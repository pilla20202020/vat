<?php

namespace App\Modules\Models\ReceiveBillDetail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceiveBillDetail extends Model
{
    use HasFactory;

    protected $table = "tbl_receive_bill_details";

    protected $fillable = [
        'product_id',
        'receivebill_id',
        'quantity',
        'price',
        'type',
        'taxable_type',
    ];
}
