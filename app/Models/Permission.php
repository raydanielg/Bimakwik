<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Module;
use App\Models\Role;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = [
        'module_id',
        'permission_code',
        'permission_name',
        'permission_type',
        'name',
        'slug',
    ];

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
