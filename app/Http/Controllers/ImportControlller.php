<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Product\ProductService;
use Illuminate\Support\Facades\Response;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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
        fputcsv($handle, ['category_id', 'supplier_id', 'name', 'sku', 'stock', 'purchase_price', 'selling_price', 'description']); // Add more headers as needed

        foreach ($products as $product) {
            fputcsv($handle, [$product->category_id, $product->supplier_id, $product->name, $product->sku, $product->stock, $product->purchase_price, $product->selling_price, $product->description]); // Add more fields as needed
        }

        fclose($handle);

        return Response::make('', 200, $headers);
    }

    public function exportxls()
    {
        // Fetch products data
        $products = $this->productService->viewProduct();

        // Create new Spreadsheet object
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set header row
        $headers = ['Category ID', 'Supplier ID', 'Name', 'SKU', 'Stock', 'Purchase Price', 'Selling Price', 'Description'];
        $columnIndex = 'A'; // Start with column 'A'
        foreach ($headers as $header) {
            $sheet->setCellValue($columnIndex . '1', $header);
            $columnIndex++;
        }

        // Add data rows
        $rowNumber = 2; // Start from the second row
        foreach ($products as $product) {
            $sheet->setCellValue('A' . $rowNumber, $product->category_id);
            $sheet->setCellValue('B' . $rowNumber, $product->supplier_id);
            $sheet->setCellValue('C' . $rowNumber, $product->name);
            $sheet->setCellValue('D' . $rowNumber, $product->sku);
            $sheet->setCellValue('E' . $rowNumber, $product->stock);
            $sheet->setCellValue('F' . $rowNumber, $product->purchase_price);
            $sheet->setCellValue('G' . $rowNumber, $product->selling_price);
            $sheet->setCellValue('H' . $rowNumber, $product->description);
            $rowNumber++;
        }

        // Set headers for download
        $fileName = 'Product-' . now()->format('Y-m-d_H-i-s') . '.xlsx';
        $response = new Response();

        // Create writer and stream output
        $writer = new Xlsx($spreadsheet);
        ob_start();
        $writer->save('php://output');
        $excelOutput = ob_get_clean();

        return response($excelOutput)
        ->header('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet')
        ->header('Content-Disposition', 'attachment; filename="Product-' . now()->format('Y-m-d_H-i-s') . '.xlsx"')
        ->header('Cache-Control', 'max-age=0');
    }
}
