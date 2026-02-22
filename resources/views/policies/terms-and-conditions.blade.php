@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-black py-24">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            
            <!-- Header -->
            <div class="text-center mb-12">
                <h1 class="text-4xl text-white font-light mb-4">Terms & Conditions</h1>
                <p class="text-gray-400">Last Updated: {{ date('F d, Y') }}</p>
            </div>

            <div class="bg-gray-900 rounded-lg p-8 border border-gray-800 space-y-8">
                
                <!-- Introduction -->
                <div>
                    <p class="text-gray-300 leading-relaxed">
                        Welcome to Soba Lanka. By accessing our website and making a booking, you agree to comply with and be bound by the following Terms and Conditions. Please read these terms carefully before using our services.
                    </p>
                </div>

                <!-- Acceptance of Terms -->
                <div>
                    <h2 class="text-2xl text-white font-semibold mb-4">1. Acceptance of Terms</h2>
                    <p class="text-gray-300">
                        By using our website (<a href="https://sobalanka.com" class="text-emerald-400 hover:underline">sobalanka.com</a>), creating an account, or making a booking, you agree to be bound by these Terms and Conditions, our Privacy Policy, and our Return & Refund Policy. If you do not agree with any part of these terms, please do not use our services.
                    </p>
                </div>

                <!-- Booking and Reservations -->
                <div>
                    <h2 class="text-2xl text-white font-semibold mb-4">2. Booking and Reservations</h2>
                    
                    <div class="space-y-4 text-gray-300">
                        <div>
                            <h3 class="text-lg text-emerald-400 font-semibold mb-2">2.1 Booking Confirmation</h3>
                            <p>All bookings are subject to availability. A booking is confirmed only when you receive a confirmation email from us after successful payment processing.</p>
                        </div>

                        <div>
                            <h3 class="text-lg text-emerald-400 font-semibold mb-2">2.2 Accuracy of Information</h3>
                            <p>You are responsible for ensuring that all information provided during booking (name, contact details, dates, number of guests) is accurate and complete. Errors may result in booking cancellation or additional charges.</p>
                        </div>

                        <div>
                            <h3 class="text-lg text-emerald-400 font-semibold mb-2">2.3 Minimum Age Requirement</h3>
                            <p>Guests must be at least 18 years of age to make a booking. Minors must be accompanied by an adult guardian.</p>
                        </div>

                        <div>
                            <h3 class="text-lg text-emerald-400 font-semibold mb-2">2.4 Room Availability</h3>
                            <p>Room availability displayed on our website is updated in real-time but not guaranteed until booking confirmation. We reserve the right to offer an alternative room of equal or higher value if your selected room becomes unavailable.</p>
                        </div>
                    </div>
                </div>

                <!-- Payment Terms -->
                <div>
                    <h2 class="text-2xl text-white font-semibold mb-4">3. Payment Terms</h2>
                    
                    <div class="space-y-3 text-gray-300">
                        <p><strong class="text-white">3.1 Payment Methods:</strong> We accept payments via credit/debit cards and digital wallets through PayHere, as well as bank transfers.</p>
                        <p><strong class="text-white">3.2 Advance Payment:</strong> An advance payment of 30-50% of the total booking amount is required at the time of booking. The remaining balance must be paid upon check-in or as specified in your booking confirmation.</p>
                        <p><strong class="text-white">3.3 Payment Security:</strong> All online payments are processed through PayHere, a PCI-DSS compliant payment gateway. We do not store your credit card information.</p>
                        <p><strong class="text-white">3.4 Currency:</strong> All prices are listed in Sri Lankan Rupees (LKR) unless otherwise stated.</p>
                        <p><strong class="text-white">3.5 Price Changes:</strong> Prices are subject to change without notice. The price applicable to your booking is the price displayed at the time of confirmation.</p>
                    </div>
                </div>

                <!-- Check-in and Check-out -->
                <div>
                    <h2 class="text-2xl text-white font-semibold mb-4">4. Check-in and Check-out</h2>
                    
                    <div class="bg-gray-800/50 p-6 rounded-lg space-y-3 text-gray-300">
                        <p><strong class="text-white">Check-in Time:</strong> 2:00 PM onwards</p>
                        <p><strong class="text-white">Check-out Time:</strong> 11:00 AM</p>
                        <p class="pt-2">Early check-in or late check-out may be available upon request and subject to availability. Additional charges may apply.</p>
                        <p>Valid government-issued photo identification (NIC, Passport, Driving License) is required at check-in for all guests.</p>
                    </div>
                </div>

                <!-- Guest Responsibilities -->
                <div>
                    <h2 class="text-2xl text-white font-semibold mb-4">5. Guest Responsibilities</h2>
                    
                    <p class="text-gray-300 mb-3">As a guest, you agree to:</p>
                    <ul class="space-y-2 text-gray-300">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-emerald-500 mr-3 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span>Respect the property, other guests, and staff</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-emerald-500 mr-3 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span>Comply with all hotel rules and regulations</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-emerald-500 mr-3 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span>Not engage in illegal activities on the premises</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-emerald-500 mr-3 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span>Not smoke in non-smoking areas</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-emerald-500 mr-3 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span>Be responsible for any damage caused to the property during your stay</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-emerald-500 mr-3 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span>Keep noise levels reasonable, especially during quiet hours (10 PM - 7 AM)</span>
                        </li>
                    </ul>
                </div>

                <!-- Liability -->
                <div>
                    <h2 class="text-2xl text-white font-semibold mb-4">6. Limitation of Liability</h2>
                    
                    <div class="space-y-3 text-gray-300">
                        <p><strong class="text-white">6.1 Personal Belongings:</strong> We are not responsible for loss or damage to guests' personal belongings. We recommend using the in-room safe for valuables.</p>
                        <p><strong class="text-white">6.2 Accidents and Injuries:</strong> While we maintain safe premises, we are not liable for accidents or injuries resulting from guest negligence or failure to follow safety instructions.</p>
                        <p><strong class="text-white">6.3 Third-Party Services:</strong> We may provide information about third-party services (tours, transportation, activities). We are not responsible for the quality or safety of these external services.</p>
                        <p><strong class="text-white">6.4 Force Majeure:</strong> We are not liable for failure to perform our obligations due to circumstances beyond our control (natural disasters, government actions, pandemics, etc.).</p>
                    </div>
                </div>

                <!-- Damages and Additional Charges -->
                <div>
                    <h2 class="text-2xl text-white font-semibold mb-4">7. Damages and Additional Charges</h2>
                    
                    <p class="text-gray-300 mb-3">Guests are liable for:</p>
                    <ul class="space-y-2 text-gray-300 list-disc list-inside ml-4">
                        <li>Any damage to the room, furniture, or hotel property caused during their stay</li>
                        <li>Missing items from the room (towels, robes, etc.)</li>
                        <li>Excessive cleaning required due to guest negligence</li>
                        <li>Unauthorized additional guests or pets</li>
                        <li>Smoking in non-smoking rooms</li>
                    </ul>
                    <p class="text-gray-300 mt-3">Charges for damages will be assessed and charged to your payment method on file.</p>
                </div>

                <!-- Right to Refuse Service -->
                <div>
                    <h2 class="text-2xl text-white font-semibold mb-4">8. Right to Refuse Service</h2>
                    
                    <p class="text-gray-300">
                        We reserve the right to refuse service or terminate a booking without refund if a guest:
                    </p>
                    <ul class="space-y-1 text-gray-300 list-disc list-inside ml-4 mt-2">
                        <li>Violates these Terms and Conditions</li>
                        <li>Engages in disruptive, threatening, or illegal behavior</li>
                        <li>Damages property or poses a safety risk</li>
                        <li>Provides false or fraudulent information</li>
                        <li>Has unpaid charges from previous visits</li>
                    </ul>
                </div>

                <!-- Pets Policy -->
                <div>
                    <h2 class="text-2xl text-white font-semibold mb-4">9. Pets Policy</h2>
                    <p class="text-gray-300">
                        Pets are not allowed on the premises unless prior approval has been obtained and documented in your booking confirmation. Unauthorized pets will result in additional cleaning fees and may lead to booking termination.
                    </p>
                </div>

                <!-- Privacy and Data Protection -->
                <div>
                    <h2 class="text-2xl text-white font-semibold mb-4">10. Privacy and Data Protection</h2>
                    <p class="text-gray-300">
                        Your use of our website and services is subject to our <a href="{{ route('policies.privacy-policy') }}" class="text-emerald-400 hover:underline">Privacy Policy</a>, which explains how we collect, use, and protect your personal information.
                    </p>
                </div>

                <!-- Intellectual Property -->
                <div>
                    <h2 class="text-2xl text-white font-semibold mb-4">11. Intellectual Property</h2>
                    <p class="text-gray-300">
                        All content on this website (text, images, logos, videos) is the property of Soba Lanka and protected by copyright laws. You may not reproduce, distribute, or use any content without our written permission.
                    </p>
                </div>

                <!-- Website Use -->
                <div>
                    <h2 class="text-2xl text-white font-semibold mb-4">12. Website Use and Restrictions</h2>
                    <p class="text-gray-300 mb-3">You agree not to:</p>
                    <ul class="space-y-1 text-gray-300 list-disc list-inside ml-4">
                        <li>Use the website for any unlawful purpose</li>
                        <li>Attempt to gain unauthorized access to our systems</li>
                        <li>Transmit viruses or malicious code</li>
                        <li>Scrape or harvest data from the website</li>
                        <li>Interfere with the proper functioning of the website</li>
                        <li>Impersonate another person or entity</li>
                    </ul>
                </div>

                <!-- Dispute Resolution -->
                <div>
                    <h2 class="text-2xl text-white font-semibold mb-4">13. Dispute Resolution and Governing Law</h2>
                    <div class="space-y-3 text-gray-300">
                        <p><strong class="text-white">13.1 Governing Law:</strong> These Terms and Conditions are governed by the laws of Sri Lanka.</p>
                        <p><strong class="text-white">13.2 Jurisdiction:</strong> Any disputes arising from these terms shall be subject to the exclusive jurisdiction of the courts of Sri Lanka.</p>
                        <p><strong class="text-white">13.3 Amicable Resolution:</strong> We encourage resolving disputes through direct communication. Please contact us first before pursuing legal action.</p>
                    </div>
                </div>

                <!-- Modifications to Terms -->
                <div>
                    <h2 class="text-2xl text-white font-semibold mb-4">14. Modifications to Terms</h2>
                    <p class="text-gray-300">
                        We reserve the right to modify these Terms and Conditions at any time. Changes will be effective immediately upon posting on this page. Your continued use of our services after changes constitutes acceptance of the modified terms. We recommend reviewing this page periodically.
                    </p>
                </div>

                <!-- Severability -->
                <div>
                    <h2 class="text-2xl text-white font-semibold mb-4">15. Severability</h2>
                    <p class="text-gray-300">
                        If any provision of these Terms and Conditions is found to be invalid or unenforceable, the remaining provisions shall continue in full force and effect.
                    </p>
                </div>

                <!-- Contact Information -->
                <div class="bg-emerald-500/10 border border-emerald-500/30 rounded-lg p-6">
                    <h2 class="text-2xl text-emerald-400 font-semibold mb-4">Questions or Concerns?</h2>
                    <p class="text-gray-300 mb-4">
                        If you have any questions about these Terms and Conditions, please contact us:
                    </p>
                    <div class="space-y-2 text-gray-300">
                        <p><strong class="text-white">Soba Lanka</strong></p>
                        <p><strong class="text-white">Email:</strong> <a href="mailto:info@sobalanka.com" class="text-emerald-400 hover:underline">info@sobalanka.com</a></p>
                        <p><strong class="text-white">Phone:</strong> <a href="tel:+94717152955" class="text-emerald-400 hover:underline">071 715 2955</a></p>
                        <p><strong class="text-white">Website:</strong> <a href="https://sobalanka.com" class="text-emerald-400 hover:underline">sobalanka.com</a></p>
                    </div>
                </div>

                <!-- Acknowledgment -->
                <div class="bg-gray-800/50 p-4 rounded-lg">
                    <p class="text-gray-400 text-sm">
                        By making a booking, you acknowledge that you have read, understood, and agree to be bound by these Terms and Conditions, along with our Privacy Policy and Return & Refund Policy.
                    </p>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
