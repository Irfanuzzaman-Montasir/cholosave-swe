<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Group;
use App\Models\Investment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        try {
            // Get total members and new members this month
            $totalMembers = User::count();
            $newMembersThisMonth = User::whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->count();

            // Get total groups
            $totalGroups = Group::where('status', 'active')->count();

            // Get total savings and this month's savings
            $totalSavings = Investment::where('status', 'completed')->sum('amount') ?? 0;
            $savingsThisMonth = Investment::where('status', 'completed')
                ->whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->sum('amount') ?? 0;

            // Get current period investments
            $currentInvestments = Investment::where('status', 'completed')
                ->whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->sum('amount') ?? 0;

            // Get total reports (placeholder - implement based on your reports system)
            $totalReports = 4;

            // Get monthly new users for the chart
            $monthlyUsers = User::select(DB::raw('COUNT(*) as count'), DB::raw('DATE_FORMAT(created_at, "%b %Y") as month'))
                ->groupBy('month')
                ->orderBy('created_at', 'asc')
                ->limit(12)
                ->get();

            return view('admin.dashboard', compact(
                'totalMembers',
                'newMembersThisMonth',
                'totalGroups',
                'totalSavings',
                'savingsThisMonth',
                'currentInvestments',
                'totalReports',
                'monthlyUsers'
            ));
        } catch (\Exception $e) {
            // Log the error
            \Log::error('Admin Dashboard Error: ' . $e->getMessage());
            
            // Return view with default values if there's an error
            return view('admin.dashboard', [
                'totalMembers' => 0,
                'newMembersThisMonth' => 0,
                'totalGroups' => 0,
                'totalSavings' => 0,
                'savingsThisMonth' => 0,
                'currentInvestments' => 0,
                'totalReports' => 0,
                'monthlyUsers' => collect([])
            ]);
        }
    }
} 