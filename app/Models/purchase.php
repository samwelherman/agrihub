<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchse extends Model
{
    use HasFactory;
    protected $table = "tbl_purchases";

    protected $fillable = ['reference_no','supplier_id','purchase_date','due_date','user_id','status','total'];
    
    public function user()
    {
        return $this->belongsTo('App\Models\user');
    }
    public function group()
    {
        return $this->belongsTo('App\Models\Group');
    }               
    public function land()
    {
        return $this->hasMany('App\Models\FarmLand');
    }
     public function farmer_account()
    {
        return $this->hasMany('App\Models\Farmer_account');
    }
}
