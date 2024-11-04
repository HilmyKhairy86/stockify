<?php

namespace App\Http\Controllers;

use App\Services\User\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function viewUsers()
    {
        $data = $this->userService->viewUsers();
        return view('Users.management',[
            'data' => $data,
        ]);
    }
}
