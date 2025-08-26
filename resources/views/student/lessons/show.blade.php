@extends('layouts.student')

@section('title', $lesson->title_ar . ' - ' . $course->title_ar)

@push('styles')
<style>
    /* CSS Variables */
    :root {
        --primary-color: #10b981;
        --primary-dark: #059669;
        --primary-light: #34d399;
        --secondary-color: #fbbf24;
        --secondary-dark: #f59e0b;
        --accent-color: #8b5cf6;
        --text-primary: #1f2937;
        --text-secondary: #64748b;
        --text-light: #9ca3af;
        --bg-primary: #ffffff;
        --bg-secondary: #f8fafc;
        --bg-dark: #1f2937;
        --border-color: #e2e8f0;
        --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        --shadow-2xl: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        --border-radius-sm: 0.5rem;
        --border-radius-md: 1rem;
        --border-radius-lg: 1.5rem;
        --border-radius-xl: 2rem;
        --transition-fast: 0.15s ease;
        --transition-normal: 0.3s ease;
        --transition-slow: 0.5s ease;
    }

    /* Global Styles */
    * {
        font-family: 'Cairo', 'Tajawal', sans-serif;
    }

    body {
        background: #f8fafc;
        min-height: 100vh;
    }

    /* Lesson Container */
    .lesson-container {
        padding: 0;
        min-height: 100vh;
        background: #f8fafc;
    }

    /* Enhanced Sidebar - Udemy Style */
    .lesson-sidebar {
        background: var(--bg-primary);
        border-right: 1px solid var(--border-color);
        height: 100vh;
        position: fixed;
        top: 0;
        right: 0;
        width: 320px;
        z-index: 1000;
        overflow-y: auto;
        box-shadow: var(--shadow-xl);
        transition: all var(--transition-normal);
    }

    .lesson-sidebar::-webkit-scrollbar {
        width: 6px;
    }

    .lesson-sidebar::-webkit-scrollbar-track {
        background: var(--bg-secondary);
    }

    .lesson-sidebar::-webkit-scrollbar-thumb {
        background: var(--primary-color);
        border-radius: 3px;
    }

    .sidebar-header {
        background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
        color: white;
        padding: 1.5rem;
        position: sticky;
        top: 0;
        z-index: 10;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .sidebar-header h5 {
        margin: 0;
        font-weight: 700;
        font-size: 1.1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .sidebar-header i {
        font-size: 1.2rem;
    }

    .course-progress-summary {
        background: rgba(255, 255, 255, 0.1);
        border-radius: var(--border-radius-md);
        padding: 1rem;
        margin-top: 1rem;
        backdrop-filter: blur(10px);
    }

    .progress-summary-text {
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
        opacity: 0.9;
    }

    .progress-summary-bar {
        background: rgba(255, 255, 255, 0.2);
        border-radius: 10px;
        height: 6px;
        overflow: hidden;
        margin-bottom: 0.5rem;
    }

    .progress-summary-fill {
        background: white;
        height: 100%;
        border-radius: 10px;
        transition: width var(--transition-slow);
    }

    .progress-summary-percentage {
        font-size: 0.8rem;
        font-weight: 600;
        opacity: 0.9;
    }

    .lessons-list {
        padding: 0;
    }

    .lesson-item {
        padding: 0;
        border: none;
        background: transparent;
        transition: all var(--transition-normal);
        position: relative;
        text-decoration: none;
        color: var(--text-primary);
        display: block;
    }

    .lesson-item::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(90deg, transparent, rgba(16, 185, 129, 0.05), transparent);
        opacity: 0;
        transition: opacity var(--transition-normal);
    }

    .lesson-item:hover::before {
        opacity: 1;
    }

    .lesson-item:hover {
        background: var(--bg-secondary);
        color: var(--primary-color);
        text-decoration: none;
    }

    .lesson-item.active {
        background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
        color: white;
        box-shadow: var(--shadow-md);
    }

    .lesson-item.active::before {
        display: none;
    }

    .lesson-content {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem 1.5rem;
        position: relative;
        z-index: 1;
    }

    .lesson-icon {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(16, 185, 129, 0.1);
        color: var(--primary-color);
        font-size: 1rem;
        transition: all var(--transition-normal);
        flex-shrink: 0;
        position: relative;
    }

    .lesson-item:hover .lesson-icon {
        background: rgba(16, 185, 129, 0.2);
        transform: scale(1.1);
    }

    .lesson-item.active .lesson-icon {
        background: rgba(255, 255, 255, 0.2);
        color: white;
    }

    .lesson-completed .lesson-icon {
        background: var(--primary-color);
        color: white;
    }

    .lesson-completed .lesson-icon::after {
        content: '✓';
        position: absolute;
        top: -2px;
        right: -2px;
        background: white;
        color: var(--primary-color);
        border-radius: 50%;
        width: 16px;
        height: 16px;
        font-size: 0.7rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
    }

    .lesson-info {
        flex: 1;
        min-width: 0;
    }

    .lesson-title {
        font-weight: 600;
        font-size: 0.9rem;
        margin: 0 0 0.25rem 0;
        line-height: 1.4;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .lesson-meta {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.8rem;
        color: var(--text-secondary);
    }

    .lesson-item.active .lesson-meta {
        color: rgba(255, 255, 255, 0.8);
    }

    .lesson-duration {
        background: var(--primary-color);
        color: white;
        padding: 0.2rem 0.6rem;
        border-radius: 12px;
        font-size: 0.75rem;
        font-weight: 600;
        transition: all var(--transition-normal);
    }

    .lesson-item:hover .lesson-duration {
        background: var(--primary-dark);
        transform: scale(1.05);
    }

    .lesson-item.active .lesson-duration {
        background: rgba(255, 255, 255, 0.2);
    }

    .lesson-free-badge {
        background: var(--secondary-color);
        color: var(--text-primary);
        padding: 0.2rem 0.6rem;
        border-radius: 12px;
        font-size: 0.75rem;
        font-weight: 600;
    }

    /* Main Content Area */
    .lesson-main {
        margin-right: 320px;
        min-height: 100vh;
        background: var(--bg-primary);
    }

    /* Lesson Header - Udemy Style */
    .lesson-header {
        background: linear-gradient(135deg, var(--bg-secondary) 0%, #e2e8f0 100%);
        padding: 2rem;
        border-bottom: 1px solid var(--border-color);
        position: relative;
        overflow: hidden;
    }

    .lesson-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="rgba(16,185,129,0.1)" stroke-width="0.5"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
        opacity: 0.3;
    }

    .lesson-title-main {
        font-size: 2rem;
        font-weight: 900;
        color: var(--text-primary);
        margin-bottom: 1rem;
        background: linear-gradient(45deg, var(--text-primary), var(--primary-color));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        line-height: 1.2;
        position: relative;
        z-index: 1;
    }

    .lesson-description-main {
        color: var(--text-secondary);
        font-size: 1rem;
        line-height: 1.6;
        margin-bottom: 1.5rem;
        position: relative;
        z-index: 1;
    }

    /* Navigation Buttons */
    .lesson-navigation {
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: relative;
        z-index: 1;
    }

    .nav-btn {
        background: var(--bg-primary);
        color: var(--text-primary);
        border: 2px solid var(--border-color);
        padding: 0.75rem 1.5rem;
        border-radius: 50px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all var(--transition-normal);
        box-shadow: var(--shadow-sm);
    }

    .nav-btn:hover {
        background: var(--primary-color);
        color: white;
        border-color: var(--primary-color);
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
        text-decoration: none;
    }

    .nav-btn.disabled {
        opacity: 0.5;
        pointer-events: none;
    }

    /* Lesson Content Section */
    .lesson-content-section {
        padding: 2rem;
    }

    .lesson-media-container {
        background: #000;
        border-radius: var(--border-radius-lg);
        overflow: hidden;
        box-shadow: var(--shadow-xl);
        margin-bottom: 2rem;
        position: relative;
    }

    .lesson-video {
        width: 100%;
        aspect-ratio: 16/9;
        border: none;
        display: block;
    }

    .lesson-pdf-container {
        background: linear-gradient(135deg, #ef4444, #dc2626);
        color: white;
        padding: 3rem 2rem;
        text-align: center;
        border-radius: var(--border-radius-lg);
        margin-bottom: 2rem;
    }

    .lesson-pdf-icon {
        font-size: 4rem;
        margin-bottom: 1rem;
        display: block;
    }

    .lesson-pdf-title {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 1rem;
    }

    .lesson-pdf-description {
        font-size: 1rem;
        opacity: 0.9;
        margin-bottom: 2rem;
    }

    .lesson-pdf-btn {
        background: white;
        color: #dc2626;
        border: none;
        padding: 1rem 2rem;
        border-radius: 50px;
        font-weight: 700;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        transition: all var(--transition-normal);
        box-shadow: var(--shadow-lg);
    }

    .lesson-pdf-btn:hover {
        background: var(--bg-secondary);
        transform: translateY(-2px);
        box-shadow: var(--shadow-xl);
        color: #dc2626;
        text-decoration: none;
    }

    .lesson-text-content {
        background: var(--bg-primary);
        border-radius: var(--border-radius-lg);
        padding: 2rem;
        box-shadow: var(--shadow-lg);
        border: 1px solid var(--border-color);
        margin-bottom: 2rem;
        line-height: 1.8;
        font-size: 1.1rem;
    }

    .lesson-text-content h1,
    .lesson-text-content h2,
    .lesson-text-content h3,
    .lesson-text-content h4,
    .lesson-text-content h5,
    .lesson-text-content h6 {
        color: var(--text-primary);
        margin-bottom: 1rem;
        font-weight: 700;
    }

    .lesson-text-content p {
        margin-bottom: 1rem;
        color: var(--text-secondary);
    }

    .lesson-text-content ul,
    .lesson-text-content ol {
        margin-bottom: 1rem;
        padding-right: 1.5rem;
    }

    .lesson-text-content li {
        margin-bottom: 0.5rem;
        color: var(--text-secondary);
    }

    /* Lesson Info Sidebar */
    .lesson-info-sidebar {
        background: var(--bg-secondary);
        border-radius: var(--border-radius-lg);
        padding: 1.5rem;
        border: 1px solid var(--border-color);
        margin-bottom: 2rem;
    }

    .info-section-title {
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 1rem;
        font-size: 1.1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .info-section-title i {
        color: var(--primary-color);
    }

    .info-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .info-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.75rem 0;
        border-bottom: 1px solid var(--border-color);
    }

    .info-item:last-child {
        border-bottom: none;
    }

    .info-label {
        font-weight: 600;
        color: var(--text-secondary);
        font-size: 0.9rem;
    }

    .info-value {
        font-weight: 700;
        color: var(--text-primary);
        font-size: 0.9rem;
    }

    .info-badge {
        background: var(--primary-color);
        color: white;
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
    }

    /* Progress Section */
    .progress-section {
        background: var(--bg-primary);
        border-radius: var(--border-radius-lg);
        padding: 1.5rem;
        border: 1px solid var(--border-color);
        margin-bottom: 2rem;
        box-shadow: var(--shadow-md);
    }

    .progress-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
    }

    .progress-label {
        font-weight: 700;
        color: var(--text-primary);
        font-size: 1rem;
    }

    .progress-percentage {
        font-weight: 900;
        color: var(--primary-color);
        font-size: 1.2rem;
    }

    .progress-bar-container {
        background: var(--bg-secondary);
        border-radius: 25px;
        height: 12px;
        overflow: hidden;
        margin-bottom: 1rem;
    }

    .progress-bar-fill {
        background: linear-gradient(90deg, var(--primary-color), var(--primary-dark));
        height: 100%;
        border-radius: 25px;
        transition: width var(--transition-slow);
        position: relative;
        overflow: hidden;
    }

    .progress-bar-fill::after {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
        animation: shimmer 2s infinite;
    }

    @keyframes shimmer {
        0% { left: -100%; }
        100% { left: 100%; }
    }

    .progress-info {
        font-size: 0.9rem;
        color: var(--text-secondary);
        text-align: center;
    }

    /* Complete Lesson Button */
    .complete-lesson-section {
        background: var(--bg-primary);
        border-radius: var(--border-radius-lg);
        padding: 1.5rem;
        border: 1px solid var(--border-color);
        box-shadow: var(--shadow-md);
    }

    .complete-lesson-btn {
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
        border: none;
        padding: 1rem 2rem;
        border-radius: 50px;
        font-weight: 700;
        font-size: 1.1rem;
        width: 100%;
        transition: all var(--transition-normal);
        box-shadow: var(--shadow-lg);
        position: relative;
        overflow: hidden;
    }

    .complete-lesson-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left var(--transition-slow);
    }

    .complete-lesson-btn:hover::before {
        left: 100%;
    }

    .complete-lesson-btn:hover {
        background: linear-gradient(135deg, #059669, #047857);
        transform: translateY(-2px);
        box-shadow: var(--shadow-xl);
    }

    .complete-lesson-btn:disabled {
        opacity: 0.7;
        cursor: not-allowed;
        transform: none;
    }

    /* Loading States */
    .loading {
        opacity: 0.7;
        pointer-events: none;
    }

    .loading::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 30px;
        height: 30px;
        margin: -15px 0 0 -15px;
        border: 3px solid rgba(16, 185, 129, 0.2);
        border-top: 3px solid var(--primary-color);
        border-radius: 50%;
        animation: spin 1s linear infinite;
        z-index: 10;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    /* Success Animation */
    .success-animation {
        animation: successPulse 0.6s ease-in-out;
    }

    @keyframes successPulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }

    /* Mobile Responsive */
    @media (max-width: 768px) {
        .lesson-sidebar {
            transform: translateX(100%);
            width: 100%;
        }

        .lesson-sidebar.show {
            transform: translateX(0);
        }

        .lesson-main {
            margin-right: 0;
        }

        .lesson-header {
            padding: 1.5rem;
        }

        .lesson-title-main {
            font-size: 1.6rem;
        }

        .lesson-navigation {
            flex-direction: column;
            gap: 1rem;
        }

        .lesson-content-section {
            padding: 1rem;
        }

        .lesson-text-content {
            padding: 1.5rem;
            font-size: 1rem;
        }
    }

    /* Sidebar Toggle Button */
    .sidebar-toggle {
        position: fixed;
        top: 1rem;
        right: 1rem;
        z-index: 1001;
        background: var(--primary-color);
        color: white;
        border: none;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        display: none;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        box-shadow: var(--shadow-lg);
        transition: all var(--transition-normal);
    }

    .sidebar-toggle:hover {
        background: var(--primary-dark);
        transform: scale(1.1);
    }

    @media (max-width: 768px) {
        .sidebar-toggle {
            display: flex;
        }
    }

    /* Overlay for mobile */
    .sidebar-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        z-index: 999;
        opacity: 0;
        visibility: hidden;
        transition: all var(--transition-normal);
    }

    .sidebar-overlay.show {
        opacity: 1;
        visibility: visible;
    }

    /* Print Styles */
    @media print {
        .lesson-sidebar,
        .sidebar-toggle {
            display: none;
        }

        .lesson-main {
            margin-right: 0;
        }
    }

    /* Accessibility */
    .lesson-item:focus,
    .complete-lesson-btn:focus,
    .nav-btn:focus {
        outline: 3px solid var(--primary-color);
        outline-offset: 2px;
    }

    /* Reduced Motion */
    @media (prefers-reduced-motion: reduce) {
        * {
            animation-duration: 0.01ms !important;
            animation-iteration-count: 1 !important;
            transition-duration: 0.01ms !important;
        }
    }
</style>
@endpush

@section('content')
<div class="lesson-container">
    <!-- Sidebar Toggle Button for Mobile -->
    <button class="sidebar-toggle" onclick="toggleSidebar()">
        <i class="bi bi-list"></i>
    </button>

    <!-- Sidebar Overlay for Mobile -->
    <div class="sidebar-overlay" onclick="toggleSidebar()"></div>

    <!-- Enhanced Sidebar -->
    <div class="lesson-sidebar" id="lessonSidebar">
        <div class="sidebar-header">
            <h5>
                <i class="bi bi-list"></i>
                محتوى الدورة
            </h5>
            <div class="course-progress-summary">
                <div class="progress-summary-text">التقدم في الدورة</div>
                <div class="progress-summary-bar">
                    <div class="progress-summary-fill" 
                         style="width: {{ $enrollment ? $enrollment->progress_percentage : 0 }}%">
                    </div>
                </div>
                <div class="progress-summary-percentage">
                    {{ $enrollment ? $enrollment->progress_percentage : 0 }}% مكتمل
                </div>
            </div>
        </div>
        
        <div class="lessons-list">
            @foreach($course_lessons as $course_lesson)
                <a href="{{ route('student.lessons.show', ['course' => $course->id, 'lesson' => $course_lesson->id]) }}" 
                   class="lesson-item {{ $lesson->id === $course_lesson->id ? 'active' : '' }} {{ $enrollment && $enrollment->isLessonCompleted($course_lesson->id) ? 'lesson-completed' : '' }}">
                    <div class="lesson-content">
                        <div class="lesson-icon">
                            <i class="bi bi-{{ $course_lesson->type === 'video' ? 'play-circle' : ($course_lesson->type === 'pdf' ? 'file-pdf' : 'file-text') }}"></i>
                        </div>
                        <div class="lesson-info">
                            <div class="lesson-title">{{ $course_lesson->title_ar }}</div>
                            <div class="lesson-meta">
                                <span class="lesson-duration">{{ $course_lesson->duration_minutes }} د</span>
                                @if($course_lesson->is_free)
                                    <span class="lesson-free-badge">مجاني</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>

    <!-- Enhanced Main Content -->
    <div class="lesson-main">
        <!-- Enhanced Lesson Header -->
        <div class="lesson-header">
            <h1 class="lesson-title-main">{{ $lesson->title_ar }}</h1>
            @if($lesson->description_ar)
                <p class="lesson-description-main">{{ $lesson->description_ar }}</p>
            @endif
            
            <div class="lesson-navigation">
                @if($previous_lesson)
                    <a href="{{ route('student.lessons.show', ['course' => $course->id, 'lesson' => $previous_lesson->id]) }}" 
                       class="nav-btn">
                        <i class="bi bi-chevron-left"></i>
                        الدرس السابق
                    </a>
                @else
                    <span class="nav-btn disabled">
                        <i class="bi bi-chevron-left"></i>
                        الدرس السابق
                    </span>
                @endif
                
                <a href="{{ route('student.courses.show', $course->id) }}" 
                   class="nav-btn">
                    <i class="bi bi-arrow-left"></i>
                    العودة للدورة
                </a>
                
                @if($next_lesson)
                    <a href="{{ route('student.lessons.show', ['course' => $course->id, 'lesson' => $next_lesson->id]) }}" 
                       class="nav-btn">
                        الدرس التالي
                        <i class="bi bi-chevron-right"></i>
                    </a>
                @else
                    <span class="nav-btn disabled">
                        الدرس التالي
                        <i class="bi bi-chevron-right"></i>
                    </span>
                @endif
            </div>
        </div>

        <!-- Enhanced Lesson Content Section -->
        <div class="lesson-content-section">
            <div class="row">
                <div class="col-lg-8">
                    <!-- Lesson Media Content -->
                    @if($lesson->type === 'video' && $lesson->video_url)
                        <div class="lesson-media-container">
                            <iframe src="{{ $lesson->video_url }}" 
                                    class="lesson-video"
                                    allowfullscreen></iframe>
                        </div>
                    @elseif($lesson->type === 'pdf' && $lesson->pdf_file)
                        <div class="lesson-pdf-container">
                            <i class="bi bi-file-pdf lesson-pdf-icon"></i>
                            <h3 class="lesson-pdf-title">ملف PDF</h3>
                            <p class="lesson-pdf-description">اضغط على الزر أدناه لعرض الملف</p>
                            <a href="{{ asset('storage/' . $lesson->pdf_file) }}" 
                               target="_blank" 
                               class="lesson-pdf-btn">
                                <i class="bi bi-file-pdf"></i>
                                عرض الملف
                            </a>
                        </div>
                    @elseif($lesson->type === 'text' && $lesson->text_content)
                        <div class="lesson-text-content">
                            {!! $lesson->text_content !!}
                        </div>
                    @else
                        <div class="alert alert-info text-center">
                            <i class="bi bi-info-circle"></i>
                            محتوى الدرس سيتم إضافته قريباً
                        </div>
                    @endif
                </div>
                
                <div class="col-lg-4">
                    <!-- Lesson Info Sidebar -->
                    <div class="lesson-info-sidebar">
                        <h6 class="info-section-title">
                            <i class="bi bi-info-circle"></i>
                            معلومات الدرس
                        </h6>
                        <ul class="info-list">
                            <li class="info-item">
                                <span class="info-label">النوع:</span>
                                <span class="info-badge">{{ $lesson->type_text }}</span>
                            </li>
                            <li class="info-item">
                                <span class="info-label">المدة:</span>
                                <span class="info-value">{{ $lesson->duration_minutes }} دقيقة</span>
                            </li>
                            <li class="info-item">
                                <span class="info-label">الترتيب:</span>
                                <span class="info-value">{{ $lesson->sort_order }}</span>
                            </li>
                            <li class="info-item">
                                <span class="info-label">الحالة:</span>
                                <span class="info-badge">
                                    {{ $lesson->is_published ? 'منشور' : 'مسودة' }}
                                </span>
                            </li>
                        </ul>
                    </div>

                    <!-- Progress Section -->
                    <div class="progress-section">
                        <div class="progress-header">
                            <span class="progress-label">التقدم في الدورة</span>
                            <span class="progress-percentage">{{ $enrollment ? $enrollment->progress_percentage : 0 }}%</span>
                        </div>
                        <div class="progress-bar-container">
                            <div class="progress-bar-fill" 
                                 style="width: {{ $enrollment ? $enrollment->progress_percentage : 0 }}%">
                            </div>
                        </div>
                        <div class="progress-info">
                            {{ $enrollment ? $enrollment->lessons_completed : 0 }} من {{ $course_lessons->count() }} درس مكتمل
                        </div>
                    </div>

                    <!-- Complete Lesson Section -->
                    <div class="complete-lesson-section">
                        <button class="complete-lesson-btn" 
                                onclick="completeLesson({{ $lesson->id }})"
                                id="completeLessonBtn">
                            <i class="bi bi-check-circle"></i>
                            تحديد كمكتمل
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function toggleSidebar() {
    const sidebar = document.getElementById('lessonSidebar');
    const overlay = document.querySelector('.sidebar-overlay');
    
    sidebar.classList.toggle('show');
    overlay.classList.toggle('show');
}

function completeLesson(lessonId) {
    const button = document.getElementById('completeLessonBtn');
    const originalText = button.innerHTML;
    
    // Add loading state
    button.classList.add('loading');
    button.innerHTML = '<i class="bi bi-hourglass-split"></i> جاري التحديث...';
    button.disabled = true;

    fetch(`/lessons/${lessonId}/complete`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            time_spent_minutes: 30, // يمكن تحديث هذا ليكون الوقت الفعلي المستغرق
            quiz_results: null
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update progress bar with animation
            const progressBar = document.querySelector('.progress-bar-fill');
            const progressText = document.querySelector('.progress-percentage');
            const progressInfo = document.querySelector('.progress-info');
            const sidebarProgressBar = document.querySelector('.progress-summary-fill');
            const sidebarProgressText = document.querySelector('.progress-summary-percentage');
            
            const currentProgress = parseInt(progressText.textContent);
            const newProgress = data.progress;
            
            // Animate progress bar
            let current = currentProgress;
            const increment = (newProgress - currentProgress) / 20;
            const progressInterval = setInterval(() => {
                current += increment;
                if (current >= newProgress) {
                    current = newProgress;
                    clearInterval(progressInterval);
                }
                progressBar.style.width = current + '%';
                progressText.textContent = Math.round(current) + '%';
                sidebarProgressBar.style.width = current + '%';
                sidebarProgressText.textContent = Math.round(current) + '% مكتمل';
            }, 50);

            // Update progress info
            const currentCompleted = parseInt(progressInfo.textContent.split(' ')[0]) + 1;
            progressInfo.textContent = `${currentCompleted} من ${data.total_lessons} درس مكتمل`;

            // Show success animation
            button.classList.remove('loading');
            button.classList.add('success-animation');
            button.innerHTML = '<i class="bi bi-check-circle"></i> تم التحديث!';
            button.style.background = 'linear-gradient(135deg, #10b981, #059669)';

            // Show success message
            const successAlert = document.createElement('div');
            successAlert.className = 'alert alert-success alert-dismissible fade show';
            successAlert.innerHTML = `
                <i class="bi bi-check-circle"></i>
                تم تحديد الدرس كمكتمل بنجاح!
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;
            
            const container = document.querySelector('.lesson-container');
            container.insertBefore(successAlert, container.firstChild);

            // Reload page after 3 seconds
            setTimeout(() => {
                location.reload();
            }, 3000);
        } else {
            // Show error state
            button.classList.remove('loading');
            button.innerHTML = originalText;
            button.disabled = false;
            
            const errorAlert = document.createElement('div');
            errorAlert.className = 'alert alert-danger alert-dismissible fade show';
            errorAlert.innerHTML = `
                <i class="bi bi-exclamation-triangle"></i>
                حدث خطأ أثناء تحديد الدرس كمكتمل
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;
            
            const container = document.querySelector('.lesson-container');
            container.insertBefore(errorAlert, container.firstChild);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        
        // Show error state
        button.classList.remove('loading');
        button.innerHTML = originalText;
        button.disabled = false;
        
        const errorAlert = document.createElement('div');
        errorAlert.className = 'alert alert-danger alert-dismissible fade show';
        errorAlert.innerHTML = `
            <i class="bi bi-exclamation-triangle"></i>
            حدث خطأ أثناء تحديد الدرس كمكتمل
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        
        const container = document.querySelector('.lesson-container');
        container.insertBefore(errorAlert, container.firstChild);
    });
}

// Add smooth scrolling for lesson navigation
document.addEventListener('DOMContentLoaded', function() {
    // Add entrance animations
    const elements = document.querySelectorAll('.lesson-sidebar, .lesson-main, .lesson-item');
    elements.forEach((el, index) => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(20px)';
        
        setTimeout(() => {
            el.style.transition = 'all 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94)';
            el.style.opacity = '1';
            el.style.transform = 'translateY(0)';
        }, index * 100);
    });

    // Add hover effects for lesson items
    const lessonItems = document.querySelectorAll('.lesson-item');
    lessonItems.forEach(item => {
        item.addEventListener('mouseenter', function() {
            if (!this.classList.contains('active')) {
                this.style.transform = 'translateX(5px) scale(1.02)';
            }
        });
        
        item.addEventListener('mouseleave', function() {
            if (!this.classList.contains('active')) {
                this.style.transform = 'translateX(0) scale(1)';
            }
        });
    });

    // Add progress bar animation on page load
    const progressBar = document.querySelector('.progress-bar-fill');
    if (progressBar) {
        const targetWidth = progressBar.style.width;
        progressBar.style.width = '0%';
        
        setTimeout(() => {
            progressBar.style.width = targetWidth;
        }, 500);
    }

    // Add intersection observer for animations
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, { threshold: 0.1 });

    // Observe all animated elements
    const animatedElements = document.querySelectorAll('.lesson-item, .lesson-info-sidebar, .progress-section');
    animatedElements.forEach(el => observer.observe(el));
});
</script>
@endsection 