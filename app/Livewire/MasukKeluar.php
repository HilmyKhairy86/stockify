<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\StockTransaction\StockTransactionService;
use Livewire\WithPagination;

class MasukKeluar extends Component
{
    use WithPagination;
    protected $stockTransactionService;
    public function boot(StockTransactionService $stockTransactionService)
    {
        $this->stockTransactionService = $stockTransactionService;
    }

    public function render()
    {
        $masuk = $this->stockTransactionService->masuk()->where('status','pending')->paginate(10);
        $keluar = $this->stockTransactionService->keluar()->paginate(10);
        return view('livewire.masuk-keluar',[
            'masuk' => $masuk,
            'keluar' => $keluar,
        ]);
    }
}
