<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Receipt Uploaded</title>
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

                    <!-- Alert Icon -->
                    <tr>
                        <td style="padding: 40px 30px 20px 30px; text-align: center;">
                            <div style="width: 70px; height: 70px; background-color: #f59e0b; border-radius: 50%; margin: 0 auto; display: flex; align-items: center; justify-content: center;">
                                <span style="color: white; font-size: 36px;">📄</span>
                            </div>
                            <h2 style="color: #1f2937; margin: 20px 0 10px 0; font-size: 24px;">Payment Receipt Uploaded!</h2>
                            <p style="color: #6b7280; margin: 0; font-size: 16px;">A customer has uploaded their payment receipt</p>
                        </td>
                    </tr>

                    <!-- Booking Reference -->
                    <tr>
                        <td style="padding: 0 30px 20px 30px;">
                            <table role="presentation" style="width: 100%; background-color: #fef3c7; border-radius: 8px; border: 2px solid #f59e0b;">
                                <tr>
                                    <td style="padding: 20px; text-align: center;">
                                        <p style="color: #92400e; margin: 0 0 5px 0; font-size: 12px; text-transform: uppercase; letter-spacing: 1px;">Booking Reference</p>
                                        <p style="color: #b45309; margin: 0; font-size: 32px; font-weight: 700;">#{{ $booking->id }}</p>
                                        <p style="color: #92400e; margin: 10px 0 0 0; font-size: 14px; font-weight: 600;">⚡ Ready for Quick Approval</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Customer Details -->
                    <tr>
                        <td style="padding: 0 30px 30px 30px;">
                            <table role="presentation" style="width: 100%; border-collapse: collapse; background-color: #f9fafb; border-radius: 8px; overflow: hidden;">
                                <tr>
                                    <td colspan="2" style="padding: 15px 20px; background-color: #1f2937;">
                                        <h3 style="color: #ffffff; margin: 0; font-size: 16px; font-weight: 600;">Customer Details</h3>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 15px 20px; border-bottom: 1px solid #e5e7eb; color: #6b7280; font-size: 14px;">Name</td>
                                    <td style="padding: 15px 20px; border-bottom: 1px solid #e5e7eb; color: #1f2937; font-size: 14px; font-weight: 600; text-align: right;">{{ $user->name }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 15px 20px; border-bottom: 1px solid #e5e7eb; color: #6b7280; font-size: 14px;">Email</td>
                                    <td style="padding: 15px 20px; border-bottom: 1px solid #e5e7eb; color: #1f2937; font-size: 14px; text-align: right;">{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 15px 20px; border-bottom: 1px solid #e5e7eb; color: #6b7280; font-size: 14px;">Phone</td>
                                    <td style="padding: 15px 20px; border-bottom: 1px solid #e5e7eb; color: #1f2937; font-size: 14px; text-align: right;">{{ $user->phone ?? 'Not provided' }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 15px 20px; border-bottom: 1px solid #e5e7eb; color: #6b7280; font-size: 14px;">Package</td>
                                    <td style="padding: 15px 20px; border-bottom: 1px solid #e5e7eb; color: #059669; font-size: 14px; font-weight: 600; text-align: right;">{{ $package->name ?? 'Custom Booking' }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 15px 20px; border-bottom: 1px solid #e5e7eb; color: #6b7280; font-size: 14px;">Check-in</td>
                                    <td style="padding: 15px 20px; border-bottom: 1px solid #e5e7eb; color: #1f2937; font-size: 14px; text-align: right;">{{ \Carbon\Carbon::parse($booking->check_in)->format('D, M d, Y') }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 15px 20px; border-bottom: 1px solid #e5e7eb; color: #6b7280; font-size: 14px;">Check-out</td>
                                    <td style="padding: 15px 20px; border-bottom: 1px solid #e5e7eb; color: #1f2937; font-size: 14px; text-align: right;">{{ \Carbon\Carbon::parse($booking->check_out)->format('D, M d, Y') }}</td>
                                </tr>
                                <tr style="background-color: #f0fdf4;">
                                    <td style="padding: 20px; color: #1f2937; font-size: 16px; font-weight: 600;">Total Amount</td>
                                    <td style="padding: 20px; color: #059669; font-size: 24px; font-weight: 700; text-align: right;">Rs {{ number_format($booking->total_price, 0) }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Action Required -->
                    <tr>
                        <td style="padding: 0 30px 30px 30px;">
                            <table role="presentation" style="width: 100%; border-collapse: collapse; background-color: #fef3c7; border-radius: 8px; border: 1px solid #fcd34d;">
                                <tr>
                                    <td style="padding: 20px; text-align: center;">
                                        <h4 style="color: #92400e; margin: 0 0 10px 0; font-size: 16px; font-weight: 600;">⚡ Action Required</h4>
                                        <p style="color: #78350f; margin: 0; font-size: 14px;">
                                            Please review the uploaded receipt and approve the booking using the <strong>Quick Approve</strong> button in the admin panel.
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- CTA Button -->
                    <tr>
                        <td style="padding: 0 30px 30px 30px; text-align: center;">
                            <a href="{{ url('/admin/bookings') }}" style="display: inline-block; background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: #ffffff; text-decoration: none; padding: 16px 50px; border-radius: 8px; font-size: 16px; font-weight: 700;">
                                View in Admin Panel
                            </a>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #1f2937; padding: 30px; text-align: center;">
                            <p style="color: #6b7280; margin: 0; font-size: 12px;">
                                This is an automated notification from Soba Lanka Hotel Booking System
                            </p>
                            <p style="color: #6b7280; margin: 10px 0 0 0; font-size: 12px;">
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
