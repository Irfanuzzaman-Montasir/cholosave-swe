<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvestmentReturn extends Model
{
    use HasFactory;

    protected $primaryKey = 'return_id';
<<<<<<< HEAD
    public $timestamps = true;
=======
>>>>>>> master

    protected $fillable = [
        'investment_id',
        'amount',
        'description'
    ];

    protected $casts = [
<<<<<<< HEAD
        'amount' => 'decimal:2',
    ];

    // Relationships
=======
        'amount' => 'decimal:2'
    ];

>>>>>>> master
    public function investment()
    {
        return $this->belongsTo(Investment::class, 'investment_id');
    }
} 