<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reply;

class ConversationBestReplyController extends Controller
{
    public function store(Reply $reply)
    {
        // authorize that the current user has permission to set the best reply 
        // for the conversation
        $this->authorize('update', $reply->conversation);
        // $this->authorize($reply->conversation);

        // then set it 
        // $reply->conversation->best_reply_id = $reply->id;
        // $reply->conversation->save();
        $reply->conversation->setBestReply($reply);

        // redirect back to the conversation page
        return back();
    }
}