<?php
namespace App\Repositories;
use App\Models\Comment;
use App\Models\Post;
use App\Repositories\Interface\CommentRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentRepository extends BaseRepository implements CommentRepositoryInterface{
    protected $comment;
    public function __construct(Comment $comment){
        $this->comment = $comment;
        parent::__construct($comment);
    }
    public function fillComment($request){
        $comment = new Comment();
        $comment->fill($request);
        $comment->user()->associate(Auth::user()->id);
        $comment->save();
    }
    public function fillReply($request){
        $comment = new Comment();
        $comment->fill($request);
        $comment->parent_id = $request['comment_id'];
        $comment->user()->associate(Auth::user()->id);
        $comment->save();
    }
    public function getAllComment($post_id){
        return Post::find($post_id)->comments()->with('user', 'replies', 'replies.replies')->orderBy('created_at','desc')->paginate(10);
    }
    public function getCommentView($post_id, $comments){
        return view('reply', ['comments' => $comments, 'post_id' => $post_id, 'padding' => null, 'margin' => 'mt-4', 'isReply' => null])->render();
    }
    public function updateComment($request){
        return $this->comment->findOrFail($request['comment_id'])->update(['content' => $request['content']]);
    }
    public function findComment($id){
        return $this->comment->find($id);
    }
    public function deleteComment($id){
        return $this->comment->findOrFail($id)->delete();
    }
}