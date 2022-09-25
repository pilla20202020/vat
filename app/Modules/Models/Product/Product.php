<?php

namespace App\Modules\Models\Product;

use App\Modules\Models\ProductCategory\ProductCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = "tbl_products";

    protected $fillable = [
        'name',
        'productcategory_id',
    ];

    public function productcategory() {
        return $this->belongsTo(ProductCategory::class);
    }

}
