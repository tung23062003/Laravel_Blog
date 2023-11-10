<?php
namespace App\Services;

use App\Repositories\Interface\CommentRepositoryInterface;
use Illuminate\Http\Request;

class CommentService{
    
    protected $commentRepository;
    public function __construct(CommentRepositoryInterface $commentRepository){
        $this->commentRepository = $commentRepository;
    }
    public function fillComment($request){
        return $this->commentRepository->fillComment($request);
    }
    public function fillReply($request){
        return $this->commentRepository->fillReply($request);
    }
    public function getAllComment($post_id){
        return $this->commentRepository->getAllComment($post_id);
    }
    public function getCommentView($post_id, $comments){
        return $this->commentRepository->getCommentView($post_id, $comments);
    }
    public function updateComment($request){
        return $this->commentRepository->updateComment($request);
    }
    public function findComment($id){
        return $this->commentRepository->findComment($id);
    }
    public function deleteComment($id){
        return $this->commentRepository->deleteComment($id);
    }
}