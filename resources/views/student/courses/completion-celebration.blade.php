@extends('layouts.student')

@section('title', 'تهانينا! لقد أكملت الدورة بنجاح')

@section('content')
<div class="completion-celebration-page">
    <!-- Hero Section with Animated Background -->
    <div class="hero-section">
        <div class="hero-particles">
            @for($i = 0; $i < 100; $i++)
                <div class="particle" style="left: {{ rand(0, 100) }}%; animation-delay: {{ rand(0, 5) }}s; animation-duration: {{ rand(3, 8) }}s;"></div>
            @endfor
        </div>
        
        <div class="hero-content">
            <div class="celebration-logo">
                <div class="logo-circle">
                    <i class="bi bi-trophy-fill"></i>
                </div>
            </div>
            
            <h1 class="hero-title">تهانينا! 🎉</h1>
            <p class="hero-subtitle">لقد أكملت الدورة بنجاح!</p>
            <p class="hero-description">أنت الآن جزء من مجتمع المتعلمين المتميزين في أكاديمية السهم الأخضر</p>
        </div>
    </div>

    <!-- Main Content Section -->
    <div class="main-content">
        <div class="container">
            <!-- Course Achievement Card -->
            <div class="achievement-card">
                <div class="achievement-header">
                    <div class="course-badge">
                        <i class="bi bi-award-fill"></i>
                    </div>
                    <div class="course-info">
                        <h2 class="course-title">{{ $course->title_ar }}</h2>
                        <p class="course-instructor">
                            <i class="bi bi-person-circle"></i>
                            المدرب: {{ $course->instructor->name }}
                        </p>
                        <div class="completion-badge">
                            <i class="bi bi-check-circle-fill"></i>
                            مكتمل بنسبة 100%
                        </div>
                    </div>
                </div>

                <!-- Achievement Stats -->
                <div class="achievement-stats">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="bi bi-book-fill"></i>
                        </div>
                        <div class="stat-content">
                            <div class="stat-number">{{ $courseStats['completed_lessons'] }}</div>
                            <div class="stat-label">درس مكتمل</div>
                        </div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="bi bi-clock-fill"></i>
                        </div>
                        <div class="stat-content">
                            <div class="stat-number">{{ $courseStats['total_hours'] }}</div>
                            <div class="stat-label">ساعة تعلم</div>
                        </div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="bi bi-percent"></i>
                        </div>
                        <div class="stat-content">
                            <div class="stat-number">100%</div>
                            <div class="stat-label">نسبة الإكمال</div>
                        </div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="bi bi-calendar-check-fill"></i>
                        </div>
                        <div class="stat-content">
                            <div class="stat-number">{{ $courseStats['completion_date']->format('d/m/Y') }}</div>
                            <div class="stat-label">تاريخ الإكمال</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Certificate Section -->
            @if($courseStats['certificate_issued'])
            <div class="certificate-section">
                <div class="certificate-card">
                    <div class="certificate-header">
                        <div class="certificate-icon">
                            <i class="bi bi-award-fill"></i>
                        </div>
                        <div class="certificate-info">
                            <h3>شهادة الإكمال</h3>
                            <p>تم إصدار شهادتك بنجاح! يمكنك تحميلها أو مشاركتها مع الآخرين.</p>
                            <div class="certificate-number">
                                <span>رقم الشهادة:</span>
                                <strong>{{ $courseStats['certificate_number'] }}</strong>
                            </div>
                        </div>
                    </div>
                    
                    <div class="certificate-actions">
                        <a href="{{ route('student.certificates.download', $certificate) }}" class="btn-certificate btn-download">
                            <i class="bi bi-download"></i>
                            <span>تحميل الشهادة</span>
                        </a>
                        <a href="{{ route('student.certificates') }}" class="btn-certificate btn-view">
                            <i class="bi bi-eye"></i>
                            <span>عرض جميع الشهادات</span>
                        </a>
                    </div>
                </div>
            </div>
            @endif

            <!-- Academic Recognition -->
            <div class="academic-section">
                <h3 class="section-title">
                    <i class="bi bi-building"></i>
                    الاعتراف الأكاديمي
                </h3>
                
                <div class="academic-grid">
                    <div class="academic-item">
                        <div class="academic-icon">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <div class="academic-content">
                            <h4>معتمدة من الأكاديمية</h4>
                            <p>شهادة معتمدة رسمياً من أكاديمية السهم الأخضر</p>
                        </div>
                    </div>
                    
                    <div class="academic-item">
                        <div class="academic-icon">
                            <i class="bi bi-globe"></i>
                        </div>
                        <div class="academic-content">
                            <h4>صالحة دولياً</h4>
                            <p>معترف بها في جميع أنحاء العالم</p>
                        </div>
                    </div>
                    
                    <div class="academic-item">
                        <div class="academic-icon">
                            <i class="bi bi-clock-history"></i>
                        </div>
                        <div class="academic-content">
                            <h4>دائمة الصلاحية</h4>
                            <p>شهادة صالحة مدى الحياة</p>
                        </div>
                    </div>
                    
                    <div class="academic-item">
                        <div class="academic-icon">
                            <i class="bi bi-people"></i>
                        </div>
                        <div class="academic-content">
                            <h4>معترف بها من الشركات</h4>
                            <p>مقبولة في سوق العمل</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Next Steps -->
            <div class="next-steps-section">
                <h3 class="section-title">
                    <i class="bi bi-arrow-right-circle"></i>
                    الخطوات التالية
                </h3>
                
                <div class="steps-grid">
                    <div class="step-item">
                        <div class="step-number">1</div>
                        <div class="step-content">
                            <h4>شارك إنجازك</h4>
                            <p>شارك شهادتك على وسائل التواصل الاجتماعي</p>
                        </div>
                    </div>
                    
                    <div class="step-item">
                        <div class="step-number">2</div>
                        <div class="step-content">
                            <h4>استكشف دورات جديدة</h4>
                            <p>تابع رحلة التعلم مع دورات أخرى</p>
                        </div>
                    </div>
                    
                    <div class="step-item">
                        <div class="step-number">3</div>
                        <div class="step-content">
                            <h4>انضم لمجتمعنا</h4>
                            <p>تواصل مع المتعلمين الآخرين</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="action-section">
                <div class="action-buttons">
                    <a href="{{ route('student.dashboard') }}" class="btn-action btn-primary">
                        <i class="bi bi-house"></i>
                        <span>العودة للوحة التحكم</span>
                    </a>
                    
                    <a href="{{ route('student.courses') }}" class="btn-action btn-secondary">
                        <i class="bi bi-book"></i>
                        <span>استكشف دورات جديدة</span>
                    </a>
                    
                    <button onclick="shareAchievement()" class="btn-action btn-share">
                        <i class="bi bi-share"></i>
                        <span>مشاركة الإنجاز</span>
                    </button>
                </div>
            </div>

            <!-- Social Sharing -->
            <div class="social-sharing">
                <h4>شارك إنجازك مع العالم!</h4>
                <div class="social-buttons">
                    <a href="#" onclick="shareOnSocial('facebook')" class="social-btn facebook">
                        <i class="bi bi-facebook"></i>
                        <span>Facebook</span>
                    </a>
                    <a href="#" onclick="shareOnSocial('twitter')" class="social-btn twitter">
                        <i class="bi bi-twitter"></i>
                        <span>Twitter</span>
                    </a>
                    <a href="#" onclick="shareOnSocial('linkedin')" class="social-btn linkedin">
                        <i class="bi bi-linkedin"></i>
                        <span>LinkedIn</span>
                    </a>
                    <a href="#" onclick="shareOnSocial('whatsapp')" class="social-btn whatsapp">
                        <i class="bi bi-whatsapp"></i>
                        <span>WhatsApp</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.completion-celebration-page {
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    min-height: 100vh;
    overflow-x: hidden;
}

/* Hero Section */
.hero-section {
    background: linear-gradient(135deg, #10b981 0%, #059669 50%, #047857 100%);
    padding: 80px 0 60px;
    color: white;
    position: relative;
    overflow: hidden;
    text-align: center;
}

.hero-particles {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
}

.particle {
    position: absolute;
    width: 6px;
    height: 6px;
    background: rgba(255, 255, 255, 0.6);
    border-radius: 50%;
    animation: float 6s ease-in-out infinite;
}

@keyframes float {
    0%, 100% {
        transform: translateY(0px) rotate(0deg);
        opacity: 0;
    }
    50% {
        transform: translateY(-100px) rotate(180deg);
        opacity: 1;
    }
}

.hero-content {
    position: relative;
    z-index: 2;
    max-width: 800px;
    margin: 0 auto;
    padding: 0 20px;
}

.celebration-logo {
    margin-bottom: 30px;
}

.logo-circle {
    width: 120px;
    height: 120px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
    font-size: 3rem;
    backdrop-filter: blur(10px);
    border: 3px solid rgba(255, 255, 255, 0.3);
    animation: pulse 2s ease-in-out infinite;
}

@keyframes pulse {
    0%, 100% {
        transform: scale(1);
        box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.4);
    }
    50% {
        transform: scale(1.05);
        box-shadow: 0 0 0 20px rgba(255, 255, 255, 0);
    }
}

.hero-title {
    font-size: 3.5rem;
    font-weight: 700;
    margin-bottom: 15px;
    text-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.hero-subtitle {
    font-size: 1.8rem;
    margin-bottom: 20px;
    opacity: 0.9;
    font-weight: 300;
}

.hero-description {
    font-size: 1.2rem;
    opacity: 0.8;
    line-height: 1.6;
    max-width: 600px;
    margin: 0 auto;
}

/* Main Content */
.main-content {
    padding: 60px 0;
    margin-top: -30px;
    position: relative;
    z-index: 3;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

/* Achievement Card */
.achievement-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.1);
    padding: 40px;
    margin-bottom: 40px;
    position: relative;
    overflow: hidden;
}

.achievement-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #10b981, #059669, #047857);
}

.achievement-header {
    display: flex;
    align-items: center;
    gap: 30px;
    margin-bottom: 40px;
}

.course-badge {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #10b981, #059669);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    color: white;
    box-shadow: 0 10px 20px rgba(16, 185, 129, 0.3);
}

.course-info {
    flex: 1;
}

.course-title {
    font-size: 2rem;
    color: #1f2937;
    margin-bottom: 10px;
    font-weight: 600;
}

.course-instructor {
    color: #6b7280;
    font-size: 1.1rem;
    margin-bottom: 15px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.completion-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 0.9rem;
    font-weight: 600;
}

/* Achievement Stats */
.achievement-stats {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
}

.stat-card {
    background: #f8fafc;
    border-radius: 16px;
    padding: 25px;
    display: flex;
    align-items: center;
    gap: 20px;
    transition: all 0.3s ease;
    border: 1px solid #e2e8f0;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.1);
    background: white;
}

.stat-icon {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #10b981, #059669);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: white;
}

.stat-content {
    flex: 1;
}

.stat-number {
    font-size: 2rem;
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 5px;
}

.stat-label {
    color: #6b7280;
    font-size: 0.9rem;
    font-weight: 500;
}

/* Certificate Section */
.certificate-section {
    margin-bottom: 40px;
}

.certificate-card {
    background: linear-gradient(135deg, #fef3c7, #fde68a);
    border-radius: 20px;
    padding: 30px;
    border: 2px solid #f59e0b;
    position: relative;
    overflow: hidden;
}

.certificate-card::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -50%;
    width: 200%;
    height: 200%;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="stars" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="10" cy="10" r="1" fill="%23f59e0b" opacity="0.3"/></pattern></defs><rect width="100" height="100" fill="url(%23stars)"/></svg>');
    opacity: 0.5;
    animation: rotate 20s linear infinite;
}

@keyframes rotate {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

.certificate-header {
    display: flex;
    align-items: center;
    gap: 25px;
    margin-bottom: 25px;
    position: relative;
    z-index: 2;
}

.certificate-icon {
    width: 70px;
    height: 70px;
    background: linear-gradient(135deg, #f59e0b, #d97706);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    color: white;
    box-shadow: 0 10px 20px rgba(245, 158, 11, 0.3);
}

.certificate-info h3 {
    font-size: 1.5rem;
    color: #92400e;
    margin-bottom: 8px;
    font-weight: 600;
}

.certificate-info p {
    color: #92400e;
    margin-bottom: 15px;
    line-height: 1.5;
}

.certificate-number {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 0.9rem;
}

.certificate-number span {
    color: #92400e;
}

.certificate-number strong {
    color: #78350f;
    font-weight: 600;
}

.certificate-actions {
    display: flex;
    gap: 15px;
    position: relative;
    z-index: 2;
}

.btn-certificate {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 12px 24px;
    border-radius: 12px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
}

.btn-download {
    background: linear-gradient(135deg, #f59e0b, #d97706);
    color: white;
}

.btn-download:hover {
    background: linear-gradient(135deg, #d97706, #b45309);
    transform: translateY(-2px);
    box-shadow: 0 10px 20px rgba(245, 158, 11, 0.3);
}

.btn-view {
    background: white;
    color: #92400e;
    border: 2px solid #f59e0b;
}

.btn-view:hover {
    background: #fef3c7;
    transform: translateY(-2px);
}

/* Academic Section */
.academic-section {
    background: white;
    border-radius: 20px;
    padding: 40px;
    margin-bottom: 40px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.section-title {
    font-size: 1.8rem;
    color: #1f2937;
    margin-bottom: 30px;
    display: flex;
    align-items: center;
    gap: 15px;
    font-weight: 600;
}

.section-title i {
    color: #10b981;
    font-size: 1.5rem;
}

.academic-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 25px;
}

.academic-item {
    display: flex;
    align-items: flex-start;
    gap: 20px;
    padding: 20px;
    background: #f8fafc;
    border-radius: 16px;
    transition: all 0.3s ease;
    border: 1px solid #e2e8f0;
}

.academic-item:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    background: white;
}

.academic-icon {
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, #10b981, #059669);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    color: white;
    flex-shrink: 0;
}

.academic-content h4 {
    color: #1f2937;
    font-size: 1.1rem;
    margin-bottom: 8px;
    font-weight: 600;
}

.academic-content p {
    color: #6b7280;
    font-size: 0.9rem;
    line-height: 1.5;
    margin: 0;
}

/* Next Steps Section */
.next-steps-section {
    background: white;
    border-radius: 20px;
    padding: 40px;
    margin-bottom: 40px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.steps-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 25px;
}

.step-item {
    display: flex;
    align-items: flex-start;
    gap: 20px;
    padding: 25px;
    background: linear-gradient(135deg, #f0fdf4, #dcfce7);
    border-radius: 16px;
    border-left: 4px solid #10b981;
    transition: all 0.3s ease;
}

.step-item:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(16, 185, 129, 0.2);
}

.step-number {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, #10b981, #059669);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 700;
    font-size: 1.1rem;
    flex-shrink: 0;
}

.step-content h4 {
    color: #065f46;
    font-size: 1.1rem;
    margin-bottom: 8px;
    font-weight: 600;
}

.step-content p {
    color: #047857;
    font-size: 0.9rem;
    line-height: 1.5;
    margin: 0;
}

/* Action Section */
.action-section {
    margin-bottom: 40px;
}

.action-buttons {
    display: flex;
    gap: 20px;
    justify-content: center;
    flex-wrap: wrap;
}

.btn-action {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 16px 32px;
    border-radius: 12px;
    text-decoration: none;
    font-weight: 600;
    font-size: 1rem;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
    min-width: 200px;
    justify-content: center;
}

.btn-primary {
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #059669, #047857);
    transform: translateY(-3px);
    box-shadow: 0 15px 30px rgba(16, 185, 129, 0.3);
}

.btn-secondary {
    background: white;
    color: #10b981;
    border: 2px solid #10b981;
}

.btn-secondary:hover {
    background: #10b981;
    color: white;
    transform: translateY(-3px);
    box-shadow: 0 15px 30px rgba(16, 185, 129, 0.2);
}

.btn-share {
    background: linear-gradient(135deg, #8b5cf6, #7c3aed);
    color: white;
}

.btn-share:hover {
    background: linear-gradient(135deg, #7c3aed, #6d28d9);
    transform: translateY(-3px);
    box-shadow: 0 15px 30px rgba(139, 92, 246, 0.3);
}

/* Social Sharing */
.social-sharing {
    background: white;
    border-radius: 20px;
    padding: 40px;
    text-align: center;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.social-sharing h4 {
    font-size: 1.5rem;
    color: #1f2937;
    margin-bottom: 25px;
    font-weight: 600;
}

.social-buttons {
    display: flex;
    gap: 15px;
    justify-content: center;
    flex-wrap: wrap;
}

.social-btn {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 12px 24px;
    border-radius: 12px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
    min-width: 140px;
    justify-content: center;
}

.social-btn.facebook {
    background: #1877f2;
    color: white;
}

.social-btn.facebook:hover {
    background: #166fe5;
    transform: translateY(-2px);
    box-shadow: 0 10px 20px rgba(24, 119, 242, 0.3);
}

.social-btn.twitter {
    background: #1da1f2;
    color: white;
}

.social-btn.twitter:hover {
    background: #1a91da;
    transform: translateY(-2px);
    box-shadow: 0 10px 20px rgba(29, 161, 242, 0.3);
}

.social-btn.linkedin {
    background: #0077b5;
    color: white;
}

.social-btn.linkedin:hover {
    background: #006097;
    transform: translateY(-2px);
    box-shadow: 0 10px 20px rgba(0, 119, 181, 0.3);
}

.social-btn.whatsapp {
    background: #25d366;
    color: white;
}

.social-btn.whatsapp:hover {
    background: #20ba5a;
    transform: translateY(-2px);
    box-shadow: 0 10px 20px rgba(37, 211, 102, 0.3);
}

/* Responsive Design */
@media (max-width: 768px) {
    .hero-title {
        font-size: 2.5rem;
    }
    
    .hero-subtitle {
        font-size: 1.4rem;
    }
    
    .achievement-header {
        flex-direction: column;
        text-align: center;
        gap: 20px;
    }
    
    .achievement-stats {
        grid-template-columns: 1fr;
    }
    
    .academic-grid {
        grid-template-columns: 1fr;
    }
    
    .steps-grid {
        grid-template-columns: 1fr;
    }
    
    .action-buttons {
        flex-direction: column;
        align-items: center;
    }
    
    .btn-action {
        width: 100%;
        max-width: 300px;
    }
    
    .social-buttons {
        flex-direction: column;
        align-items: center;
    }
    
    .social-btn {
        width: 100%;
        max-width: 250px;
    }
    
    .certificate-actions {
        flex-direction: column;
    }
    
    .btn-certificate {
        justify-content: center;
    }
}

/* Animations */
@keyframes slideInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.achievement-card,
.certificate-section,
.academic-section,
.next-steps-section,
.action-section,
.social-sharing {
    animation: slideInUp 0.6s ease-out forwards;
}

.achievement-card { animation-delay: 0.1s; }
.certificate-section { animation-delay: 0.2s; }
.academic-section { animation-delay: 0.3s; }
.next-steps-section { animation-delay: 0.4s; }
.action-section { animation-delay: 0.5s; }
.social-sharing { animation-delay: 0.6s; }
</style>

<script>
// Social sharing functions
function shareOnSocial(platform) {
    const url = encodeURIComponent(window.location.href);
    const text = encodeURIComponent('لقد أكملت دورة {{ $course->title_ar }} بنجاح في أكاديمية السهم الأخضر! 🎉');
    
    let shareUrl = '';
    
    switch(platform) {
        case 'facebook':
            shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${url}`;
            break;
        case 'twitter':
            shareUrl = `https://twitter.com/intent/tweet?text=${text}&url=${url}`;
            break;
        case 'linkedin':
            shareUrl = `https://www.linkedin.com/sharing/share-offsite/?url=${url}`;
            break;
        case 'whatsapp':
            shareUrl = `https://wa.me/?text=${text}%20${url}`;
            break;
    }
    
    if (shareUrl) {
        window.open(shareUrl, '_blank', 'width=600,height=400');
    }
}

function shareAchievement() {
    if (navigator.share) {
        navigator.share({
            title: 'إنجاز جديد!',
            text: 'لقد أكملت دورة {{ $course->title_ar }} بنجاح في أكاديمية السهم الأخضر! 🎉',
            url: window.location.href
        }).catch(console.error);
    } else {
        // Fallback: copy to clipboard
        const text = 'لقد أكملت دورة {{ $course->title_ar }} بنجاح في أكاديمية السهم الأخضر! 🎉\n' + window.location.href;
        navigator.clipboard.writeText(text).then(() => {
            alert('تم نسخ الرابط إلى الحافظة!');
        }).catch(() => {
            alert('رابط المشاركة: ' + window.location.href);
        });
    }
}

// Animate numbers on scroll
document.addEventListener('DOMContentLoaded', function() {
    const stats = document.querySelectorAll('.stat-number');
    
    const animateValue = (element, start, end, duration) => {
        let startTimestamp = null;
        const step = (timestamp) => {
            if (!startTimestamp) startTimestamp = timestamp;
            const progress = Math.min((timestamp - startTimestamp) / duration, 1);
            const current = Math.floor(progress * (end - start) + start);
            element.textContent = current;
            if (progress < 1) {
                window.requestAnimationFrame(step);
            }
        };
        window.requestAnimationFrame(step);
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const target = entry.target;
                const endValue = parseInt(target.textContent);
                animateValue(target, 0, endValue, 2000);
                observer.unobserve(target);
            }
        });
    });
    
    stats.forEach(stat => observer.observe(stat));
});
</script>
@endsection 