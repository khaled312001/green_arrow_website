@extends('layouts.student')

@section('title', 'نتائج الاختبار - ' . $quiz->title_ar)

@section('content')
<div class="container" style="max-width: 800px; margin: 0 auto; padding: 20px;">
    <div class="card">
        <div class="card-header" style="background: #f8fafc; padding: 20px; border-bottom: 1px solid #e5e7eb;">
            <h2 style="margin: 0; color: #1f2937;">نتائج الاختبار</h2>
            <p style="margin: 10px 0 0 0; color: #6b7280;">{{ $quiz->title_ar }}</p>
        </div>
        
        <div class="card-body" style="padding: 20px;">
            <!-- نتيجة الاختبار -->
            <div class="result-card" style="background: {{ $attempt->is_passed ? '#d1fae5' : '#fee2e2' }}; color: {{ $attempt->is_passed ? '#065f46' : '#991b1b' }}; padding: 20px; border-radius: 12px; margin-bottom: 20px; text-align: center;">
                <div style="font-size: 3rem; margin-bottom: 10px;">
                    @if($attempt->is_passed)
                        <i class="bi bi-check-circle-fill"></i>
                    @else
                        <i class="bi bi-x-circle-fill"></i>
                    @endif
                </div>
                <h3 style="margin: 0 0 10px 0; font-size: 1.5rem;">
                    {{ $attempt->is_passed ? 'مبروك! لقد نجحت في الاختبار' : 'للأسف لم تنجح في الاختبار' }}
                </h3>
                <div style="font-size: 2rem; font-weight: 700; margin-bottom: 10px;">
                    {{ $attempt->score }}/{{ $attempt->total_points }}
                </div>
                <div style="font-size: 1.2rem; font-weight: 600;">
                    النسبة المئوية: {{ number_format($attempt->percentage, 1) }}%
                </div>
            </div>
            
            <!-- تفاصيل الاختبار -->
            <div style="background: white; border: 1px solid #e5e7eb; border-radius: 8px; padding: 20px; margin-bottom: 20px;">
                <h4 style="margin: 0 0 15px 0; color: #1f2937;">
                    <i class="bi bi-info-circle"></i>
                    تفاصيل الاختبار
                </h4>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px;">
                    <div>
                        <strong>عدد الأسئلة:</strong> {{ $attempt->total_points }}
                    </div>
                    <div>
                        <strong>الإجابات الصحيحة:</strong> {{ $attempt->score }}
                    </div>
                    <div>
                        <strong>الإجابات الخاطئة:</strong> {{ $attempt->total_points - $attempt->score }}
                    </div>
                    <div>
                        <strong>درجة النجاح المطلوبة:</strong> {{ $quiz->passing_score ?? 70 }}%
                    </div>
                    <div>
                        <strong>تاريخ الاختبار:</strong> {{ $attempt->created_at->format('Y-m-d H:i') }}
                    </div>
                    <div>
                        <strong>مدة الاختبار:</strong> 
                        @if($attempt->started_at && $attempt->completed_at)
                            {{ $attempt->started_at->diffInMinutes($attempt->completed_at) }} دقيقة
                        @else
                            غير محدد
                        @endif
                    </div>
                </div>
            </div>
            
            <!-- معلومات الدورة -->
            <div style="background: white; border: 1px solid #e5e7eb; border-radius: 8px; padding: 20px; margin-bottom: 20px;">
                <h4 style="margin: 0 0 15px 0; color: #1f2937;">
                    <i class="bi bi-book"></i>
                    معلومات الدورة
                </h4>
                <div style="display: flex; align-items: center; gap: 15px;">
                    <div style="flex: 1;">
                        <h5 style="margin: 0 0 5px 0; color: #1f2937;">{{ $quiz->course->title_ar }}</h5>
                        <p style="margin: 0; color: #6b7280;">{{ $quiz->course->instructor->name ?? 'المدرب' }}</p>
                    </div>
                    <a href="{{ route('student.courses.player', $quiz->course) }}" class="btn btn-primary" style="background: #10b981; color: white; border: none; padding: 10px 20px; border-radius: 6px; text-decoration: none;">
                        <i class="bi bi-play-circle"></i>
                        العودة للدورة
                    </a>
                </div>
            </div>
            
            <!-- نصائح -->
            @if(!$attempt->is_passed)
            <div style="background: #fef3c7; color: #92400e; padding: 20px; border-radius: 8px; margin-bottom: 20px;">
                <h4 style="margin: 0 0 15px 0;">
                    <i class="bi bi-lightbulb"></i>
                    نصائح للتحسين
                </h4>
                <ul style="margin: 0; padding-right: 20px;">
                    <li>راجع الدروس مرة أخرى لفهم النقاط التي أخطأت فيها</li>
                    <li>خذ وقتك في قراءة الأسئلة بعناية</li>
                    <li>تدرب على الاختبارات السابقة</li>
                    <li>تواصل مع المدرب إذا كنت تحتاج مساعدة إضافية</li>
                </ul>
            </div>
            @endif
            
            <!-- أزرار الإجراءات -->
            <div style="text-align: center; margin-top: 30px;">
                <a href="{{ route('student.courses.player', $quiz->course) }}" class="btn btn-primary" style="background: #10b981; color: white; border: none; padding: 12px 30px; border-radius: 8px; font-size: 1.1rem; font-weight: 600; text-decoration: none; margin: 0 10px;">
                    <i class="bi bi-play-circle"></i>
                    العودة للدورة
                </a>
                
                <a href="{{ route('student.dashboard') }}" class="btn btn-secondary" style="background: #6b7280; color: white; border: none; padding: 12px 30px; border-radius: 8px; font-size: 1.1rem; font-weight: 600; text-decoration: none; margin: 0 10px;">
                    <i class="bi bi-house"></i>
                    لوحة التحكم
                </a>
            </div>
        </div>
    </div>
</div>

<style>
.result-card {
    transition: transform 0.3s ease;
}

.result-card:hover {
    transform: translateY(-2px);
}

.btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

@media (max-width: 768px) {
    .container {
        padding: 10px;
    }
    
    .btn {
        display: block;
        margin: 10px 0 !important;
        width: 100%;
    }
}
</style>
@endsection 