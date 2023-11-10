<?php
namespace App\Repositories\Interface;

use App\Models\Category;

interface TagRepositoryInterface extends BaseRepositoryInterface{
    public function getByName($name);

    
}