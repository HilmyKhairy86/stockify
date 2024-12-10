<?php

namespace App\Services\User;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use LaravelEasyRepository\ServiceApi;
use Illuminate\Auth\Events\Registered;
use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class UserServiceImplement extends ServiceApi implements UserService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */

     protected $mainRepository;

    public function __construct(UserRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    public function viewUsers()
    {
        return $this->mainRepository->viewUsers();
    }

    public function addUser($data)
    {
      // $validator = Validator::make($data, [
      //   'name' => 'required|string|max:255',
      //   'supplier_id' => 'required|exists:users,email',
      //   'role' => 'required|string|max:255',
      //   'password' => 'required|string|max:255',
      // ]);

      // if ($validator->fails()) {
      //   throw new \Illuminate\Validation\ValidationException($validator);
      // } else {
      // }
      $user = [
        'name' => $data['name'],
        'email' => $data['email'],
        'role' => $data['role'],
        'password' => Hash::make($data['password']),
      ];

      return $this->mainRepository->createUser($user);
      // $data->validate([
      //   'name' => ['required', 'string', 'max:255'],
      //   'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
      //   'role' => ['required', 'string', 'max:255'],
      //   'password' => ['required', 'confirmed', Password::defaults()],
      // ]);
    }

    public function updateUser($id, array $data)
    {
        $this->mainRepository->update($id, $data);
    }

    public function findUserById($id)
    {
      $this->mainRepository->find($id);
    }

    public function deleteUser($id)
    {
      $this->mainRepository->deleteUser($id);
    }

    public function searchByName(string $name)
    {
        return $this->mainRepository->searchByName($name);
    }
}
