<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Product\ProductService;
use Illuminate\Support\Facades\Response;

class ImportControlller extends Controller
{

    protected $productService;
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,xls,xlsx|max:2048',
        ]);

        $this->productService->importProduct($request->file('file'));

        // Redirect with a success message
        return redirect()->back()->with('success', 'Products imported successfully!');
    }

    public function export()
    {
        $products = $this->productService->viewProduct();
        $csvFileName = 'Product-' . now()->format('Y-m-d_H-i-s') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $csvFileName . '"',
        ];

        $handle = fopen('php://output', 'w');
        fputcsv($handle, ['category_id', 'supplier_id', 'name', 'sku', 'purchase_price', 'selling_price', 'description']); // Add more headers as needed

        foreach ($products as $product) {
            fputcsv($handle, [$product->category_id, $product->supplier_id, $product->name, $product->sku, $product->purchase_price, $product->selling_price, $product->description]); // Add more fields as needed
        }

        fclose($handle);

        return Response::make('', 200, $headers);
    }
}
