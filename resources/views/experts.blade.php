@extends('layouts.app')

@section('title', 'Our Experts - CholoSave')

@section('content')
<div class="container">
    <h1 class="text-center mb-5">Our Expert Team</h1>
    
    <div class="row">
        @foreach($experts as $expert)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="{{ $expert->image }}" class="card-img-top" alt="{{ $expert->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $expert->name }}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">{{ $expert->expertise }}</h6>
                        <p class="card-text">{{ $expert->bio }}</p>
                        <div class="mt-3">
                            <p class="mb-1"><i class="fas fa-envelope"></i> {{ $expert->email }}</p>
                            <p class="mb-0"><i class="fas fa-phone"></i> {{ $expert->phone }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection 