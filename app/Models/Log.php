<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $casts = [
        'old_data' => 'array',
        'new_data' => 'array',
    ];

}
