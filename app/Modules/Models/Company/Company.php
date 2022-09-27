<?php

namespace App\Modules\Models\Company;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $table = "tbl_companies";

    protected $fillable = [
        'name',
        'email',
        'address',
        'vat',
        'notification',
    ];

}
