@extends('layouts.app')

@section('title', 'Book a Room')

@section('content')
    <h1>Book Room {{ $room->room_number }}</h1>

    <form action="{{ route('bookings.store', $room) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="guest_name" class="form-label">Name</label>
            <input type="text" class="form-control" id="guest_name" name="guest_name" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="tel" class="form-control" id="phone" name="phone" required>
        </div>
        <div class="mb-3">
            <label for="check_in" class="form-label">Check-in Date</label>
            <input type="date" class="form-control" id="check_in" name="check_in" required>
        </div>
        <div class="mb-3">
            <label for="check_out" class="form-label">Check-out Date</label>
            <input type="date" class="form-control" id="check_out" name="check_out" required>
        </div>
        <button type="submit" class="btn btn-primary">Book Now</button>
        <a href="{{ route('rooms.show', $room) }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection