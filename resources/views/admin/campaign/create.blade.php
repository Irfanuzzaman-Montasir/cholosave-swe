@extends('layouts.site_admin')

@section('title', 'Create Campaign')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded shadow">
    <h2 class="text-2xl font-bold mb-6 text-green-700">Create New Campaign</h2>
    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('admin.campaign.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block mb-1 font-semibold" for="title">Title</label>
            <input type="text" name="title" id="title" class="w-full border rounded px-3 py-2" required value="{{ old('title') }}">
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold" for="description">Description</label>
            <textarea name="description" id="description" rows="4" class="w-full border rounded px-3 py-2" required>{{ old('description') }}</textarea>
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold" for="goal_amount">Goal Amount</label>
            <input type="number" name="goal_amount" id="goal_amount" class="w-full border rounded px-3 py-2" required min="1" value="{{ old('goal_amount') }}">
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold" for="deadline">Deadline</label>
            <input type="date" name="deadline" id="deadline" class="w-full border rounded px-3 py-2" required value="{{ old('deadline') }}">
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold" for="bKash">bKash Number</label>
            <input type="text" name="bKash" id="bKash" class="w-full border rounded px-3 py-2" value="{{ old('bKash') }}">
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold" for="Rocket">Rocket Number</label>
            <input type="text" name="Rocket" id="Rocket" class="w-full border rounded px-3 py-2" value="{{ old('Rocket') }}">
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold" for="Nagad">Nagad Number</label>
            <input type="text" name="Nagad" id="Nagad" class="w-full border rounded px-3 py-2" value="{{ old('Nagad') }}">
        </div>
        <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">Create Campaign</button>
    </form>
</div>
@endsection 