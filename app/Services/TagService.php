<?php
namespace App\Services;

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
    
}