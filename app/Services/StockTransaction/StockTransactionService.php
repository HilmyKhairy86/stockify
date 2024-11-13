<?php

namespace App\Services\StockTransaction;

use LaravelEasyRepository\BaseService;

interface StockTransactionService extends BaseService{

    public function addTransaction(array $data);
    public function viewTransaction();
    public function updateTransaction($id, array $data);
    public function deleteTransaction($id);
    public function searchByName(string $name, array $types = [], array $status);
}
