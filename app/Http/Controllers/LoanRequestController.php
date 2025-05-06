<?php

namespace App\Http\Controllers;

use App\Models\LoanRequest;
use App\Models\MyGroup;
use App\Models\Poll;
use App\Models\Notification;
use App\Models\GroupMembership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoanRequestController extends Controller
{
    public function create($groupId)
    {
        $group = MyGroup::findOrFail($groupId);
        
        // Verify user is a member of the group
        $membership = GroupMembership::where('group_id', $groupId)
            ->where('user_id', Auth::id())
            ->where('status', 'approved')
            ->firstOrFail();

        // Check for pending leave request
        $hasLeaveRequest = GroupMembership::where('group_id', $groupId)
            ->where('user_id', Auth::id())
            ->where('leave_request', 1)
            ->exists();

        if ($hasLeaveRequest) {
            return redirect()->route('groups.member.dashboard', $groupId)
                ->with('error', 'Cannot request loan while having a pending leave request.');
        }

        return view('groups.member.loan_request', compact('group'));
    }

    public function store(Request $request, $groupId)
    {
        $group = MyGroup::findOrFail($groupId);

        // Check if user has any outstanding loans
        $existingLoan = LoanRequest::where('group_id', $groupId)
            ->where('user_id', Auth::id())
            ->whereIn('status', ['pending', 'approved'])
            ->first();

        if ($existingLoan) {
            return redirect()->route('member.loan.request.create', $groupId)
                ->with('error', 'You already have a pending or active loan request.');
        }

        // Check for pending leave request
        $hasLeaveRequest = GroupMembership::where('group_id', $groupId)
            ->where('user_id', Auth::id())
            ->where('leave_request', 1)
            ->exists();

        if ($hasLeaveRequest) {
            return redirect()->back()
                ->with('error', 'Cannot request loan while having a pending leave request.');
        }

        $request->validate([
            'amount' => 'required|numeric|min:1|max:' . $group->emergency_fund,
            'reason' => 'required|string|min:10',
            'return_date' => 'required|date|after:today',
            'terms' => 'required|accepted'
        ]);

        // Verify user is a member of the group
        $membership = GroupMembership::where('group_id', $groupId)
            ->where('user_id', Auth::id())
            ->where('status', 'approved')
            ->firstOrFail();

        try {
            DB::beginTransaction();

            // Create loan request
            $loanRequest = LoanRequest::create([
                'group_id' => $groupId,
                'user_id' => Auth::id(),
                'amount' => $request->amount,
                'reason' => $request->reason,
                'return_time' => $request->return_date,
                'status' => 'pending'
            ]);

            // Create poll for loan approval
            $userName = Auth::user()->name;
            $pollQuestion = "$userName has requested a loan of BDT {$request->amount}. Do you approve?";
            
            Poll::create([
                'group_id' => $groupId,
                'poll_question' => $pollQuestion
            ]);

            DB::commit();

            return redirect()->route('member.loan.request.create', $groupId)
                ->with('success', 'Loan request submitted successfully. Waiting for admin approval.')
                ->with('just_submitted', true);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Error processing loan request: ' . $e->getMessage());
        }
    }
} 