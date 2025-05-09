@extends('layouts.group_member')
@section('title', 'Withdrawal Request')

@push('styles')
<style>
    .custom-font {
        font-family: 'Poppins', sans-serif;
    }
    .form-container {
        background: white;
        border-radius: 1rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        border: 1px solid #e5e7eb;
    }
    .form-input {
        background-color: #f9fafb;
        border: 1px solid #e5e7eb;
        border-radius: 0.5rem;
        padding: 0.75rem 1rem;
        width: 100%;
        transition: all 0.2s;
        color: #000000;
    }
    .form-input:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.1);
        outline: none;
    }
    .submit-btn {
        background: linear-gradient(to right, #3b82f6, #2563eb);
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 0.5rem;
        font-weight: 500;
        transition: all 0.2s;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    .submit-btn:hover {
        background: linear-gradient(to right, #2563eb, #1d4ed8);
        transform: translateY(-1px);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
</style>
@endpush

@section('content')
<div class="p-6 w-full max-w-4xl mx-auto">
    <div class="form-container p-8">
        <div class="mb-8 text-center">
            <h2 class="text-2xl font-semibold custom-font text-blue-700">
                <i class="fa-solid fa-money-bill-wave mr-2 text-blue-600"></i>
                Withdrawal Request Form
            </h2>
            <p class="mt-2 text-black">Please fill in the details below to submit your withdrawal request</p>
        </div>
        <form method="POST" action="{{ route('member.withdrawal.request.store', $group->group_id) }}" class="space-y-6">
            @csrf
            <div>
                <label for="amount" class="block text-sm font-medium text-black mb-2">Withdrawal Amount (BDT)</label>
                <input type="number" id="amount" name="amount" class="form-input" placeholder="Enter amount" required value="{{ old('amount') }}">
                @error('amount')
                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="payment_number" class="block text-sm font-medium text-black mb-2">Payment Number</label>
                <input type="text" id="payment_number" name="payment_number" class="form-input" placeholder="Enter payment number" required value="{{ old('payment_number') }}">
                @error('payment_number')
                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="payment_method" class="block text-sm font-medium text-black mb-2">Payment Method</label>
                <select id="payment_method" name="payment_method" class="form-input" required>
                    <option value="">Select a method</option>
                    <option value="Bkash" {{ old('payment_method') == 'Bkash' ? 'selected' : '' }}>Bkash</option>
                    <option value="Nagad" {{ old('payment_method') == 'Nagad' ? 'selected' : '' }}>Nagad</option>
                    <option value="Rocket" {{ old('payment_method') == 'Rocket' ? 'selected' : '' }}>Rocket</option>
                </select>
                @error('payment_method')
                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="pt-4">
                <button type="submit" class="submit-btn w-full">
                    <i class="fas fa-paper-plane mr-2"></i> Submit Withdrawal Request
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
@if(session('success'))
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    Swal.fire({
        title: 'Success!',
        text: '{{ session('success') }}',
        icon: 'success',
        confirmButtonText: 'OK'
    });
</script>
@endif
@endpush 