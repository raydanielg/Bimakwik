<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'requester_id',
        'requested_role_id',
        'requested_permission_id',
        'request_type',
        'reason',
        'status',
        'reviewed_by',
        'reviewed_at',
        'approval_notes',
    ];

    protected $casts = [
        'reviewed_at' => 'datetime',
    ];

    public function requester()
    {
        return $this->belongsTo(User::class, 'requester_id');
    }

    public function requestedRole()
    {
        return $this->belongsTo(Role::class, 'requested_role_id');
    }

    public function requestedPermission()
    {
        return $this->belongsTo(Permission::class, 'requested_permission_id');
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }
}
