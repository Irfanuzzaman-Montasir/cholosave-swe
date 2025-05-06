<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AITipsController extends Controller
{
    public function index(Request $request)
    {
        // You can fetch user financial data here if needed for the view
        return view('ai_tips');
    }
} 