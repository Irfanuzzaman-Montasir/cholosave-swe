<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class LeaderboardController extends Controller
{
    public function index()
    {
        // Get users ordered by their points/score (you'll need to adjust this based on your scoring system)
        $users = User::orderBy('points', 'desc')
                    ->paginate(10);

        return view('leaderboard.index', compact('users'));
    }
} 