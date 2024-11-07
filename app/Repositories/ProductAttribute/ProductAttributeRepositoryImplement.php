<?php

namespace App\Repositories\ProductAttribute;

use App\Models\ProductAttribute;
use Illuminate\Support\Facades\DB;
use LaravelEasyRepository\Implementations\Eloquent;

class ProductAttributeRepositoryImplement extends Eloquent implements ProductAttributeRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(ProductAttribute $model)
    {
        $this->model = $model;
    }

    public function addAttribute(array $data)
    {
        return $this->model->create($data);
    }

    public function viewAttribute()
    {
        return $this->model->all();
    }

    public function updateAttribute($id, array $data)
    {
        $update = $this->model->findOrfail($id);
        return $update->update($data);
    }

    public function deleteAttribute($id)
    {
        $attribute = $this->model->find($id);
        return $attribute->delete();
    }

    public function pagAtrribute(int $num)
    {
        return $this->model->paginate($num);
    }

    public function searchByName(string $name)
    {
        return DB::table('product_attributes')
        ->join('products', 'product_attributes.product_id', '=', 'products.id')
        ->where('products.name', 'like', '%' . $name . '%')
        ->select('product_attributes.*', 'products.name as product_name')
        ->orderBy('product_attributes.id', 'desc');
    }

    public function getAttByProdId($id)
    {
        $this->model->where('product_id', $id);
    }

}
