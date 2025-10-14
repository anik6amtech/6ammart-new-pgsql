<?php

namespace Modules\Service\Http\Controllers\Web\Provider\ChattingModule;

use App\Http\Controllers\Controller;
use App\CentralLogics\Helpers;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use App\Models\UserInfo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Modules\Service\Entities\ProviderManagement\Serviceman;

class ConversationController extends Controller
{
    public function list(Request $request)
    {
        $provider = Helpers::get_provider_data();
        $provider = UserInfo::where('provider_id',$provider->id)->first();
        if($provider){
            $conversations = Conversation::with(['sender','receiver', 'last_message'])->WhereUser($provider->id);
            if($request->query('key')) {
                $key = explode(' ', $request->get('key'));
                $conversations = $conversations->where(function($qu)use($key){
                    $qu->whereHas('sender',function($query)use($key){
                        foreach ($key as $value) {
                            $query->where('f_name', 'like', "%{$value}%")
                            ->orWhere('l_name', 'like', "%{$value}%")
                            ->orWhere('phone', 'like', "%{$value}%");
                        }
                    })
                    ->orWhereHas('receiver',function($query1)use($key){
                        foreach ($key as $value) {
                            $query1->where('f_name', 'like', "%{$value}%")
                            ->orWhere('l_name', 'like', "%{$value}%")
                            ->orWhere('phone', 'like', "%{$value}%");
                        }
                    });
                });
            }
            $conversations = $conversations->orderBy('last_message_time', 'DESC')
            ->latest()
            ->paginate(8);
        }else{
            $conversations = [];
        }


        if ($request->ajax()) {

            $view = view('service::provider.messages.data',compact('conversations'))->render();
            return response()->json(['html'=>$view]);
        }

        return view('service::provider.messages.index', compact('conversations'));
    }

    public function view($conversation_id,$user_id)
    {
        $conversation = Conversation::find($conversation_id);
        $lastmessage = $conversation->last_message;
        if($lastmessage && $lastmessage->sender_id == $user_id ) {
            $conversation->unread_message_count = 0;
            $conversation->save();
        }
        Message::where(['conversation_id' => $conversation->id])->where('sender_id',$user_id)->update(['is_seen' => 1]);
        $convs = Message::where(['conversation_id' => $conversation_id])->get();
        // Message::where(['conversation_id' => $conversation_id])->update(['is_seen' => 1]);
        $conversation= Conversation::find($conversation_id);
        $receiver = $conversation->receiver;
        $sender = $conversation->sender;
        $provider = Helpers::get_provider_data();
        $provider = UserInfo::where('provider_id',$provider->id)->first();

        if($receiver->user_id){
            $user = User::find($receiver->user_id);
            $user_type = 'user';
        }elseif($receiver->serviceman_id){
            $user = Serviceman::find($receiver->serviceman_id);
            $user_type = 'serviceman';
        }elseif($sender->user_id){
            $user = User::find($sender->user_id);
            $user_type = 'user';
        }else{
            $user = Serviceman::find($sender->serviceman_id);
            $user_type = 'serviceman';
        }

        return response()->json([
            'view' => view('service::provider.messages.partials._conversations', compact('convs', 'user', 'receiver','sender','user_type','provider'))->render()
        ]);
    }

    public function store(Request $request, $user_id, $user_type)
    {
        if ($request->has('images')) {
            $image_name=[];
            foreach($request->images as $key=>$img)
            {
                $name = Helpers::upload('conversation/', 'png', $img);
                array_push($image_name,['img'=>$name, 'storage'=> Helpers::getDisk()]);
            }
        } else {
            $image_name = null;

            $validator = Validator::make($request->all(), [
                'reply' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => Helpers::error_processor($validator)]);
            }
        }

        $provider = Helpers::get_provider_data();
        $sender = UserInfo::where('provider_id',$provider->id)->first();
        if(!$sender){
            $sender = new UserInfo();
            $sender->provider_id = $provider->id;
            $sender->f_name = $provider->first_name;
            $sender->l_name = $provider->last_name;
            $sender->phone = $provider->phone;
            $sender->email = $provider->email;
            $sender->image = $provider->logo;
            $sender->save();
        }

        if($user_type == 'user'){

            $user = User::find($user_id);
            $fcm_token=$user->cm_firebase_token;
            $receiver = UserInfo::where('user_id', $user->id)->first();
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

        }elseif($user_type == 'serviceman'){
            $serviceman = Serviceman::find($user_id);
            $fcm_token=$serviceman->fcm_token;
            $receiver = UserInfo::where('serviceman_id', $serviceman->id)->first();
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
            $user = Serviceman::find($user_id);
        }



        $conversation = Conversation::WhereConversation($sender->id,$receiver->id)->first();


        if(!$conversation){
            $conversation = new Conversation;
            $conversation->sender_id = $sender->id;
            $conversation->sender_type = 'provider';
            $conversation->receiver_id = $receiver->id;
            $conversation->receiver_type = $user_type;
            $conversation->last_message_time = Carbon::now()->toDateTimeString();
            $conversation->save();

            $conversation= Conversation::find($conversation->id);
        }

        $message = new Message();
        $message->conversation_id = $conversation->id;
        $message->sender_id = $sender->id;
        $message->message = $request->reply;
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
                    'message' => $message,
                    'type'=> 'message',
                    'conversation_id'=> $conversation->id,
                    'sender_type'=> 'provider'
                ];
                Helpers::send_push_notif_to_device($fcm_token, $data);
            }

        } catch (\Exception $e) {
            info($e->getMessage());
        }
        $provider = UserInfo::where('provider_id',$provider->id)->first();
        $convs = Message::where(['conversation_id' => $conversation->id])->get();
        return response()->json([
            'view' => view('service::provider.messages.partials._conversations', compact('convs', 'user', 'receiver','user_type','provider'))->render()
        ]);
    }
}
