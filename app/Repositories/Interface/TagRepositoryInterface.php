<?php
namespace App\Repositories\Interface;
use App\Models\Tag;


interface TagRepositoryInterface extends BaseRepositoryInterface{
    public function getByName($name);

    public function getTagPaginate();

    public function fillTag($request);
    public function updateTag($request, Tag $tag);
    public function deleteTag(Tag $tag);
}