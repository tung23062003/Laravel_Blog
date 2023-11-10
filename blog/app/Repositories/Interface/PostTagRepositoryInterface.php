<?php
namespace App\Repositories\Interface;

use App\Models\Category;

interface PostTagRepositoryInterface extends BaseRepositoryInterface{
    public function delete($post_id);
}