<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;

    protected $connection = 'app';
    protected $table = 'events';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'asset_id',
        'date',
        'name',
        'description',
        'obs',
        'next_event',
        'guatantee'
    ];

    /***
     * Tranforms values
     */ 
    protected $casts = [
        
    ];
}
