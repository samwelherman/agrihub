<?php

namespace App\Models\Payroll;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaryPaymentDeduction extends Model
{
    use HasFactory;

    protected $table = "tbl_salary_payment_deduction";
}
