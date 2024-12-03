<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use App\Services\Product\ProductService;
use App\Services\Category\CategoryService;
use App\Services\StockTransaction\StockTransactionService;
use App\Services\Supplier\SupplierService;
use App\Services\UserActivity\UserActivityService;

class StockOpname extends Component
{
    use WithPagination, WithoutUrlPagination;

    protected $stockTransactionService;

    public function boot(StockTransactionService $stockTransactionService)
    {
        $this->stockTransactionService = $stockTransactionService;
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
        $result = $this->stockTransactionService->stockOpname($this->search)->paginate(10);
        // dd($result);
        return view('livewire.stock-opname', [
            'products' => $result,
        ]);
    }
}