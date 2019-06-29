<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailItem extends Model
{
    protected $table = 'detail_item';

    protected $fillable = [
        'item_id', 'detail_id', 'value'
    ];
}
