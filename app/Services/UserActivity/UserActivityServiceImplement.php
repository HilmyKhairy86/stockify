<?php

namespace App\Services\UserActivity;

use LaravelEasyRepository\ServiceApi;
use App\Repositories\UserActivity\UserActivityRepository;

class UserActivityServiceImplement extends ServiceApi implements UserActivityService{

    /**
     * set title message api for CRUD
     * @param string $title
     */
    //  protected $title = "";
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

    public function __construct(UserActivityRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    public function createActivity(array $data)
    {
      $this->mainRepository->createActivity($data);
    }
}
