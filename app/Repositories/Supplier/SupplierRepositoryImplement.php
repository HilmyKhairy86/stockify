<?php

namespace App\Repositories\Supplier;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Supplier;

class SupplierRepositoryImplement extends Eloquent implements SupplierRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(Supplier $model)
    {
        $this->model = $model;
    }
    
    public function addSupplier(array $data)
    {
        return $this->model->create($data);
    } 

    public function viewSupplier()
    {
        return $this->model->all();
    }

    public function updateSupplier($id, array $data)
    {
        $update = $this->model->findOrfail($id);
        return $update->update($data);
    }

    public function deleteSupplier($id)
    {
        $sup = $this->model->find($id);
        return $sup->delete();
    }

    public function pagSupplier(int $num)
    {
        return $this->model->paginate($num);
    }
}
