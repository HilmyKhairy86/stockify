<?php

namespace App\Repositories\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use LaravelEasyRepository\Implementations\Eloquent;

class UserRepositoryImplement extends Eloquent implements UserRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */

    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function createUser(array $data)
    {
        return $this->model->create($data);
    }

    public function viewUsers()
    {
        $this->model->all();
    }

    public function updateUser($id, array $data)
    {
        $user = $this->model->where('id', $id)->first();
        $user->update($data);
        return $user;
    }

    public function deleteuser($id)
    {
        $user = $this->model->where('id', $id)->first();
        $user->delete();
    }

    public function searchByName(string $name)
    {
        return User::where('name', 'LIKE', '%' . $name . '%');
    }

    public function searchById($id)
    {
        return $this->model->find($id);
    }

    public function checkpassword($id, string $password)
    {
        $user = $this->model->where('id',$id);

        if (!$user) {
            return false; // User not found
        }

        return Hash::check($password, $user->password);
    }

    public function checkmail(string $email)
    {
        return User::where('email', $email)->exists();
    }
}
