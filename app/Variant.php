<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    /**
     * @var string
     * Table for Database
     */
    protected $table = 'Variant';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description','product_id'
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * Relationship One To Many / Many To One
     */
    public function product()
    {
        return $this->belongsTo('App\Product','product_id');
    }
}
