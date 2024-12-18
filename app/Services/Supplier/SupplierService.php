<?php

namespace App\Services\Supplier;

use LaravelEasyRepository\BaseService;

interface SupplierService extends BaseService{

    public function addSupplier(array $data);
    public function viewSupplier();
    public function updateSupplier($id, array $data);
    public function deleteSupplier($id);
    public function pagSupplier(int $num);
    public function searchByName(string $name);
    
}
