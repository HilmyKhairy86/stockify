<?php

namespace App\Repositories\StockTransaction;

use LaravelEasyRepository\Repository;

interface StockTransactionRepository extends Repository{

    public function addTransaction(array $data);
    public function viewTransaction();
    public function updateTransaction($id, array $data);
    public function deleteTransaction($id);
    public function searchByName(string $name, string $date, array $types = [], array $status = []);
    public function findMasukByDay($day);
    public function findKeluarByDay($day);
    public function FilterDateMasuk(string $input);
    public function FilterDateKeluar(string $input);
}
