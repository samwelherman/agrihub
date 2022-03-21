<?php

namespace App\Models\orders;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $table = "activities";

    protected $fillable = [
    'transport_id',
    'date',
    'activity',
    'notes',   
    'added_by'];
    
   
    public function user(){
    
        return $this->belongsTo('App\Models\User','added_by');
      }

      public function transport(){
    
        return $this->belongsTo('App\Models\orders\Transport_quotation','transport_id');
      }
}
