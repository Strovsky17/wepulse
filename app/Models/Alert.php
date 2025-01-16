<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Alert extends Model
{
    use SoftDeletes;

    protected $connection = 'app';
    protected $table = 'alerts';

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
