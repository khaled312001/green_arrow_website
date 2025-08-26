@extends('layouts.app')

@section('title', 'أكاديمية السهم الأخضر للتدريب - مكة المكرمة')
@section('meta_description', 'أكاديمية السهم الأخضر للتدريب بمكة المكرمة - دورات تدريبية متخصصة في البرمجة والإدارة واللغات والتقنية مع أفضل المدربين')

@push('styles')
<style>
    /* CSS Variables */
    :root {
        --primary-color: #10b981;
        --primary-dark: #059669;
        --secondary-color: #fbbf24;
        --secondary-dark: #f59e0b;
        --text-primary: #1f2937;
        --text-secondary: #6b7280;
        --bg-light: #f8fafc;
        --bg-white: #ffffff;
        --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        --transition-normal: 0.3s ease;
        --border-radius: 15px;
    }

    /* Horizontal Slider Styles */
    .categories-slider-container,
    .courses-slider-container {
        position: relative;
        width: 100%;
        max-width: 100%;
        overflow: hidden;
        margin: 30px 0;
    }

    .categories-slider,
    .courses-slider {
        width: 100%;
        overflow: hidden;
        position: relative;
    }

    .categories-track,
    .courses-track {
        display: flex;
        transition: transform 0.5s ease-in-out;
        gap: 20px;
        padding: 10px 0;
    }

    .category-item,
    .course-card {
        flex: 0 0 auto;
        min-width: 320px;
        max-width: 320px;
        margin: 0;
    }

    .slider-nav-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
        color: white;
        border: none;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        z-index: 10;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
        font-size: 1.2rem;
    }

    .slider-nav-btn:hover {
        background: linear-gradient(135deg, var(--primary-dark), #047857);
        transform: translateY(-50%) scale(1.1);
        box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
    }

    .slider-nav-btn.prev-btn {
        left: -25px;
    }

    .slider-nav-btn.next-btn {
        right: -25px;
    }

    .slider-nav-btn:disabled {
        opacity: 0.5;
        cursor: not-allowed;
        transform: translateY(-50%) scale(1);
    }

    .slider-nav-btn:disabled:hover {
        transform: translateY(-50%) scale(1);
        box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .category-item,
        .course-card {
            min-width: 280px;
            max-width: 280px;
        }

        .slider-nav-btn {
            width: 45px;
            height: 45px;
            font-size: 1rem;
        }

        .slider-nav-btn.prev-btn {
            left: -20px;
        }

        .slider-nav-btn.next-btn {
            right: -20px;
        }
    }

    @media (max-width: 480px) {
        .category-item,
        .course-card {
            min-width: 260px;
            max-width: 260px;
        }

        .slider-nav-btn {
            width: 40px;
            height: 40px;
            font-size: 0.9rem;
        }
    }









    /* Main Content Area */
    .main-content-area {
        width: 100%;
        max-width: 100%;
        background: var(--bg-light);
        margin: 0;
        padding: 0;
        overflow-x: hidden;
        margin-top: 0;
    }
    
    /* Mobile specific styles to remove gaps */
    @media (max-width: 768px) {
        .main-content-area {
            margin-top: 0 !important;
            padding-top: 0 !important;
        }
        
        .hero-slider {
            margin-top: 0 !important;
            padding-top: 0 !important;
        }
        
        body {
            margin-top: 0 !important;
            padding-top: 0 !important;
        }
    }

    /* Mobile Header Styles */
    .mobile-header {
        display: none; /* Hidden by default, will show only on mobile */
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(15px);
        -webkit-backdrop-filter: blur(15px);
        color: var(--text-primary);
        padding: 15px 20px;
        position: sticky;
        top: 0;
        z-index: 999;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        border-bottom: 1px solid rgba(16, 185, 129, 0.1);
        transition: all 0.3s ease;
        margin-bottom: 0;
    }

    .mobile-header:hover {
        background: rgba(255, 255, 255, 0.98);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    .mobile-header-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        max-width: 1200px;
        margin: 0 auto;
        gap: 15px;
    }
    
    /* Mobile Contact & Social */
    .mobile-contact-social {
        display: flex;
        align-items: center;
        gap: 15px;
        flex-shrink: 0;
    }
    
    .mobile-contact-info {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .mobile-contact-item {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 35px;
        height: 35px;
        background: rgba(16, 185, 129, 0.1);
        border: 1px solid rgba(16, 185, 129, 0.2);
        border-radius: 50%;
        color: var(--primary-color);
        text-decoration: none;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
    }
    
    .mobile-contact-item:hover {
        background: rgba(16, 185, 129, 0.2);
        border-color: rgba(16, 185, 129, 0.4);
        transform: scale(1.1);
        color: var(--primary-dark);
    }
    
    .mobile-social-links {
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .mobile-social-link {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        color: white;
        text-decoration: none;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
    }
    
    .mobile-social-link:hover {
        background: rgba(255, 255, 255, 0.2);
        border-color: rgba(255, 255, 255, 0.4);
        transform: scale(1.1);
    }
    
    .mobile-social-link.whatsapp:hover {
        background: rgba(37, 211, 102, 0.2);
        border-color: rgba(37, 211, 102, 0.4);
    }
    
    .mobile-social-link.twitter:hover {
        background: rgba(29, 161, 242, 0.2);
        border-color: rgba(29, 161, 242, 0.4);
    }
    
    .mobile-social-link.telegram:hover {
        background: rgba(0, 136, 204, 0.2);
        border-color: rgba(0, 136, 204, 0.4);
    }

    .mobile-logo {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 1.2rem;
        font-weight: 800;
        color: var(--primary-color);
        text-decoration: none;
        transition: all var(--transition-normal);
        letter-spacing: -0.5px;
        position: relative;
        overflow: hidden;
    }

    .mobile-logo:hover {
        color: var(--primary-dark);
        transform: scale(1.05);
    }

    .mobile-logo::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 0;
        height: 2px;
        background: var(--primary-color);
        transition: width 0.3s ease;
    }

    .mobile-logo:hover::after {
        width: 100%;
    }

    .mobile-logo i {
        font-size: 1.5rem;
        color: var(--primary-color);
        filter: drop-shadow(0 2px 4px rgba(16, 185, 129, 0.3));
    }

















    /* Keyframe Animations */
    @keyframes slideInRight {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    @keyframes slideOutRight {
        from {
            transform: translateX(0);
            opacity: 1;
        }
        to {
            transform: translateX(100%);
            opacity: 0;
        }
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes fadeInScale {
        from {
            opacity: 0;
            transform: scale(0.8);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    @keyframes scaleIn {
        from {
            opacity: 0;
            transform: scale(0.8);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    /* Pulse animation for mobile menu button */
    @keyframes pulse {
        0% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.05);
        }
        100% {
            transform: scale(1);
        }
    }



    @media (max-width: 768px) {
        .mobile-header {
            display: block; /* Show mobile header only on mobile */
        }
        
        .sidebar {
            max-width: 280px;
        }

        .sidebar-header {
            padding: 25px 20px;
        }

        .sidebar-nav-item {
            padding: 16px 20px;
            font-size: 1.05rem;
        }

        .sidebar-stats {
            grid-template-columns: 1fr;
            gap: 10px;
        }

        .mobile-header {
            padding: 12px 15px;
        }

        .mobile-logo {
            font-size: 1.1rem;
        }

        .mobile-logo i {
            font-size: 1.3rem;
        }


    }

    @media (max-width: 480px) {
        .sidebar {
            max-width: 100%;
        }

        .sidebar-header {
            padding: 20px 15px;
        }

        .sidebar-nav-item {
            padding: 18px 15px;
            font-size: 1.1rem;
        }

        .sidebar-auth-btn {
            padding: 12px 16px;
            font-size: 0.95rem;
        }

        .sidebar-auth-btn i {
            font-size: 1rem;
        }

        .mobile-header {
            padding: 10px 12px;
        }

        .mobile-logo {
            font-size: 1rem;
        }

        .mobile-logo i {
            font-size: 1.2rem;
        }

        .mobile-logo span {
            display: none; /* Hide text on very small screens */
        }


    }
    </style>
</link>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
<style>
    /* Import Google Fonts */
    @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;800;900&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800;900&display=swap');
    
    /* CSS Variables for consistent theming */
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
        box-sizing: border-box;
    }
    
    html {
        overflow-x: hidden;
        width: 100%;
        max-width: 100%;
    }
    
    body {
        line-height: 1.6;
        color: var(--text-primary);
        overflow-x: hidden;
        width: 100%;
        max-width: 100%;
        margin: 0;
        padding: 0;
    }
    
    /* Hero Slider Section */
    .hero-slider {
        position: relative;
        height: 120vh;
        min-height: 800px;
        overflow: hidden;
    }
    
    .swiper {
        width: 100%;
        height: 100%;
    }
    
    .swiper-slide {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }
    
    .slide-1 {
        background-image: linear-gradient(135deg, rgba(16, 185, 129, 0.4) 0%, rgba(5, 150, 105, 0.4) 100%), 
                          url('https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80');
    }
    
    .slide-2 {
        background-image: linear-gradient(135deg, rgba(139, 92, 246, 0.4) 0%, rgba(124, 58, 237, 0.4) 100%), 
                          url('https://images.unsplash.com/photo-1516321318423-f06f85e504b3?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80');
    }
    
    .slide-3 {
        background-image: linear-gradient(135deg, rgba(251, 191, 36, 0.4) 0%, rgba(245, 158, 11, 0.4) 100%), 
                          url('https://images.unsplash.com/photo-1521737711867-e3b97375f902?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80');
    }
    
    .slide-content {
        text-align: center;
        color: white;
        max-width: 900px;
        padding: 0 20px;
        z-index: 10;
        position: relative;
        transform: translateY(5%);
    }
    
    .slide-title {
        font-size: clamp(3rem, 8vw, 5rem);
        font-weight: 900;
        margin-bottom: 30px;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        line-height: 1.2;
        animation: slideInUp 1s ease-out;
    }
    
    .slide-description {
        font-size: clamp(1.2rem, 3vw, 1.6rem);
        margin-bottom: 40px;
        opacity: 0.95;
        line-height: 1.8;
        font-weight: 400;
        animation: slideInUp 1s ease-out 0.2s both;
    }
    
    .slide-buttons {
        display: flex;
        gap: 25px;
        justify-content: center;
        flex-wrap: wrap;
        animation: slideInUp 1s ease-out 0.4s both;
    }
    
    .slide-btn {
        padding: 18px 40px;
        border-radius: 50px;
        font-size: 1.2rem;
        font-weight: 700;
        text-decoration: none;
        transition: all var(--transition-normal);
        display: inline-flex;
        align-items: center;
        gap: 12px;
        box-shadow: var(--shadow-xl);
        position: relative;
        overflow: hidden;
        white-space: nowrap;
        min-width: 200px;
        justify-content: center;
    }
    
    .slide-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left var(--transition-slow);
    }
    
    .slide-btn:hover::before {
        left: 100%;
    }
    
    .slide-btn-primary {
        background: linear-gradient(45deg, var(--secondary-color), var(--secondary-dark));
        color: var(--text-primary);
    }
    
    .slide-btn-primary:hover {
        background: linear-gradient(45deg, var(--secondary-dark), #d97706);
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.3);
    }
    
    .slide-btn-secondary {
        background: transparent;
        color: white;
        border: 3px solid white;
        backdrop-filter: blur(10px);
    }
    
    .slide-btn-secondary:hover {
        background: white;
        color: var(--primary-color);
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(255, 255, 255, 0.3);
    }
    
    .slide-btn-outline {
        background: rgba(255, 255, 255, 0.1);
        color: white;
        border: 2px solid rgba(255, 255, 255, 0.5);
        backdrop-filter: blur(10px);
    }
    
    .slide-btn-outline:hover {
        background: rgba(255, 255, 255, 0.2);
        border-color: rgba(255, 255, 255, 0.8);
        transform: translateY(-5px);
    }
    
    /* Swiper Navigation */
    .swiper-button-next,
    .swiper-button-prev {
        color: white;
        background: rgba(255,255,255,0.25);
        width: 70px;
        height: 70px;
        border-radius: 50%;
        backdrop-filter: blur(15px);
        transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        border: 2px solid rgba(255, 255, 255, 0.3);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
    }
    
    .swiper-button-next:hover,
    .swiper-button-prev:hover {
        background: rgba(255,255,255,0.4);
        transform: scale(1.15);
        box-shadow: 0 12px 35px rgba(0, 0, 0, 0.3);
        border-color: rgba(255, 255, 255, 0.6);
    }
    
    .swiper-button-next i,
    .swiper-button-prev i {
        font-size: 24px;
        color: white;
        font-weight: bold;
        text-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
    }
    
    .swiper-pagination-bullet {
        background: white;
        opacity: 0.7;
        width: 14px;
        height: 14px;
        transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        border: 2px solid transparent;
    }
    
    .swiper-pagination-bullet-active {
        opacity: 1;
        background: var(--secondary-color);
        transform: scale(1.3);
        box-shadow: 0 0 15px rgba(251, 191, 36, 0.6);
        border-color: rgba(255, 255, 255, 0.5);
    }
    
    .swiper-pagination-bullet:hover {
        background: var(--secondary-color);
        transform: scale(1.2);
        box-shadow: 0 0 10px rgba(251, 191, 36, 0.4);
    }
    
    /* Floating Elements */
    .floating-elements {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        overflow: hidden;
        z-index: 1;
    }
    
    .floating-element {
        position: absolute;
        background: rgba(255,255,255,0.1);
        border-radius: 50%;
        animation: floatElement 6s ease-in-out infinite;
    }
    
    .floating-element:nth-child(1) {
        width: 80px;
        height: 80px;
        top: 20%;
        left: 10%;
        animation-delay: 0s;
    }
    
    .floating-element:nth-child(2) {
        width: 120px;
        height: 120px;
        top: 60%;
        right: 15%;
        animation-delay: 2s;
    }
    
    .floating-element:nth-child(3) {
        width: 60px;
        height: 60px;
        bottom: 30%;
        left: 20%;
        animation-delay: 4s;
    }
    
    @keyframes floatElement {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(180deg); }
    }
    
    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(50px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    /* Enhanced Stats Section */
    .stats {
        background: var(--bg-primary);
        padding: 120px 0 100px;
        margin-top: -100px;
        position: relative;
        z-index: 3;
    }
    
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 40px;
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 20px;
    }
    
    .stat-item {
        text-align: center;
        padding: 50px 30px;
        border-radius: var(--border-radius-xl);
        background: linear-gradient(135deg, var(--bg-secondary) 0%, #e2e8f0 100%);
        transition: all var(--transition-normal);
        position: relative;
        overflow: hidden;
        border: 1px solid var(--border-color);
        box-shadow: var(--shadow-lg);
    }
    
    .stat-item::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(16, 185, 129, 0.1), transparent);
        transition: left var(--transition-slow);
    }
    
    .stat-item:hover::before {
        left: 100%;
    }
    
    .stat-item:hover {
        transform: translateY(-20px);
        box-shadow: var(--shadow-2xl);
        border-color: var(--primary-color);
    }
    
    .stat-icon {
        width: 120px;
        height: 120px;
        margin: 0 auto 30px;
        background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 3rem;
        transition: all var(--transition-normal);
        box-shadow: var(--shadow-lg);
    }
    
    .stat-item:hover .stat-icon {
        transform: scale(1.1) rotate(360deg);
        box-shadow: var(--shadow-xl);
    }
    
    .stat-number {
        font-size: 4rem;
        font-weight: 900;
        color: var(--primary-color);
        margin-bottom: 20px;
        background: linear-gradient(45deg, var(--primary-color), var(--primary-dark));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        line-height: 1;
    }
    
    .stat-label {
        font-size: 1.3rem;
        color: var(--text-secondary);
        font-weight: 600;
    }
    
    /* Modern Categories Section */
    .modern-categories {
        padding: 120px 0;
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 50%, #cbd5e1 100%);
        position: relative;
        overflow: hidden;
    }
    
    .modern-categories::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="rgba(16,185,129,0.1)" stroke-width="0.5"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
        opacity: 0.3;
        z-index: 1;
    }
    
    .section-header {
        text-align: center;
        margin-bottom: 80px;
        position: relative;
        z-index: 2;
        padding: 0 20px;
    }
    
    .section-title-wrapper {
        margin-bottom: 30px;
    }
    
    .section-title {
        font-size: 3.5rem;
        font-weight: 900;
        color: var(--text-primary);
        margin-bottom: 25px;
        background: linear-gradient(45deg, var(--text-primary), var(--primary-color));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        line-height: 1.2;
        position: relative;
    }
    
    .section-subtitle {
        font-size: 1.4rem;
        color: var(--text-secondary);
        max-width: 800px;
        margin: 0 auto;
        line-height: 1.8;
        font-weight: 400;
    }
    
    .section-decoration {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 20px;
        margin-top: 30px;
    }
    
    .decoration-line {
        width: 60px;
        height: 3px;
        background: linear-gradient(90deg, transparent, var(--primary-color), transparent);
        border-radius: 2px;
    }
    
    .decoration-dot {
        width: 12px;
        height: 12px;
        background: var(--primary-color);
        border-radius: 50%;
        box-shadow: 0 0 20px rgba(16, 185, 129, 0.5);
    }
    
    .categories-showcase {
        position: relative;
        z-index: 2;
        padding: 0 20px;
    }
    
    .categories-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(380px, 1fr));
        gap: 30px;
        max-width: 1400px;
        margin: 0 auto;
    }
    
    .category-item {
        position: relative;
        border-radius: 20px;
        overflow: hidden;
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        transform: translateY(0);
        opacity: 0;
        animation: fadeInUp 0.8s ease forwards;
    }
    
    .category-item:nth-child(1) { animation-delay: 0.1s; }
    .category-item:nth-child(2) { animation-delay: 0.2s; }
    .category-item:nth-child(3) { animation-delay: 0.3s; }
    .category-item:nth-child(4) { animation-delay: 0.4s; }
    .category-item:nth-child(5) { animation-delay: 0.5s; }
    .category-item:nth-child(6) { animation-delay: 0.6s; }
    .category-item:nth-child(7) { animation-delay: 0.7s; }
    .category-item:nth-child(8) { animation-delay: 0.8s; }
    
    .category-item:hover {
        transform: translateY(-15px) scale(1.02);
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
        border-color: var(--primary-color);
    }
    
    .category-content {
        padding: 40px 30px;
        position: relative;
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    
    .category-icon-wrapper {
        position: relative;
        width: 80px;
        height: 80px;
        margin-bottom: 25px;
    }
    
    .category-icon {
        width: 100%;
        height: 100%;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        color: white;
        background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
        position: relative;
        z-index: 2;
        transition: all 0.3s ease;
    }
    
    .icon-glow {
        position: absolute;
        top: -10px;
        left: -10px;
        right: -10px;
        bottom: -10px;
        background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
        border-radius: 25px;
        opacity: 0.3;
        z-index: 1;
        transition: all 0.3s ease;
        filter: blur(10px);
    }
    
    .category-item:hover .icon-glow {
        opacity: 0.6;
        filter: blur(15px);
    }
    
    .category-info {
        flex: 1;
    }
    
    .category-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 15px;
        line-height: 1.3;
    }
    
    .category-description {
        color: var(--text-secondary);
        line-height: 1.6;
        margin-bottom: 20px;
        font-size: 0.95rem;
    }
    
    .category-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 20px;
    }
    
    .tag {
        background: rgba(16, 185, 129, 0.1);
        color: var(--primary-color);
        padding: 4px 12px;
        border-radius: 15px;
        font-size: 0.8rem;
        font-weight: 500;
        border: 1px solid rgba(16, 185, 129, 0.2);
        transition: all 0.3s ease;
    }
    
    .tag:hover {
        background: var(--primary-color);
        color: white;
        transform: translateY(-2px);
    }
    
    .category-stats {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        font-size: 0.9rem;
    }
    
    .courses-count {
        color: var(--primary-color);
        font-weight: 600;
    }
    
    .students-count {
        color: var(--text-secondary);
        font-weight: 500;
    }
    
    .category-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(16, 185, 129, 0.95), rgba(5, 150, 105, 0.95));
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: all 0.4s ease;
        border-radius: 20px;
    }
    
    .category-item:hover .category-overlay {
        opacity: 1;
    }
    
    .explore-btn {
        display: flex;
        align-items: center;
        gap: 10px;
        color: white;
        text-decoration: none;
        font-weight: 600;
        font-size: 1.1rem;
        padding: 15px 25px;
        border: 2px solid white;
        border-radius: 25px;
        transition: all 0.3s ease;
        transform: translateY(20px);
        opacity: 0;
    }
    
    .category-item:hover .explore-btn {
        transform: translateY(0);
        opacity: 1;
    }
    
    .explore-btn:hover {
        background: white;
        color: var(--primary-color);
        transform: translateY(-5px);
    }
    
    .categories-cta {
        text-align: center;
        margin-top: 60px;
        position: relative;
        z-index: 2;
    }
    
    .cta-button {
        display: inline-flex;
        align-items: center;
        gap: 15px;
        background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
        color: white;
        text-decoration: none;
        padding: 18px 35px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        box-shadow: 0 10px 30px rgba(16, 185, 129, 0.3);
        border: none;
        position: relative;
        overflow: hidden;
    }
    
    .cta-button::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s ease;
    }
    
    .cta-button:hover::before {
        left: 100%;
    }
    
    .cta-button:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 40px rgba(16, 185, 129, 0.4);
    }
    
    /* Animations */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes float {
        0%, 100% {
            transform: translateY(0px);
        }
        50% {
            transform: translateY(-10px);
        }
    }
    
    @keyframes pulse {
        0%, 100% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.05);
        }
    }
    
    /* Continuous Loop Animation for Categories */
    .categories-grid {
        display: flex;
        gap: 30px;
        animation: continuousScroll 60s linear infinite;
        width: max-content;
    }
    
    .categories-grid:hover {
        animation-play-state: paused;
    }
    
    @keyframes continuousScroll {
        0% {
            transform: translateX(0);
        }
        100% {
            transform: translateX(-50%);
        }
    }
    
    /* Create duplicate items for seamless loop */
    .categories-showcase {
        overflow: hidden;
        position: relative;
    }
    
    .categories-showcase::before,
    .categories-showcase::after {
        content: '';
        position: absolute;
        top: 0;
        width: 100px;
        height: 100%;
        z-index: 2;
        pointer-events: none;
    }
    
    .categories-showcase::before {
        left: 0;
        background: linear-gradient(90deg, rgba(248, 250, 252, 1) 0%, rgba(248, 250, 252, 0) 100%);
    }
    
    .categories-showcase::after {
        right: 0;
        background: linear-gradient(90deg, rgba(248, 250, 252, 0) 0%, rgba(248, 250, 252, 1) 100%);
    }
    
    /* Responsive Design */
    @media (max-width: 1200px) {
        .categories-grid {
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 25px;
        }
    }
    
    @media (max-width: 768px) {
        .modern-categories {
            padding: 80px 0;
        }
        
        .section-title {
            font-size: 2.5rem;
        }
        
        .section-subtitle {
            font-size: 1.1rem;
        }
        
        .categories-grid {
            grid-template-columns: 1fr;
            gap: 20px;
        }
        
        .category-content {
            padding: 30px 20px;
        }
        
        .category-icon-wrapper {
            width: 60px;
            height: 60px;
        }
        
        .category-icon {
            font-size: 1.5rem;
        }
        
        .category-title {
            font-size: 1.3rem;
        }
        
        .cta-button {
            padding: 15px 25px;
            font-size: 1rem;
        }
    }
    
    @media (max-width: 480px) {
        .section-title {
            font-size: 2rem;
        }
        
        .category-content {
            padding: 25px 15px;
        }
        
        .category-tags {
            gap: 6px;
        }
        
        .tag {
            font-size: 0.75rem;
            padding: 3px 10px;
        }

    
    /* Enhanced Featured Courses */
    .featured-courses {
        padding: 120px 0;
        background: var(--bg-primary);
        position: relative;
    }
    
    .courses-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
        gap: 40px;
        padding: 0 20px;
        max-width: 1400px;
        margin: 0 auto;
    }
    
    .course-card {
        background: var(--bg-primary);
        border-radius: var(--border-radius-xl);
        overflow: hidden;
        box-shadow: var(--shadow-lg);
        transition: all var(--transition-normal);
        border: 1px solid var(--border-color);
        position: relative;
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    
    .course-card:hover {
        transform: translateY(-20px);
        box-shadow: var(--shadow-2xl);
        border-color: var(--primary-color);
    }
    
    .course-image {
        height: 280px;
        background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
        position: relative;
        overflow: hidden;
    }
    
    .course-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform var(--transition-normal);
    }
    
    .course-card:hover .course-image img {
        transform: scale(1.1);
    }
    
    .course-price {
        position: absolute;
        top: 25px;
        left: 25px;
        background: linear-gradient(45deg, var(--secondary-color), var(--secondary-dark));
        color: var(--text-primary);
        padding: 12px 25px;
        border-radius: 30px;
        font-weight: 800;
        font-size: 1.2rem;
        box-shadow: var(--shadow-lg);
        z-index: 2;
    }
    
    .course-content {
        padding: 40px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }
    
    .course-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        font-size: 1.1rem;
        color: var(--text-secondary);
        flex-wrap: wrap;
        gap: 15px;
    }
    
    .course-title {
        font-size: 1.8rem;
        font-weight: 800;
        color: var(--text-primary);
        margin-bottom: 25px;
        line-height: 1.4;
        flex-grow: 1;
    }
    
    .course-description {
        color: var(--text-secondary);
        line-height: 1.7;
        margin-bottom: 30px;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        font-size: 1.1rem;
        flex-grow: 1;
    }
    
    .course-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 25px;
        border-top: 2px solid var(--bg-secondary);
        margin-top: auto;
        flex-wrap: wrap;
        gap: 20px;
    }
    
    .course-instructor {
        display: flex;
        align-items: center;
        gap: 15px;
    }
    
    .instructor-avatar {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 1.5rem;
        box-shadow: var(--shadow-md);
    }
    
    .course-btn {
        background: linear-gradient(45deg, var(--primary-color), var(--primary-dark));
        color: white;
        padding: 15px 30px;
        border-radius: 30px;
        text-decoration: none;
        font-weight: 700;
        transition: all var(--transition-normal);
        font-size: 1.1rem;
        white-space: nowrap;
        box-shadow: var(--shadow-md);
    }
    
    .course-btn:hover {
        background: linear-gradient(45deg, var(--primary-dark), #047857);
        transform: translateY(-3px);
        box-shadow: var(--shadow-lg);
    }
    
    /* Enhanced Testimonials */
    .testimonials {
        padding: 120px 0;
        background: linear-gradient(135deg, var(--bg-dark) 0%, #374151 100%);
        color: white;
        position: relative;
    }
    
    .testimonials-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 40px;
        position: relative;
        z-index: 2;
        padding: 0 20px;
        max-width: 1400px;
        margin: 0 auto;
    }
    
    .testimonial-card {
        background: rgba(255,255,255,0.1);
        backdrop-filter: blur(10px);
        border-radius: var(--border-radius-xl);
        padding: 50px 40px;
        text-align: center;
        border: 1px solid rgba(255,255,255,0.2);
        transition: all var(--transition-normal);
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    
    .testimonial-card:hover {
        transform: translateY(-15px);
        background: rgba(255,255,255,0.15);
        box-shadow: var(--shadow-xl);
    }
    
    .testimonial-avatar {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        margin: 0 auto 25px;
        background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        color: white;
        font-weight: 700;
        box-shadow: var(--shadow-lg);
    }
    
    .testimonial-text {
        font-size: 1.2rem;
        line-height: 1.8;
        margin-bottom: 25px;
        font-style: italic;
        flex-grow: 1;
    }
    
    .testimonial-author {
        font-weight: 700;
        font-size: 1.3rem;
        margin-bottom: 8px;
    }
    
    .testimonial-position {
        color: #9ca3af;
        font-size: 1.1rem;
    }
    
    /* Enhanced CTA Section */
    .cta-section {
        padding: 120px 0;
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
        color: white;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    
    .cta-content {
        position: relative;
        z-index: 2;
        max-width: 900px;
        margin: 0 auto;
        padding: 0 20px;
    }
    
    .cta-title {
        font-size: 4rem;
        font-weight: 900;
        margin-bottom: 30px;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        line-height: 1.2;
    }
    
    .cta-description {
        font-size: 1.4rem;
        margin-bottom: 50px;
        line-height: 1.8;
        opacity: 0.95;
    }
    
    .cta-buttons {
        display: flex;
        gap: 30px;
        justify-content: center;
        flex-wrap: wrap;
    }
    
    .cta-btn {
        padding: 20px 40px;
        border-radius: 50px;
        font-size: 1.2rem;
        font-weight: 700;
        text-decoration: none;
        transition: all var(--transition-normal);
        display: inline-flex;
        align-items: center;
        gap: 15px;
        white-space: nowrap;
        min-width: 200px;
        justify-content: center;
    }
    
    .cta-btn-primary {
        background: var(--secondary-color);
        color: var(--text-primary);
        box-shadow: var(--shadow-xl);
    }
    
    .cta-btn-primary:hover {
        background: var(--secondary-dark);
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.3);
    }
    
    .cta-btn-secondary {
        background: transparent;
        color: white;
        border: 3px solid white;
    }
    
    .cta-btn-secondary:hover {
        background: white;
        color: var(--primary-color);
        transform: translateY(-5px);
    }
    
    /* Enhanced WhatsApp Float Button */
    .whatsapp-float {
        position: fixed;
        bottom: 40px;
        right: 40px;
        z-index: 1000;
        animation: float 3s ease-in-out infinite;
    }
    
    .whatsapp-float a {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #25d366, #128c7e);
        color: white;
        border-radius: 50%;
        text-decoration: none;
        box-shadow: 0 8px 25px rgba(37, 211, 102, 0.3);
        transition: all var(--transition-normal);
        font-size: 32px;
        position: relative;
        overflow: hidden;
        border: 3px solid rgba(255, 255, 255, 0.2);
    }
    
    .whatsapp-float a::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
        transition: left var(--transition-slow);
    }
    
    .whatsapp-float a:hover::before {
        left: 100%;
    }
    
    .whatsapp-float a:hover {
        transform: scale(1.15) rotate(5deg);
        box-shadow: 0 12px 35px rgba(37, 211, 102, 0.5);
        border-color: rgba(255, 255, 255, 0.4);
    }
    
    /* WhatsApp Tooltip */
    .whatsapp-float::after {
        content: 'تواصل معنا عبر واتساب';
        position: absolute;
        right: 100px;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(0, 0, 0, 0.8);
        color: white;
        padding: 10px 15px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        white-space: nowrap;
        opacity: 0;
        visibility: hidden;
        transition: all var(--transition-normal);
        z-index: 1001;
    }
    
    .whatsapp-float::before {
        content: '';
        position: absolute;
        right: 90px;
        top: 50%;
        transform: translateY(-50%);
        border: 8px solid transparent;
        border-left-color: rgba(0, 0, 0, 0.8);
        opacity: 0;
        visibility: hidden;
        transition: all var(--transition-normal);
        z-index: 1001;
    }
    
    .whatsapp-float:hover::after,
    .whatsapp-float:hover::before {
        opacity: 1;
        visibility: visible;
    }
    
    /* Pulse Animation */
    .whatsapp-float::after {
        animation: pulse 2s infinite;
    }
    
    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-10px) rotate(2deg); }
    }
    
    @keyframes pulse {
        0% {
            box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
        }
        70% {
            box-shadow: 0 0 0 10px rgba(16, 185, 129, 0);
        }
        100% {
            box-shadow: 0 0 0 0 rgba(16, 185, 129, 0);
        }
    }
    
    /* Responsive Design */
    @media (max-width: 1200px) {
        .categories-grid,
        .courses-grid,
        .testimonials-grid {
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        }
    }
    
    @media (max-width: 768px) {
        .hero-slider {
            height: 80vh;
            min-height: 500px;
        }
        
        .slide-buttons {
            flex-direction: column;
            align-items: center;
            gap: 20px;
        }
        
        .stats {
            margin-top: -60px;
            padding: 100px 0 80px;
        }
        
        .stats-grid {
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
        }
        
        .categories-grid,
        .courses-grid,
        .testimonials-grid {
            grid-template-columns: 1fr;
            gap: 30px;
        }
        
        .section-title h2 {
            font-size: 2.5rem;
        }
        
        .section-title p {
            font-size: 1.2rem;
        }
        
        .cta-title {
            font-size: 2.5rem;
        }
        
        .cta-description {
            font-size: 1.2rem;
        }
        

    }
    
    @media (max-width: 480px) {
        .slide-title {
            font-size: 2.5rem;
        }
        
        .slide-description {
            font-size: 1.1rem;
        }
        
        .section-title h2 {
            font-size: 2rem;
        }
        
        .section-title p {
            font-size: 1.1rem;
        }
        
        .stat-number {
            font-size: 3rem;
        }
        
        .category-card,
        .course-card,
        .testimonial-card {
            padding: 40px 25px;
        }
        
        .slide-buttons,
        .cta-buttons {
            gap: 15px;
        }
        
        .slide-btn,
        .cta-btn {
            padding: 15px 30px;
            font-size: 1.1rem;
            min-width: 180px;
        }
        

    }
    
    /* Animation Classes */
    .fade-in {
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.8s ease;
    }
    
    .fade-in.visible {
        opacity: 1;
        transform: translateY(0);
    }
    
    .slide-in-left {
        opacity: 0;
        transform: translateX(-50px);
        transition: all 0.8s ease;
    }
    
    .slide-in-left.visible {
        opacity: 1;
        transform: translateX(0);
    }
    
    .slide-in-right {
        opacity: 0;
        transform: translateX(50px);
        transition: all 0.8s ease;
    }
    
    .slide-in-right.visible {
        opacity: 1;
        transform: translateX(0);
    }
    
    .scale-in {
        opacity: 0;
        transform: scale(0.8);
        transition: all 0.8s ease;
    }
    
    .scale-in.visible {
        opacity: 1;
        transform: scale(1);
    }
</style>

@endpush

@push('scripts')

@endpush

@push('styles')
<style>
    /* Import Google Fonts */
    @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;800;900&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800;900&display=swap');
    
    /* CSS Variables for consistent theming */
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
        box-sizing: border-box;
    }
    
    html {
        overflow-x: hidden;
        width: 100%;
        max-width: 100%;
    }
    
    body {
        line-height: 1.6;
        color: var(--text-primary);
        overflow-x: hidden;
        width: 100%;
        max-width: 100%;
        margin: 0;
        padding: 0;
    }
    
    /* Custom Scrollbar */
    ::-webkit-scrollbar {
        width: 8px;
    }
    
    ::-webkit-scrollbar-track {
        background: var(--bg-secondary);
    }
    
    ::-webkit-scrollbar-thumb {
        background: var(--primary-color);
        border-radius: 4px;
    }
    
    ::-webkit-scrollbar-thumb:hover {
        background: var(--primary-dark);
    }
    
    /* Selection Styles */
    ::selection {
        background: var(--primary-color);
        color: white;
    }
    


    /* WhatsApp Float Button */
    .whatsapp-float {
        position: fixed !important;
        bottom: 30px !important;
        right: 30px !important;
        z-index: 9999 !important;
        animation: float 3s ease-in-out infinite;
        display: block !important;
        visibility: visible !important;
        opacity: 1 !important;
        pointer-events: auto !important;
    }
    
    .whatsapp-float a {
        display: flex !important;
        align-items: center;
        justify-content: center;
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #25d366, #128c7e);
        color: white !important;
        border-radius: 50%;
        text-decoration: none;
        box-shadow: 0 4px 20px rgba(37, 211, 102, 0.3);
        transition: all 0.3s ease;
        font-size: 24px;
        position: relative;
        overflow: hidden;
        cursor: pointer !important;
        pointer-events: auto !important;
    }
    
    .whatsapp-float a::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
        transition: left 0.5s ease;
    }
    
    .whatsapp-float a:hover::before {
        left: 100%;
    }
    
    .whatsapp-float a:hover {
        transform: scale(1.1) rotate(5deg);
        box-shadow: 0 8px 30px rgba(37, 211, 102, 0.4);
    }
    
    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-10px) rotate(2deg); }
    }
    
    /* Hero Section - Removed duplicate section */
    
    /* Stats Section */
    .stats {
        background: var(--bg-primary);
        padding: clamp(60px, 10vw, 100px) 0;
        margin-top: -80px;
        position: relative;
        z-index: 3;
        width: 100%;
        max-width: 100%;
        margin-left: 0;
        margin-right: 0;
        overflow-x: hidden;
    }
    
    .stats .container {
        max-width: 100%;
        width: 100%;
        margin: 0;
        padding: 0 40px;
        overflow-x: hidden;
    }
    
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: clamp(20px, 4vw, 40px);
        max-width: none;
        width: 100%;
        margin: 0;
        padding: 0;
    }
    
    .stat-item {
        text-align: center;
        padding: clamp(30px, 5vw, 40px) clamp(20px, 3vw, 30px);
        border-radius: var(--border-radius-xl);
        background: linear-gradient(135deg, var(--bg-secondary) 0%, #e2e8f0 100%);
        transition: all var(--transition-normal);
        position: relative;
        overflow: hidden;
        border: 1px solid var(--border-color);
    }
    
    .stat-item::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(16, 185, 129, 0.1), transparent);
        transition: left var(--transition-slow);
    }
    
    .stat-item:hover::before {
        left: 100%;
    }
    
    .stat-item:hover {
        transform: translateY(-15px);
        box-shadow: var(--shadow-2xl);
        border-color: var(--primary-color);
    }
    
    .stat-icon {
        width: clamp(80px, 12vw, 100px);
        height: clamp(80px, 12vw, 100px);
        margin: 0 auto 25px;
        background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: clamp(2rem, 4vw, 2.5rem);
        transition: all var(--transition-normal);
        box-shadow: var(--shadow-lg);
    }
    
    .stat-item:hover .stat-icon {
        transform: scale(1.1) rotate(360deg);
        box-shadow: var(--shadow-xl);
    }
    
    .stat-number {
        font-size: clamp(2.5rem, 6vw, 3.5rem);
        font-weight: 900;
        color: var(--primary-color);
        margin-bottom: 15px;
        background: linear-gradient(45deg, var(--primary-color), var(--primary-dark));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        line-height: 1;
    }
    
    .stat-label {
        font-size: clamp(1rem, 2.5vw, 1.2rem);
        color: var(--text-secondary);
        font-weight: 600;
    }
    
    /* Categories Section */
    .categories {
        padding: clamp(80px, 12vw, 120px) 0;
        background: linear-gradient(135deg, var(--bg-secondary) 0%, #e2e8f0 100%);
        position: relative;
        width: 100%;
        max-width: 100%;
        margin: 0;
        overflow-x: hidden;
    }
    
    .categories .container {
        max-width: 100%;
        width: 100%;
        margin: 0;
        padding: 0 40px;
        overflow-x: hidden;
    }
    
    .categories::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('https://images.unsplash.com/photo-1516321318423-f06f85e504b3?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80') center/cover;
        opacity: 0.05;
    }
    
    .section-title {
        text-align: center;
        margin-bottom: clamp(50px, 8vw, 80px);
        position: relative;
        z-index: 2;
        padding: 0;
        width: 100%;
    }
    
    .section-title h2 {
        font-size: clamp(2rem, 5vw, 3rem);
        font-weight: 800;
        color: var(--text-primary);
        margin-bottom: 20px;
        background: linear-gradient(45deg, var(--text-primary), var(--primary-color));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        line-height: 1.2;
    }
    
    .section-title p {
        font-size: clamp(1.1rem, 2.5vw, 1.3rem);
        color: var(--text-secondary);
        max-width: none;
        width: 100%;
        margin: 0;
        line-height: 1.8;
        font-weight: 400;
    }
    
    /* Categories Carousel */
    .categories-carousel-container {
        position: relative;
        margin-top: 50px;
        overflow: hidden;
        padding: 0 60px;
        z-index: 2;
        width: 100%;
        max-width: 100%;
        background: linear-gradient(90deg, 
            rgba(16, 185, 129, 0.05) 0%, 
            transparent 20%, 
            transparent 80%, 
            rgba(16, 185, 129, 0.05) 100%);
        border-radius: 20px;
        padding: 30px 60px;
        box-shadow: inset 0 0 20px rgba(16, 185, 129, 0.1);
        border: 1px solid rgba(16, 185, 129, 0.1);
    }
    
    .categories-carousel {
        display: flex;
        gap: 30px;
        transition: transform 1s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        padding: 20px 0;
        width: max-content;
        min-width: 100%;
        max-width: 100%;
        position: relative;
        overflow-x: hidden;
    }
    
    .categories-carousel::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, 
            transparent 0%, 
            rgba(255, 255, 255, 0.1) 50%, 
            transparent 100%);
        animation: shimmer 3s ease-in-out infinite;
        pointer-events: none;
        z-index: 1;
    }
    
    @keyframes shimmer {
        0% { transform: translateX(-100%); }
        100% { transform: translateX(200%); }
    }
    
    @keyframes spin {
        0% { transform: translate(-50%, -50%) rotate(0deg); }
        100% { transform: translate(-50%, -50%) rotate(360deg); }
    }
    
    @keyframes bounce {
        0%, 20%, 50%, 80%, 100% {
            transform: translateY(0);
        }
        40% {
            transform: translateY(-5px);
        }
        60% {
            transform: translateY(-3px);
        }
    }
    
    .categories-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: clamp(25px, 4vw, 40px);
        position: relative;
        z-index: 2;
        padding: 0;
        max-width: 100%;
        width: 100%;
        margin: 0;
        overflow-x: hidden;
    }
    
    .category-card {
        min-width: 280px;
        max-width: 400px;
        flex-shrink: 0;
        flex-grow: 0;
        background: var(--bg-primary);
        border-radius: var(--border-radius-xl);
        padding: clamp(40px, 6vw, 50px) clamp(30px, 4vw, 40px);
        text-align: center;
        box-shadow: var(--shadow-lg);
        transition: all 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        border: 2px solid transparent;
        position: relative;
        overflow: hidden;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        backdrop-filter: blur(10px);
        animation: fadeInScale 0.8s ease-out both;
    }
    
    /* Staggered animation for cards */
    .category-card:nth-child(1) { animation-delay: 0.1s; }
    .category-card:nth-child(2) { animation-delay: 0.2s; }
    .category-card:nth-child(3) { animation-delay: 0.3s; }
    .category-card:nth-child(4) { animation-delay: 0.4s; }
    .category-card:nth-child(5) { animation-delay: 0.5s; }
    .category-card:nth-child(6) { animation-delay: 0.6s; }
    .category-card:nth-child(7) { animation-delay: 0.7s; }
    .category-card:nth-child(8) { animation-delay: 0.8s; }
    
    .category-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 5px;
        background: linear-gradient(90deg, var(--primary-color), var(--primary-dark));
        transform: scaleX(0);
        transition: transform var(--transition-normal);
    }
    
    .category-card:hover::before {
        transform: scaleX(1);
    }
    
    .category-card:hover {
        transform: translateY(-15px) scale(1.02);
        box-shadow: var(--shadow-2xl);
        border-color: var(--primary-color);
        background: linear-gradient(135deg, var(--bg-primary) 0%, rgba(16, 185, 129, 0.05) 100%);
    }
    
    .category-card::after {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
        transition: left 0.8s ease;
        pointer-events: none;
    }
    
    .category-card:hover::after {
        left: 100%;
    }
    
    .category-icon {
        width: clamp(100px, 15vw, 120px);
        height: clamp(100px, 15vw, 120px);
        margin: 0 auto 30px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: clamp(2.5rem, 5vw, 3rem);
        color: white;
        background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
        transition: all 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        position: relative;
        box-shadow: var(--shadow-lg);
        animation: fadeInScale 0.8s ease-out both;
    }
    
    .category-card:hover .category-icon {
        transform: scale(1.1) rotate(360deg);
        box-shadow: var(--shadow-xl);
    }
    
    .category-card:hover .category-icon {
        transform: scale(1.1) rotate(360deg);
        box-shadow: var(--shadow-xl);
        animation: pulse 2s infinite;
    }
    
    .category-card h3 {
        font-size: clamp(1.4rem, 3vw, 1.8rem);
        font-weight: 800;
        color: var(--text-primary);
        margin-bottom: 20px;
        line-height: 1.3;
        animation: fadeInUp 0.8s ease-out both;
        animation-delay: 0.3s;
    }
    
    .category-card p {
        color: var(--text-secondary);
        line-height: 1.7;
        margin-bottom: 20px;
        font-size: clamp(1rem, 2vw, 1.1rem);
        flex-grow: 1;
        animation: fadeInUp 0.8s ease-out both;
        animation-delay: 0.4s;
    }
    
    .category-features {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 20px;
        justify-content: center;
        animation: fadeInUp 0.8s ease-out both;
        animation-delay: 0.5s;
    }
    
    .feature-tag {
        background: var(--bg-secondary);
        color: var(--text-secondary);
        padding: 6px 12px;
        border-radius: 20px;
        font-size: clamp(0.8rem, 1.5vw, 0.9rem);
        font-weight: 600;
        border: 1px solid var(--border-color);
        transition: all 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        animation: fadeInScale 0.8s ease-out both;
        animation-delay: 0.5s;
    }
    
    .category-card:hover .feature-tag {
        background: var(--primary-color);
        color: white;
        border-color: var(--primary-color);
        transform: translateY(-2px);
        animation: bounce 0.6s ease;
    }
    
    .category-count {
        background: linear-gradient(45deg, var(--primary-color), var(--primary-dark));
        color: white;
        padding: clamp(10px, 2vw, 12px) clamp(20px, 3vw, 25px);
        border-radius: 30px;
        font-weight: 700;
        display: inline-block;
        font-size: clamp(1rem, 2vw, 1.1rem);
        transition: all 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        box-shadow: var(--shadow-md);
        margin-bottom: 15px;
        animation: fadeInUp 0.8s ease-out both;
        animation-delay: 0.6s;
    }
    
    .category-card:hover .category-count {
        transform: scale(1.05);
        box-shadow: var(--shadow-lg);
    }
    
    /* Carousel Navigation */
    .carousel-arrow {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 55px;
        height: 55px;
        border: none;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
        color: white;
        font-size: 1.3rem;
        cursor: pointer;
        transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        box-shadow: var(--shadow-xl);
        z-index: 10;
        display: flex;
        align-items: center;
        justify-content: center;
        backdrop-filter: blur(10px);
        border: 2px solid rgba(255, 255, 255, 0.2);
    }
    
    .carousel-arrow::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        border-radius: 50%;
        background: linear-gradient(135deg, rgba(255,255,255,0.2), rgba(255,255,255,0.1));
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .carousel-arrow:hover::before {
        opacity: 1;
    }
    
    .carousel-arrow::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        background: rgba(255, 255, 255, 0.3);
        border-radius: 50%;
        transform: translate(-50%, -50%);
        transition: all 0.3s ease;
    }
    
    .carousel-arrow:hover::after {
        width: 100%;
        height: 100%;
    }
    
    .carousel-arrow:hover,
    .carousel-arrow:focus {
        transform: translateY(-50%) scale(1.1);
        box-shadow: 0 8px 25px rgba(16, 185, 129, 0.4);
        outline: 3px solid var(--primary-color);
        outline-offset: 2px;
    }
    
    .carousel-prev {
        right: 0;
        animation: slideInRight 0.6s ease-out;
    }
    
    .carousel-next {
        left: 0;
        animation: slideInLeft 0.6s ease-out;
    }
    
    @keyframes slideInRight {
        from {
            transform: translateY(-50%) translateX(20px);
            opacity: 0;
        }
        to {
            transform: translateY(-50%) translateX(0);
            opacity: 1;
        }
    }
    
    @keyframes slideInLeft {
        from {
            transform: translateY(-50%) translateX(-20px);
            opacity: 0;
        }
        to {
            transform: translateY(-50%) translateX(0);
            opacity: 1;
        }
    }
    
    /* Carousel Dots */
    .carousel-dots {
        display: flex;
        justify-content: center;
        gap: 12px;
        margin-top: 35px;
        padding: 15px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 25px;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        max-width: fit-content;
        margin-left: auto;
        margin-right: auto;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        position: relative;
        animation: fadeInUp 0.8s ease-out 0.5s both;
    }
    
    .carousel-dots::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(16, 185, 129, 0.1), rgba(16, 185, 129, 0.05));
        border-radius: 25px;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .carousel-dots:hover::before {
        opacity: 1;
    }
    
    .carousel-dot {
        width: 14px;
        height: 14px;
        border-radius: 50%;
        background: rgba(16, 185, 129, 0.3);
        cursor: pointer;
        transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        border: 2px solid transparent;
        position: relative;
        overflow: hidden;
        z-index: 1;
    }
    
    .carousel-dot::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.6s ease;
        z-index: 2;
    }
    
    .carousel-dot:hover::before {
        left: 100%;
    }
    
    .carousel-dot::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        transform: translate(-50%, -50%);
        transition: all 0.3s ease;
        z-index: 3;
    }
    
    .carousel-dot:hover::after {
        width: 100%;
        height: 100%;
    }
    
    .carousel-dot.active {
        background: var(--primary-color);
        transform: scale(1.3);
        box-shadow: 0 0 15px rgba(16, 185, 129, 0.6);
        border-color: rgba(255, 255, 255, 0.5);
        animation: pulse 2s infinite;
    }
    
    .carousel-dot:hover,
    .carousel-dot:focus {
        background: var(--primary-color);
        transform: scale(1.2);
        box-shadow: 0 0 10px rgba(16, 185, 129, 0.4);
        outline: 2px solid var(--primary-color);
        outline-offset: 2px;
        animation: bounce 0.6s ease;
    }
    
    /* Responsive Carousel */
    @media (max-width: 1024px) {
        .category-card {
            min-width: 260px;
        }
    }
    
    @media (max-width: 768px) {
        .categories-carousel-container {
            padding: 0 50px;
            background: linear-gradient(90deg, 
                rgba(16, 185, 129, 0.08) 0%, 
                transparent 20%, 
                transparent 80%, 
                rgba(16, 185, 129, 0.08) 100%);
        }
        
        .category-card {
            min-width: 240px;
        }
        
        .carousel-arrow {
            width: 45px;
            height: 45px;
            font-size: 1.1rem;
        }
        
        .carousel-dots {
            padding: 10px;
            gap: 8px;
        }
        
        .carousel-dot {
            width: 12px;
            height: 12px;
        }
    }
    
    @media (max-width: 480px) {
        .categories-carousel-container {
            padding: 0 40px;
            background: linear-gradient(90deg, 
                rgba(16, 185, 129, 0.1) 0%, 
                transparent 15%, 
                transparent 85%, 
                rgba(16, 185, 129, 0.1) 100%);
        }
        
        .category-card {
            min-width: 220px;
            padding: 30px 20px;
        }
        
        .carousel-arrow {
            width: 40px;
            height: 40px;
            font-size: 1rem;
        }
        
        .carousel-dots {
            padding: 8px;
            gap: 6px;
        }
        
        .carousel-dot {
            width: 10px;
            height: 10px;
        }
        
        .categories-carousel-container {
            background: linear-gradient(90deg, 
                rgba(16, 185, 129, 0.08) 0%, 
                transparent 15%, 
                transparent 85%, 
                rgba(16, 185, 129, 0.08) 100%);
        }
        
        .section-title h2 {
            font-size: 1.6rem;
            margin-bottom: 10px;
        }
        
        .section-title p {
            font-size: 0.9rem;
        }
        
        .categories-carousel {
            padding: 15px 0;
        }
        
        .category-card {
            min-width: 180px;
            padding: 20px 12px;
        }
        
        .category-icon {
            width: 60px;
            height: 60px;
            font-size: 1.5rem;
            margin-bottom: 15px;
        }
        
        .category-card h3 {
            font-size: 1rem;
            margin-bottom: 10px;
        }
        
        .category-card p {
            font-size: 0.8rem;
            margin-bottom: 10px;
        }
        
        .feature-tag {
            font-size: 0.7rem;
            padding: 3px 6px;
        }
        
        .category-count {
            font-size: 0.8rem;
            padding: 6px 12px;
        }
        
        .category-link {
            font-size: 0.8rem;
            padding: 6px 12px;
        }
        
        .carousel-arrow {
            width: 35px;
            height: 35px;
            font-size: 0.9rem;
        }
        
        .carousel-dots {
            padding: 6px;
            gap: 4px;
        }
        
        .carousel-dot {
            width: 8px;
            height: 8px;
        }
        
        .categories-carousel-container {
            padding: 0 25px;
        }
        
        .categories-carousel {
            gap: 15px;
        }
    }
    
        /* Extra small screens */
    @media (max-width: 360px) {
        .sidebar {
            max-width: 100%;
        }

        .sidebar-header {
            padding: 15px 10px;
        }

        .sidebar-nav-item {
            padding: 15px 12px;
            font-size: 1rem;
        }

        .sidebar-auth-btn {
            padding: 10px 14px;
            font-size: 0.9rem;
        }

        .sidebar-auth-btn i {
            font-size: 0.9rem;
        }

        .sidebar-cta {
            padding: 15px 20px;
            font-size: 1rem;
        }

        .mobile-header {
            padding: 8px 10px;
        }

        .mobile-logo {
            font-size: 0.9rem;
        }

        .mobile-logo i {
            font-size: 1.1rem;
        }

        .mobile-menu-btn {
            min-width: 30px;
            height: 30px;
            font-size: 0.9rem;
        }
        
        .category-card {
            min-width: 160px;
            padding: 15px 10px;
        }
        
        .category-icon {
            width: 50px;
            height: 50px;
            font-size: 1.2rem;
            margin-bottom: 10px;
        }
        
        .category-card h3 {
            font-size: 0.9rem;
            margin-bottom: 8px;
        }
        
        .category-card p {
            font-size: 0.7rem;
            margin-bottom: 8px;
        }
        
        .feature-tag {
            font-size: 0.6rem;
            padding: 2px 4px;
        }
        
        .category-count {
            font-size: 0.7rem;
            padding: 4px 8px;
        }
        
        .category-link {
            font-size: 0.7rem;
            padding: 4px 8px;
        }
        
        .carousel-arrow {
            width: 30px;
            height: 30px;
            font-size: 0.8rem;
        }
        
        .carousel-dots {
            padding: 4px;
            gap: 3px;
        }
        
        .carousel-dot {
            width: 6px;
            height: 6px;
        }
        
        .categories-carousel-container {
            padding: 0 20px;
        }
        
        .categories-carousel {
            gap: 10px;
        }
        
        .section-title h2 {
            font-size: 1.4rem;
            margin-bottom: 8px;
        }
        
        .section-title p {
            font-size: 0.8rem;
        }
        
        .categories-carousel-container {
            background: linear-gradient(90deg, 
                rgba(16, 185, 129, 0.1) 0%, 
                transparent 10%, 
                transparent 90%, 
                rgba(16, 185, 129, 0.1) 100%);
        }
    }
    
    /* Landscape orientation for mobile */
    @media (max-width: 768px) and (orientation: landscape) {
        .categories-carousel-container {
            padding: 0 40px;
        }
        
        .category-card {
            min-width: 200px;
            padding: 20px 15px;
        }
        
        .category-icon {
            width: 70px;
            height: 70px;
            font-size: 1.8rem;
            margin-bottom: 15px;
        }
        
        .category-card h3 {
            font-size: 1.1rem;
            margin-bottom: 10px;
        }
        
        .category-card p {
            font-size: 0.9rem;
            margin-bottom: 10px;
        }
        
        .feature-tag {
            font-size: 0.8rem;
            padding: 4px 8px;
        }
        
        .category-count {
            font-size: 0.9rem;
            padding: 6px 12px;
        }
        
        .category-link {
            font-size: 0.9rem;
            padding: 6px 12px;
        }
        
        .carousel-arrow {
            width: 40px;
            height: 40px;
            font-size: 1rem;
        }
        
        .carousel-dots {
            padding: 8px;
            gap: 6px;
        }
        
        .carousel-dot {
            width: 10px;
            height: 10px;
        }
        
        .categories-carousel {
            gap: 20px;
        }
        
        .section-title h2 {
            font-size: 1.8rem;
            margin-bottom: 10px;
        }
        
        .section-title p {
            font-size: 1rem;
        }
        
        .categories-carousel-container {
            background: linear-gradient(90deg, 
                rgba(16, 185, 129, 0.08) 0%, 
                transparent 15%, 
                transparent 85%, 
                rgba(16, 185, 129, 0.08) 100%);
        }
    }
    
    /* Tablet landscape orientation */
    @media (min-width: 769px) and (max-width: 1024px) and (orientation: landscape) {
        .categories-carousel-container {
            padding: 0 50px;
        }
        
        .category-card {
            min-width: 250px;
            padding: 30px 20px;
        }
        
        .category-icon {
            width: 90px;
            height: 90px;
            font-size: 2.2rem;
            margin-bottom: 20px;
        }
        
        .category-card h3 {
            font-size: 1.3rem;
            margin-bottom: 15px;
        }
        
        .category-card p {
            font-size: 1rem;
            margin-bottom: 15px;
        }
        
        .feature-tag {
            font-size: 0.9rem;
            padding: 5px 10px;
        }
        
        .category-count {
            font-size: 1rem;
            padding: 8px 16px;
        }
        
        .category-link {
            font-size: 1rem;
            padding: 8px 16px;
        }
        
        .carousel-arrow {
            width: 45px;
            height: 45px;
            font-size: 1.1rem;
        }
        
        .carousel-dots {
            padding: 10px;
            gap: 8px;
        }
        
        .carousel-dot {
            width: 12px;
            height: 12px;
        }
        
        .categories-carousel {
            gap: 25px;
        }
        
        .section-title h2 {
            font-size: 2.2rem;
            margin-bottom: 15px;
        }
        
        .section-title p {
            font-size: 1.1rem;
        }
        
        .categories-carousel-container {
            background: linear-gradient(90deg, 
                rgba(16, 185, 129, 0.06) 0%, 
                transparent 20%, 
                transparent 80%, 
                rgba(16, 185, 129, 0.06) 100%);
        }
    }
    
    /* Large desktop screens */
    @media (min-width: 1440px) {
        .categories-carousel-container {
            padding: 0 80px;
        }
        
        .category-card {
            min-width: 350px;
            padding: 60px 40px;
        }
        
        .category-icon {
            width: 140px;
            height: 140px;
            font-size: 3.5rem;
            margin-bottom: 40px;
        }
        
        .category-card h3 {
            font-size: 2rem;
            margin-bottom: 30px;
        }
        
        .category-card p {
            font-size: 1.3rem;
            margin-bottom: 30px;
        }
        
        .feature-tag {
            font-size: 1.1rem;
            padding: 8px 16px;
        }
        
        .category-count {
            font-size: 1.3rem;
            padding: 15px 30px;
        }
        
        .category-link {
            font-size: 1.3rem;
            padding: 15px 30px;
        }
        
        .carousel-arrow {
            width: 70px;
            height: 70px;
            font-size: 1.5rem;
        }
        
        .carousel-dots {
            padding: 20px;
            gap: 15px;
        }
        
        .carousel-dot {
            width: 18px;
            height: 18px;
        }
        
        .categories-carousel {
            gap: 40px;
        }
        
        .section-title h2 {
            font-size: 3.5rem;
            margin-bottom: 30px;
        }
        
        .section-title p {
            font-size: 1.4rem;
        }
        
        .categories-carousel-container {
            background: linear-gradient(90deg, 
                rgba(16, 185, 129, 0.04) 0%, 
                transparent 25%, 
                transparent 75%, 
                rgba(16, 185, 129, 0.04) 100%);
        }
    }
    
    /* Ultra-wide screens */
    @media (min-width: 1920px) {
        .categories-carousel-container {
            padding: 0 100px;
        }
        
        .category-card {
            min-width: 400px;
            padding: 70px 50px;
        }
        
        .category-icon {
            width: 160px;
            height: 160px;
            font-size: 4rem;
            margin-bottom: 50px;
        }
        
        .category-card h3 {
            font-size: 2.5rem;
            margin-bottom: 40px;
        }
        
        .category-card p {
            font-size: 1.5rem;
            margin-bottom: 40px;
        }
        
        .feature-tag {
            font-size: 1.2rem;
            padding: 10px 20px;
        }
        
        .category-count {
            font-size: 1.5rem;
            padding: 20px 40px;
        }
        
        .category-link {
            font-size: 1.5rem;
            padding: 20px 40px;
        }
        
        .carousel-arrow {
            width: 80px;
            height: 80px;
            font-size: 1.8rem;
        }
        
        .carousel-dots {
            padding: 25px;
            gap: 20px;
        }
        
        .carousel-dot {
            width: 20px;
            height: 20px;
        }
        
        .categories-carousel {
            gap: 50px;
        }
        
        .section-title h2 {
            font-size: 4rem;
            margin-bottom: 40px;
        }
        
        .section-title p {
            font-size: 1.6rem;
        }
        
        .categories-carousel-container {
            background: linear-gradient(90deg, 
                rgba(16, 185, 129, 0.03) 0%, 
                transparent 30%, 
                transparent 70%, 
                rgba(16, 185, 129, 0.03) 100%);
        }
    }
    
    /* Print styles for better printing */
    @media print {
        .categories-carousel-container {
            display: block;
            background: none;
            padding: 0;
        }
        
        .category-card {
            display: inline-block;
            width: 45%;
            margin: 10px;
            page-break-inside: avoid;
            background: white;
            border: 1px solid #ccc;
        }
        
        .carousel-arrow,
        .carousel-dots {
            display: none;
        }
        
        .category-icon {
            background: #f0f0f0;
            color: #333;
        }
        
        .category-link {
            background: #333;
            color: white;
            border: none;
        }
        
        .feature-tag {
            background: #f0f0f0;
            color: #333;
            border: 1px solid #ccc;
        }
        
        .category-count {
            background: #333;
            color: white;
        }
        
        .feature-tag {
            background: #f0f0f0;
            color: #333;
            border: 1px solid #ccc;
        }
    }
    
    /* Enhanced accessibility for screen readers */
    .category-card[aria-hidden="true"] {
        display: none;
    }
    
    .carousel-arrow[aria-hidden="true"] {
        display: none;
    }
    
    .carousel-dot[aria-hidden="true"] {
        display: none;
    }
    
    /* Enhanced focus management */
    .category-card:focus {
        outline: 3px solid var(--primary-color);
        outline-offset: 2px;
    }
    
    .category-link:focus {
        outline: 2px solid var(--primary-color);
        outline-offset: 2px;
    }
    
    .carousel-arrow:focus {
        outline: 3px solid var(--primary-color);
        outline-offset: 2px;
    }
    
    .carousel-dot:focus {
        outline: 2px solid var(--primary-color);
        outline-offset: 2px;
    }
    
    /* Enhanced accessibility for screen readers */
    .category-card[aria-hidden="true"] {
        display: none;
    }
    
    .carousel-arrow[aria-hidden="true"] {
        display: none;
    }
    
    .carousel-dot[aria-hidden="true"] {
        display: none;
    }
    
    /* Enhanced focus management */
    .category-card:focus {
        outline: 3px solid var(--primary-color);
        outline-offset: 2px;
    }
    
    .category-link:focus {
        outline: 2px solid var(--primary-color);
        outline-offset: 2px;
    }
    
    .carousel-arrow:focus {
        outline: 3px solid var(--primary-color);
        outline-offset: 2px;
    }
    
    .carousel-dot:focus {
        outline: 2px solid var(--primary-color);
        outline-offset: 2px;
    }
    
    .category-card:hover .category-count {
        transform: scale(1.05);
        box-shadow: var(--shadow-lg);
        animation: pulse 1s infinite;
    }
    
    .category-link {
        background: transparent;
        color: var(--primary-color);
        padding: clamp(8px, 1.5vw, 10px) clamp(15px, 2.5vw, 20px);
        border-radius: 25px;
        text-decoration: none;
        font-weight: 600;
        font-size: clamp(0.9rem, 1.8vw, 1rem);
        transition: all 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        border: 2px solid var(--primary-color);
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-top: auto;
        animation: fadeInUp 0.8s ease-out both;
        animation-delay: 0.7s;
    }
    
    .category-link:hover {
        background: var(--primary-color);
        color: white;
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
        animation: bounce 0.6s ease;
    }
    
    .category-link i {
        transition: transform 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }
    
    .category-link:hover i {
        transform: translateX(-3px);
        animation: bounce 0.6s ease;
    }
    
    /* Enhanced hover effects for better user experience */
    .category-card:hover .category-icon {
        animation: pulse 2s infinite;
    }
    
    .category-card:hover .feature-tag {
        animation: bounce 0.6s ease;
    }
    
    .category-card:hover .category-count {
        animation: pulse 1s infinite;
    }
    
    .category-card:hover .category-link {
        animation: bounce 0.6s ease;
    }
    
    /* Smooth scrolling for better performance */
    .categories-carousel {
        scroll-behavior: smooth;
    }
    
    /* Enhanced focus states for accessibility */
    .category-card:focus-within {
        outline: 3px solid var(--primary-color);
        outline-offset: 2px;
    }
    
    .category-link:focus {
        outline: 2px solid var(--primary-color);
        outline-offset: 2px;
    }
    
    /* Loading state for better UX */
    .categories-carousel-container.loading {
        opacity: 0.7;
        pointer-events: none;
    }
    
    .categories-carousel-container.loading::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 50px;
        height: 50px;
        margin: -25px 0 0 -25px;
        border: 4px solid rgba(16, 185, 129, 0.2);
        border-top: 4px solid var(--primary-color);
        border-radius: 50%;
        animation: spin 1s linear infinite;
        z-index: 10;
    }
    
    /* Enhanced mobile experience */
    @media (hover: none) {
        .category-card:hover {
            transform: none;
        }
        
        .category-card:active {
            transform: translateY(-5px) scale(1.02);
        }
    }
    
    /* Print styles */
    @media print {
        .categories-carousel-container {
            display: block;
        }
        
        .carousel-arrow,
        .carousel-dots {
            display: none;
        }
    }
    
    /* High contrast mode support */
    @media (prefers-contrast: high) {
        .category-card {
            border: 2px solid var(--text-primary);
        }
        
        .category-card:hover {
            border-color: var(--primary-color);
        }
        
        .carousel-arrow {
            border: 2px solid white;
        }
        
        .carousel-dot {
            border: 2px solid var(--text-primary);
        }
    }
    
    /* Reduced motion support */
    @media (prefers-reduced-motion: reduce) {
        .category-card,
        .category-icon,
        .category-card h3,
        .category-card p,
        .category-features,
        .category-count,
        .category-link,
        .feature-tag,
        .carousel-arrow,
        .carousel-dot,
        .categories-carousel {
            animation: none;
            transition: none;
        }
        
        .category-card:hover {
            transform: none;
        }
    }
    
    /* Dark mode support */
    @media (prefers-color-scheme: dark) {
        .category-card {
            background: #1f2937;
            color: white;
        }
        
        .category-card h3 {
            color: white;
        }
        
        .category-card p {
            color: #d1d5db;
        }
        
        .feature-tag {
            background: #374151;
            color: #d1d5db;
            border-color: #4b5563;
        }
        
        .categories-carousel-container {
            background: linear-gradient(90deg, 
                rgba(16, 185, 129, 0.1) 0%, 
                transparent 20%, 
                transparent 80%, 
                rgba(16, 185, 129, 0.1) 100%);
        }
    }
    
    /* Enhanced performance optimizations */
    .category-card {
        will-change: transform;
        backface-visibility: hidden;
        transform: translateZ(0);
    }
    
    .categories-carousel {
        will-change: transform;
        backface-visibility: hidden;
        transform: translateZ(0);
    }
    
    .carousel-arrow {
        will-change: transform;
        backface-visibility: hidden;
        transform: translateZ(0);
    }
    
    /* Enhanced loading states */
    .category-card.loading {
        opacity: 0.7;
        pointer-events: none;
    }
    
    .category-card.loading::after {
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
    
    /* Enhanced error states */
    .category-card.error {
        border-color: #ef4444;
        background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
    }
    
    .category-card.error::before {
        background: linear-gradient(90deg, #ef4444, #dc2626);
    }
    
    /* Enhanced success states */
    .category-card.success {
        border-color: #10b981;
        background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
    }
    
    .category-card.success::before {
        background: linear-gradient(90deg, #10b981, #059669);
    }
    
    /* Enhanced warning states */
    .category-card.warning {
        border-color: #f59e0b;
        background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
    }
    
    .category-card.warning::before {
        background: linear-gradient(90deg, #f59e0b, #d97706);
    }
    
    /* Enhanced info states */
    .category-card.info {
        border-color: #3b82f6;
        background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
    }
    
    .category-card.info::before {
        background: linear-gradient(90deg, #3b82f6, #2563eb);
    }
    
    /* Enhanced focus ring for better accessibility */
    .category-card:focus-within {
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.3);
    }
    
    .category-link:focus {
        box-shadow: 0 0 0 2px rgba(16, 185, 129, 0.3);
    }
    
    .carousel-arrow:focus {
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.3);
    }
    
    .carousel-dot:focus {
        box-shadow: 0 0 0 2px rgba(16, 185, 129, 0.3);
    }
    
    /* Enhanced hover effects for better user experience */
    .category-card:hover .category-icon {
        filter: brightness(1.1);
    }
    
    .category-card:hover .category-link {
        background: var(--primary-color);
        color: white;
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }
    
    .category-card:hover .feature-tag {
        background: var(--primary-color);
        color: white;
        border-color: var(--primary-color);
        transform: translateY(-2px);
    }
    
    .category-card:hover .category-count {
        transform: scale(1.05);
        box-shadow: var(--shadow-lg);
    }
    
    /* Enhanced responsive design for better mobile experience */
    @media (max-width: 480px) {
        .category-card {
            min-width: 200px;
            padding: 25px 15px;
        }
        
        .category-icon {
            width: 80px;
            height: 80px;
            font-size: 2rem;
            margin-bottom: 20px;
        }
        
        .category-card h3 {
            font-size: 1.2rem;
            margin-bottom: 15px;
        }
        
        .category-card p {
            font-size: 0.9rem;
            margin-bottom: 15px;
        }
        
        .feature-tag {
            font-size: 0.8rem;
            padding: 4px 8px;
        }
        
        .category-count {
            font-size: 0.9rem;
            padding: 8px 15px;
        }
        
        .category-link {
            font-size: 0.9rem;
            padding: 8px 15px;
        }
        
        .carousel-arrow {
            width: 40px;
            height: 40px;
            font-size: 1rem;
        }
        
        .carousel-dots {
            padding: 8px;
            gap: 6px;
        }
        
        .carousel-dot {
            width: 10px;
            height: 10px;
        }
        
        .categories-carousel-container {
            padding: 0 30px;
        }
        
            .categories-carousel {
        gap: 20px;
    }
}

/* Enhanced accessibility for screen readers */
.category-card[aria-hidden="true"] {
    display: none;
}

.carousel-arrow[aria-hidden="true"] {
    display: none;
}

.carousel-dot[aria-hidden="true"] {
    display: none;
}

/* Enhanced focus management */
.category-card:focus {
    outline: 3px solid var(--primary-color);
    outline-offset: 2px;
}

.category-link:focus {
    outline: 2px solid var(--primary-color);
    outline-offset: 2px;
}

.carousel-arrow:focus {
    outline: 3px solid var(--primary-color);
    outline-offset: 2px;
}

.carousel-dot:focus {
    outline: 2px solid var(--primary-color);
    outline-offset: 2px;
}

/* Enhanced performance optimizations */
.category-card {
    contain: layout style paint;
}

.categories-carousel {
    contain: layout style paint;
}

.carousel-arrow {
    contain: layout style paint;
}

.carousel-dot {
    contain: layout style paint;
}

/* Enhanced loading states */
.category-card.loading {
    opacity: 0.7;
    pointer-events: none;
}

.category-card.loading::after {
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

/* Enhanced error states */
.category-card.error {
    border-color: #ef4444;
    background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
}

.category-card.error::before {
    background: linear-gradient(90deg, #ef4444, #dc2626);
}

/* Enhanced success states */
.category-card.success {
    border-color: #10b981;
    background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
}

.category-card.success::before {
    background: linear-gradient(90deg, #10b981, #059669);
}

/* Enhanced warning states */
.category-card.warning {
    border-color: #f59e0b;
    background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
}

.category-card.warning::before {
    background: linear-gradient(90deg, #f59e0b, #d97706);
}

/* Enhanced info states */
.category-card.info {
    border-color: #3b82f6;
    background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
}

.category-card.info::before {
    background: linear-gradient(90deg, #3b82f6, #2563eb);
}

    /* Featured Courses */
    .featured-courses {
        padding: clamp(80px, 12vw, 120px) 0;
        background: var(--bg-primary);
        position: relative;
        width: 100%;
        max-width: 100%;
        margin: 0;
        overflow-x: hidden;
    }
    
    .featured-courses .container {
        max-width: 100%;
        width: 100%;
        margin: 0;
        padding: 0 40px;
        overflow-x: hidden;
    }
    
    .courses-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: clamp(25px, 4vw, 40px);
        padding: 0;
        max-width: 100%;
        width: 100%;
        margin: 0;
        overflow-x: hidden;
    }
    
    .course-card {
        background: var(--bg-primary);
        border-radius: var(--border-radius-xl);
        overflow: hidden;
        box-shadow: var(--shadow-lg);
        transition: all var(--transition-normal);
        border: 1px solid var(--border-color);
        position: relative;
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    
    .course-card:hover {
        transform: translateY(-15px);
        box-shadow: var(--shadow-2xl);
        border-color: var(--primary-color);
    }
    
    .course-image {
        height: clamp(200px, 30vw, 250px);
        background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
        position: relative;
        overflow: hidden;
    }
    
    .course-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform var(--transition-normal);
    }
    
    .course-card:hover .course-image img {
        transform: scale(1.1);
    }
    
    .course-price {
        position: absolute;
        top: 20px;
        left: 20px;
        background: linear-gradient(45deg, var(--secondary-color), var(--secondary-dark));
        color: var(--text-primary);
        padding: clamp(8px, 1.5vw, 12px) clamp(15px, 2.5vw, 20px);
        border-radius: 30px;
        font-weight: 800;
        font-size: clamp(0.9rem, 2vw, 1.1rem);
        box-shadow: var(--shadow-lg);
        z-index: 2;
    }
    
    .course-content {
        padding: clamp(25px, 4vw, 35px);
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }
    
    .course-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        font-size: clamp(0.9rem, 2vw, 1rem);
        color: var(--text-secondary);
        flex-wrap: wrap;
        gap: 10px;
    }
    
    .course-title {
        font-size: clamp(1.2rem, 3vw, 1.5rem);
        font-weight: 800;
        color: var(--text-primary);
        margin-bottom: 20px;
        line-height: 1.4;
        flex-grow: 1;
    }
    
    .course-description {
        color: var(--text-secondary);
        line-height: 1.7;
        margin-bottom: 25px;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        font-size: clamp(1rem, 2vw, 1.1rem);
        flex-grow: 1;
    }
    
    .course-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 20px;
        border-top: 2px solid var(--bg-secondary);
        margin-top: auto;
        flex-wrap: wrap;
        gap: 15px;
    }
    
    .course-instructor {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    
    .instructor-avatar {
        width: clamp(40px, 6vw, 50px);
        height: clamp(40px, 6vw, 50px);
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: clamp(1rem, 2vw, 1.2rem);
        box-shadow: var(--shadow-md);
    }
    
    .course-btn {
        background: linear-gradient(45deg, var(--primary-color), var(--primary-dark));
        color: white;
        padding: clamp(10px, 2vw, 12px) clamp(20px, 3vw, 25px);
        border-radius: 30px;
        text-decoration: none;
        font-weight: 700;
        transition: all var(--transition-normal);
        font-size: clamp(1rem, 2vw, 1.1rem);
        white-space: nowrap;
        box-shadow: var(--shadow-md);
    }
    
    .course-btn:hover {
        background: linear-gradient(45deg, var(--primary-dark), #047857);
        transform: translateY(-3px);
        box-shadow: var(--shadow-lg);
    }
    
    /* Testimonials Section */
    .testimonials {
        padding: clamp(80px, 12vw, 120px) 0;
        background: linear-gradient(135deg, var(--bg-dark) 0%, #374151 100%);
        color: white;
        position: relative;
        width: 100%;
        max-width: 100%;
        margin: 0;
        overflow-x: hidden;
    }
    
    .testimonials .container {
        max-width: 100%;
        width: 100%;
        margin: 0;
        padding: 0 40px;
        overflow-x: hidden;
    }
    
    .testimonials::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('https://images.unsplash.com/photo-1521737711867-e3b97375f902?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80') center/cover;
        opacity: 0.1;
    }
    
    .testimonials-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: clamp(25px, 4vw, 40px);
        position: relative;
        z-index: 2;
        padding: 0;
        max-width: none;
        width: 100%;
        margin: 0;
    }
    
    .testimonial-card {
        background: rgba(255,255,255,0.1);
        backdrop-filter: blur(10px);
        border-radius: var(--border-radius-xl);
        padding: clamp(30px, 5vw, 40px);
        text-align: center;
        border: 1px solid rgba(255,255,255,0.2);
        transition: all var(--transition-normal);
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    
    .testimonial-card:hover {
        transform: translateY(-10px);
        background: rgba(255,255,255,0.15);
        box-shadow: var(--shadow-xl);
    }
    
    .testimonial-avatar {
        width: clamp(70px, 12vw, 80px);
        height: clamp(70px, 12vw, 80px);
        border-radius: 50%;
        margin: 0 auto 20px;
        background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: clamp(1.8rem, 4vw, 2rem);
        color: white;
        font-weight: 700;
        box-shadow: var(--shadow-lg);
    }
    
    .testimonial-text {
        font-size: clamp(1rem, 2.5vw, 1.1rem);
        line-height: 1.8;
        margin-bottom: 20px;
        font-style: italic;
        flex-grow: 1;
    }
    
    .testimonial-author {
        font-weight: 700;
        font-size: clamp(1.1rem, 2.5vw, 1.2rem);
        margin-bottom: 5px;
    }
    
    .testimonial-position {
        color: #9ca3af;
        font-size: clamp(0.9rem, 2vw, 1rem);
    }
    
    /* FAQ Section */
    .faq-section {
        padding: clamp(80px, 12vw, 120px) 0;
        background: linear-gradient(135deg, var(--bg-secondary) 0%, #e2e8f0 100%);
        position: relative;
        width: 100%;
        margin: 0;
    }
    
    .faq-section .container {
        max-width: none;
        width: 100%;
        margin: 0;
        padding: 0 40px;
    }
    
    .faq-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('https://images.unsplash.com/photo-1516321318423-f06f85e504b3?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80') center/cover;
        opacity: 0.03;
    }
    
    .faq-container {
        max-width: 900px;
        margin: 0 auto;
        position: relative;
        z-index: 2;
    }
    
    .faq-item {
        background: var(--bg-primary);
        border-radius: var(--border-radius-xl);
        margin-bottom: 20px;
        box-shadow: var(--shadow-lg);
        border: 2px solid transparent;
        transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        overflow: hidden;
        position: relative;
    }
    
    .faq-item::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(16, 185, 129, 0.1), transparent);
        transition: left 0.8s ease;
    }
    
    .faq-item:hover::before {
        left: 100%;
    }
    
    .faq-item:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-2xl);
        border-color: var(--primary-color);
    }
    
    .faq-item.active {
        border-color: var(--primary-color);
        box-shadow: var(--shadow-xl);
        background: linear-gradient(135deg, var(--bg-primary) 0%, rgba(16, 185, 129, 0.05) 100%);
    }
    
    .faq-question {
        padding: clamp(25px, 4vw, 35px);
        cursor: pointer;
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: all 0.3s ease;
        position: relative;
        z-index: 1;
    }
    
    .faq-question:hover {
        background: rgba(16, 185, 129, 0.05);
    }
    
    .faq-question h3 {
        font-size: clamp(1.1rem, 2.5vw, 1.3rem);
        font-weight: 700;
        color: var(--text-primary);
        margin: 0;
        line-height: 1.4;
        flex: 1;
        padding-left: 0;
    }
    
    .faq-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.2rem;
        transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        flex-shrink: 0;
        margin-right: 15px;
    }
    
    .faq-item.active .faq-icon {
        transform: rotate(45deg);
        background: linear-gradient(135deg, var(--secondary-color), var(--secondary-dark));
        color: var(--text-primary);
    }
    
    .faq-icon i {
        transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }
    
    .faq-answer {
        max-height: 0;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        background: rgba(16, 185, 129, 0.02);
        border-top: 1px solid transparent;
    }
    
    .faq-item.active .faq-answer {
        max-height: 300px;
        border-top-color: rgba(16, 185, 129, 0.1);
    }
    
    .faq-answer p {
        padding: clamp(20px, 3vw, 30px);
        margin: 0;
        color: var(--text-secondary);
        line-height: 1.8;
        font-size: clamp(1rem, 2vw, 1.1rem);
        animation: fadeInUp 0.4s ease-out;
    }
    
    .faq-cta {
        text-align: center;
        margin-top: 50px;
        padding: 40px;
        background: linear-gradient(135deg, var(--bg-primary) 0%, rgba(16, 185, 129, 0.05) 100%);
        border-radius: var(--border-radius-xl);
        border: 2px solid rgba(16, 185, 129, 0.1);
        position: relative;
        z-index: 2;
    }
    
    .faq-cta::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(16, 185, 129, 0.1), transparent);
        transition: left 0.8s ease;
    }
    
    .faq-cta:hover::before {
        left: 100%;
    }
    
    .faq-cta p {
        font-size: clamp(1.2rem, 2.5vw, 1.4rem);
        color: var(--text-primary);
        margin-bottom: 25px;
        font-weight: 600;
        position: relative;
        z-index: 1;
    }
    
    .faq-contact-btn {
        background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
        color: white;
        padding: clamp(15px, 3vw, 18px) clamp(30px, 5vw, 40px);
        border-radius: 50px;
        text-decoration: none;
        font-weight: 700;
        font-size: clamp(1rem, 2vw, 1.2rem);
        transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        display: inline-flex;
        align-items: center;
        gap: 12px;
        box-shadow: var(--shadow-lg);
        position: relative;
        z-index: 1;
        overflow: hidden;
    }
    
    .faq-contact-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.6s ease;
    }
    
    .faq-contact-btn:hover::before {
        left: 100%;
    }
    
    .faq-contact-btn:hover {
        background: linear-gradient(135deg, var(--primary-dark), #047857);
        transform: translateY(-3px);
        box-shadow: var(--shadow-xl);
    }
    
    /* FAQ Responsive Design */
    @media (max-width: 768px) {
        .faq-section .container {
            padding: 0 20px;
        }
        
        .faq-question {
            padding: 20px 15px;
        }
        
        .faq-question h3 {
            font-size: 1.1rem;
        }
        
        .faq-icon {
            width: 35px;
            height: 35px;
            font-size: 1rem;
            margin-right: 10px;
        }
        
        .faq-answer p {
            padding: 15px 20px;
            font-size: 1rem;
        }
        
        .faq-cta {
            padding: 30px 20px;
            margin-top: 30px;
        }
        
        .faq-cta p {
            font-size: 1.2rem;
        }
        
        .faq-contact-btn {
            padding: 12px 25px;
            font-size: 1rem;
        }
    }
    
    @media (max-width: 480px) {
        .faq-question {
            padding: 18px 12px;
        }
        
        .faq-question h3 {
            font-size: 1rem;
        }
        
        .faq-icon {
            width: 30px;
            height: 30px;
            font-size: 0.9rem;
            margin-right: 8px;
        }
        
        .faq-answer p {
            padding: 12px 15px;
            font-size: 0.95rem;
        }
        
        .faq-cta {
            padding: 25px 15px;
        }
        
        .faq-cta p {
            font-size: 1.1rem;
        }
        
        .faq-contact-btn {
            padding: 10px 20px;
            font-size: 0.95rem;
        }
    }
    
    /* Blog Section */
    .blog-section {
        padding: clamp(80px, 12vw, 120px) 0;
        background: var(--bg-secondary);
        position: relative;
        width: 100%;
        max-width: 100%;
        margin: 0;
        overflow-x: hidden;
    }
    
    .blog-section .container {
        max-width: 100%;
        width: 100%;
        margin: 0;
        padding: 0 40px;
        overflow-x: hidden;
    }
    
    .blog-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: clamp(25px, 4vw, 40px);
        padding: 0;
        max-width: 100%;
        width: 100%;
        margin: 0;
        overflow-x: hidden;
    }
    
    .blog-card {
        background: var(--bg-primary);
        border-radius: var(--border-radius-xl);
        overflow: hidden;
        box-shadow: var(--shadow-lg);
        transition: all var(--transition-normal);
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    
    .blog-card:hover {
        transform: translateY(-10px);
        box-shadow: var(--shadow-2xl);
    }
    
    .blog-image {
        height: clamp(180px, 25vw, 220px);
        background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
        position: relative;
        overflow: hidden;
    }
    
    .blog-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform var(--transition-normal);
    }
    
    .blog-card:hover .blog-image img {
        transform: scale(1.1);
    }
    
    .blog-content {
        padding: clamp(25px, 4vw, 35px);
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }
    
    .blog-title {
        font-size: clamp(1.2rem, 3vw, 1.4rem);
        font-weight: 800;
        color: var(--text-primary);
        margin-bottom: 15px;
        line-height: 1.4;
        flex-grow: 1;
    }
    
    .blog-excerpt {
        color: var(--text-secondary);
        line-height: 1.7;
        margin-bottom: 20px;
        font-size: clamp(1rem, 2vw, 1.1rem);
        flex-grow: 1;
    }
    
    .blog-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: clamp(0.9rem, 2vw, 1rem);
        color: var(--text-secondary);
        margin-top: auto;
        flex-wrap: wrap;
        gap: 10px;
    }
    
    /* FAQ Section */
    .faq-section {
        padding: clamp(80px, 12vw, 120px) 0;
        background: linear-gradient(135deg, var(--bg-secondary) 0%, #e2e8f0 100%);
        position: relative;
        width: 100%;
        margin: 0;
    }
    
    .faq-section .container {
        max-width: none;
        width: 100%;
        margin: 0;
        padding: 0 40px;
    }
    
    .faq-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('https://images.unsplash.com/photo-1516321318423-f06f85e504b3?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80') center/cover;
        opacity: 0.03;
    }
    
    .faq-container {
        max-width: 900px;
        margin: 0 auto;
        position: relative;
        z-index: 2;
    }
    
    .faq-item {
        background: var(--bg-primary);
        border-radius: var(--border-radius-xl);
        margin-bottom: 20px;
        box-shadow: var(--shadow-lg);
        border: 2px solid transparent;
        transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        overflow: hidden;
        position: relative;
    }
    
    .faq-item::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(16, 185, 129, 0.1), transparent);
        transition: left 0.8s ease;
    }
    
    .faq-item:hover::before {
        left: 100%;
    }
    
    .faq-item:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-2xl);
        border-color: var(--primary-color);
    }
    
    .faq-item.active {
        border-color: var(--primary-color);
        box-shadow: var(--shadow-xl);
        background: linear-gradient(135deg, var(--bg-primary) 0%, rgba(16, 185, 129, 0.05) 100%);
    }
    
    .faq-question {
        padding: clamp(25px, 4vw, 35px);
        cursor: pointer;
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: all 0.3s ease;
        position: relative;
        z-index: 1;
    }
    
    .faq-question:hover {
        background: rgba(16, 185, 129, 0.05);
    }
    
    .faq-question h3 {
        font-size: clamp(1.1rem, 2.5vw, 1.3rem);
        font-weight: 700;
        color: var(--text-primary);
        margin: 0;
        line-height: 1.4;
        flex: 1;
        padding-left: 0;
    }
    
    .faq-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.2rem;
        transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        flex-shrink: 0;
        margin-right: 15px;
    }
    
    .faq-item.active .faq-icon {
        transform: rotate(45deg);
        background: linear-gradient(135deg, var(--secondary-color), var(--secondary-dark));
        color: var(--text-primary);
    }
    
    .faq-icon i {
        transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }
    
    .faq-answer {
        max-height: 0;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        background: rgba(16, 185, 129, 0.02);
        border-top: 1px solid transparent;
    }
    
    .faq-item.active .faq-answer {
        max-height: 300px;
        border-top-color: rgba(16, 185, 129, 0.1);
    }
    
    .faq-answer p {
        padding: clamp(20px, 3vw, 30px);
        margin: 0;
        color: var(--text-secondary);
        line-height: 1.8;
        font-size: clamp(1rem, 2vw, 1.1rem);
        animation: fadeInUp 0.4s ease-out;
    }
    
    .faq-cta {
        text-align: center;
        margin-top: 50px;
        padding: 40px;
        background: linear-gradient(135deg, var(--bg-primary) 0%, rgba(16, 185, 129, 0.05) 100%);
        border-radius: var(--border-radius-xl);
        border: 2px solid rgba(16, 185, 129, 0.1);
        position: relative;
        z-index: 2;
    }
    
    .faq-cta::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(16, 185, 129, 0.1), transparent);
        transition: left 0.8s ease;
    }
    
    .faq-cta:hover::before {
        left: 100%;
    }
    
    .faq-cta p {
        font-size: clamp(1.2rem, 2.5vw, 1.4rem);
        color: var(--text-primary);
        margin-bottom: 25px;
        font-weight: 600;
        position: relative;
        z-index: 1;
    }
    
    .faq-contact-btn {
        background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
        color: white;
        padding: clamp(15px, 3vw, 18px) clamp(30px, 5vw, 40px);
        border-radius: 50px;
        text-decoration: none;
        font-weight: 700;
        font-size: clamp(1rem, 2vw, 1.2rem);
        transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        display: inline-flex;
        align-items: center;
        gap: 12px;
        box-shadow: var(--shadow-lg);
        position: relative;
        z-index: 1;
        overflow: hidden;
    }
    
    .faq-contact-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.6s ease;
    }
    
    .faq-contact-btn:hover::before {
        left: 100%;
    }
    
    .faq-contact-btn:hover {
        background: linear-gradient(135deg, var(--primary-dark), #047857);
        transform: translateY(-3px);
        box-shadow: var(--shadow-xl);
    }
    
    /* FAQ Animations */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    /* FAQ Responsive Design */
    @media (max-width: 768px) {
        .faq-section .container {
            padding: 0 20px;
        }
        
        .faq-question {
            padding: 20px 15px;
        }
        
        .faq-question h3 {
            font-size: 1.1rem;
        }
        
        .faq-icon {
            width: 35px;
            height: 35px;
            font-size: 1rem;
            margin-right: 10px;
        }
        
        .faq-answer p {
            padding: 15px 20px;
            font-size: 1rem;
        }
        
        .faq-cta {
            padding: 30px 20px;
            margin-top: 30px;
        }
        
        .faq-cta p {
            font-size: 1.2rem;
        }
        
        .faq-contact-btn {
            padding: 12px 25px;
            font-size: 1rem;
        }
    }
    
    @media (max-width: 480px) {
        .faq-question {
            padding: 18px 12px;
        }
        
        .faq-question h3 {
            font-size: 1rem;
        }
        
        .faq-icon {
            width: 30px;
            height: 30px;
            font-size: 0.9rem;
            margin-right: 8px;
        }
        
        .faq-answer p {
            padding: 12px 15px;
            font-size: 0.95rem;
        }
        
        .faq-cta {
            padding: 25px 15px;
        }
        
        .faq-cta p {
            font-size: 1.1rem;
        }
        
        .faq-contact-btn {
            padding: 10px 20px;
            font-size: 0.95rem;
        }
    }
    
    /* CTA Section */
    .cta-section {
        padding: clamp(80px, 12vw, 120px) 0;
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
        color: white;
        text-align: center;
        position: relative;
        overflow: hidden;
        width: 100%;
        max-width: 100%;
        margin: 0;
    }
    
    .cta-section .container {
        max-width: 100%;
        width: 100%;
        margin: 0;
        padding: 0 40px;
        overflow-x: hidden;
    }
    
    .cta-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('https://images.unsplash.com/photo-1516321318423-f06f85e504b3?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80') center/cover;
        opacity: 0.1;
    }
    
    .cta-content {
        position: relative;
        z-index: 2;
        max-width: none;
        width: 100%;
        margin: 0;
        padding: 0;
    }
    
    .cta-title {
        font-size: clamp(2.5rem, 6vw, 3.5rem);
        font-weight: 900;
        margin-bottom: 25px;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        line-height: 1.2;
    }
    
    .cta-description {
        font-size: clamp(1.1rem, 2.5vw, 1.3rem);
        margin-bottom: 40px;
        line-height: 1.8;
        opacity: 0.95;
    }
    
    .cta-buttons {
        display: flex;
        gap: clamp(15px, 3vw, 25px);
        justify-content: center;
        flex-wrap: wrap;
    }
    
    .cta-btn {
        padding: clamp(15px, 3vw, 18px) clamp(30px, 5vw, 40px);
        border-radius: 50px;
        font-size: clamp(1rem, 2vw, 1.2rem);
        font-weight: 700;
        text-decoration: none;
        transition: all var(--transition-normal);
        display: inline-flex;
        align-items: center;
        gap: 12px;
        white-space: nowrap;
    }
    
    .cta-btn-primary {
        background: var(--secondary-color);
        color: var(--text-primary);
        box-shadow: var(--shadow-xl);
    }
    
    .cta-btn-primary:hover {
        background: var(--secondary-dark);
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.3);
    }
    
    .cta-btn-secondary {
        background: transparent;
        color: white;
        border: 3px solid white;
    }
    
    .cta-btn-secondary:hover {
        background: white;
        color: var(--primary-color);
        transform: translateY(-5px);
    }
    
    /* Enhanced Responsive Design */
    @media (max-width: 1200px) {
        .categories-grid,
        .courses-grid,
        .blog-grid,
        .testimonials-grid {
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        }
    }
    
    @media (max-width: 768px) {
        /* Hero section removed - using slider instead */
        
        /* Hero buttons removed - using slide buttons instead */
        
        .stats {
            margin-top: -40px;
            padding: 50px 0;
        }
        
        .stats .container {
            padding: 0 20px;
        }
        
        .stats-grid {
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 15px;
        }
        
        .categories .container,
        .featured-courses .container,
        .testimonials .container,
        .blog-section .container,
        .cta-section .container {
            padding: 0 20px;
        }
        
        .categories-grid,
        .courses-grid,
        .blog-grid,
        .testimonials-grid {
            grid-template-columns: 1fr;
            gap: 20px;
        }
        
        .category-card,
        .course-card,
        .blog-card,
        .testimonial-card {
            margin: 0;
        }
        
        .whatsapp-float {
            bottom: 20px;
            right: 20px;
        }
        
        .whatsapp-float a {
            width: 50px;
            height: 50px;
            font-size: 20px;
        }
        
        .course-footer {
            flex-direction: column;
            align-items: stretch;
            gap: 15px;
        }
        
        .course-btn {
            text-align: center;
            justify-content: center;
            width: 100%;
        }
        
        .cta-buttons {
            flex-direction: column;
            align-items: center;
            gap: 15px;
        }
        
        .cta-btn {
            width: 100%;
            max-width: 280px;
            justify-content: center;
        }
        
        .category-features {
            justify-content: center;
        }
        
        .feature-tag {
            font-size: 0.8rem;
            padding: 4px 8px;
        }
    }
    
    @media (max-width: 480px) {
        /* Hero section removed - using slider instead */
        
        .section-title h2 {
            font-size: 1.6rem;
            margin-bottom: 15px;
        }
        
        .section-title p {
            font-size: 0.95rem;
        }
        
        .stat-number {
            font-size: 2rem;
        }
        
        .stat-label {
            font-size: 0.9rem;
        }
        
        .category-card,
        .course-card,
        .blog-card,
        .testimonial-card {
            padding: 20px 15px;
        }
        
        .category-icon {
            width: 80px;
            height: 80px;
            font-size: 2rem;
            margin-bottom: 20px;
        }
        
        .category-card h3 {
            font-size: 1.3rem;
            margin-bottom: 15px;
        }
        
        .category-card p {
            font-size: 0.9rem;
            margin-bottom: 15px;
        }
        
        .cta-buttons {
            gap: 10px;
        }
        
        .cta-btn {
            padding: 12px 20px;
            font-size: 0.95rem;
            min-width: 200px;
        }
        
        .course-title {
            font-size: 1.2rem;
        }
        
        .course-description {
            font-size: 0.9rem;
        }
        
        .testimonial-text {
            font-size: 0.9rem;
        }
        
        .blog-title {
            font-size: 1.1rem;
        }
        
        .blog-excerpt {
            font-size: 0.9rem;
        }
        
        .cta-title {
            font-size: 2rem;
        }
        
        .cta-description {
            font-size: 1rem;
        }
        
        .whatsapp-float {
            bottom: 15px;
            right: 15px;
        }
        
        .whatsapp-float a {
            width: 45px;
            height: 45px;
            font-size: 18px;
        }
    }
    
    @media (max-width: 360px) {
        .hero h1 {
            font-size: 1.6rem;
        }
        
        .hero p {
            font-size: 0.9rem;
        }
        
        .section-title h2 {
            font-size: 1.4rem;
        }
        
        .hero-btn,
        .cta-btn {
            padding: 10px 18px;
            font-size: 0.9rem;
            min-width: 180px;
        }
        
        .category-card,
        .course-card,
        .blog-card,
        .testimonial-card {
            padding: 15px 12px;
        }
    }
    
    /* Animation Classes */
    .fade-in {
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.6s ease;
    }
    
    .fade-in.visible {
        opacity: 1;
        transform: translateY(0);
    }
    
    .slide-in-left {
        opacity: 0;
        transform: translateX(-50px);
        transition: all 0.6s ease;
    }
    
    .slide-in-left.visible {
        opacity: 1;
        transform: translateX(0);
    }
    
    .slide-in-right {
        opacity: 0;
        transform: translateX(50px);
        transition: all 0.6s ease;
    }
    
    .slide-in-right.visible {
        opacity: 1;
        transform: translateX(0);
    }
    
    .scale-in {
        opacity: 0;
        transform: scale(0.8);
        transition: all 0.6s ease;
    }
    
    .scale-in.visible {
        opacity: 1;
        transform: scale(1);
    }
    
    /* Loading Animation */
    .loading {
        opacity: 0;
        transform: translateY(20px);
    }
    
    .loaded {
        opacity: 1;
        transform: translateY(0);
        transition: all 0.6s ease;
    }
    
    /* Focus States for Accessibility */
    .hero-btn:focus,
    .course-btn:focus,
    .cta-btn:focus,
    .whatsapp-float a:focus {
        outline: 3px solid var(--primary-color);
        outline-offset: 2px;
    }
    
    /* Responsive Design for Hero Slider */
    @media (max-width: 768px) {
        .hero-slider {
            height: 100vh;
            min-height: 600px;
        }
        
        .slide-content {
            transform: translateY(10%);
        }
        
        .slide-title {
            font-size: 2.5rem;
        }
        
        .slide-description {
            font-size: 1.1rem;
        }
        
        .slide-buttons {
            flex-direction: column;
            gap: 15px;
        }
        
        .slide-btn {
            width: 100%;
            max-width: 300px;
        }
        
        .swiper-button-next,
        .swiper-button-prev {
            width: 50px;
            height: 50px;
        }
        
        .swiper-button-next i,
        .swiper-button-prev i {
            font-size: 18px;
        }
        
        .swiper-pagination-bullet {
            width: 10px;
            height: 10px;
        }
        
        /* Mobile Header Responsive */
        .mobile-header-content {
            gap: 10px;
        }
        
        .mobile-contact-social {
            gap: 10px;
        }
        
        .mobile-contact-info {
            gap: 8px;
        }
        
        .mobile-social-links {
            gap: 6px;
        }
        
        .mobile-contact-item {
            width: 32px;
            height: 32px;
        }
        
        .mobile-social-link {
            width: 28px;
            height: 28px;
        }
    }
    
    @media (max-width: 480px) {
        .hero-slider {
            height: 70vh;
            min-height: 400px;
        }
        
        .slide-content {
            transform: translateY(15%);
        }
        
        .slide-title {
            font-size: 2rem;
        }
        
        .slide-description {
            font-size: 1rem;
        }
        
        .swiper-button-next,
        .swiper-button-prev {
            width: 40px;
            height: 40px;
        }
        
        .swiper-button-next i,
        .swiper-button-prev i {
            font-size: 16px;
        }
    }
    
    /* Print Styles */
    @media print {
        .whatsapp-float,
        .hero-buttons,
        .cta-buttons {
            display: none;
        }
        
        .hero {
            background: white !important;
            color: black !important;
        }
    }
    
    /* Enhanced Categories Slider Styles */
    .categories-slider-container {
        position: relative;
        width: 100%;
        max-width: 100%;
        overflow: hidden;
        margin: 30px 0;
        padding: 0 60px; /* Space for navigation buttons */
    }
    
    .categories-slider {
        width: 100%;
        overflow: hidden;
        position: relative;
    }
    
    .categories-track {
        display: flex;
        transition: transform 0.5s ease-in-out;
        gap: 20px;
        padding: 10px 0;
    }
    
    .category-item {
        flex: 0 0 auto;
        min-width: 320px;
        max-width: 320px;
        margin: 0;
    }
    
    /* Navigation Buttons */
    .slider-nav-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
        color: white;
        border: none;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        z-index: 10;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
        font-size: 1.2rem;
    }
    
    .slider-nav-btn:hover {
        background: linear-gradient(135deg, var(--primary-dark), #047857);
        transform: translateY(-50%) scale(1.1);
        box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
    }
    
    .slider-nav-btn.prev-btn {
        left: 0;
    }
    
    .slider-nav-btn.next-btn {
        right: 0;
    }
    
    .slider-nav-btn:disabled {
        opacity: 0.5;
        cursor: not-allowed;
        transform: translateY(-50%) scale(1);
    }
    
    .slider-nav-btn:disabled:hover {
        transform: translateY(-50%) scale(1);
        box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
    }
    
    /* Auto-scroll indicator */
    .auto-scroll-indicator {
        position: absolute;
        bottom: -30px;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        gap: 8px;
        z-index: 5;
    }
    
    .scroll-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: rgba(16, 185, 129, 0.3);
        transition: all 0.3s ease;
    }
    
    .scroll-dot.active {
        background: var(--primary-color);
        transform: scale(1.2);
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .categories-slider-container {
            padding: 0 50px;
        }
        
        .category-item {
            min-width: 280px;
            max-width: 280px;
        }
        
        .slider-nav-btn {
            width: 45px;
            height: 45px;
            font-size: 1rem;
        }
    }
    
    @media (max-width: 480px) {
        .categories-slider-container {
            padding: 0 40px;
        }
        
        .category-item {
            min-width: 260px;
            max-width: 260px;
        }
        
        .slider-nav-btn {
            width: 40px;
            height: 40px;
            font-size: 0.9rem;
        }
    }
    
    /* Animation for ripple effect */
    @keyframes ripple {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }
    
    /* Enhanced floating animation */
    @keyframes float {
        0%, 100% { 
            transform: translateY(0px) rotate(0deg); 
        }
        50% { 
            transform: translateY(-10px) rotate(2deg); 
        }
    }
    
    /* Pulse animation for tags */
    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }
    
    /* Enhanced Courses Slider Styles */
    .courses-slider-container {
        position: relative;
        width: 100%;
        max-width: 100%;
        overflow: hidden;
        margin: 30px 0;
        padding: 0 60px; /* Space for navigation buttons */
    }
    
    .courses-slider {
        width: 100%;
        overflow: hidden;
        position: relative;
    }
    
    .courses-track {
        display: flex;
        transition: transform 0.5s ease-in-out;
        gap: 20px;
        padding: 10px 0;
    }
    
    .course-card {
        flex: 0 0 auto;
        min-width: 350px;
        max-width: 350px;
        margin: 0;
    }
    
    /* Responsive adjustments for courses slider */
    @media (max-width: 768px) {
        .courses-slider-container {
            padding: 0 50px;
        }
        
        .course-card {
            min-width: 300px;
            max-width: 300px;
        }
    }
    
    @media (max-width: 480px) {
        .courses-slider-container {
            padding: 0 40px;
        }
        
        .course-card {
            min-width: 280px;
            max-width: 280px;
        }
    }

</style>
@endpush

@section('content')
<!-- Mobile Header -->

<style>
    @media (min-width: 768px) {
        .mobile-header {
            display: none !important;
        }
    }

    /* Mobile Header Animation */
    @keyframes slideDown {
        from {
            transform: translateY(-100%);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    .mobile-header {
        animation: slideDown 0.5s ease-out;
    }
</style>



<!-- Main Content Area -->
<div class="main-content-area">
    <!-- Hero Slider -->
    <section class="hero-slider">
        <div class="floating-elements">
            <div class="floating-element"></div>
            <div class="floating-element"></div>
            <div class="floating-element"></div>
        </div>
        
        <div class="swiper">
            <div class="swiper-wrapper">
                <!-- Slide 1 -->
                <div class="swiper-slide slide-1">
                    <div class="slide-content">
                        <h1 class="slide-title">أكاديمية السهم الأخضر للتدريب</h1>
                        <p class="slide-description">
                            نحن نقدم أفضل الدورات التدريبية في مكة المكرمة لتطوير مهاراتك المهنية والشخصية
                            مع أفضل المدربين المتخصصين في مختلف المجالات التقنية والإدارية واللغوية
                        </p>
                        <div class="slide-buttons">
                            <a href="{{ route('register.page') }}" class="slide-btn slide-btn-primary">
                                <i class="bi bi-person-plus"></i>
                                سجل الآن
                            </a>
                            <a href="{{ route('courses') }}" class="slide-btn slide-btn-secondary">
                                <i class="bi bi-play-circle"></i>
                                تصفح الدورات
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Slide 2 -->
                <div class="swiper-slide slide-2">
                    <div class="slide-content">
                        <h1 class="slide-title">تعلم مع أفضل المدربين</h1>
                        <p class="slide-description">
                            استفد من خبرة مدربين متخصصين في مجالاتهم مع منهجيات تعليمية حديثة
                            مصممة لتحقيق أقصى استفادة وتطوير مهاراتك العملية
                        </p>
                        <div class="slide-buttons">
                            <a href="{{ route('instructors') }}" class="slide-btn slide-btn-primary">
                                <i class="bi bi-person-workspace"></i>
                                تعرف على المدربين
                            </a>
                            <a href="{{ route('courses') }}" class="slide-btn slide-btn-secondary">
                                <i class="bi bi-book"></i>
                                استكشف الدورات
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Slide 3 -->
                <div class="swiper-slide slide-3">
                    <div class="slide-content">
                        <h1 class="slide-title">طور مهاراتك المستقبلية</h1>
                        <p class="slide-description">
                            اكتشف أحدث التقنيات والمهارات المطلوبة في سوق العمل
                            مع دورات مصممة لمواكبة التطورات العالمية
                        </p>
                        <div class="slide-buttons">
                            <a href="{{ route('courses') }}" class="slide-btn slide-btn-primary">
                                <i class="bi bi-rocket"></i>
                                ابدأ رحلتك
                            </a>
                            <a href="{{ route('about') }}" class="slide-btn slide-btn-secondary">
                                <i class="bi bi-info-circle"></i>
                                تعرف علينا
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Navigation Arrows -->
            <div class="swiper-button-next">
                <i class="bi bi-chevron-left"></i>
            </div>
            <div class="swiper-button-prev">
                <i class="bi bi-chevron-right"></i>
            </div>
            
            <!-- Pagination -->
            <div class="swiper-pagination"></div>
        </div>
    </section>

<!-- Stats Section -->
<section class="stats">
    <div class="container">
        <div class="stats-grid">
            <div class="stat-item fade-in">
                <div class="stat-icon">
                    <i class="bi bi-book"></i>
                </div>
                <div class="stat-number">{{ $stats['total_courses'] }}+</div>
                <div class="stat-label">دورة تدريبية</div>
            </div>
            <div class="stat-item fade-in">
                <div class="stat-icon">
                    <i class="bi bi-people"></i>
                </div>
                <div class="stat-number">{{ $stats['total_students'] }}+</div>
                <div class="stat-label">طالب مسجل</div>
            </div>
            <div class="stat-item fade-in">
                <div class="stat-icon">
                    <i class="bi bi-person-workspace"></i>
                </div>
                <div class="stat-number">{{ $stats['total_instructors'] }}+</div>
                <div class="stat-label">مدرب متخصص</div>
            </div>
            <div class="stat-item fade-in">
                <div class="stat-icon">
                    <i class="bi bi-award"></i>
                </div>
                <div class="stat-number">{{ $stats['total_graduates'] }}+</div>
                <div class="stat-label">خريج متميز</div>
            </div>
        </div>
    </div>
</section>

<!-- Categories Section -->
<section class="categories-section">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h2 class="section-title">أقسام الأكاديمية</h2>
            <p class="section-subtitle">اكتشف مجموعة متنوعة من الأقسام التخصصية المصممة لتطوير مهاراتك وتوسيع آفاقك المهنية</p>
        </div>
        
        <div class="categories-grid">
            <!-- قسم البرمجة وتطوير المواقع -->
            <div class="category-card">
                <div class="category-icon">
                    <i class="bi bi-code-slash"></i>
                </div>
                <h3>البرمجة وتطوير المواقع</h3>
                <p>تعلم أحدث تقنيات البرمجة وتطوير المواقع الإلكترونية والتطبيقات</p>
                <div class="category-tags">
                    <span class="tag">Laravel</span>
                    <span class="tag">React</span>
                    <span class="tag">Python</span>
                </div>
                <a href="{{ route('courses') }}?category=programming" class="category-link">
                    استكشف القسم <i class="bi bi-arrow-right"></i>
                </a>
            </div>

            <!-- قسم الإدارة والقيادة -->
            <div class="category-card">
                <div class="category-icon">
                    <i class="bi bi-people"></i>
                </div>
                <h3>الإدارة والقيادة</h3>
                <p>طور مهاراتك القيادية والإدارية مع دورات متخصصة في إدارة المشاريع</p>
                <div class="category-tags">
                    <span class="tag">إدارة المشاريع</span>
                    <span class="tag">القيادة الفعالة</span>
                    <span class="tag">التخطيط الاستراتيجي</span>
                </div>
                <a href="{{ route('courses') }}?category=management" class="category-link">
                    استكشف القسم <i class="bi bi-arrow-right"></i>
                </a>
            </div>

            <!-- قسم اللغات الأجنبية -->
            <div class="category-card">
                <div class="category-icon">
                    <i class="bi bi-translate"></i>
                </div>
                <h3>اللغات الأجنبية</h3>
                <p>تعلم اللغات الأجنبية مع أفضل المدربين وأحدث الطرق التعليمية</p>
                <div class="category-tags">
                    <span class="tag">الإنجليزية</span>
                    <span class="tag">الفرنسية</span>
                    <span class="tag">الألمانية</span>
                </div>
                <a href="{{ route('courses') }}?category=languages" class="category-link">
                    استكشف القسم <i class="bi bi-arrow-right"></i>
                </a>
            </div>

            <!-- قسم التقنية والذكاء الاصطناعي -->
            <div class="category-card">
                <div class="category-icon">
                    <i class="bi bi-cpu"></i>
                </div>
                <h3>التقنية والذكاء الاصطناعي</h3>
                <p>اكتشف عالم الذكاء الاصطناعي والتعلم الآلي وعلوم البيانات</p>
                <div class="category-tags">
                    <span class="tag">Machine Learning</span>
                    <span class="tag">Data Science</span>
                    <span class="tag">Deep Learning</span>
                </div>
                <a href="{{ route('courses') }}?category=ai-tech" class="category-link">
                    استكشف القسم <i class="bi bi-arrow-right"></i>
                </a>
            </div>

            <!-- قسم دورات الأطفال -->
            <div class="category-card">
                <div class="category-icon">
                    <i class="bi bi-emoji-smile"></i>
                </div>
                <h3>دورات الأطفال</h3>
                <p>برامج تعليمية مخصصة للأطفال تطور مهاراتهم الإبداعية والذهنية</p>
                <div class="category-tags">
                    <span class="tag">البرمجة للأطفال</span>
                    <span class="tag">الرسم والفنون</span>
                    <span class="tag">الرياضيات التفاعلية</span>
                </div>
                <a href="{{ route('courses') }}?category=kids" class="category-link">
                    استكشف القسم <i class="bi bi-arrow-right"></i>
                </a>
            </div>

            <!-- قسم التسويق الرقمي -->
            <div class="category-card">
                <div class="category-icon">
                    <i class="bi bi-megaphone"></i>
                </div>
                <h3>التسويق الرقمي</h3>
                <p>تعلم استراتيجيات التسويق الرقمي الحديثة وإدارة وسائل التواصل</p>
                <div class="category-tags">
                    <span class="tag">Social Media Marketing</span>
                    <span class="tag">SEO & SEM</span>
                    <span class="tag">Content Marketing</span>
                </div>
                <a href="{{ route('courses') }}?category=digital-marketing" class="category-link">
                    استكشف القسم <i class="bi bi-arrow-right"></i>
                </a>
            </div>

            <!-- قسم تصميم الجرافيك -->
            <div class="category-card">
                <div class="category-icon">
                    <i class="bi bi-palette"></i>
                </div>
                <h3>تصميم الجرافيك والوسائط</h3>
                <p>طور مهاراتك في التصميم الجرافيكي والوسائط المتعددة</p>
                <div class="category-tags">
                    <span class="tag">Adobe Photoshop</span>
                    <span class="tag">Adobe Illustrator</span>
                    <span class="tag">UI/UX Design</span>
                </div>
                <a href="{{ route('courses') }}?category=graphic-design" class="category-link">
                    استكشف القسم <i class="bi bi-arrow-right"></i>
                </a>
            </div>

            <!-- قسم الأعمال والريادة -->
            <div class="category-card">
                <div class="category-icon">
                    <i class="bi bi-briefcase"></i>
                </div>
                <h3>الأعمال والريادة</h3>
                <p>تعلم أساسيات إدارة الأعمال والريادة وبناء المشاريع الناجحة</p>
                <div class="category-tags">
                    <span class="tag">ريادة الأعمال</span>
                    <span class="tag">إدارة الأعمال</span>
                    <span class="tag">التخطيط المالي</span>
                </div>
                <a href="{{ route('courses') }}?category=business" class="category-link">
                    استكشف القسم <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
        
        <div class="text-center mt-5">
            <a href="{{ route('courses') }}" class="btn btn-primary btn-lg">
                عرض جميع الأقسام والدورات <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>
</section>
                        <div class="category-info">

        </div>
    </div>
</section>

<!-- Featured Courses Section -->
@if($featuredCourses->count() > 0)
<section class="featured-courses-section">
    <div class="container">
        <div class="section-header text-center mb-5">
            <div class="section-badge">
                <i class="bi bi-star-fill"></i>
                <span>الدورات المميزة</span>
            </div>
            <h2 class="section-title">اكتشف أفضل دوراتنا التدريبية</h2>
            <p class="section-subtitle">دورات مختارة بعناية من خبراء متخصصين لتطوير مهاراتك وبناء مستقبلك المهني</p>
        </div>
        
        <div class="courses-grid">
            @foreach($featuredCourses as $course)
                <div class="course-card">
                    <div class="course-image-wrapper">
                        <div class="course-image">
                            @if($course->thumbnail)
                                <img src="{{ $course->thumbnail_url }}" alt="{{ $course->title }}">
                            @else
                                <img src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80" alt="{{ $course->title }}">
                            @endif
                            <div class="course-overlay">
                                <div class="course-overlay-content">
                                    <a href="{{ route('courses.show', $course->slug) }}" class="preview-btn">
                                        <i class="bi bi-play-circle"></i>
                                        معاينة الدورة
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="course-badges">
                            @if($course->is_featured)
                                <div class="badge featured-badge">
                                    <i class="bi bi-star-fill"></i>
                                    مميزة
                                </div>
                            @endif
                            <div class="badge price-badge">
                                @if($course->is_free)
                                    <i class="bi bi-gift"></i>
                                    مجاني
                                @else
                                    <i class="bi bi-currency-dollar"></i>
                                    {{ number_format($course->final_price, 0) }} ريال
                                @endif
                            </div>
                        </div>
                        
                        <div class="course-category">
                            <i class="bi bi-folder"></i>
                            {{ $course->category->name }}
                        </div>
                    </div>
                    
                    <div class="course-content">
                        <div class="course-header">
                            <h3 class="course-title">{{ $course->title }}</h3>
                            <div class="course-rating">
                                <div class="stars">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="bi bi-star{{ $i <= $course->rating ? '-fill' : '' }}"></i>
                                    @endfor
                                </div>
                                <span class="rating-text">{{ $course->rating }}/5</span>
                            </div>
                        </div>
                        
                        <p class="course-description">{{ Str::limit($course->description, 100) }}</p>
                        
                        <div class="course-stats">
                            <div class="stat-item">
                                <i class="bi bi-clock"></i>
                                <span>{{ $course->duration ?? '8 ساعات' }}</span>
                            </div>
                            <div class="stat-item">
                                <i class="bi bi-people"></i>
                                <span>{{ $course->students_count ?? '150+' }} طالب</span>
                            </div>
                            <div class="stat-item">
                                <i class="bi bi-collection-play"></i>
                                <span>{{ $course->lessons_count ?? '12' }} درس</span>
                            </div>
                        </div>
                        
                        <div class="course-footer">
                            <div class="course-instructor">
                                <div class="instructor-avatar">
                                    @if($course->instructor->avatar)
                                        <img src="{{ $course->instructor->avatar_url }}" alt="{{ $course->instructor->name }}">
                                    @else
                                        <span>{{ substr($course->instructor->name, 0, 1) }}</span>
                                    @endif
                                </div>
                                <div class="instructor-info">
                                    <span class="instructor-name">{{ $course->instructor->name }}</span>
                                    <span class="instructor-title">مدرب متخصص</span>
                                </div>
                            </div>
                            
                            <div class="course-actions">
                                <a href="{{ route('courses.show', $course->slug) }}" class="course-btn primary">
                                    <i class="bi bi-eye"></i>
                                    عرض الدورة
                                </a>
                                <button class="course-btn secondary" onclick="addToWishlist({{ $course->id }})">
                                    <i class="bi bi-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="courses-cta">
            <div class="cta-content">
                <h3>هل تريد المزيد من الدورات؟</h3>
                <p>اكتشف مكتبتنا الكاملة من الدورات التدريبية المتخصصة</p>
                <a href="{{ route('courses') }}" class="cta-btn">
                    <span>تصفح جميع الدورات</span>
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</section>
@endif

<style>
/* Categories Section Styles */
.categories-section {
    padding: 80px 0;
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
}

.categories-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 30px;
    margin-bottom: 40px;
}

.category-card {
    background: white;
    border-radius: 15px;
    padding: 30px;
    text-align: center;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    border: 1px solid #e2e8f0;
}

.category-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    border-color: #10b981;
}

.category-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #10b981, #059669);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
    color: white;
    font-size: 2rem;
    transition: all 0.3s ease;
}

.category-card:hover .category-icon {
    transform: scale(1.1);
}

.category-card h3 {
    font-size: 1.3rem;
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 15px;
}

.category-card p {
    color: #6b7280;
    line-height: 1.6;
    margin-bottom: 20px;
}

.category-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    justify-content: center;
    margin-bottom: 20px;
}

.tag {
    background: #f3f4f6;
    color: #374151;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 500;
}

.category-link {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: #10b981;
    color: white;
    padding: 10px 20px;
    border-radius: 25px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
}

.category-link:hover {
    background: #059669;
    transform: translateY(-2px);
    color: white;
}

/* Featured Courses Section Styles */
.featured-courses-section {
    padding: 100px 0;
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    position: relative;
}

.featured-courses-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="rgba(16,185,129,0.1)" stroke-width="0.5"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
    opacity: 0.3;
    z-index: 1;
}

.featured-courses-section .container {
    position: relative;
    z-index: 2;
}

.section-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
    padding: 8px 16px;
    border-radius: 25px;
    font-size: 0.9rem;
    font-weight: 600;
    margin-bottom: 20px;
    box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
}

.section-badge i {
    color: #fbbf24;
}

.courses-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(380px, 1fr));
    gap: 30px;
    margin-bottom: 60px;
}

.course-card {
    background: white;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
    transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    border: 1px solid rgba(255, 255, 255, 0.2);
    position: relative;
    backdrop-filter: blur(10px);
}

.course-card:hover {
    transform: translateY(-10px) scale(1.02);
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
    border-color: #10b981;
}

.course-image-wrapper {
    position: relative;
    overflow: hidden;
}

.course-image {
    height: 220px;
    position: relative;
    overflow: hidden;
}

.course-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

.course-card:hover .course-image img {
    transform: scale(1.1);
}

.course-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(16, 185, 129, 0.9), rgba(5, 150, 105, 0.9));
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: all 0.4s ease;
}

.course-card:hover .course-overlay {
    opacity: 1;
}

.preview-btn {
    display: flex;
    align-items: center;
    gap: 10px;
    background: white;
    color: #10b981;
    padding: 12px 24px;
    border-radius: 30px;
    text-decoration: none;
    font-weight: 600;
    font-size: 0.9rem;
    transition: all 0.3s ease;
    transform: translateY(20px);
    opacity: 0;
}

.course-card:hover .preview-btn {
    transform: translateY(0);
    opacity: 1;
}

.preview-btn:hover {
    background: #f8fafc;
    transform: translateY(-2px);
}

.course-badges {
    position: absolute;
    top: 15px;
    left: 15px;
    display: flex;
    flex-direction: column;
    gap: 8px;
    z-index: 2;
}

.badge {
    display: flex;
    align-items: center;
    gap: 5px;
    padding: 6px 12px;
    border-radius: 15px;
    font-size: 0.8rem;
    font-weight: 600;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.featured-badge {
    background: rgba(251, 191, 36, 0.9);
    color: #1f2937;
}

.price-badge {
    background: rgba(16, 185, 129, 0.9);
    color: white;
}

.course-category {
    position: absolute;
    top: 15px;
    right: 15px;
    background: rgba(0, 0, 0, 0.7);
    color: white;
    padding: 6px 12px;
    border-radius: 15px;
    font-size: 0.8rem;
    font-weight: 500;
    backdrop-filter: blur(10px);
    z-index: 2;
}

.course-content {
    padding: 30px;
}

.course-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 15px;
}

.course-title {
    font-size: 1.3rem;
    font-weight: 700;
    color: #1f2937;
    line-height: 1.4;
    flex: 1;
    margin: 0;
}

.course-rating {
    display: flex;
    align-items: center;
    gap: 8px;
    flex-shrink: 0;
}

.stars {
    display: flex;
    gap: 2px;
}

.stars i {
    color: #fbbf24;
    font-size: 0.9rem;
}

.rating-text {
    font-size: 0.8rem;
    color: #6b7280;
    font-weight: 600;
}

.course-description {
    color: #6b7280;
    line-height: 1.6;
    margin-bottom: 20px;
    font-size: 0.9rem;
}

.course-stats {
    display: flex;
    gap: 20px;
    margin-bottom: 25px;
    padding: 15px;
    background: #f8fafc;
    border-radius: 12px;
    border: 1px solid #e2e8f0;
}

.stat-item {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 0.8rem;
    color: #6b7280;
    font-weight: 500;
}

.stat-item i {
    color: #10b981;
    font-size: 0.9rem;
}

.course-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 20px;
    border-top: 1px solid #e2e8f0;
}

.course-instructor {
    display: flex;
    align-items: center;
    gap: 12px;
}

.instructor-avatar {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    overflow: hidden;
    background: linear-gradient(135deg, #10b981, #059669);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 700;
    font-size: 1rem;
    border: 2px solid #e2e8f0;
}

.instructor-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.instructor-info {
    display: flex;
    flex-direction: column;
    gap: 2px;
}

.instructor-name {
    font-size: 0.9rem;
    font-weight: 600;
    color: #1f2937;
}

.instructor-title {
    font-size: 0.8rem;
    color: #6b7280;
}

.course-actions {
    display: flex;
    gap: 10px;
}

.course-btn {
    display: flex;
    align-items: center;
    gap: 6px;
    padding: 10px 16px;
    border-radius: 25px;
    text-decoration: none;
    font-weight: 600;
    font-size: 0.9rem;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
}

.course-btn.primary {
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
}

.course-btn.primary:hover {
    background: linear-gradient(135deg, #059669, #047857);
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3);
}

.course-btn.secondary {
    background: #f3f4f6;
    color: #6b7280;
    padding: 10px;
    border: 1px solid #e2e8f0;
}

.course-btn.secondary:hover {
    background: #e5e7eb;
    color: #374151;
    transform: translateY(-2px);
}

.courses-cta {
    background: linear-gradient(135deg, #10b981, #059669);
    border-radius: 20px;
    padding: 50px;
    text-align: center;
    color: white;
    position: relative;
    overflow: hidden;
}

.courses-cta::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="dots" width="10" height="10" patternUnits="userSpaceOnUse"><circle cx="5" cy="5" r="1" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23dots)"/></svg>');
    opacity: 0.3;
}

.cta-content {
    position: relative;
    z-index: 2;
}

.cta-content h3 {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 15px;
}

.cta-content p {
    font-size: 1.1rem;
    margin-bottom: 30px;
    opacity: 0.9;
}

.cta-btn {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: white;
    color: #10b981;
    padding: 15px 30px;
    border-radius: 30px;
    text-decoration: none;
    font-weight: 600;
    font-size: 1rem;
    transition: all 0.3s ease;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
}

.cta-btn:hover {
    background: #f8fafc;
    transform: translateY(-3px);
    box-shadow: 0 12px 35px rgba(0, 0, 0, 0.15);
    color: #059669;
}

/* Responsive Design for Featured Courses */
@media (max-width: 1200px) {
    .courses-grid {
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 25px;
    }
    
    .course-stats {
        flex-direction: column;
        gap: 10px;
    }
}

@media (max-width: 768px) {
    .featured-courses-section {
        padding: 60px 0;
    }
    
    .courses-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .course-card {
        border-radius: 15px;
    }
    
    .course-content {
        padding: 20px;
    }
    
    .course-title {
        font-size: 1.1rem;
    }
    
    .course-stats {
        flex-direction: row;
        flex-wrap: wrap;
        gap: 15px;
    }
    
    .course-footer {
        flex-direction: column;
        gap: 15px;
        align-items: stretch;
    }
    
    .course-actions {
        justify-content: center;
    }
    
    .courses-cta {
        padding: 30px 20px;
    }
    
    .cta-content h3 {
        font-size: 1.5rem;
    }
    
    .cta-content p {
        font-size: 1rem;
    }
}

@media (max-width: 480px) {
    .course-image {
        height: 180px;
    }
    
    .course-badges {
        top: 10px;
        left: 10px;
    }
    
    .course-category {
        top: 10px;
        right: 10px;
    }
    
    .course-stats {
        padding: 10px;
    }
    
    .stat-item {
        font-size: 0.75rem;
    }
    
    .instructor-avatar {
        width: 35px;
        height: 35px;
        font-size: 0.8rem;
    }
    
    .course-btn {
        padding: 8px 12px;
        font-size: 0.8rem;
    }
}



/* Responsive Design */
@media (max-width: 768px) {
    .categories-grid,
    .courses-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .category-card,
    .course-card {
        padding: 20px;
    }
    
    .category-icon {
        width: 60px;
        height: 60px;
        font-size: 1.5rem;
    }
    
    .course-image {
        height: 150px;
    }
}

@media (max-width: 480px) {
    .categories-section,
    .featured-courses-section {
        padding: 60px 0;
    }
    
    .category-card h3 {
        font-size: 1.1rem;
    }
    
    .course-title {
        font-size: 1.1rem;
    }
}
</style>

<!-- Testimonials Section -->
<section class="testimonials">
    <div class="container">
        <div class="section-title">
            <h2 style="color: white;">آراء طلابنا</h2>
            <p style="color: #d1d5db;">استمع إلى تجارب طلابنا المتميزين في أكاديمية السهم الأخضر</p>
        </div>
        
        <div class="testimonials-grid">
            <div class="testimonial-card slide-in-left">
                <div class="testimonial-avatar">أ</div>
                <div class="testimonial-text">
                    "تجربة رائعة في أكاديمية السهم الأخضر! المدربين متخصصون والمحتوى ممتاز. استفدت كثيراً من دورة البرمجة"
                </div>
                <div class="testimonial-author">أحمد محمد</div>
                <div class="testimonial-position">مطور ويب</div>
            </div>
            
            <div class="testimonial-card fade-in">
                <div class="testimonial-avatar">ف</div>
                <div class="testimonial-text">
                    "أفضل أكاديمية تدريب في مكة! الدورات منظمة والمدربين خبراء في مجالاتهم"
                </div>
                <div class="testimonial-author">فاطمة علي</div>
                <div class="testimonial-position">مديرة مشاريع</div>
            </div>
            
            <div class="testimonial-card slide-in-right">
                <div class="testimonial-avatar">م</div>
                <div class="testimonial-text">
                    "شهادتي من الأكاديمية ساعدتني في الحصول على وظيفة ممتازة. شكراً لكم!"
                </div>
                <div class="testimonial-author">محمد عبدالله</div>
                <div class="testimonial-position">محلل بيانات</div>
            </div>
        </div>
    </div>
</section>

<!-- Blog Section -->
@if($latestPosts->count() > 0)
<section class="blog-section">
    <div class="container">
        <div class="section-title">
            <h2>آخر المقالات</h2>
            <p>اطلع على أحدث المقالات والنصائح التعليمية من خبرائنا</p>
        </div>
        
        <div class="blog-grid">
            @foreach($latestPosts as $post)
            <div class="blog-card scale-in">
                <div class="blog-image">
                    <img src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80" alt="{{ $post->title }}">
                </div>
                <div class="blog-content">
                    <h3 class="blog-title">{{ $post->title }}</h3>
                    <p class="blog-excerpt">{{ Str::limit($post->excerpt, 120) }}</p>
                    <div class="blog-meta">
                        <span><i class="bi bi-person"></i> {{ $post->author->name }}</span>
                        <span><i class="bi bi-calendar"></i> {{ $post->published_at->format('Y/m/d') }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="text-center mt-5">
            <a href="{{ route('blog') }}" class="btn btn-primary btn-lg">
                <i class="bi bi-arrow-left"></i>
                عرض جميع المقالات
            </a>
        </div>
    </div>
</section>
@endif

<!-- FAQ Section -->
<section class="faq-section">
    <div class="container">
        <div class="section-title">
            <h2>الأسئلة المتداولة</h2>
            <p>هل لديك شيء تود معرفته؟ تحقق هنا إذا كان لديك أي أسئلة عنا</p>
        </div>
        
        <div class="faq-container">
            <div class="faq-item" data-faq="1">
                <div class="faq-question">
                    <h3>كيف يمكنني التسجيل في الدورات التدريبية؟</h3>
                    <div class="faq-icon">
                        <i class="bi bi-plus-lg"></i>
                    </div>
                </div>
                <div class="faq-answer">
                    <p>يمكنك التسجيل بسهولة من خلال إنشاء حساب جديد على موقعنا، ثم تصفح الدورات المتاحة واختيار الدورة المناسبة لك. يمكنك أيضاً التواصل معنا عبر الهاتف أو الواتساب للمساعدة في التسجيل.</p>
                </div>
            </div>
            
            <div class="faq-item" data-faq="2">
                <div class="faq-question">
                    <h3>هل الدورات متاحة أونلاين أم حضورية؟</h3>
                    <div class="faq-icon">
                        <i class="bi bi-plus-lg"></i>
                    </div>
                </div>
                <div class="faq-answer">
                    <p>نقدم كلا النوعين من الدورات. لدينا دورات حضورية في مقر الأكاديمية بمكة المكرمة، ودورات أونلاين يمكنك حضورها من أي مكان. يمكنك اختيار النوع المناسب لك حسب جدولك وموقعك.</p>
                </div>
            </div>
            
            <div class="faq-item" data-faq="3">
                <div class="faq-question">
                    <h3>ما هي شروط الحصول على شهادة معتمدة؟</h3>
                    <div class="faq-icon">
                        <i class="bi bi-plus-lg"></i>
                    </div>
                </div>
                <div class="faq-answer">
                    <p>للحصول على شهادة معتمدة، يجب عليك حضور 80% على الأقل من الدورة التدريبية، وإكمال جميع المهام والاختبارات المطلوبة، والحصول على درجة لا تقل عن 70% في التقييم النهائي.</p>
                </div>
            </div>
            
            <div class="faq-item" data-faq="4">
                <div class="faq-question">
                    <h3>هل يمكنني إلغاء أو تغيير موعد الدورة؟</h3>
                    <div class="faq-icon">
                        <i class="bi bi-plus-lg"></i>
                    </div>
                </div>
                <div class="faq-answer">
                    <p>نعم، يمكنك إلغاء أو تغيير موعد الدورة قبل أسبوع من بدايتها. في حالات الطوارئ، يمكن التواصل معنا مباشرة وستتم معالجة طلبك في أقرب وقت ممكن.</p>
                </div>
            </div>
            
            <div class="faq-item" data-faq="5">
                <div class="faq-question">
                    <h3>ما هي طرق الدفع المتاحة؟</h3>
                    <div class="faq-icon">
                        <i class="bi bi-plus-lg"></i>
                    </div>
                </div>
                <div class="faq-answer">
                    <p>نقبل جميع طرق الدفع: البطاقات الائتمانية، التحويل البنكي، الدفع النقدي في مقر الأكاديمية، والدفع عبر المحافظ الإلكترونية. كما نقدم خيارات تقسيط للدورات طويلة المدى.</p>
                </div>
            </div>
            
            <div class="faq-item" data-faq="6">
                <div class="faq-question">
                    <h3>هل تقدمون دورات مجانية؟</h3>
                    <div class="faq-icon">
                        <i class="bi bi-plus-lg"></i>
                    </div>
                </div>
                <div class="faq-answer">
                    <p>نعم، نقدم مجموعة من الدورات المجانية كجزء من مسؤوليتنا المجتمعية. هذه الدورات تغطي أساسيات البرمجة واللغات والمهارات الأساسية. يمكنك تصفحها في قسم "الدورات المجانية".</p>
                </div>
            </div>
            
            <div class="faq-item" data-faq="7">
                <div class="faq-question">
                    <h3>كيف يمكنني التواصل مع المدربين؟</h3>
                    <div class="faq-icon">
                        <i class="bi bi-plus-lg"></i>
                    </div>
                </div>
                <div class="faq-answer">
                    <p>يمكنك التواصل مع المدربين من خلال منصة التعلم الخاصة بنا، أو عبر البريد الإلكتروني، أو خلال ساعات العمل المكتبية. كما نوفر مجموعات واتساب لكل دورة للتواصل المباشر.</p>
                </div>
            </div>
            
            <div class="faq-item" data-faq="8">
                <div class="faq-question">
                    <h3>هل تقدمون دورات للأطفال؟</h3>
                    <div class="faq-icon">
                        <i class="bi bi-plus-lg"></i>
                    </div>
                </div>
                <div class="faq-answer">
                    <p>نعم، لدينا برامج تعليمية مخصصة للأطفال من سن 7 سنوات فما فوق. هذه الدورات مصممة بطريقة تفاعلية وممتعة لتنمية مهاراتهم الإبداعية والتقنية.</p>
                </div>
            </div>
        </div>
        
        <div class="faq-cta">
            <p>لم تجد إجابة لسؤالك؟</p>
            <a href="{{ route('contact') }}" class="faq-contact-btn">
                <i class="bi bi-chat-dots"></i>
                تواصل معنا
            </a>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="container">
        <div class="cta-content">
            <h2 class="cta-title">ابدأ رحلة التعلم معنا اليوم</h2>
            <p class="cta-description">
                انضم إلى آلاف الطلاب الذين طوروا مهاراتهم وحققوا أحلامهم المهنية من خلال دوراتنا المتميزة
            </p>
            <div class="cta-buttons">
                <a href="{{ route('register.page') }}" class="cta-btn cta-btn-primary">
                    <i class="bi bi-person-plus"></i>
                    سجل الآن
                </a>
                <a href="{{ route('contact') }}" class="cta-btn cta-btn-secondary">
                    <i class="bi bi-telephone"></i>
                    اتصل بنا
                </a>
            </div>
        </div>
    </div>
</section>

    </div> <!-- End of main-content-area -->
    
    <!-- WhatsApp Float Button -->
    <div class="whatsapp-float" style="display: block !important; visibility: visible !important; opacity: 1 !important;">
        <a href="https://wa.me/{{ str_replace(['+', ' ', '-'], '', setting('site_whatsapp', '966508260274')) }}" target="_blank" aria-label="تواصل معنا عبر واتساب" style="display: flex !important;">
            <i class="bi bi-whatsapp"></i>
        </a>
    </div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<script>
// Initialize Swiper
const swiper = new Swiper('.swiper', {
    // Optional parameters
    direction: 'horizontal',
    loop: true,
    autoplay: {
        delay: 3000, // تغيير كل 3 ثواني
        disableOnInteraction: false,
    },
    effect: 'fade',
    fadeEffect: {
        crossFade: true
    },
    
    // Navigation arrows
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    
    // Pagination
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    
    // Responsive breakpoints
    breakpoints: {
        640: {
            slidesPerView: 1,
        },
        768: {
            slidesPerView: 1,
        },
        1024: {
            slidesPerView: 1,
        },
    }
});

// Intersection Observer for animations
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('visible');
        }
    });
}, observerOptions);

// Observe all animated elements
document.addEventListener('DOMContentLoaded', function() {
    const animatedElements = document.querySelectorAll('.fade-in, .slide-in-left, .slide-in-right, .scale-in');
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
    
    // Add loading animation
    document.body.classList.add('loaded');
    
    // Enhanced animations for Saudi Arabian students
    const culturalElements = document.querySelectorAll('.stat-item, .category-card, .course-card');
    culturalElements.forEach((el, index) => {
        el.style.animationDelay = `${index * 0.1}s`;
        el.classList.add('fade-in');
    });
    
    // Add hover effects for better interactivity
    const interactiveElements = document.querySelectorAll('.slide-btn, .course-btn, .cta-btn');
    interactiveElements.forEach(el => {
        el.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px) scale(1.05)';
        });
        
        el.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });
    
    // Enhanced WhatsApp button functionality
    const whatsappButton = document.querySelector('.whatsapp-float a');
    console.log('WhatsApp button found:', whatsappButton);
    if (whatsappButton) {
        console.log('WhatsApp button href:', whatsappButton.href);
        // Add click tracking
        whatsappButton.addEventListener('click', function() {
            // You can add analytics tracking here
            console.log('WhatsApp button clicked');
        });
        
        // Add pulse effect on page load
        setTimeout(() => {
            whatsappButton.style.animation = 'pulse 2s infinite';
        }, 3000);
        
        // Remove pulse after first interaction
        whatsappButton.addEventListener('mouseenter', function() {
            this.style.animation = 'none';
        });
    } else {
        console.error('WhatsApp button not found!');
    }
});

// Parallax effect for hero slider
window.addEventListener('scroll', function() {
    const scrolled = window.pageYOffset;
    const parallax = document.querySelector('.hero-slider');
    if (parallax) {
        const speed = scrolled * 0.3;
        parallax.style.transform = `translateY(${speed}px)`;
    }
});


    const tags = document.querySelectorAll('.tag');
    tags.forEach(tag => {
        tag.addEventListener('mouseenter', function() {
            this.style.animation = 'pulse 0.6s ease-in-out';
        });
        
        tag.addEventListener('animationend', function() {
            this.style.animation = '';
        });
    });
    
    // Add ripple effect to explore buttons
    const exploreButtons = document.querySelectorAll('.explore-btn');
    exploreButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            const ripple = document.createElement('span');
            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = e.clientX - rect.left - size / 2;
            const y = e.clientY - rect.top - size / 2;
            
            ripple.style.cssText = `
                position: absolute;
                width: ${size}px;
                height: ${size}px;
                left: ${x}px;
                top: ${y}px;
                background: rgba(255, 255, 255, 0.3);
                border-radius: 50%;
                transform: scale(0);
                animation: ripple 0.6s linear;
                pointer-events: none;
            `;
            
            this.appendChild(ripple);
            
            setTimeout(() => {
                ripple.remove();
            }, 600);
        });
    });
    
    // Add ripple animation
    const style = document.createElement('style');
    style.textContent = `
        @keyframes ripple {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
    `;
    document.head.appendChild(style);
});

// Legacy Categories Carousel Functionality (for backward compatibility)
document.addEventListener('DOMContentLoaded', function() {
    const carousel = document.getElementById('categoriesCarousel');
    const prevBtn = document.getElementById('carouselPrev');
    const nextBtn = document.getElementById('carouselNext');
    const dotsContainer = document.getElementById('carouselDots');
    
    if (!carousel) return;
    
    const cards = carousel.querySelectorAll('.category-card');
    
    // Calculate cards per view based on screen size
    function getCardsPerView() {
        if (window.innerWidth <= 480) return 1;
        if (window.innerWidth <= 1024) return 2;
        return 3; // Desktop: 3 cards per view
    }
    
    function calculateCarouselDimensions() {
        cardsPerView = getCardsPerView();
        const containerWidth = carousel.offsetWidth;
        const gap = 30;
        cardWidth = (containerWidth - (gap * (cardsPerView - 1))) / cardsPerView;
        totalSlides = Math.ceil(cards.length / cardsPerView);
        
        // Update card widths
        cards.forEach(card => {
            card.style.width = `${cardWidth}px`;
        });
    }
    
    let cardsPerView = getCardsPerView();
    let cardWidth = 0;
    let totalSlides = 0;
    
    // Initialize dimensions
    calculateCarouselDimensions();
    
    let currentSlide = 0;
    let autoPlayInterval;
    let isInfinite = true; // Enable infinite loop
    
    // Create dots
    function createDots() {
        dotsContainer.innerHTML = '';
        for (let i = 0; i < totalSlides; i++) {
            const dot = document.createElement('div');
            dot.className = 'carousel-dot';
            dot.setAttribute('role', 'button');
            dot.setAttribute('tabindex', '0');
            dot.setAttribute('aria-label', `انتقل إلى القسم ${i + 1}`);
            
            if (i === 0) dot.classList.add('active');
            
            dot.addEventListener('click', () => {
                goToSlide(i);
                stopAutoPlay();
                startAutoPlay();
            });
            
            dot.addEventListener('keydown', (e) => {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    goToSlide(i);
                    stopAutoPlay();
                    startAutoPlay();
                }
            });
            
            dotsContainer.appendChild(dot);
        }
    }
    
    // Update dots
    function updateDots() {
        const dots = dotsContainer.querySelectorAll('.carousel-dot');
        dots.forEach((dot, index) => {
            dot.classList.toggle('active', index === currentSlide);
        });
    }
    
    // Go to specific slide
    function goToSlide(slideIndex) {
        currentSlide = slideIndex;
        const gap = 30;
        const slideWidth = (cardWidth + gap) * cardsPerView;
        const translateX = -currentSlide * slideWidth;
        carousel.style.transform = `translateX(${translateX}px)`;
        updateDots();
        
        // Add pulse animation to current card
        const categoryCards = carousel.querySelectorAll('.category-card');
        categoryCards.forEach((card, index) => {
            card.style.transform = 'scale(1)';
            card.style.boxShadow = 'var(--shadow-lg)';
        });
        
        const currentCard = categoryCards[slideIndex];
        if (currentCard) {
            currentCard.style.transform = 'scale(1.02)';
            currentCard.style.boxShadow = 'var(--shadow-2xl)';
            currentCard.style.transition = 'all 0.3s ease';
        }
    }
    
    // Next slide with infinite loop
    function nextSlide() {
        if (isInfinite) {
            currentSlide++;
            if (currentSlide >= totalSlides) {
                // Reset to beginning for infinite loop
                currentSlide = 0;
                carousel.style.transition = 'none';
                carousel.style.transform = `translateX(0px)`;
                setTimeout(() => {
                    carousel.style.transition = 'transform 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94)';
                }, 10);
            }
        } else {
            currentSlide = (currentSlide + 1) % totalSlides;
        }
        goToSlide(currentSlide);
    }
    
    // Previous slide
    function prevSlide() {
        currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
        goToSlide(currentSlide);
    }
    
    // Auto play - continuous movement to the right
    function startAutoPlay() {
        autoPlayInterval = setInterval(() => {
            nextSlide();
        }, 5000); // Move every 5 seconds for better user experience and reading time
    }
    
    function stopAutoPlay() {
        clearInterval(autoPlayInterval);
    }
    
    // Event listeners
    if (prevBtn) {
        prevBtn.addEventListener('click', () => {
            prevSlide();
            stopAutoPlay();
            startAutoPlay(); // Restart auto play
        });
    }
    
    if (nextBtn) {
        nextBtn.addEventListener('click', () => {
            nextSlide();
            stopAutoPlay();
            startAutoPlay(); // Restart auto play
        });
    }
    
    // Pause auto play on hover
    carousel.addEventListener('mouseenter', stopAutoPlay);
    carousel.addEventListener('mouseleave', startAutoPlay);
    
    // Pause auto play when user is not viewing the page
    document.addEventListener('visibilitychange', () => {
        if (document.hidden) {
            stopAutoPlay();
        } else {
            startAutoPlay();
        }
    });
    
    // Touch/swipe support for mobile
    let touchStartX = 0;
    let touchEndX = 0;
    
    carousel.addEventListener('touchstart', (e) => {
        touchStartX = e.changedTouches[0].screenX;
        stopAutoPlay();
    });
    
    carousel.addEventListener('touchend', (e) => {
        touchEndX = e.changedTouches[0].screenX;
        handleSwipe();
        startAutoPlay();
    });
    
    function handleSwipe() {
        const swipeThreshold = 50;
        if (touchEndX < touchStartX - swipeThreshold) {
            // Swipe left - next slide
            nextSlide();
        } else if (touchEndX > touchStartX + swipeThreshold) {
            // Swipe right - previous slide
            prevSlide();
        }
    }
    
    // Initialize carousel
    createDots();
    startAutoPlay();
    
    // Add keyboard navigation
    document.addEventListener('keydown', (e) => {
        if (e.key === 'ArrowLeft') {
            prevSlide();
            stopAutoPlay();
            startAutoPlay();
        } else if (e.key === 'ArrowRight') {
            nextSlide();
            stopAutoPlay();
            startAutoPlay();
        }
    });
    
    // Add smooth entrance animation for cards
    const categoryCards = carousel.querySelectorAll('.category-card');
    categoryCards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        
        setTimeout(() => {
            card.style.transition = 'all 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94)';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 150); // Increased delay for better visual effect
    });
    
    // Add loading indicator
    const loadingIndicator = document.createElement('div');
    loadingIndicator.style.cssText = `
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 50px;
        height: 50px;
        border: 4px solid rgba(16, 185, 129, 0.2);
        border-top: 4px solid var(--primary-color);
        border-radius: 50%;
        animation: spin 1s linear infinite;
        z-index: 10;
    `;
    
    carousel.parentElement.appendChild(loadingIndicator);
    
    // Remove loading indicator after animation
    setTimeout(() => {
        loadingIndicator.remove();
    }, categoryCards.length * 150 + 1000);
    
    // Update on window resize
    window.addEventListener('resize', () => {
        const newCardsPerView = getCardsPerView();
        if (newCardsPerView !== cardsPerView) {
            // Recalculate dimensions
            calculateCarouselDimensions();
            
            // Reset to first slide
            currentSlide = 0;
            goToSlide(0);
            
            // Recreate dots
            createDots();
        }
    });
    
    // Add intersection observer for performance
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                startAutoPlay();
            } else {
                stopAutoPlay();
            }
        });
    }, { threshold: 0.3 });
    
    observer.observe(carousel);
    
    // Add progress indicator
    const progressBar = document.createElement('div');
    progressBar.style.cssText = `
        position: absolute;
        bottom: 0;
        left: 0;
        height: 3px;
        background: linear-gradient(90deg, var(--primary-color), var(--primary-dark));
        width: 0%;
        transition: width 0.1s linear;
        z-index: 10;
        border-radius: 2px;
    `;
    
    carousel.parentElement.appendChild(progressBar);
    
    // Update progress bar
    function updateProgress() {
        const progress = ((currentSlide + 1) / totalSlides) * 100;
        progressBar.style.width = `${progress}%`;
    }
    
    // Update progress on slide change
    const originalGoToSlide = goToSlide;
    goToSlide = function(slideIndex) {
        originalGoToSlide(slideIndex);
        updateProgress();
    };
    
    // Initialize progress
    updateProgress();
});

// FAQ Functionality
document.addEventListener('DOMContentLoaded', function() {
    const faqItems = document.querySelectorAll('.faq-item');
    
    faqItems.forEach(item => {
        const question = item.querySelector('.faq-question');
        const answer = item.querySelector('.faq-answer');
        const icon = item.querySelector('.faq-icon i');
        
        question.addEventListener('click', function() {
            const isActive = item.classList.contains('active');
            
            // Close all other FAQ items
            faqItems.forEach(otherItem => {
                if (otherItem !== item) {
                    otherItem.classList.remove('active');
                    const otherAnswer = otherItem.querySelector('.faq-answer');
                    const otherIcon = otherItem.querySelector('.faq-icon i');
                    
                    // Reset other items
                    otherAnswer.style.maxHeight = '0';
                    otherIcon.style.transform = 'rotate(0deg)';
                }
            });
            
            // Toggle current item
            if (isActive) {
                item.classList.remove('active');
                answer.style.maxHeight = '0';
                icon.style.transform = 'rotate(0deg)';
            } else {
                item.classList.add('active');
                answer.style.maxHeight = answer.scrollHeight + 'px';
                icon.style.transform = 'rotate(45deg)';
                
                // Add entrance animation
                answer.style.animation = 'fadeInUp 0.4s ease-out';
            }
        });
        
        // Keyboard accessibility
        question.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                question.click();
            }
        });
        
        // Add hover effects
        item.addEventListener('mouseenter', function() {
            if (!item.classList.contains('active')) {
                item.style.transform = 'translateY(-2px)';
            }
        });
        
        item.addEventListener('mouseleave', function() {
            if (!item.classList.contains('active')) {
                item.style.transform = 'translateY(0)';
            }
        });
    });
    
    // Add smooth scroll to FAQ section when clicking on FAQ links
    document.querySelectorAll('a[href="#faq"]').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const faqSection = document.querySelector('.faq-section');
            if (faqSection) {
                faqSection.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
    
    // Add intersection observer for FAQ animations
    const faqObserver = new IntersectionObserver((entries) => {
        entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
                setTimeout(() => {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }, index * 100);
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    });
    
    // Observe FAQ items for animation
    faqItems.forEach(item => {
        item.style.opacity = '0';
        item.style.transform = 'translateY(30px)';
        item.style.transition = 'all 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94)';
        faqObserver.observe(item);
    });
    
    // Add FAQ search functionality (optional)
    const faqSearchInput = document.createElement('input');
    faqSearchInput.type = 'text';
    faqSearchInput.placeholder = 'ابحث في الأسئلة المتداولة...';
    faqSearchInput.className = 'faq-search-input';
    faqSearchInput.style.cssText = `
        width: 100%;
        max-width: 500px;
        padding: 15px 20px;
        border: 2px solid var(--border-color);
        border-radius: 25px;
        font-size: 1rem;
        margin-bottom: 30px;
        background: var(--bg-primary);
        transition: all 0.3s ease;
        outline: none;
    `;
    
    // Insert search input before FAQ container
    const faqContainer = document.querySelector('.faq-container');
    if (faqContainer) {
        faqContainer.parentNode.insertBefore(faqSearchInput, faqContainer);
        
        // Add search functionality
        faqSearchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            
            faqItems.forEach(item => {
                const question = item.querySelector('.faq-question h3').textContent.toLowerCase();
                const answer = item.querySelector('.faq-answer p').textContent.toLowerCase();
                
                if (question.includes(searchTerm) || answer.includes(searchTerm)) {
                    item.style.display = 'block';
                    item.style.opacity = '1';
                    item.style.transform = 'translateY(0)';
                } else {
                    item.style.display = 'none';
                    item.style.opacity = '0';
                    item.style.transform = 'translateY(20px)';
                }
            });
        });
        
        // Add focus styles
        faqSearchInput.addEventListener('focus', function() {
            this.style.borderColor = 'var(--primary-color)';
            this.style.boxShadow = '0 0 0 3px rgba(16, 185, 129, 0.1)';
        });
        
        faqSearchInput.addEventListener('blur', function() {
            this.style.borderColor = 'var(--border-color)';
            this.style.boxShadow = 'none';
        });
    }



    // Featured Courses Slider Functionality
    document.addEventListener('DOMContentLoaded', function() {
        const coursesSlider = document.getElementById('coursesSlider');
        const coursesTrack = document.getElementById('coursesTrack');
        const coursesPrevBtn = document.getElementById('coursesPrevBtn');
        const coursesNextBtn = document.getElementById('coursesNextBtn');
        
        if (!coursesSlider || !coursesTrack || !coursesPrevBtn || !coursesNextBtn) {
            console.log('Courses slider elements not found');
            return;
        }
        
        let coursesCurrentPosition = 0;
        const courseItems = coursesTrack.querySelectorAll('.course-card');
        const courseItemWidth = 350; // Width of each course card
        const courseGap = 20; // Gap between items
        const coursesItemsPerView = Math.floor(coursesSlider.offsetWidth / (courseItemWidth + courseGap));
        const coursesMaxPosition = Math.max(0, courseItems.length - coursesItemsPerView);
        
        // Function to update courses slider position
        function updateCoursesSliderPosition() {
            const translateX = -(coursesCurrentPosition * (courseItemWidth + courseGap));
            coursesTrack.style.transform = `translateX(${translateX}px)`;
            
            // Update button states
            coursesPrevBtn.disabled = coursesCurrentPosition === 0;
            coursesNextBtn.disabled = coursesCurrentPosition >= coursesMaxPosition;
        }
        
        // Next button click
        coursesNextBtn.addEventListener('click', function() {
            if (coursesCurrentPosition < coursesMaxPosition) {
                coursesCurrentPosition++;
                updateCoursesSliderPosition();
            }
        });
        
        // Previous button click
        coursesPrevBtn.addEventListener('click', function() {
            if (coursesCurrentPosition > 0) {
                coursesCurrentPosition--;
                updateCoursesSliderPosition();
            }
        });
        
        // Initialize courses slider
        updateCoursesSliderPosition();
        
        // Add smooth entrance animation for course items
        courseItems.forEach((item, index) => {
            item.style.opacity = '0';
            item.style.transform = 'translateY(30px)';
            
            setTimeout(() => {
                item.style.transition = 'all 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94)';
                item.style.opacity = '1';
                item.style.transform = 'translateY(0)';
            }, index * 150);
        });
        
        // Add keyboard navigation for courses
        document.addEventListener('keydown', function(e) {
            if (e.key === 'ArrowLeft' && e.ctrlKey) {
                e.preventDefault();
                coursesNextBtn.click();
            } else if (e.key === 'ArrowRight' && e.ctrlKey) {
                e.preventDefault();
                coursesPrevBtn.click();
            }
        });
        
        // Add touch/swipe support for courses
        let coursesTouchStartX = 0;
        let coursesTouchEndX = 0;
        
        coursesSlider.addEventListener('touchstart', function(e) {
            coursesTouchStartX = e.changedTouches[0].screenX;
        });
        
        coursesSlider.addEventListener('touchend', function(e) {
            coursesTouchEndX = e.changedTouches[0].screenX;
            handleCoursesSwipe();
        });
        
        function handleCoursesSwipe() {
            const swipeThreshold = 50;
            const diff = coursesTouchStartX - coursesTouchEndX;
            
            if (Math.abs(diff) > swipeThreshold) {
                if (diff > 0) {
                    // Swipe left - go next
                    coursesNextBtn.click();
                } else {
                    // Swipe right - go previous
                    coursesPrevBtn.click();
                }
            }
        }
    });

    // Featured Courses JavaScript
    function addToWishlist(courseId) {
        const btn = event.target.closest('.course-btn.secondary');
        const icon = btn.querySelector('i');
        
        if (icon.classList.contains('bi-heart')) {
            icon.classList.remove('bi-heart');
            icon.classList.add('bi-heart-fill');
            btn.style.color = '#ef4444';
            btn.style.background = '#fef2f2';
            btn.style.borderColor = '#fecaca';
            
            showNotification('تم إضافة الدورة إلى المفضلة', 'success');
        } else {
            icon.classList.remove('bi-heart-fill');
            icon.classList.add('bi-heart');
            btn.style.color = '#6b7280';
            btn.style.background = '#f3f4f6';
            btn.style.borderColor = '#e2e8f0';
            
            showNotification('تم إزالة الدورة من المفضلة', 'info');
        }
    }

    function showNotification(message, type = 'info') {
        const notification = document.createElement('div');
        notification.className = `notification notification-${type}`;
        notification.innerHTML = `
            <div class="notification-content">
                <i class="bi bi-${type === 'success' ? 'check-circle' : 'info-circle'}"></i>
                <span>${message}</span>
            </div>
        `;
        
        notification.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            background: ${type === 'success' ? '#10b981' : '#3b82f6'};
            color: white;
            padding: 15px 20px;
            border-radius: 10px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            z-index: 10000;
            transform: translateX(100%);
            transition: transform 0.3s ease;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
        `;
        
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.style.transform = 'translateX(0)';
        }, 100);
        
        setTimeout(() => {
            notification.style.transform = 'translateX(100%)';
            setTimeout(() => {
                document.body.removeChild(notification);
            }, 300);
        }, 3000);
    }

    // Course cards animation
    const courseCards = document.querySelectorAll('.course-card');
    
    const courseObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    });
    
    courseCards.forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        courseObserver.observe(card);
    });

});
</script>
@endpush 