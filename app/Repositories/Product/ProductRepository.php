<?php

namespace App\Repositories\Product;

use LaravelEasyRepository\Repository;

interface ProductRepository extends Repository{

    public function viewProduct();

    public function getProdbyId($id);

    public function createProduct(array $data);

    public function updateProduct($id, array $data);

    public function deleteProduct($id);
}
