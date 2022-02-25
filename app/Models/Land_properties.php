<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Land_properties extends Model
{
    use HasFactory;
    protected $table = 'tbl_land_properties';

    protected $fillable = ['location','owner_id','reg_no','size','land_value','description','status'];
    
    public function owner()
    {
        return $this->belongsTo('App\Models\Farmer','owner_id');
    }
    public function farmer()
    {
        return $this->belongsTo('App\Models\Farmer','owner_id');
    }
    
     public function monitoring()
    {
        return $this->hasMany('App\Models\Crops_Monitoring','id');
    }
}