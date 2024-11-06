<?php

namespace App\Livewire;

use App\Services\StockTransaction\StockTransactionService;
use Livewire\Component;

class Transaksi extends Component
{
    protected $stocktransactionService;
    public function boot(StockTransactionService $stockTransactionService)
    {
        $this->stocktransactionService = $stockTransactionService;
    }

    public $search = '';
    public function render()
    {
        $stock = $this->stocktransactionService->viewTransaction();
        return view('livewire.transaksi',[
            'stock' => $stock,
        ]);
    }
}
