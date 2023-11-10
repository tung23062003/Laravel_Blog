<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Services\CategoryService;

class CategoryController extends Controller
{
    protected $categoryService;
    public function __construct(CategoryService $categoryService){
        $this->categoryService = $categoryService;
    }
    
    public function index()
    {
        $categories = $this->categoryService->getCategoryPaginate();
        return view('admin.category.category', ['categories' => $categories]);
    }

    public function create()
    {
        return view('admin.category.add');
    }

    public function store(CategoryRequest $request)
    {
        $this->categoryService->fillCategory($request->all());
        return redirect()->route('category.index')->with('message', 'Add category successfully');
    }

    public function show(Category $category)
    {
        //
    }

    public function edit(Category $category)
    {
        return view('admin.category.edit', ['category' => $category]);
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $this->categoryService->updateCategory($request->all(), $category);
        return redirect()->route('category.index')->with('message', 'Update category successfully');
    }

    public function destroy(Category $category)
    {
        $this->categoryService->deleteCategory($category);
        return redirect()->route('category.index')->with('message', 'Delete category successfully');
    }
}
