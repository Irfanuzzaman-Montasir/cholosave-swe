@extends('layouts.app')

@section('title', 'Create New Group - CholoSave')

@section('content')
<div class="create-group-container">
    <div class="create-group-card">
        <form id="groupForm" method="POST" action="{{ route('groups.store') }}" class="form">
            @csrf
            <div class="form-two-columns">
                <div class="form-column">
                    <h2 class="form-title">Basic Group Information</h2>
                    <div class="form-group">
                        <label for="group_name" class="form-label">Group Name</label>
                        <input type="text" id="group_name" name="group_name" class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label for="description" class="form-label">Description</label>
                        <textarea id="description" name="description" class="form-input" rows="4" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="members" class="form-label">Number of Members</label>
                        <input type="number" id="members" name="members" class="form-input" min="2" required>
                    </div>
                    <h2 class="form-title">DPS Details</h2>
                    <div class="form-group">
                        <label for="dps_type" class="form-label">DPS Type</label>
                        <select id="dps_type" name="dps_type" class="form-input" required>
                            <option value="">Select Type</option>
                            <option value="weekly">Weekly</option>
                            <option value="monthly">Monthly</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="time_period" class="form-label">Time Period (in months)</label>
                        <input type="number" id="time_period" name="time_period" class="form-input" min="1" required>
                    </div>
                    <div class="form-group">
                        <label for="amount" class="form-label">Amount per Period</label>
                        <input type="number" id="amount" name="amount" class="form-input" min="0" step="0.01" required>
                    </div>
                    <div class="form-group">
                        <label for="start_date" class="form-label">Start Date</label>
                        <input type="date" id="start_date" name="start_date" class="form-input" required>
                    </div>
                </div>
                <div class="form-column">
                    <h2 class="form-title">Payment Methods</h2>
                    <div class="form-group">
                        <label for="bKash" class="form-label">bKash Number</label>
                        <input type="text" id="bKash" name="bKash" class="form-input">
                    </div>
                    <div class="form-group">
                        <label for="Rocket" class="form-label">Rocket Number</label>
                        <input type="text" id="Rocket" name="Rocket" class="form-input">
                    </div>
                    <div class="form-group">
                        <label for="Nagad" class="form-label">Nagad Number</label>
                        <input type="text" id="Nagad" name="Nagad" class="form-input">
                    </div>
                    <h2 class="form-title">Financial Goals</h2>
                    <div class="form-group">
                        <label for="goal_amount" class="form-label">Goal Amount</label>
                        <input type="number" id="goal_amount" name="goal_amount" class="form-input" min="0" step="0.01" required>
                    </div>
                    <div class="form-group">
                        <label for="emergency_fund" class="form-label">Emergency Fund</label>
                        <input type="number" id="emergency_fund" name="emergency_fund" class="form-input" min="0" step="0.01" required>
                    </div>
                </div>
            </div>
            <div class="form-actions" style="justify-content: flex-end;">
                <button type="submit" class="btn-submit">Create Group</button>
            </div>
        </form>
    </div>
</div>

<style>
.create-group-container {
    min-height: calc(100vh - 5rem);
    background-color: #f4f7f9;
    padding: 2rem 1rem;
}
.create-group-card {
    max-width: 900px;
    margin: 0 auto;
    background: white;
    border-radius: 1rem;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    padding: 2rem;
}
.form-two-columns {
    display: flex;
    gap: 2rem;
    flex-wrap: wrap;
}
.form-column {
    flex: 1;
    min-width: 300px;
}
.form-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: #1E40AF;
    margin-bottom: 1rem;
    margin-top: 2rem;
}
.form-group {
    margin-bottom: 1.5rem;
}
.form-label {
    display: block;
    font-size: 0.875rem;
    font-weight: 500;
    color: #4B5563;
    margin-bottom: 0.5rem;
}
.form-input {
    width: 100%;
    padding: 0.75rem 1rem;
    border: 1px solid #E5E7EB;
    border-radius: 0.5rem;
    font-family: 'Poppins', sans-serif;
    transition: all 0.3s ease;
}
.form-input:focus {
    outline: none;
    border-color: #1E40AF;
    box-shadow: 0 0 0 3px rgba(30, 64, 175, 0.1);
}
.form-actions {
    display: flex;
    margin-top: 2rem;
}
.btn-submit {
    padding: 0.75rem 1.5rem;
    border-radius: 0.5rem;
    font-weight: 600;
    cursor: pointer;
    background: linear-gradient(135deg, #1E40AF 0%, #1E3A8A 100%);
    color: white;
    transition: all 0.3s ease;
}
.btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
}
</style>
@endsection 