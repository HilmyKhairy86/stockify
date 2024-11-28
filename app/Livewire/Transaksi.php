<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use Illuminate\Support\Facades\Auth;
use App\Services\StockTransaction\StockTransactionService;

class Transaksi extends Component
{
    use WithPagination, WithoutUrlPagination; 
    protected $stocktransactionService;
    public function boot(StockTransactionService $stockTransactionService)
    {
        $this->stocktransactionService = $stockTransactionService;
    }

    public $search = '';
    public $date = '';
    public $types = [];
    public $status = [];

    public function updatingtypes()
    {
        $this->resetPage();
    }

    public function updatedtypes()
    {
        $this->resetPage();
    }

    public function updatingdate()
    {
        $this->resetPage();
    }

    public function updateddate()
    {
        $this->resetPage();
    }

    public function updatingstatus()
    {
        $this->resetPage();
    }

    public function updatedstatus()
    {
        $this->resetPage();
    }

    public function updatingsearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $types = is_array($this->types) ? $this->types : [$this->types];

        if (in_array('all', $types)) {
            $types = [];
        }

        $status = is_array($this->status) ? $this->status : [$this->status];

        if (in_array('all', $status)) {
            $status = [];
        }
            $stock = $this->stocktransactionService->searchByName($this->search, $this->date, $types, $status)->paginate(5);
            // dd($stock);
            return view('livewire.transaksi',[
                'stock' => $stock,
            ]);  
    }
}
