<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\CommentService;

class CommentController extends Controller
{
    protected $commentService;
    public function __construct(CommentService $commentService){
        $this->commentService = $commentService;
    }
    public function store(Request $request)
    {
        $this->commentService->fillComment($request->all());
        return response()->json(['status' => 200]);
    }

    public function fetchAll(Request $request){
        $comments = $this->commentService->getAllComment($request->id);
        $view = $this->commentService->getCommentView($request->id, $comments);
        return response()->json([
            'status'=> 200,
            'data'=> $view,
        ]);
    }

    function reply(Request $request){
        $this->commentService->fillReply($request->all());
        return response()->json(['status' => 200]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $this->authorize('update', Comment::class);
        $this->commentService->updateComment($request->all());
        return response()->json([
            'status'=> 200,
            'comment_content' => $request->content,
            'comment_id' => $request->comment_id
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $this->commentService->deleteComment($request->id);
        return response()->json(['status' => 200]);
    }
}
