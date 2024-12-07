<?php

namespace App\Services\StockTransaction;

use LaravelEasyRepository\BaseService;

interface StockTransactionService extends BaseService{

    public function addTransaction(array $data);
    public function viewTransaction();
    public function updateTransaction($id, array $data);
    public function deleteTransaction($id);
    public function searchByName(string $name, string $date, array $types = [], array $status = []);
    public function masuk();
    public function keluar();
    public function FilterDateMasuk(string $input);
    public function FilterDateKeluar(string $input);
    public function TaskMasuk();
    public function TaskKeluar();
    public function FilterStock(string $day);
    public function stockOpname(string $name);
    public function stockCheck();
}
