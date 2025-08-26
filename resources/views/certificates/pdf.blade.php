<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>شهادة إكمال الدورة</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Arial', sans-serif;
            background: white;
            margin: 0;
            padding: 20px;
            direction: rtl;
            text-align: right;
            unicode-bidi: embed;
            font-size: 14px;
            line-height: 1.6;
        }
        
        /* إضافة دعم للخطوط العربية */
        .arabic-text {
            font-family: 'Arial', sans-serif;
            direction: rtl;
            text-align: right;
        }
        
        @page {
            size: A4 landscape;
            margin: 10mm;
        }
        
        .certificate-container {
            width: 100%;
            height: 100%;
            background: white;
            border: 6px solid #10b981;
            border-radius: 15px;
            position: relative;
            overflow: hidden;
            margin: 0;
            padding: 20px;
        }
        
        .certificate-border {
            position: absolute;
            top: 20px;
            left: 20px;
            right: 20px;
            bottom: 20px;
            border: 3px solid #10b981;
            border-radius: 15px;
        }
        
        .certificate-border::before {
            content: '';
            position: absolute;
            top: 15px;
            left: 15px;
            right: 15px;
            bottom: 15px;
            border: 1px solid #10b981;
            border-radius: 10px;
        }
        
        .certificate-content {
            position: relative;
            z-index: 3;
            padding: 30px;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .logo {
            font-size: 1.8rem;
            font-weight: bold;
            color: #10b981;
            margin-bottom: 8px;
        }
        
        .academy-name {
            font-size: 1rem;
            color: #6b7280;
            margin-bottom: 10px;
            font-weight: 600;
        }
        
        .academy-subtitle {
            font-size: 0.8rem;
            color: #9ca3af;
            font-style: italic;
        }
        
        .certificate-title {
            font-size: 2.2rem;
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 8px;
            text-align: center;
        }
        
        .certificate-subtitle {
            font-size: 1rem;
            color: #6b7280;
            text-align: center;
            margin-bottom: 25px;
            font-weight: 600;
        }
        
        .student-info {
            text-align: center;
            margin-bottom: 20px;
            padding: 15px;
            background: #f0fdf4;
            border-radius: 12px;
            border: 2px solid #dcfce7;
        }
        
        .student-name {
            font-size: 1.5rem;
            font-weight: bold;
            color: #10b981;
            margin-bottom: 8px;
        }
        
        .course-info {
            text-align: center;
            margin-bottom: 20px;
            padding: 15px;
            background: #f8fafc;
            border-radius: 10px;
            border-left: 4px solid #10b981;
        }
        
        .course-name {
            font-size: 1.2rem;
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 8px;
        }
        
        .course-details {
            font-size: 1rem;
            color: #6b7280;
            line-height: 1.6;
        }
        
        .course-details div {
            margin-bottom: 5px;
        }
        
        .completion-date {
            font-size: 0.9rem;
            color: #6b7280;
            text-align: center;
            margin-bottom: 15px;
            padding: 10px;
            background: #f0fdf4;
            border-radius: 8px;
            font-weight: 600;
        }
        
        .certificate-number {
            text-align: center;
            margin-bottom: 15px;
        }
        
        .number-label {
            font-size: 0.8rem;
            color: #6b7280;
            margin-bottom: 6px;
            font-weight: 600;
        }
        
        .number-value {
            font-size: 1rem;
            font-weight: bold;
            color: white;
            background: #10b981;
            padding: 8px 20px;
            border-radius: 8px;
            display: inline-block;
        }
        
        .signatures {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-top: auto;
            padding: 15px 0;
        }
        
        .signature-box {
            text-align: center;
            flex: 1;
            padding: 12px;
            background: white;
            border-radius: 8px;
            margin: 0 8px;
            border: 1px solid #e5e7eb;
        }
        
        .signature-line {
            width: 150px;
            height: 2px;
            background: #10b981;
            margin: 0 auto 10px;
            border-radius: 1px;
        }
        
        .signature-name {
            font-size: 1rem;
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 5px;
        }
        
        .signature-title {
            font-size: 0.8rem;
            color: #6b7280;
            font-weight: 500;
        }
        
        .verification-info {
            text-align: center;
            margin-top: 15px;
            padding: 12px;
            background: #f8fafc;
            border-radius: 8px;
            border: 2px solid #e2e8f0;
        }
        
        .verification-text {
            font-size: 0.8rem;
            color: #6b7280;
            margin-bottom: 5px;
            font-weight: 500;
        }
        
        .verification-code {
            font-size: 0.9rem;
            font-weight: bold;
            color: #10b981;
            background: #f0fdf4;
            padding: 4px 8px;
            border-radius: 6px;
            display: inline-block;
            font-family: 'Courier New', monospace;
        }
        
        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 2.5rem;
            color: rgba(16, 185, 129, 0.06);
            font-weight: bold;
            z-index: 1;
            pointer-events: none;
        }
        
        .corner-decoration {
            position: absolute;
            width: 40px;
            height: 40px;
            background: #10b981;
            border-radius: 50%;
            z-index: 2;
        }
        
        .corner-decoration.top-left {
            top: 20px;
            left: 20px;
        }
        
        .corner-decoration.top-right {
            top: 20px;
            right: 20px;
        }
        
        .corner-decoration.bottom-left {
            bottom: 20px;
            left: 20px;
        }
        
        .corner-decoration.bottom-right {
            bottom: 20px;
            right: 20px;
        }
        
        @media print {
            body {
                background: white;
                padding: 0;
                margin: 0;
            }
            
            .certificate-container {
                box-shadow: none;
                border: none;
                width: 100%;
                height: 100%;
                border-radius: 0;
                padding: 15px;
            }
            
            .certificate-content {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="certificate-container">
        <!-- إطار احترافي -->
        <div class="certificate-border"></div>
        
        <!-- زوايا مزخرفة -->
        <div class="corner-decoration top-left"></div>
        <div class="corner-decoration top-right"></div>
        <div class="corner-decoration bottom-left"></div>
        <div class="corner-decoration bottom-right"></div>
        
        <!-- Watermark -->
        <div class="watermark">GREEN ARROW ACADEMY</div>
        
        <!-- Certificate Content -->
        <div class="certificate-content">
            <!-- Header -->
            <div class="header">
                <div class="logo">🏹 Green Arrow Academy</div>
                <div class="academy-name arabic-text">أكاديمية السهم الأخضر للتعليم الإلكتروني</div>
                <div class="academy-subtitle arabic-text">مؤسسة تعليمية معتمدة دولياً</div>
            </div>
            
            <!-- Certificate Title -->
            <div class="certificate-title arabic-text">شهادة إكمال الدورة</div>
            <div class="certificate-subtitle">Certificate of Course Completion</div>
            
            <!-- Student Info -->
            <div class="student-info">
                <div class="student-name arabic-text">{{ $user->name ?? 'اسم الطالب' }}</div>
                <div style="color: #6b7280; font-size: 0.9rem;" class="arabic-text">الطالب / Student</div>
            </div>
            
            <!-- Course Info -->
            <div class="course-info">
                <div class="course-name arabic-text">{{ $course->title_ar ?? $course->title ?? 'اسم الدورة' }}</div>
                <div class="course-details arabic-text">
                    <div>المدرب: {{ $course->instructor->name ?? 'اسم المدرب' }}</div>
                    <div>عدد الدروس: {{ $enrollment->total_lessons ?? 0 }}</div>
                    <div>مدة الدورة: {{ $course->duration_hours ?? 'غير محدد' }} ساعة</div>
                </div>
            </div>
            
            <!-- Completion Date -->
            <div class="completion-date arabic-text">
                تم إكمال الدورة بنجاح في تاريخ: {{ $certificate->issued_at ? $certificate->issued_at->format('d/m/Y') : date('d/m/Y') }}
            </div>
            
            <!-- Certificate Number -->
            <div class="certificate-number">
                <div class="number-label arabic-text">رقم الشهادة / Certificate Number</div>
                <div class="number-value">{{ $certificate->certificate_number ?? 'GA-2025-000001' }}</div>
            </div>
            
            <!-- Verification Info -->
            <div class="verification-info">
                <div class="verification-text arabic-text">للتحقق من صحة الشهادة، قم بزيارة:</div>
                <div class="verification-text">http://127.0.0.1:8000/certificates/verify</div>
                <div class="verification-text arabic-text">رمز التحقق: <span class="verification-code">{{ $certificate->verification_code ?? 'ABC12345' }}</span></div>
            </div>
            
            <!-- Signatures -->
            <div class="signatures">
                <div class="signature-box">
                    <div class="signature-line"></div>
                    <div class="signature-name arabic-text">مدير الأكاديمية</div>
                    <div class="signature-title">Academy Director</div>
                </div>
                
                <div class="signature-box">
                    <div class="signature-line"></div>
                    <div class="signature-name arabic-text">{{ $course->instructor->name ?? 'اسم المدرب' }}</div>
                    <div class="signature-title arabic-text">مدرب الدورة / Course Instructor</div>
                </div>
            </div>
        </div>
    </div>
</body>
</html> 