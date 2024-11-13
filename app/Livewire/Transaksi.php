<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Services\StockTransaction\StockTransactionService;

class Transaksi extends Component
{
    use WithPagination;
    protected $stocktransactionService;
    public function boot(StockTransactionService $stockTransactionService)
    {
        $this->stocktransactionService = $stockTransactionService;
    }

    public $search = '';
    public $types = [];
    public $status = [];

    public function updatingTypes()
    {
        $this->resetPage();
    }

    public function render()
    {
            $types = is_array($this->types) ? $this->types : [$this->types];

            if (in_array('all', $types)) {
                $types = []; // Clear the types filter to show all data
            }
            
            $status = is_array($this->status) ? $this->status : [$this->status];
            if (in_array('all', $status)) {
                $status = []; // Clear the types filter to show all data
            }


            $stock = $this->stocktransactionService->searchByName($this->search, $types, $status)->paginate(10);
            return view('livewire.transaksi',[
                'stock' => $stock,
            ]);  
    }
}
