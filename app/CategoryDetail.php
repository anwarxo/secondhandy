<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryDetail extends Model
{
    protected $table = 'category_detail';

    protected $fillable = [
        'category_id', 'detail_id'
    ];

}
