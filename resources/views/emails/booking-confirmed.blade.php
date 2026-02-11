<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmed</title>
</head>
<body style="margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f4f4;">
    <table role="presentation" style="width: 100%; border-collapse: collapse;">
        <tr>
            <td align="center" style="padding: 40px 0;">
                <table role="presentation" style="width: 600px; border-collapse: collapse; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);">
                    
                    <!-- Header -->
                    <tr>
                        <td style="background: linear-gradient(135deg, #059669 0%, #10b981 100%); padding: 40px 30px; text-align: center;">
                            <h1 style="color: #ffffff; margin: 0; font-size: 28px; font-weight: 600;">Soba Lanka</h1>
                            <p style="color: rgba(255,255,255,0.9); margin: 5px 0 0 0; font-size: 14px; letter-spacing: 2px;">HOLIDAY RESORT</p>
                        </td>
                    </tr>

                    <!-- Success Icon -->
                    <tr>
                        <td style="padding: 40px 30px 20px 30px; text-align: center;">
                            <div style="width: 70px; height: 70px; background-color: #10b981; border-radius: 50%; margin: 0 auto; display: flex; align-items: center; justify-content: center;">
                                <span style="color: white; font-size: 36px;">✓</span>
                            </div>
                            <h2 style="color: #1f2937; margin: 20px 0 10px 0; font-size: 24px;">Booking Confirmed!</h2>
                            <p style="color: #6b7280; margin: 0; font-size: 16px;">Your payment has been verified and your booking is now confirmed</p>
                        </td>
                    </tr>

                    <!-- Greeting -->
                    <tr>
                        <td style="padding: 0 30px 20px 30px;">
                            <p style="color: #374151; font-size: 16px; line-height: 1.6; margin: 0;">
                                Dear <strong>{{ $booking->user->name }}</strong>,
                            </p>
                            <p style="color: #6b7280; font-size: 15px; line-height: 1.6; margin: 10px 0 0 0;">
                                Great news! Your payment has been verified and your reservation is now confirmed. We look forward to welcoming you!
                            </p>
                        </td>
                    </tr>

                    <!-- Booking Reference -->
                    <tr>
                        <td style="padding: 0 30px 20px 30px;">
                            <table role="presentation" style="width: 100%; background-color: #f0fdf4; border-radius: 8px; border: 1px solid #bbf7d0;">
                                <tr>
                                    <td style="padding: 20px; text-align: center;">
                                        <p style="color: #6b7280; margin: 0 0 5px 0; font-size: 12px; text-transform: uppercase; letter-spacing: 1px;">Booking Reference</p>
                                        <p style="color: #059669; margin: 0; font-size: 32px; font-weight: 700;">#{{ $booking->id }}</p>
                                        <p style="color: #059669; margin: 10px 0 0 0; font-size: 14px; font-weight: 600;">STATUS: CONFIRMED</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Booking Details -->
                    <tr>
                        <td style="padding: 0 30px 30px 30px;">
                            <table role="presentation" style="width: 100%; border-collapse: collapse; background-color: #f9fafb; border-radius: 8px; overflow: hidden;">
                                <tr>
                                    <td colspan="2" style="padding: 15px 20px; background-color: #1f2937;">
                                        <h3 style="color: #ffffff; margin: 0; font-size: 16px; font-weight: 600;">Booking Details</h3>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 15px 20px; border-bottom: 1px solid #e5e7eb; color: #6b7280; font-size: 14px;">Package</td>
                                    <td style="padding: 15px 20px; border-bottom: 1px solid #e5e7eb; color: #1f2937; font-size: 14px; font-weight: 600; text-align: right;">{{ $booking->customPackage->name ?? 'Custom Booking' }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 15px 20px; border-bottom: 1px solid #e5e7eb; color: #6b7280; font-size: 14px;">Check-in</td>
                                    <td style="padding: 15px 20px; border-bottom: 1px solid #e5e7eb; color: #1f2937; font-size: 14px; text-align: right;">
                                        {{ \Carbon\Carbon::parse($booking->check_in)->format('D, M d, Y') }}
                                        <br><span style="color: #059669; font-weight: 600;">{{ $checkInTime }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 15px 20px; border-bottom: 1px solid #e5e7eb; color: #6b7280; font-size: 14px;">Check-out</td>
                                    <td style="padding: 15px 20px; border-bottom: 1px solid #e5e7eb; color: #1f2937; font-size: 14px; text-align: right;">
                                        {{ \Carbon\Carbon::parse($booking->check_out)->format('D, M d, Y') }}
                                        <br><span style="color: #059669; font-weight: 600;">{{ $checkOutTime }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 15px 20px; border-bottom: 1px solid #e5e7eb; color: #6b7280; font-size: 14px;">Guests</td>
                                    <td style="padding: 15px 20px; border-bottom: 1px solid #e5e7eb; color: #1f2937; font-size: 14px; text-align: right;">
                                        {{ $booking->guests }} Adults
                                        @if(isset($booking->package_details['children']) && $booking->package_details['children'] > 0)
                                            , {{ $booking->package_details['children'] }} Children
                                        @endif
                                    </td>
                                </tr>
                                <tr style="background-color: #f0fdf4;">
                                    <td style="padding: 20px; color: #1f2937; font-size: 16px; font-weight: 600;">Total Amount</td>
                                    <td style="padding: 20px; color: #059669; font-size: 24px; font-weight: 700; text-align: right;">Rs {{ number_format($booking->total_price, 0) }}</td>
                                </tr>
                                <tr style="background-color: #f0fdf4;">
                                    <td style="padding: 0 20px 20px 20px; color: #1f2937; font-size: 14px;">Payment Status</td>
                                    <td style="padding: 0 20px 20px 20px; color: #059669; font-size: 14px; font-weight: 600; text-align: right;">Verified ✓</td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Important Info -->
                    <tr>
                        <td style="padding: 0 30px 30px 30px;">
                            <table role="presentation" style="width: 100%; border-collapse: collapse; background-color: #f0fdf4; border-radius: 8px; border: 1px solid #bbf7d0;">
                                <tr>
                                    <td style="padding: 20px;">
                                        <h4 style="color: #065f46; margin: 0 0 10px 0; font-size: 14px; font-weight: 600;">Important Information</h4>
                                        <ul style="color: #047857; margin: 0; padding-left: 20px; font-size: 13px; line-height: 1.8;">
                                            <li>Please arrive on time for a smooth check-in experience.</li>
                                            <li>Carry a valid photo ID for verification at check-in.</li>
                                            <li>For any changes or cancellations, please contact us at least 48 hours in advance.</li>
                                        </ul>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- CTA Button -->
                    <tr>
                        <td style="padding: 0 30px 30px 30px; text-align: center;">
                            <a href="{{ url('/profile') }}" style="display: inline-block; background: linear-gradient(135deg, #059669 0%, #10b981 100%); color: #ffffff; text-decoration: none; padding: 14px 40px; border-radius: 8px; font-size: 14px; font-weight: 600;">
                                View My Bookings
                            </a>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #1f2937; padding: 30px; text-align: center;">
                            <p style="color: #9ca3af; margin: 0 0 10px 0; font-size: 14px;">
                                Balawattala Road, Melsiripura 60540
                            </p>
                            <p style="color: #9ca3af; margin: 0 0 15px 0; font-size: 14px;">
                                037 22 50 308 | 071 71 52 955
                            </p>
                            <p style="color: #6b7280; margin: 0; font-size: 12px;">
                                &copy; {{ date('Y') }} Soba Lanka Holiday Resort. All rights reserved.
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>
