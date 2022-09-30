<?php

namespace App\Modules\Models\DraftBillDetail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DraftBillDetail extends Model
{
    use HasFactory;

    protected $table = "tbl_draft_bill_details";

    protected $fillable = [
        'draftbill_id',
        'component',
        'description',
        'price',
        'billed_for',
    ];
}
