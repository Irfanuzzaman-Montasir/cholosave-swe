@extends('layouts.app')

@section('title', 'Admin Dashboard - CholoSave')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8">Admin Dashboard</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Statistics Cards -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold mb-2">Total Users</h3>
            <p class="text-3xl font-bold text-indigo-600">0</p>
        </div>
        
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold mb-2">Active Savings</h3>
            <p class="text-3xl font-bold text-green-600">0</p>
        </div>
        
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold mb-2">Total Transactions</h3>
            <p class="text-3xl font-bold text-blue-600">0</p>
        </div>
    </div>

    <!-- Recent Activity Section -->
    <div class="mt-8">
        <h2 class="text-2xl font-bold mb-4">Recent Activity</h2>
        <div class="bg-white rounded-lg shadow-md p-6">
            <p class="text-gray-500">No recent activity</p>
        </div>
    </div>
</div>
@endsection 