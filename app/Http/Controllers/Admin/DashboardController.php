<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Group;
use App\Models\Investment;
use App\Models\ContactUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        try {
            // Enhanced stats query similar to test project
            $stats = $this->getDashboardStats();
            
            // Get comprehensive analytics data for charts
            $analyticsData = $this->getAnalyticsData();

            return view('admin.dashboard', compact('stats', 'analyticsData'));
        } catch (\Exception $e) {
            // Log the error
            \Log::error('Admin Dashboard Error: ' . $e->getMessage());
            
            // Return view with default values if there's an error
            return view('admin.dashboard', [
                'stats' => $this->getDefaultStats(),
                'analyticsData' => $this->getDefaultAnalyticsData()
            ]);
        }
    }

    /**
     * Get comprehensive dashboard statistics
     */
    private function getDashboardStats()
    {
        // Total savings (investments with type 'savings')
        $totalSavings = Investment::where('type', 'savings')
            ->where('status', 'completed')
            ->sum('amount') ?? 0;

        // This month's savings
        $thisMonthSavings = Investment::where('type', 'savings')
            ->where('status', 'completed')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('amount') ?? 0;

        // Total members
        $totalMembers = User::count();

        // New members this month
        $newMembers = User::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        // Total groups
        $totalGroups = Group::where('status', 'active')->count();

        // Total reports (contact us submissions)
        $totalReports = ContactUs::count();

        // Total investments (investments with type 'investment')
        $totalInvestments = Investment::where('type', 'investment')
            ->where('status', 'completed')
            ->sum('amount') ?? 0;

        // Current period investments
        $currentInvestments = Investment::where('type', 'investment')
            ->where('status', 'completed')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('amount') ?? 0;

        return [
            'totalSavings' => $totalSavings,
            'thisMonthSavings' => $thisMonthSavings,
            'totalMembers' => $totalMembers,
            'newMembers' => $newMembers,
            'totalGroups' => $totalGroups,
            'totalReports' => $totalReports,
            'totalInvestments' => $totalInvestments,
            'currentInvestments' => $currentInvestments
        ];
    }

    /**
     * Get comprehensive analytics data for charts
     */
    private function getAnalyticsData()
    {
        // Get last 6 months of data
        $sixMonthsAgo = now()->subMonths(6)->startOfMonth();
        
        $analyticsData = DB::table('users as u')
            ->select(
                DB::raw('DATE_FORMAT(u.created_at, "%b %Y") as month_label'),
                DB::raw('DATE_FORMAT(u.created_at, "%Y-%m") as month_sort'),
                DB::raw('COUNT(DISTINCT u.id) as new_users'),
                DB::raw('IFNULL(SUM(CASE WHEN i.type = "savings" AND i.status = "completed" THEN i.amount ELSE 0 END), 0) as total_savings'),
                DB::raw('IFNULL(SUM(CASE WHEN i.type = "investment" AND i.status = "completed" THEN i.amount ELSE 0 END), 0) as investments'),
                DB::raw('COUNT(DISTINCT c.id) as contact_reports')
            )
            ->leftJoin('investments as i', function($join) {
                $join->on(DB::raw('DATE_FORMAT(i.created_at, "%Y-%m")'), '=', DB::raw('DATE_FORMAT(u.created_at, "%Y-%m")'));
            })
            ->leftJoin('contact_us as c', function($join) {
                $join->on(DB::raw('DATE_FORMAT(c.created_at, "%Y-%m")'), '=', DB::raw('DATE_FORMAT(u.created_at, "%Y-%m")'));
            })
            ->where('u.created_at', '>=', $sixMonthsAgo)
            ->groupBy('month_label', 'month_sort')
            ->orderBy('month_sort', 'asc')
            ->get();

        // Prepare data arrays for charts
        $data = [
            'labels' => [],
            'users' => [],
            'savings' => [],
            'investments' => [],
            'reports' => []
        ];

        foreach ($analyticsData as $row) {
            $data['labels'][] = $row->month_label;
            $data['users'][] = $row->new_users;
            $data['savings'][] = (float) $row->total_savings;
            $data['investments'][] = (float) $row->investments;
            $data['reports'][] = $row->contact_reports;
        }

        return $data;
    }

    /**
     * Get default stats when there's an error
     */
    private function getDefaultStats()
    {
        return [
            'totalSavings' => 0,
            'thisMonthSavings' => 0,
            'totalMembers' => 0,
            'newMembers' => 0,
            'totalGroups' => 0,
            'totalReports' => 0,
            'totalInvestments' => 0,
            'currentInvestments' => 0
        ];
    }

    /**
     * Get default analytics data when there's an error
     */
    private function getDefaultAnalyticsData()
    {
        return [
            'labels' => [],
            'users' => [],
            'savings' => [],
            'investments' => [],
            'reports' => []
        ];
    }

    /**
     * Get real-time dashboard data via AJAX
     */
    public function getDashboardData()
    {
        try {
            $stats = $this->getDashboardStats();
            $analyticsData = $this->getAnalyticsData();

            return response()->json([
                'success' => true,
                'stats' => $stats,
                'analyticsData' => $analyticsData
            ]);
        } catch (\Exception $e) {
            \Log::error('Dashboard Data Error: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Error fetching dashboard data',
                'stats' => $this->getDefaultStats(),
                'analyticsData' => $this->getDefaultAnalyticsData()
            ], 500);
        }
    }
} 