<?php

namespace App\Models\farming;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostHarvest extends Model
{
    use HasFactory;

    protected $table = "tbl_post_harvests";

    protected $fillable = ['maturity_index','crop_type','seasson_id','grade','moisture_level','distance','parking_type'];

    public function seeds_type(){

        return $this->belongsTo('App\Models\farming\Seeds_type','seed_type');
    }

    public function crops_type(){

        return $this->belongsTo('App\Models\Crops_type','crop_type');
    }

    public function parking_types(){

        return $this->belongsTo('App\Models\farming\ParkingType','parking_type');
    }
}
