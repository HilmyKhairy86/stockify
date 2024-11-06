<?php

namespace App\Http\Controllers;

use App\Services\StockTransaction\StockTransactionService;
use Illuminate\Http\Request;

class StockTransactionController extends Controller
{
    protected $stocktransactionService;
    public function __construct(StockTransactionService $stockTransactionService)
    {
        $this->stocktransactionService = $stockTransactionService;
    }

    public function addTransaction(Request $request)
    {
        $data = $request->all();
        $this->stocktransactionService->addTransaction($data);
        return redirect()->back();
    }

    public function updateTransaction($id, Request $request)
    {
        $data = $request->all();
        $this->stocktransactionService->updateTransaction($id, $data);
    }

    public function deleteTransaction($id)
    {
        $this->stocktransactionService->deleteTransaction($id);
    }
}
