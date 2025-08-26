@extends('layouts.course-player')

@section('title', $course->title_ar . ' - متابعة الدورة')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/course-player.css') }}">
<style>
    /* CSS Variables - Professional Udemy/Coursera Style */
    :root {
        --primary-color: #1c1d1f;
        --primary-dark: #0f0f0f;
        --primary-light: #2d2f31;
        --secondary-color: #a435f0;
        --secondary-dark: #8710d8;
        --secondary-light: #b469f3;
        --accent-color: #f7f9fa;
        --text-primary: #1c1d1f;
        --text-secondary: #6a6f73;
        --text-light: #a1a7ab;
        --bg-primary: #ffffff;
        --bg-secondary: #f7f9fa;
        --bg-dark: #1c1d1f;
        --border-color: #d1d7dc;
        --border-light: #e5e5e5;
        --shadow-sm: 0 2px 4px rgba(0,0,0,.08);
        --shadow-md: 0 2px 4px rgba(0,0,0,.12);
        --shadow-lg: 0 4px 8px rgba(0,0,0,.12);
        --shadow-xl: 0 8px 16px rgba(0,0,0,.12);
        --border-radius-sm: 4px;
        --border-radius-md: 8px;
        --border-radius-lg: 12px;
        --border-radius-xl: 16px;
        --transition-fast: 0.15s ease;
        --transition-normal: 0.3s ease;
        --transition-slow: 0.5s ease;
        --success-color: #10b981;
        --warning-color: #f59e0b;
        --error-color: #ef4444;
        --info-color: #3b82f6;
    }

    /* Global Styles */
    * {
        font-family: 'Cairo', 'Tajawal', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }

    body {
        background: var(--bg-dark);
        min-height: 100vh;
        color: var(--text-primary);
        overflow-x: hidden;
    }

    /* Course Player Container - Professional Layout */
    .course-player-container {
        display: flex;
        height: 100vh;
        background: var(--bg-dark);
    }

    /* Enhanced Sidebar - Professional Udemy Style */
    .course-sidebar {
        background: var(--bg-primary);
        width: 380px;
        height: 100vh;
        position: fixed;
        top: 0;
        left: 0;
        z-index: 1000;
        overflow-y: auto;
        box-shadow: var(--shadow-xl);
        transition: all var(--transition-normal);
        border-right: 1px solid var(--border-color);
    }

    .course-sidebar::-webkit-scrollbar {
        width: 6px;
    }

    .course-sidebar::-webkit-scrollbar-track {
        background: var(--bg-secondary);
    }

    .course-sidebar::-webkit-scrollbar-thumb {
        background: var(--border-color);
        border-radius: 3px;
    }

    .course-sidebar::-webkit-scrollbar-thumb:hover {
        background: var(--text-light);
    }

    /* Sidebar Header */
    .sidebar-header {
        background: var(--bg-primary);
        padding: 1.5rem;
        border-bottom: 1px solid var(--border-color);
        position: sticky;
        top: 0;
        z-index: 10;
    }

    .course-title-sidebar {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 0.5rem;
        line-height: 1.3;
    }

    .course-instructor {
        font-size: 0.875rem;
        color: var(--text-secondary);
        margin-bottom: 1rem;
    }

    .progress-summary {
        background: var(--bg-secondary);
        border-radius: var(--border-radius-md);
        padding: 1rem;
        border: 1px solid var(--border-color);
    }

    .progress-text {
        font-size: 0.875rem;
        color: var(--text-secondary);
        margin-bottom: 0.75rem;
        font-weight: 600;
    }

    .progress-bar-container {
        background: var(--border-color);
        border-radius: 10px;
        height: 8px;
        overflow: hidden;
        margin-bottom: 0.75rem;
    }

    .progress-bar-fill {
        background: linear-gradient(90deg, var(--secondary-color), var(--secondary-light));
        height: 100%;
        border-radius: 10px;
        transition: width var(--transition-slow);
    }

    .progress-percentage {
        font-size: 0.875rem;
        font-weight: 700;
        color: var(--text-primary);
    }

    /* Search Bar */
    .lesson-search {
        margin-top: 1rem;
        position: relative;
    }

    .lesson-search input {
        width: 100%;
        padding: 0.75rem 1rem 0.75rem 2.5rem;
        border: 1px solid var(--border-color);
        border-radius: var(--border-radius-md);
        font-size: 0.875rem;
        background: var(--bg-primary);
        color: var(--text-primary);
        transition: all var(--transition-normal);
    }

    .lesson-search input:focus {
        outline: none;
        border-color: var(--secondary-color);
        box-shadow: 0 0 0 3px rgba(164, 53, 240, 0.1);
    }

    .search-icon {
        position: absolute;
        left: 0.75rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-light);
        pointer-events: none;
    }

    /* Lessons List */
    .lessons-list {
        padding: 0;
    }

    .lesson-item {
        display: block;
        text-decoration: none;
        color: var(--text-primary);
        border-bottom: 1px solid var(--border-light);
        transition: all var(--transition-normal);
        position: relative;
    }

    .lesson-item:last-child {
        border-bottom: none;
    }

    .lesson-item:hover {
        background: var(--bg-secondary);
        color: var(--text-primary);
        text-decoration: none;
    }

    .lesson-item.active {
        background: var(--bg-secondary);
        border-left: 4px solid var(--secondary-color);
    }

    .lesson-item.completed {
        background: rgba(164, 53, 240, 0.05);
        border-left: 4px solid var(--success-color);
    }

    .lesson-content {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem 1.5rem;
    }

    .lesson-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--bg-secondary);
        color: var(--text-secondary);
        font-size: 1.1rem;
        transition: all var(--transition-normal);
        flex-shrink: 0;
        border: 1px solid var(--border-color);
    }

    .lesson-item.active .lesson-icon {
        background: var(--secondary-color);
        color: white;
        border-color: var(--secondary-color);
    }

    .lesson-item.completed .lesson-icon {
        background: var(--success-color);
        color: white;
        border-color: var(--success-color);
    }

    .lesson-info {
        flex: 1;
        min-width: 0;
    }

    .lesson-title {
        font-weight: 600;
        font-size: 0.9rem;
        margin-bottom: 0.25rem;
        line-height: 1.4;
        color: var(--text-primary);
    }

    .lesson-meta {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-size: 0.75rem;
        color: var(--text-light);
    }

    .lesson-duration {
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }

    .lesson-type-badge {
        padding: 0.125rem 0.5rem;
        border-radius: 12px;
        font-size: 0.625rem;
        font-weight: 600;
    }

    .lesson-type-video {
        background: var(--info-color);
        color: white;
    }

    .lesson-type-pdf {
        background: var(--error-color);
        color: white;
    }

    .lesson-type-quiz {
        background: var(--warning-color);
        color: white;
    }

    /* Main Content Area */
    .course-main {
        margin-left: 380px;
        flex: 1;
        background: var(--bg-dark);
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }

    /* Video Player Section */
    .video-section {
        background: #000;
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }

    .video-container {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #000;
    }

    .video-player {
        width: 100%;
        height: 100%;
        border: none;
        background: #000;
    }

    .video-placeholder {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: white;
        text-align: center;
        padding: 2rem;
    }

    .video-placeholder i {
        font-size: 4rem;
        margin-bottom: 1rem;
        color: var(--text-light);
    }

    .video-placeholder h3 {
        font-size: 1.5rem;
        margin-bottom: 0.5rem;
        color: white;
    }

    .video-placeholder p {
        color: var(--text-light);
        font-size: 1rem;
    }

    /* Lesson Info Panel */
    .lesson-info-panel {
        background: var(--bg-primary);
        border-top: 1px solid var(--border-color);
        padding: 1.5rem;
        box-shadow: var(--shadow-lg);
    }

    .lesson-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 1rem;
    }

    .lesson-title-main {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 0.5rem;
    }

    .lesson-description {
        color: var(--text-secondary);
        line-height: 1.6;
        margin-bottom: 1rem;
    }

    .lesson-actions {
        display: flex;
        gap: 1rem;
        align-items: center;
    }

    .complete-btn {
        background: var(--secondary-color);
        color: white;
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: var(--border-radius-md);
        font-weight: 600;
        cursor: pointer;
        transition: all var(--transition-normal);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .complete-btn:hover {
        background: var(--secondary-dark);
        transform: translateY(-1px);
        box-shadow: var(--shadow-md);
    }

    .complete-btn:disabled {
        background: var(--text-light);
        cursor: not-allowed;
        transform: none;
        box-shadow: none;
    }

    .next-lesson-btn {
        background: transparent;
        color: var(--secondary-color);
        border: 2px solid var(--secondary-color);
        padding: 0.75rem 1.5rem;
        border-radius: var(--border-radius-md);
        font-weight: 600;
        cursor: pointer;
        transition: all var(--transition-normal);
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .next-lesson-btn:hover {
        background: var(--secondary-color);
        color: white;
        text-decoration: none;
    }

    /* Course Resources */
    .resources-section {
        background: var(--bg-primary);
        border-top: 1px solid var(--border-color);
        padding: 1.5rem;
    }

    .resources-header {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .resources-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1rem;
    }

    .resource-card {
        background: var(--bg-secondary);
        border: 1px solid var(--border-color);
        border-radius: var(--border-radius-md);
        padding: 1rem;
        transition: all var(--transition-normal);
        text-decoration: none;
        color: var(--text-primary);
    }

    .resource-card:hover {
        box-shadow: var(--shadow-md);
        transform: translateY(-2px);
        text-decoration: none;
        color: var(--text-primary);
    }

    .resource-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: var(--secondary-color);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 0.75rem;
    }

    .resource-title {
        font-weight: 600;
        margin-bottom: 0.5rem;
        font-size: 0.9rem;
    }

    .resource-description {
        color: var(--text-secondary);
        font-size: 0.8rem;
        line-height: 1.4;
    }

    /* Mobile Responsive */
    @media (max-width: 768px) {
        .course-sidebar {
            transform: translateX(-100%);
            width: 100%;
        }

        .course-sidebar.show {
            transform: translateX(0);
        }

        .course-main {
            margin-left: 0;
        }

        .lesson-title-main {
            font-size: 1.25rem;
        }

        .lesson-actions {
            flex-direction: column;
            align-items: stretch;
        }

        .resources-grid {
            grid-template-columns: 1fr;
        }
    }

    /* Sidebar Toggle */
    .sidebar-toggle {
        display: none;
        position: fixed;
        top: 1rem;
        left: 1rem;
        z-index: 1001;
        background: var(--secondary-color);
        color: white;
        border: none;
        padding: 0.75rem;
        border-radius: 50%;
        cursor: pointer;
        box-shadow: var(--shadow-lg);
        transition: all var(--transition-normal);
    }

    .sidebar-toggle:hover {
        background: var(--secondary-dark);
        transform: scale(1.1);
    }

    @media (max-width: 768px) {
        .sidebar-toggle {
            display: block;
        }
    }

    .sidebar-overlay {
        display: none;
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

    @media (max-width: 768px) {
        .sidebar-overlay {
            display: block;
        }
    }

    /* Loading States */
    .loading {
        opacity: 0.6;
        pointer-events: none;
    }

    /* Success Animation */
    @keyframes successPulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }

    .success-animation {
        animation: successPulse 0.5s ease-in-out;
    }

    /* Quiz Section */
    .quiz-section {
        background: var(--bg-primary);
        border-top: 1px solid var(--border-color);
        padding: 1.5rem;
    }

    .quiz-header {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .quiz-card {
        background: var(--bg-secondary);
        border: 1px solid var(--border-color);
        border-radius: var(--border-radius-md);
        padding: 1.5rem;
        margin-bottom: 1rem;
    }

    .quiz-title {
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 0.5rem;
    }

    .quiz-meta {
        display: flex;
        gap: 1rem;
        font-size: 0.875rem;
        color: var(--text-secondary);
        margin-bottom: 1rem;
    }

    .start-quiz-btn {
        background: var(--warning-color);
        color: white;
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: var(--border-radius-md);
        font-weight: 600;
        cursor: pointer;
        transition: all var(--transition-normal);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .start-quiz-btn:hover {
        background: #d97706;
        transform: translateY(-1px);
        box-shadow: var(--shadow-md);
        text-decoration: none;
        color: white;
    }

    /* Course Resources Enhanced */
    .resource-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 0.5rem;
        font-size: 0.75rem;
        color: var(--text-light);
    }

    .resource-type {
        background: var(--secondary-color);
        color: white;
        padding: 0.125rem 0.5rem;
        border-radius: 12px;
        font-size: 0.625rem;
    }

    .resource-size {
        color: var(--text-secondary);
    }

    .no-resources {
        text-align: center;
        padding: 2rem;
        color: var(--text-light);
    }

    .no-resources i {
        font-size: 3rem;
        margin-bottom: 1rem;
        opacity: 0.5;
    }

    /* Contact Instructor Section */
    .contact-section {
        background: var(--bg-primary);
        border-top: 1px solid var(--border-color);
        padding: 1.5rem;
    }

    .contact-header {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .contact-form {
        background: var(--bg-secondary);
        border-radius: var(--border-radius-md);
        padding: 1.5rem;
        border: 1px solid var(--border-color);
    }

    .form-group {
        margin-bottom: 1rem;
    }

    .form-group label {
        display: block;
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 0.5rem;
        font-size: 0.875rem;
    }

    .form-control {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid var(--border-color);
        border-radius: var(--border-radius-md);
        font-size: 0.875rem;
        background: var(--bg-primary);
        color: var(--text-primary);
        transition: all var(--transition-normal);
    }

    .form-control:focus {
        outline: none;
        border-color: var(--secondary-color);
        box-shadow: 0 0 0 3px rgba(164, 53, 240, 0.1);
    }

    .form-control option {
        background: var(--bg-primary);
        color: var(--text-primary);
    }

    .send-message-btn {
        background: var(--secondary-color);
        color: white;
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: var(--border-radius-md);
        font-weight: 600;
        cursor: pointer;
        transition: all var(--transition-normal);
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.875rem;
    }

    .send-message-btn:hover {
        background: var(--secondary-dark);
        transform: translateY(-1px);
        box-shadow: var(--shadow-md);
    }

    .send-message-btn:disabled {
        background: var(--text-light);
        cursor: not-allowed;
        transform: none;
        box-shadow: none;
    }
</style>
@endpush

@section('content')
<div class="course-player-container">
    <!-- Sidebar Toggle Button for Mobile -->
    <button class="sidebar-toggle" onclick="toggleSidebar()">
        <i class="bi bi-list"></i>
    </button>

    <!-- Sidebar Overlay for Mobile -->
    <div class="sidebar-overlay" onclick="toggleSidebar()"></div>

    <!-- Enhanced Sidebar - Professional Udemy Style -->
    <div class="course-sidebar" id="courseSidebar">
        <div class="sidebar-header">
            <h3 class="course-title-sidebar">{{ $course->title_ar }}</h3>
            <p class="course-instructor">المدرب: {{ $course->instructor->name }}</p>
            
            <div class="progress-summary">
                <div class="progress-text">التقدم في الدورة</div>
                <div class="progress-bar-container">
                    <div class="progress-bar-fill" 
                         style="width: {{ $enrollment ? $enrollment->progress_percentage : 0 }}%">
                    </div>
                </div>
                <div class="progress-percentage">
                    {{ $enrollment ? $enrollment->progress_percentage : 0 }}% مكتمل
                </div>
            </div>

            <div class="lesson-search">
                <input type="text" id="lessonSearch" placeholder="البحث في الدروس..." class="form-control">
                <i class="bi bi-search search-icon"></i>
            </div>
        </div>
        
        <div class="lessons-list">
            @foreach($lessons as $lesson)
                <a href="{{ route('student.courses.player', ['course' => $course->id, 'lesson' => $lesson->id]) }}" 
                   class="lesson-item {{ $current_lesson && $current_lesson->id === $lesson->id ? 'active' : '' }} {{ $enrollment && $enrollment->isLessonCompleted($lesson->id) ? 'completed' : '' }}">
                    <div class="lesson-content">
                        <div class="lesson-icon">
                            <i class="bi bi-{{ $lesson->type === 'video' ? 'play-circle' : ($lesson->type === 'pdf' ? 'file-pdf' : 'file-text') }}"></i>
                        </div>
                        <div class="lesson-info">
                            <div class="lesson-title">{{ $lesson->title_ar }}</div>
                            <div class="lesson-meta">
                                <span class="lesson-duration">
                                    <i class="bi bi-clock"></i>
                                    {{ $lesson->duration_minutes }} د
                                </span>
                                <span class="lesson-type-badge lesson-type-{{ $lesson->type }}">
                                    {{ $lesson->type === 'video' ? 'فيديو' : ($lesson->type === 'pdf' ? 'PDF' : 'نص') }}
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>

    <!-- Main Content Area -->
    <div class="course-main">
        <!-- Video Player Section -->
        <div class="video-section">
            <div class="video-container">
                @if($current_lesson && $current_lesson->type === 'video' && $current_lesson->video_url)
                    <iframe src="{{ $current_lesson->video_url }}" 
                            class="video-player"
                            allowfullscreen></iframe>
                @elseif($current_lesson && $current_lesson->type === 'pdf' && $current_lesson->pdf_file)
                    <div class="video-placeholder">
                        <i class="bi bi-file-pdf"></i>
                        <h3>ملف PDF</h3>
                        <p>اضغط على الزر أدناه لفتح الملف</p>
                        <a href="{{ asset('storage/' . $current_lesson->pdf_file) }}" 
                           target="_blank" 
                           class="complete-btn">
                            <i class="bi bi-file-pdf"></i>
                            فتح الملف
                        </a>
                    </div>
                @else
                    <div class="video-placeholder">
                        <i class="bi bi-play-circle"></i>
                        <h3>اختر درساً للبدء</h3>
                        <p>اضغط على أي درس من القائمة على اليسار لبدء التعلم</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Lesson Info Panel -->
        @if($current_lesson)
        <div class="lesson-info-panel">
            <div class="lesson-header">
                <div>
                    <h2 class="lesson-title-main">{{ $current_lesson->title_ar }}</h2>
                    @if($current_lesson->description_ar)
                        <p class="lesson-description">{{ $current_lesson->description_ar }}</p>
                    @endif
                </div>
                <div class="lesson-actions">
                    <button class="complete-btn" 
                            onclick="completeLesson({{ $current_lesson->id }})"
                            {{ $enrollment && $enrollment->isLessonCompleted($current_lesson->id) ? 'disabled' : '' }}>
                        <i class="bi bi-check-circle"></i>
                        {{ $enrollment && $enrollment->isLessonCompleted($current_lesson->id) ? 'مكتمل' : 'تحديد كمكتمل' }}
                    </button>
                    
                    @if($next_lesson)
                        <a href="{{ route('student.courses.player', ['course' => $course->id, 'lesson' => $next_lesson->id]) }}" 
                           class="next-lesson-btn">
                            <i class="bi bi-arrow-right"></i>
                            الدرس التالي
                        </a>
                    @endif
                </div>
            </div>
        </div>
        @endif

        <!-- Course Resources -->
        <div class="resources-section">
            <h3 class="resources-header">
                <i class="bi bi-folder"></i>
                ملحقات الدورة
            </h3>
            <div class="resources-grid">
                @forelse($course->resources()->published()->ordered()->get() as $resource)
                    <a href="{{ route('course-resources.download', $resource) }}" class="resource-card" target="_blank">
                        <div class="resource-icon">
                            <i class="bi {{ $resource->type_icon }}"></i>
                        </div>
                        <div class="resource-title">{{ $resource->title }}</div>
                        <div class="resource-description">{{ $resource->description }}</div>
                        <div class="resource-meta">
                            <span class="resource-type">{{ $resource->type_label }}</span>
                            @if($resource->file_size)
                                <span class="resource-size">{{ $resource->formatted_file_size }}</span>
                            @endif
                        </div>
                    </a>
                @empty
                    <div class="no-resources">
                        <i class="bi bi-folder-x"></i>
                        <p>لا توجد ملحقات متاحة لهذه الدورة</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Contact Instructor Section -->
        <div class="contact-section">
            <h3 class="contact-header">
                <i class="bi bi-chat-dots"></i>
                مراسلة المدرب
            </h3>
            <div class="contact-form">
                <form action="{{ route('messages.send-from-course', $course) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="type">نوع الرسالة</label>
                        <select name="type" id="type" class="form-control" required>
                            <option value="course_question">سؤال عن الدورة</option>
                            <option value="technical_support">دعم فني</option>
                            <option value="feedback">تقييم وملاحظات</option>
                            <option value="general">رسالة عامة</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="priority">الأولوية</label>
                        <select name="priority" id="priority" class="form-control" required>
                            <option value="low">منخفضة</option>
                            <option value="medium" selected>متوسطة</option>
                            <option value="high">عالية</option>
                            <option value="urgent">عاجلة</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="content">محتوى الرسالة</label>
                        <textarea name="content" id="content" class="form-control" rows="4" 
                                  placeholder="اكتب رسالتك هنا..." required></textarea>
                    </div>
                    
                    <button type="submit" class="send-message-btn">
                        <i class="bi bi-send"></i>
                        إرسال الرسالة
                    </button>
                </form>
            </div>
        </div>

        <!-- Quiz Section -->
        @if($current_lesson && $current_lesson->quizzes->count() > 0)
        <div class="quiz-section">
            <h3 class="quiz-header">
                <i class="bi bi-question-circle"></i>
                اختبارات الدرس
            </h3>
            @foreach($current_lesson->quizzes as $quiz)
            <div class="quiz-card">
                <div class="quiz-title">{{ $quiz->title_ar }}</div>
                <div class="quiz-meta">
                    <span><i class="bi bi-clock"></i> {{ $quiz->time_limit ?? 'غير محدد' }} دقيقة</span>
                    <span><i class="bi bi-question-circle"></i> {{ $quiz->questions->count() }} أسئلة</span>
                    <span><i class="bi bi-check-circle"></i> {{ $quiz->passing_score ?? 70 }}% للنجاح</span>
                </div>
                <a href="{{ route('student.quizzes.take', ['quiz' => $quiz->id]) }}" class="start-quiz-btn">
                    <i class="bi bi-play-circle"></i>
                    بدء الاختبار
                </a>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>

<script src="{{ asset('js/course-player.js') }}"></script>
<script>
function toggleSidebar() {
    const sidebar = document.getElementById('courseSidebar');
    const overlay = document.querySelector('.sidebar-overlay');
    
    sidebar.classList.toggle('show');
    overlay.classList.toggle('show');
}

function completeLesson(lessonId) {
    if (confirm('هل تريد تحديد هذا الدرس كمكتمل؟')) {
        const btn = event.target.closest('.complete-btn');
        btn.classList.add('loading');
        
        fetch(`/student/lessons/${lessonId}/complete`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                btn.classList.remove('loading');
                btn.classList.add('success-animation');
                btn.innerHTML = '<i class="bi bi-check-circle"></i> مكتمل';
                btn.disabled = true;
                
                // إذا تم إكمال الدورة، توجيه لصفحة التهنئة
                if (data.course_completed && data.celebration_url) {
                    setTimeout(() => {
                        window.location.href = data.celebration_url;
                    }, 1500);
                } else {
                    // تحديث شريط التقدم
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                }
            } else {
                btn.classList.remove('loading');
                alert('حدث خطأ أثناء تحديث حالة الدرس');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            btn.classList.remove('loading');
            alert('حدث خطأ أثناء تحديث حالة الدرس');
        });
    }
}

// تحسين تجربة المستخدم
document.addEventListener('DOMContentLoaded', function() {
    // البحث في الدروس
    const searchInput = document.getElementById('lessonSearch');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const lessonItems = document.querySelectorAll('.lesson-item');
            
            lessonItems.forEach(item => {
                const title = item.querySelector('.lesson-title').textContent.toLowerCase();
                if (title.includes(searchTerm)) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    }
    
    // تحسين التنقل في الجانب
    const lessonItems = document.querySelectorAll('.lesson-item');
    lessonItems.forEach(item => {
        item.addEventListener('click', function() {
            lessonItems.forEach(i => i.classList.remove('active'));
            this.classList.add('active');
        });
    });
});
</script>
@endsection 