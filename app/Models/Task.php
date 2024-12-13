<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    protected $fillable = [
        'title',
        'description',
        'assigned_to',
        'status',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'title'=>'string',
        'description'=>'string',
        'assigned_to'=>'integer',
    ];
    public function assignTo():BelongsTo
    {
        return $this->belongsTo(User::class,'assign_to');
    }
}
