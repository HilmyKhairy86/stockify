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
        $day = today();
        $masuk = $this->stockTransactionService->masuk($day)->paginate(10);
        $keluar = $this->stockTransactionService->keluar($day)->paginate(10);
        return view('livewire.keluar-masuk-report',[
            'masuk' => $masuk,
            'keluar' => $keluar,
        ]);
    }
}
