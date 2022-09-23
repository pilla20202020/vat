<?php

namespace App\Modules\Models\ProductCategory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    protected $table = "tbl_product_categories";

    protected $fillable = [
        'name',
    ];
}
