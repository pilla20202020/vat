<?php

namespace App\Modules\Models\IssueBill;

use App\Modules\Models\DraftBill\DraftBill;
use App\Modules\Models\IssueBillDetail\IssueBillDetail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IssueBill extends Model
{
    use HasFactory;

    protected $table = "tbl_issue_bills";

    protected $fillable = [
        'draftbill_id',
        'bill_to',
        'address',
        'issue_bill_date',
        'is_accepted',
    ];

    public function draftbill() {
        return $this->belongsTo(DraftBill::class);
    }

    public function issueDetails()
    {
        return $this->hasMany(IssueBillDetail::class,'issuebill_id','id');
    }
}
