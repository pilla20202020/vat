<?php

namespace App\Modules\Models\ServiceCategory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceCategory extends Model
{
    use HasFactory;

    protected $table = "tbl_service_categories";

    protected $fillable = [
        'name',
    ];

}
