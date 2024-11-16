<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use App\Services\Product\ProductService;

class StockInfo extends Component
{
    use WithPagination, WithoutUrlPagination;

    protected $productService;

    public function boot(ProductService $productService)
    {
        $this->productService = $productService;
    }
    
    public function render()
    {
        $product = $this->productService->stockfilter()->paginate(5);
        return view('livewire.stock-info', [
            'product' => $product,
        ]);
    }
}
