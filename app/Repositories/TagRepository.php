<?php
namespace App\Repositories;
use App\Models\Category;
use App\Models\Tag;
use App\Repositories\Interface\TagRepositoryInterface;

class TagRepository extends BaseRepository implements TagRepositoryInterface{
    protected $tag;
    public function __construct(Tag $tag){
        $this->tag = $tag;
        parent::__construct($tag);
    }
    public function getByName($name){
        return $this->tag->where("name", $name)->get();
    }
}