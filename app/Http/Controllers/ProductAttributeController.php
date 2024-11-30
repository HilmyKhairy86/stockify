<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\Product\ProductService;
use App\Services\Attribute\AttributeService;
use App\Services\UserActivity\UserActivityService;

class ProductAttributeController extends Controller
{
    protected $attributeService;
    protected $productService;
    protected $userActivityService;
    public function __construct(AttributeService $attributeService, ProductService $productService, UserActivityService $userActivityService)
    {
        $this->attributeService = $attributeService;
        $this->productService = $productService;
        $this->userActivityService = $userActivityService;
    }

    public function addAttribute(Request $request)
    {
        $data = $request->all();
        $this->attributeService->addAttribute($data);
        $act = [
            'user_id' => Auth::user()?->id,
            'kegiatan' => 'menambahkan attribute produk '.$request->id.', nama : '.$request->name,
            'tanggal' => now(),
        ];
        $this->userActivityService->createActivity($act);
        return redirect()->back()->with('success','Action was successful!');
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
        $act = [
            'user_id' => Auth::user()?->id,
            'kegiatan' => 'mengubah attribute untuk id '.$request->id,
            'tanggal' => now(),
        ];
        $this->userActivityService->createActivity($act);
        return redirect()->back()->with('success','Action was successful!');
    }

    public function deleteAttribute($id)
    {
        $this->attributeService->deleteAttribute($id);
        $act = [
            'user_id' => Auth::user()?->id,
            'kegiatan' => 'menghapus attribute untuk id '.$id,
            'tanggal' => now(),
        ];
        $this->userActivityService->createActivity($act);
        return redirect()->back()->with('success','Action was successful!');
    }
}
