<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SmsController extends Controller
{
    public function sendSms(Request $request)
    {
        // Validate input
        $request->validate([
            'contact_number' => 'required|string',
            'message' => 'required|string|max:1600'
        ]);

        $twilio = config('services.twilio', []);

        $sid = $twilio['sid'] ?? env('TWILIO_ACCOUNT_SID');
        $token = $twilio['token'] ?? env('TWILIO_AUTH_TOKEN');
        $from = $twilio['from'] ?? env('TWILIO_FROM_NUMBER') ?? env('TWILIO_FROM') ?? '+15005550006';
        $simulate = filter_var($twilio['simulate'] ?? env('SMS_SIMULATE', true), FILTER_VALIDATE_BOOLEAN);

        $to = $request->input('contact_number');
        $body = $request->input('message');

        if ($simulate) {
            \Log::info('SMS simulated send', [
                'to' => $to,
                'from' => $from,
                'message' => $body,
            ]);

            return back()->with('success', 'Message queued (simulation mode).');
        }

        if (!$sid || !$token || !$from) {
            return back()->with('error', 'SMS service not configured properly. Please set TWILIO_* variables or enable SMS simulation.');
        }

        $url = "https://api.twilio.com/2010-04-01/Accounts/{$sid}/Messages.json";

        $data = http_build_query([
            'To' => $to,
            'From' => $from,
            'Body' => $body,
        ]);

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_USERPWD, "{$sid}:{$token}");
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if (curl_errno($ch)) {
            $error_msg = curl_error($ch);
            curl_close($ch);
            \Log::error('SMS Curl Error: ' . $error_msg);
            return back()->with('error', 'Failed to send SMS. Please try again.');
        }

        curl_close($ch);

        if ($httpCode >= 200 && $httpCode < 300) {
            \Log::info('SMS sent successfully to: ' . $to);
            return back()->with('success', 'Message sent successfully!');
        }

        \Log::error('SMS API Error: HTTP ' . $httpCode . ' - ' . $response);
        return back()->with('error', 'Failed to send SMS. Please check the phone number and try again.');
    }
}
