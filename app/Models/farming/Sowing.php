<?php

namespace App\Models\farming;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sowing extends Model
{
    use HasFactory;

    protected $table = "tbl_sowings";

    protected $fillable = ['qn','nh','cost','qheck','seed_type','crop_type','user_id'];
}
