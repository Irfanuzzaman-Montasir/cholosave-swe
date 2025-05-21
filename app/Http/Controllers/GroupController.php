<?php

namespace App\Http\Controllers;

use App\Models\MyGroup;
use App\Models\GroupMembership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\Savings;
use App\Models\Investment;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\LoanRequest;
use App\Models\Notification;
use Illuminate\Support\Facades\DB;

class GroupController extends Controller
{
    public function create()
    {
        return view('groups.create');
    }

    public function store(Request $request)
    {
        // Validate all data
        $validated = $request->validate([
            'group_name' => 'required|string|max:255',
            'description' => 'required|string',
            'members' => 'required|integer|min:2',
            'dps_type' => 'required|in:weekly,monthly',
            'time_period' => 'required|integer|min:1',
            'amount' => 'required|numeric|min:0',
            'start_date' => 'required|date|after:today',
            'bKash' => 'nullable|string|max:20',
            'Rocket' => 'nullable|string|max:20',
            'Nagad' => 'nullable|string|max:20',
            'goal_amount' => 'required|numeric|min:0',
            'emergency_fund' => 'required|numeric|min:0'
        ]);

        try {
            DB::beginTransaction();

            // Create the group
            $group = MyGroup::create([
                'group_name' => $validated['group_name'],
                'description' => $validated['description'],
                'members' => $validated['members'],
                'group_admin_id' => Auth::id(),
                'dps_type' => $validated['dps_type'],
                'time_period' => $validated['time_period'],
                'amount' => $validated['amount'],
                'start_date' => $validated['start_date'],
                'bKash' => $validated['bKash'],
                'Rocket' => $validated['Rocket'],
                'Nagad' => $validated['Nagad'],
                'goal_amount' => $validated['goal_amount'],
                'emergency_fund' => $validated['emergency_fund']
            ]);

            // Create the admin membership
            GroupMembership::create([
                'group_id' => $group->group_id,
                'user_id' => Auth::id(),
                'status' => 'approved',
                'is_admin' => true,
                'leave_request' => 'no',
                'join_date' => now(),
                'time_period_remaining' => $validated['time_period']
            ]);

            // Create leaderboard entry with 20 points
            \App\Models\Leaderboard::create([
                'group_id' => $group->group_id,
                'points' => 20.00
            ]);

            DB::commit();

            return redirect()->route('groups.admin.dashboard', $group->group_id)
                ->with('success', 'Group created successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Error creating group: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function adminDashboard($groupId)
    {
        $group = MyGroup::findOrFail($groupId);
        $membership = GroupMembership::where('group_id', $groupId)
            ->where('user_id', auth()->id())
            ->where('is_admin', true)
            ->firstOrFail();

        return view('groups.admin.dashboard', compact('group', 'membership'));
    }

    public function memberDashboard($groupId)
    {
        $group = MyGroup::findOrFail($groupId);
        $membership = GroupMembership::where('group_id', $groupId)
            ->where('user_id', auth()->id())
            ->where('is_admin', false)
            ->firstOrFail();

        return view('groups.member.dashboard', compact('group', 'membership'));
    }

    public function show($groupId)
    {
        $group = \App\Models\MyGroup::findOrFail($groupId);
        return view('groups.show', compact('group'));
    }

    public function myGroups()
    {
        $userId = auth()->id();
        $memberships = \App\Models\GroupMembership::where('user_id', $userId)
            ->where('status', 'approved')
            ->with('group')
            ->get();

        return view('groups.my_groups', compact('memberships'));
    }

    public function joinGroups()
    {
        $userId = auth()->id();
        
        // Get all groups that the user hasn't joined or has pending requests for
        $groups = \App\Models\MyGroup::whereDoesntHave('memberships', function($query) use ($userId) {
            $query->where('user_id', $userId)
                  ->where('status', 'approved');
        })
        ->with(['memberships' => function($query) use ($userId) {
            $query->where('user_id', $userId)
                  ->where('status', 'pending');
        }])
        ->get();

        // Add membership status to each group
        $groups->each(function($group) {
            $group->membership_status = $group->memberships->isNotEmpty() ? 'pending' : 'not_joined';
        });

        \Log::info('Join groups page loaded', [
            'userId' => $userId,
            'groupsCount' => $groups->count(),
            'groups' => $groups->toArray()
        ]);

        return view('groups.join_groups', compact('groups'));
    }

    public function joinGroup(Request $request, $groupId)
    {
        try {
            \Log::info('Join group request received', ['groupId' => $groupId, 'userId' => auth()->id()]);
            
            $userId = auth()->id();
            $group = \App\Models\MyGroup::findOrFail($groupId);

            \Log::info('Group found', ['group' => $group->toArray()]);

            // Check if group is full
            $currentMembers = \App\Models\GroupMembership::where('group_id', $groupId)
                ->where('status', 'approved')
                ->count();

            if ($currentMembers >= $group->members) {
                return response()->json([
                    'success' => false,
                    'message' => 'This group has reached its maximum member limit'
                ]);
            }

            // Check if user already has a pending request
            $existingMembership = \App\Models\GroupMembership::where('group_id', $groupId)
                ->where('user_id', $userId)
                ->where('status', 'pending')
                ->first();

            if ($existingMembership) {
                \Log::info('Existing pending membership found', ['membership' => $existingMembership->toArray()]);
                return response()->json([
                    'success' => false,
                    'message' => 'You already have a pending request for this group'
                ]);
            }

            // Create new membership request with all required fields
            $membership = \App\Models\GroupMembership::create([
                'group_id' => $groupId,
                'user_id' => $userId,
                'status' => 'pending',
                'is_admin' => false,
                'leave_request' => 'no',
                'join_date' => null,
                'time_period_remaining' => $group->time_period,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            \Log::info('New membership created', [
                'membership' => $membership->toArray(),
                'group_time_period' => $group->time_period
            ]);

            if ($membership) {
                return response()->json([
                    'success' => true,
                    'message' => 'Join request sent successfully'
                ]);
            } else {
                \Log::error('Failed to create membership');
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to create join request'
                ]);
            }
        } catch (\Exception $e) {
            \Log::error('Error in joinGroup: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'groupId' => $groupId,
                'userId' => auth()->id()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while processing your request'
            ], 500);
        }
    }

    public function enterGroup($groupId)
    {
        $group = MyGroup::findOrFail($groupId);
        $membership = GroupMembership::where('group_id', $groupId)
            ->where('user_id', auth()->id())
            ->where('status', 'approved')
            ->firstOrFail();

        if ($membership->is_admin) {
            return redirect()->route('groups.admin.dashboard', $group->group_id);
        } else {
            return redirect()->route('groups.member.dashboard', $group->group_id);
        }
    }

    public function members($groupId)
    {
        $memberships = GroupMembership::with('user')
            ->where('group_id', $groupId)
            ->where('status', 'approved')
            ->get();

        $members = $memberships->map(function($membership) use ($groupId) {
            $contribution = Savings::where('group_id', $groupId)
                ->where('user_id', $membership->user_id)
                ->sum('amount');
            return [
                'name' => $membership->user->name,
                'join_date' => $membership->created_at,
                'contribution' => $contribution,
                'remaining_installment' => $membership->time_period_remaining,
            ];
        });

        $group = \App\Models\MyGroup::findOrFail($groupId);

        return view('groups.member.members', compact('group', 'members'));
    }

    public function investmentDetails($groupId)
    {
        $group = MyGroup::findOrFail($groupId);
        $membership = GroupMembership::where('group_id', $groupId)
            ->where('user_id', auth()->id())
            ->where('status', 'approved')
            ->firstOrFail();

        $investments = Investment::with('returns')
            ->where('group_id', $groupId)
            ->orderBy('investment_id', 'desc')
            ->get();

        return view('groups.member.investment-details', compact('group', 'membership', 'investments'));
    }

    public function exportInvestmentDetails($groupId)
    {
        $group = MyGroup::findOrFail($groupId);
        $membership = GroupMembership::where('group_id', $groupId)
            ->where('user_id', auth()->id())
            ->where('status', 'approved')
            ->firstOrFail();

        $investments = Investment::with('returns')
            ->where('group_id', $groupId)
            ->orderBy('investment_id', 'desc')
            ->get();

        $pdf = PDF::loadView('groups.member.investment-details-pdf', [
            'group' => $group,
            'investments' => $investments,
            'totalInvestment' => $investments->sum('amount'),
            'totalExpected' => $investments->sum('ex_profit'),
            'totalActual' => $investments->sum(function($investment) {
                return $investment->returns->sum('amount');
            })
        ]);

        return $pdf->download('investment-details-' . $group->group_name . '.pdf');
    }

    public function adminNotifications($groupId)
    {
        $group = MyGroup::findOrFail($groupId);
        
        // Fetch only unread notifications for the group
        $notifications = \App\Models\Notification::where('target_group_id', $groupId)
            ->where('status', 'unread')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('groups.admin.group_notifications', compact('notifications', 'group'));
    }

    public function markNotificationAsRead($groupId, $notificationId)
    {
        $notification = \App\Models\Notification::where('notification_id', $notificationId)
            ->where('target_group_id', $groupId)
            ->firstOrFail();

        $notification->update(['status' => 'read']);

        return response()->json(['success' => true]);
    }

    public function clearAllNotifications($groupId)
    {
        // Mark all notifications as read instead of deleting them
        \App\Models\Notification::where('target_group_id', $groupId)
            ->where('status', 'unread')
            ->update(['status' => 'read']);
        
        return response()->json(['success' => true]);
    }

    public function adminMembers($groupId)
    {
        $group = MyGroup::findOrFail($groupId);
        
        // Get all members with their details
        $members = GroupMembership::where('group_id', $groupId)
            ->where('status', 'approved')
            ->with('user')
            ->get()
            ->map(function ($membership) use ($groupId) {
                // Calculate total contribution from savings
                $contribution = Savings::where('group_id', $groupId)
                    ->where('user_id', $membership->user_id)
                    ->sum('amount');

                return [
                    'name' => $membership->user->name,
                    'join_date' => $membership->created_at,
                    'is_admin' => $membership->is_admin,
                    'contribution' => $contribution,
                    'remaining_installment' => $membership->time_period_remaining
                ];
            });

        return view('groups.admin.members', compact('group', 'members'));
    }

    public function memberLoans($groupId)
    {
        $group = MyGroup::findOrFail($groupId);
        
        // Verify user is admin
        $membership = GroupMembership::where('group_id', $groupId)
            ->where('user_id', auth()->id())
            ->where('is_admin', true)
            ->firstOrFail();

        // Get all loan requests with user details
        $loans = LoanRequest::with('user')
            ->where('group_id', $groupId)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('groups.admin.member_loans', compact('group', 'loans'));
    }

    public function approveLoan($groupId, $loanId)
    {
        try {
            $group = MyGroup::findOrFail($groupId);
            
            // Verify user is admin
            $membership = GroupMembership::where('group_id', $groupId)
                ->where('user_id', auth()->id())
                ->where('is_admin', true)
                ->firstOrFail();

            $loan = LoanRequest::findOrFail($loanId);

            // Check if loan is already processed
            if ($loan->status !== 'pending') {
                return response()->json([
                    'success' => false,
                    'message' => 'This loan request has already been processed.'
                ]);
            }

            // Check emergency fund balance
            $emergencyFund = $group->emergency_fund;
            if ($emergencyFund < $loan->amount) {
                return response()->json([
                    'success' => false,
                    'message' => 'Insufficient emergency fund balance to approve this loan.'
                ]);
            }

            // Update loan status
            $loan->update([
                'status' => 'approved',
                'approve_date' => now()
            ]);

            // Create single notification for both user and group
            Notification::create([
                'target_user_id' => $loan->user_id,
                'target_group_id' => $groupId,
                'title' => 'Loan Request Approved',
                'message' => "Loan request of ৳{$loan->amount} by {$loan->user->name} has been approved.",
                'type' => 'loan_approval',
                'status' => 'unread'
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Loan request has been approved successfully.'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while processing your request.'
            ]);
        }
    }

    public function declineLoan($groupId, $loanId)
    {
        try {
            $group = MyGroup::findOrFail($groupId);
            
            // Verify user is admin
            $membership = GroupMembership::where('group_id', $groupId)
                ->where('user_id', auth()->id())
                ->where('is_admin', true)
                ->firstOrFail();

            $loan = LoanRequest::findOrFail($loanId);

            // Check if loan is already processed
            if ($loan->status !== 'pending') {
                return response()->json([
                    'success' => false,
                    'message' => 'This loan request has already been processed.'
                ]);
            }

            // Update loan status
            $loan->update([
                'status' => 'declined'
            ]);

            // Create single notification for both user and group
            Notification::create([
                'target_user_id' => $loan->user_id,
                'target_group_id' => $groupId,
                'title' => 'Loan Request Declined',
                'message' => "Loan request of ৳{$loan->amount} by {$loan->user->name} has been declined.",
                'type' => 'loan_approval',
                'status' => 'unread'
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Loan request has been declined successfully.'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while processing your request.'
            ]);
        }
    }

    public function adminSettings($groupId)
    {
        $group = MyGroup::findOrFail($groupId);
        
        // Verify user is admin
        $membership = GroupMembership::where('group_id', $groupId)
            ->where('user_id', auth()->id())
            ->where('is_admin', true)
            ->firstOrFail();

        return view('groups.admin.settings', compact('group'));
    }

    public function updateSettings(Request $request, $groupId)
    {
        $group = MyGroup::findOrFail($groupId);
        
        // Verify user is admin
        $membership = GroupMembership::where('group_id', $groupId)
            ->where('user_id', auth()->id())
            ->where('is_admin', true)
            ->firstOrFail();

        // Validate the request
        $validated = $request->validate([
            'amount' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'goal_amount' => 'required|numeric|min:0',
            'emergency_fund' => 'required|numeric|min:0',
            'bKash' => 'nullable|string|max:20',
            'Rocket' => 'nullable|string|max:20',
            'Nagad' => 'nullable|string|max:20',
        ]);

        // Update group settings
        $group->update($validated);

        return redirect()->back()->with('success', 'Group settings updated successfully.');
    }

    public function closeSavings($groupId)
    {
        // This is a placeholder for the close savings functionality
        return response()->json([
            'success' => false,
            'message' => 'This feature is currently under development.'
        ]);
    }

    public function joinRequests(MyGroup $group)
    {
        // Verify if user is admin
        if (!$group->isAdmin(auth()->id())) {
            return redirect()->back()->with('error', 'Unauthorized access');
        }

        // Get pending join requests
        $pendingRequests = GroupMembership::with('user')
            ->where('group_id', $group->group_id)
            ->where('status', 'pending')
            ->get();

        return view('groups.admin.join_requests', compact('group', 'pendingRequests'));
    }

    public function approveJoinRequest(MyGroup $group, GroupMembership $request)
    {
        // Verify if user is admin
        if (!$group->isAdmin(auth()->id())) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized access'
            ], 403);
        }

        // Update membership status
        $request->update([
            'status' => 'approved',
            'join_date' => now(),
            'time_period_remaining' => $group->time_period
        ]);

        // Create notification for the group (targeted_group_id set, targeted_user_id null)
        Notification::create([
            'target_group_id' => $group->group_id,
            'target_user_id' => null,
            'title' => 'New Member Joined',
            'message' => "{$request->user->name} has joined the group",
            'type' => 'join_request',
            'status' => 'unread'
        ]);

        // Create notification for the user (targeted_user_id set, targeted_group_id null)
        Notification::create([
            'target_user_id' => $request->user_id,
            'target_group_id' => null,
            'title' => 'Join Request Approved',
            'message' => "Your request to join {$group->name} has been approved!",
            'type' => 'join_request',
            'status' => 'unread'
        ]);

        // Add points to leaderboard
        $leaderboard = \App\Models\Leaderboard::firstOrCreate(
            ['group_id' => $group->group_id],
            ['points' => 0]
        );
        $leaderboard->increment('points', 5);

        return response()->json([
            'success' => true,
            'message' => 'Join request approved successfully'
        ]);
    }

    public function rejectJoinRequest(MyGroup $group, GroupMembership $request)
    {
        // Verify if user is admin
        if (!$group->isAdmin(auth()->id())) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized access'
            ], 403);
        }

        // Update membership status
        $request->update([
            'status' => 'declined'
        ]);

        // Create notification for the user (targeted_user_id set, targeted_group_id null)
        Notification::create([
            'target_user_id' => $request->user_id,
            'target_group_id' => null,
            'title' => 'Join Request Declined',
            'message' => "Your request to join {$group->name} has been declined.",
            'type' => 'join_request',
            'status' => 'unread'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Join request declined successfully'
        ]);
    }
} 