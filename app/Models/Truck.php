<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Truck extends Model
{
    use HasFactory;
    protected $table = "trucks";

    protected $fillable = ['truck_name','reg_no','driver','truck_type','capacity','driver_status','fuel','truck_status','tyre','staff','added_by'];
    
    public function user()
    {
        return $this->belongsTo('App\Models\user');
    }
          

    
}
