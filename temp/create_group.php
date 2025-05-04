@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Group</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .step {
            display: none;
        }

        .step.active {
            display: block !important;
        }

        .progress-bar {
            transition: width 0.3s ease;
        }

        .content {
            flex: 1;
        }

        footer {
            background-color: #f1f5f9;
            padding: 2rem;
            text-align: center;
            margin-top: auto;
        }
    </style>
</head>

<body class="bg-gray-50">
    <div class="content container mx-auto px-4 py-8 max-w-5xl">
        <h1 class="text-3xl font-semibold text-center text-gray-800 mb-8">Create Group</h1>

        <!-- Progress Bar -->
        <div class="w-full bg-gray-200 rounded-full h-2.5 mb-8">
            <div class="progress-bar bg-green-600 h-2.5 rounded-full" style="width: 20%"></div>
        </div>

        <!-- Step Indicators -->
        <div class="flex justify-between mb-8">
            <div class="step-indicator flex flex-col items-center">
                <div class="w-8 h-8 bg-green-600 text-white rounded-full flex items-center justify-center">1</div>
                <span class="text-sm mt-1">Group Info</span>
            </div>
            <div class="step-indicator flex flex-col items-center">
                <div class="w-8 h-8 bg-gray-300 text-gray-600 rounded-full flex items-center justify-center">2</div>
                <span class="text-sm mt-1">Plan Details</span>
            </div>
            <div class="step-indicator flex flex-col items-center">
                <div class="w-8 h-8 bg-gray-300 text-gray-600 rounded-full flex items-center justify-center">3</div>
                <span class="text-sm mt-1">Payment</span>
            </div>
            <div class="step-indicator flex flex-col items-center">
                <div class="w-8 h-8 bg-gray-300 text-gray-600 rounded-full flex items-center justify-center">4</div>
                <span class="text-sm mt-1">Regulations</span>
            </div>
            <div class="step-indicator flex flex-col items-center">
                <div class="w-8 h-8 bg-gray-300 text-gray-600 rounded-full flex items-center justify-center">5</div>
                <span class="text-sm mt-1">Review</span>
            </div>
        </div>

        <form id="groupForm" class="space-y-6" method="POST" action="{{ route('groups.store') }}">
            @csrf
            <!-- Step 1: Group Information -->
            <div class="step active" id="step1">
                <h2 class="text-xl font-medium text-green-600 mb-4">Group Information</h2>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Group Name</label>
                        <input type="text" name="group_name" required placeholder="Enter group name"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-1 focus:ring-green-500 focus:border-green-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                        <textarea name="description" required placeholder="Enter group description" rows="3"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-1 focus:ring-green-500 focus:border-green-500"></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Members</label>
                        <input type="number" name="members" required placeholder="Number of members"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-1 focus:ring-green-500 focus:border-green-500">
                    </div>
                </div>
                <div class="flex justify-end">
                    <button type="button" class="bg-green-600 text-white px-4 py-2 rounded-md" id="nextButton1">Next</button>
                </div>
            </div>

            <!-- Step 2: Plan Details -->
            <div class="step" id="step2">
                <h2 class="text-xl font-medium text-green-600 mb-4">Plan Details</h2>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">DPS Type</label>
                        <select name="dps_type" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-1 focus:ring-green-500 focus:border-green-500">
                            <option value="monthly">Monthly</option>
                            <option value="weekly">Weekly</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Time Period</label>
                        <input type="number" name="time_period" required placeholder="Enter time period (months)"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-1 focus:ring-green-500 focus:border-green-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Amount</label>
                        <input type="number" name="amount" required placeholder="Enter amount" step="0.01"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-1 focus:ring-green-500 focus:border-green-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Start Date</label>
                        <input type="date" name="start_date" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-1 focus:ring-green-500 focus:border-green-500">
                    </div>
                </div>
                <div class="flex justify-between">
                    <button type="button" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md" id="prevButton1">Previous</button>
                    <button type="button" class="bg-green-600 text-white px-4 py-2 rounded-md" id="nextButton2">Next</button>
                </div>
            </div>

            <!-- Step 3: Payment -->
            <div class="step" id="step3">
                <h2 class="text-xl font-medium text-green-600 mb-4">Payment Details</h2>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">bKash Number</label>
                        <input type="text" name="bkash_number" placeholder="Enter bKash number"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-1 focus:ring-green-500 focus:border-green-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Rocket Number</label>
                        <input type="text" name="rocket_number" placeholder="Enter Rocket number"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-1 focus:ring-green-500 focus:border-green-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nagad Number</label>
                        <input type="text" name="nagad_number" required placeholder="Enter Nagad number"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-1 focus:ring-green-500 focus:border-green-500">
                    </div>
                </div>
                <div class="flex justify-between">
                    <button type="button" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md" id="prevButton2">Previous</button>
                    <button type="button" class="bg-green-600 text-white px-4 py-2 rounded-md" id="nextButton3">Next</button>
                </div>
            </div>

            <!-- Step 4: Regulations -->
            <div class="step" id="step4">
                <h2 class="text-xl font-medium text-green-600 mb-4">Regulations</h2>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Goal Amount</label>
                        <input type="number" name="goal_amount" required placeholder="Enter goal amount" step="0.01"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-1 focus:ring-green-500 focus:border-green-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Emergency Fund</label>
                        <input type="number" name="emergency_fund" required placeholder="Enter emergency fund amount" step="0.01"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-1 focus:ring-green-500 focus:border-green-500">
                    </div>
                </div>
                <div class="flex justify-between">
                    <button type="button" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md" id="prevButton3">Previous</button>
                    <button type="button" class="bg-green-600 text-white px-4 py-2 rounded-md" id="nextButton4">Next</button>
                </div>
            </div>

            <!-- Step 5: Summary Review -->
            <div class="step" id="step5">
                <h2 class="text-xl font-medium text-green-600 mb-4">Review Group Details</h2>
                <div class="bg-white shadow-md rounded-lg p-6 space-y-4">
                    <div>
                        <h3 class="font-semibold text-gray-700">Group Information</h3>
                        <div id="summaryGroupInfo" class="bg-gray-50 p-3 rounded-md space-y-2">
                            <p><strong>Group Name:</strong> <span id="summaryGroupName"></span></p>
                            <p><strong>Description:</strong> <span id="summaryDescription"></span></p>
                            <p><strong>Members:</strong> <span id="summaryMembers"></span></p>
                        </div>
                        <button type="button" class="mt-2 text-blue-600 hover:underline" onclick="editStep(0)">Edit Group Info</button>
                    </div>

                    <div>
                        <h3 class="font-semibold text-gray-700">Plan Details</h3>
                        <div id="summaryPlanDetails" class="bg-gray-50 p-3 rounded-md space-y-2">
                            <p><strong>DPS Type:</strong> <span id="summaryDpsType"></span></p>
                            <p><strong>Time Period:</strong> <span id="summaryTimePeriod"></span></p>
                            <p><strong>Amount:</strong> <span id="summaryAmount"></span></p>
                            <p><strong>Start Date:</strong> <span id="summaryStartDate"></span></p>
                        </div>
                        <button type="button" class="mt-2 text-blue-600 hover:underline" onclick="editStep(1)">Edit Plan Details</button>
                    </div>

                    <div>
                        <h3 class="font-semibold text-gray-700">Payment Details</h3>
                        <div id="summaryPaymentDetails" class="bg-gray-50 p-3 rounded-md space-y-2">
                            <p><strong>bKash Number:</strong> <span id="summaryBkashNumber"></span></p>
                            <p><strong>Rocket Number:</strong> <span id="summaryRocketNumber"></span></p>
                            <p><strong>Nagad Number:</strong> <span id="summaryNagadNumber"></span></p>
                        </div>
                        <button type="button" class="mt-2 text-blue-600 hover:underline" onclick="editStep(2)">Edit Payment Details</button>
                    </div>

                    <div>
                        <h3 class="font-semibold text-gray-700">Regulations</h3>
                        <div id="summaryRegulations" class="bg-gray-50 p-3 rounded-md space-y-2">
                            <p><strong>Goal Amount:</strong> <span id="summaryGoalAmount"></span></p>
                            <p><strong>Emergency Fund:</strong> <span id="summaryEmergencyFund"></span></p>
                        </div>
                        <button type="button" class="mt-2 text-blue-600 hover:underline" onclick="editStep(3)">Edit Regulations</button>
                    </div>
                </div>

                <div class="flex justify-between mt-6">
                    <button type="button" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md" id="prevButton4">Previous</button>
                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-md">Confirm & Submit</button>
                </div>
            </div>
        </form>
    </div>

    @push('scripts')
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const nextButton1 = document.getElementById('nextButton1');
        const nextButton2 = document.getElementById('nextButton2');
        const nextButton3 = document.getElementById('nextButton3');
        const nextButton4 = document.getElementById('nextButton4');

        nextButton1.onclick = function() {
            document.getElementById('step1').style.display = 'none';
            document.getElementById('step2').style.display = 'block';
            document.querySelector('.progress-bar').style.width = '40%';
        }

        nextButton2.onclick = function() {
            document.getElementById('step2').style.display = 'none';
            document.getElementById('step3').style.display = 'block';
            document.querySelector('.progress-bar').style.width = '60%';
        }

        nextButton3.onclick = function() {
            document.getElementById('step3').style.display = 'none';
            document.getElementById('step4').style.display = 'block';
            document.querySelector('.progress-bar').style.width = '80%';
        }

        nextButton4.onclick = function() {
            document.getElementById('step4').style.display = 'none';
            document.getElementById('step5').style.display = 'block';
            document.querySelector('.progress-bar').style.width = '100%';
        }

        // Previous buttons
        document.getElementById('prevButton1').onclick = function() {
            document.getElementById('step2').style.display = 'none';
            document.getElementById('step1').style.display = 'block';
            document.querySelector('.progress-bar').style.width = '20%';
        }

        document.getElementById('prevButton2').onclick = function() {
            document.getElementById('step3').style.display = 'none';
            document.getElementById('step2').style.display = 'block';
            document.querySelector('.progress-bar').style.width = '40%';
        }

        document.getElementById('prevButton3').onclick = function() {
            document.getElementById('step4').style.display = 'none';
            document.getElementById('step3').style.display = 'block';
            document.querySelector('.progress-bar').style.width = '60%';
        }

        document.getElementById('prevButton4').onclick = function() {
            document.getElementById('step5').style.display = 'none';
            document.getElementById('step4').style.display = 'block';
            document.querySelector('.progress-bar').style.width = '80%';
        }

        // Edit step function
        window.editStep = function(step) {
            document.querySelectorAll('.step').forEach(s => s.style.display = 'none');
            document.getElementById('step' + (step + 1)).style.display = 'block';
            document.querySelector('.progress-bar').style.width = ((step + 1) * 20) + '%';
        }
    });
    </script>
    @endpush
</body>
</html>
@endsection
