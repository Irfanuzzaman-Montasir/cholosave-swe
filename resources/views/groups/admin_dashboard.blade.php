@extends('layouts.group_admin')

@section('title', $group->group_name . ' - Admin Dashboard')

@section('content')
    <h1>{{ $group->group_name }} - Admin Dashboard</h1>
    <p>Welcome, you are the admin of this group.</p>
    <!-- Add dashboard widgets/content here -->
@endsection 