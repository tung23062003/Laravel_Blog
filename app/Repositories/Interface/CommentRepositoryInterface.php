<?php
namespace App\Repositories\Interface;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;

interface CommentRepositoryInterface extends BaseRepositoryInterface{
    public function fillComment($request);
    public function fillReply($request);
    public function getAllComment($post_id);
    public function getCommentView($post_id, $comments);
    public function updateComment($request);
    public function findComment($id);
    public function deleteComment($id);
}