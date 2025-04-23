<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'name',
        'description',
        'target_amount',
        'current_amount',
        'status',
        'admin_id'
    ];

    /**
     * Get the admin user of the group.
     */
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    /**
     * Get the members of the group.
     */
    public function members()
    {
        return $this->belongsToMany(User::class, 'group_members')
            ->withTimestamps()
            ->withPivot('role');
    }
} 