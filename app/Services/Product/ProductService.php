<?php

namespace App\Services\Product;

use LaravelEasyRepository\BaseService;

interface ProductService extends BaseService{

    public function addProduct(array $data);
    public function getProdbyId($id);
    public function viewProduct(?int $page = null);
    public function updateProduct($id, array $data);
    public function deleteProduct($id);
    public function pagProduct(int $num);
    public function searchByName(string $keyword);
}
