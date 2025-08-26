@extends('layouts.student')

@section('title', 'لوحة الطالب - أكاديمية السهم الأخضر')

@push('styles')
<style>
    /* ========================================
       CSS VARIABLES & FOUNDATION
       ======================================== */
    :root {
        /* Colors - Primary */
        --primary-color: #10b981;
        --primary-dark: #059669;
        --primary-light: #34d399;
        --primary-gradient: linear-gradient(135deg, #10b981, #059669);
        
        /* Colors - Secondary */
        --secondary-color: #fbbf24;
        --secondary-dark: #f59e0b;
        --secondary-gradient: linear-gradient(135deg, #fbbf24, #f59e0b);
        
        /* Colors - Accent */
        --accent-color: #8b5cf6;
        --accent-gradient: linear-gradient(135deg, #8b5cf6, #7c3aed);
        
        /* Colors - Status */
        --success-color: #10b981;
        --warning-color: #f59e0b;
        --danger-color: #ef4444;
        --info-color: #3b82f6;
        
        /* Colors - Text */
        --text-primary: #1f2937;
        --text-secondary: #64748b;
        --text-light: #9ca3af;
        --text-white: #ffffff;
        
        /* Colors - Background */
        --bg-primary: #ffffff;
        --bg-secondary: #f8fafc;
        --bg-tertiary: #f1f5f9;
        --bg-dark: #1f2937;
        --bg-gradient: linear-gradient(135deg, #f8fafc, #e2e8f0);
        
        /* Colors - Border */
        --border-color: #e2e8f0;
        --border-light: #f1f5f9;
        
        /* Shadows */
        --shadow-sm: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
        --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        --shadow-2xl: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        --shadow-glow: 0 0 20px rgba(16, 185, 129, 0.3);
        
        /* Border Radius */
        --border-radius-sm: 0.5rem;
        --border-radius-md: 1rem;
        --border-radius-lg: 1.5rem;
        --border-radius-xl: 2rem;
        --border-radius-2xl: 3rem;
        
        /* Transitions */
        --transition-fast: 0.15s cubic-bezier(0.4, 0, 0.2, 1);
        --transition-normal: 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        --transition-slow: 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        
        /* Effects */
        --backdrop-blur: blur(10px);
    }

    /* ========================================
       GLOBAL STYLES & LAYOUT
       ======================================== */
    
    /* Typography & Base Styles */
    * {
        font-family: 'Cairo', 'Tajawal', sans-serif;
        box-sizing: border-box;
    }

    body {
        background: var(--bg-secondary);
        min-height: 100vh;
        line-height: 1.6;
        color: var(--text-primary);
    }

    /* Main Container */
    .dashboard-container {
        padding: 2rem;
        max-width: 1400px;
        margin: 0 auto;
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        min-height: 100vh;
        position: relative;
    }

    /* Background Pattern */
    .dashboard-container::before {
        content: '';
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: 
            radial-gradient(circle at 20% 80%, rgba(16, 185, 129, 0.1) 0%, transparent 50%),
            radial-gradient(circle at 80% 20%, rgba(139, 92, 246, 0.1) 0%, transparent 50%),
            radial-gradient(circle at 40% 40%, rgba(251, 191, 36, 0.05) 0%, transparent 50%);
        pointer-events: none;
        z-index: -1;
    }

    /* ========================================
       WELCOME HEADER SECTION - ENHANCED
       ======================================== */
    
    .welcome-header {
        background: linear-gradient(135deg, #10b981 0%, #059669 50%, #047857 100%);
        color: var(--text-white);
        padding: 3rem 2.5rem;
        border-radius: var(--border-radius-2xl);
        margin-bottom: 3rem;
        position: relative;
        overflow: hidden;
        box-shadow: 
            0 20px 40px rgba(16, 185, 129, 0.3),
            0 0 0 1px rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(20px);
    }

    .welcome-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="0.5"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
        opacity: 0.3;
    }

    .welcome-header::after {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
        animation: float 6s ease-in-out infinite;
    }

    .welcome-content {
        position: relative;
        z-index: 2;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 2rem;
    }

    .welcome-text h1 {
        font-size: 2.5rem;
        font-weight: 900;
        margin-bottom: 0.5rem;
        text-shadow: 0 4px 8px rgba(0,0,0,0.2);
        background: linear-gradient(45deg, #ffffff, #f0f9ff, #e0f2fe);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        letter-spacing: -0.02em;
        line-height: 1.1;
    }

    .welcome-text p {
        font-size: 1.1rem;
        opacity: 0.95;
        font-weight: 500;
        text-shadow: 0 1px 2px rgba(0,0,0,0.1);
    }

    .welcome-emoji {
        font-size: 3rem;
        margin-right: 0.75rem;
        animation: wave 2.5s ease-in-out infinite;
        display: inline-block;
        filter: drop-shadow(0 4px 8px rgba(0,0,0,0.2));
    }

    .welcome-actions {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .welcome-btn {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        background: rgba(255, 255, 255, 0.2);
        color: white;
        text-decoration: none;
        padding: 0.75rem 1.5rem;
        border-radius: var(--border-radius-xl);
        font-weight: 600;
        transition: all var(--transition-normal);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    .welcome-btn:hover {
        background: rgba(255, 255, 255, 0.3);
        transform: translateY(-2px);
        color: white;
        text-decoration: none;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
    }

    @keyframes wave {
        0%, 100% { transform: rotate(0deg) scale(1); }
        25% { transform: rotate(25deg) scale(1.1); }
        50% { transform: rotate(0deg) scale(1.05); }
        75% { transform: rotate(-15deg) scale(1.1); }
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(180deg); }
    }

    /* ========================================
       STATISTICS SECTION - ENHANCED
       ======================================== */
    
    .stats-section {
        margin-bottom: 3rem;
    }

    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        padding: 1rem 0;
        border-bottom: 2px solid;
        border-image: linear-gradient(90deg, var(--primary-color), var(--accent-color)) 1;
        position: relative;
    }

    .section-header::before {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 50px;
        height: 2px;
        background: var(--primary-gradient);
        border-radius: 2px;
    }

    .section-title {
        font-size: 1.75rem;
        font-weight: 900;
        background: linear-gradient(135deg, var(--text-primary), var(--primary-color));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin: 0;
        letter-spacing: -0.01em;
    }

    .section-link {
        color: var(--primary-color);
        text-decoration: none;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all var(--transition-normal);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .section-link:hover {
        color: var(--primary-dark);
        text-decoration: none;
        transform: translateX(-3px);
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 2rem;
        position: relative;
    }

    .stat-card {
        background: rgba(255, 255, 255, 0.95);
        padding: 2rem;
        border-radius: var(--border-radius-2xl);
        box-shadow: 
            0 10px 30px rgba(0, 0, 0, 0.1),
            0 0 0 1px rgba(255, 255, 255, 0.8);
        border: 1px solid rgba(255, 255, 255, 0.2);
        transition: all var(--transition-normal);
        position: relative;
        overflow: hidden;
        backdrop-filter: blur(20px);
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(16, 185, 129, 0.08), transparent);
        transition: left var(--transition-slow);
    }

    .stat-card:hover::before {
        left: 100%;
    }

    .stat-card:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: var(--shadow-2xl), var(--shadow-glow);
        border-color: var(--primary-color);
    }

    .stat-card::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--primary-gradient);
        transform: scaleX(0);
        transition: transform var(--transition-normal);
        transform-origin: left;
    }

    .stat-card:hover::after {
        transform: scaleX(1);
    }

    .stat-content {
        display: flex;
        align-items: center;
        justify-content: space-between;
        position: relative;
        z-index: 1;
    }

    .stat-info h3 {
        font-size: 3rem;
        font-weight: 900;
        margin-bottom: 0.5rem;
        background: linear-gradient(135deg, #10b981, #059669, #047857);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        line-height: 0.9;
        letter-spacing: -0.02em;
    }

    .stat-info p {
        color: var(--text-secondary);
        font-size: 0.95rem;
        font-weight: 600;
        margin: 0;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .stat-icon {
        width: 70px;
        height: 70px;
        border-radius: var(--border-radius-2xl);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.8rem;
        transition: all var(--transition-normal);
        position: relative;
        overflow: hidden;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }

    .stat-icon::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(45deg, rgba(255,255,255,0.2), transparent);
        transform: translateX(-100%);
        transition: transform var(--transition-normal);
    }

    .stat-card:hover .stat-icon::before {
        transform: translateX(100%);
    }

    .stat-card:hover .stat-icon {
        transform: scale(1.15) rotate(5deg);
        box-shadow: var(--shadow-lg);
    }

    .stat-icon.courses { 
        background: linear-gradient(135deg, #10b981, #059669, #047857);
        box-shadow: 0 12px 35px rgba(16, 185, 129, 0.4);
    }
    .stat-icon.lessons { 
        background: linear-gradient(135deg, #3b82f6, #2563eb, #1d4ed8);
        box-shadow: 0 12px 35px rgba(59, 130, 246, 0.4);
    }
    .stat-icon.certificates { 
        background: linear-gradient(135deg, #fbbf24, #f59e0b, #d97706);
        box-shadow: 0 12px 35px rgba(251, 191, 36, 0.4);
    }
    .stat-icon.hours { 
        background: linear-gradient(135deg, #ef4444, #dc2626, #b91c1c);
        box-shadow: 0 12px 35px rgba(239, 68, 68, 0.4);
    }

    /* ========================================
       LIVE LESSONS SECTION - NEW
       ======================================== */
    
    .live-lessons-section {
        background: rgba(255, 255, 255, 0.95);
        border-radius: var(--border-radius-2xl);
        padding: 2rem;
        box-shadow: var(--shadow-lg);
        border: 1px solid var(--border-color);
        margin-bottom: 3rem;
        backdrop-filter: blur(20px);
    }

    .live-lesson-item {
        display: flex;
        align-items: center;
        gap: 1.5rem;
        padding: 1.5rem;
        border-radius: var(--border-radius-lg);
        background: var(--bg-secondary);
        margin-bottom: 1rem;
        transition: all var(--transition-normal);
        border: 1px solid transparent;
    }

    .live-lesson-item:last-child {
        margin-bottom: 0;
    }

    .live-lesson-item:hover {
        background: rgba(16, 185, 129, 0.1);
        transform: translateX(5px);
        border-color: var(--primary-color);
        box-shadow: var(--shadow-md);
    }

    .live-lesson-icon {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: linear-gradient(135deg, #ef4444, #dc2626);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.2rem;
        flex-shrink: 0;
        animation: pulse 2s ease-in-out infinite;
    }

    .live-lesson-content {
        flex: 1;
    }

    .live-lesson-title {
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 0.25rem;
        font-size: 1.1rem;
    }

    .live-lesson-course {
        font-size: 0.9rem;
        color: var(--text-secondary);
    }

    .live-lesson-time {
        color: #ef4444;
        font-weight: 700;
        font-size: 1rem;
        background: rgba(239, 68, 68, 0.1);
        padding: 0.5rem 1rem;
        border-radius: var(--border-radius-xl);
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.1); }
    }

    /* ========================================
       COURSES SECTION - ENHANCED
       ======================================== */

    .courses-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 2rem;
        margin-bottom: 3rem;
    }

    .course-card {
        background: rgba(255, 255, 255, 0.95);
        border-radius: var(--border-radius-2xl);
        box-shadow: 
            0 15px 35px rgba(0, 0, 0, 0.1),
            0 0 0 1px rgba(255, 255, 255, 0.8);
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, 0.2);
        transition: all var(--transition-normal);
        position: relative;
        backdrop-filter: blur(20px) saturate(180%);
    }

    .course-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(16, 185, 129, 0.05), transparent);
        transition: left var(--transition-slow);
        z-index: 1;
    }

    .course-card:hover::before {
        left: 100%;
    }

    .course-card:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: var(--shadow-2xl), var(--shadow-glow);
        border-color: var(--primary-color);
    }

    .course-image {
        position: relative;
        height: 200px;
        overflow: hidden;
    }

    .course-image::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(180deg, transparent 0%, rgba(0,0,0,0.3) 100%);
        z-index: 1;
        opacity: 0;
        transition: opacity var(--transition-normal);
    }

    .course-card:hover .course-image::before {
        opacity: 1;
    }

    .course-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform var(--transition-slow);
    }

    .course-card:hover .course-image img {
        transform: scale(1.15);
    }

    .course-progress-badge {
        position: absolute;
        top: 1rem;
        right: 1rem;
        background: rgba(0, 0, 0, 0.9);
        color: white;
        padding: 0.75rem 1.25rem;
        border-radius: var(--border-radius-2xl);
        font-size: 0.85rem;
        font-weight: 800;
        backdrop-filter: blur(20px);
        z-index: 2;
        border: 1px solid rgba(255,255,255,0.2);
        box-shadow: 
            0 8px 25px rgba(0, 0, 0, 0.3),
            0 0 0 1px rgba(255, 255, 255, 0.1);
        transition: all var(--transition-normal);
        letter-spacing: 0.5px;
    }

    .course-card:hover .course-progress-badge {
        background: rgba(16, 185, 129, 0.95);
        transform: scale(1.05);
    }

    .course-content {
        padding: 1.5rem;
        position: relative;
        z-index: 2;
    }

    .course-title {
        font-size: 1.2rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 0.5rem;
        line-height: 1.4;
    }

    .course-instructor {
        color: var(--text-secondary);
        font-size: 0.9rem;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .course-instructor i {
        color: var(--primary-color);
    }

    .progress-section {
        margin-bottom: 1.5rem;
    }

    .progress-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 0.5rem;
    }

    .progress-label {
        font-size: 0.9rem;
        color: var(--text-secondary);
        font-weight: 600;
    }

    .progress-percentage {
        font-size: 0.9rem;
        color: var(--primary-color);
        font-weight: 700;
    }

    .progress-bar {
        width: 100%;
        height: 12px;
        background: var(--bg-tertiary);
        border-radius: var(--border-radius-xl);
        overflow: hidden;
        position: relative;
        box-shadow: inset 0 2px 4px rgba(0,0,0,0.1);
    }

    .progress-fill {
        height: 100%;
        background: var(--primary-gradient);
        border-radius: var(--border-radius-xl);
        transition: width var(--transition-slow);
        position: relative;
        box-shadow: 0 2px 8px rgba(16, 185, 129, 0.3);
    }

    .progress-fill::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
        animation: shimmer 2s infinite;
        border-radius: var(--border-radius-xl);
    }

    @keyframes shimmer {
        0% { transform: translateX(-100%); }
        100% { transform: translateX(100%); }
    }

    .course-actions {
        display: flex;
        gap: 0.75rem;
    }

    .btn {
        padding: 1rem 1.75rem;
        border-radius: var(--border-radius-2xl);
        font-weight: 700;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all var(--transition-normal);
        border: none;
        cursor: pointer;
        font-size: 0.9rem;
        position: relative;
        overflow: hidden;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left var(--transition-normal);
    }

    .btn:hover::before {
        left: 100%;
    }

    .btn-primary {
        background: linear-gradient(135deg, #10b981, #059669, #047857);
        color: white;
        flex: 1;
        box-shadow: 
            0 8px 25px rgba(16, 185, 129, 0.3),
            0 0 0 1px rgba(255, 255, 255, 0.1);
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #059669, #047857, #065f46);
        transform: translateY(-4px) scale(1.03);
        box-shadow: 
            0 15px 35px rgba(16, 185, 129, 0.4),
            0 0 0 1px rgba(255, 255, 255, 0.2);
        color: white;
        text-decoration: none;
    }

    .btn-outline {
        background: transparent;
        color: var(--primary-color);
        border: 2px solid var(--primary-color);
        padding: 0.875rem;
        position: relative;
        overflow: hidden;
    }

    .btn-outline::after {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: var(--primary-gradient);
        transition: left var(--transition-normal);
        z-index: -1;
    }

    .btn-outline:hover::after {
        left: 0;
    }

    .btn-outline:hover {
        color: white;
        transform: translateY(-3px) scale(1.02);
        box-shadow: var(--shadow-xl), var(--shadow-glow);
        text-decoration: none;
        border-color: var(--primary-color);
    }

    /* ========================================
       QUICK ACTIONS SECTION - ENHANCED
       ======================================== */

    .quick-actions {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 3rem;
    }

    .quick-action-card {
        background: rgba(255, 255, 255, 0.95);
        padding: 2rem 1.5rem;
        border-radius: var(--border-radius-2xl);
        box-shadow: 
            0 15px 35px rgba(0, 0, 0, 0.1),
            0 0 0 1px rgba(255, 255, 255, 0.8);
        text-decoration: none;
        text-align: center;
        transition: all var(--transition-normal);
        border: 1px solid rgba(255, 255, 255, 0.2);
        position: relative;
        overflow: hidden;
        backdrop-filter: blur(20px) saturate(180%);
    }

    .quick-action-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(16, 185, 129, 0.08), transparent);
        transition: left var(--transition-slow);
    }

    .quick-action-card:hover::before {
        left: 100%;
    }

    .quick-action-card::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--primary-gradient);
        transform: scaleX(0);
        transition: transform var(--transition-normal);
        transform-origin: left;
    }

    .quick-action-card:hover::after {
        transform: scaleX(1);
    }

    .quick-action-card:hover {
        transform: translateY(-8px) scale(1.03);
        box-shadow: var(--shadow-2xl), var(--shadow-glow);
        border-color: var(--primary-color);
        text-decoration: none;
    }

    .quick-action-icon {
        font-size: 3rem;
        margin-bottom: 1.5rem;
        display: block;
        transition: all var(--transition-normal);
        position: relative;
        filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.1));
    }

    .quick-action-card:hover .quick-action-icon {
        transform: scale(1.15) rotate(5deg);
    }

    .quick-action-title {
        color: var(--text-primary);
        margin-bottom: 0.5rem;
        font-weight: 800;
        font-size: 1.1rem;
        position: relative;
        z-index: 1;
    }

    .quick-action-description {
        color: var(--text-secondary);
        font-size: 0.9rem;
        margin: 0;
        position: relative;
        z-index: 1;
        line-height: 1.5;
    }

    .quick-action-card.courses .quick-action-icon { 
        color: var(--primary-color); 
        text-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }
    .quick-action-card.certificates .quick-action-icon { 
        color: var(--secondary-color); 
        text-shadow: 0 4px 12px rgba(251, 191, 36, 0.3);
    }
    .quick-action-card.payments .quick-action-icon { 
        color: #3b82f6; 
        text-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
    }
    .quick-action-card.profile .quick-action-icon { 
        color: #ef4444; 
        text-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
    }

    /* ========================================
       ACTIVITY SECTION - ENHANCED
       ======================================== */

    .activity-list {
        background: rgba(255, 255, 255, 0.95);
        border-radius: var(--border-radius-2xl);
        box-shadow: 
            0 20px 40px rgba(0, 0, 0, 0.1),
            0 0 0 1px rgba(255, 255, 255, 0.8);
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(20px) saturate(180%);
    }

    .activity-item {
        display: flex;
        align-items: center;
        gap: 1.5rem;
        padding: 1.5rem;
        border-bottom: 1px solid var(--border-light);
        transition: all var(--transition-normal);
        position: relative;
        overflow: hidden;
    }

    .activity-item::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(16, 185, 129, 0.05), transparent);
        transition: left var(--transition-slow);
    }

    .activity-item:hover::before {
        left: 100%;
    }

    .activity-item:last-child {
        border-bottom: none;
    }

    .activity-item:hover {
        background: var(--bg-secondary);
        transform: translateX(5px);
        box-shadow: var(--shadow-md);
    }

    .activity-icon {
        width: 50px;
        height: 50px;
        border-radius: var(--border-radius-xl);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.2rem;
        flex-shrink: 0;
        position: relative;
        overflow: hidden;
        box-shadow: var(--shadow-md);
    }

    .activity-icon.quiz { 
        background: var(--accent-gradient);
        box-shadow: 0 4px 15px rgba(139, 92, 246, 0.3);
    }
    .activity-icon.lesson { 
        background: var(--primary-gradient);
        box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
    }
    .activity-icon.certificate { 
        background: var(--secondary-gradient);
        box-shadow: 0 4px 15px rgba(251, 191, 36, 0.3);
    }

    .activity-content {
        flex: 1;
        min-width: 0;
    }

    .activity-title {
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 0.25rem;
        line-height: 1.4;
        font-size: 1rem;
    }

    .activity-subtitle {
        font-size: 0.85rem;
        color: var(--text-secondary);
    }

    .activity-time {
        color: var(--text-light);
        font-size: 0.8rem;
        white-space: nowrap;
        font-weight: 500;
    }

    /* ========================================
       EMPTY STATE - ENHANCED
       ======================================== */

    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        background: rgba(255, 255, 255, 0.95);
        border-radius: var(--border-radius-2xl);
        box-shadow: 
            0 20px 40px rgba(0, 0, 0, 0.1),
            0 0 0 1px rgba(255, 255, 255, 0.8);
        border: 2px dashed rgba(16, 185, 129, 0.3);
        position: relative;
        overflow: hidden;
        transition: all var(--transition-normal);
        backdrop-filter: blur(20px) saturate(180%);
    }

    .empty-state::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(16, 185, 129, 0.05) 0%, transparent 70%);
        animation: rotate 20s linear infinite;
    }

    @keyframes rotate {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .empty-state:hover {
        border-color: var(--primary-color);
        box-shadow: var(--shadow-xl);
        transform: translateY(-5px);
    }

    .empty-state i {
        font-size: 5rem;
        color: var(--text-light);
        margin-bottom: 2rem;
        display: block;
        position: relative;
        z-index: 1;
        animation: bounce 2.5s ease-in-out infinite;
        filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.1));
    }

    @keyframes bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }

    .empty-state h3 {
        color: var(--text-primary);
        margin-bottom: 1rem;
        font-weight: 800;
        font-size: 1.4rem;
        position: relative;
        z-index: 1;
    }

    .empty-state p {
        color: var(--text-secondary);
        margin-bottom: 2rem;
        font-size: 1rem;
        line-height: 1.6;
        position: relative;
        z-index: 1;
    }

    /* ========================================
       RESPONSIVE DESIGN - ENHANCED
       ======================================== */

    @media (max-width: 768px) {
        .dashboard-container {
            padding: 1rem;
        }

        .welcome-header {
            padding: 2rem 1.5rem;
        }

        .welcome-content {
            flex-direction: column;
            text-align: center;
        }

        .welcome-text h1 {
            font-size: 2rem;
        }

        .stats-grid {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        .courses-grid {
            grid-template-columns: 1fr;
        }

        .quick-actions {
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }

        .section-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }

        .live-lesson-item {
            flex-direction: column;
            text-align: center;
            gap: 1rem;
        }

        .activity-item {
            flex-direction: column;
            text-align: center;
            gap: 1rem;
        }
    }

    @media (max-width: 480px) {
        .quick-actions {
            grid-template-columns: 1fr;
        }

        .course-actions {
            flex-direction: column;
        }

        .welcome-actions {
            width: 100%;
            justify-content: center;
        }

        .welcome-btn {
            flex: 1;
            justify-content: center;
        }
    }

    /* ========================================
       LOADING & ANIMATION ENHANCEMENTS
       ======================================== */

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

    .success-animation {
        animation: successPulse 0.6s ease-in-out;
    }

    @keyframes successPulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }

    /* Modern Scrollbar */
    ::-webkit-scrollbar {
        width: 8px;
    }

    ::-webkit-scrollbar-track {
        background: rgba(0, 0, 0, 0.05);
        border-radius: 4px;
    }

    ::-webkit-scrollbar-thumb {
        background: linear-gradient(135deg, #10b981, #059669);
        border-radius: 4px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(135deg, #059669, #047857);
    }

    /* Selection Styling */
    ::selection {
        background: rgba(16, 185, 129, 0.3);
        color: #1f2937;
    }

    ::-moz-selection {
        background: rgba(16, 185, 129, 0.3);
        color: #1f2937;
    }
</style>
@endpush

@section('content')
<div class="dashboard-container">
    <!-- Welcome Header -->
    <div class="welcome-header">
        <div class="welcome-content">
            <div class="welcome-text">
                <h1>مرحباً {{ auth()->user()->name }}! <span class="welcome-emoji">👋</span></h1>
                <p>تابع تقدمك التعليمي واستكشف الدورات الجديدة في رحلتك نحو النجاح</p>
            </div>
            <div class="welcome-actions">
                <a href="{{ route('courses') }}" class="welcome-btn">
                    <i class="bi bi-search"></i>
                    استكشف الدورات
                </a>
                <a href="{{ route('student.progress') }}" class="welcome-btn">
                    <i class="bi bi-graph-up"></i>
                    تقدمي
                </a>
            </div>
        </div>
    </div>

    <!-- Statistics Section -->
    <section class="stats-section">
        <div class="section-header">
            <h2 class="section-title">إحصائياتي</h2>
        </div>
        
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-content">
                    <div class="stat-info">
                        <h3>{{ $stats['enrolled_courses'] }}</h3>
                        <p>الدورات المسجل بها</p>
                    </div>
                    <div class="stat-icon courses">
                        <i class="bi bi-book"></i>
                    </div>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-content">
                    <div class="stat-info">
                        <h3>{{ $stats['completed_lessons'] }}</h3>
                        <p>الدروس المكتملة</p>
                    </div>
                    <div class="stat-icon lessons">
                        <i class="bi bi-check-circle"></i>
                    </div>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-content">
                    <div class="stat-info">
                        <h3>{{ $stats['certificates'] }}</h3>
                        <p>الشهادات المحصل عليها</p>
                    </div>
                    <div class="stat-icon certificates">
                        <i class="bi bi-award"></i>
                    </div>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-content">
                    <div class="stat-info">
                        <h3>{{ number_format($stats['total_hours'], 1) }}</h3>
                        <p>ساعات التعلم</p>
                    </div>
                    <div class="stat-icon hours">
                        <i class="bi bi-clock"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Live Lessons Today -->
    @if(isset($today_live_lessons) && $today_live_lessons->count() > 0)
    <section class="live-lessons-section">
        <div class="section-header">
            <h2 class="section-title">المحاضرات المباشرة اليوم</h2>
            <a href="{{ route('student.lessons') }}" class="section-link">
                عرض جميع المحاضرات
                <i class="bi bi-arrow-left"></i>
            </a>
        </div>
        
        @foreach($today_live_lessons as $lesson)
        <div class="live-lesson-item">
            <div class="live-lesson-icon">
                <i class="bi bi-broadcast"></i>
            </div>
            <div class="live-lesson-content">
                <div class="live-lesson-title">{{ $lesson->title_ar }}</div>
                <div class="live-lesson-course">{{ $lesson->course->title_ar }} - {{ $lesson->course->instructor->name }}</div>
            </div>
            <div class="live-lesson-time">
                {{ $lesson->live_session_date->format('H:i') }}
            </div>
        </div>
        @endforeach
    </section>
    @endif

    <!-- Current Courses -->
    <section class="current-courses">
        <div class="section-header">
            <h2 class="section-title">دوراتي الحالية</h2>
            <a href="{{ route('student.courses') }}" class="section-link">
                عرض جميع الدورات
                <i class="bi bi-arrow-left"></i>
            </a>
        </div>
        
        @if($enrolledCourses->count() > 0)
        <div class="courses-grid">
            @foreach($enrolledCourses as $enrollment)
            <div class="course-card">
                <div class="course-image">
                    <img src="{{ $enrollment->course->featured_image ? asset('storage/' . $enrollment->course->featured_image) : 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80' }}" 
                         alt="{{ $enrollment->course->title_ar }}">
                    <div class="course-progress-badge">
                        {{ number_format($enrollment->progress_percentage, 0) }}% مكتمل
                    </div>
                </div>
                <div class="course-content">
                    <h3 class="course-title">{{ $enrollment->course->title_ar }}</h3>
                    <div class="course-instructor">
                        <i class="bi bi-person"></i>
                        {{ $enrollment->course->instructor->name }}
                    </div>
                    
                    <div class="progress-section">
                        <div class="progress-header">
                            <span class="progress-label">التقدم</span>
                            <span class="progress-percentage">{{ number_format($enrollment->progress_percentage, 0) }}%</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: {{ $enrollment->progress_percentage }}%"></div>
                        </div>
                    </div>
                    
                    <div class="course-actions">
                        <a href="{{ route('student.courses.show', $enrollment->course) }}" class="btn btn-primary">
                            <i class="bi bi-play-circle"></i>
                            استمر في التعلم
                        </a>
                        <a href="{{ route('student.courses.show', $enrollment->course) }}" class="btn btn-outline">
                            <i class="bi bi-eye"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="empty-state">
            <i class="bi bi-book"></i>
            <h3>لم تسجل في أي دورة بعد</h3>
            <p>ابدأ رحلتك التعليمية من خلال التسجيل في إحدى دوراتنا المتميزة</p>
            <a href="{{ route('courses') }}" class="btn btn-primary">
                <i class="bi bi-search"></i>
                استكشف الدورات
            </a>
        </div>
        @endif
    </section>

    <!-- Recent Activity -->
    <section class="recent-activity">
        <div class="section-header">
            <h2 class="section-title">النشاط الأخير</h2>
        </div>
        
        @if(isset($recentActivity) && $recentActivity->count() > 0)
        <div class="activity-list">
            @foreach($recentActivity as $activity)
            <div class="activity-item">
                <div class="activity-icon quiz">
                    <i class="bi bi-question-circle"></i>
                </div>
                <div class="activity-content">
                    <div class="activity-title">
                        @if($activity->activity_type == 'quiz_attempted')
                            أخذت اختبار "{{ $activity->quiz->title_ar }}"
                        @else
                            أكملت درس "{{ $activity->lesson->title_ar ?? 'غير محدد' }}"
                        @endif
                    </div>
                    <div class="activity-subtitle">
                        في دورة {{ $activity->quiz->course->title_ar ?? 'غير محدد' }}
                    </div>
                </div>
                <div class="activity-time">
                    {{ $activity->activity_date->diffForHumans() }}
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="empty-state">
            <i class="bi bi-activity"></i>
            <h3>لا يوجد نشاط حديث</h3>
            <p>ابدأ التعلم لترى نشاطك هنا</p>
        </div>
        @endif
    </section>

    <!-- Recommended Courses -->
    @if(isset($recommendedCourses) && $recommendedCourses->count() > 0)
    <section class="recommended-courses">
        <div class="section-header">
            <h2 class="section-title">دورات موصى بها</h2>
            <a href="{{ route('courses') }}" class="section-link">
                عرض جميع الدورات
                <i class="bi bi-arrow-left"></i>
            </a>
        </div>
        
        <div class="courses-grid">
            @foreach($recommendedCourses as $course)
            <div class="course-card">
                <div class="course-image">
                    <img src="{{ $course->featured_image ? asset('storage/' . $course->featured_image) : 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80' }}" 
                         alt="{{ $course->title_ar }}">
                    @if($course->discount_percentage > 0)
                    <div class="course-progress-badge" style="background: #ef4444;">
                        -{{ $course->discount_percentage }}%
                    </div>
                    @endif
                </div>
                <div class="course-content">
                    <h3 class="course-title">{{ $course->title_ar }}</h3>
                    <div class="course-instructor">
                        <i class="bi bi-person"></i>
                        {{ $course->instructor->name }}
                    </div>
                    
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                        <div style="display: flex; align-items: center; gap: 0.25rem;">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="bi bi-star{{ $i <= ($course->rating ?? 5) ? '-fill' : '' }}" style="color: #fbbf24; font-size: 0.8rem;"></i>
                            @endfor
                            <span style="font-size: 0.8rem; color: var(--text-secondary);">({{ $course->reviews_count ?? 0 }})</span>
                        </div>
                        <div style="font-size: 1rem; font-weight: 700; color: var(--primary-color);">
                            {{ $course->is_free ? 'مجاني' : number_format($course->final_price ?? $course->price, 0) . ' ريال' }}
                        </div>
                    </div>
                    
                    <a href="{{ route('courses.show', $course->slug) }}" class="btn btn-primary" style="width: 100%;">
                        <i class="bi bi-eye"></i>
                        عرض الدورة
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    @endif

    <!-- Quick Actions -->
    <section class="quick-actions">
        <a href="{{ route('student.courses') }}" class="quick-action-card courses">
            <i class="bi bi-book quick-action-icon"></i>
            <h4 class="quick-action-title">دوراتي</h4>
            <p class="quick-action-description">عرض جميع دوراتي والتقدم</p>
        </a>
        
        <a href="{{ route('student.certificates') }}" class="quick-action-card certificates">
            <i class="bi bi-award quick-action-icon"></i>
            <h4 class="quick-action-title">شهاداتي</h4>
            <p class="quick-action-description">عرض الشهادات المحصل عليها</p>
        </a>
        
        <a href="#" class="quick-action-card payments">
            <i class="bi bi-credit-card quick-action-icon"></i>
            <h4 class="quick-action-title">مدفوعاتي</h4>
            <p class="quick-action-description">عرض سجل المدفوعات</p>
        </a>
        
        <a href="{{ route('student.profile') }}" class="quick-action-card profile">
            <i class="bi bi-person quick-action-icon"></i>
            <h4 class="quick-action-title">ملفي الشخصي</h4>
            <p class="quick-action-description">تعديل معلوماتي الشخصية</p>
        </a>
    </section>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Enhanced entrance animations with staggered timing
    const elements = document.querySelectorAll('.stat-card, .course-card, .quick-action-card, .activity-item');
    elements.forEach((el, index) => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(30px) scale(0.95)';
        
        setTimeout(() => {
            el.style.transition = 'all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94)';
            el.style.opacity = '1';
            el.style.transform = 'translateY(0) scale(1)';
        }, index * 100);
    });

    // Enhanced progress bar animation with easing
    const progressBars = document.querySelectorAll('.progress-fill');
    progressBars.forEach((bar, index) => {
        const targetWidth = bar.style.width;
        bar.style.width = '0%';
        
        setTimeout(() => {
            bar.style.transition = 'width 1.5s cubic-bezier(0.4, 0, 0.2, 1)';
            bar.style.width = targetWidth;
        }, 800 + (index * 200));
    });

    // Enhanced intersection observer with better performance
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.transition = 'all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94)';
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0) scale(1)';
                observer.unobserve(entry.target);
            }
        });
    }, { 
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    });

    // Observe all animated elements
    const animatedElements = document.querySelectorAll('.welcome-header, .live-lessons-section');
    animatedElements.forEach(el => observer.observe(el));

    // Add smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Add loading states for buttons
    document.querySelectorAll('.btn').forEach(btn => {
        btn.addEventListener('click', function() {
            if (!this.classList.contains('loading')) {
                this.classList.add('loading');
                this.style.pointerEvents = 'none';
                
                // Remove loading state after navigation
                setTimeout(() => {
                    this.classList.remove('loading');
                    this.style.pointerEvents = 'auto';
                }, 1000);
            }
        });
    });

    // Add parallax effect to welcome header
    const header = document.querySelector('.welcome-header');
    if (header) {
        let ticking = false;
        
        function updateParallax() {
            const scrolled = window.pageYOffset;
            const rate = scrolled * -0.3;
            header.style.transform = `translateY(${rate}px)`;
            ticking = false;
        }
        
        function requestParallax() {
            if (!ticking) {
                requestAnimationFrame(updateParallax);
                ticking = true;
            }
        }
        
        window.addEventListener('scroll', requestParallax);
    }

    // Add floating animation to statistics cards
    const statCards = document.querySelectorAll('.stat-card');
    statCards.forEach((card, index) => {
        card.style.animationDelay = `${index * 0.3}s`;
        card.classList.add('floating');
    });

    // Enhanced hover effects for cards
    const cards = document.querySelectorAll('.stat-card, .course-card, .quick-action-card');
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-8px) scale(1.03)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });
});

// Add CSS animations dynamically
const style = document.createElement('style');
style.textContent = `
    .floating {
        animation: floating 6s ease-in-out infinite;
    }
    
    @keyframes floating {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
    }
`;
document.head.appendChild(style);
</script>
@endsection 