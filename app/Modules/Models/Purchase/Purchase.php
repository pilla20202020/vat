<?php

namespace App\Modules\Models\Purchase;

use App\Modules\Models\PurchaseDetails\PurchaseDetails;
use App\Modules\Models\ReceiveBill\ReceiveBill;
use App\Modules\Models\Vendor\VendorClass;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $table = "tbl_purchases";

    protected $fillable = [
        'vendor_id',
        'invoice',
        'order_date',
        'urgency',
        'remarks',
    ];

    public function vendor() {
        return $this->belongsTo(VendorClass::class);
    }

    public function purchaseDetails()
    {
        return $this->hasMany(PurchaseDetails::class,'purchaseorder_id','id');
    }

    public function receivedbill() {
        return $this->belongsTo(ReceiveBill::class, 'purchaseorder_id','id');
    }
}
