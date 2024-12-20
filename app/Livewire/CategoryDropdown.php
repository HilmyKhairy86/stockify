<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\Category\CategoryService;

class CategoryDropdown extends Component
{
    protected $categoryService;
    public function boot(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }
    public $search = '';
    public $items = [];
    public $selectedItemId = null;

    public function updatedSearch()
    {
        $this->items = $this->categoryService->searchByName($this->search)->get();
    }

    public function selectItem($itemId)
    {
        $this->selectedItemId = $itemId; // Store the selected item's ID
        $this->search = $this->categoryService->getCatbyId($itemId)->name; // Update the search box with the selected name
        $this->items = []; // Clear the dropdown list
    }

    public function render()
    {
        return view('livewire.category-dropdown');
    }
}
