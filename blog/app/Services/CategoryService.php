<?php
namespace App\Services;

use App\Models\Category;
use App\Repositories\Interface\CategoryRepositoryInterface;

class CategoryService{
    
    protected $categoryRepository;
    public function __construct(CategoryRepositoryInterface $categoryRepository){
        $this->categoryRepository = $categoryRepository;
    }
    public function getAll(){
        return $this->categoryRepository->getAll();
    }
    public function getCategoryPaginate(){
        return $this->categoryRepository->getCategoryPaginate();
    }
    public function fillCategory($request){
        return $this->categoryRepository->fillCategory($request);
    }
    public function updateCategory($request, Category $category){
        return $this->categoryRepository->updateCategory($request, $category);
    }
    public function deleteCategory(Category $category){
        $id = $category->id;
        return $this->categoryRepository->deleteCategory($id);
    }
    public function countCategory(){
        return $this->categoryRepository->countCategory();
    }
}