@extends('layouts.app')

@section('content')
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #ffffff 0%, #f8faff 100%);
            min-height: 100vh;
        }
        .group-card {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }
        .group-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
        }
        .modal-overlay { backdrop-filter: blur(4px); }
        .primary-button {
            background-color: rgb(0, 42, 196);
            transition: background-color 0.3s ease;
        }
        .primary-button:hover { background-color: #333; }
        .secondary-button {
            background: linear-gradient(135deg, #22C55E 0%, #16A34A 100%);
        }
        .secondary-button:hover {
            background: linear-gradient(135deg, #047857 0%, #065f46 100%);
        }
        .tab-button { position: relative; transition: all 0.3s ease; }
        .tab-button.active {
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .tab-button.active::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, #2563eb, #059669);
        }
        .filter-section {
            background: white;
            border-radius: 0.75rem;
            padding: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }
    </style>
<div class="container mx-auto px-4 py-0">
    {{-- Message Display --}}
    @if (session('message'))
        <div class="mb-6 p-4 rounded-lg
            {{ session('message_type') === 'success' ? 'bg-green-100 text-green-700 border border-green-200' :
                (session('message_type') === 'warning' ? 'bg-yellow-100 text-yellow-700 border border-yellow-200' :
                    'bg-blue-100 text-blue-700 border border-blue-200') }}">
            {{ session('message') }}
        </div>
    @endif

    <!-- Header Section -->
    <div class="text-center mb-0">
        <div class="inline-flex rounded-lg bg-white shadow-sm p-1 space-x-1">
            <button onclick="showGroups('all')"
                class="tab-button px-6 py-2.5 rounded-md text-sm font-medium transition-all duration-200 focus:outline-none active"
                id="all-tab">
                All Groups
            </button>
            <button onclick="showGroups('joined')"
                class="tab-button px-6 py-2.5 rounded-md text-sm font-medium transition-all duration-200 focus:outline-none"
                id="joined-tab">
                My Groups
            </button>
        </div>
    </div>

    <!-- filter and search -->
    <div class="filter-section mb-8">
        <div class="flex space-x-4">
            <!-- Search Input -->
            <div class="flex-1">
                <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Search Groups</label>
                <input type="text" id="search" name="search" placeholder="Search by group name..."
                    class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
            </div>

            <!-- DPS Type Filter -->
            <div class="w-48">
                <label for="dpsType" class="block text-sm font-medium text-gray-700 mb-2">DPS Type</label>
                <select id="dpsType" name="dpsType"
                    class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">All Types</option>
                    <option value="monthly">Monthly</option>
                    <option value="weekly">Weekly</option>
                </select>
            </div>
        </div>
    </div>

    <!-- All Groups Section -->
    <div id="all-groups" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($allGroups as $group)
            <div class="group-card rounded-xl p-6 flex flex-col">
                <div class="flex justify-between items-start mb-4">
                    <h3 class="text-xl font-bold text-gray-800">{{ $group->group_name }}</h3>
                    <span class="px-3 py-1 bg-blue-50 text-blue-600 rounded-full text-sm font-medium">
                        {{ $group->dps_type }}
                    </span>
                </div>
                <div class="space-y-3 mb-6">
                    <p class="text-gray-600">
                        <span class="font-medium text-gray-700">Installment:</span>
                        <span class="text-blue-600 font-medium">BDT {{ $group->installment }}</span>
                    </p>
                    <p class="text-gray-600">
                        <span class="font-medium text-gray-700">Members:</span>
                        <span class="text-blue-600 font-medium">{{ $group->members_count }}</span>
                    </p>
                </div>
                <div class="flex space-x-3 mt-auto">
                    <button
                        onclick="showDetails({!! htmlspecialchars(json_encode([
                            'groupName' => $group->group_name,
                            'adminName' => $group->admin_name,
                            'dpsType' => $group->dps_type,
                            'timePeriod' => $group->time_period,
                            'startDate' => $group->start_date,
                            'goalAmount' => $group->goal_amount,
                            'warningTime' => $group->warning_time,
                            'emergencyFund' => $group->emergency_fund,
                            'members' => $group->members
                        ]), ENT_QUOTES, 'UTF-8') !!})"
                        class="w-1/2 px-4 py-2.5 text-white rounded-lg primary-button"
                    >
                        View Details
                    </button>
                    @if ($group->is_member)
                        @if ($group->membership_status === 'approved')
                            <button
                                class="w-1/2 px-4 py-2.5 bg-green-100 text-green-700 rounded-lg cursor-not-allowed font-medium">
                                Already Joined
                            </button>
                        @else
                            <button
                                class="w-1/2 px-4 py-2.5 bg-yellow-100 text-yellow-700 rounded-lg cursor-not-allowed font-medium">
                                Request Pending
                            </button>
                        @endif
                    @else
                        <form method="POST" action="{{ route('groups.join') }}" class="w-1/2">
                            @csrf
                            <input type="hidden" name="group_id" value="{{ $group->group_id }}">
                            <button type="submit"
                                class="w-full px-4 py-2.5 text-white rounded-lg secondary-button">
                                Join Group
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    <!-- My Groups Section -->
    <div id="joined-groups" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" style="display: none;">
        @foreach ($joinedGroups as $group)
            <div class="group-card rounded-xl p-6 flex flex-col">
                <div class="flex justify-between items-start mb-4">
                    <h3 class="text-xl font-bold text-gray-800">{{ $group->group_name }}</h3>
                    <span class="px-3 py-1 bg-blue-50 text-blue-600 rounded-full text-sm font-medium">
                        {{ $group->dps_type }}
                    </span>
                </div>
                <div class="space-y-3 mb-6">
                    <p class="text-gray-600">
                        <span class="font-medium text-gray-700">Installment:</span>
                        <span class="text-blue-600 font-medium">BDT {{ $group->installment }}</span>
                    </p>
                    <p class="text-gray-600">
                        <span class="font-medium text-gray-700">Members:</span>
                        <span class="text-blue-600 font-medium">{{ $group->members_count }}</span>
                    </p>
                    <p class="text-gray-600">
                        <span class="font-medium text-gray-700">Role:</span>
                        <span class="{{ $group->is_admin ? 'text-blue-600' : 'text-green-600' }} font-medium">
                            {{ $group->is_admin ? 'Admin' : 'Member' }}
                        </span>
                    </p>
                </div>
                <div class="flex space-x-3 mt-auto">
                    <button
                        onclick="showDetails({!! htmlspecialchars(json_encode([
                            'groupName' => $group->group_name,
                            'adminName' => $group->admin_name,
                            'dpsType' => $group->dps_type,
                            'timePeriod' => $group->time_period,
                            'startDate' => $group->start_date,
                            'goalAmount' => $group->goal_amount,
                            'warningTime' => $group->warning_time,
                            'emergencyFund' => $group->emergency_fund,
                            'members' => $group->members
                        ]), ENT_QUOTES, 'UTF-8') !!})"
                        class="w-1/2 px-4 py-2.5 text-white rounded-lg primary-button"
                    >
                        View Details
                    </button>
                    <form action="group_session.php" method="POST" class="w-1/2">
                        <input type="hidden" name="group_id" value="{{ $group->group_id }}">
                        <button type="submit" class="w-full px-4 py-2.5 text-white rounded-lg secondary-button">
                            Enter Group
                        </button>
                    </form>
                </div>
            </div>
        @endforeach

        @if (empty($joinedGroups) || count($joinedGroups) === 0)
            <div class="col-span-full text-center py-12">
                <div class="bg-white rounded-xl p-8 shadow-sm">
                    <p class="text-gray-600 text-lg">You haven't joined any groups yet.</p>
                    <p class="text-gray-500 mt-2">Browse the available groups and join one to get started!</p>
                </div>
            </div>
        @endif
    </div>

    <!-- Details Modal -->
    <div id="detailsModal"
        class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center modal-overlay z-50">
        <div class="bg-white rounded-xl p-8 max-w-md w-full mx-4 shadow-xl">
            <div class="flex justify-between items-start mb-6">
                <h2 class="text-2xl font-bold text-gray-800" id="modalGroupName"></h2>
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="space-y-4">
                <div class="p-4 bg-gray-50 rounded-lg">
                    <p class="text-gray-600">
                        <span class="font-medium text-gray-700">Admin:</span>
                        <span id="modalAdmin" class="text-blue-600"></span>
                    </p>
                </div>
                <div class="p-4 bg-gray-50 rounded-lg">
                    <p class="text-gray-600">
                        <span class="font-medium text-gray-700">DPS Type:</span>
                        <span id="modalDpsType" class="text-blue-600"></span>
                    </p>
                    <p class="text-gray-600 mt-2">
                        <span class="font-medium text-gray-700">Time Period:</span>
                        <span id="modalTimePeriod" class="text-blue-600"></span>
                    </p>
                </div>
                <div class="p-4 bg-gray-50 rounded-lg">
                    <p class="text-gray-600">
                        <span class="font-medium text-gray-700">Start Date:</span>
                        <span id="modalStartDate" class="text-blue-600"></span>
                    </p>
                    <p class="text-gray-600 mt-2">
                        <span class="font-medium text-gray-700">Goal Amount:</span>
                        BDT <span id="modalGoalAmount" class="text-blue-600"></span>
                    </p>
                </div>
                <div class="p-4 bg-gray-50 rounded-lg">
                    <p class="text-gray-600">
                        <span class="font-medium text-gray-700">Warning Time:</span>
                        <span id="modalWarningTime" class="text-blue-600"></span> days
                    </p>
                    <p class="text-gray-600 mt-2">
                        <span class="font-medium text-gray-700">Emergency Fund:</span>
                        BDT <span id="modalEmergencyFund" class="text-blue-600"></span>
                    </p>
                    <p class="text-gray-600 mt-2">
                        <span class="font-medium text-gray-700">Group Size :</span>
                        <span id="modalMembers" class="text-blue-600"></span>
                    </p>
                </div>
            </div>
            <div class="mt-8">
                <button onclick="closeModal()" class="w-full px-4 py-2.5 text-white rounded-lg primary-button">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>

{{-- JS Section --}}
<script>
    function showDetails(details) {
        const modal = document.getElementById('detailsModal');
        document.getElementById('modalGroupName').textContent = details.groupName;
        document.getElementById('modalAdmin').textContent = details.adminName;
        document.getElementById('modalDpsType').textContent = details.dpsType;
        document.getElementById('modalTimePeriod').textContent = details.timePeriod + ' ' + details.dpsType;
        document.getElementById('modalStartDate').textContent = new Date(details.startDate).toLocaleDateString();
        document.getElementById('modalGoalAmount').textContent = Number(details.goalAmount).toLocaleString();
        document.getElementById('modalWarningTime').textContent = details.warningTime;
        document.getElementById('modalEmergencyFund').textContent = Number(details.emergencyFund).toLocaleString();
        document.getElementById('modalMembers').textContent = details.members;

        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        const modal = document.getElementById('detailsModal');
        modal.style.display = 'none';
        document.body.style.overflow = 'auto';
    }

    function showGroups(type) {
        const allGroups = document.getElementById('all-groups');
        const joinedGroups = document.getElementById('joined-groups');
        const allTab = document.getElementById('all-tab');
        const joinedTab = document.getElementById('joined-tab');

        if (type === 'all') {
            allGroups.style.display = 'grid';
            joinedGroups.style.display = 'none';
            allTab.classList.add('active');
            joinedTab.classList.remove('active');
        } else {
            allGroups.style.display = 'none';
            joinedGroups.style.display = 'grid';
            joinedTab.classList.add('active');
            allTab.classList.remove('active');
        }
    }

    // Initialize the tabs
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('all-tab').classList.add('active');
    });

    // Close modal when clicking outside
    document.getElementById('detailsModal').addEventListener('click', function (e) {
        if (e.target === this) {
            closeModal();
        }
    });

    // Add escape key listener to close modal
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            closeModal();
        }
    });

    // Filter functionality
    const searchInput = document.getElementById('search');
    const dpsTypeSelect = document.getElementById('dpsType');

    // Add event listeners
    searchInput.addEventListener('input', applyFilters);
    dpsTypeSelect.addEventListener('change', applyFilters);

    function applyFilters() {
        const searchTerm = searchInput.value.toLowerCase();
        const dpsType = dpsTypeSelect.value;

        // Get all group cards from both sections
        const allGroupCards = document.querySelectorAll('#all-groups .group-card, #joined-groups .group-card');

        allGroupCards.forEach(card => {
            let show = true;

            // Group name filter
            const groupName = card.querySelector('h3').textContent.toLowerCase();
            if (!groupName.includes(searchTerm)) {
                show = false;
            }

            // DPS type filter
            if (dpsType !== '') {
                const cardDpsType = card.querySelector('.bg-blue-50').textContent.trim();
                if (cardDpsType !== dpsType) {
                    show = false;
                }
            }

            // Show/hide card
            card.style.display = show ? '' : 'none';
        });
    }

    // Initial apply on page load
    document.addEventListener('DOMContentLoaded', () => {
        applyFilters();
    });
</script>
@endsection