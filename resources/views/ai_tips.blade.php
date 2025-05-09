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
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Populate Savings Overview
    const data = window.FINANCIAL_DATA;
    document.getElementById('savings-overview').innerHTML = `
        <div class="mb-2 d-flex justify-content-between">
            <span>Total Savings</span>
            <span class="fw-bold text-success">৳${parseFloat(data.individual_savings).toFixed(2)}</span>
        </div>
        <div class="mb-2 d-flex justify-content-between">
            <span>Monthly Savings</span>
            <span class="fw-bold text-primary">৳${parseFloat(data.monthly_savings).toFixed(2)}</span>
        </div>
        <div class="mt-3">
            <strong>Group Contributions</strong>
            <ul class="list-unstyled mt-2">
                ${data.group_contributions.map(group => `
                    <li>
                        <span>${group.group_name}:</span>
                        <span class="text-info fw-bold">৳${parseFloat(group.user_contribution).toFixed(2)}</span>
                        <span>/ ৳${parseFloat(group.total_contribution).toFixed(2)}</span>
                    </li>
                `).join('')}
            </ul>
        </div>
    `;

    // Populate group selection
    const groupSelect = document.getElementById('group-id');
    data.group_contributions.forEach(group => {
        const opt = document.createElement('option');
        opt.value = group.group_id;
        opt.textContent = group.group_name;
        groupSelect.appendChild(opt);
    });

    // Show/hide group selection
    document.getElementById('savings-type').addEventListener('change', function () {
        document.getElementById('group-selection-wrapper').classList.toggle('d-none', this.value !== 'group');
    });

    // Show/hide custom question
    document.getElementById('question-select').addEventListener('change', function () {
        document.getElementById('custom-question-block').classList.toggle('d-none', this.value !== 'custom');
    });

    // Handle form submission
    document.getElementById('get-result').addEventListener('click', async function () {
        const savingsType = document.getElementById('savings-type').value;
        const groupId = groupSelect.value;
        const questionSelect = document.getElementById('question-select').value;
        const customQuestion = document.getElementById('custom-question').value;
        const investmentTime = document.getElementById('investment-time').value;
        const investmentDuration = document.getElementById('investment-duration').value;
        const investmentType = document.getElementById('investment-type').value;

        const question = questionSelect === 'custom' ? customQuestion : questionSelect;

        const payload = {
            savings_type: savingsType,
            group_id: groupId !== 'all' ? groupId : null,
            savings_data: data,
            question: question,
            investment_time: investmentTime,
            investment_duration: investmentDuration,
            investment_type: investmentType,
            all_groups_data: groupId === 'all' ? data.group_contributions : null
        };

        const aiResponse = document.getElementById('ai-response');
        aiResponse.classList.remove('d-none');
        aiResponse.innerHTML = '<div class="text-center p-3"><span class="spinner-border"></span> Analyzing financial data...</div>';

        try {
            const response = await fetch('http://localhost:5000/generate_tips', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(payload)
            });
            const result = await response.json();
            if (result.status === 'success') {
                aiResponse.innerHTML = `
                    <div class="card mt-3">
                        <div class="card-body">
                            <h5 class="card-title">${result.advice.title || 'Financial Advice'}</h5>
                            <p>${result.advice.main_advice}</p>
                            <ul>
                                ${result.advice.steps.map(step => `<li>${step}</li>`).join('')}
                            </ul>
                        </div>
                    </div>
                `;
            } else {
                aiResponse.innerHTML = `<div class="alert alert-danger">${result.error || 'Failed to generate advice.'}</div>`;
            }
        } catch (err) {
            aiResponse.innerHTML = `<div class="alert alert-danger">Error: ${err.message}</div>`;
        }
    });
});
</script>
@endsection 