<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreConversationRequest;
use App\Http\Requests\StoreMessageRequest;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function inbox()
    {
        $conversations = Conversation::where('sender_id', Auth::id())->orWhere('receiver_id', Auth::id())->orderByDesc('updated_at')->get();
        return view('messages.inbox', compact('conversations'));
    }

    public function write($user_id = false)
    {
        if($user_id) {
            $users[] = User::findOrFail($user_id);
        } else {
            $users = User::all();
        }

        return view('messages.write', compact('users'));
    }

    public function storeConversation(StoreConversationRequest $request)
    {
        $conversation = new Conversation();
        $conversation->title = $request->post('title');
        $conversation->sender_id = Auth::id();
        $conversation->receiver_id = $request->post('receiver_id');
        $conversation->save();

        Message::create([
            'sender_id' => Auth::id(),
            'conversation_id' => $conversation->id,
            'message' => $request->post('message'),
            'read' => false
        ]);

        return redirect()->route('messages.show-conversation', $conversation);
    }

    public function storeMessage($conversation_id, StoreMessageRequest $request)
    {
        $conversation = Conversation::findOrFail($conversation_id);

        //update conversation timestamp updatet_ad to order at top
        $conversation->updated_at = \Carbon\Carbon::now()->toDateTimeString();
        $conversation->save();

        $message = new Message();
        $message->sender_id = Auth::id();
        $message->conversation_id = $conversation_id;
        $message->message = $request->post('message');
        $message->read = false;
        $message->save();

        return redirect()->route('messages.show-conversation', $conversation_id);
    }

    public function conversation($conversation_id)
    {
        $conversation = Conversation::findOrFail($conversation_id);

        $unreadMessages = $conversation->messages->where("sender_id", '!=', Auth::id())->where('read', false);

        foreach ($unreadMessages as $unreadMessage) {
            $unreadMessage->read = true;
            $unreadMessage->save();
        }

        $lastMessage = $conversation->messages->last();
        if($lastMessage->read == true) {
            $seen = "Seen " . $lastMessage->updated_at;
        } else {
            $seen = "Not seen";
        }

        return view('messages.conversation', compact('conversation', 'seen'));
    }
}
