<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppSettings extends Model
{
    protected $fillable = [
        'app_name',
        'logo',
    ];
    
    protected $table = 'app_settings';
}
