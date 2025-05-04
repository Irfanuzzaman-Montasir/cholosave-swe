@extends('layouts.app')

@section('title', 'My Groups')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 text-center fw-bold">My Groups</h2>
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
        @forelse($memberships as $membership)
            @php $group = $membership->group; @endphp
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
                            <div><span class="info-label">Role:</span> <span>{{ $membership->is_admin ? 'Admin' : 'Member' }}</span></div>
                        </div>
                        <div class="d-flex gap-2 mt-auto">
                            <a href="{{ route('groups.show', $group->group_id) }}" class="btn btn-primary flex-fill">View Details</a>
                            <a href="{{ route('groups.enter', $group->group_id) }}" class="btn btn-success flex-fill">Enter Group</a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">You have not joined any groups yet.</div>
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
.card-desc {
    color: #64748b;
    font-size: 1rem;
    font-weight: 500;
    margin-bottom: 0.5rem;
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
.btn-primary:hover {
    background: #001bb5;
    color: #fff;
    transform: translateY(-2px) scale(1.04);
}
.btn-success {
    background: linear-gradient(135deg, #22C55E 0%, #16A34A 100%);
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
.btn-success:hover {
    background: linear-gradient(135deg, #16A34A 0%, #22C55E 100%);
    color: #fff;
    transform: translateY(-2px) scale(1.04);
}
.modern-group-card:hover {
    box-shadow: 0 12px 32px rgba(30,64,175,0.18);
    transform: translateY(-4px) scale(1.025);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('groupSearch');
    const dpsTypeFilter = document.getElementById('dpsTypeFilter');
    const groupCards = document.querySelectorAll('.group-card');

    function filterGroups() {
        const search = searchInput.value.trim().toLowerCase();
        const dpsType = dpsTypeFilter.value;

        groupCards.forEach(card => {
            const name = card.getAttribute('data-group-name');
            const type = card.getAttribute('data-dps-type');
            const matchesName = name.includes(search);
            const matchesType = !dpsType || type === dpsType;
            card.style.display = (matchesName && matchesType) ? '' : 'none';
        });
    }

    searchInput.addEventListener('input', filterGroups);
    dpsTypeFilter.addEventListener('change', filterGroups);
});
</script>
@endsection
