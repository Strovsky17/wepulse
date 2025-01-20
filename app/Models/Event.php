<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
        'who',
        'description',
        'obs',
        'next_event',
        'guatantee'
    ];

    protected $with = ['asset'];

    /***
     * Tranforms values
     */ 
    protected $casts = [
        'date' => 'datetime:Y-m-d',
        'next_event' => 'datetime:Y-m-d',
        'guatantee' => 'datetime:Y-m-d',
    ];

    /**
     * Asset
     */
    public function asset(): HasOne
    { 
        return $this->hasOne(Asset::class, 'id', 'asset_id');
    }
}
