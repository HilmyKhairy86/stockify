<?php

namespace App\Http\Controllers;

use App\Services\Attribute\AttributeService;
use App\Services\Product\ProductService;
use Illuminate\Http\Request;

class ProductAttributeController extends Controller
{
    protected $attributeService;
    protected $productService;
    public function __construct(AttributeService $attributeService, ProductService $productService)
    {
        $this->attributeService = $attributeService;
        $this->productService = $productService;
    }

    public function addAttribute(Request $request)
    {
        $data = $request->all();
        $this->attributeService->addAttribute($data);
        return redirect()->back()->with('success');
    }

    public function viewAttribute()
    {
        $data = $this->attributeService->pagAtrribute(10);
        $prod = $this->productService->viewProduct();
        return view('Products.attributes', [
            'data' => $data,
            'prod' => $prod,
        ]);
    }

    public function updateAttribute($id, Request $request)
    {
        $data = $request->all();
        $this->attributeService->updateAttribute($id, $data);
        return redirect()->back()->with('success');
    }

    public function deleteAttribute($id)
    {
        $this->attributeService->deleteAttribute($id);
        return redirect()->back();
    }
}
