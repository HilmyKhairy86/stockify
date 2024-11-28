<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use App\Services\Product\ProductService;
use App\Services\Category\CategoryService;
use App\Services\Supplier\SupplierService;

class StockOpname extends Component
{
    use WithPagination, WithoutUrlPagination;

    protected $productService;
    protected $categoryService;
    protected $supplierService;

    public function boot(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public $search = '';

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
        $result = $this->productService->searchByName($this->search,);
        return view('livewire.stock-opname', [
            'products' => $result->paginate(10),
        ]);
    }
}