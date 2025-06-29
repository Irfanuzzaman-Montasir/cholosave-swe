@extends('layouts.site_admin')

@section('title', 'Contact Reports')

@section('content')
<div class="max-w-6xl mx-auto p-6">
    <!-- Header Section -->
    <div class="text-center mb-8">
        <h1 class="text-4xl font-bold text-gray-800 mb-2">Contact Us Reports</h1>
        <p class="text-gray-600">Manage and review customer inquiries and feedback</p>
    </div>

    @if($contacts->isEmpty())
        <div class="bg-white rounded-xl shadow-lg p-12 text-center">
            <div class="text-gray-400 mb-4">
                <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-gray-700 mb-2">No Contact Messages</h3>
            <p class="text-gray-500">There are currently no contact form submissions to review.</p>
        </div>
    @else
        <!-- Stats Summary -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-100 text-sm font-medium">Total Messages</p>
                        <p class="text-3xl font-bold">{{ $contacts->count() }}</p>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-full p-3">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                    </div>
                </div>
            </div>
            
            <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-xl p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-green-100 text-sm font-medium">Completed</p>
                        <p class="text-3xl font-bold">{{ $contacts->where('status', 'COMPLETED')->count() }}</p>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-full p-3">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
            
            <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 rounded-xl p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-yellow-100 text-sm font-medium">Pending</p>
                        <p class="text-3xl font-bold">{{ $contacts->where('status', 'PENDING')->count() }}</p>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-full p-3">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Reports Table -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800">Contact Messages</h3>
            </div>
            
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Contact Info</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Message</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Date & Status</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($contacts as $contact)
                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                            <td class="px-6 py-6">
                                <div class="flex items-center">
                                    <div class="bg-indigo-100 rounded-full p-3 mr-4">
                                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="text-sm font-semibold text-gray-900">{{ $contact->name }}</div>
                                        <div class="text-sm text-blue-600 hover:text-blue-800">
                                            <a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            
                            <td class="px-6 py-6">
                                <div class="max-w-md">
                                    <div class="text-sm text-gray-900 leading-relaxed">
                                        {{ Str::limit($contact->description, 150) }}
                                        @if(strlen($contact->description) > 150)
                                            <button class="text-blue-600 hover:text-blue-800 font-medium ml-1" onclick="toggleMessage('{{ $contact->id }}')">
                                                Read more
                                            </button>
                                        @endif
                                    </div>
                                    <div id="full-message-{{ $contact->id }}" class="hidden mt-2 text-sm text-gray-700 leading-relaxed">
                                        {{ $contact->description }}
                                        <button class="text-blue-600 hover:text-blue-800 font-medium ml-1" onclick="toggleMessage('{{ $contact->id }}')">
                                            Show less
                                        </button>
                                    </div>
                                </div>
                            </td>
                            
                            <td class="px-6 py-6">
                                <div class="space-y-2">
                                    <div class="text-sm text-gray-500">
                                        {{ \Carbon\Carbon::parse($contact->created_at)->format('M d, Y') }}
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        {{ \Carbon\Carbon::parse($contact->created_at)->format('h:i A') }}
                                    </div>
                                    <div class="mt-2">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold @if($contact->status === 'COMPLETED') bg-green-100 text-green-800 @else bg-yellow-100 text-yellow-800 @endif">
                                            @if($contact->status === 'COMPLETED')
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                                </svg>
                                            @else
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                                </svg>
                                            @endif
                                            {{ ucfirst(strtolower($contact->status)) }}
                                        </span>
                                    </div>
                                </div>
                            </td>
                            
                            <td class="px-6 py-6">
                                <div class="flex space-x-2">
                                    @if($contact->status !== 'COMPLETED')
                                        <button class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 font-semibold text-sm transition-colors duration-200 flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            Mark Done
                                        </button>
                                    @else
                                        <span class="text-green-600 text-sm font-medium flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                            </svg>
                                            Completed
                                        </span>
                                    @endif
                                    
                                    <button class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 font-semibold text-sm transition-colors duration-200 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                        Reply
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>

<script>
function toggleMessage(contactId) {
    const shortMessage = document.querySelector(`tr:has(#full-message-${contactId}) .text-sm.text-gray-900`);
    const fullMessage = document.getElementById(`full-message-${contactId}`);
    
    if (fullMessage.classList.contains('hidden')) {
        shortMessage.style.display = 'none';
        fullMessage.classList.remove('hidden');
    } else {
        shortMessage.style.display = 'block';
        fullMessage.classList.add('hidden');
    }
}
</script>
@endsection 