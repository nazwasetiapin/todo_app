<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //
    protected $fillable = [
        'name',
        'status',
        'priority',
        'due_date',
    ];

    // tipe data
    protected $casts = [
        'status' => 'boolean',
        'due_date' => 'date',
    ];

    // default data
    protected $attributes = [
        'status' => false,
        'priority' => 3,
    ];
}