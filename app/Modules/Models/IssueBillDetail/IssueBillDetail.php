<?php

namespace App\Modules\Models\IssueBillDetail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IssueBillDetail extends Model
{
    use HasFactory;

    protected $table = "tbl_issue_bill_details";

    protected $fillable = [
        'issuebill_id',
        'component',
        'description',
        'price',
        'taxable_type',
        'billed_for',
    ];
}
