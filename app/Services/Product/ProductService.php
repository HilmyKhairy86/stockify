<?php

namespace App\Services\Product;

use LaravelEasyRepository\BaseService;

interface ProductService extends BaseService{

    public function addProduct(array $data);
    public function getProdbyId($id);
    public function viewProduct();
    public function updateProduct($id, array $data);
    public function updateStock($id, array $data);
    public function deleteProduct($id);
    public function searchByName(string $name, array $categories = []);
    public function filterCategory(int $id);
    public function importProduct($data, string $ext);
    public function stockfilter();
    public function stockOpname(string $name);
    public function startstockOpname($id, array $data);
}
