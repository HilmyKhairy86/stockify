<?php

namespace App\Services\Category;

use Illuminate\Http\Request;
use LaravelEasyRepository\BaseService;

interface CategoryService{

    public function addCategory(array $data); 
    public function viewCategory();
    public function updateCategory($id, array $data);
    public function deleteCategory($id);
    public function pagCategory(int $num);
    public function searchByName(string $name);
}
