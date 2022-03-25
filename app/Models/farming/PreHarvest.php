<?php

namespace App\Models\farming;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreHarvest extends Model
{
    use HasFactory;

    protected $table = "tbl_pre_harvests";

    protected $fillable = ['maturity_index','crop_type','seasson_id','non_rain_day','moisture_level','harvest_method'];

    public function seeds_type(){

        return $this->belongsTo('App\Models\farming\Seeds_type','seed_type');
    }

    public function crops_type(){

        return $this->belongsTo('App\Models\Crops_type','crop_type');
    }
}
