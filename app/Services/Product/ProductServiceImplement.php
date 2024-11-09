<?php

namespace App\Services\Product;

use LaravelEasyRepository\Service;
use Illuminate\Support\Facades\Validator;
use App\Repositories\Product\ProductRepository;
use League\Csv\Reader;

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

    public function viewProduct(?int $page = null)
    {
      return $this->mainRepository->viewProduct($page);
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

    public function deleteProduct($id)
    {
      return $this->mainRepository->delete($id);
    }

    public function pagProduct(int $num)
    {
      return $this->mainRepository->pagProduct($num);
    }

    public function searchByName(string $name, array $categories = [])
    {
      return $this->mainRepository->searchByName($name, $categories);
    }

    public function filterCategory(int $id)
    {
      return $this->mainRepository->filterCategory($id);
    }

    public function importProduct($file)
    {
      // Load the CSV file
      $csv = Reader::createFromPath($file->getRealPath(), 'r');
      $csv->setHeaderOffset(0); // Treat the first row as header

      // Loop through CSV rows
      foreach ($csv as $row) {
          // Insert each row using the repository
          $data = [
            'category_id'   => $row['category_id'],  // Assuming you have a 'category_id' column in CSV
            'supplier_id'   => $row['supplier_id'],  // Assuming you have a 'supplier_id' column in CSV
            'name'          => $row['name'],         // Assuming your CSV has a 'name' column
            'sku'           => $row['sku'],          // Assuming your CSV has a 'sku' column
            'description'   => $row['description'] ?? null, // Nullable field, default to null if not provided
            'purchase_price'=> $row['purchase_price'],  // Assuming a 'purchase_price' column
            'selling_price' => $row['selling_price'],   // Assuming a 'selling_price' column
            'image'         => $row['image'] ?? null, // Nullable field for image path, default to null if not provided
        ];

        // Insert data using the repository
        $this->mainRepository->createProduct($data);
      }
    }
}
