<?php
namespace App\Repositories\Interface;

use App\Models\Category;

interface CategoryRepositoryInterface extends BaseRepositoryInterface{
    public function getAll();
    public function getCategoryPaginate();
    public function updateCategory($request, Category $category);
    public function fillCategory($request);
    public function deleteCategory($id);
    public function countCategory();
}