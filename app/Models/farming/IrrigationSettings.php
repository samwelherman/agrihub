<?php

namespace App\Models\farming;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IrrigationSettings extends Model
{
    use HasFactory;

    protected $table = "tbl_irrigation_settings";

    protected $fillable = ['irrigation_type','irrigation_cost','number_of_hk','power_source','pump_cost','pump_rate','hector_per_day','pump_no','total_pump_cost','added_by'];

}
