<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Services\Product\ProductService;
use Illuminate\Support\Facades\Response;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Services\UserActivity\UserActivityService;

class ImportControlller extends Controller
{

    protected $productService;
    protected $userActivityService;
    public function __construct(ProductService $productService, UserActivityService $userActivityService)
    {
        $this->productService = $productService;
        $this->userActivityService = $userActivityService;
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt,xls,xlsx|max:2048',
        ]);

        $file = $request->file('file');
        
        $ext = $request->file('file')->extension();
        $this->productService->importProduct($file);
        if ($ext == 'txt' || $ext == 'csv') {
            $act = [
                'user_id' => Auth::user()?->id,
                'kegiatan' => 'mengimport produk menggunakan file csv',
                'tanggal' => now(),
            ];
        } else {
            $act = [
                'user_id' => Auth::user()?->id,
                'kegiatan' => 'mengimport produk menggunakan file xlsx',
                'tanggal' => now(),
            ];
        }
        $this->userActivityService->createActivity($act);
        return redirect()->back()->with('success', 'Products imported successfully!');
    }

    public function export()
    {
        // Fetch the product data
        $products = $this->productService->viewProduct();

        // Set CSV file name
        $csvFileName = 'Product-' . now()->format('Y-m-d_H-i_s') . '.csv';

        // Define the temporary file path
        $tempFilePath = storage_path('app/public/' . $csvFileName);

        // Open a file for writing
        $handle = fopen($tempFilePath, 'w');

        // Write the CSV header row
        fputcsv($handle, ['category_id', 'supplier_id', 'name', 'sku', 'stock', 'purchase_price', 'selling_price', 'description']); 

        // Write product data to CSV
        foreach ($products as $product) {
            fputcsv($handle, [
                $product->category_id, 
                $product->supplier_id, 
                $product->name, 
                $product->sku, 
                $product->stock, 
                $product->purchase_price, 
                $product->selling_price, 
                $product->description
            ]);
        }

        // Close the file handle
        fclose($handle);
        $act = [
            'user_id' => Auth::user()?->id,
            'kegiatan' => 'mengekspor produk dengan format csv',
            'tanggal' => now(),
        ];
        $this->userActivityService->createActivity($act);
        // Return the file as a download response
        return response()->download($tempFilePath)->deleteFileAfterSend(true);          
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
        // $fileName = 'Product-' . now()->format('Y-m-d_H-i-s') . '.xlsx';
        $response = new Response();

        // Create writer and stream output
        $writer = new Xlsx($spreadsheet);
        ob_start();
        $writer->save('php://output');
        $excelOutput = ob_get_clean();

        $act = [
            'user_id' => Auth::user()?->id,
            'kegiatan' => 'mengekspor produk dengan format xlsx',
            'tanggal' => now(),
        ];
        $this->userActivityService->createActivity($act);

        $response = response($excelOutput)
        ->header('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet')
        ->header('Content-Disposition', 'attachment; filename="Product-' . now()->format('Y-m-d_H-i-s') . '.xlsx"')
        ->header('Cache-Control', 'max-age=0');
        return $response;
    }
}
