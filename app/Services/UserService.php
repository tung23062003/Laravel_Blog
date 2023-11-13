<?php
namespace App\Services;

use App\Models\User;
use App\Repositories\Interface\UserRepositoryInterface;

class UserService{
    
    protected $userRepository;
    public function __construct(UserRepositoryInterface $userRepository){
        $this->userRepository = $userRepository;
    }
    public function countUser(){
        return $this->userRepository->countUser();
    }
    public function getUserPaginate(){
        return $this->userRepository->getUserPaginate();
    }
    public function fillUser($request){
        return $this->userRepository->fillUser($request);
    }
    public function updateUser($request, User $user){
        return $this->userRepository->updateUser($request, $user);
    }
    public function deleteUser(User $user){
        return $this->userRepository->deleteUser($user);
    }
}