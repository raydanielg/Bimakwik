<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $fillable = [
        'module_code',
        'module_name',
        'module_name_sw',
        'parent_module_id',
        'module_route',
        'module_icon',
        'display_order',
        'is_active',
    ];

    public function parent()
    {
        return $this->belongsTo(Module::class, 'parent_module_id');
    }

    public function children()
    {
        return $this->hasMany(Module::class, 'parent_module_id');
    }

    public function permissions()
    {
        return $this->hasMany(Permission::class, 'module_id');
    }
}
