@extends('layouts.group_member')

@section('title', $group->group_name . ' - Member Dashboard')

@section('content')
<div class="container mx-auto px-4 py-8 bg-gray-50">
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-gray-900">Welcome, {{ auth()->user()->name }}</h2>
        <p class="text-gray-500 mt-1">Member Dashboard - {{ $group->group_name }}</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg shadow-lg p-6 text-white transform hover:scale-105 transition duration-300">
            <h5 class="text-lg font-semibold mb-2 text-blue-100">Installment Amount</h5>
            <h2 class="text-2xl font-bold">BDT {{ number_format($group->amount, 2) }}</h2>
        </div>
        <div class="bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-lg shadow-lg p-6 text-white transform hover:scale-105 transition duration-300">
            <h5 class="text-lg font-semibold mb-2 text-emerald-100">Total Members</h5>
            <h2 class="text-2xl font-bold">{{ $group->members }}</h2>
        </div>
        <div class="bg-gradient-to-br from-violet-500 to-violet-600 rounded-lg shadow-lg p-6 text-white transform hover:scale-105 transition duration-300">
            <h5 class="text-lg font-semibold mb-2 text-violet-100">DPS Type</h5>
            <h2 class="text-2xl font-bold">{{ ucfirst($group->dps_type) }}</h2>
        </div>
        <div class="bg-gradient-to-br from-amber-500 to-amber-600 rounded-lg shadow-lg p-6 text-white transform hover:scale-105 transition duration-300">
            <h5 class="text-lg font-semibold mb-2 text-amber-100">Your Status</h5>
            <h2 class="text-2xl font-bold">Active</h2>
        </div>
    </div>

    <!-- Group Details -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white rounded-lg shadow-lg hover:shadow-xl transition duration-300">
            <div class="border-b border-gray-200 px-6 py-4 bg-gradient-to-r from-gray-50 to-white">
                <h5 class="text-xl font-semibold text-gray-800">Group Information</h5>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <div class="flex justify-between py-2 border-b border-gray-100 hover:bg-gray-50 px-2 rounded transition duration-150">
                        <span class="font-medium text-gray-600">Group Name</span>
                        <span class="text-gray-800">{{ $group->group_name }}</span>
                    </div>
                    <div class="flex justify-between py-2 border-b border-gray-100 hover:bg-gray-50 px-2 rounded transition duration-150">
                        <span class="font-medium text-gray-600">DPS Type</span>
                        <span class="text-gray-800">{{ ucfirst($group->dps_type) }}</span>
                    </div>
                    <div class="flex justify-between py-2 border-b border-gray-100 hover:bg-gray-50 px-2 rounded transition duration-150">
                        <span class="font-medium text-gray-600">Installment Amount</span>
                        <span class="text-gray-800">BDT {{ number_format($group->amount, 2) }}</span>
                    </div>
                    <div class="flex justify-between py-2 border-b border-gray-100 hover:bg-gray-50 px-2 rounded transition duration-150">
                        <span class="font-medium text-gray-600">Total Members</span>
                        <span class="text-gray-800">{{ $group->members }}</span>
                    </div>
                    <div class="flex justify-between py-2 hover:bg-gray-50 px-2 rounded transition duration-150">
                        <span class="font-medium text-gray-600">Group Admin</span>
                        <span class="text-gray-800">{{ $group->admin->name }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-lg hover:shadow-xl transition duration-300">
            <div class="border-b border-gray-200 px-6 py-4 bg-gradient-to-r from-gray-50 to-white">
                <h5 class="text-xl font-semibold text-gray-800">Your Membership Details</h5>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <div class="flex justify-between py-2 border-b border-gray-100 hover:bg-gray-50 px-2 rounded transition duration-150">
                        <span class="font-medium text-gray-600">Join Date</span>
                        <span class="text-gray-800">{{ $membership->created_at->format('M d, Y') }}</span>
                    </div>
                    <div class="flex justify-between py-2 border-b border-gray-100 hover:bg-gray-50 px-2 rounded transition duration-150">
                        <span class="font-medium text-gray-600">Status</span>
                        <span class="px-3 py-1 text-sm font-semibold text-emerald-800 bg-emerald-100 rounded-full">Active</span>
                    </div>
                    <div class="flex justify-between py-2 border-b border-gray-100 hover:bg-gray-50 px-2 rounded transition duration-150">
                        <span class="font-medium text-gray-600">Last Payment</span>
                        <span class="text-gray-800">Not available</span>
                    </div>
                    <div class="flex justify-between py-2 hover:bg-gray-50 px-2 rounded transition duration-150">
                        <span class="font-medium text-gray-600">Next Payment Due</span>
                        <span class="text-gray-800">Not available</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

   
</div>
@endsection 