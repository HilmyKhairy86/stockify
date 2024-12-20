<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use App\Services\Product\ProductService;
use App\Services\UserActivity\UserActivityService;
use App\Services\StockTransaction\StockTransactionService;

class StockTransactionController extends Controller
{
    protected $stocktransactionService;
    protected $productService;
    protected $userActivityService;
    public function __construct(
        StockTransactionService $stockTransactionService,
        ProductService $productService,
        UserActivityService $userActivityService
    ) {
        $this->stocktransactionService = $stockTransactionService;
        $this->productService = $productService;
        $this->userActivityService = $userActivityService;
    }

    public function addTransaction(Request $request)
    {
        $data = $request->all();
        $this->stocktransactionService->addTransaction($data);
        $act = [
            "user_id" => Auth::user()?->id,
            "kegiatan" =>
                "menambahkan transaksi dengan product id " .
                $request->product_id,
            "tanggal" => now(),
        ];
        $this->userActivityService->createActivity($act);
        return redirect()->back()->with("success", "Action was successful!");
    }

    public function updateTransaction($id, Request $request)
    {
        $data = $request->all();
        // $prod = $this->productService->getProdbyId($request->product_id);
        // $i_stock = $prod->stock;
        // $data["i_stock"] = $i_stock;
        $this->stocktransactionService->updateTransaction($id, $data);
        // $this->productService->updateStock($request->product_id, $data);
        $act = [
            "user_id" => Auth::user()?->id,
            "kegiatan" =>
                "mengkonfirmasi transaksi dengan product id " .
                $request->product_id,
            "tanggal" => now(),
        ];
        $this->userActivityService->createActivity($act);
        return redirect()->back()->with("success", "Action was successful!");
    }

    public function generatePDF()
    {
        $data = $this->stocktransactionService->viewTransaction();
        $pdf = Pdf::loadView("Export.transaksipdf", ["data" => $data]);
        $act = [
            "user_id" => Auth::user()?->id,
            "kegiatan" => "mengeksport laporan transaksi",
            "tanggal" => now(),
        ];
        $this->userActivityService->createActivity($act);
        return $pdf->download("laporan_transaksi_" . now());
    }

    public function generatePDFkel()
    {
        $masuk = $this->stocktransactionService->masuk()->get();
        $keluar = $this->stocktransactionService->keluar()->get();

        $pdf = Pdf::loadView("Export.keluarmasukpdf", ["masuk" => $masuk, 'keluar' => $keluar]);
        $act = [
            "user_id" => Auth::user()?->id,
            "kegiatan" => "mengeksport laporan keluar masuk",
            "tanggal" => now(),
        ];
        $this->userActivityService->createActivity($act);
        return $pdf->download("laporan_keluar_masuk_" . now());
    }

    public function deleteTransaction($id)
    {
        $this->stocktransactionService->deleteTransaction($id);
    }
}