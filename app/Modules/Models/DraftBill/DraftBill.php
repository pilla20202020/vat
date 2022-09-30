<?php

namespace App\Modules\Models\DraftBill;

use App\Modules\Models\BillingAdvice\BillingAdvice;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DraftBill extends Model
{
    use HasFactory;

    protected $table = "tbl_draft_bills";

    protected $fillable = [
        'billingadvice_id',
        'bill_to',
        'address',
        'draft_bill_date',
    ];

    public function billingadvice() {
        return $this->belongsTo(BillingAdvice::class);
    }

}
