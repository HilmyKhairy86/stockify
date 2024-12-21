<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Services\StockTransaction\StockTransactionService;

class ItemMasuk extends Component
{
    use WithPagination;
    protected $stockTransactionService;
    public function boot(StockTransactionService $stockTransactionService)
    {
        $this->stockTransactionService = $stockTransactionService;
    }
    
    public function render()
    {
        $masuk = $this->stockTransactionService->prodmasuk(today())->paginate(5);
        return view('livewire.item-masuk',[
            'masuk' => $masuk,
        ]);
    }
}
