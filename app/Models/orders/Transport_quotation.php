<?php

namespace App\Models\orders;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transport_quotation extends Model
{
    use HasFactory;

    protected $table = "tbl_transport_quotations";

    protected $fillable = ['crop_type','quantity','start_location','end_location','client_id','warehouse_id','amount','due_amount','tax','status','user_id'];

    public function quotation_cost(){

        return $this->hasMany('App\Models\orders\Quotation_cost','quotation_id');
    }

    public function crop_types(){

        return $this->belongsTo('App\Models\Crops_type','crop_type');
      }
    
      public function user(){
    
        return $this->belongsTo('App\Models\User','user_id');
      }
    
      public function warehouse(){
          return $this->belongsTo('App\Models\Warehouse','warehouse_id');
      }
}
