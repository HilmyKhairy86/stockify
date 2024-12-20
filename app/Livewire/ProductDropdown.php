<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use App\Services\Product\ProductService;

class ProductDropdown extends Component
{
    public $search = '';
    public $items = [];
    public $selectedItemId = null;
    protected $productService;
    public function boot(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function updatedSearch()
    {
        $this->items = $this->productService->searchByName($this->search)->get();
    }

    public function selectItem($itemId)
    {
        $this->selectedItemId = $itemId; // Store the selected item's ID
        $this->search = $this->productService->getProdbyId($itemId)->name; // Update the search box with the selected name
        $this->items = []; // Clear the dropdown list
    }

    public function render()
    {
        return view('livewire.product-dropdown');
    }
}
