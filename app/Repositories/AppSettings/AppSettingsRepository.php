<?php

namespace App\Repositories\AppSettings;

use LaravelEasyRepository\Repository;

interface AppSettingsRepository extends Repository{

    public function updateSettings(array $data);
}
