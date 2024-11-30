<?php

namespace App\Services\Supplier;

use LaravelEasyRepository\Service;
use Illuminate\Support\Facades\Validator;
use App\Repositories\Supplier\SupplierRepository;

class SupplierServiceImplement extends Service implements SupplierService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;

    public function __construct(SupplierRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    public function addSupplier(array $data)
    {
      $validator = Validator::make($data, [
        'name' => 'required|string|max:255',
      ]);

      if ($validator->fails()) {
        throw new \Illuminate\Validation\ValidationException($validator);
      } else {
        return $this->mainRepository->addSupplier($data);
      }
    }

    public function viewSupplier()
    {
      return $this->mainRepository->viewSupplier();
    }
    
    public function updateSupplier($id, array $data)
    {
      return $this->mainRepository->updateSupplier($id,$data);
    }
    
    public function deleteSupplier($id)
    {
      
      return $this->mainRepository->deleteSupplier($id);
    }

    public function pagSupplier(int $num)
    {
      return $this->mainRepository->pagSupplier($num);
    }

    public function searchByName(string $name)
    {
      return $this->mainRepository->searchByName($name);
    }
}
