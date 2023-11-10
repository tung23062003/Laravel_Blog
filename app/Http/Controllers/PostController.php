<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Services\CategoryService;
use App\Services\PostService;
use App\Services\TagService;

class PostController extends Controller
{
    protected $postService;
    protected $categoryService;
    protected $tagService;
    public function __construct(PostService $postService, CategoryService $categoryService, TagService $tagService){
        $this->postService = $postService;
        $this->categoryService = $categoryService;
        $this->tagService = $tagService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = $this->postService->getApprovedPost();
        return view('post.post', ['posts' => $posts]);
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Post::class);
        $categories = $this->categoryService->getAll();
        return view('post.add', ['categories' => $categories]);
    }

    
    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        $this->authorize('create', Post::class);
        $this->postService->createPost($request->all());
        return redirect('/')->with('message', 'Bài viết của bạn sẽ được chuyển đến quản trị viên để duyệt');
    }
    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('post.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        $categories = $this->categoryService->getAll();
        return view('post.edit', ['post' => $post, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, Post $post)
    {
        $this->authorize('update', $post);
        $this->postService->updatePost($request->all(), $post);
        
        return redirect('../../')->with('message', 'Update thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $this->postService->deletePost($post);
        return redirect('../../')->with('message', 'Delete post successfully');
    }
}
