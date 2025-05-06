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

        return redirect()->back()->with('success', 'Withdrawal request submitted successfully.');
    }
} 