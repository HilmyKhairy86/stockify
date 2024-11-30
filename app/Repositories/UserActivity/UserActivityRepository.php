<?php

namespace App\Repositories\UserActivity;

use LaravelEasyRepository\Repository;

interface UserActivityRepository extends Repository{

    public function createActivity(array $data);
    public function viewActivity();
}
