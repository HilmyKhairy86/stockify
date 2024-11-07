<?php

namespace App\Http\Controllers;

use App\Services\Attribute\AttributeService;
use App\Services\Category\CategoryService;
use App\Services\Product\ProductService;
use App\Services\Supplier\SupplierService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;
    protected $categoryService;
    protected $supplierService;
    protected $attributeService;

    public function __construct(ProductService $productService, CategoryService $categoryService, SupplierService $supplierService, AttributeService $attributeService)
    {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
        $this->supplierService = $supplierService;
        $this->attributeService = $attributeService;
    }

    public function addProduct(Request $request)
    {
        $data = $request->all();
        $this->productService->addProduct($data);
        return redirect()->back()->with('success');
    }

    public function getAllCategories()
    {
        $data = $this->categoryService->viewCategory();
        return view('testing', compact('data'));
    }

    public function allProduct()
    {
        $cat = $this->categoryService->viewCategory();
        $supplier = $this->supplierService->viewSupplier();
        $data = $this->productService->viewProduct(10);
        return view('Products.products', [
            'data' => $data,
            'sup' => $supplier,
            'cat' => $cat, 
            'title' => 'Products',
        ]);
    }

    public function updateProduct($id, Request $request)
    {
        $data = $request->all();
        $this->productService->updateProduct($id,$data);
        return redirect()->back()->with('success');
    }

    public function deleteProduct($id)
    {
        // $a_id = $this->attributeService->getAttByProdId($id);
        // $this->attributeService->deleteAttribute($a_id);
        $this->productService->deleteProduct($id);
        return redirect()->back()->with('success');
    }

    public function searchProduct(Request $request){
        if($request->keyword != ''){
            $product = $this->productService->searchByName($request);
        }
        return response()->json($product);
    }

}
