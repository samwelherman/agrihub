<?php

namespace App\Models\farming;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sowing extends Model
{
    use HasFactory;

    protected $table = "tbl_sowings";

    protected $fillable = ['qn','nh','seasson_id','cost','qheck','seed_type','harvest_date','crop_type','user_id'];

    public function seeds_type(){

        return $this->belongsTo('App\Models\farming\Seeds_type','seed_type');
    }

    public function crops_type(){

        return $this->belongsTo('App\Models\Crops_type','crop_type');
    }
}
