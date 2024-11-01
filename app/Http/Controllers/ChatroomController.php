<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Chatroom;
use App\Models\Message; // Ensure to import the Message model
use Illuminate\Http\Request;
use App\Jobs\SendMessageJob;

class ChatroomController extends Controller
{
    public function createChatroom(Request $request) {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'max_members' => 'required|integer|min:1',
        ]);

        // Create a new chatroom
        $chatroom = Chatroom::create([
            'name' => $request->name,
            'max_members' => $request->max_members,
        ]);

        return response()->json($chatroom, 201);
    }

    public function sendMessage(Request $request, $chatroomId) {
        // Validate request data
        $request->validate([
            'message' => 'required|string',
            'attachment' => 'nullable|file',
        ]);

        // Create the message (if you need to store it)
        $message = Message::create([
            'chatroom_id' => $chatroomId,
            'user_id' => auth()->id(),
            'message' => $request->message,
            'attachment' => $request->file('attachment') ? $request->file('attachment')->store('attachments') : null,
        ]);

        // Dispatch the job instead of broadcasting directly
        SendMessageJob::dispatch($message, $chatroomId);

        return response()->json($message, 201);
    }
}
