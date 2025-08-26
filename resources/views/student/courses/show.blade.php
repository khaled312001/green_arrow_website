@extends('layouts.student')

@section('title', $course->title_ar . ' - لوحة تحكم الطالب')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/course-player.css') }}">
<style>
    /* CSS Variables - Udemy Style */
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
    }

    /* Global Styles */
    * {
        font-family: 'Cairo', 'Tajawal', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }

    body {
        background: var(--bg-secondary);
        min-height: 100vh;
        color: var(--text-primary);
    }

    /* Course Container - Udemy Style */
    .course-container {
        padding: 0;
        min-height: 100vh;
        background: var(--bg-secondary);
        display: flex;
    }

    /* Enhanced Sidebar - Udemy Professional Style */
    .course-sidebar {
        background: var(--bg-primary);
        border-left: 1px solid var(--border-color);
        height: 100vh;
        position: fixed;
        top: 0;
        left: 0;
        width: 320px;
        z-index: 1000;
        overflow-y: auto;
        box-shadow: var(--shadow-xl);
        transition: all var(--transition-normal);
    }

    .course-sidebar::-webkit-scrollbar {
        width: 8px;
    }

    .course-sidebar::-webkit-scrollbar-track {
        background: var(--bg-secondary);
    }

    .course-sidebar::-webkit-scrollbar-thumb {
        background: var(--border-color);
        border-radius: 4px;
    }

    .course-sidebar::-webkit-scrollbar-thumb:hover {
        background: var(--text-light);
    }

    .sidebar-header {
        background: var(--bg-primary);
        color: var(--text-primary);
        padding: 1.5rem;
        position: sticky;
        top: 0;
        z-index: 10;
        border-bottom: 1px solid var(--border-color);
    }

    .sidebar-header h5 {
        margin: 0;
        font-weight: 700;
        font-size: 1.1rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        color: var(--text-primary);
    }

    .sidebar-header i {
        font-size: 1.2rem;
        color: var(--secondary-color);
    }

    .course-progress-summary {
        background: var(--bg-secondary);
        border-radius: var(--border-radius-md);
        padding: 1rem;
        margin-top: 1rem;
        border: 1px solid var(--border-color);
    }

    .progress-summary-text {
        font-size: 0.875rem;
        margin-bottom: 0.75rem;
        color: var(--text-secondary);
        font-weight: 600;
    }

    .progress-summary-bar {
        background: var(--border-color);
        border-radius: 10px;
        height: 8px;
        overflow: hidden;
        margin-bottom: 0.75rem;
    }

    .progress-summary-fill {
        background: linear-gradient(90deg, var(--secondary-color), var(--secondary-light));
        height: 100%;
        border-radius: 10px;
        transition: width var(--transition-slow);
    }

    .progress-summary-percentage {
        font-size: 0.875rem;
        font-weight: 700;
        color: var(--text-primary);
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
        border-bottom: 1px solid var(--border-light);
    }

    .lesson-item:last-child {
        border-bottom: none;
    }

    .lesson-item:hover {
        background: var(--bg-secondary);
        color: var(--text-primary);
        text-decoration: none;
        transform: none;
    }

    .lesson-item.active {
        background: var(--bg-secondary);
        color: var(--text-primary);
        border-left: 4px solid var(--secondary-color);
    }

    .lesson-item.lesson-completed {
        background: rgba(164, 53, 240, 0.05);
        border-left: 4px solid var(--secondary-color);
    }

    .lesson-item.lesson-completed .lesson-icon {
        background: var(--secondary-color);
        color: white;
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
        background: var(--bg-secondary);
        color: var(--text-secondary);
        font-size: 1rem;
        transition: all var(--transition-normal);
        flex-shrink: 0;
        border: 1px solid var(--border-color);
    }

    .lesson-item.active .lesson-icon {
        background: var(--secondary-color);
        color: white;
        border-color: var(--secondary-color);
    }

    .lesson-info {
        flex: 1;
        min-width: 0;
    }

    .lesson-title {
        font-weight: 600;
        font-size: 0.875rem;
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

    .lesson-free-badge {
        background: var(--secondary-color);
        color: white;
        padding: 0.125rem 0.5rem;
        border-radius: 12px;
        font-size: 0.625rem;
        font-weight: 600;
    }

    /* Lesson Search Styles */
    .lesson-search {
        position: relative;
        margin-top: 1rem;
        margin-bottom: 1rem;
    }

    .lesson-search input {
        background: var(--bg-primary);
        border: 1px solid var(--border-color);
        border-radius: var(--border-radius-md);
        padding: 0.75rem 1rem 0.75rem 2.5rem;
        font-size: 0.875rem;
        width: 100%;
        transition: all var(--transition-normal);
        color: var(--text-primary);
    }

    .lesson-search input:focus {
        outline: none;
        border-color: var(--secondary-color);
        box-shadow: 0 0 0 3px rgba(164, 53, 240, 0.1);
        background: var(--bg-primary);
    }

    .lesson-search input::placeholder {
        color: var(--text-light);
    }

    .search-icon {
        position: absolute;
        left: 0.75rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-light);
        pointer-events: none;
        font-size: 0.875rem;
    }

    /* Main Content Area - Udemy Style */
    .course-main {
        margin-left: 320px;
        padding: 2rem;
        min-height: 100vh;
        background: var(--bg-secondary);
        flex: 1;
    }

    /* Course Header Section - Udemy Style */
    .course-header {
        background: linear-gradient(135deg, var(--bg-primary) 0%, var(--bg-secondary) 100%);
        border-radius: var(--border-radius-lg);
        padding: 2.5rem;
        margin-bottom: 2rem;
        box-shadow: var(--shadow-lg);
        border: 1px solid var(--border-color);
        position: relative;
        overflow: hidden;
    }

    .course-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--secondary-color), var(--secondary-light));
    }

    .course-title {
        font-size: 2.5rem;
        font-weight: 800;
        color: var(--text-primary);
        margin-bottom: 1rem;
        line-height: 1.2;
        background: linear-gradient(135deg, var(--text-primary), var(--secondary-color));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .course-description {
        font-size: 1rem;
        color: var(--text-secondary);
        line-height: 1.6;
        margin-bottom: 1.5rem;
    }

    .course-stats {
        display: flex;
        gap: 2rem;
        flex-wrap: wrap;
        padding-top: 1rem;
        border-top: 1px solid var(--border-color);
    }

    .stat-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        color: var(--text-secondary);
        font-weight: 600;
        font-size: 0.875rem;
        padding: 0.75rem 1rem;
        background: var(--bg-secondary);
        border-radius: var(--border-radius-md);
        border: 1px solid var(--border-light);
        transition: all var(--transition-normal);
    }

    .stat-item:hover {
        background: var(--bg-primary);
        border-color: var(--secondary-color);
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    .stat-item i {
        color: var(--secondary-color);
        font-size: 1.1rem;
    }

    /* Current Lesson Section - Udemy Style */
    .current-lesson-section {
        background: var(--bg-primary);
        border-radius: var(--border-radius-lg);
        margin-bottom: 2rem;
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--border-color);
        overflow: hidden;
    }

    .lesson-header {
        background: var(--bg-primary);
        color: var(--text-primary);
        padding: 1.5rem 2rem;
        border-bottom: 1px solid var(--border-color);
    }

    .lesson-header h5 {
        margin: 0;
        font-size: 1.25rem;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        color: var(--text-primary);
    }

    .lesson-header i {
        color: var(--secondary-color);
    }

    .lesson-content-wrapper {
        padding: 2rem;
    }

    .lesson-media {
        background: #000;
        border-radius: var(--border-radius-md);
        overflow: hidden;
        margin-bottom: 1.5rem;
        box-shadow: var(--shadow-md);
    }

    .lesson-video {
        width: 100%;
        height: 500px;
        border: none;
    }

    .lesson-pdf-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: var(--secondary-color);
        color: white;
        padding: 1rem 2rem;
        border-radius: var(--border-radius-md);
        text-decoration: none;
        font-weight: 600;
        transition: all var(--transition-normal);
        border: none;
        cursor: pointer;
    }

    .lesson-pdf-btn:hover {
        background: var(--secondary-dark);
        transform: translateY(-1px);
        box-shadow: var(--shadow-md);
        color: white;
        text-decoration: none;
    }

    .lesson-info-card {
        background: var(--bg-secondary);
        border-radius: var(--border-radius-md);
        padding: 1.5rem;
        border: 1px solid var(--border-color);
    }

    .lesson-info-title {
        font-size: 1rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .lesson-info-list {
        list-style: none;
        padding: 0;
        margin: 0 0 1.5rem 0;
    }

    .lesson-info-item {
        display: flex;
        justify-content: space-between;
        padding: 0.75rem 0;
        border-bottom: 1px solid var(--border-light);
    }

    .lesson-info-item:last-child {
        border-bottom: none;
    }

    .lesson-info-label {
        color: var(--text-secondary);
        font-weight: 500;
        font-size: 0.875rem;
    }

    .lesson-info-value {
        color: var(--text-primary);
        font-weight: 600;
        font-size: 0.875rem;
    }

    .lesson-description {
        margin-top: 1.5rem;
        padding-top: 1.5rem;
        border-top: 1px solid var(--border-light);
    }

    .complete-lesson-btn {
        width: 100%;
        background: var(--secondary-color);
        color: white;
        border: none;
        padding: 1rem;
        border-radius: var(--border-radius-md);
        font-weight: 600;
        font-size: 1rem;
        cursor: pointer;
        transition: all var(--transition-normal);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        margin-top: 1rem;
    }

    .complete-lesson-btn:hover {
        background: var(--secondary-dark);
        transform: translateY(-1px);
        box-shadow: var(--shadow-md);
    }

    .complete-lesson-btn:disabled {
        background: var(--text-light);
        cursor: not-allowed;
        transform: none;
        box-shadow: none;
    }

    /* Course Information Section - Udemy Style */
    .course-info-section {
        background: var(--bg-primary);
        border-radius: var(--border-radius-lg);
        margin-bottom: 2rem;
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--border-color);
        overflow: hidden;
    }

    .info-header {
        background: var(--bg-secondary);
        padding: 1.5rem 2rem;
        border-bottom: 1px solid var(--border-color);
    }

    .info-header h5 {
        margin: 0;
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--text-primary);
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .info-header i {
        color: var(--secondary-color);
    }

    .info-content {
        padding: 2rem;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.5rem;
    }

    .info-card {
        background: var(--bg-secondary);
        border-radius: var(--border-radius-md);
        padding: 1.5rem;
        border: 1px solid var(--border-color);
        transition: all var(--transition-normal);
    }

    .info-card:hover {
        box-shadow: var(--shadow-md);
        transform: translateY(-2px);
    }

    .info-card h6 {
        color: var(--text-primary);
        font-weight: 700;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 1rem;
    }

    .info-card h6 i {
        color: var(--secondary-color);
    }

    .info-card p {
        color: var(--text-secondary);
        line-height: 1.6;
        margin: 0;
        font-size: 0.875rem;
    }

    /* Course Progress Section - Udemy Style */
    .course-progress-section {
        background: var(--bg-primary);
        border-radius: var(--border-radius-lg);
        margin-bottom: 2rem;
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--border-color);
        overflow: hidden;
    }

    .progress-header {
        background: var(--bg-secondary);
        color: var(--text-primary);
        padding: 1.5rem 2rem;
        border-bottom: 1px solid var(--border-color);
    }

    .progress-header h5 {
        margin: 0;
        font-size: 1.25rem;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .progress-header i {
        color: var(--secondary-color);
    }

    .progress-content {
        padding: 2rem;
    }

    .progress-overview {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .progress-stat {
        text-align: center;
        padding: 1.5rem;
        background: var(--bg-secondary);
        border-radius: var(--border-radius-md);
        border: 1px solid var(--border-color);
        transition: all var(--transition-normal);
    }

    .progress-stat:hover {
        box-shadow: var(--shadow-md);
        transform: translateY(-2px);
    }

    .progress-stat-number {
        font-size: 2rem;
        font-weight: 700;
        color: var(--secondary-color);
        margin-bottom: 0.5rem;
    }

    .progress-stat-label {
        color: var(--text-secondary);
        font-weight: 600;
        font-size: 0.875rem;
    }

    .progress-bar-container {
        background: var(--bg-secondary);
        border-radius: var(--border-radius-md);
        padding: 1.5rem;
        border: 1px solid var(--border-color);
    }

    .progress-bar-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
    }

    .progress-bar-title {
        font-weight: 700;
        color: var(--text-primary);
        font-size: 1rem;
    }

    .progress-bar-percentage {
        font-weight: 700;
        color: var(--secondary-color);
        font-size: 1rem;
    }

    .progress-bar {
        background: var(--border-color);
        border-radius: 10px;
        height: 12px;
        overflow: hidden;
        margin-bottom: 0.75rem;
    }

    .progress-bar-fill {
        background: linear-gradient(90deg, var(--secondary-color), var(--secondary-light));
        height: 100%;
        border-radius: 10px;
        transition: width var(--transition-slow);
    }

    .progress-bar-text {
        font-size: 0.875rem;
        color: var(--text-secondary);
    }

    /* Next Lesson Section - Udemy Style */
    .next-lesson-section {
        background: var(--bg-primary);
        border-radius: var(--border-radius-lg);
        margin-bottom: 2rem;
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--border-color);
        overflow: hidden;
    }

    .next-lesson-header {
        background: linear-gradient(135deg, var(--secondary-color), var(--secondary-dark));
        color: white;
        padding: 1.5rem 2rem;
    }

    .next-lesson-header h5 {
        margin: 0;
        font-size: 1.25rem;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .next-lesson-content {
        padding: 2rem;
    }

    .next-lesson-card {
        background: var(--bg-secondary);
        border-radius: var(--border-radius-md);
        padding: 1.5rem;
        border: 1px solid var(--border-color);
        display: flex;
        align-items: center;
        gap: 1rem;
        transition: all var(--transition-normal);
        text-decoration: none;
        color: var(--text-primary);
    }

    .next-lesson-card:hover {
        box-shadow: var(--shadow-md);
        transform: translateY(-2px);
        text-decoration: none;
        color: var(--text-primary);
    }

    .next-lesson-icon {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background: var(--secondary-color);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        flex-shrink: 0;
    }

    .next-lesson-info {
        flex: 1;
    }

    .next-lesson-title {
        font-weight: 700;
        font-size: 1rem;
        margin-bottom: 0.5rem;
        color: var(--text-primary);
    }

    .next-lesson-meta {
        display: flex;
        align-items: center;
        gap: 1rem;
        font-size: 0.875rem;
        color: var(--text-secondary);
    }

    .next-lesson-arrow {
        color: var(--secondary-color);
        font-size: 1.5rem;
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
            padding: 1rem;
        }

        .course-title {
            font-size: 1.5rem;
        }

        .course-stats {
            gap: 1rem;
        }

        .lesson-video {
            height: 300px;
        }

        .info-grid {
            grid-template-columns: 1fr;
        }

        .progress-overview {
            grid-template-columns: repeat(2, 1fr);
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

    /* Print Styles */
    @media print {
        .course-sidebar,
        .sidebar-toggle {
            display: none;
        }

        .course-main {
            margin-left: 0;
        }
    }

    /* Accessibility */
    .lesson-item:focus,
    .complete-lesson-btn:focus {
        outline: 3px solid var(--secondary-color);
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

    <!-- Enhanced Sidebar - Udemy Style -->
    <div class="course-sidebar" id="courseSidebar">
        <div class="sidebar-header">
            <h5>
                <i class="bi bi-list-ul"></i>
                محتوى الدورة
            </h5>
            <div class="lesson-search">
                <input type="text" id="lessonSearch" placeholder="البحث في الدروس..." class="form-control">
                <i class="bi bi-search search-icon"></i>
            </div>
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
                                <span class="lesson-duration">
                                    <i class="bi bi-clock"></i>
                                    {{ $lesson->duration_minutes }} د
                                </span>
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

    <!-- Enhanced Main Content - Udemy Style -->
    <div class="course-main">
        <!-- Course Header Section -->
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
                    <span>{{ $course->duration_hours ?? 0 }} ساعة</span>
                </div>
                <div class="stat-item">
                    <i class="bi bi-check-circle"></i>
                    <span>{{ $enrollment ? $enrollment->lessons_completed : 0 }} مكتمل</span>
                </div>
                <div class="stat-item">
                    <i class="bi bi-star"></i>
                    <span>{{ $course->rating ?? 0 }}/5</span>
                </div>
            </div>
        </div>

        <!-- Course Progress Section -->
        <div class="course-progress-section">
            <div class="progress-header">
                <h5>
                    <i class="bi bi-graph-up"></i>
                    تقدمك في الدورة
                </h5>
            </div>
            <div class="progress-content">
                <div class="progress-overview">
                    <div class="progress-stat">
                        <div class="progress-stat-number">{{ $enrollment ? $enrollment->progress_percentage : 0 }}%</div>
                        <div class="progress-stat-label">نسبة الإكمال</div>
                    </div>
                    <div class="progress-stat">
                        <div class="progress-stat-number">{{ $enrollment ? $enrollment->lessons_completed : 0 }}</div>
                        <div class="progress-stat-label">دروس مكتملة</div>
                    </div>
                    <div class="progress-stat">
                        <div class="progress-stat-number">{{ $lessons->count() - ($enrollment ? $enrollment->lessons_completed : 0) }}</div>
                        <div class="progress-stat-label">دروس متبقية</div>
                    </div>
                    <div class="progress-stat">
                        <div class="progress-stat-number">{{ $enrollment ? $enrollment->quiz_attempts : 0 }}</div>
                        <div class="progress-stat-label">محاولات اختبار</div>
                    </div>
                </div>
                
                <div class="progress-bar-container">
                    <div class="progress-bar-header">
                        <div class="progress-bar-title">التقدم العام</div>
                        <div class="progress-bar-percentage">{{ $enrollment ? $enrollment->progress_percentage : 0 }}%</div>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-bar-fill" 
                             style="width: {{ $enrollment ? $enrollment->progress_percentage : 0 }}%">
                        </div>
                    </div>
                    <div class="progress-bar-text">
                        أكملت {{ $enrollment ? $enrollment->lessons_completed : 0 }} من {{ $lessons->count() }} درس
                    </div>
                </div>
            </div>
        </div>

        <!-- Next Lesson Section -->
        @if($next_lesson)
        <div class="next-lesson-section">
            <div class="next-lesson-header">
                <h5>
                    <i class="bi bi-arrow-right-circle"></i>
                    الدرس التالي
                </h5>
            </div>
            <div class="next-lesson-content">
                <a href="{{ route('student.lessons.show', ['course' => $course->id, 'lesson' => $next_lesson->id]) }}" 
                   class="next-lesson-card">
                    <div class="next-lesson-icon">
                        <i class="bi bi-{{ $next_lesson->type === 'video' ? 'play-circle' : ($next_lesson->type === 'pdf' ? 'file-pdf' : 'file-text') }}"></i>
                    </div>
                    <div class="next-lesson-info">
                        <div class="next-lesson-title">{{ $next_lesson->title_ar }}</div>
                        <div class="next-lesson-meta">
                            <span>
                                <i class="bi bi-clock"></i>
                                {{ $next_lesson->duration_minutes }} دقيقة
                            </span>
                            <span>
                                <i class="bi bi-{{ $next_lesson->type === 'video' ? 'play-circle' : ($next_lesson->type === 'pdf' ? 'file-pdf' : 'file-text') }}"></i>
                                {{ $next_lesson->type_text }}
                            </span>
                        </div>
                    </div>
                    <div class="next-lesson-arrow">
                        <i class="bi bi-arrow-left"></i>
                    </div>
                </a>
            </div>
        </div>
        @endif

        <!-- Current Lesson Section -->
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
                                    onclick="completeLesson({{ $current_lesson->id }})"
                                    {{ $enrollment && $enrollment->isLessonCompleted($current_lesson->id) ? 'disabled' : '' }}>
                                <i class="bi bi-check-circle"></i>
                                {{ $enrollment && $enrollment->isLessonCompleted($current_lesson->id) ? 'مكتمل' : 'تحديد كمكتمل' }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Course Information Section -->
        <div class="course-info-section">
            <div class="info-header">
                <h5>
                    <i class="bi bi-info-circle"></i>
                    معلومات الدورة
                </h5>
            </div>
            <div class="info-content">
                <div class="info-grid">
                    <div class="info-card">
                        <h6>
                            <i class="bi bi-person"></i>
                            المدرب
                        </h6>
                        <p>{{ $course->instructor->name }}</p>
                    </div>
                    
                    <div class="info-card">
                        <h6>
                            <i class="bi bi-tag"></i>
                            الفئة
                        </h6>
                        <p>{{ $course->category->name_ar }}</p>
                    </div>
                    
                    <div class="info-card">
                        <h6>
                            <i class="bi bi-bar-chart"></i>
                            المستوى
                        </h6>
                        <p>{{ $course->level_text }}</p>
                    </div>
                    
                    <div class="info-card">
                        <h6>
                            <i class="bi bi-calendar"></i>
                            تاريخ التسجيل
                        </h6>
                        <p>{{ $enrollment ? $enrollment->enrolled_at->format('Y-m-d') : 'غير مسجل' }}</p>
                    </div>
                    
                    @if($course->objectives_ar)
                    <div class="info-card">
                        <h6>
                            <i class="bi bi-target"></i>
                            أهداف الدورة
                        </h6>
                        <p>{{ $course->objectives_ar }}</p>
                    </div>
                    @endif
                    
                    @if($course->requirements_ar)
                    <div class="info-card">
                        <h6>
                            <i class="bi bi-list-check"></i>
                            المتطلبات
                        </h6>
                        <p>{{ $course->requirements_ar }}</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
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
        const btn = event.target.closest('.complete-lesson-btn');
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
                
                // تحديث شريط التقدم
                setTimeout(() => {
                    location.reload();
                }, 1000);
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
    // إضافة تأثيرات بصرية للعناصر
    const cards = document.querySelectorAll('.info-card, .progress-stat');
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-2px)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
    
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