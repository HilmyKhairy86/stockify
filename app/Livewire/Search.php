<?php

namespace App\Livewire;

use Livewire\Livewire;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use Illuminate\Support\Facades\Cache;
use App\Services\Product\ProductService;
use App\Services\Category\CategoryService;
use App\Services\Supplier\SupplierService;

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
    public $categories = [];

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

    public function updatedCategories()
    {
        $this->resetPage();
    }
    
    public function render()
    {   
        $suppliers = Cache::remember('suppliers', 3600, function () {
            return $this->supplierService->viewSupplier();
        });
        $categories = Cache::remember('categories', 3600, function () {
            return $this->categoryService->viewCategory();
        });
        
        $result = $this->productService->searchByName($this->search, $this->categories);
        return view('livewire.search', [
            'products' => $result->paginate(10),
            'sup' => $this->supplierService->viewSupplier(),
            'cat' => $this->categoryService->viewCategory(),
        ]);
    }
}