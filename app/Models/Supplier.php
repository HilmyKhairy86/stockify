<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    public function Product()
    {
        return $this->hasMany(Product::class);
    }

    protected $fillable = [
        'name',
        'address',
        'phone',
        'email',
    ];

    protected $table = 'suppliers';
}
