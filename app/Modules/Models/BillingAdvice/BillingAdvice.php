<?php

namespace App\Modules\Models\BillingAdvice;

use App\Modules\Models\DraftBill\DraftBill;
use App\Modules\Models\JobOrder\JobOrder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillingAdvice extends Model
{
    use HasFactory;

    protected $table = "tbl_billing_advice";

    protected $fillable = [
        'joborder_id',
        'billing_advice_date',
        'is_accepted',
        'is_draftbill',
        'remarks',
    ];

    public function joborder() {
        return $this->belongsTo(JobOrder::class);
    }

    public function draftbill() {
        return $this->belongsTo(DraftBill::class,'id','billingadvice_id');
    }

}
