<?php

namespace App\Services\Supplier;

use LaravelEasyRepository\Service;
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

    public function addSupplier($data)
    {

      return $this->mainRepository->create($data);
    }

    public function viewSupplier()
    {
      return $this->mainRepository->all();
    }
    
    public function updateSupplier($id, array $data)
    {
      return $this->mainRepository->update($id,$data);
    }
    
    public function deleteSupplier($id)
    {
      return $this->mainRepository->delete($id);
    }
}
