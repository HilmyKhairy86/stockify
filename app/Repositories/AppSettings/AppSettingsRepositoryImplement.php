<?php

namespace App\Repositories\AppSettings;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\AppSettings;

class AppSettingsRepositoryImplement extends Eloquent implements AppSettingsRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected AppSettings $model;

    public function __construct(AppSettings $model)
    {
        $this->model = $model;
    }

    public function updateSettings(array $data)
    {
        $update = $this->model->findOrfail(1);
        $update->update($data);
    }
}
