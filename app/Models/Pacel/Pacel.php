<?php

namespace App\Models\Pacel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pacel extends Model
{
    use HasFactory;

    protected $table = "pacels";

    protected $fillable = [
    'pacel_name',
    'pacel_number',
    'date',
    'owner_id',
    'confirmation_number',
    'weight',
    'route_id',
    'receiver_name',
        'docs',
        'non_docs',
        'bags',
        'mobile',
      'currency_code',
        'exchange_rate',
        'amount',
        'tax',
        'due_amount',
        'discount',
        'instructions',
    'status',
    'good_receive',    
    'added_by'];
    
    public function user()
    {
        return $this->belongsTo('App\Models\user');
    }

    public function  route(){
    
        return $this->belongsTo('App\Models\Route','route_id');
      }

      public function  supplier(){
    
        return $this->belongsTo('App\Models\Supplier','owner_id');
      }
}
