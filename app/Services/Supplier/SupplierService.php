<?php

namespace App\Services\Supplier;

use LaravelEasyRepository\BaseService;

interface SupplierService extends BaseService{

    public function addSupplier($data);
    public function viewSupplier();
    public function updateSupplier($id, array $data);
    public function deleteSupplier($id);
}
