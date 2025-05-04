@extends('layouts.group_member')

@section('title', $group->group_name . ' - Member Dashboard')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="mb-0">Welcome, {{ auth()->user()->name }}</h2>
            <p class="text-muted">Member Dashboard - {{ $group->group_name }}</p>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5 class="card-title">Installment Amount</h5>
                    <h2 class="mb-0">BDT {{ number_format($group->amount, 2) }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5 class="card-title">Total Members</h5>
                    <h2 class="mb-0">{{ $group->members }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <h5 class="card-title">DPS Type</h5>
                    <h2 class="mb-0">{{ ucfirst($group->dps_type) }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <h5 class="card-title">Your Status</h5>
                    <h2 class="mb-0">Active</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Group Details -->
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Group Information</h5>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>Group Name</th>
                            <td>{{ $group->group_name }}</td>
                        </tr>
                        <tr>
                            <th>DPS Type</th>
                            <td>{{ ucfirst($group->dps_type) }}</td>
                        </tr>
                        <tr>
                            <th>Installment Amount</th>
                            <td>BDT {{ number_format($group->amount, 2) }}</td>
                        </tr>
                        <tr>
                            <th>Total Members</th>
                            <td>{{ $group->members }}</td>
                        </tr>
                        <tr>
                            <th>Group Admin</th>
                            <td>{{ $group->admin->name }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Your Membership Details</h5>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>Join Date</th>
                            <td>{{ $membership->created_at->format('M d, Y') }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td><span class="badge bg-success">Active</span></td>
                        </tr>
                        <tr>
                            <th>Last Payment</th>
                            <td>Not available</td>
                        </tr>
                        <tr>
                            <th>Next Payment Due</th>
                            <td>Not available</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Settings Section -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Settings</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('home') }}" class="btn btn-danger">
                            <i class="fas fa-sign-out-alt me-2"></i>Exit Group Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 