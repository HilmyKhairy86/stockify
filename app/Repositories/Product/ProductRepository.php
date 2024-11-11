<?php

namespace App\Repositories\Product;

use LaravelEasyRepository\Repository;

interface ProductRepository extends Repository{

    public function viewProduct(?int $page = null);

    public function getProdbyId($id);

    public function createProduct(array $data);

    public function updateProduct($id, array $data);

    public function deleteProduct($id);

    public function pagProduct(int $num);
    
    public function searchByName(string $name, array $categories = []);

    public function filterCategory(int $id);

    public function findProductBySku($sku);
}
