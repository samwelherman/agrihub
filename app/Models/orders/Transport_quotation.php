<?php

namespace App\Models\orders;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transport_quotation extends Model
{
    use HasFactory;

    protected $table = "tbl_transport_quotations";

    protected $fillable = ['crop_type','quantity','from','to','client_id','warehouse_id','amount','status','user_id'];

    public function quotation_cost(){

        return $this->hasMany('App\Models\orders\Quotation_cost','quotation_id');
    }
}
