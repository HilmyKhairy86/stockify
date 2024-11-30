<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\Product\ProductService;
use App\Services\Category\CategoryService;
use App\Services\Supplier\SupplierService;
use App\Services\Attribute\AttributeService;
use App\Services\UserActivity\UserActivityService;

class ProductController extends Controller
{
    protected $productService;
    protected $categoryService;
    protected $supplierService;
    protected $attributeService;
    protected $userActivityService;

    public function __construct(ProductService $productService, CategoryService $categoryService, SupplierService $supplierService, AttributeService $attributeService, UserActivityService $userActivityService)
    {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
        $this->supplierService = $supplierService;
        $this->attributeService = $attributeService;
        $this->userActivityService = $userActivityService;
    }

    public function addProduct(Request $request)
    {
        $data = $request->all();
        $this->productService->addProduct($data);
        $act = [
            'user_id' => Auth::user()?->id,
            'kegiatan' => 'menambahkan produk dengan nama '.$request->name,
            'tanggal' => now(),
        ];
        $this->userActivityService->createActivity($act);
        return redirect()->back()->with('success','Action was successful!');
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
        $act = [
            'user_id' => Auth::user()?->id,
            'kegiatan' => 'mengubah produk dengan id : '.$id,
            'tanggal' => now(),
        ];
        $this->userActivityService->createActivity($act);
        return redirect()->back()->with('success','Action was successful!');
    }

    public function deleteProduct($id)
    {
        // $a_id = $this->attributeService->getAttByProdId($id);
        // $this->attributeService->deleteAttribute($a_id);
        $this->productService->deleteProduct($id);
        $act = [
            'user_id' => Auth::user()?->id,
            'kegiatan' => 'menghapus produk dengan id : '.$id,
            'tanggal' => now(),
        ];
        $this->userActivityService->createActivity($act);
        return redirect()->back()->with('success','Action was successful!');
    }

    public function searchProduct(Request $request){
        if($request->keyword != ''){
            $product = $this->productService->searchByName($request);
        }
        return response()->json($product);
    }

}
