<?php

namespace App\Services\AppSettings;

use LaravelEasyRepository\BaseService;

interface AppSettingsService extends BaseService{

    public function updateSettings(array $data);
}
