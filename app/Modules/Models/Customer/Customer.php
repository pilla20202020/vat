<?php

namespace App\Modules\Models\Customer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'tbl_customers';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'type',
    ];
}
