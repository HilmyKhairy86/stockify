<?php

namespace App\Livewire;

use App\Services\Product\ProductService;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use App\Services\StockTransaction\StockTransactionService;


class StockOpname extends Component
{
    use WithPagination, WithoutUrlPagination;

    protected $stockTransactionService;
    protected $productService;
    public function boot(StockTransactionService $stockTransactionService, ProductService $productService)
    {
        $this->stockTransactionService = $stockTransactionService;
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
        $result = $this->productService->stockOpname($this->search)->paginate(10);
        // dd($result);
        return view('livewire.stock-opname', [
            'products' => $result,
        ]);
    }
}