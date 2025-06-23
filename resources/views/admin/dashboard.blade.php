@extends('layouts.site_admin')

@section('title', 'Site Admin Dashboard - CholoSave')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8">Site Admin Dashboard</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold mb-2">Total Users</h3>
            <p class="text-3xl font-bold text-indigo-600">{{ $totalUsers }}</p>
        </div>
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold mb-2">Active Savings</h3>
            <p class="text-3xl font-bold text-green-600">{{ number_format($totalSavings, 2) }}</p>
        </div>
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold mb-2">Total Transactions</h3>
            <p class="text-3xl font-bold text-blue-600">{{ $totalTransactions }}</p>
        </div>
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold mb-2">Total Groups</h3>
            <p class="text-3xl font-bold text-purple-600">{{ $totalGroups }}</p>
        </div>
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold mb-2">Total Investments</h3>
            <p class="text-3xl font-bold text-yellow-600">{{ number_format($totalInvestments, 2) }}</p>
        </div>
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold mb-2">Total Reports</h3>
            <p class="text-3xl font-bold text-red-600">{{ $totalReports }}</p>
        </div>
    </div>

    <!-- Analytics Graph -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-2xl font-bold">Analytics (Last 6 Months)</h2>
            <select id="graphFilter" class="border border-gray-300 rounded px-2 py-1">
                <option value="users">Members</option>
                <option value="savings">Savings</option>
                <option value="transactions">Transactions</option>
            </select>
        </div>
        <canvas id="adminAnalyticsChart" height="100"></canvas>
    </div>
</div>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const months = @json($months);
    const usersPerMonth = @json($usersPerMonth);
    const savingsPerMonth = @json($savingsPerMonth);
    const transactionsPerMonth = @json($transactionsPerMonth);

    let chart;
    function renderChart(type) {
        let data, label, bgColor;
        if (type === 'users') {
            data = usersPerMonth;
            label = 'New Members';
            bgColor = 'rgba(99, 102, 241, 0.7)';
        } else if (type === 'savings') {
            data = savingsPerMonth;
            label = 'Savings (BDT)';
            bgColor = 'rgba(16, 185, 129, 0.7)';
        } else {
            data = transactionsPerMonth;
            label = 'Transactions';
            bgColor = 'rgba(59, 130, 246, 0.7)';
        }
        const ctx = document.getElementById('adminAnalyticsChart').getContext('2d');
        if (chart) chart.destroy();
        chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: months,
                datasets: [{
                    label: label,
                    data: data,
                    backgroundColor: bgColor,
                    borderRadius: 8,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false },
                    title: { display: false }
                },
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    }
    document.addEventListener('DOMContentLoaded', function() {
        renderChart('users');
        document.getElementById('graphFilter').addEventListener('change', function() {
            renderChart(this.value);
        });
    });
</script>
@endsection 