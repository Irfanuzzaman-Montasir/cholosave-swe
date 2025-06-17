<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leaderboard extends Model
{
    use HasFactory;

<<<<<<< HEAD
    public $timestamps = true;
=======
    protected $table = 'leaderboard';
>>>>>>> master

    protected $fillable = [
        'group_id',
        'points'
    ];

    protected $casts = [
<<<<<<< HEAD
        'points' => 'decimal:2',
    ];

    // Relationships
=======
        'points' => 'decimal:2'
    ];

>>>>>>> master
    public function group()
    {
        return $this->belongsTo(MyGroup::class, 'group_id');
    }
} 