<?php

namespace App\Http\Controllers;

use App\Services\Category\CategoryService;
use App\Services\Product\ProductService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryService;
    protected $productService;

    public function __construct(CategoryService $categoryService, ProductService $productService)
    {
        $this->categoryService = $categoryService;
        $this->productService = $productService;
    }

    public function addCategory(Request $request){
        $data = $request->all();
        $this->categoryService->addCategory($data);
        return redirect()->back();
    }

    public function viewCategories()
    {
        $data = $this->categoryService->viewCategory();
        return view('products.categories', [
            'data' => $data,
            'title' => 'Categories',
        ]);
    }

    public function updateCategory($id, Request $request)
    {
        $data = $request->all();
        $this->categoryService->updateCategory($id, $data);
        return redirect()->back();
    }

    public function deleteCategory($id, Request $request)
    {
        $prodCheck = $this->productService->getProdbyId($id);
        if ($prodCheck) {
            $data = ['category_id' => null];
            $this->productService->update($id, $data);
            $this->categoryService->deleteCategory($id);
        } else {
            $this->categoryService->deleteCategory($id);
        }

        return redirect()->back();
    }
}
