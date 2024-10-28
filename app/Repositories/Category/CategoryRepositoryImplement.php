<?php

namespace App\Repositories\Category;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Category;

class CategoryRepositoryImplement extends Eloquent implements CategoryRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(Category $model)
    {
        $this->model = $model;
    }

    public function getAllCategory()
    {
        return $this->model->all();
    }

    public function getCategorybyId($id)
    {
        return $this->model->where('id', $id)->first();
    }

    public function createCategory(array $data)
    {
        return $this->model->create($data);
    }

    public function updateCategory($id, array $data)
    {
        $category = $this->model->findOrfail($id);
        $category->update($data);
    }

    public function deleteCategory($id)
    {
        $user = $this->model->where('id', $id)->first();
        $user->delete();
    }
}
