@extends('layouts.student')

@section('title', 'تهانينا! لقد أكملت الدورة بنجاح')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/completion-celebration.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('js/completion-celebration.js') }}"></script>
@endpush

@section('content')
<div class="celebration-container">
    <!-- Animated Background -->
    <div class="celebration-bg">
        @for($i = 0; $i < 50; $i++)
            <div class="confetti" style="left: {{ rand(0, 100) }}%; animation-delay: {{ rand(0, 3) }}s;"></div>
        @endfor
    </div>

    <!-- Main Celebration Card -->
    <div class="celebration-card">
        <!-- Success Icon -->
        <div class="success-icon">
            <i class="bi bi-trophy-fill"></i>
        </div>

        <!-- Celebration Title -->
        <h1 class="celebration-title">تهانينا! 🎉</h1>
        <p class="celebration-subtitle">
            لقد أكملت الدورة بنجاح! أنت الآن جزء من مجتمع المتعلمين المتميزين
        </p>

        <!-- Course Info -->
        <div class="course-info">
            <h2 class="course-title">{{ $course->title_ar }}</h2>
            <p class="course-instructor">
                <i class="bi bi-person-circle"></i>
                المدرب: {{ $course->instructor->name }}
            </p>
        </div>

        <!-- Stats Grid -->
        <div class="stats-grid">
            <div class="stat-item">
                <div class="stat-number">{{ $courseStats['completed_lessons'] }}</div>
                <div class="stat-label">درس مكتمل</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">{{ $courseStats['total_hours'] }}</div>
                <div class="stat-label">ساعة تعلم</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">100%</div>
                <div class="stat-label">نسبة الإكمال</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">{{ $courseStats['completion_date']->format('d/m/Y') }}</div>
                <div class="stat-label">تاريخ الإكمال</div>
            </div>
        </div>

        <!-- Certificate Section -->
        @if($courseStats['certificate_issued'])
        <div class="certificate-section">
            <div class="certificate-content">
                <h3 class="certificate-title">
                    <i class="bi bi-award-fill"></i>
                    شهادة الإكمال
                </h3>
                <p class="certificate-number">
                    رقم الشهادة: {{ $courseStats['certificate_number'] }}
                </p>
                <p>تم إصدار شهادتك بنجاح! يمكنك تحميلها أو مشاركتها مع الآخرين.</p>
            </div>
        </div>
        @endif

        <!-- Academic Info -->
        <div class="academic-info">
            <h3 class="academic-title">
                <i class="bi bi-building"></i>
                معلومات أكاديمية
            </h3>
            <div class="academic-grid">
                <div class="academic-item">
                    <div class="academic-icon">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <div class="academic-text">معتمدة من الأكاديمية</div>
                </div>
                <div class="academic-item">
                    <div class="academic-icon">
                        <i class="bi bi-globe"></i>
                    </div>
                    <div class="academic-text">صالحة دولياً</div>
                </div>
                <div class="academic-item">
                    <div class="academic-icon">
                        <i class="bi bi-clock-history"></i>
                    </div>
                    <div class="academic-text">دائمة الصلاحية</div>
                </div>
                <div class="academic-item">
                    <div class="academic-icon">
                        <i class="bi bi-people"></i>
                    </div>
                    <div class="academic-text">معترف بها من الشركات</div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="action-buttons">
            @if($courseStats['certificate_issued'])
            <a href="{{ route('student.certificates.download', $certificate) }}" class="btn-celebration btn-gold-celebration">
                <i class="bi bi-download"></i>
                تحميل الشهادة
            </a>
            @endif
            
            <a href="{{ route('student.certificates') }}" class="btn-celebration btn-primary-celebration">
                <i class="bi bi-award"></i>
                عرض جميع الشهادات
            </a>
            
            <a href="{{ route('student.dashboard') }}" class="btn-celebration btn-secondary-celebration">
                <i class="bi bi-house"></i>
                العودة للوحة التحكم
            </a>
        </div>

        <!-- Additional Info -->
        <div style="margin-top: 2rem; padding-top: 2rem; border-top: 1px solid #e5e7eb;">
            <p style="color: var(--text-light); font-size: 0.9rem; margin-bottom: 1rem;">
                <i class="bi bi-info-circle"></i>
                نصيحة: شارك إنجازك على وسائل التواصل الاجتماعي لتحفيز الآخرين!
            </p>
            <div style="display: flex; gap: 1rem; justify-content: center;">
                <a href="#" onclick="shareOnSocial('facebook')" style="color: #1877f2; font-size: 1.5rem;">
                    <i class="bi bi-facebook"></i>
                </a>
                <a href="#" onclick="shareOnSocial('twitter')" style="color: #1da1f2; font-size: 1.5rem;">
                    <i class="bi bi-twitter"></i>
                </a>
                <a href="#" onclick="shareOnSocial('linkedin')" style="color: #0077b5; font-size: 1.5rem;">
                    <i class="bi bi-linkedin"></i>
                </a>
                <a href="#" onclick="shareOnSocial('whatsapp')" style="color: #25d366; font-size: 1.5rem;">
                    <i class="bi bi-whatsapp"></i>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection 