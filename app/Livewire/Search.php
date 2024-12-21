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
    
    public function render()
    {   
        $suppliers = Cache::remember('suppliers', 3600, function () {
            return $this->supplierService->viewSupplier();
        });
        $categories = Cache::remember('categories', 3600, function () {
            return $this->categoryService->viewCategory();
        });
        
        $result = $this->productService->searchByName($this->search, $this->categories)->with(['category:id,name', 'supplier:id,name'])->paginate(10);
        return view('livewire.search', [
            'products' => $result,
            'sup' => $suppliers,
            'cat' => $categories,
        ]);
    }
}