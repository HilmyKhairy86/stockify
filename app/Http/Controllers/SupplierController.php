<?php

namespace App\Http\Controllers;

use App\Services\Supplier\SupplierService;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    private $supplierService;
    public function __construct(SupplierService $supplierService)
    {
        $this->supplierService = $supplierService;
    }

    public function addSupplier(Request $request)
    {
        $data = $request->all();
        $this->supplierService->addSupplier($data);
        return redirect()->back();
    }

    public function viewSupplier()
    {
        $data = $this->supplierService->all();
        return view('suppliers.suppliers',[
            'data' => $data,
            'title' => 'Suppliers',
        ]);
    }

    public function updateSupplier($id, Request $request)
    {
        $data = $request->all();
        $this->supplierService->updateSupplier($id, $data);
        return redirect()->back();
    }

    public function deleteSupplier($id)
    {
        $this->supplierService->deleteSupplier($id);
        return redirect()->back();
    }
}
