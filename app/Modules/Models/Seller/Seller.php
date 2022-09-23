<?php

namespace App\Modules\Models\Seller;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    use HasFactory;

    protected $table = 'tbl_sellers';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'type',
    ];
}
