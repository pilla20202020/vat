<?php

namespace App\Modules\Models\Service;

use App\Modules\Models\ServiceCategory\ServiceCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $table = "tbl_services";

    protected $fillable = [
        'name',
        'servicecategory_id',
    ];

    public function servicecategory() {
        return $this->belongsTo(ServiceCategory::class);
    }
}
