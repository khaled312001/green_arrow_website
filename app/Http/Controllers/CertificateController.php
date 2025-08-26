<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Certificate;

class CertificateController extends Controller
{
    /**
     * عرض صفحة التحقق من الشهادة
     */
    public function showVerificationForm()
    {
        return view('certificates.verify');
    }

    /**
     * التحقق من الشهادة
     */
    public function verify(Request $request)
    {
        $request->validate([
            'certificate_number' => 'required|string',
            'verification_code' => 'required|string',
        ]);

        $certificate = Certificate::where('certificate_number', $request->certificate_number)
            ->where('verification_code', strtoupper($request->verification_code))
            ->with(['user', 'course', 'course.instructor'])
            ->first();

        if (!$certificate) {
            return back()->with('error', 'الشهادة غير صحيحة أو غير موجودة');
        }

        return view('certificates.verification-result', compact('certificate'));
    }

    /**
     * التحقق من الشهادة عبر الرابط المباشر
     */
    public function verifyByNumber($certificateNumber)
    {
        $certificate = Certificate::where('certificate_number', $certificateNumber)
            ->with(['user', 'course', 'course.instructor'])
            ->first();

        if (!$certificate) {
            abort(404, 'الشهادة غير موجودة');
        }

        return view('certificates.verification-result', compact('certificate'));
    }
} 