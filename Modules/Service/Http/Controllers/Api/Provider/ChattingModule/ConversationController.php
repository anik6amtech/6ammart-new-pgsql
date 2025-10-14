<?php

namespace Modules\Service\Http\Controllers\Api\Provider\ChattingModule;

use App\CentralLogics\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Conversation;
use App\Models\UserInfo;
use App\Models\Message;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Modules\Service\Entities\BookingModule\Booking;
use Modules\Service\Entities\ProviderManagement\Provider;
use Modules\Service\Entities\ProviderManagement\Serviceman;

class ConversationController extends Controller
{
    public function messages_store(Request $request)
    {
        if ($request->has('image')) {
            $image_name=[];
            foreach($request->file('image') as $key=>$img)
            {

                $name = Helpers::upload('conversation/', 'png', $img);
                $image_name[] = ['img'=>$name, 'storage'=> Helpers::getDisk()];
            }
        } else {
            $image_name = null;
        }

        $limit = $request['limit']??10;
        $offset = $request['offset']??1;

        $provider = Provider::find($request->user('provider')->id);
        $sender = UserInfo::where('provider_id', $provider->id)->first();
        if(!$sender){
            $sender = new UserInfo();
            $sender->provider_id = $provider->id;
            $sender->f_name = $provider->company_name;
            $sender->l_name = '';
            $sender->phone = $provider->phone;
            $sender->email = $provider->email;
            $sender->image = $provider->logo;
            $sender->save();
        }else{
            $sender->f_name = $provider->company_name;
            $sender->l_name = '';
            $sender->save();
        }

        if($request->conversation_id){
            $conversation = Conversation::find($request->conversation_id);

            if($conversation->sender_id == $sender->id){
                $receiver_id = $conversation->receiver_id;
                $receiver = UserInfo::find($receiver_id);
                if($receiver->serviceman_id){
                    $serviceman = Serviceman::find($receiver->serviceman_id);
                    $fcm_token=$serviceman->fcm_token;
                }elseif($receiver->user_id){
                    $user = User::find($receiver->user_id);
                    $fcm_token=$user->cm_firebase_token;
                }
            }else{
                $receiver_id =$conversation->sender_id;
                $receiver = UserInfo::find($receiver_id);
                if($receiver->serviceman_id){
                    $serviceman = Serviceman::find($receiver->serviceman_id);
                    $fcm_token=$serviceman->fcm_token;
                }elseif($receiver->user_id){
                    $user = User::find($receiver->user_id);
                    $fcm_token=$user->cm_firebase_token;
                }
            }
        }else{

            if($request->receiver_type == 'customer'){
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

            }else if($request->receiver_type == 'serviceman'){
                $receiver = UserInfo::where('serviceman_id',$request->receiver_id)->first();
                $serviceman = Serviceman::find($request->receiver_id);

                if(!$receiver){
                    $receiver = new UserInfo();
                    $receiver->serviceman_id = $serviceman->id;
                    $receiver->f_name = $serviceman->first_name;
                    $receiver->l_name = $serviceman->last_name;
                    $receiver->phone = $serviceman->phone;
                    $receiver->email = $serviceman->email;
                    $receiver->image = $serviceman->image;
                    $receiver->save();
                }
                $receiver_id = $receiver->id;
                $fcm_token=$serviceman->fcm_token;
            }
        }
        $conversation = Conversation::with('sender','receiver','last_message')->WhereConversation($sender->id,$receiver_id)->first();


        if(!$conversation){
            $conversation = new Conversation;
            $conversation->sender_id = $sender->id;
            $conversation->sender_type = 'provider';
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
            {
                $conversation->unread_message_count = $conversation->unread_message_count? $conversation->unread_message_count+1:1;
                $conversation->last_message_id=$message->id;
                $conversation->last_message_time = Carbon::now()->toDateTimeString();
                $conversation->save();

                $data = [
                    'title' =>translate('messages.message_from')." ".$sender->f_name,
                    'description' => $message->message ?? translate('attachment'),
                    'order_id' => '',
                    'image' => '',
                    'type'=> 'message',
                    'conversation_id'=> $conversation->id,
                    'sender_type'=> 'provider'
                ];
                Helpers::send_push_notif_to_device($fcm_token, $data);

            }

        } catch (\Exception $e) {
            info($e->getMessage());
        }

        $messages = Message::where(['conversation_id' => $conversation->id])->latest()->paginate($limit, ['*'], 'page', $offset);

        $conv = Conversation::with('sender','receiver','last_message')->find($conversation->id);

        if($conv->sender_type == 'customer' && $conversation->sender){
            $user = User::find($conv->sender->user_id);
            $order = Booking::where('provider_id',$provider->id)->where('customer_id', $user->id)->whereIn('booking_status', ['pending','accepted','ongoing'])->count();
        }else if($conv->receiver_type == 'customer' && $conversation->receiver){
            $user = User::find($conv->receiver->user_id);
            $order = Booking::where('provider_id',$provider->id)->where('customer_id', $user->id)->whereIn('booking_status', ['pending','accepted','ongoing'])->count();
        }else if($conv->sender_type == 'serviceman' && $conversation->sender){
            $user2 = Serviceman::find($conv->sender->serviceman_id);
            $order = Booking::where('provider_id',$provider->id)->where('serviceman_id', $user2->id)->whereIn('booking_status', ['pending','accepted','ongoing'])->count();
        }else if($conv->receiver_type == 'serviceman' && $conversation->receiver){
            $user2 = Serviceman::find($conv->receiver->serviceman_id);
            $order = Booking::where('provider_id',$provider->id)->where('serviceman_id', $user2->id)->whereIn('booking_status', ['pending','accepted','ongoing'])->count();
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

        $provider = Provider::find($request->user('provider')->id);

        $sender = UserInfo::where('provider_id', $provider->id)->first();

        if(!$sender){
            $sender = new UserInfo();
            $sender->provider_id = $provider->id;
            $sender->f_name = $provider->company_name;
            $sender->l_name = '';
            $sender->phone = $provider->phone;
            $sender->email = $provider->email;
            $sender->image = $provider->logo;
            $sender->save();
        }else{
            $sender->f_name = $provider->company_name;
            $sender->l_name = '';
            $sender->save();
        }

        $conversations = Conversation::with(['sender', 'receiver','last_message'])->where(['sender_id' => $sender->id])->orWhere(['receiver_id' => $sender->id])->orderBy('last_message_time', 'DESC')->paginate($limit, ['*'], 'page', $offset);


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

        $provider = Provider::find($request->user('provider')->id);

        $sender = UserInfo::where('provider_id', $provider->id)->first();

        if(!$sender){
            $sender = new UserInfo();
            $sender->provider_id = $provider->id;
            $sender->f_name = $provider->company_name;
            $sender->l_name = '';
            $sender->phone = $provider->phone;
            $sender->email = $provider->email;
            $sender->image = $provider->logo;
            $sender->save();
        }else{
            $sender->f_name = $provider->company_name;
            $sender->l_name = '';
            $sender->save();
        }

        $conversations = Conversation::with('sender','receiver','last_message')->WhereUser($sender->id)->where(function($qu)use($key){
                    $qu->whereHas('sender',function($query)use($key){
                    foreach ($key as $value) {
                        $query->where('f_name', 'like', "%{$value}%")->orWhere('l_name', 'like', "%{$value}%");
                    }
                })
                ->orWhereHas('receiver',function($query1)use($key){
                    foreach ($key as $value) {
                        $query1->where('f_name', 'like', "%{$value}%")->orWhere('l_name', 'like', "%{$value}%");
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

        $vnd = Provider::find($request->user('provider')->id);
        $provider = UserInfo::where('provider_id', $vnd->id)->first();
        if(!$provider){
            $provider = new UserInfo();
            $provider->provider_id = $vnd->id;
            $provider->f_name = $vnd->company_name;
            $provider->l_name = '';
            $provider->phone = $vnd->phone;
            $provider->email = $vnd->email;
            $provider->image = $vnd->logo;
            $provider->save();
        }else{
            $provider->f_name = $vnd->company_name;
            $provider->l_name = '';
            $provider->save();
        }

        $conversation = null;
        
        if($request->conversation_id){
            $conversation = Conversation::with(['sender','receiver'])->find($request->conversation_id);
        }else if($request->serviceman_id){
            $dm = UserInfo::where('serviceman_id', $request->serviceman_id)->first();
            if(!$dm){
                $user = Serviceman::find($request->serviceman_id);
                $dm = new UserInfo();
                $dm->serviceman_id = $user->id;
                $dm->f_name = $user->first_name;
                $dm->l_name = $user->last_name;
                $dm->phone = $user->phone;
                $dm->email = $user->email;
                $dm->image = $user->image;
                $dm->save();
            }
            $conversation = Conversation::with(['sender','receiver','last_message'])->WhereConversation($provider->id,$dm->id)->first();
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
            $conversation = Conversation::with(['sender','receiver','last_message'])->WhereConversation($provider->id,$user->id)->first();
        }


        if($conversation){

            if($conversation->sender_type == 'customer' && $conversation->sender){
                $user = User::find($conversation->sender->user_id);
                $order = Booking::where('provider_id',$vnd->id)->where('customer_id', $user->id)->whereIn('booking_status', ['pending','accepted','ongoing'])->count();
            }else if($conversation->receiver_type == 'customer'  && $conversation->receiver){
                $user = User::find($conversation->receiver->user_id);
                $order = Booking::where('provider_id',$vnd->id)->where('customer_id', $user->id)->whereIn('booking_status', ['pending','accepted','ongoing'])->count();
            }else if($conversation->sender_type == 'serviceman'&& $conversation->sender){
                $user2 = Serviceman::find($conversation->sender->serviceman_id);
                $order = Booking::where('provider_id',$vnd->id)->where('serviceman_id', $user2->id)->whereIn('booking_status', ['pending','accepted','ongoing'])->count();
            }else if($conversation->receiver_type == 'serviceman' && $conversation->receiver){
                $user2 = Serviceman::find($conversation->receiver->serviceman_id);
                $order = Booking::where('provider_id',$vnd->id)->where('serviceman_id', $user2->id)->whereIn('booking_status', ['pending','accepted','ongoing'])->count();
            }
            else{
                $order=0;
            }

            $lastmessage = $conversation->last_message;
            if($lastmessage && $lastmessage->sender_id != $provider->id ) {
                $conversation->unread_message_count = 0;
                $conversation->save();
            }
            Message::where(['conversation_id' => $conversation->id])->where('sender_id','!=', $provider->id)->update(['is_seen' => 1]);
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
