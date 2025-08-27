<!-- Enhanced Header Top Bar -->
<div class="header-top">
    <div class="container">
        <div class="top-bar-content">
            <div class="contact-info">
                @if(setting('site_phone'))
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="bi bi-telephone-fill"></i>
                        </div>
                        <div class="contact-details">
                            <span class="contact-label">اتصل بنا</span>
                            <a href="tel:{{ setting('site_phone') }}" class="contact-value">{{ setting('site_phone') }}</a>
                        </div>
                    </div>
                @endif
                @if(setting('site_email'))
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="bi bi-envelope-fill"></i>
                        </div>
                        <div class="contact-details">
                            <span class="contact-label">البريد الإلكتروني</span>
                            <a href="mailto:{{ setting('site_email') }}" class="contact-value">{{ setting('site_email') }}</a>
                        </div>
                    </div>
                @endif
                @if(setting('site_working_hours'))
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="bi bi-clock-fill"></i>
                        </div>
                        <div class="contact-details">
                            <span class="contact-label">ساعات العمل</span>
                            <span class="contact-value">{{ setting('site_working_hours') }}</span>
                        </div>
                    </div>
                @endif
            </div>
            
            <div class="top-bar-right">
                <div class="social-links">
                    <a href="https://api.whatsapp.com/send?phone=9660598200437" target="_blank" rel="noopener noreferrer" class="social-link whatsapp" title="WhatsApp">
                        <i class="bi bi-whatsapp"></i>
                        <span class="social-tooltip">WhatsApp</span>
                    </a>
                    <a href="https://x.com/greenarrowac" target="_blank" rel="noopener noreferrer" class="social-link twitter" title="X (Twitter)">
                        <i class="bi bi-twitter-x"></i>
                        <span class="social-tooltip">X (Twitter)</span>
                    </a>
                    <a href="https://t.me/greenarrowac" target="_blank" rel="noopener noreferrer" class="social-link telegram" title="Telegram">
                        <i class="bi bi-telegram"></i>
                        <span class="social-tooltip">Telegram</span>
                    </a>
                    <a href="https://www.youtube.com/@%D8%A3%D9%83%D8%A7%D8%AF%D9%8A%D9%85%D9%8A%D8%A9%D8%A7%D9%84%D8%B3%D9%87%D9%85%D8%A7%D9%84%D8%A3%D8%AE%D8%B6%D8%B1" target="_blank" rel="noopener noreferrer" class="social-link youtube" title="YouTube">
                        <i class="bi bi-youtube"></i>
                        <span class="social-tooltip">YouTube</span>
                    </a>
                    <a href="https://tiktok.com/@green.arrow645" target="_blank" rel="noopener noreferrer" class="social-link tiktok" title="TikTok">
                        <i class="bi bi-tiktok"></i>
                        <span class="social-tooltip">TikTok</span>
                    </a>
                    <a href="mailto:greenarrowacademic@gmail.com" class="social-link email" title="Email">
                        <i class="bi bi-envelope"></i>
                        <span class="social-tooltip">Email</span>
                    </a>
                </div>
                
                
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Enhanced Header Main -->
<div class="header-main">
    <div class="container">
        <nav class="navbar">
            <div class="navbar-brand">
                <a href="{{ route('home') }}" class="logo">
                    <div class="logo-container">
                        @if(setting('site_logo'))
                            <img src="{{ setting('site_logo') }}" alt="{{ setting('site_name', 'أكاديمية السهم الأخضر') }}" class="logo-image">
                        @endif
                        <div class="logo-text">
                            <span class="logo-title">{{ setting('site_name', 'أكاديمية السهم الأخضر') }}</span>
                            <span class="logo-subtitle">GREEN ARROW ACADEMY</span>
                        </div>
                    </div>
                </a>
            </div>
            
            <div class="navbar-menu">
                <ul class="nav-menu" id="navMenu">
                    <li class="nav-item">
                        <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                            <i class="bi bi-house-door"></i>
                            <span>الرئيسية</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('about') }}" class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}">
                            <i class="bi bi-info-circle"></i>
                            <span>من نحن</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('courses') }}" class="nav-link {{ request()->routeIs('courses*') ? 'active' : '' }}">
                            <i class="bi bi-book"></i>
                            <span>الدورات</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('instructors') }}" class="nav-link {{ request()->routeIs('instructors*') ? 'active' : '' }}">
                            <i class="bi bi-person-workspace"></i>
                            <span>المدربين</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('blog') }}" class="nav-link {{ request()->routeIs('blog*') ? 'active' : '' }}">
                            <i class="bi bi-journal-text"></i>
                            <span>المدونة</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('contact') }}" class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">
                            <i class="bi bi-telephone"></i>
                            <span>اتصل بنا</span>
                        </a>
                    </li>
                </ul>
            </div>
            
            <div class="navbar-actions">
                
                @auth
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
                @endauth
                
                <div class="auth-buttons">
                    @guest
                        <a href="{{ route('login') }}" class="btn btn-outline">
                            <i class="bi bi-box-arrow-in-right"></i>
                            <span>دخول</span>
                        </a>
                        <a href="{{ route('register') }}" class="btn btn-primary">
                            <i class="bi bi-person-plus"></i>
                            <span>سجل الآن</span>
                        </a>
                    @else
                        <div class="user-menu">
                            <button class="user-toggle" onclick="toggleUserMenu()">
                                <div class="user-avatar">
                                    @if(auth()->user()->avatar_url)
                                        <img src="{{ auth()->user()->avatar_url }}" alt="{{ auth()->user()->name }}">
                                    @else
                                        <i class="bi bi-person-circle"></i>
                                    @endif
                                </div>
                                <span class="user-name">{{ auth()->user()->name }}</span>
                                <i class="bi bi-chevron-down"></i>
                            </button>
                            <div class="user-dropdown" id="userDropdown">
                                @if(auth()->user()->isAdmin())
                                    <a href="{{ route('admin.dashboard') }}" class="dropdown-item">
                                        <i class="bi bi-speedometer2"></i>
                                        لوحة الإدارة
                                    </a>
                                @elseif(auth()->user()->isInstructor())
                                    <a href="{{ route('teacher.dashboard') }}" class="dropdown-item">
                                        <i class="bi bi-person-workspace"></i>
                                        لوحة المعلم
                                    </a>
                                @else
                                    <a href="{{ route('student.dashboard') }}" class="dropdown-item">
                                        <i class="bi bi-person"></i>
                                        لوحة الطالب
                                    </a>
                                @endif
                                @if(auth()->user()->isAdmin())
                                    <a href="{{ route('admin.settings') }}" class="dropdown-item">
                                        <i class="bi bi-gear"></i>
                                        الإعدادات
                                    </a>
                                @elseif(auth()->user()->isInstructor())
                                    <a href="{{ route('teacher.settings.index') }}" class="dropdown-item">
                                        <i class="bi bi-gear"></i>
                                        الإعدادات
                                    </a>
                                @else
                                    <a href="{{ route('student.settings') }}" class="dropdown-item">
                                        <i class="bi bi-gear"></i>
                                        الإعدادات
                                    </a>
                                @endif
                                <div class="dropdown-divider"></div>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item logout-btn">
                                        <i class="bi bi-box-arrow-right"></i>
                                        خروج
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endguest
                </div>
                
                <button class="mobile-menu-toggle" onclick="toggleMobileMenu()">
                    <span class="hamburger-line"></span>
                    <span class="hamburger-line"></span>
                    <span class="hamburger-line"></span>
                </button>
            </div>
        </nav>
    </div>
</div>

<!-- Mobile Menu -->
<div class="mobile-menu" id="mobileMenu">
    <div class="mobile-menu-header">
        <h3>القائمة الرئيسية</h3>
        <button class="mobile-menu-close" onclick="closeMobileMenu()" title="إغلاق القائمة">
            <i class="bi bi-x-lg"></i>
        </button>
    </div>
    <ul class="mobile-nav-menu">
        <li><a href="{{ route('home') }}" class="mobile-nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
            <i class="bi bi-house-door"></i>الرئيسية
        </a></li>
        <li><a href="{{ route('about') }}" class="mobile-nav-link {{ request()->routeIs('about') ? 'active' : '' }}">
            <i class="bi bi-info-circle"></i>من نحن
        </a></li>
        <li><a href="{{ route('courses') }}" class="mobile-nav-link {{ request()->routeIs('courses*') ? 'active' : '' }}">
            <i class="bi bi-book"></i>الدورات
        </a></li>
        <li><a href="{{ route('instructors') }}" class="mobile-nav-link {{ request()->routeIs('instructors*') ? 'active' : '' }}">
            <i class="bi bi-person-workspace"></i>المدربين
        </a></li>
        <li><a href="{{ route('blog') }}" class="mobile-nav-link {{ request()->routeIs('blog*') ? 'active' : '' }}">
            <i class="bi bi-journal-text"></i>المدونة
        </a></li>
        <li><a href="{{ route('contact') }}" class="mobile-nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">
            <i class="bi bi-telephone"></i>اتصل بنا
        </a></li>
    </ul>
    
    <!-- Social Media Links in Mobile Sidebar -->
    <div class="mobile-social-section">
        <h4>تابعنا على</h4>
        <div class="mobile-social-links">
            <a href="https://api.whatsapp.com/send?phone=9660598200437" target="_blank" rel="noopener noreferrer" class="mobile-social-link whatsapp" title="WhatsApp">
                <i class="bi bi-whatsapp"></i>
                <span>WhatsApp</span>
            </a>
            <a href="https://x.com/greenarrowac" target="_blank" rel="noopener noreferrer" class="mobile-social-link twitter" title="X (Twitter)">
                <i class="bi bi-twitter-x"></i>
                <span>X (Twitter)</span>
            </a>
            <a href="https://t.me/greenarrowac" target="_blank" rel="noopener noreferrer" class="mobile-social-link telegram" title="Telegram">
                <i class="bi bi-telegram"></i>
                <span>Telegram</span>
            </a>
            <a href="https://www.youtube.com/@%D8%A3%D9%83%D8%A7%D8%AF%D9%8A%D9%85%D9%8A%D8%A9%D8%A7%D9%84%D8%B3%D9%87%D9%85%D8%A7%D9%84%D8%A3%D8%AE%D8%B6%D8%B1" target="_blank" rel="noopener noreferrer" class="mobile-social-link youtube" title="YouTube">
                <i class="bi bi-youtube"></i>
                <span>YouTube</span>
            </a>
            <a href="https://tiktok.com/@green.arrow645" target="_blank" rel="noopener noreferrer" class="mobile-social-link tiktok" title="TikTok">
                <i class="bi bi-tiktok"></i>
                <span>TikTok</span>
            </a>
            <a href="mailto:greenarrowacademic@gmail.com" class="mobile-social-link email" title="Email">
                <i class="bi bi-envelope"></i>
                <span>Email</span>
            </a>
        </div>
    </div>
    @guest
        <div class="mobile-auth-buttons">
            <a href="{{ route('login') }}" class="btn btn-outline">
                <i class="bi bi-box-arrow-in-right"></i>
                دخول
            </a>
            <a href="{{ route('register') }}" class="btn btn-primary">
                <i class="bi bi-person-plus"></i>
                سجل الآن
            </a>
        </div>
    @else
        <div class="mobile-user-info">
            <div class="mobile-user-avatar">
                @if(auth()->user()->avatar_url)
                    <img src="{{ auth()->user()->avatar_url }}" alt="{{ auth()->user()->name }}">
                @else
                    <i class="bi bi-person-circle"></i>
                @endif
            </div>
            <div class="mobile-user-details">
                <h4>{{ auth()->user()->name }}</h4>
                <p>{{ auth()->user()->email }}</p>
            </div>
        </div>
        <div class="mobile-user-actions">
            @if(auth()->user()->isAdmin())
                <a href="{{ route('admin.dashboard') }}" class="mobile-action-link">
                    <i class="bi bi-speedometer2"></i>لوحة الإدارة
                </a>
            @elseif(auth()->user()->isInstructor())
                <a href="{{ route('teacher.dashboard') }}" class="mobile-action-link">
                    <i class="bi bi-person-workspace"></i>لوحة المعلم
                </a>
            @else
                <a href="{{ route('student.dashboard') }}" class="mobile-action-link">
                    <i class="bi bi-person"></i>لوحة الطالب
                </a>
            @endif
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="mobile-action-link logout-btn">
                    <i class="bi bi-box-arrow-right"></i>خروج
                </button>
            </form>
        </div>
    @endguest
</div> 