<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public function ProductAttribute()
    {
        return $this->hasMany(ProductAttribute::class);
    }

    public function Supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function Category()
    {
        return $this->belongsTo(Category::class);
    }

    protected $fillable = [
        'category_id',
        'supplier_id',
        'name',
        'sku',
        'description',
        'purchase_price',
        'selling_price',
        'image',
    ];
}
