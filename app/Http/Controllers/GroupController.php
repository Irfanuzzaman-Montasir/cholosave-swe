<?php

namespace App\Http\Controllers;

use App\Models\MyGroup;
use App\Models\GroupMembership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GroupController extends Controller
{
    public function create()
    {
        return view('groups.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'group_name' => 'required|string|max:255',
            'description' => 'required|string',
            'members' => 'required|integer|min:1',
            'dps_type' => 'required|in:weekly,monthly',
            'time_period' => 'required|integer|min:1',
            'amount' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'goal_amount' => 'required|numeric|min:0',
            'emergency_fund' => 'required|numeric|min:0',
            'bkash_number' => 'nullable|string|max:255',
            'rocket_number' => 'nullable|string|max:255',
            'nagad_number' => 'required|string|max:255',
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
            'goal_amount' => $validated['goal_amount'],
            'emergency_fund' => $validated['emergency_fund'],
            'bKash' => $validated['bkash_number'],
            'Rocket' => $validated['rocket_number'],
            'Nagad' => $validated['nagad_number'],
        ]);

        // Create membership for the admin
        GroupMembership::create([
            'group_id' => $group->group_id,
            'user_id' => Auth::id(),
            'status' => 'approved',
            'is_admin' => 1,
            'join_date' => now(),
            'time_period_remaining' => $validated['time_period']
        ]);

        return redirect()->route('dashboard')
            ->with('success', 'Group created successfully!');
    }

    public function show(MyGroup $group)
    {
        return view('groups.show', compact('group'));
    }

    public function index(Request $request)
    {
        $user_id = Auth::id();

        // All groups with member count and membership status
        $allGroups = DB::select("
            SELECT 
                g.group_id, 
                g.group_name, 
                g.dps_type, 
                g.amount AS installment,
                g.time_period,
                g.start_date,
                g.goal_amount,
                g.warning_time,
                g.emergency_fund,
                g.members,
                u.name AS admin_name,
                COUNT(gm.user_id) AS members_count,
                EXISTS (
                    SELECT 1 FROM group_membership 
                    WHERE group_id = g.group_id 
                    AND user_id = ? 
                    AND status IN ('approved', 'pending')
                ) as is_member,
                (
                    SELECT status FROM group_membership 
                    WHERE group_id = g.group_id 
                    AND user_id = ?
                ) as membership_status
            FROM 
                my_group g
            LEFT JOIN 
                users u ON g.group_admin_id = u.id
            LEFT JOIN 
                group_membership gm 
            ON 
                g.group_id = gm.group_id AND gm.status = 'approved'
            GROUP BY 
                g.group_id, g.group_name, g.dps_type, g.amount, g.time_period, g.start_date, g.goal_amount, g.warning_time, g.emergency_fund, g.members, u.name
        ", [$user_id, $user_id]);

        // Joined groups
        $joinedGroups = DB::select("
            SELECT 
                g.group_id, 
                g.group_name, 
                g.dps_type, 
                g.amount AS installment, 
                g.time_period,
                g.start_date,
                g.goal_amount,
                g.warning_time,
                g.emergency_fund,
                g.members,
                u.name AS admin_name,
                COUNT(gm2.user_id) AS members_count,
                CASE WHEN g.group_admin_id = ? THEN 1 ELSE 0 END AS is_admin
            FROM 
                group_membership gm
            INNER JOIN 
                my_group g 
            ON 
                gm.group_id = g.group_id
            LEFT JOIN 
                users u ON g.group_admin_id = u.id
            LEFT JOIN 
                group_membership gm2 
            ON 
                g.group_id = gm2.group_id AND gm2.status = 'approved'
            WHERE 
                gm.user_id = ? AND gm.status = 'approved'
            GROUP BY 
                g.group_id, g.group_name, g.dps_type, g.amount, g.time_period, g.start_date, g.goal_amount, g.warning_time, g.emergency_fund, g.members, u.name, g.group_admin_id
        ", [$user_id, $user_id]);

        // Flash messages
        $message = session('message');
        $message_type = session('message_type');

        return view('groups.join_grp', compact('allGroups', 'joinedGroups', 'message', 'message_type'));
    }

    public function join(Request $request)
    {
        $user_id = Auth::id();
        $group_id = $request->input('group_id');

        // Check if already a member
        $membership = DB::table('group_membership')
            ->where('user_id', $user_id)
            ->where('group_id', $group_id)
            ->first();

        if ($membership) {
            if ($membership->status == 'approved') {
                return redirect()->route('groups.index')->with([
                    'message' => 'You are already a member of this group.',
                    'message_type' => 'warning'
                ]);
            } else {
                return redirect()->route('groups.index')->with([
                    'message' => 'Your join request is pending approval.',
                    'message_type' => 'info'
                ]);
            }
        } else {
            // Insert join request
            DB::table('group_membership')->insert([
                'user_id' => $user_id,
                'group_id' => $group_id,
                'status' => 'pending',
                'join_request_date' => now()
            ]);

            // Fetch member's name
            $memberName = DB::table('users')->where('id', $user_id)->value('name');

            // Insert poll
            $pollQuestion = "{$memberName} wants to join the group. Do you approve?";
            DB::table('polls')->insert([
                'group_id' => $group_id,
                'poll_question' => $pollQuestion
            ]);

            return redirect()->route('groups.index')->with([
                'message' => 'Join request sent successfully! Please wait for approval.',
                'message_type' => 'success'
            ]);
        }
    }
} 