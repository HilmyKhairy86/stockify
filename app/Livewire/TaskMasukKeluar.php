<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Services\StockTransaction\StockTransactionService;

class TaskMasukKeluar extends Component
{
    use WithPagination;
    protected $stockTransactionService;
    public function boot(StockTransactionService $stockTransactionService)
    {
        $this->stockTransactionService = $stockTransactionService;
    }

    public function render()
    {
        $masuk = $this->stockTransactionService->TaskMasuk()->get();
        $keluar = $this->stockTransactionService->TaskKeluar()->get();
        return view('livewire.task-masuk-keluar',[
            'masuk' => $masuk,
            'keluar' => $keluar,
        ]);
    }
}
