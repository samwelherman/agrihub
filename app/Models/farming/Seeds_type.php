<?php

namespace App\Models\farming;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seeds_type extends Model
{
    use HasFactory;

    protected $table="tbl_seed_types";

    protected $fillable = ['added_by','name','status'];
}
