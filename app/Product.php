<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    
    /**
     * @var string
     * Table for Database
     */
    protected $table = 'Product';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'price', 'description', 'category_id', 'slug'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * Relationship One To Many / Many To One
     */
    public function category()
    {
        return $this->belongsTo('App\Category','category_id');
    }

    /**
     * Relationship One to Many
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function variants()
    {
        return $this->hasMany('App/Variant');
    }
}
