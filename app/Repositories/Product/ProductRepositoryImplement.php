<?php

namespace App\Repositories\Product;

use App\Models\Product;
use App\Models\ProductAttribute;
use Illuminate\Support\Facades\DB;
use LaravelEasyRepository\Implementations\Eloquent;

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
        return $this->model->all();
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

    public function updateStock($id, array $data){
        $product = $this->model->findOrfail($id);
        switch ($data['status']) {
            case 'diterima':
                    $product->update([
                        'stock' => $product->stock + $data['quantity'],
                    ]);
                break;
            
            case 'ditolak':
                    
                break;
            
            case 'dikeluarkan':
                    $product->update([
                        'stock' => $product->stock - $data['quantity'],
                    ]);
                break;
            
            default:
                # code...
                break;
        }
    }

    public function deleteProduct($id){
        $product = $this->model->where('id', $id)->first();
        $product->delete();
    }

    // public function pagProduct(int $num)
    // {
    //     return $this->model->paginate($num);
    // }

    public function searchByName(string $name, array $categories = [])
    {
        $query = Product::query();
    
        // Filter by name
        if (!empty($name)) {
            $query->where('name', 'LIKE', '%' . $name . '%');
        }

        // Filter by category
        if (!empty($categories)) {
            $query->where('category_id', $categories); // Assuming 'category_id' is a column in your Product model
        }

        return $query;
    }

    public function filterCategory(int $id)
    {
        return Product::where('category_id', $id);
    }

    public function findProductBySku($sku)
    {
        return Product::where('sku', $sku);
    }

    public function stockfilter()
    {
        return Product::wherecolumn('stock', '<', 'stock_minimum');
    }

    public function stockOpname(string $name)
    {
        $product = Product::leftJoin('stock_transactions', function ($join) {
            $join->on('products.id', '=', 'stock_transactions.product_id')
                 ->whereBetween(DB::raw('DATE(stock_transactions.date)'), [now()->startOfWeek(), now()->endOfWeek()]);
        })
        ->select(
            'products.id AS id',
            'products.name',
            'products.sku',
            'products.stock',
            'products.stock_fisik',
            'products.last_edit_stock AS last',
            DB::raw('COALESCE(SUM(stock_transactions.quantity), 0) AS stock_total')
        )
        ->where('products.name', 'like', '%' . $name . '%')
        ->groupBy('products.id','products.name', 'products.sku', 'products.stock', 'products.stock_fisik', 'products.last_edit_stock');
        return $product;
    }

    public function startstockOpname($id, array $data)
    {
        $update = $this->model->findOrfail($id);
        $update->update($data);
    }
}
