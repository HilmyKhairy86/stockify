<?php

namespace App\Livewire;

use App\Services\Product\ProductService;
use App\Services\Category\CategoryService;
use App\Services\Supplier\SupplierService;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use Livewire\Component;

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

    public function search()
    {
        $this->resetPage('Products');
    }

    public function updatingSearch()
    {
        $this->resetPage('Products');
    }
    
    public function render()
    {   
        $products = $this->productService->searchByName($this->search)->paginate(10);
        return view('livewire.search', [
            'products' => $products,
            'sup' => $this->supplierService->viewSupplier(),
            'cat' => $this->categoryService->viewCategory(),
        ]);
    }
}