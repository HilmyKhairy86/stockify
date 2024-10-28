<?php

namespace App\Repositories\Product;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Product;

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

    public function getAllProduct(){
        return $this->model->all();
    }

    public function getAllProductById($id){
        return $this->model->where('id',$id)->first();
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
}
