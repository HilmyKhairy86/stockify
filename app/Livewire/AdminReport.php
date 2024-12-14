<?php

namespace App\Livewire;

use App\Services\Category\CategoryService;
use Livewire\Component;
use Livewire\WithPagination;
use App\Services\StockTransaction\StockTransactionService;

class AdminReport extends Component
{
    use WithPagination;
    protected $stocktransactionService;
    protected $categoryService;
    public function boot(StockTransactionService $stockTransactionService, CategoryService $categoryService)
    {
        $this->stocktransactionService = $stockTransactionService;
        $this->categoryService = $categoryService;
    }

    public $search = '';
    public $date = '';
    public $cat = '';

    public function updatingTypes()
    {
        $this->resetPage();
    }
    public function updatingdate()
    {
        $this->resetPage();
    }
    public function updatingstatus()
    {
        $this->resetPage();
    }

    public function render()
    {
        $stock = $this->stocktransactionService->reportSearch($this->search, $this->date, $this->cat)->paginate(10);
        $cat = $this->categoryService->viewCategory();
        // dd($stock);
        return view('livewire.admin-report',[
            'stock' => $stock,
            'cat' => $cat,
        ]);
    }
}
