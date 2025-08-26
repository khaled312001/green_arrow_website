@extends('layouts.student')

@section('title', $course->title_ar . ' - لوحة تحكم الطالب')

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

    /* Course Container */
    .course-container {
        padding: 0;
        min-height: 100vh;
        background: #f8fafc;
    }

    /* Enhanced Sidebar - Udemy Style */
    .course-sidebar {
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

    .course-sidebar::-webkit-scrollbar {
        width: 6px;
    }

    .course-sidebar::-webkit-scrollbar-track {
        background: var(--bg-secondary);
    }

    .course-sidebar::-webkit-scrollbar-thumb {
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
    .course-main {
        margin-right: 320px;
        min-height: 100vh;
        background: var(--bg-primary);
    }

    /* Course Header - Udemy Style */
    .course-header {
        background: linear-gradient(135deg, var(--bg-secondary) 0%, #e2e8f0 100%);
        padding: 2rem;
        border-bottom: 1px solid var(--border-color);
        position: relative;
        overflow: hidden;
    }

    .course-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="rgba(16,185,129,0.1)" stroke-width="0.5"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
        opacity: 0.3;
    }

    .course-title {
        font-size: 2.2rem;
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

    .course-description {
        color: var(--text-secondary);
        font-size: 1rem;
        line-height: 1.6;
        margin-bottom: 1.5rem;
        position: relative;
        z-index: 1;
    }

    /* Course Stats */
    .course-stats {
        display: flex;
        gap: 2rem;
        margin-bottom: 1.5rem;
        position: relative;
        z-index: 1;
    }

    .stat-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--text-secondary);
        font-size: 0.9rem;
    }

    .stat-item i {
        color: var(--primary-color);
        font-size: 1.1rem;
    }

    /* Current Lesson Section */
    .current-lesson-section {
        background: var(--bg-primary);
        border-radius: var(--border-radius-lg);
        box-shadow: var(--shadow-lg);
        border: 1px solid var(--border-color);
        overflow: hidden;
        margin: 2rem;
    }

    .lesson-header {
        background: linear-gradient(135deg, var(--accent-color), #7c3aed);
        color: white;
        padding: 1.5rem 2rem;
        position: relative;
        overflow: hidden;
    }

    .lesson-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left var(--transition-slow);
    }

    .current-lesson-section:hover .lesson-header::before {
        left: 100%;
    }

    .lesson-header h5 {
        margin: 0;
        font-weight: 700;
        font-size: 1.2rem;
        position: relative;
        z-index: 1;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .lesson-header i {
        font-size: 1.3rem;
    }

    .lesson-content-wrapper {
        padding: 2rem;
    }

    .lesson-media {
        border-radius: var(--border-radius-lg);
        overflow: hidden;
        box-shadow: var(--shadow-lg);
        margin-bottom: 1.5rem;
        background: #000;
    }

    .lesson-video {
        width: 100%;
        aspect-ratio: 16/9;
        border: none;
        display: block;
    }

    .lesson-pdf-btn {
        background: linear-gradient(135deg, #ef4444, #dc2626);
        color: white;
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
        background: linear-gradient(135deg, #dc2626, #b91c1c);
        transform: translateY(-2px);
        box-shadow: var(--shadow-xl);
        color: white;
        text-decoration: none;
    }

    .lesson-info-card {
        background: var(--bg-secondary);
        border-radius: var(--border-radius-lg);
        padding: 1.5rem;
        border: 1px solid var(--border-color);
    }

    .lesson-info-title {
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 1rem;
        font-size: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .lesson-info-title i {
        color: var(--primary-color);
    }

    .lesson-info-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .lesson-info-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.75rem 0;
        border-bottom: 1px solid var(--border-color);
    }

    .lesson-info-item:last-child {
        border-bottom: none;
    }

    .lesson-info-label {
        font-weight: 600;
        color: var(--text-secondary);
        font-size: 0.9rem;
    }

    .lesson-info-value {
        font-weight: 700;
        color: var(--text-primary);
        font-size: 0.9rem;
    }

    .lesson-description {
        background: var(--bg-primary);
        border-radius: var(--border-radius-md);
        padding: 1rem;
        margin-top: 1rem;
        border: 1px solid var(--border-color);
    }

    .complete-lesson-btn {
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
        border: none;
        padding: 1rem 2rem;
        border-radius: 50px;
        font-weight: 700;
        font-size: 1rem;
        width: 100%;
        margin-top: 1rem;
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

    /* Course Information Section */
    .course-info-section {
        background: var(--bg-primary);
        border-radius: var(--border-radius-lg);
        box-shadow: var(--shadow-lg);
        border: 1px solid var(--border-color);
        overflow: hidden;
        margin: 0 2rem 2rem 2rem;
    }

    .info-header {
        background: linear-gradient(135deg, var(--secondary-color), var(--secondary-dark));
        color: var(--text-primary);
        padding: 1.5rem 2rem;
        position: relative;
        overflow: hidden;
    }

    .info-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left var(--transition-slow);
    }

    .course-info-section:hover .info-header::before {
        left: 100%;
    }

    .info-header h5 {
        margin: 0;
        font-weight: 700;
        font-size: 1.2rem;
        position: relative;
        z-index: 1;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .info-header i {
        font-size: 1.3rem;
    }

    .info-content {
        padding: 2rem;
    }

    .info-section {
        margin-bottom: 2rem;
    }

    .info-section:last-child {
        margin-bottom: 0;
    }

    .info-section h6 {
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 1rem;
        font-size: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .info-section h6 i {
        color: var(--primary-color);
    }

    .info-section p {
        color: var(--text-secondary);
        line-height: 1.6;
        margin: 0;
        font-size: 0.95rem;
    }

    .course-meta-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .course-meta-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem;
        background: var(--bg-secondary);
        border-radius: var(--border-radius-md);
        margin-bottom: 0.75rem;
        border: 1px solid var(--border-color);
        transition: all var(--transition-normal);
    }

    .course-meta-item:hover {
        background: var(--bg-primary);
        border-color: var(--primary-color);
        transform: translateX(5px);
    }

    .course-meta-item:last-child {
        margin-bottom: 0;
    }

    .course-meta-label {
        font-weight: 600;
        color: var(--text-secondary);
        font-size: 0.9rem;
    }

    .course-meta-value {
        font-weight: 700;
        color: white;
        padding: 0.25rem 0.75rem;
        background: var(--primary-color);
        border-radius: 20px;
        font-size: 0.8rem;
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
        .course-sidebar {
            transform: translateX(100%);
            width: 100%;
        }

        .course-sidebar.show {
            transform: translateX(0);
        }

        .course-main {
            margin-right: 0;
        }

        .course-header {
            padding: 1.5rem;
        }

        .course-title {
            font-size: 1.8rem;
        }

        .course-stats {
            flex-direction: column;
            gap: 1rem;
        }

        .current-lesson-section,
        .course-info-section {
            margin: 1rem;
        }

        .lesson-content-wrapper {
            padding: 1rem;
        }

        .info-content {
            padding: 1rem;
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
        .course-sidebar,
        .sidebar-toggle {
            display: none;
        }

        .course-main {
            margin-right: 0;
        }
    }

    /* Accessibility */
    .lesson-item:focus,
    .complete-lesson-btn:focus {
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
<div class="course-container">
    <!-- Sidebar Toggle Button for Mobile -->
    <button class="sidebar-toggle" onclick="toggleSidebar()">
        <i class="bi bi-list"></i>
    </button>

    <!-- Sidebar Overlay for Mobile -->
    <div class="sidebar-overlay" onclick="toggleSidebar()"></div>

    <!-- Enhanced Sidebar -->
    <div class="course-sidebar" id="courseSidebar">
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
            @foreach($lessons as $lesson)
                <a href="{{ route('student.lessons.show', ['course' => $course->id, 'lesson' => $lesson->id]) }}" 
                   class="lesson-item {{ $current_lesson && $current_lesson->id === $lesson->id ? 'active' : '' }} {{ $enrollment && $enrollment->isLessonCompleted($lesson->id) ? 'lesson-completed' : '' }}">
                    <div class="lesson-content">
                        <div class="lesson-icon">
                            <i class="bi bi-{{ $lesson->type === 'video' ? 'play-circle' : ($lesson->type === 'pdf' ? 'file-pdf' : 'file-text') }}"></i>
                        </div>
                        <div class="lesson-info">
                            <div class="lesson-title">{{ $lesson->title_ar }}</div>
                            <div class="lesson-meta">
                                <span class="lesson-duration">{{ $lesson->duration_minutes }} د</span>
                                @if($lesson->is_free)
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
    <div class="course-main">
        <!-- Enhanced Course Header -->
        <div class="course-header">
            <h1 class="course-title">{{ $course->title_ar }}</h1>
            <p class="course-description">{{ $course->description_ar }}</p>
            
            <div class="course-stats">
                <div class="stat-item">
                    <i class="bi bi-play-circle"></i>
                    <span>{{ $lessons->count() }} درس</span>
                </div>
                <div class="stat-item">
                    <i class="bi bi-clock"></i>
                    <span>{{ $course->duration_hours }} ساعة</span>
                </div>
                <div class="stat-item">
                    <i class="bi bi-check-circle"></i>
                    <span>{{ $enrollment ? $enrollment->lessons_completed : 0 }} مكتمل</span>
                </div>
            </div>
        </div>

        <!-- Enhanced Current Lesson Section -->
        @if($current_lesson)
        <div class="current-lesson-section">
            <div class="lesson-header">
                <h5>
                    <i class="bi bi-play-circle"></i>
                    الدرس الحالي: {{ $current_lesson->title_ar }}
                </h5>
            </div>
            <div class="lesson-content-wrapper">
                <div class="row">
                    <div class="col-lg-8">
                        @if($current_lesson->type === 'video' && $current_lesson->video_url)
                            <div class="lesson-media">
                                <iframe src="{{ $current_lesson->video_url }}" 
                                        class="lesson-video"
                                        allowfullscreen></iframe>
                            </div>
                        @elseif($current_lesson->type === 'pdf' && $current_lesson->pdf_file)
                            <div class="text-center">
                                <a href="{{ asset('storage/' . $current_lesson->pdf_file) }}" 
                                   target="_blank" 
                                   class="lesson-pdf-btn">
                                    <i class="bi bi-file-pdf"></i>
                                    عرض الملف
                                </a>
                            </div>
                        @else
                            <div class="alert alert-info text-center">
                                <i class="bi bi-info-circle"></i>
                                محتوى الدرس سيتم إضافته قريباً
                            </div>
                        @endif
                    </div>
                    
                    <div class="col-lg-4">
                        <div class="lesson-info-card">
                            <h6 class="lesson-info-title">
                                <i class="bi bi-info-circle"></i>
                                معلومات الدرس
                            </h6>
                            <ul class="lesson-info-list">
                                <li class="lesson-info-item">
                                    <span class="lesson-info-label">النوع:</span>
                                    <span class="lesson-info-value">{{ $current_lesson->type_text }}</span>
                                </li>
                                <li class="lesson-info-item">
                                    <span class="lesson-info-label">المدة:</span>
                                    <span class="lesson-info-value">{{ $current_lesson->duration_minutes }} دقيقة</span>
                                </li>
                                <li class="lesson-info-item">
                                    <span class="lesson-info-label">الترتيب:</span>
                                    <span class="lesson-info-value">{{ $current_lesson->sort_order }}</span>
                                </li>
                            </ul>
                            
                            @if($current_lesson->description_ar)
                                <div class="lesson-description">
                                    <h6 class="lesson-info-title">
                                        <i class="bi bi-file-text"></i>
                                        وصف الدرس
                                    </h6>
                                    <p class="small">{{ $current_lesson->description_ar }}</p>
                                </div>
                            @endif
                            
                            <button class="complete-lesson-btn" 
                                    onclick="completeLesson({{ $current_lesson->id }})">
                                <i class="bi bi-check-circle"></i>
                                تحديد كمكتمل
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Enhanced Course Information Section -->
        <div class="course-info-section">
            <div class="info-header">
                <h5>
                    <i class="bi bi-info-circle"></i>
                    معلومات الدورة
                </h5>
            </div>
            <div class="info-content">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="info-section">
                            <h6>
                                <i class="bi bi-target"></i>
                                أهداف الدورة
                            </h6>
                            <p>{{ $course->objectives_ar }}</p>
                        </div>
                        
                        <div class="info-section">
                            <h6>
                                <i class="bi bi-list-check"></i>
                                المتطلبات
                            </h6>
                            <p>{{ $course->requirements_ar }}</p>
                        </div>
                    </div>
                    
                    <div class="col-lg-6">
                        <div class="info-section">
                            <h6>
                                <i class="bi bi-gear"></i>
                                معلومات إضافية
                            </h6>
                            <ul class="course-meta-list">
                                <li class="course-meta-item">
                                    <span class="course-meta-label">المستوى:</span>
                                    <span class="course-meta-value">
                                        @switch($course->level)
                                            @case('beginner')
                                                مبتدئ
                                                @break
                                            @case('intermediate')
                                                متوسط
                                                @break
                                            @case('advanced')
                                                متقدم
                                                @break
                                            @default
                                                {{ $course->level }}
                                        @endswitch
                                    </span>
                                </li>
                                <li class="course-meta-item">
                                    <span class="course-meta-label">النوع:</span>
                                    <span class="course-meta-value">
                                        @switch($course->type)
                                            @case('online')
                                                أونلاين
                                                @break
                                            @case('offline')
                                                حضورياً
                                                @break
                                            @case('hybrid')
                                                مختلط
                                                @break
                                            @default
                                                {{ $course->type }}
                                        @endswitch
                                    </span>
                                </li>
                                <li class="course-meta-item">
                                    <span class="course-meta-label">الشهادة:</span>
                                    <span class="course-meta-value">
                                        {{ $course->certificate_enabled ? 'متاحة' : 'غير متاحة' }}
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function toggleSidebar() {
    const sidebar = document.getElementById('courseSidebar');
    const overlay = document.querySelector('.sidebar-overlay');
    
    sidebar.classList.toggle('show');
    overlay.classList.toggle('show');
}

function completeLesson(lessonId) {
    const button = event.target;
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
            const progressBar = document.querySelector('.progress-summary-fill');
            const progressText = document.querySelector('.progress-summary-percentage');
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
                progressText.textContent = Math.round(current) + '% مكتمل';
            }, 50);

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
            
            const container = document.querySelector('.course-container');
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
            
            const container = document.querySelector('.course-container');
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
        
        const container = document.querySelector('.course-container');
        container.insertBefore(errorAlert, container.firstChild);
    });
}

// Add smooth scrolling for lesson navigation
document.addEventListener('DOMContentLoaded', function() {
    // Add entrance animations
    const elements = document.querySelectorAll('.course-sidebar, .course-main, .lesson-item');
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
    const progressBar = document.querySelector('.progress-summary-fill');
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
    const animatedElements = document.querySelectorAll('.lesson-item, .course-info-section');
    animatedElements.forEach(el => observer.observe(el));
});
</script>
@endsection 