<?php

namespace App\Models\farming;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seasson extends Model
{
    use HasFactory;
    protected $table = "tbl_seassons";

    protected $fillable = ['seasson_name','start_date','harvest_date','crop_name','user_id','status'];
    
    
}
