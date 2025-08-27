<!-- Enhanced Footer -->
<footer class="enhanced-footer">
    <div class="footer-background"></div>
    <div class="footer-pattern"></div>
    
    <div class="container">
        <div class="footer-content">
            <!-- Footer Brand Section -->
            <div class="footer-brand">
                <div class="footer-logo">
                    @if(setting('site_logo'))
                        <img src="{{ asset(setting('site_logo')) }}" alt="{{ setting('site_name', 'أكاديمية السهم الأخضر') }}" style="height: 50px; width: auto; margin-bottom: 15px;">
                    @else
                        <div class="logo-icon">
                            <i class="bi bi-mortarboard-fill"></i>
                        </div>
                    @endif
                    <div class="logo-text">
                        <h3>{{ setting('site_name', 'أكاديمية السهم الأخضر') }}</h3>
                        <p class="logo-tagline">{{ setting('site_description', 'نحو مستقبل تعليمي أفضل') }}</p>
                    </div>
                </div>
                <p class="footer-description">
                    {{ setting('site_description', 'نقدم دورات تعليمية عالية الجودة في مختلف المجالات التقنية والبرمجية، نساعدك على تطوير مهاراتك وبناء مستقبلك المهني.') }}
                </p>
                
                <!-- Enhanced Social Links -->
                <div class="footer-social">
                    <h4><i class="bi bi-share"></i> تابعنا على</h4>
                    <div class="social-icons-grid">
                        @if(setting('site_whatsapp'))
                            <a href="https://wa.me/{{ str_replace(['+', ' ', '-'], '', setting('site_whatsapp')) }}" target="_blank" rel="noopener noreferrer" class="social-icon whatsapp" title="WhatsApp">
                                <i class="bi bi-whatsapp"></i>
                            </a>
                        @endif
                        @if(setting('twitter_url'))
                            <a href="{{ setting('twitter_url') }}" target="_blank" rel="noopener noreferrer" class="social-icon twitter" title="X (Twitter)">
                                <i class="bi bi-twitter-x"></i>
                            </a>
                        @endif
                        @if(setting('telegram_url'))
                            <a href="{{ setting('telegram_url') }}" target="_blank" rel="noopener noreferrer" class="social-icon telegram" title="Telegram">
                                <i class="bi bi-telegram"></i>
                            </a>
                        @endif
                        @if(setting('youtube_url'))
                            <a href="{{ setting('youtube_url') }}" target="_blank" rel="noopener noreferrer" class="social-icon youtube" title="YouTube">
                                <i class="bi bi-youtube"></i>
                            </a>
                        @endif
                        @if(setting('tiktok_url'))
                            <a href="{{ setting('tiktok_url') }}" target="_blank" rel="noopener noreferrer" class="social-icon tiktok" title="TikTok">
                                <i class="bi bi-tiktok"></i>
                            </a>
                        @endif
                        @if(setting('site_email'))
                            <a href="mailto:{{ setting('site_email') }}" class="social-icon email" title="Email">
                                <i class="bi bi-envelope"></i>
                            </a>
                        @endif
                        @if(setting('facebook_url'))
                            <a href="{{ setting('facebook_url') }}" target="_blank" rel="noopener noreferrer" class="social-icon facebook" title="Facebook">
                                <i class="bi bi-facebook"></i>
                            </a>
                        @endif
                        @if(setting('instagram_url'))
                            <a href="{{ setting('instagram_url') }}" target="_blank" rel="noopener noreferrer" class="social-icon instagram" title="Instagram">
                                <i class="bi bi-instagram"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Quick Links Section -->
            <div class="footer-section">
                <h4 class="section-title">
                    <i class="bi bi-link-45deg"></i> روابط سريعة
                </h4>
                <ul class="footer-links">
                    <li><a href="{{ route('home') }}"><i class="bi bi-house"></i>الرئيسية</a></li>
                    <li><a href="{{ route('about') }}"><i class="bi bi-info-circle"></i>من نحن</a></li>
                    <li><a href="{{ route('courses') }}"><i class="bi bi-book"></i>الدورات</a></li>
                    <li><a href="{{ route('instructors') }}"><i class="bi bi-person-workspace"></i>المدربين</a></li>
                    <li><a href="{{ route('blog') }}"><i class="bi bi-journal-text"></i>المدونة</a></li>
                    <li><a href="{{ route('contact') }}"><i class="bi bi-envelope"></i>اتصل بنا</a></li>
                </ul>
            </div>

            <!-- Services Section -->
            <div class="footer-section">
                <h4 class="section-title">
                    <i class="bi bi-gear"></i> خدماتنا
                </h4>
                <ul class="footer-links">
                    <li><a href="{{ route('courses') }}?category=programming"><i class="bi bi-code-slash"></i>دورات البرمجة</a></li>
                    <li><a href="{{ route('courses') }}?category=design"><i class="bi bi-palette"></i>دورات التصميم</a></li>
                    <li><a href="{{ route('courses') }}?category=marketing"><i class="bi bi-graph-up"></i>دورات التسويق</a></li>
                    <li><a href="{{ route('courses') }}?category=business"><i class="bi bi-briefcase"></i>دورات الأعمال</a></li>
                    <li><a href="{{ route('courses') }}?category=language"><i class="bi bi-translate"></i>دورات اللغات</a></li>
                    <li><a href="{{ route('courses') }}?category=soft-skills"><i class="bi bi-people"></i>المهارات الناعمة</a></li>
                    <li><a href="{{ route('certificates.verify') }}"><i class="bi bi-shield-check"></i>التحقق من الشهادات</a></li>
                </ul>
            </div>

            <!-- Contact Info Section -->
            <div class="footer-section">
                <h4 class="section-title">
                    <i class="bi bi-geo-alt"></i> معلومات الاتصال
                </h4>
                <div class="contact-cards">
                    <div class="contact-card">
                        <div class="contact-card-icon">
                            <i class="bi bi-clock"></i>
                        </div>
                        <div class="contact-card-content">
                            <h5>ساعات العمل</h5>
                            <p>{{ setting('site_working_hours', 'الأحد - الخميس: 9:00 ص - 6:00 م') }}</p>
                        </div>
                    </div>
                    <div class="contact-card">
                        <div class="contact-card-icon">
                            <i class="bi bi-envelope"></i>
                        </div>
                        <div class="contact-card-content">
                            <h5>البريد الإلكتروني</h5>
                            <p>{{ setting('site_email', 'greenarrowacademic@gmail.com') }}</p>
                        </div>
                    </div>
                    <div class="contact-card">
                        <div class="contact-card-icon">
                            <i class="bi bi-telephone"></i>
                        </div>
                        <div class="contact-card-content">
                            <h5>الهاتف</h5>
                            <p>{{ setting('site_phone', '+966 50 826 0274') }}</p>
                        </div>
                    </div>
                    <div class="contact-card">
                        <div class="contact-card-icon">
                            <i class="bi bi-geo-alt"></i>
                        </div>
                        <div class="contact-card-content">
                            <h5>العنوان</h5>
                            <p>{{ setting('site_address', 'مكة المكرمة - حي الخضراء') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional Services Section -->
            <div class="footer-section">
                <h4 class="section-title">
                    <i class="bi bi-star"></i> خدمات إضافية
                </h4>
                <ul class="footer-links">
                    <li><a href="{{ route('courses') }}?type=online"><i class="bi bi-laptop"></i>الدورات الإلكترونية</a></li>
                    <li><a href="{{ route('courses') }}?type=offline"><i class="bi bi-building"></i>الدورات الحضورية</a></li>
                    <li><a href="{{ route('courses') }}?type=hybrid"><i class="bi bi-arrow-left-right"></i>الدورات المختلطة</a></li>
                    <li><a href="{{ route('contact') }}"><i class="bi bi-headset"></i>الدعم الفني</a></li>
                    <li><a href="{{ route('contact') }}"><i class="bi bi-chat-dots"></i>الاستشارات</a></li>
                    <li><a href="{{ route('contact') }}"><i class="bi bi-award"></i>الشهادات المعتمدة</a></li>
                    <li><a href="{{ route('certificates.verify') }}"><i class="bi bi-shield-check"></i>التحقق من الشهادات</a></li>
                </ul>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <div class="footer-bottom-content">
                <div class="copyright">
                    <p>&copy; {{ date('Y') }} أكاديمية السهم الأخضر. جميع الحقوق محفوظة.</p>
                </div>
                <div class="footer-links-bottom">
                    <a href="{{ route('privacy-policy') }}">سياسة الخصوصية</a>
                    <a href="{{ route('terms-of-service') }}">شروط الاستخدام</a>
                    <a href="{{ route('sitemap') }}">خريطة الموقع</a>
                </div>
            </div>
        </div>
    </div>
</footer> 