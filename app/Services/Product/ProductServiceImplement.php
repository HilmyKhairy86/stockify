<?php

namespace App\Services\Product;

use LaravelEasyRepository\Service;
use Illuminate\Support\Facades\Validator;
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

    public function searchByName(string $name)
    {
      return $this->mainRepository->searchByName($name);
    }
}
