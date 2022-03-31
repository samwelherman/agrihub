<?php

namespace App\Models\Tyre;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TyreReallocation extends Model
{
    use HasFactory;

    protected $table = "tyre_reallocations";

    protected $fillable = [
         'date',      
       'tyre_id',
        'staff',   
        'source_truck',  
       'destination_truck',            
        'status', 
        'added_by'];
    
    public function user()
    {
        return $this->belongsTo('App\Models\user');
    }

    public function tyre_staff(){

        return $this->belongsTo('App\Models\FieldStaff','staff');
      }
    
      public function s_truck(){
          return $this->belongsTo('App\Models\Truck','source_truck');
      }
      public function d_truck(){
        return $this->belongsTo('App\Models\Truck','destination_truck');
    }
      public function tyre_no(){
        return $this->belongsTo('App\Models\Tyre\Tyre','tyre_id');
    }
}
