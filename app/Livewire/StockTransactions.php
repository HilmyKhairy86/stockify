<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use App\Services\StockTransaction\StockTransactionService;

class StockTransactions extends Component
{
    use WithPagination, WithoutUrlPagination; 
    protected $stocktransactionService;
    public function boot(StockTransactionService $stockTransactionService)
    {
        $this->stocktransactionService = $stockTransactionService;
    }

    public $search = '';

    public function updatingsearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $stock = $this->stocktransactionService->findByName($this->search)->paginate(10);
        return view('livewire.stock-transactions',[
            'stock' => $stock,
        ]);
    }
}
