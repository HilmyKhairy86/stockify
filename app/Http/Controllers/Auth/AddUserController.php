<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\User\UserService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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

    public function checkmail(Request $request)
    {
        $mailcheck = $this->userService->checkmail($request->email);
        if ($mailcheck) {
            return response()->json(['status' => 'exists', 'message' => 'Email is already in use.']);
        }
    }

    public function addUser(Request $request)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => $request->password,
            'remember_token' => Str::random(60),
            
        ];
        $mailcheck = $this->userService->checkmail($request->email);
        if ($mailcheck) {
            return response()->json(['status' => 'exists', 'message' => 'Email is already in use.']);
        } else {
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
}
