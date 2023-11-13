<?php
namespace App\Repositories;
use App\Models\Tag;
use App\Models\User;
use App\Repositories\Interface\UserRepositoryInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface{
    protected $user;
    public function __construct(User $user){
        $this->user = $user;
        parent::__construct($user);
    }
    public function countUser(){
        return $this->user->count();
    }
    public function getUserPaginate(){
        return $this->user->paginate(10);
    }
    public function fillUser($request){
        $user = new User();
        $user->fill($request);
        $user->save();
    }
    public function updateUser($request, User $user){
        $user->fill($request);
        $user->save();
    }
    public function deleteUser(User $user){
        $user->delete();
    }
}