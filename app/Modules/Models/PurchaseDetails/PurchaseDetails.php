<?php

namespace App\Modules\Models\PurchaseDetails;

use App\Modules\Models\Product\Product;
use App\Modules\Models\Service\Service;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseDetails extends Model
{
    use HasFactory;

    protected $table = "tbl_purchase_details";

    protected $fillable = [
        'product_id',
        'purchaseorder_id',
        'quantity',
        'price',
        'type',
    ];

    public function product($product_id) {
        return Product::select('id','name')->where('id',$product_id)->first();
    }

    public function service($service_id) {
        return Service::select('id','name')->where('id',$service_id)->first();
    }
}
