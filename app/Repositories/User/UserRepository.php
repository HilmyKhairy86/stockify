<?php

namespace App\Repositories\User;

use LaravelEasyRepository\Repository;

interface UserRepository extends Repository
{

    public function createUser(array $data);

    public function viewUsers();

    public function updateUser($id, array $data);

    public function deleteuser($id);

    public function searchByName(string $name);

    public function searchById($id);

    public function checkpassword(string $email, string $password);

    public function checkmail(string $email);
}
