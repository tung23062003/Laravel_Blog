<?php
namespace App\Services;

use App\Repositories\Interface\PostTagRepositoryInterface;

class PostTagService{
    
    protected $postTagRepository;
    public function __construct(PostTagRepositoryInterface $postTagRepository){
        $this->postTagRepository = $postTagRepository;
    }
    public function create($data){
        return $this->postTagRepository->create($data);
    }
    public function delete($post_id){
        return $this->postTagRepository->delete($post_id);
    }
}