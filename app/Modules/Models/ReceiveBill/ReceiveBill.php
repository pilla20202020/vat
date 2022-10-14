<?php

namespace App\Modules\Models\ReceiveBill;

use App\Modules\Models\ReceiveBillDetail\ReceiveBillDetail;
use App\Modules\Models\Vendor\VendorClass;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceiveBill extends Model
{
    use HasFactory;

    protected $table = "tbl_receive_bills";

    protected $fillable = [
        'vendor_id',
        'purchaseorder_id',
        'invoice',
        'date',
        'remarks',
        'non_taxable_total',
        'taxable_total',
        'grand_total',
    ];

    public function vendor() {
        return $this->belongsTo(VendorClass::class);
    }

    public function receiveDetails()
    {
        return $this->hasMany(ReceiveBillDetail::class,'receivebill_id','id');
    }
}
