@extends('layouts.app')

@section('title', 'Booking Confirmation')

@section('content')
    <h1>Booking Confirmation</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Thank you for your booking, {{ $booking->guest_name }}!</h5>
            <p class="card-text">Your booking details:</p>
            <ul class="list-unstyled">
                <li><strong>Room:</strong> {{ $booking->room->room_number }}</li>
                <li><strong>Check-in:</strong> {{ $booking->check_in }}</li>
                <li><strong>Check-out:</strong> {{ $booking->check_out }}</li>
                <li><strong>Total Price:</strong> ${{ $booking->total_price }}</li>
                <li><strong>Status:</strong> {{ ucfirst($booking->status) }}</li>
            </ul>
            <p class="card-text">A confirmation email has been sent to {{ $booking->email }}</p>
            <a href="{{ route('home') }}" class="btn btn-primary">Return to Home</a>
        </div>
    </div>
@endsection