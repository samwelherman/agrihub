<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;
    protected $table = "drivers";

    protected $fillable = ['driver_name','address','referee','experience','profile','added_by','driver_status'];
    
    public function user()
    {
        return $this->belongsTo('App\Models\user');
    }
}
