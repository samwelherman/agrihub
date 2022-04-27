<?php

namespace App\Models\Payroll;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaryPayment extends Model
{
    use HasFactory;

    protected $table = "tbl_salary_payments";

    protected $fillable = ['salary_payment_id','user_id','payment_month','fine_deduction','payment_type','comments','payed_date','deduct_from']; 
}


