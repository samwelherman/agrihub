<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;
    protected $table = "tbl_warehouses";

    protected $fillable = ['id','warehouse_name','warehouse_owner','warehouse_manager','warehouse_location','manager_contact','insurance_id'];
    public function user()
    {
        return $this->belongsTo('App\Models\user');
    }
    public function insurance()
    {
        return $this->belongsTo('App\Models\Insurance');
    }
  
}