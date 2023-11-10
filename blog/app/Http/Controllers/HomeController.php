<?php

namespace App\Http\Controllers;

use App\Repositories\PostRepository;
use App\Services\PostService;

class HomeController extends Controller
{
    private $postService;
    public function __construct(PostService $postService){
        $this->postService = $postService;
    }
    public function index(){
        $posts = $this->postService->getPublishUnOutstandingPost();
        $featuredPosts = $this->postService->getFeaturedPost();
        
        return view('home', [
            'posts' => $posts,
            'featuredPosts'=> $featuredPosts,
        ]);
    }
}
