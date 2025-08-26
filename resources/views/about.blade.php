@extends('layouts.app')

@section('title', 'من نحن - أكاديمية السهم الأخضر للتدريب')

@section('content')
<!-- Enhanced Hero Section -->
<section class="hero-section">
    <div class="hero-background">
        <div class="hero-particles"></div>
        <div class="hero-gradient"></div>
    </div>
    <div class="container">
        <div class="hero-content">
            <div class="hero-badge">
                <i class="bi bi-star-fill"></i>
                <span>مؤسسة تعليمية رائدة منذ 2020</span>
            </div>
            <h1 class="hero-title">من نحن</h1>
            <p class="hero-subtitle">
                أكاديمية السهم الأخضر للتدريب - مؤسسة تعليمية رائدة في مجال التدريب والتطوير المهني
            </p>
            <div class="hero-stats">
                <div class="stat-item">
                    <div class="stat-number" data-target="500">0</div>
                    <div class="stat-label">دورة تدريبية</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number" data-target="10000">0</div>
                    <div class="stat-label">طالب</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number" data-target="50">0</div>
                    <div class="stat-label">مدرب محترف</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About Content -->
<section class="about-content">
    <div class="container">
        <div class="about-grid">
            <div class="about-text">
                <div class="section-badge">
                    <i class="bi bi-book"></i>
                    <span>قصتنا</span>
                </div>
                <h2 class="section-title">قصة نجاح مستمرة</h2>
                <div class="about-description">
                    <p>
                        تأسست أكاديمية السهم الأخضر للتدريب في عام 2020 بهدف تقديم تعليم عالي الجودة وتدريب متخصص في مختلف المجالات التقنية والإدارية واللغوية.
                    </p>
                    <p>
                        نحن نؤمن بأهمية التعليم المستمر والتطوير المهني، ونسعى لتقديم دورات تدريبية عالية الجودة تساعد الأفراد والمؤسسات على تحقيق أهدافهم.
                    </p>
                </div>
                <div class="achievement-cards">
                    <div class="achievement-card">
                        <div class="achievement-icon">
                            <i class="bi bi-trophy"></i>
                        </div>
                        <div class="achievement-content">
                            <div class="achievement-number">500+</div>
                            <div class="achievement-label">دورة تدريبية</div>
                        </div>
                    </div>
                    <div class="achievement-card">
                        <div class="achievement-icon">
                            <i class="bi bi-people"></i>
                        </div>
                        <div class="achievement-content">
                            <div class="achievement-number">10K+</div>
                            <div class="achievement-label">طالب</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="about-image">
                <div class="image-container">
                    <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2071&q=80" 
                         alt="فريق العمل">
                    <div class="image-overlay"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Mission & Vision -->
<section class="mission-vision">
    <div class="container">
        <div class="section-header">
            <div class="section-badge">
                <i class="bi bi-target"></i>
                <span>رؤيتنا ومهمتنا</span>
            </div>
            <h2 class="section-title">نحو مستقبل تعليمي أفضل</h2>
        </div>
        <div class="mission-vision-grid">
            <div class="mission-card">
                <div class="card-icon">
                    <i class="bi bi-bullseye"></i>
                </div>
                <h3>رؤيتنا</h3>
                <p>
                    أن نكون المؤسسة التعليمية الرائدة في مجال التدريب والتطوير المهني، ونكون الخيار الأول للأفراد والمؤسسات في المملكة العربية السعودية.
                </p>
            </div>
            
            <div class="mission-card">
                <div class="card-icon">
                    <i class="bi bi-flag"></i>
                </div>
                <h3>مهمتنا</h3>
                <p>
                    تقديم تعليم عالي الجودة وتدريب متخصص يساعد الأفراد على تطوير مهاراتهم وتحقيق أهدافهم المهنية والشخصية.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Values -->
<section class="values">
    <div class="container">
        <div class="section-header">
            <div class="section-badge">
                <i class="bi bi-heart"></i>
                <span>قيمنا</span>
            </div>
            <h2 class="section-title">القيم التي تقودنا</h2>
        </div>
        <div class="values-grid">
            <div class="value-card">
                <div class="value-icon">
                    <i class="bi bi-award"></i>
                </div>
                <h4>الجودة</h4>
                <p>نلتزم بتقديم أعلى معايير الجودة في جميع خدماتنا التعليمية</p>
            </div>
            
            <div class="value-card">
                <div class="value-icon">
                    <i class="bi bi-lightbulb"></i>
                </div>
                <h4>الابتكار</h4>
                <p>نتبنى أحدث التقنيات والطرق التعليمية لتقديم تجربة تعليمية مميزة</p>
            </div>
            
            <div class="value-card">
                <div class="value-icon">
                    <i class="bi bi-people"></i>
                </div>
                <h4>التعاون</h4>
                <p>نعمل مع شركائنا وطلابنا لتحقيق النجاح المشترك</p>
            </div>
            
            <div class="value-card">
                <div class="value-icon">
                    <i class="bi bi-heart"></i>
                </div>
                <h4>الاهتمام</h4>
                <p>نضع احتياجات طلابنا في المقام الأول ونقدم لهم الدعم الكامل</p>
            </div>
        </div>
    </div>
</section>

<!-- Instructors -->
<section class="instructors">
    <div class="container">
        <div class="section-header">
            <div class="section-badge">
                <i class="bi bi-person-workspace"></i>
                <span>فريق المدربين</span>
            </div>
            <h2 class="section-title">خبراء في مجالاتهم</h2>
            <p class="section-description">تعلم من أفضل المدربين المحترفين ذوي الخبرة الواسعة</p>
        </div>
        <div class="instructors-grid">
            @foreach($instructors as $instructor)
            <div class="instructor-card">
                <div class="instructor-header">
                    <div class="instructor-avatar">
                        <img src="{{ $instructor->avatar_url }}" alt="{{ $instructor->name }}">
                        <div class="avatar-overlay">
                            <div class="overlay-content">
                                <i class="bi bi-linkedin"></i>
                                <span>عرض الملف الشخصي</span>
                            </div>
                        </div>
                        <div class="status-badge">
                            <i class="bi bi-circle-fill"></i>
                            <span>متاح</span>
                        </div>
                    </div>
                    <div class="instructor-badges">
                        <span class="badge expert">
                            <i class="bi bi-star"></i>
                            خبير
                        </span>
                        <span class="badge verified">
                            <i class="bi bi-check-circle"></i>
                            موثق
                        </span>
                    </div>
                </div>
                <div class="instructor-info">
                    <h4 class="instructor-name">{{ $instructor->name }}</h4>
                    <p class="instructor-bio">{{ $instructor->bio ?: 'مدرب محترف ذو خبرة واسعة في مجال التدريب والتطوير' }}</p>
                    
                    <div class="instructor-stats">
                        <div class="stat-item">
                            <i class="bi bi-play-circle"></i>
                            <div class="stat-content">
                                <span class="stat-number">{{ $instructor->teachingCourses->count() }}</span>
                                <span class="stat-label">دورة</span>
                            </div>
                        </div>
                        <div class="stat-item">
                            <i class="bi bi-people"></i>
                            <div class="stat-content">
                                <span class="stat-number">{{ rand(50, 500) }}</span>
                                <span class="stat-label">طالب</span>
                            </div>
                        </div>
                        <div class="stat-item">
                            <i class="bi bi-star-fill"></i>
                            <div class="stat-content">
                                <span class="stat-number">{{ number_format(rand(45, 50) / 10, 1) }}</span>
                                <span class="stat-label">تقييم</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="instructor-specialties">
                        <span class="specialty">برمجة</span>
                        <span class="specialty">إدارة</span>
                        <span class="specialty">لغات</span>
                    </div>
                    
                    <div class="instructor-actions">
                        <a href="{{ route('instructors.show', $instructor->id) }}" class="btn-view-profile">
                            <i class="bi bi-person"></i>
                            عرض الملف الشخصي
                        </a>
                        <button class="btn-contact" onclick="contactInstructor({{ $instructor->id }})">
                            <i class="bi bi-chat"></i>
                            تواصل معه
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="instructors-cta">
            <div class="cta-content">
                <h3>انضم إلى فريق المدربين</h3>
                <p>هل أنت مدرب محترف؟ انضم إلينا وساعد في تطوير مهارات الطلاب</p>
                <a href="{{ route('register.page') }}" class="btn-join-team">
                    <i class="bi bi-person-plus"></i>
                    انضم إلى الفريق
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Us -->
<section class="why-choose-us">
    <div class="container">
        <div class="section-header">
            <div class="section-badge">
                <i class="bi bi-check-circle"></i>
                <span>لماذا تختارنا؟</span>
            </div>
            <h2 class="section-title">مزايا تجعلنا الأفضل</h2>
        </div>
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="bi bi-laptop"></i>
                </div>
                <div class="feature-content">
                    <h4>دورات عالية الجودة</h4>
                    <p>نقدم دورات تدريبية عالية الجودة مصممة بأحدث الطرق التعليمية</p>
                </div>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="bi bi-person-check"></i>
                </div>
                <div class="feature-content">
                    <h4>مدربون محترفون</h4>
                    <p>فريق من المدربين المحترفين ذوي الخبرة الواسعة في مجالاتهم</p>
                </div>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="bi bi-award"></i>
                </div>
                <div class="feature-content">
                    <h4>شهادات معتمدة</h4>
                    <p>شهادات معتمدة ومعترف بها في المملكة العربية السعودية</p>
                </div>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="bi bi-headset"></i>
                </div>
                <div class="feature-content">
                    <h4>دعم فني 24/7</h4>
                    <p>دعم فني متواصل لمساعدتك في أي وقت تحتاج فيه للمساعدة</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="container">
        <div class="cta-content">
            <div class="cta-badge">
                <i class="bi bi-rocket"></i>
                <span>ابدأ رحلتك التعليمية</span>
            </div>
            <h2>ابدأ رحلتك التعليمية اليوم</h2>
            <p>انضم إلى آلاف الطلاب الذين اختاروا أكاديمية السهم الأخضر</p>
            <div class="cta-buttons">
                <a href="{{ route('courses') }}" class="btn btn-primary">
                    <i class="bi bi-play-circle"></i>
                    استعرض الدورات
                </a>
                <a href="{{ route('contact') }}" class="btn btn-outline">
                    <i class="bi bi-chat-dots"></i>
                    تواصل معنا
                </a>
            </div>
        </div>
    </div>
</section>

<style>
/* Hero Section */
.hero-section {
    position: relative;
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: white;
    padding: 120px 0 80px;
    margin: -40px -20px 80px -20px;
    overflow: hidden;
}

.hero-background {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
}

.hero-particles {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-image: 
        radial-gradient(circle at 20% 50%, rgba(255,255,255,0.1) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(255,255,255,0.08) 0%, transparent 50%),
        radial-gradient(circle at 40% 80%, rgba(255,255,255,0.06) 0%, transparent 50%);
    animation: floatingLights 8s ease-in-out infinite;
}

.hero-gradient {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(45deg, rgba(16, 185, 129, 0.9) 0%, rgba(5, 150, 105, 0.9) 100%);
}

.hero-content {
    position: relative;
    z-index: 2;
    text-align: center;
    max-width: 800px;
    margin: 0 auto;
}

.hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
    padding: 12px 24px;
    border-radius: 50px;
    font-size: 0.9rem;
    font-weight: 500;
    margin-bottom: 30px;
    border: 1px solid rgba(255, 255, 255, 0.3);
}

.hero-title {
    font-size: 4rem;
    font-weight: 900;
    margin-bottom: 20px;
    background: linear-gradient(45deg, #ffffff, #f0f9ff);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.hero-subtitle {
    font-size: 1.3rem;
    margin-bottom: 50px;
    opacity: 0.95;
    line-height: 1.6;
}

.hero-stats {
    display: flex;
    justify-content: center;
    gap: 60px;
    flex-wrap: wrap;
}

.stat-item {
    text-align: center;
}

.stat-number {
    font-size: 3rem;
    font-weight: 900;
    color: #ffffff;
    margin-bottom: 8px;
}

.stat-label {
    font-size: 1rem;
    opacity: 0.9;
    font-weight: 500;
}

/* Section Styles */
.section-header {
    text-align: center;
    margin-bottom: 60px;
}

.section-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
    padding: 12px 24px;
    border-radius: 50px;
    font-size: 0.9rem;
    font-weight: 500;
    margin-bottom: 20px;
}

.section-title {
    font-size: 3rem;
    font-weight: 800;
    color: #1f2937;
    margin-bottom: 20px;
}

/* About Content */
.about-content {
    padding: 80px 0;
}

.about-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 80px;
    align-items: center;
}

.about-text {
    padding-right: 40px;
}

.about-description p {
    font-size: 1.1rem;
    line-height: 1.8;
    color: #6b7280;
    margin-bottom: 20px;
}

.achievement-cards {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 30px;
    margin-top: 40px;
}

.achievement-card {
    display: flex;
    align-items: center;
    gap: 20px;
    padding: 30px;
    background: linear-gradient(135deg, #f8fafc, #f1f5f9);
    border-radius: 20px;
    border: 1px solid #e2e8f0;
    transition: all 0.3s ease;
}

.achievement-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.1);
}

.achievement-icon {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #10b981, #059669);
    border-radius: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
}

.achievement-number {
    font-size: 2rem;
    font-weight: 800;
    color: #1f2937;
    margin-bottom: 5px;
}

.achievement-label {
    color: #6b7280;
    font-weight: 500;
}

.about-image {
    position: relative;
}

.image-container {
    position: relative;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 30px 60px rgba(0,0,0,0.15);
}

.image-container img {
    width: 100%;
    height: auto;
    transition: transform 0.3s ease;
}

.image-container:hover img {
    transform: scale(1.05);
}

.image-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(45deg, rgba(16, 185, 129, 0.2), rgba(5, 150, 105, 0.2));
    opacity: 0;
    transition: opacity 0.3s ease;
}

.image-container:hover .image-overlay {
    opacity: 1;
}

/* Mission & Vision */
.mission-vision {
    padding: 80px 0;
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
}

.mission-vision-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 40px;
}

.mission-card {
    background: white;
    padding: 50px 40px;
    border-radius: 20px;
    text-align: center;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    border: 1px solid #e2e8f0;
}

.mission-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 30px 60px rgba(0,0,0,0.15);
}

.card-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #10b981, #059669);
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 30px;
    color: white;
    font-size: 2rem;
}

.mission-card h3 {
    font-size: 1.8rem;
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 20px;
}

.mission-card p {
    color: #6b7280;
    line-height: 1.8;
    font-size: 1.1rem;
}

/* Values */
.values {
    padding: 80px 0;
}

.values-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 30px;
}

.value-card {
    background: white;
    padding: 40px 30px;
    border-radius: 20px;
    text-align: center;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    border: 1px solid #e2e8f0;
}

.value-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 30px 60px rgba(0,0,0,0.15);
}

.value-icon {
    width: 70px;
    height: 70px;
    background: linear-gradient(135deg, #10b981, #059669);
    border-radius: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 25px;
    color: white;
    font-size: 1.8rem;
}

.value-card h4 {
    font-size: 1.4rem;
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 15px;
}

.value-card p {
    color: #6b7280;
    line-height: 1.6;
}

/* Instructors */
.instructors {
    padding: 80px 0;
    background: #f8fafc;
}

.instructors-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 30px;
    margin-top: 40px;
}

.instructor-card {
    background: white;
    border-radius: 25px;
    padding: 0;
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
    transition: all 0.4s ease;
    overflow: hidden;
    position: relative;
}

.instructor-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(102, 126, 234, 0.1), transparent);
    transition: left 0.6s ease;
}

.instructor-card:hover::before {
    left: 100%;
}

.instructor-card:hover {
    transform: translateY(-15px);
    box-shadow: 0 25px 60px rgba(0, 0, 0, 0.15);
}

.instructor-header {
    position: relative;
    padding: 30px 30px 20px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.instructor-avatar {
    position: relative;
    width: 120px;
    height: 120px;
    margin: 0 auto 20px;
    border-radius: 50%;
    overflow: hidden;
    border: 4px solid rgba(255, 255, 255, 0.3);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
}

.instructor-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.instructor-card:hover .instructor-avatar img {
    transform: scale(1.1);
}

.avatar-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.7);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: all 0.3s ease;
}

.overlay-content {
    text-align: center;
    color: white;
}

.overlay-content i {
    font-size: 2rem;
    margin-bottom: 5px;
    display: block;
}

.overlay-content span {
    font-size: 0.8rem;
    opacity: 0.9;
}

.status-badge {
    position: absolute;
    top: 20px;
    right: 20px;
    background: rgba(16, 185, 129, 0.9);
    color: white;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    display: flex;
    align-items: center;
    gap: 5px;
    backdrop-filter: blur(10px);
}

.status-badge i {
    font-size: 0.6rem;
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.5; }
}

.instructor-badges {
    display: flex;
    justify-content: center;
    gap: 10px;
    margin-bottom: 15px;
}

.badge {
    padding: 4px 12px;
    border-radius: 15px;
    font-size: 0.8rem;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 4px;
}

.badge.expert {
    background: rgba(251, 191, 36, 0.9);
    color: #92400e;
}

.badge.verified {
    background: rgba(16, 185, 129, 0.9);
    color: white;
}

.instructor-info {
    padding: 30px;
}

.instructor-name {
    font-size: 1.4rem;
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 10px;
    text-align: center;
}

.instructor-bio {
    color: #6b7280;
    margin-bottom: 25px;
    line-height: 1.6;
    text-align: center;
    font-size: 0.95rem;
}

.instructor-stats {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 15px;
    margin-bottom: 25px;
}

.instructor-stats .stat-item {
    text-align: center;
    padding: 15px 10px;
    background: #f8fafc;
    border-radius: 12px;
    transition: all 0.3s ease;
}

.instructor-stats .stat-item:hover {
    background: #e2e8f0;
    transform: translateY(-2px);
}

.instructor-stats .stat-item i {
    font-size: 1.2rem;
    color: #667eea;
    margin-bottom: 5px;
    display: block;
}

.stat-content {
    display: flex;
    flex-direction: column;
}

.stat-number {
    font-size: 1.1rem;
    font-weight: 700;
    color: #1f2937;
}

.stat-label {
    font-size: 0.8rem;
    color: #6b7280;
    margin-top: 2px;
}

.instructor-specialties {
    display: flex;
    justify-content: center;
    gap: 8px;
    margin-bottom: 25px;
    flex-wrap: wrap;
}

.specialty {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 500;
}

.instructor-actions {
    display: flex;
    gap: 10px;
    justify-content: center;
}

.btn-view-profile,
.btn-contact {
    padding: 12px 20px;
    border-radius: 12px;
    font-size: 0.9rem;
    font-weight: 600;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
}

.btn-view-profile {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    flex: 1;
}

.btn-view-profile:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
    color: white;
}

.btn-contact {
    background: #f8fafc;
    color: #667eea;
    border: 2px solid #e2e8f0;
}

.btn-contact:hover {
    background: #667eea;
    color: white;
    border-color: #667eea;
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
}

.instructors-cta {
    margin-top: 60px;
    text-align: center;
    padding: 40px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 25px;
    color: white;
}

.instructors-cta h3 {
    font-size: 1.8rem;
    font-weight: 700;
    margin-bottom: 15px;
}

.instructors-cta p {
    font-size: 1.1rem;
    opacity: 0.9;
    margin-bottom: 30px;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}

.btn-join-team {
    background: rgba(255, 255, 255, 0.2);
    color: white;
    padding: 15px 30px;
    border-radius: 15px;
    text-decoration: none;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    border: 2px solid rgba(255, 255, 255, 0.3);
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
}

.btn-join-team:hover {
    background: rgba(255, 255, 255, 0.3);
    border-color: rgba(255, 255, 255, 0.5);
    transform: translateY(-3px);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
    color: white;
}

/* Why Choose Us */
.why-choose-us {
    padding: 80px 0;
}

.features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 30px;
}

.feature-card {
    display: flex;
    align-items: flex-start;
    gap: 25px;
    padding: 40px 30px;
    background: white;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    border: 1px solid #e2e8f0;
}

.feature-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 30px 60px rgba(0,0,0,0.15);
}

.feature-icon {
    width: 70px;
    height: 70px;
    background: linear-gradient(135deg, #10b981, #059669);
    border-radius: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.8rem;
    flex-shrink: 0;
}

.feature-content h4 {
    font-size: 1.3rem;
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 12px;
}

.feature-content p {
    color: #6b7280;
    line-height: 1.6;
}

/* CTA Section */
.cta-section {
    background: linear-gradient(135deg, #1f2937 0%, #374151 100%);
    color: white;
    padding: 80px 0;
    border-radius: 20px;
    margin: 80px 0;
}

.cta-content {
    text-align: center;
    max-width: 600px;
    margin: 0 auto;
}

.cta-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
    padding: 12px 24px;
    border-radius: 50px;
    font-size: 0.9rem;
    font-weight: 500;
    margin-bottom: 30px;
    border: 1px solid rgba(255, 255, 255, 0.3);
}

.cta-content h2 {
    font-size: 3rem;
    font-weight: 800;
    margin-bottom: 20px;
}

.cta-content p {
    font-size: 1.2rem;
    margin-bottom: 40px;
    opacity: 0.9;
    line-height: 1.6;
}

.cta-buttons {
    display: flex;
    gap: 20px;
    justify-content: center;
    flex-wrap: wrap;
}

.btn {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 15px 30px;
    border-radius: 50px;
    font-size: 1.1rem;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
}

.btn-primary {
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
}

.btn-primary:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 30px rgba(16, 185, 129, 0.3);
}

.btn-outline {
    background: transparent;
    color: white;
    border: 2px solid white;
}

.btn-outline:hover {
    background: white;
    color: #1f2937;
    transform: translateY(-3px);
}

/* Animations */
@keyframes floatingLights {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-20px) rotate(180deg); }
}

/* Responsive Design */
@media (max-width: 768px) {
    .hero-title {
        font-size: 2.5rem;
    }
    
    .hero-stats {
        gap: 30px;
    }
    
    .stat-number {
        font-size: 2rem;
    }
    
    .about-grid {
        grid-template-columns: 1fr;
        gap: 50px;
    }
    
    .about-text {
        padding-right: 0;
    }
    
    .achievement-cards {
        grid-template-columns: 1fr;
    }
    
    .mission-vision-grid {
        grid-template-columns: 1fr;
    }
    
    .values-grid {
        grid-template-columns: 1fr;
    }
    
    .instructors-grid {
        grid-template-columns: 1fr;
    }
    
    .features-grid {
        grid-template-columns: 1fr;
    }
    
    .cta-content h2 {
        font-size: 2rem;
    }
    
    .cta-buttons {
        flex-direction: column;
        align-items: center;
    }
    
    .btn {
        width: 100%;
        max-width: 300px;
        justify-content: center;
    }
}

@media (max-width: 480px) {
    .hero-section {
        padding: 80px 0 60px;
    }
    
    .hero-title {
        font-size: 2rem;
    }
    
    .hero-subtitle {
        font-size: 1.1rem;
    }
    
    .section-title {
        font-size: 2rem;
    }
    
    .achievement-card {
        padding: 20px;
    }
    
    .mission-card {
        padding: 30px 20px;
    }
    
    .value-card {
        padding: 30px 20px;
    }
    
    .instructor-card {
        padding: 30px 20px;
    }
    
    .feature-card {
        padding: 30px 20px;
    }
}
</style>

<script>
// Contact instructor function
function contactInstructor(instructorId) {
    // You can implement this to open a contact form or redirect to contact page
    window.location.href = `/contact?instructor=${instructorId}`;
}

// Animate statistics on scroll
function animateStats() {
    const stats = document.querySelectorAll('.stat-number');
    
    stats.forEach(stat => {
        const target = parseInt(stat.getAttribute('data-target'));
        const duration = 2000; // 2 seconds
        const increment = target / (duration / 16); // 60fps
        let current = 0;
        
        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                current = target;
                clearInterval(timer);
            }
            stat.textContent = Math.floor(current).toLocaleString();
        }, 16);
    });
}

// Intersection Observer for animations
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            if (entry.target.classList.contains('hero-stats')) {
                animateStats();
            }
            entry.target.style.opacity = '1';
            entry.target.style.transform = 'translateY(0)';
        }
    });
}, observerOptions);

// Observe elements for animation
document.addEventListener('DOMContentLoaded', () => {
    const animatedElements = document.querySelectorAll('.achievement-card, .mission-card, .value-card, .instructor-card, .feature-card');
    
    animatedElements.forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(30px)';
        el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(el);
    });
    
    // Observe hero stats
    const heroStats = document.querySelector('.hero-stats');
    if (heroStats) {
        observer.observe(heroStats);
    }
});
</script>
@endsection 