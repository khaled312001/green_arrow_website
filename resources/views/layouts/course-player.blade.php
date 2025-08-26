<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'متابعة الدورة') - أكاديمية السهم الأخضر</title>
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Course Player CSS -->
    <link rel="stylesheet" href="{{ asset('css/course-player.css') }}">
    
    @stack('styles')
</head>
<body>
    <!-- Top Navigation Bar -->
    <nav class="top-nav" style="position: fixed; top: 0; left: 0; right: 0; height: 60px; background: var(--bg-primary); border-bottom: 1px solid var(--border-color); z-index: 999; display: flex; align-items: center; justify-content: space-between; padding: 0 20px;">
        <div class="nav-left" style="display: flex; align-items: center; gap: 20px;">
            <a href="{{ route('student.dashboard') }}" class="nav-link" style="color: var(--text-secondary); text-decoration: none; font-weight: 600; display: flex; align-items: center; gap: 8px;">
                <i class="bi bi-arrow-right"></i>
                العودة للوحة التحكم
            </a>
        </div>
        
        <div class="nav-center" style="flex: 1; text-align: center; margin: 0 20px;">
            <h1 style="margin: 0; font-size: 1.2rem; font-weight: 700; color: var(--text-primary); white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                {{ $course->title_ar ?? 'متابعة الدورة' }}
            </h1>
        </div>
        
        <div class="nav-right" style="display: flex; align-items: center; gap: 15px;">
            <div class="user-info" style="display: flex; align-items: center; gap: 10px;">
                <div class="user-avatar" style="width: 35px; height: 35px; background: var(--secondary-color); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: 0.9rem;">
                    {{ substr(auth()->user()->name, 0, 2) }}
                </div>
                <span style="color: var(--text-primary); font-weight: 600; font-size: 0.9rem;">
                    {{ auth()->user()->name }}
                </span>
            </div>
            
            <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                @csrf
                <button type="submit" class="logout-btn" style="background: none; border: none; color: var(--error-color); cursor: pointer; font-size: 0.9rem; font-weight: 600; display: flex; align-items: center; gap: 5px;">
                    <i class="bi bi-box-arrow-right"></i>
                    تسجيل الخروج
                </button>
            </form>
        </div>
    </nav>

    <!-- Main Content -->
    <main style="margin-top: 60px; height: calc(100vh - 60px);">
        @yield('content')
    </main>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
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
</body>
</html> 