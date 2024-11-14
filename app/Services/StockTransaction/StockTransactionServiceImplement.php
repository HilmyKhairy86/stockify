<?php

namespace App\Services\StockTransaction;

use LaravelEasyRepository\ServiceApi;
use Illuminate\Support\Facades\Validator;
use App\Repositories\StockTransaction\StockTransactionRepository;

class StockTransactionServiceImplement extends ServiceApi implements StockTransactionService{

    /**
     * set title message api for CRUD
     * @param string $title
     */
     protected $title = "";
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

    public function searchByName(string $name, array $types = [], array $status = [])
    {
      return $this->mainRepository->searchByName($name, $types, $status);
    }
}
