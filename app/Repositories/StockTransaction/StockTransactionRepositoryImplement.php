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
        return StockTransaction::all();
    }

    public function updateTransaction($id, array $data)
    {
        $update = $this->model->findOrfail($id);
        return $update->update($data);
    }

    public function deleteTransaction($id)
    {
        return $this->model->delete($id);
    }

    public function FilterDateMasuk(string $input)
    {
        $query = StockTransaction::query()->where('type','masuk');
        switch ($input) {
            case 'day':
                $query->whereDate('date', today());
                break;

            case 'week':
                $query->whereBetween('date', [now()->startOfWeek(), now()->endOfWeek()]);
                break;

            case 'month':
                $query->whereMonth('date', now()->month);
                break;

            case 'year':
                $query->whereYear('date', now()->year);
                break;
            case 'all':
            default:
                // No filter applied; get all records
                break;
        }

        return $query->get();
    }

    public function FilterDateKeluar(string $input)
    {
        $query = StockTransaction::query()->where('type','keluar');
        switch ($input) {
            case 'day':
                $query->whereDate('date', today());
                break;

            case 'week':
                $query->whereBetween('date', [now()->startOfWeek(), now()->endOfWeek()]);
                break;

            case 'month':
                $query->whereMonth('date', now()->month);
                break;

            case 'year':
                $query->whereYear('date', now()->year);
                break;
            case 'all':

            default:
                // No filter applied; get all records
                break;
        }

        return $query->get();
    }

    public function searchByName(string $name, string $date, array $types = [], array $status = [])
    {
        $query = StockTransaction::with(['product', 'user']) // Load related Product and User data
        ->when(!empty($name), function ($q) use ($name) {
            $q->whereHas('product', function ($query) use ($name) {
                $query->where('name', 'like', '%' . $name . '%');
            });
        })
        ->when(!empty($types), function ($q) use ($types) {
            $q->whereIn('type', $types);
        })
        ->when(!empty($status), function ($q) use ($status) {
            $q->whereIn('status', $status);
        })
        ->when(!empty($date), function ($q) use ($date) {
            $q->whereDate('date', $date);
        })
        ->orderBy('id', 'desc');
        
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

    public function TaskMasuk()
    {
        $today = today();
        return StockTransaction::where('date',$today)->where('type','masuk')->where('status','pending');
    }

    public function TaskKeluar()
    {
        $today = today();
        return StockTransaction::where('date',$today)->where('type','keluar')->where('status','pending');
    }

    public function FilterStock(string $day){
        $query = StockTransaction::query();
        // $day = 'week';
        switch ($day) {
            case 'day':
                $query->whereDate('date', today());
                break;
            case 'week':
                $query->whereBetween('date', [now()->startOfWeek(), now()->endOfWeek()]);
                break;

            case 'month':
                $query->whereMonth('date', now()->month);
                break;

            case 'year':
                $query->whereYear('date', now()->year);
                break;
            case 'all':
                break;
            default:
                // No filter applied; get all records
                break;
        }

        return $query->get();
    }

    public function stockOpname(string $name)
    {
        $query = StockTransaction::join('products', 'stock_transactions.product_id', '=', 'products.id')
        ->select('stock_transactions.product_id', 'stock_fisik', 'sku', 'products.name', DB::raw('SUM(stock_transactions.quantity) as stock_total'))
        ->where('type','keluar')
        ->where('name', 'like', '%' . $name . '%')
        ->whereBetween('date', [now()->startOfWeek(), now()->endOfWeek()])
        ->groupBy('stock_transactions.product_id', 'products.name', 'sku', 'stock_fisik');
        return $query;
    }
}