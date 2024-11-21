<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Services\Product\ProductService;

class StockMinimum extends Component
{
    use WithPagination;

    protected $productService;
    protected $categoryService;
    protected $supplierService;

    public function boot(ProductService $productService)
    {
        $this->productService = $productService;
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
        $result = $this->productService->searchByName($this->search, $this->categories);
        return view('livewire.stock-minimum',[
            'products' => $result->paginate(10),
        ]);
    }
}
