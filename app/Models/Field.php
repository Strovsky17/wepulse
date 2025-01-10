<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    protected $connection = 'app';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'type',
        'description',
        'data',
        'required',
    ];

    /***
     * Tranforms values
     */ 
    protected $casts = [
        'data' => 'array',
        'required' => 'boolean',
    ];
}
