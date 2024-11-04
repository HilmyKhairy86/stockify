<?php

namespace App\Services\User;

use App\Models\User;
use LaravelEasyRepository\ServiceApi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Repositories\User\UserRepository;
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
        return $this->mainRepository->all();
    }

    public function addUser($data)
    {
      $data->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
        'password' => ['required', 'confirmed', Password::defaults()],
      ]);

      $user = [
        'name' => $data->name,
        'email' => $data->email,
        'password' => Hash::make($data->password),
      ];

      $create = $this->mainRepository->createUser($user);

      event(new Registered($create));

      Auth::login($user);

    }

    public function editUser($id, array $data)
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
}
