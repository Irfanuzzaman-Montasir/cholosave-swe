@extends('layouts.app')

@section('title', 'Join Groups')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 text-center fw-bold">Available Groups</h2>
    <div class="card p-4 mb-4" style="border-radius: 1rem;">
        <div class="row g-3 align-items-center">
            <div class="col-md-8">
                <label class="form-label fw-semibold">Search Groups</label>
                <input type="text" id="groupSearch" class="form-control" placeholder="Search by group name...">
            </div>
            <div class="col-md-4">
                <label class="form-label fw-semibold">DPS Type</label>
                <select id="dpsTypeFilter" class="form-select">
                    <option value="">All Types</option>
                    <option value="weekly">Weekly</option>
                    <option value="monthly">Monthly</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row" id="groupsList">
        @forelse($groups as $group)
            <div class="col-md-6 col-lg-4 mb-4 group-card"
                data-group-name="{{ strtolower($group->group_name) }}"
                data-dps-type="{{ strtolower($group->dps_type) }}">
                <div class="card shadow-sm h-100 modern-group-card">
                    <div class="card-body d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h4 class="card-title mb-0">{{ $group->group_name }}</h4>
                            <span class="badge bg-light text-primary text-capitalize" style="font-size:0.95rem; font-weight:400;">{{ $group->dps_type }}</span>
                        </div>
                        <div class="group-info-list mb-3">
                            <div><span class="info-label">Installment:</span> <span>BDT {{ number_format($group->amount, 2) }}</span></div>
                            <div><span class="info-label">Members:</span> <span>{{ $group->members }}</span></div>
                            <div><span class="info-label">Start Date:</span> <span>{{ \Carbon\Carbon::parse($group->start_date)->format('d M Y') }}</span></div>
                        </div>
                        <div class="d-flex gap-2 mt-auto">
                            <a href="{{ route('groups.show', $group->group_id) }}" class="btn btn-primary flex-fill">View Details</a>
                            <button class="btn flex-fill join-group-btn {{ $group->membership_status === 'pending' ? 'btn-danger' : 'btn-success' }}" 
                                    data-group-id="{{ $group->group_id }}"
                                    data-status="{{ $group->membership_status ?? 'not_joined' }}"
                                    {{ $group->membership_status === 'pending' ? 'disabled' : '' }}>
                                {{ $group->membership_status === 'pending' ? 'Pending' : 'Join Group' }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">No groups available to join at the moment.</div>
            </div>
        @endforelse
    </div>
</div>

<style>
.modern-group-card {
    border-radius: 1.25rem;
    border: none;
    background: #fff;
    transition: box-shadow 0.25s, transform 0.2s;
    box-shadow: 0 6px 24px rgba(30,64,175,0.10);
    position: relative;
    overflow: hidden;
    display: flex;
    flex-direction: column;
}
.card-title {
    color: #1E40AF;
    font-weight: 700;
    font-size: 1.3rem;
    letter-spacing: 0.5px;
}
.group-info-list {
    font-size: 0.98rem;
    color: #334155;
    margin-bottom: 1.2rem;
}
.group-info-list .info-label {
    font-weight: 600;
    color: #1E40AF;
    margin-right: 0.5rem;
}
.btn-primary {
    background: #0026ff;
    border: none;
    border-radius: 0.7rem;
    font-weight: 700;
    color: #fff;
    padding: 0.7rem 1.5rem;
    font-size: 1.08rem;
    box-shadow: 0 2px 8px rgba(30,64,175,0.10);
    transition: background 0.2s, transform 0.15s;
    letter-spacing: 0.5px;
}
.btn-success {
    background: #22C55E;
    border: none;
    border-radius: 0.7rem;
    font-weight: 700;
    color: #fff;
    padding: 0.7rem 1.5rem;
    font-size: 1.08rem;
    box-shadow: 0 2px 8px rgba(34,197,94,0.10);
    transition: background 0.2s, transform 0.15s;
    letter-spacing: 0.5px;
}
.btn-success:disabled {
    background: #94A3B8;
    cursor: not-allowed;
}
.btn-danger {
    background: #DC2626;
    border: none;
    border-radius: 0.7rem;
    font-weight: 700;
    color: #fff;
    padding: 0.7rem 1.5rem;
    font-size: 1.08rem;
    box-shadow: 0 2px 8px rgba(220,38,38,0.10);
    transition: background 0.2s, transform 0.15s;
    letter-spacing: 0.5px;
}
.btn-danger:disabled {
    background: #DC2626;
    opacity: 0.8;
    cursor: not-allowed;
}
</style>

@push('scripts')
<script>
$(document).ready(function() {
    // Search and filter functionality
    const searchInput = $('#groupSearch');
    const dpsTypeFilter = $('#dpsTypeFilter');
    const groupCards = $('.group-card');

    function filterGroups() {
        const searchTerm = searchInput.val().trim().toLowerCase();
        const dpsType = dpsTypeFilter.val().toLowerCase();
        let hasVisibleCards = false;

        groupCards.each(function() {
            const card = $(this);
            const groupName = card.data('group-name');
            const groupDpsType = card.data('dps-type');
            
            const matchesSearch = searchTerm === '' || groupName.includes(searchTerm);
            const matchesDpsType = dpsType === '' || groupDpsType === dpsType;
            
            if (matchesSearch && matchesDpsType) {
                card.show();
                hasVisibleCards = true;
            } else {
                card.hide();
            }
        });

        // Show/hide empty state message
        const emptyState = $('.empty-state-message');
        if (emptyState.length) {
            emptyState.toggle(!hasVisibleCards);
        }
    }

    // Add empty state message if it doesn't exist
    if (!$('.empty-state-message').length) {
        const emptyState = $('<div>', {
            class: 'col-12 empty-state-message',
            style: 'display: none;'
        }).append(
            $('<div>', {
                class: 'alert alert-info',
                text: 'No groups found matching your search criteria.'
            })
        );
        $('#groupsList').append(emptyState);
    }

    // Add event listeners
    searchInput.on('input', filterGroups);
    dpsTypeFilter.on('change', filterGroups);

    // Initial filter
    filterGroups();

    // Join group functionality
    $(document).on('click', '.join-group-btn', function() {
        const button = $(this);
        const groupId = button.data('group-id');
        const status = button.data('status');
        
        if (status === 'pending') {
            return; // Do nothing if already pending
        }
        
        // Get CSRF token from meta tag
        const token = $('meta[name="csrf-token"]').attr('content');
        
        console.log('Attempting to join group:', {
            groupId: groupId,
            status: status,
            token: token
        });
        
        // Disable button immediately to prevent multiple clicks
        button.prop('disabled', true);
        
        $.ajax({
            url: `/groups/${groupId}/join`,
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': token
            },
            success: function(data) {
                console.log('Join request successful:', data);
                if (data.success) {
                    // Update button state
                    button.text('Pending')
                         .data('status', 'pending')
                         .removeClass('btn-success')
                         .addClass('btn-danger')
                         .prop('disabled', true);
                } else {
                    // Re-enable button if request failed
                    button.prop('disabled', false);
                    console.error('Join request failed:', data.message);
                    alert('Failed to join group: ' + data.message);
                }
            },
            error: function(xhr, status, error) {
                // Re-enable button on error
                button.prop('disabled', false);
                console.error('Join request error:', {
                    status: status,
                    error: error,
                    response: xhr.responseText
                });
                alert('An error occurred while trying to join the group. Please try again.');
            }
        });
    });
});
</script>
@endpush 