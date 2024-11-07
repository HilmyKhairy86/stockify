<?php

namespace App\Repositories\Product;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Product;
use App\Models\ProductAttribute;

class ProductRepositoryImplement extends Eloquent implements ProductRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    public function viewProduct(?int $page = null){
        if ($page === null) {
            return $this->model->all();
        } else {
            return $this->model->paginate($page);
        }
    }

    public function getProdbyId($id){
        return $this->model->find($id);
    }

    public function createProduct(array $data){
        return Product::create($data);
    }

    public function updateProduct($id, array $data){
        $update = $this->model->findOrfail($id);
        $update->update($data);
    }

    public function deleteProduct($id){
        $product = $this->model->where('id', $id)->first();
        $product->delete();
    }

    public function pagProduct(int $num)
    {
        return $this->model->paginate($num);
    }

    public function searchByName(string $name)
    {
        return Product::where('name', 'LIKE', '%'.$name . '%');
    }

    public function filterCategory(int $id)
    {
        return Product::where('category_id', $id);
    }
}
