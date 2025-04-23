@extends('layouts.admin')

@section('title', 'Expert Team - CholoSave')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Expert Team</h2>
        <a href="{{ route('admin.experts.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Add Expert
        </a>
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
                            <th>Image</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Expertise</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($experts as $expert)
                        <tr>
                            <td>
                                <img src="{{ Storage::url($expert->image) }}" 
                                     alt="{{ $expert->name }}" 
                                     class="rounded-circle"
                                     width="50" 
                                     height="50"
                                     style="object-fit: cover;">
                            </td>
                            <td>{{ $expert->name }}</td>
                            <td>{{ $expert->email }}</td>
                            <td>{{ $expert->phone }}</td>
                            <td>{{ $expert->expertise }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.experts.edit', $expert) }}" 
                                       class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.experts.destroy', $expert) }}" 
                                          method="POST" 
                                          class="d-inline"
                                          onsubmit="return confirm('Are you sure you want to delete this expert?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">No experts found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection 