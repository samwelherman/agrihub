<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoodReturn extends Model
{
    use HasFactory;

    protected $table = "good_returns";

    protected $fillable = [
         'date',
        'staff',   
        'location',  
        'truck',  
        'added_by'];
    
    public function user()
    {
        return $this->belongsTo('App\Models\user');
    }
}
