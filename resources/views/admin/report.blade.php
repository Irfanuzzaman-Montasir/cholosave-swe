@extends('layouts.site_admin')

@section('title', 'Contact Reports')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-8 rounded-2xl shadow-2xl mt-10">
    <h2 class="text-3xl font-extrabold mb-8 text-center text-indigo-700 flex items-center justify-center"><i class="fas fa-file-alt mr-2"></i> Contact Us Reports</h2>
    @if($contacts->isEmpty())
        <div class="text-center text-gray-500">No contact messages found.</div>
    @else
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Message</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3"></th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($contacts as $contact)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap font-semibold">{{ $contact->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-blue-600">{{ $contact->email }}</td>
                    <td class="px-6 py-4 whitespace-pre-line max-w-xs">{{ $contact->description }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-500">{{ $contact->created_at }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="inline-block px-3 py-1 rounded-full text-xs font-bold @if($contact->status === 'COMPLETED') bg-green-100 text-green-700 @else bg-yellow-100 text-yellow-700 @endif">
                            {{ ucfirst(strtolower($contact->status)) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <button class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 font-semibold">Done</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>
@endsection 