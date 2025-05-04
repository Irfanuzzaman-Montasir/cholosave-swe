<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanRepayment extends Model
{
    use HasFactory;

    protected $primaryKey = 'repayment_id';
    public $timestamps = true;

    protected $fillable = [
        'loan_id',
        'amount',
        'payment_method',
        'transaction_reference',
        'status',
        'payment_date'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'payment_date' => 'datetime',
    ];

    // Relationships
    public function loan()
    {
        return $this->belongsTo(LoanRequest::class, 'loan_id');
    }
} 