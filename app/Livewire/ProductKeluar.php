<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Services\StockTransaction\StockTransactionService;

class ProductKeluar extends Component
{
    use WithPagination;
    protected $stockTransactionService;
    public function boot(StockTransactionService $stockTransactionService)
    {
        $this->stockTransactionService = $stockTransactionService;
    }

    public function render()
    {
        $keluar = $this->stockTransactionService->keluar()->paginate(10);
        return view('livewire.product-keluar',[
            'keluar' => $keluar,
        ]);
    }
}
