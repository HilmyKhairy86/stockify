<?php

namespace App\Services\UserActivity;

use LaravelEasyRepository\BaseService;

interface UserActivityService extends BaseService{

    public function createActivity(array $data);
    public function viewActivity();
}
