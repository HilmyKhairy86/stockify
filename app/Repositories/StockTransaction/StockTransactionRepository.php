<?php

namespace App\Repositories\StockTransaction;

use LaravelEasyRepository\Repository;

interface StockTransactionRepository extends Repository{

    public function addTransaction(array $data);
    public function viewTransaction();
    public function updateTransaction($id, array $data);
    public function deleteTransaction($id);
    public function searchByName(string $name, array $types = [], array $status = []);
}
