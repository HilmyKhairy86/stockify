<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\Product\ProductService;

class Proddropdown extends Component
{

    protected $productService;

    public function boot(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public $search = '';

    public function search()
    {
        $this->resetPage();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }
    
    public function render()
    {   
            $result = $this->productService->searchByName($this->search);
            return view('livewire.proddropdown', [
                'prod' => $result,
            ]);

    }

    public function selectProduct($productId)
    {
        $this->emit('productSelected', $productId);
    }

    protected $listeners = ['productSelected'];

    public function productSelected($productId)
    {
        $this->product_id = $productId;
    }
}
