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
}