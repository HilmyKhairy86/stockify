<?php

namespace App\Services\Product;

use LaravelEasyRepository\BaseService;

interface ProductService extends BaseService{

    public function addProduct(array $data);
    public function viewProduct();
    public function updateProduct($id, array $data);
    public function deleteProduct($id);
}
