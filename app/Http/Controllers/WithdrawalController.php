<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\MyGroup;
use App\Models\GroupMembership;
use App\Models\Savings;
use App\Models\Withdrawal;

class WithdrawalController extends Controller
{
    // Admin Methods
    public function adminCreate($groupId)
    {
        $group = MyGroup::findOrFail($groupId);
        return view('groups.admin.withdrawal_request', compact('group'));
    }

    public function adminStore(Request $request, $groupId)
    {
        $group = MyGroup::findOrFail($groupId);
        $userId = Auth::id();

        $request->validate([
            'amount' => 'required|numeric|min:1',
            'payment_number' => 'required|string',
            'payment_method' => 'required|in:Bkash,Nagad,Rocket',
        ]);

        // Check if user has sufficient savings
        $totalSavings = Savings::where('user_id', $userId)
            ->where('group_id', $groupId)
            ->sum('amount');

        if ($totalSavings < $request->amount) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['amount' => 'Insufficient savings for the requested withdrawal.']);
        }

        // Create withdrawal request
        Withdrawal::create([
            'user_id' => $userId,
            'group_id' => $groupId,
            'amount' => $request->amount,
            'payment_number' => $request->payment_number,
            'payment_method' => $request->payment_method,
        ]);

        return redirect()->back()
            ->with('success', 'Withdrawal request submitted successfully.')
            ->with('just_submitted', true);
    }

    /**
     * Display the admin's withdrawal history for a specific group.
     */
    public function adminWithdrawalHistory($groupId)
    {
        $group = MyGroup::findOrFail($groupId);
        
        // Get all withdrawals for the group
        $withdrawals = Withdrawal::where('group_id', $groupId)
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('groups.admin.withdrawal_history', compact('group', 'withdrawals'));
    }

    // Member Methods
    public function create($groupId)
    {
        $group = MyGroup::findOrFail($groupId);
        return view('groups.member.withdrawal_request', compact('group'));
    }

    public function store(Request $request, $groupId)
    {
        $group = MyGroup::findOrFail($groupId);
        $userId = Auth::id();

        $request->validate([
            'amount' => 'required|numeric|min:1',
            'payment_number' => 'required|string',
            'payment_method' => 'required|in:Bkash,Nagad,Rocket',
        ]);

        // Check if user has sufficient savings
        $totalSavings = Savings::where('user_id', $userId)
            ->where('group_id', $groupId)
            ->sum('amount');

        if ($totalSavings < $request->amount) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['amount' => 'Insufficient savings for the requested withdrawal.']);
        }

        // Create withdrawal request
        Withdrawal::create([
            'user_id' => $userId,
            'group_id' => $groupId,
            'amount' => $request->amount,
            'payment_number' => $request->payment_number,
            'payment_method' => $request->payment_method,
        ]);

        return redirect()->back()
            ->with('success', 'Withdrawal request submitted successfully.')
            ->with('just_submitted', true);
    }

    /**
     * Display the member's withdrawal history for a specific group.
     */
    public function withdrawalHistory($groupId)
    {
        $group = MyGroup::findOrFail($groupId);
        
        // Get withdrawals for the current user in this group
        $withdrawals = Withdrawal::where('group_id', $groupId)
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('groups.member.withdrawal_history', compact('group', 'withdrawals'));
    }

    public function downloadPdf($withdrawalId)
    {
        $withdrawal = Withdrawal::findOrFail($withdrawalId);
        $group = MyGroup::findOrFail($withdrawal->group_id);
        $user = Auth::user();

        $pdf = PDF::loadView('pdf.withdrawal', [
            'withdrawal' => $withdrawal,
            'group' => $group,
            'user' => $user
        ]);

        return $pdf->download('withdrawal-request-' . $withdrawalId . '.pdf');
    }
} 