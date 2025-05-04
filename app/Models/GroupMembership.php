<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupMembership extends Model
{
    protected $table = 'group_membership';
    protected $primaryKey = 'membership_id';
    public $timestamps = false;

    protected $fillable = [
        'group_id',
        'user_id',
        'status',
        'is_admin',
        'leave_request',
        'join_date',
        'join_request_date',
        'time_period_remaining'
    ];

    // Relationship with MyGroup
    public function group()
    {
        return $this->belongsTo(MyGroup::class, 'group_id', 'group_id');
    }

    // Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
} 