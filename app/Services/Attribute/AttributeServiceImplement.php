<?php

namespace App\Services\Attribute;

use LaravelEasyRepository\ServiceApi;
use App\Repositories\ProductAttribute\ProductAttributeRepository;
use Illuminate\Support\Facades\Validator;

class AttributeServiceImplement extends ServiceApi implements AttributeService{

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

    public function __construct(ProductAttributeRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    public function addAttribute(array $data)
    {
      $validator = Validator::make($data, [
        'product_id' => 'required|numeric',
        'name' => 'required|string|max:255',
        'value' => 'required|string|max:255',
      ]);

      if ($validator->fails()) {
        throw new \Illuminate\Validation\ValidationException($validator);
      } else {
        return $this->mainRepository->addAttribute($data);
      }
    }

    public function viewAttribute()
    {
      return $this->mainRepository->viewAttribute();
    }

    public function updateAttribute($id, $data)
    {
      return $this->mainRepository->updateAttribute($id, $data);
    }

    public function deleteAttribute($id)
    {
      return $this->mainRepository->deleteAttribute($id);
    }

    public function pagAtrribute(int $num)
    {
        return $this->mainRepository->pagAtrribute($num);
    }

    public function searchByName(string $name)
    {
      return $this->mainRepository->searchByName($name);
    }

    public function getAttByProdId($id)
    {
      return $this->mainRepository->getAttByProdId($id);
    }
}
