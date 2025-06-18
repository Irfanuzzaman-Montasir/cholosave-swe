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
            <div class="card mb-4 stats-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Total Savings</h6>
                            <h3 class="mb-0" id="savings-counter">${{ number_format($stats['totalSavings'], 2) }}</h3>
                            <small class="text-success">+${{ number_format($stats['thisMonthSavings'], 2) }} this month</small>
                        </div>
                        <div class="text-success">
                            <i class="fas fa-wallet fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card mb-4 stats-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Total Members</h6>
                            <h3 class="mb-0" id="members-counter">{{ number_format($stats['totalMembers']) }}</h3>
                            <small class="text-primary">+{{ $stats['newMembers'] }} new this month</small>
                        </div>
                        <div class="text-primary">
                            <i class="fas fa-users fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card mb-4 stats-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Total Groups</h6>
                            <h3 class="mb-0" id="groups-counter">{{ number_format($stats['totalGroups']) }}</h3>
                            <small class="text-purple">Active Groups</small>
                        </div>
                        <div class="text-purple">
                            <i class="fas fa-users-rectangle fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card mb-4 stats-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Total Investments</h6>
                            <h3 class="mb-0" id="investments-counter">${{ number_format($stats['totalInvestments'], 2) }}</h3>
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
            <div class="card mb-4 stats-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Total Reports</h6>
                            <h3 class="mb-0" id="reports-counter">{{ number_format($stats['totalReports']) }}</h3>
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
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="card-title mb-0">Analytics Overview</h5>
                        <div class="d-flex align-items-center">
                            <select class="form-select me-2" id="dataSelect">
                                <option value="users">New Users</option>
                                <option value="savings">Total Savings</option>
                                <option value="investments">Investments</option>
                                <option value="reports">Contact Reports</option>
                            </select>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-primary chart-type-btn selected" data-type="bar">Bar</button>
                                <button type="button" class="btn btn-outline-primary chart-type-btn" data-type="line">Line</button>
                            </div>
                        </div>
                    </div>
                    <div style="height: 400px;">
                        <canvas id="analyticsChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const chartData = @json($analyticsData);
    let currentChart = null;

    // Counter animation function
    function animateCounter(element, target, duration = 2000, prefix = '') {
        let start = 0;
        const increment = target / (duration / 16);
        const animate = () => {
            start += increment;
            if (start < target) {
                element.textContent = prefix + Math.floor(start).toLocaleString();
                requestAnimationFrame(animate);
            } else {
                element.textContent = prefix + target.toLocaleString();
            }
        };
        animate();
    }

    // Initialize counter animations
    const stats = {
        savings: {{ $stats['totalSavings'] }},
        members: {{ $stats['totalMembers'] }},
        groups: {{ $stats['totalGroups'] }},
        investments: {{ $stats['totalInvestments'] }},
        reports: {{ $stats['totalReports'] }}
    };

    animateCounter(document.getElementById('savings-counter'), stats.savings, 2000, '$');
    animateCounter(document.getElementById('members-counter'), stats.members);
    animateCounter(document.getElementById('groups-counter'), stats.groups);
    animateCounter(document.getElementById('investments-counter'), stats.investments, 2000, '$');
    animateCounter(document.getElementById('reports-counter'), stats.reports);

    function createChart(type = 'bar', dataKey = 'users') {
        const ctx = document.getElementById('analyticsChart').getContext('2d');
        
        if (currentChart) {
            currentChart.destroy();
        }

        const colors = {
            users: {
                background: 'rgba(59, 130, 246, 0.2)',
                border: 'rgb(59, 130, 246)'
            },
            savings: {
                background: 'rgba(16, 185, 129, 0.2)',
                border: 'rgb(16, 185, 129)'
            },
            investments: {
                background: 'rgba(139, 92, 246, 0.2)',
                border: 'rgb(139, 92, 246)'
            },
            reports: {
                background: 'rgba(239, 68, 68, 0.2)',
                border: 'rgb(239, 68, 68)'
            }
        };

        const options = {
            responsive: true,
            maintainAspectRatio: false,
            animation: {
                duration: 1000,
                easing: 'easeInOutQuart'
            },
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: 'rgba(255, 255, 255, 0.9)',
                    titleColor: '#1f2937',
                    bodyColor: '#1f2937',
                    borderColor: '#e5e7eb',
                    borderWidth: 1,
                    padding: 12,
                    displayColors: false,
                    callbacks: {
                        label: function(context) {
                            const value = context.parsed.y;
                            if (dataKey === 'savings' || dataKey === 'investments') {
                                return `$${value.toLocaleString('en-US', {
                                    minimumFractionDigits: 2,
                                    maximumFractionDigits: 2
                                })}`;
                            }
                            return value.toLocaleString('en-US');
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            if (dataKey === 'savings' || dataKey === 'investments') {
                                return '$' + value.toLocaleString('en-US');
                            }
                            return value;
                        }
                    }
                }
            }
        };

        currentChart = new Chart(ctx, {
            type: type,
            data: {
                labels: chartData.labels,
                datasets: [{
                    data: chartData[dataKey],
                    backgroundColor: colors[dataKey].background,
                    borderColor: colors[dataKey].border,
                    borderWidth: type === 'bar' ? 2 : 3,
                    tension: type === 'line' ? 0.3 : 0,
                    fill: true
                }]
            },
            options: options
        });
    }

    // Initialize chart
    createChart('bar', 'users');

    // Event listeners for chart controls
    document.querySelectorAll('.chart-type-btn').forEach(button => {
        button.addEventListener('click', function() {
            document.querySelectorAll('.chart-type-btn').forEach(btn => {
                btn.classList.remove('selected');
                btn.classList.remove('btn-primary');
                btn.classList.add('btn-outline-primary');
            });
            this.classList.add('selected');
            this.classList.remove('btn-outline-primary');
            this.classList.add('btn-primary');
            createChart(this.dataset.type, document.getElementById('dataSelect').value);
        });
    });

    document.getElementById('dataSelect').addEventListener('change', function() {
        const chartType = document.querySelector('.chart-type-btn.selected').dataset.type;
        createChart(chartType, this.value);
    });

    // Responsive resize handling
    let resizeTimer;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function() {
            const chartType = document.querySelector('.chart-type-btn.selected').dataset.type;
            const dataType = document.getElementById('dataSelect').value;
            createChart(chartType, dataType);
        }, 250);
    });
});
</script>
@endpush

@push('styles')
<style>
.text-purple {
    color: #6f42c1;
}

.stats-card {
    transition: transform 0.2s ease-in-out;
}

.stats-card:hover {
    transform: translateY(-5px);
}

.chart-type-btn.selected {
    background-color: #0d6efd;
    color: white;
    border-color: #0d6efd;
}
</style>
@endpush
@endsection 