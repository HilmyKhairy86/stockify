<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\Supplier\SupplierService;
use App\Services\UserActivity\UserActivityService;

class SupplierController extends Controller
{
    private $supplierService;
    protected $userActivityService;
    public function __construct(SupplierService $supplierService, UserActivityService $userActivityService)
    {
        $this->supplierService = $supplierService;
        $this->userActivityService = $userActivityService;
    }

    public function addSupplier(Request $request)
    {
        $data = $request->all();
        $this->supplierService->addSupplier($data);
        $act = [
            'user_id' => Auth::user()?->id,
            'kegiatan' => 'menambahkan supplier dengan nama '.$request->name,
            'tanggal' => now(),
        ];
        $this->userActivityService->createActivity($act);
        return redirect()->back()->with('success','Action was successful!');
    }

    public function viewSupplier()
    {
        $data = $this->supplierService->pagSupplier(10);
        return view('suppliers.suppliers',[
            'data' => $data,
            'title' => 'Suppliers',
        ]);
    }

    public function updateSupplier($id, Request $request)
    {
        $data = $request->all();
        $this->supplierService->updateSupplier($id, $data);
        $act = [
            'user_id' => Auth::user()?->id,
            'kegiatan' => 'mengubah supplier dengan id '.$id,
            'tanggal' => now(),
        ];
        $this->userActivityService->createActivity($act);
        return redirect()->back()->with('success','Action was successful!');
    }

    public function deleteSupplier($id)
    {
        $this->supplierService->deleteSupplier($id);
        $act = [
            'user_id' => Auth::user()?->id,
            'kegiatan' => 'menghapus supplier dengan id '.$id,
            'tanggal' => now(),
        ];
        $this->userActivityService->createActivity($act);
        return redirect()->back()->with('success','Action was successful!');
    }
}
