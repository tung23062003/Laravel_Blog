<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Services\PostService;

class FeaturedPostController extends Controller
{
    protected $postSerivce;
    public function __construct(PostService $postService){
        $this->postSerivce = $postService;
    }
    public function index(){
        $posts = $this->postSerivce->getFeaturedPost();
        return view("admin.featuredPost", ["posts"=> $posts]);
    }
    public function addToFeatured(Post $post){
        $this->postSerivce->addFeaturedPost($post);
        return redirect()->route('admin.featuredPost')->with("success","Add successfully");
    }
    public function removeFromFeatured(Post $post){
        $this->postSerivce->removeFeaturedPost($post);
        return redirect()->back()->with("success","Remove successfully");
    }
}
