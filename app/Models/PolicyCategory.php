<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PolicyCategory extends Model
{
    use HasFactory;

    protected $fillable = ['category_code', 'category_name', 'category_name_sw', 'description', 'icon_url', 'display_order', 'is_active'];

    public function products()
    {
        return $this->hasMany(InsuranceProduct::class);
    }
}
