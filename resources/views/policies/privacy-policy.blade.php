@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-black py-24">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            
            <!-- Header -->
            <div class="text-center mb-12">
                <h1 class="text-4xl text-white font-light mb-4">Privacy Policy</h1>
                <p class="text-gray-400">Last Updated: {{ date('F d, Y') }}</p>
            </div>

            <div class="bg-gray-900 rounded-lg p-8 border border-gray-800 space-y-8">
                
                <!-- Introduction -->
                <div>
                    <p class="text-gray-300 leading-relaxed">
                        At Soba Lanka ("we," "us," or "our"), we are committed to protecting your privacy and ensuring the security of your personal information. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you visit our website <a href="https://sobalanka.com" class="text-emerald-400 hover:underline">sobalanka.com</a> and make bookings with us.
                    </p>
                </div>

                <!-- Information We Collect -->
                <div>
                    <h2 class="text-2xl text-white font-semibold mb-4">1. Information We Collect</h2>
                    
                    <div class="space-y-4">
                        <div>
                            <h3 class="text-lg text-emerald-400 font-semibold mb-2">Personal Information</h3>
                            <p class="text-gray-300 mb-2">When you make a booking or register on our website, we may collect:</p>
                            <ul class="space-y-1 text-gray-300 list-disc list-inside ml-4">
                                <li>Full name</li>
                                <li>Email address</li>
                                <li>Phone number</li>
                                <li>Billing address</li>
                                <li>Payment information (processed securely through PayHere)</li>
                                <li>Check-in and check-out dates</li>
                                <li>Number of guests</li>
                                <li>Special requests or preferences</li>
                            </ul>
                        </div>

                        <div>
                            <h3 class="text-lg text-emerald-400 font-semibold mb-2">Automatically Collected Information</h3>
                            <p class="text-gray-300 mb-2">When you visit our website, we automatically collect:</p>
                            <ul class="space-y-1 text-gray-300 list-disc list-inside ml-4">
                                <li>IP address</li>
                                <li>Browser type and version</li>
                                <li>Device information</li>
                                <li>Pages visited and time spent</li>
                                <li>Referring website</li>
                                <li>Cookies and similar tracking technologies</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- How We Use Your Information -->
                <div>
                    <h2 class="text-2xl text-white font-semibold mb-4">2. How We Use Your Information</h2>
                    <p class="text-gray-300 mb-3">We use the information we collect for the following purposes:</p>
                    <ul class="space-y-2 text-gray-300">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-emerald-500 mr-3 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span><strong class="text-white">Processing Bookings:</strong> To confirm and manage your reservations</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-emerald-500 mr-3 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span><strong class="text-white">Communication:</strong> To send booking confirmations, updates, and respond to inquiries</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-emerald-500 mr-3 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span><strong class="text-white">Payment Processing:</strong> To securely process payments through our payment gateway partner (PayHere)</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-emerald-500 mr-3 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span><strong class="text-white">Service Improvement:</strong> To improve our website, services, and customer experience</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-emerald-500 mr-3 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span><strong class="text-white">Marketing:</strong> To send promotional offers and updates (only with your consent)</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-emerald-500 mr-3 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span><strong class="text-white">Legal Compliance:</strong> To comply with legal obligations and resolve disputes</span>
                        </li>
                    </ul>
                </div>

                <!-- How We Share Your Information -->
                <div>
                    <h2 class="text-2xl text-white font-semibold mb-4">3. How We Share Your Information</h2>
                    <p class="text-gray-300 mb-3">We do not sell or rent your personal information to third parties. We may share your information with:</p>
                    <div class="space-y-3 text-gray-300">
                        <p><strong class="text-white">Payment Processors:</strong> We use PayHere to process payments securely. Your payment information is transmitted directly to PayHere and is subject to their privacy policy.</p>
                        <p><strong class="text-white">Service Providers:</strong> Trusted third-party vendors who assist us with website hosting, email delivery, and analytics.</p>
                        <p><strong class="text-white">Legal Requirements:</strong> When required by law, court order, or government regulation.</p>
                        <p><strong class="text-white">Business Transfers:</strong> In the event of a merger, acquisition, or sale of assets, your information may be transferred.</p>
                    </div>
                </div>

                <!-- Data Security -->
                <div>
                    <h2 class="text-2xl text-white font-semibold mb-4">4. Data Security</h2>
                    <p class="text-gray-300 mb-3">
                        We implement industry-standard security measures to protect your personal information:
                    </p>
                    <ul class="space-y-2 text-gray-300 list-disc list-inside ml-4">
                        <li>SSL/TLS encryption for data transmission</li>
                        <li>Secure payment processing through PCI-DSS compliant PayHere</li>
                        <li>Regular security audits and updates</li>
                        <li>Access controls and password protection</li>
                        <li>Secure database storage with encryption</li>
                    </ul>
                    <p class="text-gray-300 mt-3">
                        However, no method of transmission over the internet is 100% secure. While we strive to protect your information, we cannot guarantee absolute security.
                    </p>
                </div>

                <!-- Cookies -->
                <div>
                    <h2 class="text-2xl text-white font-semibold mb-4">5. Cookies and Tracking Technologies</h2>
                    <p class="text-gray-300 mb-3">
                        We use cookies and similar technologies to enhance your browsing experience. Cookies are small text files stored on your device that help us:
                    </p>
                    <ul class="space-y-1 text-gray-300 list-disc list-inside ml-4">
                        <li>Remember your preferences and settings</li>
                        <li>Understand how you use our website</li>
                        <li>Improve website performance and functionality</li>
                        <li>Provide personalized content and offers</li>
                    </ul>
                    <p class="text-gray-300 mt-3">
                        You can control cookies through your browser settings. However, disabling cookies may affect your ability to use certain features of our website.
                    </p>
                </div>

                <!-- Your Rights -->
                <div>
                    <h2 class="text-2xl text-white font-semibold mb-4">6. Your Rights and Choices</h2>
                    <p class="text-gray-300 mb-3">You have the right to:</p>
                    <div class="space-y-2 text-gray-300">
                        <p><strong class="text-emerald-400">Access:</strong> Request a copy of the personal information we hold about you</p>
                        <p><strong class="text-emerald-400">Correction:</strong> Request corrections to inaccurate or incomplete information</p>
                        <p><strong class="text-emerald-400">Deletion:</strong> Request deletion of your personal information (subject to legal requirements)</p>
                        <p><strong class="text-emerald-400">Opt-Out:</strong> Unsubscribe from marketing communications at any time</p>
                        <p><strong class="text-emerald-400">Data Portability:</strong> Request your data in a structured, commonly used format</p>
                    </div>
                    <p class="text-gray-300 mt-3">
                        To exercise any of these rights, please contact us at <a href="mailto:info@sobalanka.com" class="text-emerald-400 hover:underline">info@sobalanka.com</a>
                    </p>
                </div>

                <!-- Data Retention -->
                <div>
                    <h2 class="text-2xl text-white font-semibold mb-4">7. Data Retention</h2>
                    <p class="text-gray-300">
                        We retain your personal information for as long as necessary to fulfill the purposes outlined in this policy, comply with legal obligations, resolve disputes, and enforce our agreements. Booking records are typically retained for 7 years for accounting and legal purposes.
                    </p>
                </div>

                <!-- Children's Privacy -->
                <div>
                    <h2 class="text-2xl text-white font-semibold mb-4">8. Children's Privacy</h2>
                    <p class="text-gray-300">
                        Our services are not intended for individuals under the age of 18. We do not knowingly collect personal information from children. If you believe we have collected information from a child, please contact us immediately.
                    </p>
                </div>

                <!-- International Transfers -->
                <div>
                    <h2 class="text-2xl text-white font-semibold mb-4">9. International Data Transfers</h2>
                    <p class="text-gray-300">
                        Your information may be transferred to and processed in countries other than Sri Lanka. We ensure that appropriate safeguards are in place to protect your information in accordance with this Privacy Policy.
                    </p>
                </div>

                <!-- Changes to Privacy Policy -->
                <div>
                    <h2 class="text-2xl text-white font-semibold mb-4">10. Changes to This Privacy Policy</h2>
                    <p class="text-gray-300">
                        We may update this Privacy Policy from time to time. We will notify you of any changes by posting the new policy on this page and updating the "Last Updated" date. We encourage you to review this policy periodically.
                    </p>
                </div>

                <!-- Contact Information -->
                <div class="bg-emerald-500/10 border border-emerald-500/30 rounded-lg p-6">
                    <h2 class="text-2xl text-emerald-400 font-semibold mb-4">Contact Us</h2>
                    <p class="text-gray-300 mb-4">
                        If you have any questions or concerns about this Privacy Policy or our data practices, please contact us:
                    </p>
                    <div class="space-y-2 text-gray-300">
                        <p><strong class="text-white">Soba Lanka</strong></p>
                        <p><strong class="text-white">Email:</strong> <a href="mailto:info@sobalanka.com" class="text-emerald-400 hover:underline">info@sobalanka.com</a></p>
                        <p><strong class="text-white">Phone:</strong> <a href="tel:+94717152955" class="text-emerald-400 hover:underline">071 715 2955</a></p>
                        <p><strong class="text-white">Address:</strong> Soba Lanka, Sri Lanka</p>
                    </div>
                </div>

                <!-- Compliance -->
                <div class="bg-gray-800/50 p-4 rounded-lg">
                    <p class="text-gray-400 text-sm">
                        This Privacy Policy is designed to comply with the Sri Lankan Personal Data Protection Act and international best practices for data protection.
                    </p>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
