<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class JobApplicationController extends Controller
{
    /**
     * Handle job application form submission
     */
    public function submit(Request $request)
    {
        try {
            // Validate form input
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'nullable|string|max:20',
                'position' => 'required|string|max:255',
                'message' => 'nullable|string|max:5000',
                'cv' => 'required|file|mimes:pdf|max:5120', // 5MB max
            ]);

            // Handle file upload
            $cvPath = null;
            if ($request->hasFile('cv')) {
                // Store CV file in 'applications' directory
                $cvPath = $request->file('cv')->store('job-applications', 'public');
            }

            // Create job application record
            $application = JobApplication::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'position' => $validated['position'],
                'message' => $validated['message'],
                'cv_path' => $cvPath,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            // Send confirmation email to applicant
            try {
                Mail::send('emails.application-confirmation', [
                    'name' => $validated['name'],
                    'position' => $validated['position'],
                    'applicationId' => $application->id,
                ], function ($message) use ($validated) {
                    $message->to($validated['email'])
                            ->subject('Đơn ứng tuyển của bạn đã được nhận - Starvik');
                });
            } catch (\Exception $e) {
                // Log email error but don't fail the application
                \Log::error('Failed to send confirmation email: ' . $e->getMessage());
            }

            // Send notification email to admin
            try {
                $adminEmail = config('app.admin_email', 'admin@starvik.com');
                Mail::send('emails.application-notification', [
                    'name' => $validated['name'],
                    'email' => $validated['email'],
                    'phone' => $validated['phone'],
                    'position' => $validated['position'],
                    'message' => $validated['message'],
                    'applicationId' => $application->id,
                    'cvPath' => $cvPath,
                ], function ($message) use ($adminEmail) {
                    $message->to($adminEmail)
                            ->subject('Đơn ứng tuyển mới từ ' . request('name'));
                });
            } catch (\Exception $e) {
                // Log email error but don't fail the application
                \Log::error('Failed to send admin notification email: ' . $e->getMessage());
            }

            // Redirect with success message
            $message = 'Cảm ơn bạn! Đơn ứng tuyển của bạn đã được gửi thành công. Chúng tôi sẽ liên hệ với bạn sớm.';

            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => $message,
                ]);
            }

            return back()->with('success', $message);

        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Dữ liệu không hợp lệ. Vui lòng kiểm tra lại.',
                    'errors' => $e->errors(),
                ], 422);
            }
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            \Log::error('Job application error: ' . $e->getMessage());
            $errorMessage = 'Có lỗi xảy ra khi gửi đơn ứng tuyển. Vui lòng thử lại sau.';

            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => $errorMessage,
                ], 500);
            }
            return back()->with('error', $errorMessage)->withInput();
        }
    }
}
