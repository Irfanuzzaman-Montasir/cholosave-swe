@extends('layouts.app')

@section('title', 'AI Financial Assistant')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
<style>
    body { font-family: 'Inter', sans-serif; }
    @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
    .animate-fade-in { animation: fadeIn 0.3s ease-out forwards; }
    .glass-card {
        background: rgba(255,255,255,0.8);
        backdrop-filter: blur(10px);
        border-radius: 1rem;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        border: 1px solid rgba(255,255,255,0.3); /* Added a subtle border */
    }
    /* Ensure content within columns doesn't overflow */
    .glass-card > div {
        overflow: hidden; /* Hide overflow to prevent inner content from expanding parent */
    }
    /* Specific styling for list items inside AI response to prevent overflow */
    #ai-response ul li {
        word-wrap: break-word; /* Ensure long words break and wrap */
        white-space: normal; /* Allow text to wrap normally */
    }
</style>
<script>
    window.FINANCIAL_DATA = @json($financialData);
    window.CSRF_TOKEN = '{{ csrf_token() }}';
</script>
<div class="container mx-auto max-w-6xl mt-16 px-4"> {{-- Added horizontal padding here --}}
    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6 rounded-md"> {{-- Added rounded-md for consistency --}}
        <div class="flex items-center"> {{-- Added items-center for vertical alignment --}}
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.494-1.646-1.742-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3 flex-1 min-w-0"> {{-- Added flex-1 min-w-0 to ensure text wraps properly --}}
                <p class="text-sm text-yellow-700">
                    <strong>Caution:</strong> AI-generated financial advice is for informational purposes only.
                    Always consult with a professional financial advisor before making important financial decisions.
                </p>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-start"> {{-- Added items-start to align cards at the top --}}
        <div class="md:col-span-1 glass-card p-6 flex flex-col"> {{-- Added flex flex-col to make content fill height if needed --}}
            <h2 class="text-xl font-semibold mb-4 text-gray-700 border-b pb-2">Savings Overview</h2>
            <div class="space-y-3 flex-grow" id="savings-overview"> {{-- Added flex-grow --}}
                </div>
            <div class="mt-6">
                <h3 class="text-lg font-semibold mb-3 text-gray-700 border-b pb-2">Group Contributions</h3>
                <div class="space-y-2" id="group-contributions">
                    </div>
            </div>
        </div>
        <div class="md:col-span-2 glass-card p-6 flex flex-col"> {{-- Added flex flex-col --}}
            <h2 class="text-xl font-semibold mb-4 text-gray-700 border-b pb-2">AI Financial Guidance</h2>
            <div class="grid md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="savings-type" class="block text-sm font-medium text-gray-700 mb-2">Savings Type</label>
                    <select id="savings-type" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 transition p-2"> {{-- Added p-2 for better padding --}}
                        <option value="individual">Individual Savings</option>
                        <option value="group">Group Savings</option>
                    </select>
                </div>
                <div id="group-selection" class="hidden">
                    <label for="group-id" class="block text-sm font-medium text-gray-700 mb-2">Choose Group</label>
                    <select id="group-id" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 transition p-2"> {{-- Added p-2 --}}
                        <option value="all">All Groups</option>
                        </select>
                </div>
            </div>
            <div class="mb-4">
                <label for="question-select" class="block text-sm font-medium text-gray-700 mb-2">Financial Question</label>
                <select id="question-select" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 transition p-2"> {{-- Added p-2 --}}
                    <option value="financial_health">What is my financial health?</option>
                    <option value="budgeting">How can I improve my budgeting?</option>
                    <option value="investment_advice">What are the best investment options for me over [Time Period] in [Investment Type]?</option>
                    <option value="savings_strategy">What savings strategy should I follow?</option>
                    <option value="risk_management">How should I manage my financial risks?</option>
                    <option value="custom">Custom Question</option>
                </select>
            </div>
            <div id="investment-options" class="mb-4">
                <div class="mb-4">
                    <label for="investment-time" class="block text-sm font-medium text-gray-700 mb-2">Investment Time Period</label>
                    <div class="flex items-center gap-2">
                        <input type="number" id="investment-time" class="w-20 border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 transition p-2" placeholder="1" value="1"> {{-- Added p-2 --}}
                        <select id="investment-duration" class="w-32 border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 transition p-2"> {{-- Added p-2 --}}
                            <option value="month">Month</option>
                            <option value="year">Year</option>
                        </select>
                    </div>
                </div>
                <div class="mb-4">
                    <label for="investment-type" class="block text-sm font-medium text-gray-700 mb-2">Investment Type</label>
                    <input type="text" id="investment-type" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 transition p-2" placeholder="Enter investment type..."> {{-- Added p-2 --}}
                </div>
            </div>
            <div id="custom-question-block" class="mb-4 hidden">
                <label for="custom-question" class="block text-sm font-medium text-gray-700 mb-2">Your Question:</label>
                <input type="text" id="custom-question" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 transition p-2" placeholder="Type your question here..."> {{-- Added p-2 --}}
            </div>
            <button id="get-result" class="w-full bg-blue-500 text-white py-3 rounded-lg hover:bg-blue-600 transition font-semibold shadow-md">Get Financial Advice</button>
            <div id="ai-response" class="mt-6 hidden flex-grow overflow-auto"> {{-- Added flex-grow and overflow-auto for response section --}}
                {{-- Dynamic content will be placed here --}}
            </div>
        </div>
    </div>
</div>
<script>
function displayAdvice(result) {
    const aiResponse = document.getElementById('ai-response');
    const advice = result.advice;
    // Changed to use non-breaking space for bullet points to prevent layout issues with long text.
    // Also ensuring lists are properly structured and styled for better readability.
    const formattedSteps = advice.steps
        .map(step => `<li class="flex items-start text-gray-700"><span class="mr-2">•</span><span class="flex-1">${step.replace(/^\*/, '').trim()}</span></li>`)
        .join('');
    aiResponse.innerHTML = `
        <div class="space-y-6 animate-fade-in h-full"> {{-- Ensure response container takes full height and animates --}}
            <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100 h-full flex flex-col"> {{-- Added flex flex-col and h-full --}}
                <h3 class="text-xl font-bold mb-4 text-gray-800">${advice.title || 'Financial Advice'}</h3>
                <p class="text-lg text-gray-700 mb-4">${advice.main_advice}</p>
                <div class="mt-4 flex-grow overflow-auto"> {{-- Added flex-grow and overflow-auto for scrollable content --}}
                    <h4 class="font-semibold mb-2 text-gray-700">Action Steps:</h4>
                    <ul class="space-y-2 pl-2"> {{-- Adjusted padding for custom bullets --}}
                        ${formattedSteps}
                    </ul>
                </div>
            </div>
        </div>
    `;
}
document.addEventListener('DOMContentLoaded', () => {
    const data = window.FINANCIAL_DATA;
    // Savings Overview
    document.getElementById('savings-overview').innerHTML = `
        <div class="flex justify-between items-center py-1"> {{-- Added vertical padding --}}
            <span class="text-gray-600">Total Savings</span>
            <span class="font-bold text-green-600">৳${parseFloat(data.individual_savings).toLocaleString(undefined, {minimumFractionDigits:2, maximumFractionDigits:2})}</span>
        </div>
        <div class="flex justify-between items-center py-1"> {{-- Added vertical padding --}}
            <span class="text-gray-600">Monthly Savings</span>
            <span class="font-bold text-blue-600">৳${parseFloat(data.monthly_savings).toLocaleString(undefined, {minimumFractionDigits:2, maximumFractionDigits:2})}</span>
        </div>
    `;
    // Group Contributions
    document.getElementById('group-contributions').innerHTML = data.group_contributions.map(group => `
        <div class="flex items-center justify-between py-1"> {{-- Added vertical padding --}}
            <span class="text-sm text-gray-600">${group.group_name}</span>
            <span class="text-sm font-bold text-indigo-600">৳${parseFloat(group.user_contribution).toLocaleString(undefined, {minimumFractionDigits:2, maximumFractionDigits:2})} / ৳${parseFloat(group.total_contribution).toLocaleString(undefined, {minimumFractionDigits:2, maximumFractionDigits:2})}</span>
        </div>
    `).join('');
    // Populate group selection
    const groupSelect = document.getElementById('group-id');
    if (groupSelect) {
        data.group_contributions.forEach(group => {
            const opt = document.createElement('option');
            opt.value = group.group_id;
            opt.textContent = group.group_name;
            groupSelect.appendChild(opt);
        });
    }
    // Show/hide group selection
    document.getElementById('savings-type').addEventListener('change', () => {
        const groupSelection = document.getElementById('group-selection');
        groupSelection.classList.toggle('hidden', document.getElementById('savings-type').value !== 'group');
    });
    // Show/hide custom question
    document.getElementById('question-select').addEventListener('change', function () {
        document.getElementById('custom-question-block').classList.toggle('hidden', this.value !== 'custom');
    });
    document.getElementById('get-result').addEventListener('click', async () => {
        const questionSelect = document.getElementById('question-select');
        let question = questionSelect.value === 'custom'
            ? document.getElementById('custom-question').value.trim()
            : questionSelect.value;
        // Input validation: prevent prompt injection and abuse
        if (!question) {
            alert('Please select or write a question.');
            return;
        }
        // Limit question length and sanitize
        if (question.length > 300) {
            alert('Your question is too long. Please keep it under 300 characters.');
            return;
        }
        // Basic sanitization: remove dangerous characters
        question = question.replace(/[<>\n\r]/g, '');
        const aiResponse = document.getElementById('ai-response');
        aiResponse.classList.remove('hidden');
        aiResponse.innerHTML = '<div class="flex items-center justify-center p-4"><div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-500"></div><span class="ml-2 text-gray-700">Analyzing financial data...</span></div>';
        const savingsType = document.getElementById('savings-type').value;
        const selectedGroupId = document.getElementById('group-id') ? document.getElementById('group-id').value : null;
        const investmentTime = document.getElementById('investment-time')?.value || null;
        const investmentDuration = document.getElementById('investment-duration')?.value || null;
        const investmentType = document.getElementById('investment-type')?.value || null;
        const payload = {
            savings_type: savingsType,
            group_id: selectedGroupId !== 'all' ? selectedGroupId : null,
            savings_data: data,
            question, // sanitized
            investment_time: investmentTime,
            investment_duration: investmentDuration,
            investment_type: investmentType,
            all_groups_data: selectedGroupId === 'all' ? data.group_contributions : null
        };
        try {
            const response = await fetch('http://localhost:5000/generate_tips', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': window.CSRF_TOKEN // Attach CSRF token for security
                },
                body: JSON.stringify(payload)
            });
            if (!response.ok) {
                const errorData = await response.json();
                throw new Error(errorData.error || 'Failed to generate advice');
            }
            const result = await response.json();
            if (result.status === 'success') {
                displayAdvice(result);
            } else {
                throw new Error(result.error || 'Failed to generate advice');
            }
        } catch (err) {
            aiResponse.innerHTML = `<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">Error: ${err.message}</div>`;
        }
    });
});
</script>
@endsection