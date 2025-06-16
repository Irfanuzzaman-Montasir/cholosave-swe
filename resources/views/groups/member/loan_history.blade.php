@extends('layouts.group_member')

@section('title', 'Loan History')

@push('styles')
<style>
    .custom-font {
        font-family: 'Poppins', sans-serif;
    }

    .table-container {
        scrollbar-width: thin;
        scrollbar-color: #CBD5E0 #EDF2F7;
    }

    .table-container::-webkit-scrollbar {
        width: 8px;
        height: 8px;
    }

    .table-container::-webkit-scrollbar-track {
        background: #EDF2F7;
    }

    .table-container::-webkit-scrollbar-thumb {
        background-color: #CBD5E0;
        border-radius: 4px;
    }

    .animate-fade-in {
        animation: fadeIn 0.5s ease-in-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Force black text in light mode */
    .force-light h1,
    .force-light h2,
    .force-light th,
    .force-light td {
        color: #000 !important;
    }

    .status-badge {
        padding: 0.5rem 1rem;
        border-radius: 9999px;
        font-size: 0.875rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .status-approved {
        background-color: #dcfce7;
        color: #166534;
        border: 1px solid #86efac;
    }

    .status-pending {
        background-color: #fef3c7;
        color: #92400e;
        border: 1px solid #fcd34d;
    }

    .status-repaid {
        background-color: #dbeafe;
        color: #1e40af;
        border: 1px solid #93c5fd;
    }

    .pay-button {
        background: linear-gradient(to right, #3b82f6, #2563eb);
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 0.5rem;
        font-weight: 500;
        transition: all 0.2s;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .pay-button:hover {
        background: linear-gradient(to right, #2563eb, #1d4ed8);
        transform: translateY(-1px);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
</style>
@endpush

@section('content')
<div class="flex-1 overflow-hidden">
    <!-- Header -->
    <header class="bg-white shadow-sm border-b border-gray-200 px-6 py-4">
        <div class="flex items-center justify-center">
            <h1 class="text-2xl font-semibold custom-font text-black">
                <i class="fa-solid fa-file-invoice-dollar mr-2 text-blue-600 !important"></i>
                Loan History
            </h1>
        </div>
    </header>

    <!-- Main Content -->
    <main class="p-6 overflow-auto h-[calc(100vh-4rem)]">
        <div class="max-w-7xl mx-auto animate-fade-in">
            <!-- Loan History Table -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h2 class="text-lg font-semibold text-black">Loan Details</h2>
                </div>
                <div class="table-container overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Serial</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Loan Amount (BDT)</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Approve Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Due Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($loans as $index => $loan)
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ number_format($loan->amount) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $loan->approve_date ? $loan->approve_date->format('M d, Y') : 'Not Approved' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $loan->return_time ? $loan->return_time->format('M d, Y') : 'Not Set' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="status-badge 
                                            @if($loan->status === 'approved') status-approved
                                            @elseif($loan->status === 'pending') status-pending
                                            @elseif($loan->status === 'repaid') status-repaid
                                            @endif">
                                            {{ ucfirst($loan->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        @if($loan->status === 'approved')
                                            <button class="pay-button">
                                                Pay
                                            </button>
                                        @else
                                            <span class="text-gray-400">N/A</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">No loan history found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection 