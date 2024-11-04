<?php

namespace App\Livewire;

use App\Services\User\UserService;
use Livewire\Component;
use Livewire\WithPagination;

class Users extends Component
{
    use WithPagination;
    protected $userService;
    public function boot(UserService $userService)
    {
        $this->userService = $userService;
    }

    public $search = '';
    public function render()
    {
        $data = $this->userService->searchByName($this->search)->paginate(10);
        return view('livewire.users', [
            'usr' => $data,
        ]);
    }
}
