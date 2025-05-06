@extends('layouts.app')

@section('title', 'AI Tips - CholoSave')

@section('content')
<div class="container py-5">
    <div class="alert alert-warning mb-4">
        <strong>Caution:</strong> AI-generated financial advice is for informational purposes only. Always consult with a professional financial advisor before making important financial decisions.
    </div>
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Savings Overview</h5>
                    <div id="savings-overview">
                        <!-- Populated by JS -->
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">AI Financial Guidance</h5>
                    <form id="ai-tips-form">
                        <div class="mb-3">
                            <label for="savings-type" class="form-label">Savings Type</label>
                            <select id="savings-type" class="form-select">
                                <option value="individual">Individual Savings</option>
                                <option value="group">Group Savings</option>
                            </select>
                        </div>
                        <div class="mb-3 d-none" id="group-selection-wrapper">
                            <label for="group-id" class="form-label">Choose Group</label>
                            <select id="group-id" class="form-select">
                                <option value="all">All Groups</option>
                                <!-- Populated by JS -->
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="question-select" class="form-label">Financial Question</label>
                            <select id="question-select" class="form-select">
                                <option value="financial_health">What is my financial health?</option>
                                <option value="budgeting">How can I improve my budgeting?</option>
                                <option value="investment_advice">What are the best investment options for me over [Time Period] in [Investment Type]?</option>
                                <option value="savings_strategy">What savings strategy should I follow?</option>
                                <option value="risk_management">How should I manage my financial risks?</option>
                                <option value="custom">Custom Question</option>
                            </select>
                        </div>
                        <div class="mb-3 d-none" id="custom-question-block">
                            <label for="custom-question" class="form-label">Your Question:</label>
                            <input type="text" id="custom-question" class="form-control" placeholder="Type your question here...">
                        </div>
                        <div id="investment-options" class="mb-3">
                            <label for="investment-time" class="form-label">Investment Time Period</label>
                            <div class="input-group mb-2">
                                <input type="number" id="investment-time" class="form-control" placeholder="1" value="1">
                                <select id="investment-duration" class="form-select">
                                    <option value="month">Month</option>
                                    <option value="year">Year</option>
                                </select>
                            </div>
                            <label for="investment-type" class="form-label">Investment Type</label>
                            <input type="text" id="investment-type" class="form-control" placeholder="Enter investment type...">
                        </div>
                        <button type="button" id="get-result" class="btn btn-primary w-100">Get Financial Advice</button>
                    </form>
                    <div id="ai-response" class="mt-4 d-none"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 