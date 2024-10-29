<?php

namespace App\Repositories\Supplier;

use LaravelEasyRepository\Repository;

interface SupplierRepository extends Repository{

    public function addSupplier(array $data);
    public function viewSupplier();
    public function updateSupplier($id, array $data);
    public function deleteSupplier($id);
    public function pagSupplier(int $num);
}
