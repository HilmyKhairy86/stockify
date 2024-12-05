<?php

namespace App\Services\AppSettings;

use LaravelEasyRepository\ServiceApi;
use App\Repositories\AppSettings\AppSettingsRepository;

class AppSettingsServiceImplement extends ServiceApi implements AppSettingsService{

    /**
     * set title message api for CRUD
     * @param string $title
     */
    //  protected string $title = "";
     /**
     * uncomment this to override the default message
     * protected string $create_message = "";
     * protected string $update_message = "";
     * protected string $delete_message = "";
     */

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected AppSettingsRepository $mainRepository;

    public function __construct(AppSettingsRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    public function updateSettings(array $data)
    {
      if (isset($data['logo'])){
        $path = $data['logo']->store('images');
        $data['logo'] = $path;
        return $this->mainRepository->updateSettings($data);
      } else {
        return $this->mainRepository->updateSettings($data);
      }
    }
}
