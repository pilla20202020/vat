<?php

namespace App\Modules\Models\JobOrder;

use App\Modules\Models\Customer\Customer;
use App\Modules\Models\JobOrderDetail\JobOrderDetail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobOrder extends Model
{
    use HasFactory;

    protected $table = "tbl_job_orders";

    protected $fillable = [
        'customer_id',
        'invoice',
        'order_date',
        'is_billingadvice',
    ];

    public function customer() {
        return $this->belongsTo(Customer::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(JobOrderDetail::class,'joborder_id','id');
    }

    


}
