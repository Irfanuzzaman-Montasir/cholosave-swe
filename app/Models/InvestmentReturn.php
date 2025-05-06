<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvestmentReturn extends Model
{
    use HasFactory;

    protected $primaryKey = 'return_id';
    public $timestamps = true;

    protected $fillable = [
        'investment_id',
        'amount',
        'description'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
    ];

    // Relationships
    public function investment()
    {
        return $this->belongsTo(Investment::class, 'investment_id');
    }
} 