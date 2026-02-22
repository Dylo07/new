# PayHere Integration Setup Guide

This guide will walk you through setting up PayHere payment gateway for your hotel booking website.

---

## Step 1: Register for PayHere Sandbox Account (Testing)

1. **Visit PayHere Sandbox Registration:**
   - Go to: https://sandbox.payhere.lk/merchant/signup
   - This is the **test environment** where you can test payments without real money

2. **Fill in Business Details:**
   - Business Name: Your Hotel Name
   - Business Email: Your email address
   - Contact Number: Your phone number
   - Create a secure password

3. **Verify Your Email:**
   - Check your inbox for a verification email from PayHere
   - Click the verification link

4. **Login to Sandbox Dashboard:**
   - Go to: https://sandbox.payhere.lk/merchant/
   - Login with your credentials

---

## Step 2: Get Your API Credentials

1. **Navigate to Settings:**
   - After logging in, go to **Settings** → **Domains & Credentials**

2. **Copy Your Credentials:**
   - **Merchant ID**: A number like `1220000000` (this is your test merchant ID)
   - **Merchant Secret**: A long string like `MzQ4NDI5MzQyMjQ1MzM1NTM0NjIzMTYyNzEyNzY=`

3. **Add Authorized Domains (Important!):**
   - In the "Domains & Credentials" section, add:
     - `localhost` (for local testing)
     - Your production domain when you deploy (e.g., `yourdomain.com`)

---

## Step 3: Add Credentials to Your .env File

1. **Open your `.env` file** in the project root

2. **Find these lines** (they should already be there):
   ```
   PAYHERE_MERCHANT_ID=
   PAYHERE_SECRET=
   PAYHERE_ENV=sandbox
   ```

3. **Replace with your actual credentials:**
   ```
   PAYHERE_MERCHANT_ID=1220000000
   PAYHERE_SECRET=MzQ4NDI5MzQyMjQ1MzM1NTM0NjIzMTYyNzEyNzY=
   PAYHERE_ENV=sandbox
   ```

4. **Save the file**

---

## Step 4: Test the Integration

### Using PayHere Test Cards

When testing in the Sandbox, use these **test card numbers**:

**Successful Payment:**
- Card Number: `5123 4567 8901 2346`
- CVV: Any 3 digits (e.g., `123`)
- Expiry: Any future date (e.g., `12/25`)
- OTP: `1234`

**Failed Payment:**
- Card Number: `4916 2001 0000 6610`
- CVV: Any 3 digits
- Expiry: Any future date
- OTP: Will show as failed

### Test Flow:
1. Create a booking on your website
2. Click "Pay Online (PayHere)"
3. You'll be redirected to PayHere's payment page
4. Enter the test card details above
5. Complete the payment
6. You should be redirected back to your site
7. Check your bookings - the status should update to "Confirmed" and payment status to "Paid"

---

## Step 5: View Transactions in Dashboard

1. Login to https://sandbox.payhere.lk/merchant/
2. Go to **Transactions** to see all test payments
3. You can view payment details, refund, and more

---

## Step 6: Set Up Webhook Notifications (Important!)

PayHere sends payment confirmations to your webhook URL. This is already configured in the code.

1. In PayHere Dashboard, go to **Settings** → **Domains & Credentials**
2. Under **Notify URL**, it will automatically use the URL we send in each payment request
3. The webhook URL format is: `https://yourdomain.com/webhook/payhere`
4. **For local testing**, you need to use a tunnel service like **ngrok**:
   ```bash
   ngrok http 8000
   ```
   This will give you a public URL like `https://abc123.ngrok.io`
   - Use this URL in PayHere's "Authorized Domains"
   - Your webhook will be: `https://abc123.ngrok.io/webhook/payhere`

---

## Step 7: Going Live (Production)

When you're ready to accept real payments:

1. **Register for Live Account:**
   - Go to: https://www.payhere.lk/merchant/signup
   - Submit your business documents (Business Registration, Bank Details, etc.)
   - PayHere will verify your account (usually takes 1-2 business days)

2. **Get Live Credentials:**
   - Login to: https://www.payhere.lk/merchant/
   - Go to **Settings** → **Domains & Credentials**
   - Copy your **Live Merchant ID** and **Live Merchant Secret**

3. **Update Your .env File:**
   ```
   PAYHERE_MERCHANT_ID=your_live_merchant_id
   PAYHERE_SECRET=your_live_merchant_secret
   PAYHERE_ENV=production
   ```

4. **Add Production Domain:**
   - In PayHere Dashboard, add your production domain (e.g., `yourhotel.com`)

5. **Deploy and Test:**
   - Deploy your application
   - Test with a small real transaction
   - Verify money arrives in your PayHere account
   - You can withdraw to your bank account from the PayHere dashboard

---

## Important Notes

### Security
- ✅ Never commit your `.env` file to Git (it's already in `.gitignore`)
- ✅ Keep your Merchant Secret private
- ✅ Always verify the MD5 signature in webhook responses (already implemented)

### Supported Payment Methods
PayHere accepts:
- Visa, Mastercard, AMEX
- Local cards from any Sri Lankan bank
- Digital wallets: Frimi, Genie, eZ Cash, mCash
- QR payments

### Transaction Fees
- Check current rates at: https://www.payhere.lk/pricing
- Usually around 3.5% + Rs 5 per transaction for cards
- Lower rates for bank transfers

### Currency
- The integration is set to **LKR** (Sri Lankan Rupees)
- To change currency, edit line 28 in `app/Http/Controllers/PaymentController.php`

---

## Troubleshooting

**Issue: Payment not updating booking status**
- Check Laravel logs: `storage/logs/laravel.log`
- Verify webhook is receiving calls (check logs for "PayHere Signature Mismatch")
- Ensure your webhook URL is publicly accessible

**Issue: "Invalid Merchant" error**
- Double-check your Merchant ID in `.env`
- Ensure you've added your domain to PayHere's authorized domains

**Issue: Hash mismatch**
- Verify your Merchant Secret is correct
- Check that there are no extra spaces in your `.env` file

---

## Support

- PayHere Support: support@payhere.lk
- PayHere Documentation: https://support.payhere.lk/
- PayHere API Docs: https://support.payhere.lk/api-&-mobile-sdk/payhere-checkout

---

## Summary of What's Been Implemented

✅ PayHere checkout form with automatic redirect
✅ Secure hash generation for payment verification
✅ Webhook handler to confirm payments
✅ Database tracking of payment status
✅ Automatic booking confirmation on successful payment
✅ Support for both sandbox and production environments
✅ User-friendly payment flow with loading screens

---

**You're all set! Start testing with the sandbox account and go live when ready.**
