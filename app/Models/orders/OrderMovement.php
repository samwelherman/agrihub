<?php

namespace App\Models\orders;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderMovement extends Model
{
    use HasFactory;


    protected $table = "order_movements";

    protected $fillable = ['transport_id','crop_type','quantity','start_location','end_location','client_id','warehouse_id','amount','due_amount','tax','status','user_id','truck'];

    public function movement_quotation_cost(){

        return $this->hasMany('App\Models\orders\Quotation_cost','quotation_id');
    }

    public function  movement_crop_types(){

        return $this->belongsTo('App\Models\Crops_type','crop_type');
      }
    
      public function  movement_user(){
    
        return $this->belongsTo('App\Models\User','user_id');
      }
    
      public function  movement_warehouse(){
          return $this->belongsTo('App\Models\Warehouse','warehouse_id');
      }
}
