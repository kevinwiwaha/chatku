<?php

namespace App\Http\Controllers;

use App\Chat;
use App\Events\ChatStoredEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        return Chat::with('user')->orderBy('created_at', 'desc')->take(10)->get();
    }
    public function store(Request $request)
    {
        $chat = Chat::create([
            'subject' => $request->subject,
            'user_id' => Auth::user()->id
        ]);
        broadcast(new ChatStoredEvent($chat))->toOthers();
        return response()->json([
            'status' => 'Message Sent!',
            'data' => [
                'subject' => $request->subject,
                'user_id' => Auth::user()->id
            ]
        ]);
    }
    public function tes()
    {
        dd(Chat::all());
    }
}
