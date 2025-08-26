<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * عرض صفحة التواصل
     */
    public function index()
    {
        $socialLinks = get_active_social_links();
        
        return view('contact', compact('socialLinks'));
    }

    /**
     * حفظ رسالة التواصل
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
        ]);

        try {
            ContactMessage::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'subject' => $request->subject,
                'message' => $request->message,
                'status' => 'new',
            ]);

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'تم إرسال رسالتك بنجاح! سنقوم بالرد عليك في أقرب وقت ممكن.'
                ]);
            }

            return back()->with('success', 'تم إرسال رسالتك بنجاح! سنقوم بالرد عليك في أقرب وقت ممكن.');
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'حدث خطأ أثناء إرسال الرسالة. يرجى المحاولة مرة أخرى.'
                ], 500);
            }

            return back()->with('error', 'حدث خطأ أثناء إرسال الرسالة. يرجى المحاولة مرة أخرى.');
        }
    }
}
