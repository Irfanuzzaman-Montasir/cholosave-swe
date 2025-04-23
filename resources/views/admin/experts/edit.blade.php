@extends('layouts.admin')

@section('title', 'Edit Expert - CholoSave')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Expert</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.experts.update', $expert) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" 
                                           class="form-control @error('name') is-invalid @enderror" 
                                           id="name" 
                                           name="name" 
                                           value="{{ old('name', $expert->name) }}" 
                                           required>
                                    @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" 
                                           class="form-control @error('email') is-invalid @enderror" 
                                           id="email" 
                                           name="email" 
                                           value="{{ old('email', $expert->email) }}" 
                                           required>
                                    @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="text" 
                                           class="form-control @error('phone') is-invalid @enderror" 
                                           id="phone" 
                                           name="phone" 
                                           value="{{ old('phone', $expert->phone) }}" 
                                           required>
                                    @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="expertise" class="form-label">Expertise</label>
                                    <input type="text" 
                                           class="form-control @error('expertise') is-invalid @enderror" 
                                           id="expertise" 
                                           name="expertise" 
                                           value="{{ old('expertise', $expert->expertise) }}" 
                                           required>
                                    @error('expertise')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="bio" class="form-label">Bio</label>
                                    <textarea class="form-control @error('bio') is-invalid @enderror" 
                                              id="bio" 
                                              name="bio" 
                                              rows="4" 
                                              required>{{ old('bio', $expert->bio) }}</textarea>
                                    @error('bio')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="image" class="form-label">Profile Image</label>
                                    <input type="file" 
                                           class="form-control @error('image') is-invalid @enderror" 
                                           id="image" 
                                           name="image" 
                                           accept="image/*">
                                    @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

                                    @if($expert->image)
                                    <div class="mt-2">
                                        <img src="{{ Storage::url($expert->image) }}" 
                                             alt="{{ $expert->name }}" 
                                             class="rounded"
                                             width="100">
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="text-end">
                            <a href="{{ route('admin.experts.index') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">Update Expert</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Preview image before upload
    document.getElementById('image').addEventListener('change', function(e) {
        const reader = new FileReader();
        reader.onload = function(e) {
            // You can add image preview logic here if needed
        };
        reader.readAsDataURL(e.target.files[0]);
    });
</script>
@endpush
@endsection 