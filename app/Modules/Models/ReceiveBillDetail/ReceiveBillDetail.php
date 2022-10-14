<?php

namespace App\Modules\Models\ReceiveBillDetail;

use App\Modules\Models\Product\Product;
use App\Modules\Models\Service\Service;
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

    public function product($product_id) {
        return Product::select('id','name')->where('id',$product_id)->first();
    }

    public function service($service_id) {
        return Service::select('id','name')->where('id',$service_id)->first();
    }
}
