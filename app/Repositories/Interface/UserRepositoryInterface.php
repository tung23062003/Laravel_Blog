<?php
namespace App\Repositories\Interface;
use App\Models\User;


interface UserRepositoryInterface extends BaseRepositoryInterface{
    public function countUser();
    public function getUserPaginate();
    public function fillUser($request);
    public function updateUser($request, User $user);
    public function deleteUser(User $user);
}