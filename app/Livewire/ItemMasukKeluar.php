<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Services\StockTransaction\StockTransactionService;

class ItemMasukKeluar extends Component
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
        $keluar = $this->stockTransactionService->prodkeluar(today())->paginate(5);
        return view('livewire.item-masuk-keluar',[
            'masuk' => $masuk,
            'keluar' => $keluar,
        ]);
    }
}
