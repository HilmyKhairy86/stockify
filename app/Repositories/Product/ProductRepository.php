<?php

namespace App\Repositories\Product;

use LaravelEasyRepository\Repository;

interface ProductRepository extends Repository{

    public function viewProduct();

    public function getProdbyId($id);

    public function createProduct(array $data);

    public function updateProduct($id, array $data);

    public function updateStock($id, array $data);

    public function deleteProduct($id);
    
    public function searchByName(string $name, array $categories = []);

    public function filterCategory(int $id);

    public function findProductBySku($sku);

    public function stockfilter();

    public function stockOpname(string $name);

    public function startstockOpname($id, array $data);
}
