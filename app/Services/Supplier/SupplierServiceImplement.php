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

    public function addSupplier(array $data)
    {
      return $this->mainRepository->addSupplier($data);
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
}
