<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use App\Models\ChatMessage;
use App\Models\User;

class ChatController extends Controller
{
    public function SendMsg (Request $request) {

        $request->validate([
            'msg' => 'required',
        ], [
            'msg.required' => 'Entrez votre message',
        ]);

        ChatMessage::create([
            'sender_id' => Auth::user()->id,
            'receiver_id' => $request->receiver_id,
            'msg' => $request->msg,
            'created_at' => Carbon::now(),
        ]);

        return response()->json(['message' => 'Message envoyé avec succès.']);

    } // fin de la fonction


    public function GetAllUsers () {

        $auth_id = Auth::id();

        $chats = ChatMessage::latest()->where('sender_id', $auth_id)
                            ->orWhere('receiver_id', $auth_id)->get();

        $users = $chats->flatMap(function ($chat) {
            if ($chat->sender_id === auth()->id()) {
                return [$chat->senders, $chat->receivers];
            }

            return [$chat->senders, $chat->receivers];
        })->unique();

        return $users;

    } // fin de la fonction


    public function UserMsgById ($userId) {

        $user = User::find($userId);

        if ($user) {
            $messages = ChatMessage::where(function ($q) use ($userId) {
                $q->where('sender_id', auth()->id());
                $q->where('receiver_id', $userId);
            })->orWhere(function ($q) use ($userId) {
                $q->where('sender_id', $userId);
                $q->where('receiver_id', auth()->id());
            })->with('users')->get();

            return response().json([
                'user' => $user,
                'messages' => $messages,
            ]);
        } else {
            abort(404);
        }

    } // fin de la fonction
}
