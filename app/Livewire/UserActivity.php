<?php

namespace App\Livewire;

use App\Services\UserActivity\UserActivityService;
use Livewire\Component;
use Livewire\WithPagination;

class UserActivity extends Component
{
    use WithPagination;
    protected $userActivityService;
    public function boot(UserActivityService $userActivityService)
    {
        $this->userActivityService = $userActivityService;
    }

    public function render()
    {
        $data = $this->userActivityService->viewActivity()->paginate(10);
        return view('livewire.user-activity',[
            'data' => $data
        ]);
    }
}
