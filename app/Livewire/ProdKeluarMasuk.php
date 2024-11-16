<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\StockTransaction\StockTransactionService;

class ProdKeluarMasuk extends Component
{
    protected $stockTransactionService;
    public function boot(StockTransactionService $stockTransactionService)
    {
        $this->stockTransactionService = $stockTransactionService;
    }

    public $filtermasuk = 'day';
    public $filterkeluar = 'day';
    public function render()
    {
        $masuk = $this->stockTransactionService->FilterDateMasuk($this->filtermasuk)->count();
        $keluar = $this->stockTransactionService->FilterDateKeluar($this->filterkeluar)->count();
        // dd($masuk);
        return view('livewire.prod-keluar-masuk',[
            'masuk' => $masuk,
            'keluar' => $keluar,
        ]);
    }
}
