<?php

namespace App\Repositories\StockTransaction;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\StockTransaction;

class StockTransactionRepositoryImplement extends Eloquent implements StockTransactionRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(StockTransaction $model)
    {
        return $this->model = $model;
    }

    public function addTransaction(array $data)
    {
        return $this->model->create($data);
    }

    public function viewTransaction()
    {
        return $this->model->all();
    }

    public function updateTransaction($id, array $data)
    {
        return $this->model->update($id,$data);
    }

    public function deleteTransaction($id)
    {
        return $this->model->delete($id);
    }

    public function searchByName(string $name)
    {
        return StockTransaction::where('type', 'LIKE', '%' . $name . '%');
    }
}
