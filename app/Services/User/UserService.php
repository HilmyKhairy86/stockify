<?php

namespace App\Services\User;

use Illuminate\Http\Request;
use LaravelEasyRepository\BaseService;

interface UserService extends BaseService{

    public function viewUsers();

    public function addUser(array $data);

    public function editUser($id, array $data);

    public function findUserById($id);

    public function deleteUser($id);
}
