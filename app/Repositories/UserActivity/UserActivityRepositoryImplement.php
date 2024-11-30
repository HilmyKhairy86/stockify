<?php

namespace App\Repositories\UserActivity;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\UserActivity;

class UserActivityRepositoryImplement extends Eloquent implements UserActivityRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(UserActivity $model)
    {
        $this->model = $model;
    }

    public function createActivity(array $data)
    {
        $this->model->create($data);
    }
}
