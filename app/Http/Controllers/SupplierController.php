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
        $data = $request->except('_token');

        $this->supplierService->addSupplier($data);
    }

    public function viewSupplier()
    {
        $data = $this->supplierService->all();
        return view('suppliers.suppliers',[
            'data' => $data,
            'title' => 'Suppliers',
        ]);
    }
}
