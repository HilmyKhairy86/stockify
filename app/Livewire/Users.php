<?php

namespace App\Livewire;

use App\Services\User\UserService;
use Livewire\Component;

class Users extends Component
{
    protected $userService;
    public function boot(UserService $userService)
    {
        $this->userService = $userService;
    }

    public $search = '';
    public function render()
    {
        $data = $this->userService->searchByName($this->search);
        return view('livewire.users', [
            'data' => $data,
        ]);
    }
}
