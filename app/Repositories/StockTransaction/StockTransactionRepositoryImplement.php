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

    public function reportSearch(string $day, $cat_id)
    {
        $query = StockTransaction::query()->with(['product:id,name'])
        ->join('products', 'stock_transactions.product_id', '=', 'products.id')
        ->select(
            'stock_transactions.product_id as product_id',
            'products.name as product_name',
            'stock_transactions.user_id as user_id',
            'products.category_id as category_id',
            'stock_transactions.type as type',
            'stock_transactions.quantity as quantity',
            'stock_transactions.date as date',
            'stock_transactions.status as status'
        );
        if ($cat_id != ''){
            $query->where('category_id', $cat_id);
        }
        switch ($day) {
            case 'day':
                $query->whereDate('stock_transactions.date', today());
                break;
            case 'week':
                $query->whereBetween('stock_transactions.date', [now()->startOfWeek(), now()->endOfWeek()]);
                break;

            case 'month':
                $query->whereMonth('stock_transactions.date', now()->month);
                break;

            case 'year':
                $query->whereYear('stock_transactions.date', now()->year);
                break;
            case 'all':
                break;
            default:
                break;
        }
        return $query;
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
        return StockTransaction::where('date',today())->where('type','masuk')->where('status','=','pending');
    }

    public function TaskKeluar()
    {
        return StockTransaction::where('date',today())->where('type','keluar')->where('status','=','pending');
    }

    public function FilterStock(string $day){

        $results = DB::table('stock_transactions')
        ->join('products', 'stock_transactions.product_id', '=', 'products.id')
        ->selectRaw('products.name as pname, DATE(stock_transactions.date) as date, SUM(stock_transactions.quantity) as total')
        ->where('stock_transactions.status', 'diterima')
        ->where('stock_transactions.type', 'keluar')
        ->whereBetween('date', [now()->startOfWeek(), now()->endOfWeek()])
        ->groupBy('products.name', 'date')
        ->orderBy('date', 'asc');
        
        return $results->get();
    }

    public function stockOpname(string $name)
    {
        $query = StockTransaction::join('products', 'stock_transactions.product_id', '=', 'products.id')
        ->select('stock_transactions.product_id', 'stock', 'stock_fisik', 'sku', 'products.name', DB::raw('SUM(stock_transactions.quantity) as stock_total'))
        ->where('type','keluar')
        ->where('name', 'like', '%' . $name . '%')
        ->whereBetween('stock_transactions.date', [now()->startOfWeek(), now()->endOfWeek()])
        ->groupBy('stock_transactions.product_id', 'stock', 'products.name', 'sku', 'stock_fisik');
        return $query;
    }

    public function masuk()
    {
        return StockTransaction::where('type', 'masuk');
    }

    public function keluar()
    {
        return StockTransaction::where('type', 'keluar');
    }

    public function findByName(string $name)
    {
        $query = StockTransaction::with(['product', 'user'])
        ->when(!empty($name), function ($q) use ($name) {
            $q->whereHas('product', function ($query) use ($name) {
                $query->where('name', 'like', '%' . $name . '%');
            });
        });
        $query->where('status', 'pending')
        ->where('date', today())
        ->orderBy('id', 'desc');

        return $query;
    }

}
