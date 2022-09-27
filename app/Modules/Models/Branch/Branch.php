<?php

namespace App\Modules\Models\Branch;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $table = "tbl_branches";

    protected $fillable = [
        'name',
        'address',
        'company_id',
        'vat',
    ];
}   
