<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\Product\ProductService;
use App\Services\Category\CategoryService;
use App\Services\UserActivity\UserActivityService;

class CategoryController extends Controller
{
    protected $categoryService;
    protected $productService;
    protected $userActivityService;
    public function __construct(CategoryService $categoryService, ProductService $productService, UserActivityService $userActivityService)
    {
        $this->categoryService = $categoryService;
        $this->productService = $productService;
        $this->userActivityService = $userActivityService;
    }

    public function addCategory(Request $request){
        $data = $request->all();
        $this->categoryService->addCategory($data);
        $act = [
            'user_id' => Auth::user()?->id,
            'kegiatan' => 'menambahkan kategori dengan nama '.$request->name,
            'tanggal' => now(),
        ];
        $this->userActivityService->createActivity($act);
        return redirect()->back()->with('success','Action was successful!');
    }

    public function viewCategories()
    {
        $data = $this->categoryService->pagCategory(10);
        return view('products.categories', [
            'data' => $data,
            'title' => 'Categories',
        ]);
    }

    public function updateCategory($id, Request $request)
    {
        $data = $request->all();
        $this->categoryService->updateCategory($id, $data);
        $act = [
            'user_id' => Auth::user()?->id,
            'kegiatan' => 'mengubah kategori dengan id '.$id,
            'tanggal' => now(),
        ];
        $this->userActivityService->createActivity($act);
        return redirect()->back()->with('success','Action was successful!');
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
        $act = [
            'user_id' => Auth::user()?->id,
            'kegiatan' => 'menghapus kategori dengan id '.$id,
            'tanggal' => now(),
        ];
        $this->userActivityService->createActivity($act);
        return redirect()->back()->with('success','Action was successful!');
    }
}
