<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MyGroup extends Model
{
    protected $table = 'my_group';
    protected $primaryKey = 'group_id';
    public $timestamps = false;

    protected $fillable = [
        'group_name',
        'members',
        'group_admin_id',
        'dps_type',
        'time_period',
        'amount',
        'start_date',
        'goal_amount',
        'warning_time',
        'emergency_fund',
        'bKash',
        'Rocket',
        'Nagad',
        'description'
    ];

    // Relationship with User (Admin)
    public function admin()
    {
        return $this->belongsTo(User::class, 'group_admin_id', 'id');
    }

    // Relationship with GroupMembership
    public function memberships()
    {
        return $this->hasMany(GroupMembership::class, 'group_id', 'group_id');
    }
} 