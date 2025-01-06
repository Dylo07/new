@extends('layouts.app')

@section('title', 'Room Details')

@section('content')
    <h1>Room {{ $room->room_number }}</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $room->type }}</h5>
            <p class="card-text">{{ $room->description }}</p>
            <p class="card-text"><strong>Price per night:</strong> ${{ $room->price_per_night }}</p>
            <a href="{{ route('bookings.create', $room) }}" class="btn btn-success">Book Now</a>
            <a href="{{ route('rooms.index') }}" class="btn btn-secondary">Back to Rooms</a>
        </div>
    </div>
@endsection