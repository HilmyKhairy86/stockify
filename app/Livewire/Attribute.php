<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\Product\ProductService;
use App\Services\Attribute\AttributeService;
use Livewire\WithPagination;

class Attribute extends Component
{
    use WithPagination;
    protected $productService;
    protected $attributeService;
    public function boot(ProductService $productService, AttributeService $attributeService)
    {
        $this->productService = $productService;
        $this->attributeService = $attributeService;
    }

    public $search = '';

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
        $att = $this->attributeService->searchByName($this->search)->paginate(10);
        return view('livewire.attribute', [
            'att' => $att,
        ]);
    }
}
