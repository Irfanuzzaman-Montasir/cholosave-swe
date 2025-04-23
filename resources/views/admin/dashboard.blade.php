@extends('layouts.admin')

@section('title', 'Admin Dashboard - CholoSave')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4">Welcome back, Admin!</h2>
            <p class="text-muted">Here's what's happening with your platform today.</p>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mt-4">
        <div class="col-md-3">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Total Savings</h6>
                            <h3 class="mb-0">${{ number_format($totalSavings) }}</h3>
                            <small class="text-success">+${{ number_format($savingsThisMonth) }} this month</small>
                        </div>
                        <div class="text-success">
                            <i class="fas fa-wallet fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Total Members</h6>
                            <h3 class="mb-0">{{ $totalMembers }}</h3>
                            <small class="text-primary">+{{ $newMembersThisMonth }} new this month</small>
                        </div>
                        <div class="text-primary">
                            <i class="fas fa-users fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Total Groups</h6>
                            <h3 class="mb-0">{{ $totalGroups }}</h3>
                            <small class="text-purple">Active Groups</small>
                        </div>
                        <div class="text-purple">
                            <i class="fas fa-users-cog fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Total Investments</h6>
                            <h3 class="mb-0">${{ number_format($currentInvestments) }}</h3>
                            <small class="text-warning">Current Period</small>
                        </div>
                        <div class="text-warning">
                            <i class="fas fa-chart-line fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Reports Card -->
    <div class="row">
        <div class="col-md-3">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Total Reports</h6>
                            <h3 class="mb-0">{{ $totalReports }}</h3>
                            <small class="text-danger">User Reports</small>
                        </div>
                        <div class="text-danger">
                            <i class="fas fa-flag fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Analytics Section -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Savings Overview</h5>
                    <div class="mt-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6>Analytics Overview</h6>
                            <div class="d-flex align-items-center">
                                <select class="form-select me-2" id="chartType">
                                    <option selected>New Users</option>
                                    <option>Savings</option>
                                    <option>Investments</option>
                                </select>
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-primary active" data-chart-style="bar">Bar</button>
                                    <button type="button" class="btn btn-outline-primary" data-chart-style="line">Line</button>
                                </div>
                            </div>
                        </div>
                        <div style="height: 300px;">
                            <canvas id="analyticsChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const monthlyData = @json($monthlyUsers);
    const labels = monthlyData.map(item => item.month);
    const data = monthlyData.map(item => item.count);

    const ctx = document.getElementById('analyticsChart').getContext('2d');
    let chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'New Users',
                data: data,
                backgroundColor: 'rgba(66, 133, 244, 0.2)',
                borderColor: 'rgb(66, 133, 244)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });

    // Handle chart style switching
    document.querySelectorAll('[data-chart-style]').forEach(button => {
        button.addEventListener('click', function() {
            const chartStyle = this.dataset.chartStyle;
            chart.config.type = chartStyle;
            chart.update();

            // Update button states
            document.querySelectorAll('[data-chart-style]').forEach(btn => {
                btn.classList.remove('active');
                btn.classList.add('btn-outline-primary');
                btn.classList.remove('btn-primary');
            });
            this.classList.add('active');
            this.classList.remove('btn-outline-primary');
            this.classList.add('btn-primary');
        });
    });
});
</script>
@endpush

@push('styles')
<style>
.text-purple {
    color: #6f42c1;
}
.btn-group .btn.active {
    background-color: #0d6efd;
    color: white;
}
</style>
@endpush
@endsection 