@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-black py-24">
    <div class="container mx-auto px-4">
        <div class="max-w-2xl mx-auto text-center">
            
            <div class="w-16 h-16 border-4 border-emerald-500 border-t-transparent rounded-full animate-spin mx-auto mb-8"></div>
            
            <h1 class="text-3xl text-white font-light mb-4">Redirecting to Secure Payment Gateway...</h1>
            <p class="text-gray-400 mb-8">Please wait while we transfer you to PayHere to complete your payment securely.</p>

            <form id="payhere-form" method="post" action="{{ $actionUrl }}">
                @foreach($payhereData as $key => $value)
                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                @endforeach
                
                <button type="submit" class="bg-emerald-600 text-white px-8 py-3 rounded-lg hover:bg-emerald-700 transition hidden" id="manual-submit">
                    Click here if you are not redirected automatically
                </button>
            </form>

        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Show manual button after 3 seconds just in case
        setTimeout(function() {
            document.getElementById('manual-submit').classList.remove('hidden');
        }, 3000);

        // Auto submit form
        document.getElementById('payhere-form').submit();
    });
</script>
@endpush
@endsection
