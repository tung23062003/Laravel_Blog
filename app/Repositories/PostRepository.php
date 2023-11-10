<?php
namespace App\Repositories;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Repositories\Interface\PostRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class PostRepository extends BaseRepository implements PostRepositoryInterface{
    protected $post;
    public function __construct(Post $post){
        $this->post = $post;
        parent::__construct($post);
    }
    public function getPublishUnOutstandingPost() {
        return $this->post->with('user', 'tags')->where([
            ['approved', true],
            ['outstanding', false],
        ])->simplePaginate(8);
    }
    public function getFeaturedPost(){
        return $this->post->with('user', 'tags')->where('outstanding', true)->get();
    }
    public function getApprovedPost(){
        return $this->post->with('user','tags')->where('approved', true)->simplePaginate(12);
    }
    public function createPost($request, $content, $imageShow_name){
        $post = new Post();
        $post->tittle = $request['tittle'];
        $post->content = $content;
        $post->slug = $request['slug'];
        $post->image = $imageShow_name;
        $post->category_id = $request['category_id'];
        $post->user()->associate(Auth::user()->id);
        $post->save();
        return $post;
    }
    public function createPostAdmin($request, $content, $imageShow_name){
        $post = new Post();
        $post->tittle = $request['tittle'];
        $post->content = $content;
        $post->slug = $request['slug'];
        $post->image = $imageShow_name;
        $post->category_id = $request['category'];
        $post->approved = true;
        $post->user()->associate(Auth::user()->id);
        $post->save();
        return $post;
    }
    public function updatePost($request, Post $post, $content){
        $post->content = $content;
        $post->tittle = $request['tittle'];
        $post->slug = $request['slug'];
        $post->category_id = $request['category'];
        $post->save();
        return $post;
    }
    public function updateImage(Post $post, $image_name){
        $post->image = $image_name;
    }
    public function deletePost(Post $post){
        return $post->delete();
    }
    public function addFeaturedPost(Post $post){
        $post->outstanding = true;
        $post->save();
    }
    public function countFeaturedPost(){
        return $this->post->with('user', 'tags')->where('outstanding', true)->count();
    }
    public function removeFeaturedPost(Post $post){
        $post->outstanding = false;
        $post->save();
    }
    public function getUnapprovedPost(){
        return $this->post->with('user', 'tags')->where('approved', false)->get();
    }
    public function acceptPost(Post $post){
        $post->approved = true;
        $post->save();
    }
    public function rejectPost(Post $post){
        $post->delete();
    }
    public function countApprovedPost(){
        return $this->post->where('approved', true)->count();
    }
    public function countUnapprovedPost(){
        return $this->post->where('approved', false)->count();
    }
}