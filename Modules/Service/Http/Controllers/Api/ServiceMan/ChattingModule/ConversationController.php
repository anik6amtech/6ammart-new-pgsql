<?php

namespace Modules\Service\Http\Controllers\Api\ServiceMan\ChattingModule;

use App\CentralLogics\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Conversation;
use App\Models\UserInfo;
use App\Models\Message;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Modules\Service\Entities\BookingModule\Booking;
use Modules\Service\Entities\ProviderManagement\Provider;
use Modules\Service\Entities\ProviderManagement\Serviceman;

class ConversationController extends Controller
{
    public function chat_image(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }

        if ($request->has('image')) {
            $image_name = Helpers::upload('conversation/', 'png', $request->file('image'));
        } else {
            $image_name = 'def.png';
        }

        $url = asset('storage/app/public/conversation') . '/' . $image_name;

        return response()->json(['image_url' => $url], 200);
    }

    public function messages_store(Request $request)
    {

        if ($request->has('image')) {
            $image_name=[];
            foreach($request->file('image') as $key=>$img)
            {

                $name = Helpers::upload('conversation/', 'png', $img);
                array_push($image_name,['img'=>$name, 'storage'=> Helpers::getDisk()]);
            }
        } else {
            $image_name = null;
        }

        $limit = $request['limit']??10;
        $offset = $request['offset']??1;
        $fcm_token_web = null;

        $dm = Serviceman::find($request->user('serviceman')->id);

        $sender = UserInfo::where('serviceman_id', $dm->id)->first();
        if(!$sender){
            $sender = new UserInfo();
            $sender->serviceman_id = $dm->id;
            $sender->f_name = $dm->first_name;
            $sender->l_name = $dm->last_name;
            $sender->phone = $dm->phone;
            $sender->email = $dm->email;
            $sender->image = $dm->image;
            $sender->save();
        }

        if($request->conversation_id){
            $conversation = Conversation::find($request->conversation_id);

            if($conversation->sender_id == $sender->id){
                $receiver_id = $conversation->receiver_id;
                $receiver = UserInfo::find($receiver_id);
                if($receiver->provider_id){
                    $provider = Provider::find($receiver->provider_id);
                    $fcm_token=$provider->fcm_token;
                    $fcm_token_web = "provider_panel_{$provider->id}_message";
                }elseif($receiver->user_id){
                    $user = User::find($receiver->user_id);
                    $fcm_token=$user->cm_firebase_token;
                }
            }else{
                $receiver_id =$conversation->sender_id;
                $receiver = UserInfo::find($receiver_id);
                if($receiver->provider_id){
                    $provider = Provider::find($receiver->provider_id);
                    $fcm_token=$provider->fcm_token;
                    $fcm_token_web = "provider_panel_{$provider->id}_message";
                }elseif($receiver->user_id){
                    $user = User::find($receiver->user_id);
                    $fcm_token=$user->cm_firebase_token;
                }
            }
        }else{
            if($request->receiver_type == 'provider'){
                $receiver = UserInfo::where('provider_id',$request->receiver_id)->first();
                $provider = Provider::find($request->receiver_id);

                if(!$receiver){
                    $receiver = new UserInfo();
                    $receiver->provider_id = $provider->id;
                    $receiver->f_name = $provider->company_name;
                    $receiver->l_name = '';
                    $receiver->phone = $provider->phone;
                    $receiver->email = $provider->email;
                    $receiver->image = $provider->logo;
                    $receiver->save();
                }else{
                    $receiver->f_name = $provider->company_name;
                    $receiver->l_name = '';
                    $receiver->save();
                }
                $receiver_id = $receiver->id;
                $fcm_token=$provider->fcm_token;
                $fcm_token_web = "provider_panel_{$provider->id}_message";
            }else if($request->receiver_type == 'customer'){
                $receiver = UserInfo::where('user_id',$request->receiver_id)->first();
                $user = User::find($request->receiver_id);

                if(!$receiver){
                    $receiver = new UserInfo();
                    $receiver->user_id = $user->id;
                    $receiver->f_name = $user->f_name;
                    $receiver->l_name = $user->l_name;
                    $receiver->phone = $user->phone;
                    $receiver->email = $user->email;
                    $receiver->image = $user->image;
                    $receiver->save();
                }
                $receiver_id = $receiver->id;
                $fcm_token=$user->cm_firebase_token;
            }
        }

        $conversation = Conversation::WhereConversation($sender->id,$receiver_id)->first();

        if(!$conversation){
            $conversation = new Conversation;
            $conversation->sender_id = $sender->id;
            $conversation->sender_type = 'serviceman';
            $conversation->receiver_id = $receiver->id;
            $conversation->receiver_type = $request->receiver_type;
            $conversation->unread_message_count = 0;
            $conversation->last_message_time = Carbon::now()->toDateTimeString();
            $conversation->save();
            $conversation= Conversation::find($conversation->id);
        }


        $message = new Message();
        $message->conversation_id = $conversation->id;
        $message->sender_id = $sender->id;
        $message->message = $request->message;
        if($image_name && count($image_name)>0){
            $message->file = json_encode($image_name, JSON_UNESCAPED_SLASHES);
        }
        try {
            if($message->save())
            $conversation->unread_message_count = $conversation->unread_message_count? $conversation->unread_message_count+1:1;
            $conversation->last_message_id=$message->id;
            $conversation->last_message_time = Carbon::now()->toDateTimeString();
            $conversation->save();
            {
                $data = [
                    'title' =>translate('messages.message_from')." ".$sender->f_name,
                    'description' => $message->message ?? translate('attachment'),
                    'order_id' => '',
                    'image' => '',
                    'message' => json_encode($message) ,
                    'type'=> 'message',
                    'conversation_id'=> $conversation->id,
                    'sender_type'=> 'serviceman'
                ];
                Helpers::send_push_notif_to_device($fcm_token, $data);
                if($fcm_token_web){
                    Helpers::send_push_notif_to_topic($data, $fcm_token_web, 'message');
                }
            }

        } catch (\Exception $e) {
            info($e->getMessage());
        }

        $messages = Message::where(['conversation_id' => $conversation->id])->latest()->paginate($limit, ['*'], 'page', $offset);

        $conv = Conversation::with('sender','receiver','last_message')->find($conversation->id);

        if($conv->sender_type == 'provider' && $conversation->sender){
            $vd = Provider::find($conv->sender->provider_id);
            $order = Booking::where('serviceman_id',$dm->id)->where('provider_id', $vd->id)->whereIn('booking_status', ['pending','accepted','ongoing'])->count();
        }else if($conv->receiver_type == 'provider' && $conversation->receiver){
            $vd = Provider::find($conv->receiver->provider_id);
            $order = Booking::where('serviceman_id',$dm->id)->where('provider_id', $vd->id)->whereIn('booking_status', ['pending','accepted','ongoing'])->count();
        }else if($conv->sender_type == 'customer' && $conversation->sender){
            $user = User::find($conv->sender->user_id);
            $order = Booking::where('serviceman_id',$dm->id)->where('customer_id', $user->id)->whereIn('booking_status', ['pending','accepted','ongoing'])->count();
        }else if($conv->receiver_type == 'customer' && $conversation->receiver){
            $user = User::find($conv->receiver->user_id);
            $order = Booking::where('serviceman_id',$dm->id)->where('customer_id', $user->id)->whereIn('booking_status', ['pending','accepted','ongoing'])->count();
        }
        else{
            $order=0;
        }


        $data =  [
            'total_size' => intval($messages->total()),
            'limit' => intval($limit),
            'offset' => intval($offset),
            'status' => ($order>0)?true:false,
            'message' => 'successfully sent!',
            'messages' => $messages->items(),
            'conversation' => $conv,
        ];
        return response()->json($data, 200);
    }

    public function conversations(Request $request)
    {
        $limit = $request['limit']??10;
        $offset = $request['offset']??1;

        $serviceman = Serviceman::find($request->user('serviceman')->id);

        $sender = UserInfo::where('serviceman_id', $serviceman->id)->first();
        if(!$sender){
            $sender = new UserInfo();
            $sender->serviceman_id = $serviceman->id;
            $sender->f_name = $serviceman->first_name;
            $sender->l_name = $serviceman->last_name;
            $sender->phone = $serviceman->phone;
            $sender->email = $serviceman->email;
            $sender->image = $serviceman->image;
            $sender->save();
        }


        $conversations = Conversation::with('sender','receiver','last_message')->where(['sender_id' => $sender->id])->orWhere(['receiver_id' => $sender->id])->orderBy('last_message_time', 'DESC')->paginate($limit, ['*'], 'page', $offset);


        $data =  [
            'total_size' => intval($conversations->total()),
            'limit' => intval($limit),
            'offset' => intval($offset),
            'conversation' => $conversations->items()
        ];

        return response()->json($data, 200);
    }

    public function search_conversations(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }

        $key = explode(' ', $request['name']);

        $limit = $request['limit']??10;
        $offset = $request['offset']??1;

        $serviceman = Serviceman::find($request->user('serviceman')->id);

        $sender = UserInfo::where('serviceman_id', $serviceman->id)->first();
        if(!$sender){
            $sender = new UserInfo();
            $sender->serviceman_id = $serviceman->id;
            $sender->f_name = $serviceman->first_name;
            $sender->l_name = $serviceman->last_name;
            $sender->phone = $serviceman->phone;
            $sender->email = $serviceman->email;
            $sender->image = $serviceman->image;
            $sender->save();
        }

        $conversations = Conversation::with('sender','receiver','last_message')->WhereUser($sender->id)
            ->where(function($qu)use($key){
                $qu->whereHas('sender',function($query)use($key){
                    foreach ($key as $value) {
                        $query->where('f_name', 'like', "%{$value}%")
                            ->orWhere('l_name', 'like', "%{$value}%")
                            ->orWhereHas('provider', function($query2) use($value){
                                $query2->where('company_name', 'like', "%{$value}%");
                            });
                    }
                })
                ->orWhereHas('receiver',function($query1)use($key){
                    foreach ($key as $value) {
                        $query1->where('f_name', 'like', "%{$value}%")
                            ->orWhere('l_name', 'like', "%{$value}%")
                            ->orWhereHas('provider', function($query2) use($value){
                                $query2->where('company_name', 'like', "%{$value}%");
                            });
                    }
                });
            });

        $conversations = $conversations->orderBy('last_message_time', 'DESC')->paginate($limit, ['*'], 'page', $offset);

        $data =  [
            'total_size' => intval($conversations->total()),
            'limit' => intval($limit),
            'offset' => intval($offset),
            'conversation' => $conversations->items()
        ];
        return response()->json($data, 200);
    }

    public function messages(Request $request)
    {
        $limit = $request['limit']??10;
        $offset = $request['offset']??1;

        $dm = Serviceman::find($request->user('serviceman')->id);
        $serviceman = UserInfo::where('serviceman_id',$dm->id)->first();

        if(!$serviceman){
            $serviceman = new UserInfo();
            $serviceman->serviceman_id = $dm->id;
            $serviceman->f_name = $dm->first_name;
            $serviceman->l_name = $dm->last_name;
            $serviceman->phone = $dm->phone;
            $serviceman->email = $dm->email;
            $serviceman->image = $dm->image;
            $serviceman->save();
        }

        if($request->conversation_id){
            $conversation = Conversation::with(['sender','receiver','last_message'])->find($request->conversation_id);
        }else if($request->provider_id){
            $provider = UserInfo::where('provider_id', $request->provider_id)->first();
            $user = Provider::find($request->provider_id);
            if(!$provider){
                $provider = new UserInfo();
                $provider->provider_id = $user->id;
                $provider->f_name = $user->company_name;
                $provider->l_name = '';
                $provider->phone = $user->phone;
                $provider->email = $user->email;
                $provider->image = $user->logo;
                $provider->save();
            }else{
                $provider->f_name = $user->company_name;
                $provider->l_name = '';
                $provider->save();
            }
            $conversation = Conversation::with(['sender','receiver','last_message'])->WhereConversation($serviceman->id,$provider->id)->first();

        }else if($request->user_id){
            $user = UserInfo::where('user_id', $request->user_id)->first();
            if(!$user){
                $customer = User::find($request->user_id);
                $user = new UserInfo();
                $user->user_id = $customer->id;
                $user->f_name = $customer->f_name;
                $user->l_name = $customer->l_name;
                $user->phone = $customer->phone;
                $user->email = $customer->email;
                $user->image = $customer->image;
                $user->save();
            }
            $conversation = Conversation::with(['sender','receiver','last_message'])->WhereConversation($serviceman->id,$user->id)->first();
        }

        if($conversation){

            if($conversation->sender_type == 'provider' && $conversation->sender){
                $vd = Provider::find($conversation->sender->provider_id);
                $order = Booking::where('serviceman_id',$dm->id)->where('provider_id', $vd->id)->whereIn('booking_status', ['pending','accepted','ongoing'])->count();
            }else if($conversation->receiver_type == 'provider' && $conversation->receiver){
                $vd = Provider::find($conversation->receiver->provider_id);
                $order = Booking::where('serviceman_id',$dm->id)->where('provider_id', $vd->id)->whereIn('booking_status', ['pending','accepted','ongoing'])->count();
            }else if($conversation->sender_type == 'customer' && $conversation->sender){
                $user = User::find($conversation->sender->user_id);
                $order = Booking::where('serviceman_id',$dm->id)->where('customer_id', $user->id)->whereIn('booking_status', ['pending','accepted','ongoing'])->count();
            }else if($conversation->receiver_type == 'customer' && $conversation->receiver){
                $user = User::find($conversation->receiver->user_id);
                $order = Booking::where('serviceman_id',$dm->id)->where('customer_id', $user->id)->whereIn('booking_status', ['pending','accepted','ongoing'])->count();
            }
            else{
                $order=0;
            }


            $lastmessage = $conversation->last_message;
            if($lastmessage && $lastmessage->sender_id != $serviceman->id ) {
                $conversation->unread_message_count = 0;
                $conversation->save();
            }

            Message::where(['conversation_id' => $conversation->id])->where('sender_id','!=',$serviceman->id)->update(['is_seen' => 1]);
            $messages = Message::where(['conversation_id' => $conversation->id])->latest()->paginate($limit, ['*'], 'page', $offset);
        }else{
            $messages =[];
            $order=0;
        }

        $data =  [
            'total_size' => $messages? intval($messages->total()):0,
            'limit' => intval($limit),
            'offset' => intval($offset),
            'status' => ($order>0)?true:false,
            'messages' => $messages? $messages->items():[],
            'conversation' => $conversation
        ];
        return response()->json($data, 200);
    }
}
