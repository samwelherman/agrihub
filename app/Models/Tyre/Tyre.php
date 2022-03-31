<?php

namespace App\Models\Tyre;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tyre extends Model
{
    use HasFactory;

    protected $table = "tyres";

    protected $fillable = [
    'serial_no',
    'brand_id',
    'purchase_id',
    'purchase_date',
    'location',
    'truck_id',
    'status',  
    'added_by'];
    
    public function brand(){

        return $this->belongsTo('App\Models\Tyre\TyreBrand','brand_id');
      }
    
      public function  tyre_location(){
    
        return $this->belongsTo('App\Models\Location','location');
      }
    
      public function  truck(){
          return $this->belongsTo('App\Models\Truck','truck_id');
      }
    public function user()
    {
        return $this->belongsTo('App\Models\user');
    }
}
