<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Services\User\UserService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\UserActivity\UserActivityService;

class AddUserController extends Controller
{
    protected $userService;
    protected $userActivityService;
    public function __construct(UserService $userService, UserActivityService $userActivityService)
    {
        $this->userService = $userService;
        $this->userActivityService = $userActivityService;
    }

    public function addUser(Request $request)
    {
        $data = $request->all();
        $this->userService->addUser($data);
        $act = [
            "user_id" => Auth::user()?->id,
            "kegiatan" => "menambahkan user dengan nama ".$request->name,
            "tanggal" => now(),
        ];
        $this->userActivityService->createActivity($act);
        return redirect()->route('viewUsers')->with("success", "Action was successful!");
    }
}
