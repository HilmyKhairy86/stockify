<?php

namespace App\Repositories\ProductAttribute;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\ProductAttribute;

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
        return $this->model->delete($id);
    }
}
