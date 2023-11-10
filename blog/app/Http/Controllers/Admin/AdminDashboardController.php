<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use App\Services\CategoryService;
use App\Services\PostService;
use App\Services\UserService;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    protected $postService;
    protected $userService;
    protected $categoryService;
    public function __construct(PostService $postService, UserService $userService, CategoryService $categoryService){
        $this->postService = $postService;
        $this->userService = $userService;
        $this->categoryService = $categoryService;
    }
    public function index(){
        $userCount = $this->userService->countUser();
        $categoryCount = $this->categoryService->countCategory();
        $postCount = $this->postService->countApprovedPost();
        $unaprrovedCount = $this->postService->countUnapprovedPost();
        return view('admin.dashboard')->with([
            'userCount'=> $userCount,
            'categoryCount'=> $categoryCount,
            'postCount'=> $postCount,
            'unaprrovedCount'=> $unaprrovedCount
        ]);
    }
}
