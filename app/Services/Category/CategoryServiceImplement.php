<?php

namespace App\Services\Category;

use LaravelEasyRepository\Service;
use Illuminate\Support\Facades\Validator;
use App\Repositories\Category\CategoryRepository;
use Illuminate\Support\Arr;

class CategoryServiceImplement extends Service implements CategoryService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;

    public function __construct(CategoryRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    public function addCategory(array $data)
    {
      $validator = Validator::make($data, [
        'name' => 'required|string|max:255',
      ]);

      if ($validator->fails()) {
        throw new \Illuminate\Validation\ValidationException($validator);
      } else {
        return $this->mainRepository->createCategory($data);
      }
    }
    
    public function viewCategory()
    {
      return $this->mainRepository->viewCategory();
    }

    public function updateCategory($id, array $data)
    {
      return $this->mainRepository->updateCategory($id, $data);
    }

    public function deleteCategory($id)
    {
      return $this->mainRepository->deleteCategory($id);
    }

    public function pagCategory(int $num)
    {
      return $this->mainRepository->pagCategory($num);
    }
}
