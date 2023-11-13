<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function showChat(){
        return view('chat');
    }
    public function messageReceived(Request $request){
        broadcast(new MessageSent($request->user(), $request->message));
        return response()->json('Message broadcast');
    }
}
