<?php

namespace App\Http\Controllers;

use App\Models\MyGroup;
use App\Models\GroupMembership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
} 