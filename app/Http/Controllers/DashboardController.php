<?php

namespace App\Http\Controllers;

use App\Services\Product\ProductService;
use App\Services\StockTransaction\StockTransactionService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $stockTransactionService;
    protected $productService;
    public function __construct(StockTransactionService $stockTransactionService, ProductService $productService)
    {
        $this->stockTransactionService = $stockTransactionService;
        $this->productService = $productService;
    }

    public function managerdash()
    {
        return view('manager.dashboard');
    }
}
