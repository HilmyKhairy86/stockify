<?php

namespace App\Repositories\ProductAttribute;

use LaravelEasyRepository\Repository;

interface ProductAttributeRepository extends Repository{

    public function addAttribute(array $data);
    public function viewAttribute();
    public function updateAttribute($id, array $data);
    public function deleteAttribute($id);
    public function pagAtrribute(int $num);
}
