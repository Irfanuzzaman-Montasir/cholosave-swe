<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    use HasFactory;

    protected $primaryKey = 'withdrawal_id';
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'group_id',
        'amount',
        'payment_number',
        'payment_method',
        'status',
        'approve_date'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'approve_date' => 'date',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function group()
    {
        return $this->belongsTo(MyGroup::class, 'group_id');
    }
} 