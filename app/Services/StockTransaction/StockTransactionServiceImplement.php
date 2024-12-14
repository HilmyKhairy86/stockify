<?php

namespace App\Services\StockTransaction;

use LaravelEasyRepository\ServiceApi;
use Illuminate\Support\Facades\Validator;
use App\Repositories\StockTransaction\StockTransactionRepository;

class StockTransactionServiceImplement extends ServiceApi implements StockTransactionService{

    /**
     * set title message api for CRUD
     * @param string $title
     * protected $title = "";
     */
     /**
     * uncomment this to override the default message
     * protected $create_message = "";
     * protected $update_message = "";
     * protected $delete_message = "";
     */

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;

    public function __construct(StockTransactionRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    public function addTransaction(array $data)
    {
      // $validator = Validator::make($data, [
      //   'product_id' => 'required|exists:products,id',
      //   'user_id' => 'required|exists:users,id',
      //   'type' => 'required|string|max:255',
      //   'quantity' => 'required|numeric|min:0',
      //   'date' => 'required|string|max:255',
      //   'notes' => 'required|string|max:255',
      // ]);

      // if ($validator->fails()) {
      //   throw new \Illuminate\Validation\ValidationException($validator);
      // } else {
        return $this->mainRepository->addTransaction($data);
      // }
    }

    public function viewTransaction()
    {
      return $this->mainRepository->viewTransaction();
    }

    public function updateTransaction($id, array $data)
    {
      return $this->mainRepository->updateTransaction($id,$data);
    }

    public function deleteTransaction($id)
    {
      return $this->mainRepository->deleteTransaction($id);
    }

    public function searchByName(string $name, string $date, array $types = [], array $status = [])
    {
      return $this->mainRepository->searchByName($name, $date, $types, $status);
    }

    public function masuk()
    {
      $day = today();
      return $this->mainRepository->findMasukByDay($day);
    }
    public function keluar()
    {
      $day = today();
      return $this->mainRepository->findKeluarByDay($day);
    }

    public function FilterDateMasuk(string $input)
    {
      return $this->mainRepository->FilterDateMasuk($input);
    }

    public function FilterDateKeluar(string $input)
    {
      return $this->mainRepository->FilterDateKeluar($input);
    }

    public function TaskMasuk()
    {
      return $this->mainRepository->TaskMasuk();
    }

    public function TaskKeluar()
    {
      return $this->mainRepository->TaskKeluar();
    }

    public function FilterStock(string $day)
    {
      return $this->mainRepository->FilterStock($day);
    }

    public function stockOpname(string $name)
    {
      return $this->mainRepository->stockOpname($name);
    }

    public function reportSearch(string $name,string $day, $cat_id)
    {
      return $this->mainRepository->reportSearch($name, $day, $cat_id);
    }
}
