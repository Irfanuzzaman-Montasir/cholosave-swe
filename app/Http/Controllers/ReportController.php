<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\MyGroup;
use App\Models\GroupMembership;
use App\Models\Savings;
use App\Models\LoanRequest;
use App\Models\Withdrawal;
use App\Models\Investment;
use App\Models\InvestmentReturn;
use App\Models\TransactionInfo;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function generateReport($groupId)
    {
        $userId = Auth::id();
        $group = MyGroup::findOrFail($groupId);

        // Group Overview Data
        $groupData = [
            'GroupName' => $group->group_name,
            'AdminName' => $group->admin->name,
            'TotalMembers' => GroupMembership::where('group_id', $groupId)
                ->where('status', 'approved')
                ->count(),
            'DPSType' => $group->dps_type,
            'TimePeriod' => $group->time_period,
            'InstallmentAmount' => $group->amount,
            'StartDate' => $group->start_date->format('d F, Y'),
            'GoalAmount' => $group->goal_amount,
            'EmergencyFund' => $group->emergency_fund,
            'TotalLoansApproved' => LoanRequest::where('group_id', $groupId)
                ->where('status', 'approved')
                ->count(),
            'TotalSavings' => Savings::where('group_id', $groupId)->sum('amount'),
            'TotalWithdrawal' => Withdrawal::where('group_id', $groupId)
                ->where('status', 'approved')
                ->sum('amount'),
            'TotalInvestments' => Investment::where('group_id', $groupId)->sum('amount'),
            'TotalReturns' => InvestmentReturn::join('investments', 'investment_returns.investment_id', '=', 'investments.investment_id')
                ->where('investments.group_id', $groupId)
                ->sum('investment_returns.amount'),
        ];

        // Calculate Profit
        $groupData['Profit'] = $groupData['TotalReturns'] - $groupData['TotalInvestments'];

        // Member Information
        $memberData = [
            'MemberName' => Auth::user()->name,
            'Role' => GroupMembership::where('group_id', $groupId)
                ->where('user_id', $userId)
                ->value('is_admin') ? 'Admin' : 'Member',
            'JoinDate' => GroupMembership::where('group_id', $groupId)
                ->where('user_id', $userId)
                ->value('join_date')->format('d F, Y'),
            'TotalSavings' => Savings::where('group_id', $groupId)
                ->where('user_id', $userId)
                ->sum('amount'),
            'TotalLoans' => LoanRequest::where('group_id', $groupId)
                ->where('user_id', $userId)
                ->where('status', 'approved')
                ->sum('amount'),
            'TotalWithdrawals' => Withdrawal::where('group_id', $groupId)
                ->where('user_id', $userId)
                ->where('status', 'approved')
                ->sum('amount'),
        ];

        // Recent Transactions
        $transactions = TransactionInfo::where('user_id', $userId)
            ->where('group_id', $groupId)
            ->orderBy('payment_time', 'desc')
            ->limit(5)
            ->get()
            ->map(function ($transaction) {
                return [
                    'transaction_id' => $transaction->transaction_id,
                    'amount' => $transaction->amount,
                    'payment_method' => $transaction->payment_method,
                    'PaymentTime' => $transaction->payment_time->format('d F, Y'),
                ];
            });

        // Recent Loans
        $loans = LoanRequest::where('user_id', $userId)
            ->where('group_id', $groupId)
            ->where('status', 'approved')
            ->orderBy('approve_date', 'desc')
            ->limit(5)
            ->get()
            ->map(function ($loan) {
                return [
                    'amount' => $loan->amount,
                    'ApproveDate' => $loan->approve_date->format('d F, Y'),
                ];
            });

        // Recent Withdrawals
        $withdrawals = Withdrawal::where('user_id', $userId)
            ->where('group_id', $groupId)
            ->where('status', 'approved')
            ->orderBy('approve_date', 'desc')
            ->limit(5)
            ->get()
            ->map(function ($withdrawal) {
                return [
                    'amount' => $withdrawal->amount,
                    'ApproveDate' => $withdrawal->approve_date->format('d F, Y'),
                ];
            });

        $pdf = PDF::loadView('groups.member.report', [
            'groupData' => $groupData,
            'memberData' => $memberData,
            'transactions' => $transactions,
            'loans' => $loans,
            'withdrawals' => $withdrawals,
        ]);

        return $pdf->download('financial-report-' . $groupId . '.pdf');
    }
} 