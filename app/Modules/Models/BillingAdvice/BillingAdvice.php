<?php

namespace App\Modules\Models\BillingAdvice;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillingAdvice extends Model
{
    use HasFactory;

    protected $table = "tbl_billing_advice";

    protected $fillable = [
        'joborder_id',
        'billing_advice_date'
    ];

}
