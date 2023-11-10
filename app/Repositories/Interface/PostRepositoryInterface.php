<?php
namespace App\Repositories\Interface;

use App\Http\Requests\PostRequest;
use App\Models\Post;

interface PostRepositoryInterface extends BaseRepositoryInterface{

    public function getPublishUnOutstandingPost();
    public function getFeaturedPost();
    public function getApprovedPost();
    public function createPost($request, $content, $image_name);
    public function createPostAdmin($request, $content, $image_name);
    public function updatePost($request, Post $post, $content);
    public function updateImage(Post $post, $image_name);
    public function deletePost(Post $post);
    public function addFeaturedPost(Post $post);
    public function countFeaturedPost();
    public function countApprovedPost();
    public function countUnapprovedPost();
    public function removeFeaturedPost(Post $post);
    public function getUnapprovedPost();
    public function acceptPost(Post $post);
    public function rejectPost(Post $post);
}