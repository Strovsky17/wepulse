<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Asset extends Model
{
    use SoftDeletes;

    protected $connection = 'app';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'category_id',
        'risk',
        'criticality',
        'data',
    ];

    /***
     * Tranforms values
     */ 
    protected $casts = [
        'data' => 'array'
    ];
}
