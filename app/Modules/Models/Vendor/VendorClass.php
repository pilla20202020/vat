<?php

namespace App\Modules\Models\Vendor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorClass extends Model
{
    use HasFactory;

    protected $table = 'tbl_vendors';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'type',
    ];

}
