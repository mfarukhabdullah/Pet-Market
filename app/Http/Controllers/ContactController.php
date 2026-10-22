<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Models\ContactMessage;

// USER PROMPT: "form main smtp ni lga howa lgao andullahkhanmahesar9696@gmail.com Abdullah123#"
class ContactController extends Controller
{
    /**
     * Display the Contact Us page.
     */
    public function index()
    {
        return view('contact');
    }

    /**
     * Handle incoming contact form submission and dispatch email via SMTP.
     */
    public function send(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:150',
            'phone' => 'nullable|string|max:30',
            'subject' => 'nullable|string|max:150',
            'message' => 'required|string|max:3000',
        ]);

        // 1. Save submission to database so no message is ever lost
        try {
            ContactMessage::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'] ?? null,
                'subject' => $validated['subject'] ?? null,
                'message' => $validated['message'],
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to save ContactMessage record: ' . $e->getMessage());
        }

        // 2. Dispatch email to configured recipient via SMTP
        $recipient = config('mail.from.address', 'andullahkhanmahesar9696@gmail.com');
        $emailSubject = !empty($validated['subject']) 
            ? 'New Contact Inquiry: ' . $validated['subject'] 
            : 'New Contact Inquiry from ' . $validated['name'];

        $mailSent = false;
        $mailError = null;

        try {
            Mail::send([], [], function ($message) use ($recipient, $emailSubject, $validated) {
                $htmlBody = '
                <div style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; background: #ffffff; border: 1px solid #e2e8f0; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.05);">
                    <div style="background: #147A4D; color: #ffffff; padding: 22px 24px;">
                        <h2 style="margin: 0; font-size: 20px; font-weight: 700;">Pet Marketplace &bull; New Contact Inquiry</h2>
                    </div>
                    <div style="padding: 24px;">
                        <p style="margin: 0 0 16px; font-size: 14px; color: #334155;">You have received a new contact submission from the website contact form:</p>
                        <table style="width: 100%; border-collapse: collapse; font-size: 14px; margin-bottom: 20px;">
                            <tr style="border-bottom: 1px solid #f1f5f9;"><td style="padding: 10px 0; color: #64748b; width: 130px;"><strong>Full Name:</strong></td><td style="padding: 10px 0; color: #0f172a; font-weight: 600;">' . htmlspecialchars($validated['name']) . '</td></tr>
                            <tr style="border-bottom: 1px solid #f1f5f9;"><td style="padding: 10px 0; color: #64748b;"><strong>Email:</strong></td><td style="padding: 10px 0; color: #0f172a;"><a href="mailto:' . htmlspecialchars($validated['email']) . '" style="color: #147A4D; text-decoration: none;">' . htmlspecialchars($validated['email']) . '</a></td></tr>
                            <tr style="border-bottom: 1px solid #f1f5f9;"><td style="padding: 10px 0; color: #64748b;"><strong>Phone:</strong></td><td style="padding: 10px 0; color: #0f172a;">' . (!empty($validated['phone']) ? htmlspecialchars($validated['phone']) : 'Not provided') . '</td></tr>
                            <tr style="border-bottom: 1px solid #f1f5f9;"><td style="padding: 10px 0; color: #64748b;"><strong>Subject:</strong></td><td style="padding: 10px 0; color: #0f172a;">' . (!empty($validated['subject']) ? htmlspecialchars($validated['subject']) : 'General Support') . '</td></tr>
                        </table>
                        <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 16px; margin-top: 14px;">
                            <strong style="color: #475569; display: block; margin-bottom: 8px; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px;">Message:</strong>
                            <p style="margin: 0; color: #0f172a; white-space: pre-wrap; line-height: 1.6; font-size: 14px;">' . nl2br(htmlspecialchars($validated['message'])) . '</p>
                        </div>
                    </div>
                    <div style="background: #f1f5f9; padding: 14px 24px; font-size: 12px; color: #64748b; text-align: center; border-top: 1px solid #e2e8f0;">
                        Sent via Pet Marketplace Contact Form &bull; ' . date('Y-m-d H:i:s') . '
                    </div>
                </div>';

                $message->to($recipient)
                        ->replyTo($validated['email'], $validated['name'])
                        ->subject($emailSubject)
                        ->html($htmlBody);
            });
            $mailSent = true;
        } catch (\Exception $e) {
            $mailError = $e->getMessage();
            Log::error('SMTP Contact email dispatch error: ' . $mailError);
        }

        $successMsg = 'Thank you! Your message has been received successfully. Our support team will review and reply shortly.';

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => $successMsg,
                'mail_sent' => $mailSent,
            ]);
        }

        return redirect()->route('contact')->with('success', $successMsg);
    }
}
