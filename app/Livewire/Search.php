<?php

namespace App\Livewire;

use App\Services\Product\ProductService;
use App\Services\Category\CategoryService;
use App\Services\Supplier\SupplierService;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use Livewire\Component;
use Livewire\Livewire;

class Search extends Component
{

    use WithPagination, WithoutUrlPagination;

    protected $productService;
    protected $categoryService;
    protected $supplierService;

    public function boot(ProductService $productService, CategoryService $categoryService, SupplierService $supplierService)
    {
        $this->productService = $productService;
        $this->supplierService = $supplierService;
        $this->categoryService = $categoryService;
    }

    public $search = '';
    public $category = [];

    public function search()
    {
        $this->resetPage();
    }

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
        
            $result = $this->productService->searchByName($this->search);
            return view('livewire.search', [
                'products' => $result->paginate(10),
                'sup' => $this->supplierService->viewSupplier(),
                'cat' => $this->categoryService->viewCategory(),
            ]);

    }
}