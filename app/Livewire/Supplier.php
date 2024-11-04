<?php

namespace App\Livewire;

use App\Services\Supplier\SupplierService;
use Livewire\Component;
use Livewire\WithPagination;

class Supplier extends Component
{

    use WithPagination;
    protected $supplierService;
    public function boot(SupplierService $supplierService)
    {
        $this->supplierService = $supplierService;
    }

    public $search = '';

    public function render()
    {
        $sup = $this->supplierService->searchByName($this->search)->paginate(10);
        return view('livewire.supplier',[
            'sup' => $sup,
        ]);
    }
}
