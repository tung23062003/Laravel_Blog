<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\ApprovedPost;
use App\Models\Category;
use App\Models\Post;
use App\Models\PostTag;
use App\Models\Tag;
use App\Services\CategoryService;
use App\Services\PostService;
use App\Services\TagService;
use DOMDocument;

class AdminPostController extends Controller
{
    protected $postService;
    protected $categoryService;
    protected $tagService;
    public function __construct(PostService $postService, CategoryService $categoryService, TagService $tagService){
        $this->postService = $postService;
        $this->categoryService = $categoryService;
        $this->tagService = $tagService;
        $this->authorizeResource(Post::class, 'post');
    }
    
    public function index()
    {
        $posts = $this->postService->getApprovedPost();
        return view('admin.post.post', ['posts' => $posts]);
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->categoryService->getAll();
        return view('admin.post.add', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        $this->postService->createPost($request->all());
        return redirect('/admin/dashboard/post')->with('message', 'Add Post successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('admin.post.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = $this->categoryService->getAll();
        return view('admin.post.edit', ['post' => $post, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, Post $post)
    {
        $this->postService->updatePost($request->all(), $post);
        return redirect('../../')->with('message', 'Update thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->postService->deletePost($post);
        return redirect('../../')->with('message', 'Delete post successfully');
    }
}
