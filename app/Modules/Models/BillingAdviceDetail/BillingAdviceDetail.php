<?php

namespace App\Modules\Models\BillingAdviceDetail;

use App\Modules\Models\JobOrder\JobOrder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillingAdviceDetail extends Model
{
    use HasFactory;

    protected $table = "tbl_billing_advice_details";

    protected $fillable = [
        'product_id',
        'billingadvice_id',
        'description',
        'price',
        'type',
    ];

    
}
