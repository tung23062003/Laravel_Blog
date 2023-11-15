<?php
namespace App\Services;

use App\Models\Tag;
use App\Repositories\Interface\TagRepositoryInterface;

class TagService{
    
    protected $tagRepository;
    public function __construct(TagRepositoryInterface $tagRepository){
        $this->tagRepository = $tagRepository;
    }
    public function all(){
        return $this->tagRepository->all();
    }
    public function getByName($name){
        return $this->tagRepository->getByName($name);
    }
    public function create($data){
        return $this->tagRepository->create($data);
    }
    public function getTagPaginate(){
        return $this->tagRepository->getTagPaginate();
    }
    public function fillTag($request){
        return $this->tagRepository->fillTag($request);
    }
    public function updateTag($request, Tag $tag){
        return $this->tagRepository->updateTag($request, $tag);
    }
    public function deleteTag(Tag $tag){
        return $this->tagRepository->deleteTag($tag);
    }
}