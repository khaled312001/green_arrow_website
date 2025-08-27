<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Additional Meta Tags -->
    <meta name="author" content="{{ setting('site_author', 'أكاديمية السهم الأخضر للتدريب') }}">
    <meta name="robots" content="index, follow">
    <meta name="language" content="ar">
    <meta name="revisit-after" content="7 days">
    <meta name="distribution" content="global">
    <meta name="rating" content="general">
    <meta name="theme-color" content="#10b981">
    <meta name="msapplication-TileColor" content="#10b981">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="apple-mobile-web-app-title" content="{{ setting('site_name', 'أكاديمية السهم الأخضر') }}">
    
    <title>@yield('title', setting('site_title', 'أكاديمية السهم الأخضر للتدريب - مكة'))</title>
    <meta name="description" content="@yield('meta_description', setting('site_description', 'أكاديمية السهم الأخضر للتدريب بمكة المكرمة - دورات تدريبية متخصصة في البرمجة والإدارة واللغات'))">
    <meta name="keywords" content="@yield('meta_keywords', setting('site_keywords', 'دورات تدريبية, أكاديمية, السهم الأخضر, مكة, برمجة, إدارة, لغات'))">
    
    <!-- Favicon -->
    @if(setting('site_favicon'))
        <link rel="icon" type="image/svg+xml" href="{{ asset(setting('site_favicon')) }}">
        <link rel="icon" type="image/x-icon" href="{{ asset(setting('site_favicon')) }}">
    @else
        <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    @endif
    
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="@yield('og_title', setting('og_title', setting('site_title')))">
    <meta property="og:description" content="@yield('og_description', setting('og_description', setting('site_description')))">
    @if(setting('og_image'))
        <meta property="og:image" content="{{ asset(setting('og_image')) }}">
    @elseif(setting('site_logo'))
        <meta property="og:image" content="{{ asset(setting('site_logo')) }}">
    @else
        <meta property="og:image" content="{{ asset('images/logo.svg') }}">
    @endif
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="{{ setting('site_name', 'أكاديمية السهم الأخضر للتدريب') }}">
    
    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="{{ setting('twitter_card', 'summary_large_image') }}">
    <meta name="twitter:title" content="@yield('og_title', setting('og_title', setting('site_title')))">
    <meta name="twitter:description" content="@yield('og_description', setting('og_description', setting('site_description')))">
    @if(setting('og_image'))
        <meta name="twitter:image" content="{{ asset(setting('og_image')) }}">
    @elseif(setting('site_logo'))
        <meta name="twitter:image" content="{{ asset(setting('site_logo')) }}">
    @else
        <meta name="twitter:image" content="{{ asset('images/logo.svg') }}">
    @endif
    
    <!-- Google Analytics -->
    @if(setting('google_analytics'))
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ setting('google_analytics') }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', '{{ setting("google_analytics") }}');
        </script>
    @endif
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@200;300;400;500;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <!-- CSS -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        html {
            overflow-x: hidden;
            width: 100%;
        }
        
        body {
            font-family: 'Tajawal', sans-serif;
            line-height: 1.6;
            color: #333;
            background: #f8fafc;
            overflow-x: hidden;
            width: 100%;
            position: relative;
        }
        
        .container {
            max-width: 1600px;
            margin: 0 auto;
            padding: 0 10px;
        }
        
        /* Header Styles */
        .header {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.7) 0%, rgba(5, 150, 105, 0.7) 100%);
            color: white;
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
            position: relative;
            overflow: hidden;
            padding: 20px 0;
            margin-bottom: 0;
        }
        
        .header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 20% 50%, rgba(255,255,255,0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(255,255,255,0.08) 0%, transparent 50%),
                radial-gradient(circle at 40% 80%, rgba(255,255,255,0.06) 0%, transparent 50%);
            animation: floatingLights 8s ease-in-out infinite;
            pointer-events: none;
        }
        
        .header::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, 
                transparent 0%, 
                rgba(255,255,255,0.1) 25%, 
                rgba(255,255,255,0.2) 50%, 
                rgba(255,255,255,0.1) 75%, 
                transparent 100%);
            animation: shimmer 4s ease-in-out infinite;
            pointer-events: none;
        }
        
        @keyframes floatingLights {
            0%, 100% { 
                transform: translateY(0px) rotate(0deg);
                opacity: 0.8;
            }
            25% { 
                transform: translateY(-10px) rotate(1deg);
                opacity: 1;
            }
            50% { 
                transform: translateY(5px) rotate(-1deg);
                opacity: 0.6;
            }
            75% { 
                transform: translateY(-5px) rotate(0.5deg);
                opacity: 0.9;
            }
        }
        
        @keyframes shimmer {
            0% { 
                transform: translateX(-100%) skewX(-15deg);
                opacity: 0;
            }
            50% { 
                opacity: 1;
            }
            100% { 
                transform: translateX(200%) skewX(-15deg);
                opacity: 0;
            }
        }
        
        .header-top {
            background: rgba(0,0,0,0.1);
            padding: 12px 0;
            font-size: 13px;
        }
        
        .header-top .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }
        
        .header-top .contact-info {
            display: flex;
            align-items: center;
            gap: 20px;
            flex-wrap: wrap;
        }
        
        .header-top .contact-item {
            display: flex;
            align-items: center;
            gap: 6px;
            color: rgba(255,255,255,0.9);
            font-size: 12px;
        }
        
        .header-top .contact-item i {
            font-size: 14px;
            opacity: 0.8;
        }
        
        .header-top .contact-item a {
            color: inherit;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        
        .header-top .contact-item a:hover {
            color: #fbbf24;
        }
        
        .header-top .social-links {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .header-top .social-links a {
            color: rgba(255,255,255,0.8);
            font-size: 16px;
            transition: all 0.3s ease;
            padding: 4px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .header-top .social-links a:hover {
            color: #fbbf24;
            background: rgba(255,255,255,0.1);
            transform: scale(1.1);
        }
        
        .header-main {
            padding: 0;
            position: relative;
            z-index: 2;
        }
        
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: nowrap;
            gap: 20px;
            min-height: 90px;
            width: 100%;
            padding: 0 15px;
        }
        
        .logo {
            display: flex;
            align-items: center;
            font-size: 20px;
            font-weight: 800;
            text-decoration: none;
            color: white;
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            position: relative;
            overflow: hidden;
            flex-shrink: 0;
            padding: 8px 15px;
            border-radius: 12px;
            margin-left: auto;
            min-width: 140px;
            justify-content: center;
        }
        
        .logo::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }
        
        .logo::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(255,255,255,0.1), rgba(255,255,255,0.05));
            border-radius: 15px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .logo:hover::before {
            left: 100%;
        }
        
        .logo:hover::after {
            opacity: 1;
        }
        
        .logo:hover {
            transform: scale(1.05) translateY(-2px);
            text-shadow: 0 0 25px rgba(255,255,255,0.6);
            box-shadow: 0 8px 25px rgba(0,0,0,0.2);
        }
        
        .logo img {
            height: 28px;
            width: auto;
            margin-left: 6px;
            filter: drop-shadow(0 2px 8px rgba(0,0,0,0.2));
            transition: all 0.3s ease;
        }
        
        .logo:hover img {
            transform: scale(1.1) rotate(5deg);
            filter: drop-shadow(0 4px 12px rgba(0,0,0,0.3));
        }
        
        .logo i {
            margin-left: 8px;
            font-size: 22px;
            filter: drop-shadow(0 2px 8px rgba(0,0,0,0.2));
            transition: all 0.3s ease;
        }
        
        .logo:hover i {
            transform: scale(1.2) rotate(10deg);
            filter: drop-shadow(0 4px 12px rgba(0,0,0,0.3));
        }
        
        .nav-menu {
            display: flex;
            list-style: none;
            gap: 15px;
            margin: 0;
            align-items: center;
            flex-wrap: nowrap;
            flex: 1;
            justify-content: center;
            max-width: 900px;
            overflow-x: auto;
            scrollbar-width: none;
            -ms-overflow-style: none;
            padding: 0 15px;
        }
        
        .nav-menu::-webkit-scrollbar {
            display: none;
        }
        
        .nav-menu a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            padding: 12px 18px;
            position: relative;
            display: flex;
            align-items: center;
            gap: 8px;
            border-radius: 25px;
            font-size: 15px;
            white-space: nowrap;
            overflow: hidden;
            background: rgba(255,255,255,0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.1);
            flex-shrink: 0;
        }
        
        .nav-menu a::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.6s ease;
        }
        
        .nav-menu a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 3px;
            background: linear-gradient(90deg, #fbbf24, #f59e0b);
            transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            border-radius: 2px;
            transform: translateX(-50%);
        }
        
        .nav-menu a:hover::before {
            left: 100%;
        }
        
        .nav-menu a:hover::after {
            width: 80%;
        }
        
        .nav-menu a:hover,
        .nav-menu a.active {
            color: #fbbf24;
            background: rgba(255,255,255,0.15);
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            border-color: rgba(255,255,255,0.3);
        }
        
        .nav-menu a.active::after {
            width: 80%;
            background: linear-gradient(90deg, #fbbf24, #f59e0b);
        }
        
        .nav-menu a i {
            transition: all 0.3s ease;
            position: relative;
            z-index: 1;
            font-size: 16px;
        }
        
        .nav-menu a:hover i {
            transform: scale(1.2) rotate(10deg);
            color: #fbbf24;
        }
        
        .mobile-menu-toggle {
            display: none;
            background: rgba(255,255,255,0.1);
            border: 1px solid rgba(255,255,255,0.2);
            color: white;
            padding: 10px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }
        
        .mobile-menu-toggle:hover {
            background: rgba(255,255,255,0.2);
            transform: scale(1.05);
        }
        
        .mobile-menu-toggle i {
            font-size: 1.5rem;
        }
        
        .auth-buttons {
            display: flex;
            gap: 10px;
            align-items: center;
            flex-shrink: 0;
            margin-right: auto;
            min-width: 220px;
            justify-content: flex-end;
        }
        
        .btn {
            padding: 12px 20px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            position: relative;
            overflow: hidden;
            font-size: 14px;
            white-space: nowrap;
            backdrop-filter: blur(10px);
            flex-shrink: 0;
        }
        
        .btn i {
            font-size: 14px;
        }
        
        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.6s ease;
        }
        
        .btn::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(255,255,255,0.1), rgba(255,255,255,0.05));
            border-radius: 30px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .btn:hover::before {
            left: 100%;
        }
        
        .btn:hover::after {
            opacity: 1;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #fbbf24, #f59e0b);
            color: #1f2937;
            box-shadow: 0 6px 20px rgba(251, 191, 36, 0.4);
            border: 1px solid rgba(251, 191, 36, 0.3);
        }
        
        .btn-primary:hover {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            transform: translateY(-4px) scale(1.05);
            box-shadow: 0 12px 35px rgba(251, 191, 36, 0.6);
            border-color: rgba(251, 191, 36, 0.5);
        }
        
        .btn-outline {
            background: rgba(255,255,255,0.1);
            color: white;
            border: 2px solid rgba(255,255,255,0.3);
            backdrop-filter: blur(15px);
        }
        
        .btn-outline:hover {
            background: rgba(255,255,255,0.2);
            border-color: rgba(255,255,255,0.5);
            transform: translateY(-4px) scale(1.05);
            box-shadow: 0 12px 35px rgba(255,255,255,0.3);
        }
        
        .btn i {
            transition: all 0.3s ease;
            position: relative;
            z-index: 1;
        }
        
        .btn:hover i {
            transform: scale(1.2) rotate(5deg);
        }
        
        /* Enhanced Mobile Menu */
        .mobile-menu-toggle {
            display: none;
            background: linear-gradient(135deg, rgba(255,255,255,0.15), rgba(255,255,255,0.1));
            border: 1px solid rgba(255,255,255,0.3);
            color: white;
            padding: 15px;
            border-radius: 15px;
            font-size: 1.4rem;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            backdrop-filter: blur(15px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
            position: relative;
            overflow: hidden;
        }
        
        .mobile-menu-toggle::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.8s ease;
        }
        
        .mobile-menu-toggle::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(255,255,255,0.1), rgba(255,255,255,0.05));
            border-radius: 15px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .mobile-menu-toggle:hover::before {
            left: 100%;
        }
        
        .mobile-menu-toggle:hover::after {
            opacity: 1;
        }
        
        .mobile-menu-toggle:hover {
            background: linear-gradient(135deg, rgba(255,255,255,0.25), rgba(255,255,255,0.15));
            transform: scale(1.1) rotate(5deg);
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.3);
            border-color: rgba(255,255,255,0.5);
        }
        
        .mobile-menu-toggle i {
            transition: all 0.3s ease;
            position: relative;
            z-index: 1;
        }
        
        .mobile-menu-toggle:hover i {
            transform: scale(1.2) rotate(10deg);
        }
        
        /* Mobile menu close button */
        .mobile-menu-close {
            display: none;
            position: absolute;
            top: 25px;
            right: 25px;
            background: linear-gradient(135deg, rgba(255,255,255,0.15), rgba(255,255,255,0.1));
            border: 1px solid rgba(255,255,255,0.3);
            color: white;
            padding: 12px;
            border-radius: 50%;
            font-size: 1.3rem;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            backdrop-filter: blur(15px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            z-index: 1001;
            position: relative;
            overflow: hidden;
        }
        
        .mobile-menu-close::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.6s ease;
        }
        
        .mobile-menu-close::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(255,255,255,0.1), rgba(255,255,255,0.05));
            border-radius: 50%;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .mobile-menu-close:hover::before {
            left: 100%;
        }
        
        .mobile-menu-close:hover::after {
            opacity: 1;
        }
        
        .mobile-menu-close:hover {
            background: linear-gradient(135deg, rgba(255,255,255,0.25), rgba(255,255,255,0.15));
            transform: scale(1.15) rotate(90deg);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
        }
        
        .mobile-menu-close i {
            transition: all 0.3s ease;
            position: relative;
            z-index: 1;
        }
        
        .mobile-menu-close:hover i {
            transform: scale(1.2) rotate(10deg);
        }
        
        /* Main Content */
        .main-content {
            min-height: calc(100vh - 200px);
            padding: 0;
            margin-top: 0;
        }
        
        /* Ensure main content doesn't overlap with fixed header on mobile */
        @media (max-width: 768px) {
            .main-content {
                padding-top: 160px;
            }
        }
        
        /* Enhanced Footer */
        .enhanced-footer {
            position: relative;
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #334155 100%);
            color: white;
            padding: 80px 0 20px;
            margin-top: 80px;
            overflow: hidden;
        }
        
        .footer-background {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 1;
        }
        
        .footer-pattern {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: 
                radial-gradient(circle at 20% 80%, rgba(16, 185, 129, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(59, 130, 246, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(139, 92, 246, 0.05) 0%, transparent 50%);
            opacity: 0.6;
        }
        
        .enhanced-footer .container {
            position: relative;
            z-index: 2;
        }
        
        .footer-content {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1.5fr;
            gap: 50px;
            margin-bottom: 60px;
        }
        
        /* Footer Brand Section */
        .footer-brand {
            padding-right: 30px;
        }
        
        .footer-logo {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 25px;
        }
        
        .logo-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #10b981, #059669);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: white;
            box-shadow: 0 8px 25px rgba(16, 185, 129, 0.3);
            position: relative;
            overflow: hidden;
        }
        
        .logo-icon::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transform: rotate(45deg);
            animation: shimmer 3s infinite;
        }
        
        @keyframes shimmer {
            0% { transform: translateX(-100%) translateY(-100%) rotate(45deg); }
            100% { transform: translateX(100%) translateY(100%) rotate(45deg); }
        }
        
        .logo-text h3 {
            font-size: 1.5rem;
            font-weight: 700;
            color: white;
            margin: 0;
            background: linear-gradient(45deg, #10b981, #3b82f6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .logo-tagline {
            color: #94a3b8;
            font-size: 0.8rem;
            font-weight: 500;
            margin-top: 3px;
            display: block;
        }
        
        .footer-description {
            color: #cbd5e1;
            line-height: 1.6;
            margin-bottom: 25px;
            font-size: 0.9rem;
        }
        
        .footer-social h4 {
            color: #10b981;
            font-size: 1rem;
            margin-bottom: 12px;
            font-weight: 600;
        }
        
        .social-icons-grid {
            display: flex;
            gap: 15px;
        }
        
        /* Enhanced Social Icons */
        .enhanced-social-icons {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }
        
        .enhanced-social-icons a {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.3);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        
        .enhanced-social-icons a::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(16, 185, 129, 0.2), transparent);
            transition: left 0.5s ease;
        }
        
        .enhanced-social-icons a:hover::before {
            left: 100%;
        }
        
        .enhanced-social-icons a:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            border-color: rgba(16, 185, 129, 0.5);
        }
        
        /* Social Icons Colors */
        .enhanced-social-icons a.facebook {
            color: #1877f2;
        }
        
        .enhanced-social-icons a.twitter {
            color: #1da1f2;
        }
        
        .enhanced-social-icons a.instagram {
            color: #e4405f;
        }
        
        .enhanced-social-icons a.youtube {
            color: #ff0000;
        }
        
        .enhanced-social-icons a.linkedin {
            color: #0077b5;
        }
        
        .enhanced-social-icons a.tiktok {
            color: #000000;
        }
        
        .enhanced-social-icons a.telegram {
            color: #0088cc;
        }
        
        .enhanced-social-icons a.snapchat {
            color: #fffc00;
        }
        
        .enhanced-social-icons a.whatsapp {
            color: #25d366;
        }
        
        .enhanced-social-icons a.discord {
            color: #5865f2;
        }
        
        .enhanced-social-icons a.twitch {
            color: #9146ff;
        }
        
        .enhanced-social-icons a.pinterest {
            color: #e60023;
        }
        
        .enhanced-social-icons a.reddit {
            color: #ff4500;
        }
        
        .enhanced-social-icons a.github {
            color: #333;
        }
        
        .enhanced-social-icons a.medium {
            color: #00ab6c;
        }
        
        .enhanced-social-icons a.behance {
            color: #1769ff;
        }
        
        .enhanced-social-icons a.dribbble {
            color: #ea4c89;
        }
        
        .enhanced-social-icons a.spotify {
            color: #1db954;
        }
        
        .enhanced-social-icons a.apple_music {
            color: #fa243c;
        }
        
        .enhanced-social-icons a.soundcloud {
            color: #ff7700;
        }
        
        .enhanced-social-icons a.vimeo {
            color: #1ab7ea;
        }
        
        .enhanced-social-icons a.flickr {
            color: #ff0084;
        }
        
        .enhanced-social-icons a.quora {
            color: #b92b27;
        }
        
        .enhanced-social-icons a.stack_overflow {
            color: #f48024;
        }
        
        .enhanced-social-icons a.wordpress {
            color: #21759b;
        }
        
        .enhanced-social-icons a.blogger {
            color: #ff5722;
        }
        
        .enhanced-social-icons a.tumblr {
            color: #36465d;
        }
        
        .enhanced-social-icons a.xing {
            color: #026466;
        }
        
        .enhanced-social-icons a.skype {
            color: #00aff0;
        }
        
        .enhanced-social-icons a.wechat {
            color: #07c160;
        }
        
        .enhanced-social-icons a.line {
            color: #00b900;
        }
        
        .enhanced-social-icons a.kakao {
            color: #fee500;
        }
        
        .enhanced-social-icons a.naver {
            color: #03c75a;
        }
        
        .enhanced-social-icons a.baidu {
            color: #2932e1;
        }
        
        .enhanced-social-icons a.qq {
            color: #12b7f5;
        }
        
        .enhanced-social-icons a.weibo {
            color: #e6162d;
        }
        
        /* Section Titles */
        .section-title {
            color: #10b981;
            margin-bottom: 20px;
            font-size: 1rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .section-title i {
            font-size: 1rem;
            color: #10b981;
        }
        
        /* Footer Links */
        .footer-links {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .footer-links li {
            margin-bottom: 10px;
        }
        
        .footer-links a {
            color: #cbd5e1;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 6px 0;
            transition: all 0.3s ease;
            border-radius: 6px;
            position: relative;
            font-size: 0.85rem;
        }
        
        .footer-links a i {
            font-size: 0.7rem;
            color: #10b981;
            transition: transform 0.3s ease;
        }
        
        .footer-links a:hover {
            color: #10b981;
            transform: translateX(-3px);
            background: rgba(16, 185, 129, 0.1);
            padding-right: 8px;
        }
        
        .footer-links a:hover i {
            transform: translateX(-2px);
        }
        
        /* Contact Info */
        .contact-info {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .contact-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 15px;
            padding: 12px;
            border-radius: 10px;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .contact-item:hover {
            background: rgba(16, 185, 129, 0.1);
            border-color: rgba(16, 185, 129, 0.3);
            transform: translateY(-2px);
        }
        
        .contact-icon {
            width: 35px;
            height: 35px;
            background: linear-gradient(135deg, #10b981, #059669);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1rem;
            flex-shrink: 0;
        }
        
        .contact-details {
            flex: 1;
        }
        
        .contact-label {
            display: block;
            color: #94a3b8;
            font-size: 0.75rem;
            font-weight: 500;
            margin-bottom: 3px;
        }
        
        .contact-value {
            color: #e2e8f0;
            font-weight: 500;
            line-height: 1.3;
            font-size: 0.85rem;
        }
        
        .contact-link {
            text-decoration: none;
            transition: color 0.3s ease;
        }
        
        .contact-link:hover {
            color: #10b981;
        }
        
        /* Newsletter Section */
        .footer-newsletter {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.1), rgba(59, 130, 246, 0.1));
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 40px;
            margin-bottom: 40px;
            backdrop-filter: blur(10px);
        }
        
        .newsletter-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 30px;
        }
        
        .newsletter-text h3 {
            color: white;
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 8px;
        }
        
        .newsletter-text p {
            color: #cbd5e1;
            margin: 0;
            font-size: 0.9rem;
        }
        
        .newsletter-form {
            flex-shrink: 0;
        }
        
        .newsletter-input-group {
            display: flex;
            gap: 8px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 40px;
            padding: 4px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .newsletter-input {
            background: transparent;
            border: none;
            color: white;
            padding: 12px 18px;
            border-radius: 40px;
            outline: none;
            min-width: 250px;
            font-size: 0.9rem;
        }
        
        .newsletter-input::placeholder {
            color: #94a3b8;
        }
        
        .newsletter-btn {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 40px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 0.9rem;
        }
        
        .newsletter-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(16, 185, 129, 0.3);
        }
        
        /* Footer Bottom */
        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 30px;
        }
        
        .footer-bottom-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
        }
        
        .copyright p {
            color: #94a3b8;
            margin: 0;
            font-size: 0.8rem;
        }
        
        .footer-links-bottom {
            display: flex;
            gap: 25px;
        }
        
        .footer-links-bottom a {
            color: #cbd5e1;
            text-decoration: none;
            font-size: 0.8rem;
            transition: color 0.3s ease;
        }
        
        .footer-links-bottom a:hover {
            color: #10b981;
        }
        
        /* Responsive Design */
        @media (max-width: 1200px) {
            .footer-content {
                grid-template-columns: 1fr 1fr;
                gap: 40px;
            }
            
            .footer-brand {
                grid-column: 1 / -1;
                padding-right: 0;
            }
        }
        
        @media (max-width: 768px) {
            .enhanced-footer {
                padding: 60px 0 20px;
            }
            
            .footer-content {
                grid-template-columns: 1fr;
                gap: 30px;
            }
            
            .newsletter-content {
                flex-direction: column;
                text-align: center;
            }
            
            .newsletter-input-group {
                flex-direction: column;
                border-radius: 15px;
            }
            
            .newsletter-input {
                min-width: auto;
                border-radius: 10px;
            }
            
            .newsletter-btn {
                border-radius: 10px;
            }
            
            .footer-bottom-content {
                flex-direction: column;
                text-align: center;
            }
            
            .footer-links-bottom {
                justify-content: center;
            }
        }
        
        @media (max-width: 480px) {
            .footer-logo {
                flex-direction: column;
                text-align: center;
                gap: 10px;
            }
            
            .logo-icon {
                width: 50px;
                height: 50px;
                font-size: 1.5rem;
            }
            
            .logo-text h3 {
                font-size: 1.5rem;
            }
            
            .enhanced-social-icons {
                justify-content: center;
            }
            
            .contact-item {
                flex-direction: column;
                text-align: center;
                gap: 10px;
            }
            
            .contact-icon {
                align-self: center;
            }
        }
        
        /* Utility Classes */
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .text-left { text-align: left; }
        .mb-20 { margin-bottom: 20px; }
        .mb-30 { margin-bottom: 30px; }
        .mt-20 { margin-top: 20px; }
        .mt-30 { margin-top: 30px; }
        
        /* Cards */
        .card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }
        
        .card-body {
            padding: 25px;
        }
        
        /* Enhanced Responsive Design */
        @media (max-width: 1024px) {
            .navbar {
                gap: 15px;
            }
            
            .nav-menu {
                gap: 12px;
            }
            
            .nav-menu a {
                padding: 10px 15px;
                font-size: 14px;
            }
            
            .nav-menu a i {
                font-size: 14px;
            }
            
            .btn {
                padding: 10px 16px;
                font-size: 13px;
            }
            
            .btn i {
                font-size: 13px;
            }
        }
        
        @media (max-width: 768px) {
            /* Fix header transparency and positioning */
            .header {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                z-index: 1000;
                background: linear-gradient(135deg, rgba(16, 185, 129, 0.7) 0%, rgba(5, 150, 105, 0.7) 100%);
                box-shadow: 0 4px 20px rgba(0,0,0,0.2);
                padding: 20px 0;
            }
            
            /* Hide auth buttons in main header on mobile */
            .desktop-auth-buttons {
                display: none !important;
            }
            
            .header::before {
                display: none;
            }
            
            .navbar {
                gap: 15px;
                justify-content: space-between;
            }
            
            .logo {
                font-size: 20px;
                margin-left: 0;
            }
            
            .logo img {
                height: 32px;
            }
            
            .logo i {
                font-size: 24px;
            }
            
            .nav-menu {
                display: none;
                position: fixed;
                top: 0;
                right: -100%;
                width: 280px;
                height: 100vh;
                background: linear-gradient(135deg, rgba(16, 185, 129, 0.98), rgba(5, 150, 105, 0.98));
                backdrop-filter: blur(20px);
                flex-direction: column;
                padding: 80px 20px 20px;
                box-shadow: -5px 0 30px rgba(0,0,0,0.3);
                z-index: 1000;
                justify-content: flex-start;
                align-items: stretch;
                gap: 15px;
                overflow-y: auto;
                transition: right 0.3s ease;
            }
            
            .nav-menu.active {
                right: 0;
                display: flex;
            }
            
            .nav-menu.active {
                display: flex;
                animation: slideInFromRight 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            }
            
            .nav-menu.active .mobile-menu-close {
                display: block;
                animation: fadeInScale 0.5s ease-out 0.2s both;
            }
            
            .nav-menu li {
                width: 100%;
                max-width: 300px;
            }
            
            .nav-menu a {
                font-size: 1.3rem;
                padding: 20px 30px;
                border-radius: 20px;
                background: linear-gradient(135deg, rgba(255,255,255,0.15), rgba(255,255,255,0.1));
                backdrop-filter: blur(15px);
                border: 1px solid rgba(255,255,255,0.3);
                transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
                position: relative;
                overflow: hidden;
                font-weight: 600;
                box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 12px;
                width: 100%;
                text-align: center;
            }

            .nav-menu a i {
                font-size: 1.2rem;
                transition: transform 0.3s ease;
            }
            
            .nav-menu a::before {
                content: '';
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
                transition: left 0.6s ease;
            }
            
            .nav-menu a:hover::before {
                left: 100%;
            }
            
            .nav-menu a:hover {
                background: linear-gradient(135deg, rgba(255,255,255,0.25), rgba(255,255,255,0.15));
                transform: translateY(-8px) scale(1.02);
                box-shadow: 0 15px 40px rgba(0,0,0,0.3);
                border-color: rgba(255,255,255,0.5);
            }
            
            .nav-menu a:hover i {
                transform: scale(1.2) rotate(10deg);
            }
            
            .nav-menu a::after {
                display: none;
            }
            
            .mobile-menu-toggle {
                display: block;
                background: linear-gradient(135deg, rgba(255,255,255,0.15), rgba(255,255,255,0.1));
                border: 1px solid rgba(255,255,255,0.3);
                color: white;
                padding: 15px;
                border-radius: 15px;
                font-size: 1.4rem;
                cursor: pointer;
                transition: all 0.3s ease;
                backdrop-filter: blur(15px);
                box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
                position: relative;
                overflow: hidden;
            }
            
            .mobile-menu-toggle::before {
                content: '';
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
                transition: left 0.6s ease;
            }
            
            .mobile-menu-toggle:hover::before {
                left: 100%;
            }
            
            .mobile-menu-toggle:hover {
                background: linear-gradient(135deg, rgba(255,255,255,0.25), rgba(255,255,255,0.15));
                transform: scale(1.1) rotate(5deg);
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
                border-color: rgba(255,255,255,0.5);
            }
            
            .auth-buttons {
                width: 100%;
                margin-top: 40px;
                justify-content: center;
                flex-direction: column;
                gap: 20px;
                padding: 0 20px;
            }
            
            .auth-buttons .btn {
                width: 100%;
                max-width: 280px;
                justify-content: center;
                padding: 18px 30px;
                font-size: 1.2rem;
                border-radius: 25px;
            }
            
            /* Sidebar auth buttons mobile optimization */
            .sidebar-auth-buttons {
                margin-bottom: 25px;
                gap: 15px;
            }
            
            .sidebar-auth-btn {
                padding: 18px 25px;
                font-size: 1.1rem;
                border-radius: 15px;
            }
            
            .sidebar-auth-btn i {
                font-size: 1.2rem;
            }
            
            .navbar {
                position: relative;
            }
            
            /* Mobile menu close button */
            .mobile-menu-close {
                display: none;
                position: absolute;
                top: 25px;
                right: 25px;
                background: linear-gradient(135deg, rgba(255,255,255,0.15), rgba(255,255,255,0.1));
                border: 1px solid rgba(255,255,255,0.3);
                color: white;
                padding: 12px;
                border-radius: 50%;
                font-size: 1.3rem;
                cursor: pointer;
                transition: all 0.3s ease;
                backdrop-filter: blur(15px);
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            }
            
            .mobile-menu-close:hover {
                background: linear-gradient(135deg, rgba(255,255,255,0.25), rgba(255,255,255,0.15));
                transform: scale(1.15) rotate(90deg);
                box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
            }
            
            /* Header top responsive */
            .header-top {
                padding: 10px 0;
                font-size: 11px;
            }
            
            .header-top .container {
                flex-direction: column;
                gap: 8px;
                text-align: center;
            }
            
            .header-top .contact-info {
                justify-content: center;
                gap: 15px;
            }
            
            .header-top .contact-item {
                font-size: 11px;
                gap: 4px;
            }
            
            .header-top .contact-item i {
                font-size: 12px;
            }
            
            .header-top .social-links {
                justify-content: center;
                gap: 8px;
            }
            
            .header-top .social-links a {
                font-size: 14px;
                padding: 3px;
            }
        }
        
        @keyframes slideInFromRight {
            from {
                opacity: 0;
                transform: translateX(100%);
            }
            to {
                opacity: 1;
                transform: translateX(0);
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
        
        /* Enhanced mobile styles for smaller screens */
        @media (max-width: 480px) {
            /* Adjust header height for smaller screens */
            .header {
                padding: 8px 0;
            }
            
            .navbar {
                gap: 8px;
                justify-content: space-between;
            }
            
            .logo {
                font-size: 16px;
                margin-left: 0;
                min-width: 100px;
            }
            
            .logo img {
                height: 24px;
            }
            
            .logo i {
                font-size: 18px;
            }
            
            .nav-menu {
                gap: 6px;
            }
            
            .nav-menu a {
                font-size: 11px;
                padding: 4px 8px;
            }
            
            .nav-menu a i {
                font-size: 10px;
            }
            
            .auth-buttons .btn {
                padding: 4px 8px;
                font-size: 10px;
            }
            
            .auth-buttons .btn i {
                font-size: 10px;
            }
            
            .mobile-menu-close {
                top: 15px;
                right: 15px;
                padding: 8px;
                font-size: 1rem;
            }
            
            .main-content {
                padding-top: 120px;
            }
            
            .header-top {
                padding: 8px 0;
                font-size: 10px;
            }
            
            .header-top .contact-info {
                gap: 10px;
            }
            
            .header-top .contact-item {
                font-size: 10px;
                gap: 3px;
            }
            
            .header-top .contact-item i {
                font-size: 11px;
            }
            
            .header-top .social-links {
                gap: 6px;
            }
            
            .header-top .social-links a {
                font-size: 12px;
                padding: 2px;
            }
        }
        
        /* Landscape mobile optimization */
        @media (max-width: 768px) and (orientation: landscape) {
            /* Adjust header for landscape mode */
            .header {
                padding: 6px 0;
            }
            
            .navbar {
                gap: 10px;
            }
            
            .logo {
                font-size: 16px;
            }
            
            .nav-menu {
                gap: 8px;
            }
            
            .nav-menu a {
                font-size: 11px;
                padding: 4px 8px;
            }
            
            .nav-menu a i {
                font-size: 10px;
            }
            
            .auth-buttons .btn {
                padding: 4px 8px;
                font-size: 10px;
            }
            
            .auth-buttons .btn i {
                font-size: 10px;
            }
            
            .main-content {
                padding-top: 60px;
            }
            
            .nav-menu {
                padding: 40px 20px;
                gap: 15px;
            }
            
            .nav-menu a {
                padding: 12px 20px;
                font-size: 1.1rem;
            }
            
            .auth-buttons {
                margin-top: 25px;
            }
        }
        
        /* Alert Messages */
        .alert {
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            border-right: 4px solid;
        }
        
        .alert-success {
            background: #d1fae5;
            color: #065f46;
            border-color: #10b981;
        }
        
        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            border-color: #ef4444;
        }
        
        .alert-warning {
            background: #fef3c7;
            color: #92400e;
            border-color: #f59e0b;
        }
        
        .alert-info {
            background: #dbeafe;
            color: #1e40af;
            border-color: #3b82f6;
        }
        
        /* Loading animation for mobile menu */
        .nav-menu.loading {
            pointer-events: none;
        }
        
        .nav-menu.loading::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 50px;
            height: 50px;
            margin: -25px 0 0 -25px;
            border: 4px solid rgba(255,255,255,0.2);
            border-top: 4px solid white;
            border-radius: 50%;
            animation: spin 1.2s cubic-bezier(0.25, 0.46, 0.45, 0.94) infinite;
            box-shadow: 0 0 20px rgba(255,255,255,0.3);
        }
        
        @keyframes spin {
            0% { 
                transform: rotate(0deg) scale(1);
                opacity: 1;
            }
            50% { 
                transform: rotate(180deg) scale(1.1);
                opacity: 0.8;
            }
            100% { 
                transform: rotate(360deg) scale(1);
                opacity: 1;
            }
        }
        
        /* Pulse animation for interactive elements */
        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
                opacity: 1;
            }
            50% {
                transform: scale(1.05);
                opacity: 0.8;
            }
        }
        
        /* Floating animation for subtle movement */
        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-5px);
            }
        }
        
        /* Glow animation for special effects */
        @keyframes glow {
            0%, 100% {
                box-shadow: 0 0 5px rgba(255,255,255,0.3);
            }
            50% {
                box-shadow: 0 0 20px rgba(255,255,255,0.6), 0 0 30px rgba(255,255,255,0.4);
            }
        }
    </style>
    
    @include('components.header-footer-styles')
    @stack('styles')
</head>
<body>
    <!-- Header -->
    <header class="header">
        @include('components.header')
    </header>
    
    <!-- Main Content -->
    <main class="main-content">
        <div class="container">
            <!-- Flash Messages -->
            @if(session('success'))
                <div class="alert alert-success">
                    <i class="bi bi-check-circle"></i>
                    {{ session('success') }}
                </div>
            @endif
            
            @if(session('error'))
                <div class="alert alert-error">
                    <i class="bi bi-exclamation-triangle"></i>
                    {{ session('error') }}
                </div>
            @endif
            
            @if(session('warning'))
                <div class="alert alert-warning">
                    <i class="bi bi-exclamation-circle"></i>
                    {{ session('warning') }}
                </div>
            @endif
            
            @if(session('info'))
                <div class="alert alert-info">
                    <i class="bi bi-info-circle"></i>
                    {{ session('info') }}
                </div>
            @endif
            
            @yield('content')
        </div>
    </main>
    
    <!-- Enhanced Footer -->
    @include('components.footer')
    
    <script>
        
        // Newsletter Form Functionality
        document.addEventListener('DOMContentLoaded', function() {
            const newsletterForm = document.querySelector('.newsletter-input-group');
            const newsletterInput = document.querySelector('.newsletter-input');
            const newsletterBtn = document.querySelector('.newsletter-btn');
            
            if (newsletterForm) {
                newsletterForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    const email = newsletterInput.value.trim();
                    if (!email) {
                        showNewsletterMessage('يرجى إدخال بريد إلكتروني صحيح', 'error');
                        return;
                    }
                    
                    if (!isValidEmail(email)) {
                        showNewsletterMessage('يرجى إدخال بريد إلكتروني صحيح', 'error');
                        return;
                    }
                    
                    // Simulate newsletter subscription
                    newsletterBtn.innerHTML = '<i class="bi bi-hourglass-split"></i> جاري الإرسال...';
                    newsletterBtn.disabled = true;
                    
                    setTimeout(() => {
                        showNewsletterMessage('تم الاشتراك بنجاح! شكراً لك', 'success');
                        newsletterInput.value = '';
                        newsletterBtn.innerHTML = '<i class="bi bi-send"></i> اشتراك';
                        newsletterBtn.disabled = false;
                    }, 2000);
                });
            }
            
            function isValidEmail(email) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return emailRegex.test(email);
            }
            
            function showNewsletterMessage(message, type) {
                // Remove existing message
                const existingMessage = document.querySelector('.newsletter-message');
                if (existingMessage) {
                    existingMessage.remove();
                }
                
                // Create new message
                const messageDiv = document.createElement('div');
                messageDiv.className = `newsletter-message newsletter-${type}`;
                messageDiv.textContent = message;
                messageDiv.style.cssText = `
                    position: absolute;
                    top: 100%;
                    left: 0;
                    right: 0;
                    padding: 10px 15px;
                    border-radius: 8px;
                    font-size: 0.9rem;
                    font-weight: 500;
                    margin-top: 10px;
                    text-align: center;
                    animation: slideInUp 0.3s ease;
                `;
                
                if (type === 'success') {
                    messageDiv.style.background = 'rgba(16, 185, 129, 0.2)';
                    messageDiv.style.color = '#10b981';
                    messageDiv.style.border = '1px solid rgba(16, 185, 129, 0.3)';
                } else {
                    messageDiv.style.background = 'rgba(239, 68, 68, 0.2)';
                    messageDiv.style.color = '#ef4444';
                    messageDiv.style.border = '1px solid rgba(239, 68, 68, 0.3)';
                }
                
                const newsletterForm = document.querySelector('.newsletter-form');
                newsletterForm.style.position = 'relative';
                newsletterForm.appendChild(messageDiv);
                
                // Remove message after 5 seconds
                setTimeout(() => {
                    if (messageDiv.parentNode) {
                        messageDiv.remove();
                    }
                }, 5000);
            }
            
            // Add slideInUp animation
            const style = document.createElement('style');
            style.textContent = `
                @keyframes slideInUp {
                    from {
                        opacity: 0;
                        transform: translateY(20px);
                    }
                    to {
                        opacity: 1;
                        transform: translateY(0);
                    }
                }
            `;
            document.head.appendChild(style);
        });
        
        // Enhanced Social Icons Animation
        document.addEventListener('DOMContentLoaded', function() {
            const socialIcons = document.querySelectorAll('.enhanced-social-icons a');
            
            socialIcons.forEach((icon, index) => {
                // Add entrance animation
                icon.style.opacity = '0';
                icon.style.transform = 'translateY(20px)';
                
                setTimeout(() => {
                    icon.style.transition = 'all 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
                    icon.style.opacity = '1';
                    icon.style.transform = 'translateY(0)';
                }, index * 100);
                
                // Add hover sound effect (optional)
                icon.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-5px) scale(1.1)';
                });
                
                icon.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0) scale(1)';
                });
            });
        });
        
        // Footer Links Animation
        document.addEventListener('DOMContentLoaded', function() {
            const footerLinks = document.querySelectorAll('.footer-links a, .contact-item');
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry, index) => {
                    if (entry.isIntersecting) {
                        setTimeout(() => {
                            entry.target.style.opacity = '1';
                            entry.target.style.transform = 'translateX(0)';
                        }, index * 50);
                    }
                });
            }, { threshold: 0.1 });
            
            footerLinks.forEach(link => {
                link.style.opacity = '0';
                link.style.transform = 'translateX(20px)';
                link.style.transition = 'all 0.6s ease';
                observer.observe(link);
            });
        });
        

        
        // Auto-hide alerts after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                setTimeout(function() {
                    alert.style.opacity = '0';
                    setTimeout(function() {
                        alert.remove();
                    }, 300);
                }, 5000);
            });
        });
        
        // Add smooth scrolling for better mobile experience
        document.addEventListener('DOMContentLoaded', function() {
            // Smooth scroll for anchor links
            const anchorLinks = document.querySelectorAll('a[href^="#"]');
            anchorLinks.forEach(function(link) {
                link.addEventListener('click', function(e) {
                    const targetId = this.getAttribute('href');
                    if (targetId === '#') {
                        e.preventDefault();
                        return;
                    }
                    
                    e.preventDefault();
                    const targetElement = document.querySelector(targetId);
                    
                    if (targetElement) {
                        targetElement.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
        });
        

    </script>
    
    @include('components.header-footer-scripts')
    @stack('scripts')
</body>
</html> 