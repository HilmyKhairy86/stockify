<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\Product\ProductService;
use App\Services\Attribute\AttributeService;

class Attribute extends Component
{
    protected $productService;
    protected $attributeService;
    public function boot(ProductService $productService, AttributeService $attributeService)
    {
        $this->productService = $productService;
        $this->attributeService = $attributeService;
    }

    public $search = '';

    public function render()
    {
        $att = $this->productService->searchByName($this->search)->paginate(10);
        return view('livewire.attribute', [
            'att' => $att,
        ]);
    }
}
