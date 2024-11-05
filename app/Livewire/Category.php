<?php

namespace App\Livewire;

use App\Services\Category\CategoryService;
use Livewire\Component;
use Livewire\WithPagination;

class Category extends Component
{
    use WithPagination;
    protected $categoryService;
    public function boot(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }
    
    public function render()
    {
        $cat = $this->categoryService->searchByName($this->search)->paginate(10);
        return view('livewire.category',[
            'cat' => $cat,
        ]);
    }
}
