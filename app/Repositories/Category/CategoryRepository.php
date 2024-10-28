<?php

namespace App\Repositories\Category;

use LaravelEasyRepository\Repository;

interface CategoryRepository extends Repository{

    public function getAllCategory();

    public function getCategorybyId($id);
    
    public function createCategory(array $data);

    public function updateCategory($id, array $data);

    public function deleteCategory($id);

}
