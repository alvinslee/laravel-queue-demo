<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'name',
        'email',
        'status',
        'parameters',
        'file_path',
        'error_message',
        'completed_at'
    ];

    protected $casts = [
        'parameters' => 'array',
        'completed_at' => 'datetime'
    ];
}
