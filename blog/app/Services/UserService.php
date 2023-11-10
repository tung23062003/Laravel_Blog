<?php
namespace App\Services;

use App\Repositories\Interface\UserRepositoryInterface;

class UserService{
    
    protected $userRepository;
    public function __construct(UserRepositoryInterface $userRepository){
        $this->userRepository = $userRepository;
    }
    public function countUser(){
        return $this->userRepository->countUser();
    }
    
}