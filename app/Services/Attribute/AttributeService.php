<?php

namespace App\Services\Attribute;

use LaravelEasyRepository\BaseService;

interface AttributeService extends BaseService{

    public function addAttribute(array $data);
    public function viewAttribute();
    public function updateAttribute($id, $data);
    public function deleteAttribute($id);
}
