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
    public function getTagPaginate(){
        return $this->tag->simplePaginate(15);
    }
    public function fillTag($request){
        $tag = new Tag();
        $tag->fill($request);
        $tag->save();
    }
    public function updateTag($request, Tag $tag){
        $tag->fill($request);
        $tag->save();
    }
    public function deleteTag(Tag $tag){
        $tag->delete();
    }
}