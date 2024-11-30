<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserActivity extends Model
{
    public function User()
    {
        return $this->belongsTo(User::class);
    }
    
    protected $fillable = [
        'user_id',
        'kegiatan',
        'tanggal',
    ];

    protected $table = 'user_activity';
}
