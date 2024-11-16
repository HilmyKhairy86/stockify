<?php

namespace App\Repositories\StockTransaction;

use App\Models\StockTransaction;
use Illuminate\Support\Facades\DB;
use LaravelEasyRepository\Implementations\Eloquent;

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

    public function searchByName(string $name, string $date, array $types = [], array $status = [])
    {
        $query = StockTransaction::join('products', 'stock_transactions.product_id', '=', 'products.id')
        ->join('users', 'stock_transactions.user_id', '=', 'users.id') // Join the users table
        ->where('products.name', 'like', '%' . $name . '%')
        ->select('stock_transactions.*', 'products.name as product_name', 'users.name as user_name') // Select user information
        ->orderBy('stock_transactions.id', 'desc');

        if (!empty($types)) {
            $query->whereIn('type', $types);
        }

        if (!empty($status)) {
            $query->whereIn('status', $status);
        }
        if (!empty($date)) {
            $query->whereDate('stock_transactions.date', $date);
        }

        return $query;
    }

    public function findMasukByDay($day)
    {
        return StockTransaction::where('date', $day)->where('type', 'masuk');
    }
    public function findKeluarByDay($day)
    {
        return StockTransaction::where('date', $day)->where('type', 'keluar');
    }
}