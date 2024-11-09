<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Services\StockTransaction\StockTransactionService;

class Transaksi extends Component
{
    use WithPagination;
    protected $stocktransactionService;
    public function boot(StockTransactionService $stockTransactionService)
    {
        $this->stocktransactionService = $stockTransactionService;
    }

    public $search = '';
    public $types = [];
    public $status = [];
    public function render()
    {
        $stock = $this->stocktransactionService->searchByName($this->search, $this->types, $this->status)->paginate(10);
        return view('livewire.transaksi',[
            'stock' => $stock,
        ]);
    }
}
