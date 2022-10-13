<?php

namespace App\Modules\Models\ReceiveBill;

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
    ];

    public function vendor() {
        return $this->belongsTo(VendorClass::class);
    }
}
