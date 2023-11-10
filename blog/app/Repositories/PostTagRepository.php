<?php
namespace App\Repositories;
use App\Models\Category;
use App\Models\PostTag;

;
use App\Repositories\Interface\PostTagRepositoryInterface;

class PostTagRepository extends BaseRepository implements PostTagRepositoryInterface{
    protected $postTag;
    public function __construct(PostTag $postTag){
        $this->postTag = $postTag;
        parent::__construct($postTag);
    }
    public function delete($post_id){
        return $this->postTag->where('post_id', $post_id)->delete();
    }
}