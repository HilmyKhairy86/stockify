<?php

namespace App\Repositories\Category;

use LaravelEasyRepository\Repository;

interface CategoryRepository extends Repository{

    public function viewCategory();

    public function getCatbyId($id);
    
    public function createCategory(array $data);

    public function updateCategory($id, array $data);

    public function deleteCategory($id);

    public function pagCategory(int $num);

    public function searchByName(string $name);

}
