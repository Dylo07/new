<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Booking Notification</title>
</head>
<body style="margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f4f4;">
    <table role="presentation" style="width: 100%; border-collapse: collapse;">
        <tr>
            <td align="center" style="padding: 40px 0;">
                <table role="presentation" style="width: 600px; border-collapse: collapse; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);">
                    
                    <!-- Header -->
                    <tr>
                        <td style="background: linear-gradient(135deg, #1f2937 0%, #374151 100%); padding: 30px; text-align: center;">
                            <h1 style="color: #ffffff; margin: 0; font-size: 24px; font-weight: 600;">🔔 New Booking Alert</h1>
                            <p style="color: #10b981; margin: 10px 0 0 0; font-size: 14px; font-weight: 600;">Soba Lanka Holiday Resort</p>
                        </td>
                    </tr>

                    <!-- Alert Banner -->
                    <tr>
                        <td style="padding: 25px 30px 15px 30px;">
                            <table role="presentation" style="width: 100%; background-color: #fef3c7; border-radius: 8px; border-left: 4px solid #f59e0b;">
                                <tr>
                                    <td style="padding: 15px 20px;">
                                        <p style="color: #92400e; margin: 0; font-size: 14px; font-weight: 600;">
                                            ⚡ A new booking requires your attention
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Booking Reference -->
                    <tr>
                        <td style="padding: 10px 30px 20px 30px;">
                            <table role="presentation" style="width: 100%; background-color: #f0fdf4; border-radius: 8px; border: 1px solid #bbf7d0;">
                                <tr>
                                    <td style="padding: 20px; text-align: center;">
                                        <p style="color: #6b7280; margin: 0 0 5px 0; font-size: 12px; text-transform: uppercase; letter-spacing: 1px;">Booking ID</p>
                                        <p style="color: #059669; margin: 0; font-size: 36px; font-weight: 700;">#{{ $booking->id }}</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Customer Information -->
                    <tr>
                        <td style="padding: 0 30px 20px 30px;">
                            <table role="presentation" style="width: 100%; border-collapse: collapse; background-color: #f9fafb; border-radius: 8px; overflow: hidden;">
                                <tr>
                                    <td colspan="2" style="padding: 15px 20px; background-color: #3b82f6;">
                                        <h3 style="color: #ffffff; margin: 0; font-size: 14px; font-weight: 600;">👤 Customer Information</h3>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 12px 20px; border-bottom: 1px solid #e5e7eb; color: #6b7280; font-size: 13px; width: 40%;">Name</td>
                                    <td style="padding: 12px 20px; border-bottom: 1px solid #e5e7eb; color: #1f2937; font-size: 13px; font-weight: 600;">{{ $user->name }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 12px 20px; color: #6b7280; font-size: 13px;">Email</td>
                                    <td style="padding: 12px 20px; color: #1f2937; font-size: 13px;">
                                        <a href="mailto:{{ $user->email }}" style="color: #3b82f6; text-decoration: none;">{{ $user->email }}</a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Booking Details -->
                    <tr>
                        <td style="padding: 0 30px 20px 30px;">
                            <table role="presentation" style="width: 100%; border-collapse: collapse; background-color: #f9fafb; border-radius: 8px; overflow: hidden;">
                                <tr>
                                    <td colspan="2" style="padding: 15px 20px; background-color: #059669;">
                                        <h3 style="color: #ffffff; margin: 0; font-size: 14px; font-weight: 600;">📋 Booking Details</h3>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 12px 20px; border-bottom: 1px solid #e5e7eb; color: #6b7280; font-size: 13px; width: 40%;">Package</td>
                                    <td style="padding: 12px 20px; border-bottom: 1px solid #e5e7eb; color: #059669; font-size: 13px; font-weight: 600;">{{ $package->name }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 12px 20px; border-bottom: 1px solid #e5e7eb; color: #6b7280; font-size: 13px;">Check-in</td>
                                    <td style="padding: 12px 20px; border-bottom: 1px solid #e5e7eb; color: #1f2937; font-size: 13px;">
                                        {{ \Carbon\Carbon::parse($booking->check_in)->format('D, M d, Y') }} 
                                        <span style="color: #059669; font-weight: 600;">at {{ $checkInTime }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 12px 20px; border-bottom: 1px solid #e5e7eb; color: #6b7280; font-size: 13px;">Check-out</td>
                                    <td style="padding: 12px 20px; border-bottom: 1px solid #e5e7eb; color: #1f2937; font-size: 13px;">
                                        {{ \Carbon\Carbon::parse($booking->check_out)->format('D, M d, Y') }} 
                                        <span style="color: #059669; font-weight: 600;">at {{ $checkOutTime }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 12px 20px; border-bottom: 1px solid #e5e7eb; color: #6b7280; font-size: 13px;">Guests</td>
                                    <td style="padding: 12px 20px; border-bottom: 1px solid #e5e7eb; color: #1f2937; font-size: 13px;">
                                        {{ $booking->guests }} Adults
                                        @if(isset($booking->package_details['children']) && $booking->package_details['children'] > 0)
                                            , {{ $booking->package_details['children'] }} Children
                                        @endif
                                    </td>
                                </tr>
                                <tr style="background-color: #f0fdf4;">
                                    <td style="padding: 15px 20px; color: #1f2937; font-size: 14px; font-weight: 600;">Total Amount</td>
                                    <td style="padding: 15px 20px; color: #059669; font-size: 20px; font-weight: 700;">Rs {{ number_format($booking->total_price, 0) }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Payment Status -->
                    <tr>
                        <td style="padding: 0 30px 20px 30px;">
                            <table role="presentation" style="width: 100%; border-collapse: collapse; background-color: {{ $booking->payment_receipt ? '#f0fdf4' : '#fef2f2' }}; border-radius: 8px; border: 1px solid {{ $booking->payment_receipt ? '#bbf7d0' : '#fecaca' }};">
                                <tr>
                                    <td style="padding: 20px;">
                                        <h4 style="color: {{ $booking->payment_receipt ? '#059669' : '#dc2626' }}; margin: 0 0 10px 0; font-size: 14px; font-weight: 600;">
                                            💳 Payment Status
                                        </h4>
                                        <p style="color: #374151; margin: 0 0 5px 0; font-size: 13px;">
                                            <strong>Method:</strong> {{ ucfirst(str_replace('_', ' ', $booking->payment_method)) }}
                                        </p>
                                        <p style="color: {{ $booking->payment_receipt ? '#059669' : '#dc2626' }}; margin: 0; font-size: 13px; font-weight: 600;">
                                            <strong>Status:</strong> {{ $booking->payment_receipt ? '✅ Receipt Uploaded' : '⏳ Awaiting Receipt' }}
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Action Button -->
                    <tr>
                        <td style="padding: 0 30px 30px 30px; text-align: center;">
                            <a href="{{ url('/admin/bookings') }}" style="display: inline-block; background: linear-gradient(135deg, #1f2937 0%, #374151 100%); color: #ffffff; text-decoration: none; padding: 14px 40px; border-radius: 8px; font-size: 14px; font-weight: 600;">
                                View in Admin Panel
                            </a>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #1f2937; padding: 25px; text-align: center;">
                            <p style="color: #9ca3af; margin: 0 0 5px 0; font-size: 12px;">
                                This is an automated notification from Soba Lanka Hotel Booking System
                            </p>
                            <p style="color: #6b7280; margin: 0; font-size: 11px;">
                                © {{ date('Y') }} Soba Lanka Holiday Resort
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>
