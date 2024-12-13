<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskLog extends Model
{
    protected $fillable = [
        'user_id',
        'action',
        'endpoint',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'user_id'=>'integer',
        'action'=>'string',
        'endpoint'=>'integer',
    ];
}
