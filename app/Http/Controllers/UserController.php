<?php

namespace App\Http\Controllers;

use App\Services\UserActivity\UserActivityService;
use App\Services\User\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;
    protected $userActivityService;
    public function __construct(
        UserService $userService,
        UserActivityService $userActivityService
    ) {
        $this->userService = $userService;
        $this->userActivityService = $userActivityService;
    }

    // public function viewUsers()
    // {
    //     $data = $this->userService->viewUsers();
    //     return view("Users.management", [
    //         "data" => $data,
    //     ]);
    // }

    public function updateUser($id, Request $request)
    {
        $data = $request->all();
        $this->userService->updateUser($id, $data);
        $act = [
            "user_id" => Auth::user()?->id,
            "kegiatan" => "mengupdate user dengan id " . $id,
            "tanggal" => now(),
        ];
        $this->userActivityService->createActivity($act);
        return redirect()->back();
    }

    public function deleteUser($id)
    {
        $this->userService->deleteUser($id);
        return redirect()->back();
    }
}
