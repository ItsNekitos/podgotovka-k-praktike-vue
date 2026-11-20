<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\Order;
use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function comment(CommentRequest $request, Place $place)
    {
        $comment = new Comment();
        $comment->user_id = Auth::id();
        $comment->place_id = $place->id;
        $comment->comment = $request->comment;
        $comment->save();
        return response()->json(["message"=>"ok"]);
    }
}
