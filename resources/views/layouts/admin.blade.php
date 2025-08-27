<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'لوحة الإدارة - أكاديمية السهم الأخضر')</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@200;300;400;500;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Notifications CSS -->
    <style>
        /* Notifications Styles */
        .notifications-dropdown {
            position: relative;
            display: inline-block;
        }

        .notifications-toggle {
            position: relative;
            background: none;
            border: none;
            color: #6b7280;
            font-size: 1.2rem;
            padding: 8px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .notifications-toggle:hover {
            background: rgba(16, 185, 129, 0.1);
            color: #10b981;
            transform: scale(1.05);
        }

        .notifications-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #ef4444;
            color: white;
            font-size: 0.7rem;
            font-weight: 600;
            padding: 2px 6px;
            border-radius: 10px;
            min-width: 18px;
            text-align: center;
            animation: pulse 2s infinite;
        }

        .notifications-panel {
            position: absolute;
            top: 100%;
            right: 0;
            width: 350px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            border: 1px solid #e5e7eb;
            z-index: 9999;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            margin-top: 10px;
        }

        .notifications-panel.active {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .notifications-header {
            padding: 15px 20px;
            border-bottom: 1px solid #f3f4f6;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .notifications-header .header-actions {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .notifications-header h6 {
            margin: 0;
            font-weight: 600;
            color: #1f2937;
        }

        .mark-all-read {
            background: none;
            border: none;
            color: #10b981;
            font-size: 0.8rem;
            cursor: pointer;
            padding: 5px 10px;
            border-radius: 6px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .mark-all-read:hover {
            background: rgba(16, 185, 129, 0.1);
        }

        .notifications-list {
            max-height: 300px;
            overflow-y: auto;
            padding: 10px 0;
        }

        .notification-item {
            padding: 12px 20px;
            border-bottom: 1px solid #f3f4f6;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }

        .notification-item:hover {
            background: #f9fafb;
        }

        .notification-item.unread {
            background: rgba(16, 185, 129, 0.05);
            border-right: 3px solid #10b981;
        }

        .notification-icon {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
            flex-shrink: 0;
        }

        .notification-icon.success {
            background: rgba(16, 185, 129, 0.1);
            color: #10b981;
        }

        .notification-icon.warning {
            background: rgba(245, 158, 11, 0.1);
            color: #f59e0b;
        }

        .notification-icon.info {
            background: rgba(59, 130, 246, 0.1);
            color: #3b82f6;
        }

        .notification-icon.error {
            background: rgba(239, 68, 68, 0.1);
            color: #ef4444;
        }

        .notification-content {
            flex: 1;
            min-width: 0;
        }

        .notification-title {
            font-weight: 600;
            font-size: 0.9rem;
            color: #1f2937;
            margin-bottom: 4px;
            line-height: 1.3;
        }

        .notification-message {
            font-size: 0.85rem;
            color: #6b7280;
            line-height: 1.4;
            margin-bottom: 4px;
        }

        .notification-time {
            font-size: 0.75rem;
            color: #9ca3af;
        }

        .notification-actions {
            display: flex;
            gap: 5px;
            flex-shrink: 0;
            align-items: center;
        }

        .notification-actions .btn {
            padding: 4px 8px;
            font-size: 0.8rem;
            border-radius: 6px;
        }

        .no-notifications {
            text-align: center;
            padding: 40px 20px;
            color: #9ca3af;
        }

        .no-notifications i {
            font-size: 3rem;
            margin-bottom: 15px;
            display: block;
        }

        .no-notifications p {
            margin: 0;
            font-size: 0.9rem;
        }

        .notifications-footer {
            padding: 15px 20px;
            border-top: 1px solid #f3f4f6;
            text-align: center;
        }

        .notifications-footer a {
            color: #10b981;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .notifications-footer a:hover {
            color: #059669;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }

        /* Responsive Notifications */
        @media (max-width: 768px) {
            .notifications-panel {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                width: 100%;
                height: 100%;
                border-radius: 0;
                z-index: 9999;
            }
            
            .notifications-panel {
                padding: 20px;
            }
            
            .notifications-toggle {
                padding: 8px;
            }
            
            .notifications-badge {
                font-size: 0.7rem;
                min-width: 16px;
                height: 16px;
            }
        }
    </style>
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Tajawal', sans-serif;
            background: #f8fafc;
            color: #333;
        }
        
        .admin-container {
            display: flex;
            min-height: 100vh;
        }
        
        /* Sidebar */
        .sidebar {
            width: 280px;
            background: #1f2937;
            color: white;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            z-index: 1000;
        }
        
        .sidebar-header {
            padding: 25px 20px;
            border-bottom: 1px solid #374151;
        }
        
        .sidebar-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 1.5rem;
            font-weight: 700;
            color: white;
            text-decoration: none;
        }
        
        .sidebar-logo i {
            color: #10b981;
            font-size: 1.8rem;
        }
        
        .sidebar-nav {
            padding: 20px 0;
        }
        
        .nav-section {
            margin-bottom: 30px;
        }
        
        .nav-section-title {
            padding: 0 20px 10px;
            font-size: 0.8rem;
            font-weight: 600;
            color: #9ca3af;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .nav-item {
            display: flex;
            align-items: center;
            padding: 15px 20px;
            color: #d1d5db;
            text-decoration: none;
            transition: all 0.3s ease;
            border-right: 3px solid transparent;
            font-weight: 500;
            font-size: 0.95rem;
            position: relative;
            overflow: hidden;
        }
        
        .nav-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(16, 185, 129, 0.1), transparent);
            transition: left 0.5s ease;
        }
        
        .nav-item:hover::before {
            left: 100%;
        }
        
        .nav-item:hover {
            background: #374151;
            color: white;
            border-right-color: #10b981;
            transform: translateX(-5px);
        }
        
        .nav-item.active {
            background: linear-gradient(135deg, #374151, #4b5563);
            color: white;
            border-right-color: #10b981;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2);
        }
        
        .nav-item.active::before {
            display: none;
        }
        
        .nav-item i {
            margin-left: 15px;
            width: 20px;
            text-align: center;
            font-size: 1.1rem;
            transition: transform 0.3s ease;
        }
        
        .nav-item:hover i {
            transform: scale(1.1);
        }
        
        /* Main Content */
        .main-content {
            flex: 1;
            margin-right: 280px;
            min-height: 100vh;
        }
        
        .top-bar {
            background: white;
            padding: 20px 30px;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .page-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1f2937;
        }
        
        .header-actions {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        
        /* Visit Website Button */
        .visit-website-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            text-decoration: none;
            padding: 10px 16px;
            border-radius: 25px;
            font-weight: 500;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
            border: none;
        }
        
        .visit-website-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
            color: white;
            text-decoration: none;
        }
        
        .visit-website-btn i {
            font-size: 1rem;
        }
        
        .visit-website-btn span {
            display: inline-block;
        }
        
        @media (max-width: 768px) {
            .visit-website-btn span {
                display: none;
            }
            
            .visit-website-btn {
                padding: 10px;
                border-radius: 50%;
            }
        }
        
        /* Notifications Styles */
        .notifications-dropdown {
            position: relative;
            display: inline-block;
        }
        
        .notifications-toggle {
            position: relative;
            background: none;
            border: none;
            color: #6b7280;
            font-size: 1.2rem;
            padding: 8px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .notifications-toggle:hover {
            background: rgba(16, 185, 129, 0.1);
            color: #10b981;
            transform: scale(1.05);
        }
        
        .notifications-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #ef4444;
            color: white;
            font-size: 0.7rem;
            font-weight: 600;
            padding: 2px 6px;
            border-radius: 10px;
            min-width: 18px;
            text-align: center;
            animation: pulse 2s infinite;
        }
        
        .notifications-panel {
            position: absolute;
            top: 100%;
            right: 0;
            width: 350px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            border: 1px solid #e5e7eb;
            z-index: 9999;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            margin-top: 10px;
        }
        
        .notifications-panel.active {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        
        .notifications-header {
            padding: 15px 20px;
            border-bottom: 1px solid #f3f4f6;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .notifications-header .header-actions {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .notifications-header h6 {
            margin: 0;
            font-weight: 600;
            color: #1f2937;
        }
        
        .mark-all-read {
            background: none;
            border: none;
            color: #10b981;
            font-size: 0.8rem;
            cursor: pointer;
            padding: 5px 10px;
            border-radius: 6px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        .mark-all-read:hover {
            background: rgba(16, 185, 129, 0.1);
        }
        
        .notifications-list {
            max-height: 300px;
            overflow-y: auto;
            padding: 10px 0;
        }
        
        .notification-item {
            padding: 12px 20px;
            border-bottom: 1px solid #f3f4f6;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }
        
        .notification-item:hover {
            background: #f9fafb;
        }
        
        .notification-item.unread {
            background: rgba(16, 185, 129, 0.05);
            border-right: 3px solid #10b981;
        }
        
        .notification-icon {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
            flex-shrink: 0;
        }
        
        .notification-icon.success {
            background: rgba(16, 185, 129, 0.1);
            color: #10b981;
        }
        
        .notification-icon.warning {
            background: rgba(245, 158, 11, 0.1);
            color: #f59e0b;
        }
        
        .notification-icon.info {
            background: rgba(59, 130, 246, 0.1);
            color: #3b82f6;
        }
        
        .notification-icon.error {
            background: rgba(239, 68, 68, 0.1);
            color: #ef4444;
        }
        
        .notification-content {
            flex: 1;
        }
        
        .notification-title {
            font-weight: 600;
            font-size: 0.85rem;
            color: #1f2937;
            margin-bottom: 4px;
        }
        
        .notification-message {
            font-size: 0.8rem;
            color: #6b7280;
            line-height: 1.4;
            margin-bottom: 4px;
        }
        
        .notification-time {
            font-size: 0.75rem;
            color: #9ca3af;
        }
        
        .no-notifications {
            text-align: center;
            padding: 40px 20px;
            color: #9ca3af;
        }
        
        .no-notifications i {
            font-size: 2rem;
            margin-bottom: 10px;
            display: block;
        }
        
        .no-notifications p {
            margin: 0;
            font-size: 0.9rem;
        }
        
        .notifications-footer {
            padding: 15px 20px;
            border-top: 1px solid #f3f4f6;
            text-align: center;
        }
        
        .notifications-footer a {
            color: #10b981;
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 500;
            transition: color 0.3s ease;
        }
        
        .notifications-footer a:hover {
            color: #059669;
        }
        
        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.1);
            }
        }
        
        .user-menu {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .user-info {
            text-align: left;
        }
        
        .user-name {
            font-weight: 600;
            color: #1f2937;
            font-size: 0.9rem;
        }
        
        .user-role {
            color: #6b7280;
            font-size: 0.8rem;
        }
        
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }
        
        .content-area {
            padding: 30px;
        }
        
        /* Cards */
        .card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        
        .card-body {
            padding: 25px;
        }
        
        .card-header {
            padding: 25px 25px 0;
            border-bottom: 1px solid #e5e7eb;
            margin-bottom: 0;
        }
        
        .card-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 10px;
        }
        
        /* Buttons */
        .btn {
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 0.9rem;
        }
        
        .btn-primary {
            background: #10b981;
            color: white;
        }
        
        .btn-primary:hover {
            background: #059669;
            transform: translateY(-1px);
        }
        
        .btn-secondary {
            background: #6b7280;
            color: white;
        }
        
        .btn-secondary:hover {
            background: #4b5563;
        }
        
        .btn-danger {
            background: #ef4444;
            color: white;
        }
        
        .btn-danger:hover {
            background: #dc2626;
        }
        
        .btn-outline {
            background: transparent;
            color: #10b981;
            border: 2px solid #10b981;
        }
        
        .btn-outline:hover {
            background: #10b981;
            color: white;
        }
        
        /* Tables */
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .table th,
        .table td {
            padding: 12px 15px;
            text-align: right;
            border-bottom: 1px solid #e5e7eb;
        }
        
        .table th {
            background: #f8fafc;
            font-weight: 600;
            color: #374151;
        }
        
        .table tbody tr:hover {
            background: #f8fafc;
        }
        
        /* Status Badges */
        .badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }
        
        .badge-success {
            background: #d1fae5;
            color: #065f46;
        }
        
        .badge-warning {
            background: #fef3c7;
            color: #92400e;
        }
        
        .badge-danger {
            background: #fee2e2;
            color: #991b1b;
        }
        
        .badge-info {
            background: #dbeafe;
            color: #1e40af;
        }
        
        /* Mobile Menu Toggle */
        .mobile-menu-toggle {
            display: none;
            background: none;
            border: none;
            color: #1f2937;
            font-size: 1.5rem;
            cursor: pointer;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(100%);
                transition: transform 0.3s ease;
                width: 100%;
                max-width: 320px;
                box-shadow: 0 0 20px rgba(0,0,0,0.3);
            }
            
            .sidebar.active {
                transform: translateX(0);
            }
            
            .sidebar-header {
                padding: 20px;
                position: relative;
            }
            
            .sidebar-header::after {
                content: '';
                position: absolute;
                bottom: 0;
                left: 20px;
                right: 20px;
                height: 1px;
                background: linear-gradient(90deg, transparent, #374151, transparent);
            }
            
            .sidebar-nav {
                padding: 15px 0;
            }
            
            .nav-section {
                margin-bottom: 20px;
            }
            
            .nav-section-title {
                padding: 0 20px 8px;
                font-size: 0.75rem;
                font-weight: 600;
                color: #6b7280;
            }
            
            .nav-item {
                padding: 16px 20px;
                margin: 0 10px;
                border-radius: 12px;
                border-right: none;
                font-size: 1rem;
                font-weight: 600;
                position: relative;
                overflow: hidden;
            }
            
            .nav-item::before {
                content: '';
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
                transition: left 0.5s ease;
            }
            
            .nav-item:hover::before {
                left: 100%;
            }
            
            .nav-item:hover {
                background: #374151;
                transform: translateX(-8px) scale(1.02);
                box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
            }
            
            .nav-item.active {
                background: linear-gradient(135deg, #10b981, #059669);
                color: white;
                border-right: none;
                box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
                transform: translateX(-5px);
            }
            
            .nav-item.active::before {
                display: none;
            }
            
            .nav-item i {
                width: 24px;
                font-size: 1.1rem;
            }
            
            .main-content {
                margin-right: 0;
            }
            
            .mobile-menu-toggle {
                display: block;
                background: linear-gradient(135deg, #10b981, #059669);
                color: white;
                border: none;
                padding: 12px;
                border-radius: 10px;
                font-size: 1.3rem;
                transition: all 0.3s ease;
                box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
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
                background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
                transition: left 0.5s ease;
            }
            
            .mobile-menu-toggle:hover::before {
                left: 100%;
            }
            
            .mobile-menu-toggle:hover {
                background: linear-gradient(135deg, #059669, #047857);
                transform: scale(1.05);
                box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
            }
            
            .content-area {
                padding: 20px;
            }
            
            /* Overlay for mobile sidebar */
            .sidebar-overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0,0,0,0.5);
                z-index: 999;
                opacity: 0;
                transition: opacity 0.3s ease;
                backdrop-filter: blur(2px);
            }
            
            .sidebar-overlay.active {
                display: block;
                opacity: 1;
            }
            
            /* Close button for mobile sidebar */
            .sidebar-close {
                display: none;
                position: absolute;
                top: 20px;
                right: 20px;
                background: rgba(255,255,255,0.1);
                border: 1px solid rgba(255,255,255,0.2);
                color: white;
                padding: 8px;
                border-radius: 50%;
                font-size: 1.2rem;
                cursor: pointer;
                transition: all 0.3s ease;
                backdrop-filter: blur(5px);
            }
            
            .sidebar-close:hover {
                background: rgba(255,255,255,0.2);
                transform: scale(1.1);
            }
            
            .sidebar.active .sidebar-close {
                display: block;
            }
        }
        
        /* Enhanced mobile styles for smaller screens */
        @media (max-width: 480px) {
            .sidebar {
                max-width: 280px;
            }
            
            .nav-item {
                padding: 12px 15px;
                margin: 0 8px;
                font-size: 0.9rem;
            }
            
            .nav-item i {
                width: 20px;
                font-size: 1rem;
            }
            
            .sidebar-header {
                padding: 15px;
            }
            
            .sidebar-logo {
                font-size: 1.3rem;
            }
            
            .top-bar {
                padding: 10px 15px;
            }
            
            .page-title {
                font-size: 1.2rem;
            }
            
            .user-menu {
                gap: 10px;
            }
            
            .user-avatar {
                width: 35px;
                height: 35px;
            }
            
            .logout-btn {
                padding: 6px 12px;
                font-size: 0.8rem;
                background: #ef4444 !important;
                border-color: #ef4444 !important;
                color: white !important;
            }
            
            .logout-btn:hover {
                background: #dc2626 !important;
                border-color: #dc2626 !important;
                color: white !important;
            }
            
            .sidebar-close {
                top: 15px;
                right: 15px;
                padding: 6px;
                font-size: 1rem;
            }
        }
        
        /* Landscape mobile optimization */
        @media (max-width: 768px) and (orientation: landscape) {
            .sidebar {
                max-width: 300px;
            }
            
            .nav-item {
                padding: 10px 15px;
            }
            
            .sidebar-nav {
                padding: 10px 0;
            }
        }
        
        /* Utilities */
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .text-left { text-align: left; }
        .mb-20 { margin-bottom: 20px; }
        .mb-30 { margin-bottom: 30px; }
        .mt-20 { margin-top: 20px; }
        .mt-30 { margin-top: 30px; }
        .d-flex { display: flex; }
        .align-items-center { align-items: center; }
        .justify-content-between { justify-content: space-between; }
        .gap-15 { gap: 15px; }
        .gap-20 { gap: 20px; }
        
        /* Global Pagination Styles */
        .pagination {
            margin: 0;
            padding: 0;
            list-style: none;
            display: flex;
            align-items: center;
            gap: 5px;
            justify-content: center;
        }
        
        .pagination .page-item {
            margin: 0;
        }
        
        .pagination .page-link {
            padding: 8px 12px;
            border: 1px solid #d1d5db;
            background-color: white;
            color: #374151;
            text-decoration: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.2s ease;
            min-width: 40px;
            text-align: center;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            line-height: 1;
        }
        
        .pagination .page-link:hover {
            background-color: #f3f4f6;
            border-color: #9ca3af;
            color: #1f2937;
        }
        
        .pagination .page-item.active .page-link {
            background-color: #10b981;
            border-color: #10b981;
            color: white;
        }
        
        .pagination .page-item.disabled .page-link {
            background-color: #f9fafb;
            border-color: #e5e7eb;
            color: #9ca3af;
            cursor: not-allowed;
        }
        
        .pagination .page-link:focus {
            box-shadow: 0 0 0 0.2rem rgba(16, 185, 129, 0.25);
            outline: none;
        }
        
        /* Ensure pagination icons are properly sized */
        .pagination .page-link svg,
        .pagination .page-link i {
            width: 16px;
            height: 16px;
            font-size: 16px;
        }
        
        /* Responsive pagination */
        @media (max-width: 768px) {
            .pagination {
                flex-wrap: wrap;
                justify-content: center;
            }
            
            .pagination .page-link {
                padding: 6px 10px;
                font-size: 13px;
                min-width: 36px;
            }
        }
        
        /* Responsive Notifications */
        @media (max-width: 768px) {
            .notifications-panel {
                width: 300px;
                right: -50px;
            }
            
            .header-actions {
                gap: 15px;
            }
        }
        
        @media (max-width: 480px) {
            .notifications-panel {
                width: 280px;
                right: -80px;
            }
            
            .header-actions {
                gap: 10px;
            }
            
            .notifications-toggle {
                font-size: 1rem;
                padding: 6px;
            }
            
            .notifications-badge {
                font-size: 0.6rem;
                padding: 1px 4px;
                min-width: 16px;
            }
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <div class="admin-container">
        <!-- Mobile Sidebar Overlay -->
        <div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>
        
        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <button class="sidebar-close" onclick="toggleSidebar()">
                <i class="bi bi-x-lg"></i>
            </button>
            <div class="sidebar-header">
                <a href="{{ route('admin.dashboard') }}" class="sidebar-logo">
                    @if(setting('site_logo'))
                        <img src="{{ asset(setting('site_logo')) }}" alt="{{ setting('site_name', 'أكاديمية السهم الأخضر') }}" style="height: 30px; width: auto; margin-left: 10px;">
                    @else
                        <i class="bi bi-arrow-up-circle"></i>
                    @endif
                    {{ setting('site_name', 'لوحة الإدارة') }}
                </a>
            </div>
            
            <nav class="sidebar-nav">
                <div class="nav-section">
                    <div class="nav-section-title">الرئيسية</div>
                    <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="bi bi-speedometer2"></i>
                        لوحة التحكم
                    </a>
                </div>
                
                <div class="nav-section">
                    <div class="nav-section-title">إدارة المستخدمين</div>
                    <a href="{{ route('admin.users') }}" class="nav-item {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
                        <i class="bi bi-people"></i>
                        جميع المستخدمين
                    </a>
                    <a href="{{ route('admin.students') }}" class="nav-item {{ request()->routeIs('admin.students*') ? 'active' : '' }}">
                        <i class="bi bi-person-check"></i>
                        الطلاب
                    </a>
                    <a href="{{ route('admin.instructors') }}" class="nav-item {{ request()->routeIs('admin.instructors*') ? 'active' : '' }}">
                        <i class="bi bi-person-workspace"></i>
                        المدربين
                    </a>
                </div>
                
                <div class="nav-section">
                    <div class="nav-section-title">إدارة المحتوى</div>
                    <a href="{{ route('admin.categories') }}" class="nav-item {{ request()->routeIs('admin.categories*') ? 'active' : '' }}">
                        <i class="bi bi-folder"></i>
                        الأقسام
                    </a>
                    <a href="{{ route('admin.courses') }}" class="nav-item {{ request()->routeIs('admin.courses*') ? 'active' : '' }}">
                        <i class="bi bi-book"></i>
                        الدورات
                    </a>
                    <a href="{{ route('admin.blog') }}" class="nav-item {{ request()->routeIs('admin.blog*') ? 'active' : '' }}">
                        <i class="bi bi-file-text"></i>
                        المدونة
                    </a>
                </div>
                
                <div class="nav-section">
                    <div class="nav-section-title">المالية</div>
                    <a href="{{ route('admin.payments') }}" class="nav-item {{ request()->routeIs('admin.payments*') ? 'active' : '' }}">
                        <i class="bi bi-credit-card"></i>
                        المدفوعات
                    </a>
                </div>
                
                <div class="nav-section">
                    <div class="nav-section-title">التقارير</div>
                    <a href="{{ route('admin.reports') }}" class="nav-item {{ request()->routeIs('admin.reports*') ? 'active' : '' }}">
                        <i class="bi bi-graph-up"></i>
                        التقارير
                    </a>
                </div>
                
                <div class="nav-section">
                    <div class="nav-section-title">التواصل</div>
                    <a href="{{ route('admin.contact.index') }}" class="nav-item {{ request()->routeIs('admin.contact*') ? 'active' : '' }}">
                        <i class="bi bi-envelope"></i>
                        رسائل التواصل
                    </a>
                </div>
                
                <div class="nav-section">
                    <div class="nav-section-title">الإشعارات</div>
                    <a href="{{ route('admin.notifications') }}" class="nav-item {{ request()->routeIs('admin.notifications*') ? 'active' : '' }}">
                        <i class="bi bi-bell"></i>
                        الإشعارات
                    </a>
                </div>
                
                <div class="nav-section">
                    <div class="nav-section-title">الإعدادات</div>
                    <a href="{{ route('admin.seo') }}" class="nav-item {{ request()->routeIs('admin.seo*') ? 'active' : '' }}">
                        <i class="bi bi-search"></i>
                        إدارة SEO
                    </a>
                    <a href="{{ route('admin.settings') }}" class="nav-item {{ request()->routeIs('admin.settings*') ? 'active' : '' }}">
                        <i class="bi bi-gear"></i>
                        الإعدادات
                    </a>

                </div>
            </nav>
        </aside>
        
        <!-- Main Content -->
        <main class="main-content">
            <!-- Top Bar -->
            <header class="top-bar">
                <div class="d-flex align-items-center gap-20">
                    <button class="mobile-menu-toggle" onclick="toggleSidebar()">
                        <i class="bi bi-list"></i>
                    </button>
                    <h1 class="page-title">@yield('title', 'لوحة الإدارة')</h1>
                </div>
                
                <div class="header-actions">
                    <!-- Visit Website Button -->
                    <a href="{{ route('home') }}" target="_blank" class="visit-website-btn">
                        <i class="bi bi-globe"></i>
                        <span>زيارة الموقع</span>
                    </a>
                    
                    <!-- Notifications -->
                    <div class="notifications-dropdown">
                        <button class="notifications-toggle" id="notificationsToggle">
                            <i class="bi bi-bell"></i>
                            <span class="notifications-badge" id="notificationsCount">0</span>
                        </button>
                        
                        <div class="notifications-panel" id="notificationsPanel">
                            <div class="notifications-header">
                                <h6>الإشعارات</h6>
                                <div class="header-actions">
                                    <button class="mark-all-read" onclick="markAllAsRead()">
                                        <i class="bi bi-check-all"></i>
                                        تحديد الكل كمقروء
                                    </button>
                                </div>
                            </div>
                            
                            <div class="notifications-list" id="notificationsList">
                                <div class="no-notifications">
                                    <i class="bi bi-bell-slash"></i>
                                    <p>لم يصل أي إشعار من الموقع</p>
                                </div>
                            </div>
                            
                            <div class="notifications-footer">
                                <a href="#" onclick="viewAllNotifications()">عرض جميع الإشعارات</a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- User Menu -->
                    <div class="user-menu">
                        <div class="user-info">
                            <div class="user-name">{{ auth()->user()->name }}</div>
                            <div class="user-role">مدير</div>
                        </div>
                        <img src="{{ auth()->user()->avatar_url }}" alt="{{ auth()->user()->name }}" class="user-avatar">
                        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-danger" style="padding: 8px 15px; font-size: 0.8rem; background: #ef4444; border-color: #ef4444; color: white;">
                                <i class="bi bi-box-arrow-right"></i>
                                خروج
                            </button>
                        </form>
                    </div>
                </div>
            </header>
            
            <!-- Content Area -->
            <div class="content-area">
                @if(session('success'))
                    <div class="alert alert-success" style="background: #d1fae5; color: #065f46; padding: 15px 20px; border-radius: 10px; margin-bottom: 20px; border-right: 4px solid #10b981;">
                        <i class="bi bi-check-circle"></i>
                        {{ session('success') }}
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="alert alert-error" style="background: #fee2e2; color: #991b1b; padding: 15px 20px; border-radius: 10px; margin-bottom: 20px; border-right: 4px solid #ef4444;">
                        <i class="bi bi-exclamation-triangle"></i>
                        {{ session('error') }}
                    </div>
                @endif
                
                @if(session('warning'))
                    <div class="alert alert-warning" style="background: #fef3c7; color: #92400e; padding: 15px 20px; border-radius: 10px; margin-bottom: 20px; border-right: 4px solid #f59e0b;">
                        <i class="bi bi-exclamation-circle"></i>
                        {{ session('warning') }}
                    </div>
                @endif
                
                @if(session('info'))
                    <div class="alert alert-info" style="background: #dbeafe; color: #1e40af; padding: 15px 20px; border-radius: 10px; margin-bottom: 20px; border-right: 4px solid #3b82f6;">
                        <i class="bi bi-info-circle"></i>
                        {{ session('info') }}
                    </div>
                @endif
                
                @yield('content')
            </div>
        </main>
    </div>
    
    <script>
        // Test notifications functionality
        console.log('Admin layout script loaded');
        
        // Check if elements exist
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM loaded');
            
            const toggleButton = document.getElementById('notificationsToggle');
            const panel = document.getElementById('notificationsPanel');
            
            console.log('Toggle button:', toggleButton);
            console.log('Panel:', panel);
            
            if (toggleButton) {
                console.log('Toggle button found, adding click listener');
                toggleButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    console.log('Toggle button clicked');
                    toggleNotifications();
                });
            } else {
                console.error('Toggle button not found');
            }
        });

        // Notifications functionality
        function toggleNotifications() {
            console.log('Toggle notifications clicked');
            const panel = document.getElementById('notificationsPanel');
            const toggle = document.querySelector('.notifications-toggle');
            
            if (!panel) {
                console.error('Notifications panel not found');
                return;
            }
            
            console.log('Panel found, toggling...');
            panel.classList.toggle('active');
            
            // Close when clicking outside
            if (panel.classList.contains('active')) {
                console.log('Panel is now active');
                document.addEventListener('click', closeNotificationsOnClickOutside);
            } else {
                console.log('Panel is now inactive');
                document.removeEventListener('click', closeNotificationsOnClickOutside);
            }
        }
        
        function closeNotificationsOnClickOutside(event) {
            const panel = document.getElementById('notificationsPanel');
            const toggle = document.querySelector('.notifications-toggle');
            
            if (!panel.contains(event.target) && !toggle.contains(event.target)) {
                panel.classList.remove('active');
                document.removeEventListener('click', closeNotificationsOnClickOutside);
            }
        }
        
        function markAllAsRead() {
            fetch('/admin/notifications/mark-all-read', {
                method: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Remove unread class from all notifications
                    document.querySelectorAll('.notification-item.unread').forEach(item => {
                        item.classList.remove('unread');
                    });
                    
                    // Update badge count
                    updateNotificationBadge(0);
                    
                    // Show success message
                    showNotification('تم تحديد جميع الإشعارات كمقروءة', 'success');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('حدث خطأ أثناء تحديث الإشعارات', 'error');
            });
        }
        
        function viewAllNotifications() {
            // Redirect to notifications page or show all notifications
            window.location.href = '{{ route("admin.notifications") }}';
        }
        
        function updateNotificationBadge(count) {
            const badge = document.getElementById('notificationsCount');
            badge.textContent = count;
            
            if (count > 0) {
                badge.style.display = 'block';
            } else {
                badge.style.display = 'none';
            }
        }
        
        function showNotification(message, type = 'info') {
            const alertClass = type === 'success' ? 'alert-success' : 
                             type === 'error' ? 'alert-danger' : 
                             type === 'warning' ? 'alert-warning' : 'alert-info';
            
            const notification = `
                <div class="alert ${alertClass} alert-dismissible fade show" role="alert" style="position: fixed; top: 20px; right: 20px; z-index: 9999; min-width: 300px;">
                    <i class="bi bi-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-triangle' : 'info-circle'}"></i>
                    ${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            `;
            
            document.body.insertAdjacentHTML('beforeend', notification);
            
            // Auto remove after 5 seconds
            setTimeout(() => {
                const alerts = document.querySelectorAll('.alert');
                if (alerts.length > 0) {
                    alerts[alerts.length - 1].remove();
                }
            }, 5000);
        }
        
        // Load notifications on page load
        document.addEventListener('DOMContentLoaded', function() {
            loadNotifications();
            
            // Auto refresh notifications every 30 seconds
            setInterval(loadNotifications, 30000);
        });
        
        function loadNotifications() {
            console.log('Loading notifications...');
            fetch('/admin/notifications/api', {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                console.log('Notifications data:', data);
                const notificationsList = document.getElementById('notificationsList');
                const noNotifications = document.querySelector('.no-notifications');
                
                if (data.notifications && data.notifications.length > 0) {
                    console.log('Found notifications:', data.notifications.length);
                    // Hide no notifications message
                    if (noNotifications) {
                        noNotifications.style.display = 'none';
                    }
                    
                    // Clear existing notifications
                    notificationsList.innerHTML = '';
                    
                    // Add notifications
                    data.notifications.forEach(notification => {
                        const notificationHtml = `
                            <div class="notification-item ${!notification.read_at ? 'unread' : ''}" 
                                 data-notification-id="${notification.id}">
                                <div class="notification-icon ${notification.type || 'info'}">
                                    <i class="bi bi-${getNotificationIcon(notification.type)}"></i>
                                </div>
                                <div class="notification-content">
                                    <div class="notification-title">${notification.title}</div>
                                    <div class="notification-message">${notification.message}</div>
                                    <div class="notification-time">${formatTime(notification.created_at)}</div>
                                </div>
                                <div class="notification-actions">
                                    ${!notification.read_at ? `
                                        <button class="btn btn-sm btn-outline-success" 
                                                onclick="markAsRead(${notification.id})"
                                                title="تحديد كمقروء">
                                            <i class="bi bi-check"></i>
                                        </button>
                                    ` : ''}
                                    <button class="btn btn-sm btn-outline-danger" 
                                            onclick="deleteNotification(${notification.id})"
                                            title="حذف">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </div>
                        `;
                        notificationsList.insertAdjacentHTML('beforeend', notificationHtml);
                    });
                } else {
                    console.log('No notifications found');
                    // Show no notifications message
                    if (noNotifications) {
                        noNotifications.style.display = 'block';
                    }
                }
                
                // Update badge count
                updateNotificationBadge(data.unread_count || 0);
            })
            .catch(error => {
                console.error('Error loading notifications:', error);
                // Show no notifications message on error
                const noNotifications = document.querySelector('.no-notifications');
                if (noNotifications) {
                    noNotifications.style.display = 'block';
                }
                updateNotificationBadge(0);
            });
        }
        
        function getNotificationIcon(type) {
            switch (type) {
                case 'success': return 'check-circle';
                case 'warning': return 'exclamation-triangle';
                case 'error': return 'x-circle';
                default: return 'info-circle';
            }
        }

        function formatTime(dateString) {
            const date = new Date(dateString);
            const now = new Date();
            const diffInMinutes = Math.floor((now - date) / (1000 * 60));
            
            if (diffInMinutes < 1) return 'الآن';
            if (diffInMinutes < 60) return `منذ ${diffInMinutes} دقيقة`;
            
            const diffInHours = Math.floor(diffInMinutes / 60);
            if (diffInHours < 24) return `منذ ${diffInHours} ساعة`;
            
            const diffInDays = Math.floor(diffInHours / 24);
            return `منذ ${diffInDays} يوم`;
        }

        function markAsRead(notificationId) {
            fetch(`/admin/notifications/${notificationId}/read`, {
                method: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const notificationItem = document.querySelector(`[data-notification-id="${notificationId}"]`);
                    if (notificationItem) {
                        notificationItem.classList.remove('unread');
                    }
                    
                    // Update badge count
                    loadNotifications();
                    
                    showNotification('تم تحديد الإشعار كمقروء', 'success');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('حدث خطأ أثناء تحديث الإشعار', 'error');
            });
        }

        function deleteNotification(notificationId) {
            if (!confirm('هل تريد حذف هذا الإشعار؟')) {
                return;
            }
            
            fetch(`/admin/notifications/${notificationId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const notificationItem = document.querySelector(`[data-notification-id="${notificationId}"]`);
                    if (notificationItem) {
                        notificationItem.remove();
                    }
                    
                    // Update badge count
                    loadNotifications();
                    
                    showNotification('تم حذف الإشعار بنجاح', 'success');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('حدث خطأ أثناء حذف الإشعار', 'error');
            });
        }

        function formatTimeExtended(timestamp) {
            const date = new Date(timestamp);
            const now = new Date();
            const diffInMinutes = Math.floor((now - date) / (1000 * 60));
            
            if (diffInMinutes < 1) return 'الآن';
            if (diffInMinutes < 60) return `منذ ${diffInMinutes} دقيقة`;
            
            const diffInHours = Math.floor(diffInMinutes / 60);
            if (diffInHours < 24) return `منذ ${diffInHours} ساعة`;
            
            const diffInDays = Math.floor(diffInHours / 24);
            if (diffInDays < 7) return `منذ ${diffInDays} يوم`;
            
            return date.toLocaleDateString('ar-SA');
        }
        
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
            
            // Prevent body scroll when sidebar is open
            document.body.style.overflow = sidebar.classList.contains('active') ? 'hidden' : '';
        }
        
        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar');
            const toggleButton = document.querySelector('.mobile-menu-toggle');
            const closeButton = document.querySelector('.sidebar-close');
            
            if (window.innerWidth <= 768) {
                if (!sidebar.contains(event.target) && !toggleButton.contains(event.target) && !closeButton.contains(event.target)) {
                    sidebar.classList.remove('active');
                    document.getElementById('sidebarOverlay').classList.remove('active');
                    document.body.style.overflow = '';
                }
            }
        });
        
        // Close sidebar on window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768) {
                const sidebar = document.getElementById('sidebar');
                const overlay = document.getElementById('sidebarOverlay');
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
                document.body.style.overflow = '';
            }
        });
        
        // Close sidebar when clicking on navigation links
        document.addEventListener('DOMContentLoaded', function() {
            const navLinks = document.querySelectorAll('.nav-item');
            navLinks.forEach(function(link) {
                link.addEventListener('click', function() {
                    if (window.innerWidth <= 768) {
                        const sidebar = document.getElementById('sidebar');
                        const overlay = document.getElementById('sidebarOverlay');
                        sidebar.classList.remove('active');
                        overlay.classList.remove('active');
                        document.body.style.overflow = '';
                    }
                });
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
    </script>
    
    @stack('scripts')
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    @include('components.header-footer-styles')
    @include('components.header-footer-scripts')
    
    <!-- Notifications JS -->
    <script src="{{ asset('js/notifications.js') }}"></script>
</body>
</html> 