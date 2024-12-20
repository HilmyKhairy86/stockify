<?php

namespace App\Services\User;

use Illuminate\Http\Request;
use LaravelEasyRepository\BaseService;

interface UserService extends BaseService{

    public function viewUsers();

    public function addUser(array $data);

    public function updateUser($id, array $data);

    public function findUserById($id);

    public function deleteUser($id);

    public function searchByName(string $name);

    public function searchById($id);

    public function checkpassword($id, string $password);

    public function checkmail(string $email);
}
