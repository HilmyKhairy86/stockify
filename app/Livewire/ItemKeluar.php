<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Services\StockTransaction\StockTransactionService;

class ItemKeluar extends Component
{
    use WithPagination;
    protected $stockTransactionService;
    public function boot(StockTransactionService $stockTransactionService)
    {
        $this->stockTransactionService = $stockTransactionService;
    }
    
    public function render()
    {
        $keluar = $this->stockTransactionService->prodkeluar(today())->paginate(5);
        return view('livewire.item-keluar',[
            'keluar' => $keluar,
        ]);
    }
}
