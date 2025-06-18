<?php

namespace App\Http\Controllers;

use App\Models\ExpertTeam;
use Illuminate\Http\Request;

class ExpertController extends Controller
{
    public function index()
    {
        $experts = ExpertTeam::all();
        return view('experts', compact('experts'));
    }
}
