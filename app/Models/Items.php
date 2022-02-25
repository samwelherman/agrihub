<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    //

    protected $table = 'items';


    protected $fillable = [
        'price',
        'name',
        'unit',
        'user_id',
    ];
    
}
