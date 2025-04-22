<?php

namespace App\Http\Controllers;

use App\Models\ExpertTeam;
use Illuminate\Http\Request;

class ExpertController extends Controller
{
    public function index()
    {
        $experts = ExpertTeam::all();
        
        // If no experts exist, create some sample data
        if ($experts->isEmpty()) {
            $experts = collect([
                (object)[
                    'name' => 'John Doe',
                    'email' => 'john@example.com',
                    'phone' => '+1 234 567 890',
                    'expertise' => 'Financial Advisor',
                    'bio' => 'Experienced financial advisor with over 10 years of experience in wealth management and investment strategies.',
                    'image' => 'https://via.placeholder.com/300x200'
                ],
                (object)[
                    'name' => 'Jane Smith',
                    'email' => 'jane@example.com',
                    'phone' => '+1 234 567 891',
                    'expertise' => 'Investment Specialist',
                    'bio' => 'Specialized in portfolio management and risk assessment with a focus on sustainable investments.',
                    'image' => 'https://via.placeholder.com/300x200'
                ],
                (object)[
                    'name' => 'Mike Johnson',
                    'email' => 'mike@example.com',
                    'phone' => '+1 234 567 892',
                    'expertise' => 'Tax Consultant',
                    'bio' => 'Expert in tax planning and optimization strategies for individuals and businesses.',
                    'image' => 'https://via.placeholder.com/300x200'
                ]
            ]);
        }

        return view('experts', compact('experts'));
    }
}
