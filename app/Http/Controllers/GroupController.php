<?php

namespace App\Http\Controllers;

use App\Models\MyGroup;
use App\Models\GroupMembership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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

        return redirect()->route('groups.admin.dashboard', $group->group_id)
            ->with('success', 'Group created successfully!');
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
            return redirect()->route('groups.admin_dashboard', $group->group_id);
        } else {
            return redirect()->route('groups.member.dashboard', $group->group_id);
        }
    }
} 