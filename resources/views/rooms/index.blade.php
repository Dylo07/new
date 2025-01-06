@extends('layouts.app')

@section('title', 'Available Rooms')

@section('content')
    <h1>Available Rooms</h1>

    <div class="row">
        @foreach($rooms as $room)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Room {{ $room->room_number }}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">{{ $room->type }}</h6>
                        <p class="card-text">{{ $room->description }}</p>
                        <p class="card-text"><strong>Price per night:</strong> ${{ $room->price_per_night }}</p>
                        <a href="{{ route('rooms.show', $room) }}" class="btn btn-primary">View Details</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection