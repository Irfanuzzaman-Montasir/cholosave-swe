<?php

namespace App\Http\Controllers;

use App\Models\MyGroup;
use App\Models\LoanRequest;
use App\Models\TransactionInfo;
use App\Models\Withdrawal;
use Illuminate\Http\Request;

class GroupMemberController extends Controller
{
    public function loanHistory($groupId)
    {
        $group = MyGroup::findOrFail($groupId);
        $loans = LoanRequest::where('user_id', auth()->id())
            ->where('group_id', $groupId)
            ->whereIn('status', ['approved', 'pending', 'repaid'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('groups.member.loan_history', compact('group', 'loans'));
    }

    public function paymentHistory($groupId)
    {
        $group = MyGroup::findOrFail($groupId);
        $transactions = TransactionInfo::where('user_id', auth()->id())
            ->where('group_id', $groupId)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('groups.member.payment_history', compact('group', 'transactions'));
    }

    public function withdrawalHistory($groupId)
    {
        $group = MyGroup::findOrFail($groupId);
        $withdrawals = Withdrawal::where('group_id', $groupId)
            ->with('user') // Assuming there's a relationship to get user name
            ->orderBy('created_at', 'desc')
            ->get();

        return view('groups.member.withdrawal_history', compact('group', 'withdrawals'));
    }
} 