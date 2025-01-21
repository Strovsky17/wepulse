<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Alert extends Model
{
    use SoftDeletes;

    protected $connection = 'app';
    protected $table = 'alerts';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'asset_id',
        'date',
        'status',
        'description',
        'obs'
    ];

    /***
     * Tranforms values
     */ 
    protected $casts = [
        'data' => 'array',
        'required' => 'boolean',
    ];

    protected $with = ['asset'];

    /**
     * Asset
     */
    public function asset(): HasOne
    { 
        return $this->hasOne(Asset::class, 'id', 'asset_id');
    }
}
