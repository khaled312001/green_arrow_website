<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>شهادة إكمال الدورة</title>
    <style>
        @font-face {
            font-family: 'Cairo';
            src: url('https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;900&display=swap');
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Cairo', 'Tajawal', Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            margin: 0;
        }
        
        /* تحسين الطباعة */
        @media print {
            body {
                background: white;
                padding: 0;
            }
            
            .certificate-container {
                box-shadow: none;
                border: none;
            }
        }
        
        .certificate-container {
            background: white;
            width: 1200px;
            height: 800px;
            border-radius: 30px;
            box-shadow: 0 30px 60px rgba(0,0,0,0.15);
            position: relative;
            overflow: hidden;
            border: 8px solid #10b981;
        }
        
        /* إطار احترافي */
        .certificate-border {
            position: absolute;
            top: 20px;
            left: 20px;
            right: 20px;
            bottom: 20px;
            border: 3px solid #10b981;
            border-radius: 20px;
            z-index: 1;
        }
        
        .certificate-border::before {
            content: '';
            position: absolute;
            top: 15px;
            left: 15px;
            right: 15px;
            bottom: 15px;
            border: 1px solid #10b981;
            border-radius: 15px;
        }
        
        .certificate-border::after {
            content: '';
            position: absolute;
            top: 30px;
            left: 30px;
            right: 30px;
            bottom: 30px;
            border: 1px solid rgba(16, 185, 129, 0.3);
            border-radius: 10px;
        }
        
        .certificate-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(circle at 20% 20%, rgba(16, 185, 129, 0.08) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(139, 92, 246, 0.08) 0%, transparent 50%),
                radial-gradient(circle at 40% 60%, rgba(251, 191, 36, 0.08) 0%, transparent 50%),
                linear-gradient(45deg, rgba(16, 185, 129, 0.02) 0%, transparent 50%);
            z-index: 1;
        }
        
        /* زوايا مزخرفة */
        .corner-decoration {
            position: absolute;
            width: 80px;
            height: 80px;
            z-index: 2;
        }
        
        .corner-decoration.top-left {
            top: 40px;
            left: 40px;
            background: 
                radial-gradient(circle at 20px 20px, #10b981 0%, transparent 50%),
                radial-gradient(circle at 60px 60px, rgba(16, 185, 129, 0.3) 0%, transparent 50%);
            border-radius: 50%;
        }
        
        .corner-decoration.top-right {
            top: 40px;
            right: 40px;
            background: 
                radial-gradient(circle at 20px 20px, #10b981 0%, transparent 50%),
                radial-gradient(circle at 60px 60px, rgba(16, 185, 129, 0.3) 0%, transparent 50%);
            border-radius: 50%;
        }
        
        .corner-decoration.bottom-left {
            bottom: 40px;
            left: 40px;
            background: 
                radial-gradient(circle at 20px 20px, #10b981 0%, transparent 50%),
                radial-gradient(circle at 60px 60px, rgba(16, 185, 129, 0.3) 0%, transparent 50%);
            border-radius: 50%;
        }
        
        .corner-decoration.bottom-right {
            bottom: 40px;
            right: 40px;
            background: 
                radial-gradient(circle at 20px 20px, #10b981 0%, transparent 50%),
                radial-gradient(circle at 60px 60px, rgba(16, 185, 129, 0.3) 0%, transparent 50%);
            border-radius: 50%;
        }
        
        .certificate-content {
            position: relative;
            z-index: 3;
            padding: 60px;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        
        .header {
            text-align: center;
            margin-bottom: 40px;
            position: relative;
        }
        
        .logo {
            font-size: 3rem;
            font-weight: 900;
            color: #10b981;
            margin-bottom: 15px;
            text-shadow: 2px 2px 4px rgba(16, 185, 129, 0.2);
        }
        
        .academy-name {
            font-size: 1.4rem;
            color: #6b7280;
            margin-bottom: 25px;
            font-weight: 600;
        }
        
        .academy-subtitle {
            font-size: 1rem;
            color: #9ca3af;
            font-style: italic;
        }
        
        .certificate-title {
            font-size: 3.5rem;
            font-weight: 900;
            color: #1f2937;
            margin-bottom: 15px;
            text-align: center;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
            background: linear-gradient(135deg, #10b981, #059669);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .certificate-subtitle {
            font-size: 1.3rem;
            color: #6b7280;
            text-align: center;
            margin-bottom: 50px;
            font-weight: 600;
        }
        
        .student-info {
            text-align: center;
            margin-bottom: 40px;
            padding: 30px;
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.05), rgba(5, 150, 105, 0.05));
            border-radius: 20px;
            border: 2px solid rgba(16, 185, 129, 0.1);
        }
        
        .student-name {
            font-size: 2.5rem;
            font-weight: 700;
            color: #10b981;
            margin-bottom: 15px;
            text-shadow: 1px 1px 2px rgba(16, 185, 129, 0.2);
            background: linear-gradient(135deg, #10b981, #059669);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .course-info {
            text-align: center;
            margin-bottom: 40px;
            padding: 25px;
            background: rgba(248, 250, 252, 0.8);
            border-radius: 15px;
            border-left: 4px solid #10b981;
        }
        
        .course-name {
            font-size: 1.8rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 15px;
        }
        
        .course-details {
            font-size: 1.1rem;
            color: #6b7280;
            margin-bottom: 20px;
            line-height: 1.6;
        }
        
        .course-details div {
            margin-bottom: 8px;
            padding: 5px 0;
        }
        
        .course-details div:before {
            content: '• ';
            color: #10b981;
            font-weight: bold;
        }
        
        .completion-date {
            font-size: 1.1rem;
            color: #6b7280;
            text-align: center;
            margin-bottom: 35px;
            padding: 15px;
            background: rgba(16, 185, 129, 0.05);
            border-radius: 10px;
            font-weight: 600;
        }
        
        .certificate-number {
            text-align: center;
            margin-bottom: 35px;
        }
        
        .number-label {
            font-size: 1rem;
            color: #6b7280;
            margin-bottom: 10px;
            font-weight: 600;
        }
        
        .number-value {
            font-size: 1.3rem;
            font-weight: 700;
            color: #1f2937;
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            padding: 15px 30px;
            border-radius: 15px;
            display: inline-block;
            box-shadow: 0 4px 8px rgba(16, 185, 129, 0.3);
        }
        
        .signatures {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-top: auto;
            padding: 20px 0;
        }
        
        .signature-box {
            text-align: center;
            flex: 1;
            padding: 20px;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 15px;
            margin: 0 10px;
            border: 1px solid rgba(16, 185, 129, 0.2);
        }
        
        .signature-line {
            width: 180px;
            height: 3px;
            background: linear-gradient(90deg, #10b981, #059669);
            margin: 0 auto 15px;
            border-radius: 2px;
        }
        
        .signature-name {
            font-size: 1.1rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 8px;
        }
        
        .signature-title {
            font-size: 0.9rem;
            color: #6b7280;
            font-weight: 500;
        }
        
        .verification-info {
            text-align: center;
            margin-top: 25px;
            padding: 20px;
            background: linear-gradient(135deg, #f8fafc, #f1f5f9);
            border-radius: 15px;
            border: 2px solid #e2e8f0;
            box-shadow: 0 4px 8px rgba(0,0,0,0.05);
        }
        
        .verification-text {
            font-size: 0.9rem;
            color: #6b7280;
            margin-bottom: 8px;
            font-weight: 500;
        }
        
        .verification-code {
            font-size: 1rem;
            font-weight: 700;
            color: #10b981;
            background: rgba(16, 185, 129, 0.1);
            padding: 5px 10px;
            border-radius: 8px;
            display: inline-block;
            font-family: 'Courier New', monospace;
            letter-spacing: 1px;
        }
        
        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 5rem;
            color: rgba(16, 185, 129, 0.08);
            font-weight: 900;
            z-index: 1;
            pointer-events: none;
            letter-spacing: 2px;
        }
        
        .border-pattern {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: 
                linear-gradient(45deg, #10b981 1px, transparent 1px),
                linear-gradient(-45deg, #10b981 1px, transparent 1px);
            background-size: 30px 30px;
            opacity: 0.08;
            z-index: 1;
        }
        
        /* تحسينات إضافية */
        .certificate-container::before {
            content: '';
            position: absolute;
            top: 10px;
            left: 10px;
            right: 10px;
            bottom: 10px;
            border: 1px solid rgba(16, 185, 129, 0.2);
            border-radius: 25px;
            z-index: 1;
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
        
        <!-- Background Pattern -->
        <div class="border-pattern"></div>
        
        <!-- Watermark -->
        <div class="watermark">GREEN ARROW ACADEMY</div>
        
        <!-- Background Gradients -->
        <div class="certificate-bg"></div>
        
        <!-- Certificate Content -->
        <div class="certificate-content">
            <!-- Header -->
            <div class="header">
                <div class="logo">🏹 Green Arrow Academy</div>
                <div class="academy-name">أكاديمية السهم الأخضر للتعليم الإلكتروني</div>
                <div class="academy-subtitle">مؤسسة تعليمية معتمدة دولياً</div>
            </div>
            
            <!-- Certificate Title -->
            <div class="certificate-title">شهادة إكمال الدورة</div>
            <div class="certificate-subtitle">Certificate of Course Completion</div>
            
            <!-- Student Info -->
            <div class="student-info">
                <div class="student-name">{{ $user->name }}</div>
                <div style="color: #6b7280; font-size: 1rem;">الطالب / Student</div>
            </div>
            
            <!-- Course Info -->
            <div class="course-info">
                <div class="course-name">{{ $course->title_ar }}</div>
                <div class="course-details">
                    <div>المدرب: {{ $course->instructor->name }}</div>
                    <div>عدد الدروس: {{ $enrollment->total_lessons }}</div>
                    <div>مدة الدورة: {{ $course->duration_hours ?? 'غير محدد' }} ساعة</div>
                </div>
            </div>
            
            <!-- Completion Date -->
            <div class="completion-date">
                تم إكمال الدورة بنجاح في تاريخ: {{ $certificate->issued_at->format('d/m/Y') }}
            </div>
            
            <!-- Certificate Number -->
            <div class="certificate-number">
                <div class="number-label">رقم الشهادة / Certificate Number</div>
                <div class="number-value">{{ $certificate->certificate_number }}</div>
            </div>
            
            <!-- Verification Info -->
            <div class="verification-info">
                <div class="verification-text">للتحقق من صحة الشهادة، قم بزيارة:</div>
                <div class="verification-text">http://127.0.0.1:8000/certificates/verify</div>
                <div class="verification-text">رمز التحقق: <span class="verification-code">{{ $certificate->verification_code }}</span></div>
            </div>
            
            <!-- Signatures -->
            <div class="signatures">
                <div class="signature-box">
                    <div class="signature-line"></div>
                    <div class="signature-name">مدير الأكاديمية</div>
                    <div class="signature-title">Academy Director</div>
                </div>
                
                <div class="signature-box">
                    <div class="signature-line"></div>
                    <div class="signature-name">{{ $course->instructor->name }}</div>
                    <div class="signature-title">مدرب الدورة / Course Instructor</div>
                </div>
            </div>
        </div>
    </div>
</body>
</html> 