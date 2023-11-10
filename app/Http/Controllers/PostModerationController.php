<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Services\PostService;

class PostModerationController extends Controller
{
    protected $postService;
    public function __construct(PostService $postService){
        $this->postService = $postService;
    }
    public function index(){
        $posts = $this->postService->getUnapprovedPost();
        return view('admin.moderation', ['posts' => $posts]);
    }
    public function accept(Post $post){
        $this->postService->acceptPost($post);
        return redirect()->back()->with('success','Post accepted');
    }
    public function reject(Post $post){
        $this->postService->rejectPost($post);
        return redirect()->back()->with('success','Post rejected');
    }
}
