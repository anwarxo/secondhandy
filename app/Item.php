<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
	    protected $fillable = [
        'name', 'price', 'image', 'description', 'seller_id', 'buyer_id', 'category_id', 'is_sold'
    ];

    public function category() {
        return $this->belongsTo('App\Category');
    }

    public function images() {
    	return $this->hasMany('App\Image');
    }
}
