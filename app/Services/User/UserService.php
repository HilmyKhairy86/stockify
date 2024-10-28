<?php

namespace App\Services\User;

use Illuminate\Http\Request;
use LaravelEasyRepository\BaseService;

interface UserService extends BaseService{

    public function getAllUsers();

    public function store($data);

    public function editUser(array $data);
}
