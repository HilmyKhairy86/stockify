<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Services\StockTransaction\StockTransactionService;

class KeluarMasukReport extends Component
{
    use WithPagination;
    protected $stockTransactionService;
    public function boot(StockTransactionService $stockTransactionService)
    {
        $this->stockTransactionService = $stockTransactionService;
    }

    public function render()
    {
        $masuk = $this->stockTransactionService->masuk()->paginate(10);
        $keluar = $this->stockTransactionService->keluar()->paginate(10);
        return view('livewire.keluar-masuk-report',[
            'masuk' => $masuk,
            'keluar' => $keluar,
        ]);
    }
}
