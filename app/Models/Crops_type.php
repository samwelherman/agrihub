<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crops_type extends Model
{
    use HasFactory;
    protected $table = "tbl_crops_types";

    protected $fillable = ['crop_name','storage_type','status'];
    
    public function farmer_account()
    {
        return $this->hasMany('App\Models\Farmer_account','id');
    }

    public function order()
    {
        return $this->hasMany('App\Models\orders\Order','id');
    }
  
}