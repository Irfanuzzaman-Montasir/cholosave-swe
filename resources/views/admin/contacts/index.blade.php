@extends('layouts.admin')

@section('title', 'Contact Messages - CholoSave')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Contact Messages</h2>
        <div class="btn-group" role="group">
            <a href="?status=all" class="btn btn-sm {{ ($status ?? 'all') === 'all' ? 'btn-primary text-white' : 'btn-outline-primary' }}">All</a>
            <a href="?status=pending" class="btn btn-sm {{ ($status ?? 'all') === 'pending' ? 'btn-primary text-white' : 'btn-outline-primary' }}">Pending</a>
            <a href="?status=done" class="btn btn-sm {{ ($status ?? 'all') === 'done' ? 'btn-primary text-white' : 'btn-outline-primary' }}">Done</a>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Message</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($messages as $message)
                        <tr>
                            <td>{{ $message->name }}</td>
                            <td>{{ $message->email }}</td>
                            <td>
                                <span title="{{ $message->description }}">{{ Str::limit($message->description, 100) }}</span>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($message->created_at)->format('M d, Y H:i') }}</td>
                            <td>
                                <span class="badge {{ $message->status === 'done' ? 'bg-success' : 'bg-warning text-dark' }}">{{ ucfirst($message->status) }}</span>
                            </td>
                            <td>
                                @if($message->status !== 'done')
                                    <button class="btn btn-sm btn-success mark-done-btn" data-id="{{ $message->id }}">
                                        <i class="fas fa-check"></i> Mark as Done
                                    </button>
                                @endif
                                <form action="{{ route('admin.contacts.destroy', $message) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this message?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">No messages found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.querySelectorAll('.mark-done-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            Swal.fire({
                title: 'Mark as Done?',
                text: 'Are you sure you want to mark this message as done?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, mark as done!'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/admin/contacts/${id}/mark-done`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire('Marked as Done!', 'The message has been marked as done.', 'success').then(() => {
                                window.location.reload();
                            });
                        } else {
                            Swal.fire('Error!', 'Something went wrong.', 'error');
                        }
                    });
                }
            });
        });
    });
</script>
@endpush 