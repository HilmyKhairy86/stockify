<?php

namespace App\Services\Product;

use League\Csv\Reader;
use LaravelEasyRepository\Service;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Repositories\Product\ProductRepository;

class ProductServiceImplement extends Service implements ProductService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;

    public function __construct(ProductRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    public function addProduct(array $data)
    {
      $validator = Validator::make($data, [
        'name' => 'required|string|max:255',
        'supplier_id' => 'required|exists:suppliers,id',
        'category_id' => 'required|exists:categories,id',
        'sku' => 'required|string|max:255',
        'purchase_price' => 'required|numeric|min:0',
        'selling_price' => 'required|numeric|min:0',
      ]);

      if ($validator->fails()) {
        throw new \Illuminate\Validation\ValidationException($validator);
      } else {
        if (isset($data['image'])){
          $path = $data['image']->store('images');
          $data['image'] = $path;
          return $this->mainRepository->createProduct($data);
        } else {
          return $this->mainRepository->createProduct($data);
        }
      }
    }

    public function viewProduct()
    {
      return $this->mainRepository->viewProduct();
    }

    public function getProdbyId($id)
    {
      return $this->mainRepository->getProdbyId($id);
    }

    public function updateProduct($id, array $data)
    {
      // dd($data); 
      if (isset($data['image'])){
        $path = $data['image']->store('images');
        $data['image'] = $path;
        return $this->mainRepository->updateProduct($id, $data);
      } else {
        return $this->mainRepository->updateProduct($id, $data);
      }
      
    }

    public function updateStock($id, array $data)
    {
      return $this->mainRepository->updateStock($id, $data);
    }

    public function deleteProduct($id)
    {
      return $this->mainRepository->deleteProduct($id);
    }

    public function searchByName(string $name, array $categories = [])
    {
      return $this->mainRepository->searchByName($name, $categories);
    }

    public function filterCategory(int $id)
    {
      return $this->mainRepository->filterCategory($id);
    }

    // public function importProduct($file)
    // {
    //   // Load the CSV file
    //   $csv = Reader::createFromPath($file->getRealPath(), 'r');
    //   $csv->setHeaderOffset(0); // Treat the first row as header

    //   // Loop through CSV rows
    //   foreach ($csv as $row) {
    //     $existingProduct = $this->mainRepository->findProductBySku($row['sku']); // Assuming you have a method for this

    //     if ($existingProduct) {
    //         // If the product exists, skip to the next iteration
    //         continue;
    //     }
    //       // Insert each row using the repository
    //       $data = [
    //         'category_id'   => $row['category_id'] ?? null,  // Now optional, defaulting to null if not present
    //         'supplier_id'   => $row['supplier_id'] ?? null, // Assuming you have a 'supplier_id' column in CSV
    //         'name'          => $row['name'],         // Assuming your CSV has a 'name' column
    //         'sku'           => $row['sku'],          // Assuming your CSV has a 'sku' column
    //         'description'   => $row['description'] ?? null, // Nullable field, default to null if not provided
    //         'purchase_price'=> $row['purchase_price'],  // Assuming a 'purchase_price' column
    //         'selling_price' => $row['selling_price'],   // Assuming a 'selling_price' column
    //         'image'         => $row['image'] ?? null, // Nullable field for image path, default to null if not provided
    //     ];

    //     // Insert data using the repository
    //     $this->mainRepository->createProduct($data);
    //   }
    // }

    public function importProduct($file, string $ext)
    {
      $rows = [];
      if ($ext === 'csv' || $ext === 'txt') {
          $csv = Reader::createFromPath($file->getRealPath(), 'r');
          $csv->setHeaderOffset(0);
          $rows = iterator_to_array($csv->getRecords());
      } elseif (in_array($ext, ['xls', 'xlsx'])) {
          $spreadsheet = IOFactory::load($file->getRealPath());
          $sheet = $spreadsheet->getActiveSheet();
          $rows = $sheet->toArray();
  
          $headers = array_shift($rows);
          $rows = array_map(function ($row) use ($headers) {
              return array_combine($headers, $row);
          }, $rows);
      } else {
          throw new \Exception("Invalid file type. Please upload a CSV or Excel file.");
      }
  
      foreach ($rows as $row) {
          $sku = $row['sku'] ?? null;
  
          if (!$sku) {
              continue;
          }
  
          $existingProduct = $this->mainRepository->findProductBySku($sku);
  
          if ($existingProduct) {
              continue;
          }
  
          $data = [
              'category_id'    => $row['category_id'] ?? null,
              'supplier_id'    => $row['supplier_id'] ?? null,
              'name'           => $row['name'] ?? null,
              'sku'            => $sku,
              'stock'          => $row['stock'] ?? 0,
              'description'    => $row['description'] ?? null,
              'purchase_price' => $row['purchase_price'] ?? 0,
              'selling_price'  => $row['selling_price'] ?? 0,
              'image'          => $row['image'] ?? null,
          ];
          $this->mainRepository->createProduct($data);
      }
    }

    public function stockfilter()
    {
      return $this->mainRepository->stockfilter();
    }

    public function stockOpname(string $name)
    {
      return $this->mainRepository->stockOpname($name);
    }

    public function startstockOpname($id, array $data)
    {
      
      return $this->mainRepository->startstockOpname($id, $data);

    }

    

}
