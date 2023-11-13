<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;
    public function __construct(UserService $userService){
        $this->userService = $userService;
    }
    
    public function index()
    {
        $users = $this->userService->getUserPaginate();
        return view('admin.user.user', ['users' => $users]);
    }

    public function create()
    {
        return view('admin.user.add');
    }

    public function store(Request $request)
    {
        $this->userService->fillUser($request->all());
        return redirect()->route('user.index')->with('message', 'Add user successfully');
    }

    public function show(User $user)
    {
        //
    }

    public function edit(User $user)
    {
        return view('admin.user.edit', ['user' => $user]);
    }

    public function update(Request $request, User $user)
    {
        $this->userService->updateUser($request->all(), $user);
        return redirect()->route('user.index')->with('message', 'Update user successfully');
    }

    public function destroy(User $user)
    {
        $this->userService->deleteUser($user);
        return redirect()->route('user.index')->with('message', 'Delete user successfully');
    }
}
