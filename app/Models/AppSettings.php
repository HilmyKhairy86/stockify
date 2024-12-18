<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AppSettings extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'app_name',
        'logo',
    ];
    
    protected $table = 'app_settings';
}
