@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Request Group Loan</h2>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <form action="{{ route('admin.loan.request.store') }}" method="POST" id="loanRequestForm" class="space-y-6">
            @csrf
            
            <!-- Amount Selection -->
            <div>
                <label for="amount" class="block text-sm font-medium text-gray-700 mb-2">Loan Amount (BDT)</label>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-2 mb-2">
                    @foreach([500, 1000, 1500, 2000] as $quickAmount)
                        <button type="button" 
                                class="quick-amount-btn px-4 py-2 border rounded-md text-center hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                data-amount="{{ $quickAmount }}">
                            {{ number_format($quickAmount) }} BDT
                        </button>
                    @endforeach
                </div>
                <input type="number" 
                       name="amount" 
                       id="amount" 
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                       placeholder="Enter loan amount"
                       min="1"
                       step="0.01"
                       required>
                @error('amount')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-sm text-gray-500">Available Emergency Fund: {{ number_format($group->emergency_fund, 2) }} BDT</p>
            </div>

            <!-- Reason -->
            <div>
                <label for="reason" class="block text-sm font-medium text-gray-700 mb-2">Reason for Loan</label>
                <textarea name="reason" 
                          id="reason" 
                          rows="4" 
                          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                          placeholder="Please provide a detailed reason for your loan request"
                          required></textarea>
                @error('reason')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Return Date -->
            <div>
                <label for="return_time" class="block text-sm font-medium text-gray-700 mb-2">Expected Return Date</label>
                <input type="date" 
                       name="return_time" 
                       id="return_time" 
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                       min="{{ date('Y-m-d') }}"
                       required>
                @error('return_time')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Terms and Conditions -->
            <div class="flex items-start">
                <div class="flex items-center h-5">
                    <input type="checkbox" 
                           name="terms_accepted" 
                           id="terms_accepted" 
                           class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                           required>
                </div>
                <div class="ml-3 text-sm">
                    <label for="terms_accepted" class="font-medium text-gray-700">I agree to the terms and conditions</label>
                    <p class="text-gray-500">By checking this box, you agree to repay the loan within the specified timeframe and understand that this request will be subject to group member approval.</p>
                </div>
            </div>
            @error('terms_accepted')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="submit" 
                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Submit Loan Request
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Quick amount selection
    const quickAmountBtns = document.querySelectorAll('.quick-amount-btn');
    const amountInput = document.getElementById('amount');

    quickAmountBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            amountInput.value = this.dataset.amount;
        });
    });

    // Form submission with SweetAlert
    const form = document.getElementById('loanRequestForm');
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Basic validation
        const amount = parseFloat(amountInput.value);
        const emergencyFund = {{ $group->emergency_fund }};
        
        if (amount > emergencyFund) {
            Swal.fire({
                icon: 'error',
                title: 'Invalid Amount',
                text: 'Loan amount cannot exceed the available emergency fund.'
            });
            return;
        }

        // Submit form if validation passes
        this.submit();
    });
});
</script>
@endpush
@endsection 