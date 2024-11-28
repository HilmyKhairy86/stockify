<?php

namespace App\Http\Controllers;

use App\Services\Product\ProductService;
use App\Services\StockTransaction\StockTransactionService;
use Illuminate\Http\Request;

class StockTransactionController extends Controller
{
    protected $stocktransactionService;
    protected $productService;
    public function __construct(StockTransactionService $stockTransactionService, ProductService $productService)
    {
        $this->stocktransactionService = $stockTransactionService;
        $this->productService = $productService;
    }

    public function addTransaction(Request $request)
    {
        $data = $request->all();
        $this->stocktransactionService->addTransaction($data);
        return redirect()->back()->with('success','Action was successful!');
    }

    public function updateTransaction($id, Request $request)
    {
        $data = $request->all();
        $prod = $this->productService->getProdbyId($request->product_id);
        $i_stock = $prod->stock;
        $data['i_stock'] = $i_stock;

            $this->stocktransactionService->updateTransaction($id, $data);
            $this->productService->updateStock($request->product_id, $data);
            return redirect()->route('staff.sHistory');
    }

    public function deleteTransaction($id)
    {
        $this->stocktransactionService->deleteTransaction($id);
    }
}
