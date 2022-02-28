<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'tbl_orders';
    protected $fillable = ['quantity','client_id','warehouse_id','offered_amount','start_location','end_location','route_type','status'];

}
