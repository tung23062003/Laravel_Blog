<?php
namespace App\Repositories;
use App\Models\Category;
use App\Repositories\Interface\CategoryRepositoryInterface;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface{
    protected $category;
    public function __construct(Category $category){
        $this->category = $category;
        parent::__construct($category);
    }
    public function getAll(){
        return $this->category->all();
    }
    public function getCategoryPaginate(){
        return $this->category->paginate(15);
    }
    public function fillCategory($request){
        $category = new Category();
        $category->fill($request);
        $category->save();
    }
    public function updateCategory($request, Category $category){
        $category->fill($request);
        $category->save();
    }
    public function deleteCategory($id){
        return $this->category->where('id', $id)->delete();
    }
    public function countCategory(){
        return $this->category->count();
    }
}