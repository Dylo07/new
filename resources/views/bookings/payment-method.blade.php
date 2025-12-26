@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-black py-24">
    <div class="container mx-auto px-4">
        <div class="max-w-2xl mx-auto">
            
            <!-- Progress Steps -->
            <div class="flex items-center justify-center mb-8">
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-emerald-500 rounded-full flex items-center justify-center text-white text-sm font-bold">✓</div>
                    <span class="ml-2 text-emerald-500 text-sm">Review</span>
                </div>
                <div class="w-16 h-0.5 bg-emerald-500 mx-2"></div>
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-emerald-500 rounded-full flex items-center justify-center text-white text-sm font-bold">2</div>
                    <span class="ml-2 text-emerald-500 text-sm">Payment</span>
                </div>
                <div class="w-16 h-0.5 bg-gray-700 mx-2"></div>
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-gray-700 rounded-full flex items-center justify-center text-gray-400 text-sm font-bold">3</div>
                    <span class="ml-2 text-gray-400 text-sm">Complete</span>
                </div>
            </div>

            <div class="bg-gray-900 rounded-lg p-8 border border-gray-800">
                <h1 class="text-3xl text-white font-light mb-2">Select Payment Method</h1>
                <p class="text-gray-400 mb-8">Choose how you would like to pay for your booking</p>
                
                <!-- Booking Summary -->
                <div class="bg-gray-800/50 rounded-lg p-4 mb-8 border border-gray-700">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-gray-400 text-sm">Package</p>
                            <p class="text-emerald-500 font-bold">{{ $package->name }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-gray-400 text-sm">Total Amount</p>
                            <p class="text-2xl text-white font-bold">Rs {{ number_format($bookingData['total_price'], 0) }}</p>
                        </div>
                    </div>
                </div>

                <!-- Payment Options -->
                <div class="space-y-4" id="payment-options">
                    
                    <!-- Credit/Debit Card Option -->
                    <div class="payment-option relative">
                        <input type="radio" name="payment_method" value="card" id="card" class="hidden peer" disabled>
                        <label for="card" class="block p-6 bg-gray-800/30 border border-gray-700 rounded-lg cursor-not-allowed opacity-50">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="w-12 h-12 bg-gray-700 rounded-lg flex items-center justify-center mr-4">
                                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-white font-semibold">Credit / Debit Card</h3>
                                        <p class="text-gray-500 text-sm">Pay securely with your card</p>
                                    </div>
                                </div>
                                <span class="bg-yellow-500/20 text-yellow-500 text-xs px-3 py-1 rounded-full">Coming Soon</span>
                            </div>
                        </label>
                    </div>

                    <!-- Bank Transfer Option -->
                    <div class="payment-option relative">
                        <input type="radio" name="payment_method" value="bank_transfer" id="bank_transfer" class="hidden peer" checked>
                        <label for="bank_transfer" class="block p-6 bg-gray-800 border-2 border-emerald-500 rounded-lg cursor-pointer hover:bg-gray-800/80 transition peer-checked:border-emerald-500 peer-checked:bg-gray-800">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="w-12 h-12 bg-emerald-500/20 rounded-lg flex items-center justify-center mr-4">
                                        <svg class="w-6 h-6 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-white font-semibold">Online Bank Transfer</h3>
                                        <p class="text-gray-400 text-sm">Transfer directly to our bank account</p>
                                    </div>
                                </div>
                                <div class="w-6 h-6 border-2 border-emerald-500 rounded-full flex items-center justify-center">
                                    <div class="w-3 h-3 bg-emerald-500 rounded-full"></div>
                                </div>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Bank Transfer Details (shown when bank transfer is selected) -->
                <div id="bank-details" class="mt-6 bg-emerald-500/10 border border-emerald-500/30 rounded-lg p-6">
                    <h3 class="text-emerald-400 font-semibold mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Bank Account Details
                    </h3>
                    
                    <div class="space-y-3 text-gray-300">
                        <div class="flex justify-between items-center py-2 border-b border-gray-700">
                            <span class="text-gray-400">Account Name</span>
                            <span class="text-white font-medium">Soba Lanka Holiday Resort (PVT) LTD</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-700">
                            <span class="text-gray-400">Account Number</span>
                            <span class="text-white font-mono font-bold text-lg">0090201000175926</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-700">
                            <span class="text-gray-400">Bank</span>
                            <span class="text-white font-medium">Union Bank of Colombo PLC</span>
                        </div>
                        <div class="flex justify-between items-center py-2">
                            <span class="text-gray-400">Branch</span>
                            <span class="text-white font-medium">Kurunegala</span>
                        </div>
                    </div>

                    <div class="mt-6 p-4 bg-yellow-500/10 border border-yellow-500/30 rounded-lg">
                        <p class="text-yellow-400 text-sm">
                            <strong>Important:</strong> Please use your booking reference number as the payment reference when making the transfer.
                        </p>
                    </div>
                </div>

                <!-- Receipt Upload Section -->
                <form action="{{ route('bookings.package.store') }}" method="POST" enctype="multipart/form-data" class="mt-6">
                    @csrf
                    <input type="hidden" name="payment_method" value="bank_transfer">
                    
                    <div class="bg-gray-800/50 border border-gray-700 rounded-lg p-6">
                        <h3 class="text-white font-semibold mb-4">Upload Payment Receipt (Optional)</h3>
                        <p class="text-gray-400 text-sm mb-4">
                            You can upload your payment receipt now or later from your profile page.
                        </p>
                        
                        <div class="relative">
                            <input type="file" name="payment_receipt" id="payment_receipt" accept="image/*,.pdf" 
                                   class="hidden" onchange="updateFileName(this)">
                            <label for="payment_receipt" 
                                   class="flex items-center justify-center w-full p-6 border-2 border-dashed border-gray-600 rounded-lg cursor-pointer hover:border-emerald-500 transition">
                                <div class="text-center">
                                    <svg class="w-10 h-10 text-gray-500 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                    </svg>
                                    <span class="text-gray-400" id="file-name">Click to upload receipt (JPG, PNG, PDF)</span>
                                </div>
                            </label>
                        </div>
                        
                        <p class="text-gray-500 text-xs mt-2">Max file size: 5MB</p>
                    </div>

                    <!-- Action Buttons -->
                    <div class="grid grid-cols-2 gap-4 mt-8">
                        <a href="{{ route('bookings.package.review') }}" 
                           class="block text-center bg-gray-700 text-white py-4 rounded-lg hover:bg-gray-600 transition font-semibold">
                            Back
                        </a>
                        <button type="submit" 
                                class="block w-full text-center bg-emerald-600 text-white py-4 rounded-lg hover:bg-emerald-700 transition font-bold">
                            Complete Booking
                        </button>
                    </div>
                </form>

                <p class="text-gray-500 text-xs text-center mt-6">
                    By completing this booking, you agree to our terms and conditions. 
                    Our team will verify your payment and confirm your booking.
                </p>
            </div>
        </div>
    </div>
</div>

<script>
function updateFileName(input) {
    const fileName = input.files[0] ? input.files[0].name : 'Click to upload receipt (JPG, PNG, PDF)';
    document.getElementById('file-name').textContent = fileName;
    
    if (input.files[0]) {
        document.getElementById('file-name').classList.add('text-emerald-400');
        document.getElementById('file-name').classList.remove('text-gray-400');
    }
}
</script>
@endsection
