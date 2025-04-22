@extends('layouts.app')

@section('title', 'Dashboard - CholoSave')

@section('content')
<style>
    .dashboard-container {
        min-height: calc(100vh - 5rem);
        background-color: #f4f7f9;
        padding: 2rem 1rem;
    }

    .welcome-section {
        background: linear-gradient(135deg, #1E40AF 0%, #1E3A8A 100%);
        border-radius: 1rem;
        padding: 2rem;
        color: white;
        margin-bottom: 2rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .welcome-title {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .welcome-subtitle {
        font-size: 1.1rem;
        opacity: 0.9;
    }

    .dashboard-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1.5rem;
        margin-top: 2rem;
    }

    .dashboard-card {
        background: white;
        border-radius: 0.75rem;
        padding: 1.5rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        transition: transform 0.3s ease;
    }

    .dashboard-card:hover {
        transform: translateY(-5px);
    }

    .card-header {
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
    }

    .card-icon {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, #1E40AF 0%, #1E3A8A 100%);
        border-radius: 0.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        margin-right: 1rem;
    }

    .card-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: #1E40AF;
    }

    .card-content {
        color: #4B5563;
        line-height: 1.6;
    }

    .quick-actions {
        display: flex;
        gap: 1rem;
        margin-top: 1rem;
    }

    .action-button {
        padding: 0.5rem 1rem;
        background: #1E40AF;
        color: white;
        border-radius: 0.375rem;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .action-button:hover {
        background: #1E3A8A;
        transform: translateY(-2px);
    }
</style>

<div class="dashboard-container">
    <div class="welcome-section">
        <h1 class="welcome-title">Welcome back, {{ Auth::user()->name }}!</h1>
        <p class="welcome-subtitle">Here's what's happening with your savings and investments today.</p>
    </div>

    <div class="dashboard-grid">
        <div class="dashboard-card">
            <div class="card-header">
                <div class="card-icon">
                    <i class="fas fa-piggy-bank"></i>
                </div>
                <h3 class="card-title">Total Savings</h3>
            </div>
            <div class="card-content">
                <p>Track your total savings across all groups and individual accounts.</p>
                <div class="quick-actions">
                    <a href="#" class="action-button">View Details</a>
                    <a href="#" class="action-button">Add Savings</a>
                </div>
            </div>
        </div>

        <div class="dashboard-card">
            <div class="card-header">
                <div class="card-icon">
                    <i class="fas fa-users"></i>
                </div>
                <h3 class="card-title">Active Groups</h3>
            </div>
            <div class="card-content">
                <p>Manage your savings groups and see their progress.</p>
                <div class="quick-actions">
                    <a href="#" class="action-button">View Groups</a>
                    <a href="#" class="action-button">Join Group</a>
                </div>
            </div>
        </div>

        <div class="dashboard-card">
            <div class="card-header">
                <div class="card-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <h3 class="card-title">Investment Portfolio</h3>
            </div>
            <div class="card-content">
                <p>Monitor your investments and track their performance.</p>
                <div class="quick-actions">
                    <a href="#" class="action-button">View Portfolio</a>
                    <a href="#" class="action-button">New Investment</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 