<?php

namespace App\Models\orders;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

  protected $table = "tbl_orders";
  protected $fillable = ['quantity','user_id','client_id','crop_type','warehouse_id','offered_amount','start_location','end_location','route_type','status'];

  public function crop_type(){

    return $this->belongsTo('App\Models\Crops_type','crop_type');
  }

  public function user(){

    return $this->belongsTo('App\Models\User','user_id');
  }

  public function warehouse(){
      return $this->belongsTo('App\Models\Warehouse','warehouse_id');
  }
}
