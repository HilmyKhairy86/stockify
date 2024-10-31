<?php

namespace App\Livewire;

use App\Services\Category\CategoryService;
use App\Services\Supplier\SupplierService;
use Livewire\Component;

class CategorySelect extends Component
{   
    protected $categoryService;
    protected $supplierService;
    public function boot(CategoryService $categoryService, SupplierService $supplierService)
    {
        $this->categoryService = $categoryService;
        $this->supplierService = $supplierService;
    }
    public $search = ''; // Search term
    public $categories = []; // Dropdown items

    public function updatedSearch()
    {
        // Fetch categories based on search term
    }
    
    public function render()
    {
        $cat = $this->categoryService->viewCategory()
            ->take(10);
        return view('livewire.category-select', [
            'cat' => $cat,
        ]);
    }
}
