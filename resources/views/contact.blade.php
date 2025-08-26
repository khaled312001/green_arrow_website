@extends('layouts.app')

@section('title', 'تواصل معنا - ' . setting('site_name'))
@section('meta_description', 'تواصل مع أكاديمية السهم الأخضر للتدريب عبر جميع وسائل التواصل الاجتماعي والطرق المتاحة')

@section('content')
<!-- Enhanced Hero Section -->
<section class="hero-section">
    <div class="hero-background">
        <div class="hero-particles"></div>
        <div class="hero-gradient"></div>
        <div class="hero-shapes">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
            <div class="shape shape-3"></div>
        </div>
    </div>
    <div class="hero-container">
        <div class="hero-content">
            <div class="hero-badge">
                <i class="bi bi-chat-dots"></i>
                <span>دعم متواصل 24/7</span>
            </div>
            <h1 class="hero-title">تواصل معنا</h1>
            <p class="hero-subtitle">نحن هنا لمساعدتك في كل خطوة من رحلة التعلم. فريقنا متاح دائماً للإجابة على استفساراتك</p>
            <div class="hero-stats">
                <div class="stat-item">
                    <div class="stat-icon">
                        <i class="bi bi-clock"></i>
                    </div>
                    <div class="stat-number" data-target="24">0</div>
                    <div class="stat-label">ساعة للرد</div>
                </div>
                <div class="stat-item">
                    <div class="stat-icon">
                        <i class="bi bi-heart"></i>
                    </div>
                    <div class="stat-number" data-target="100">0</div>
                    <div class="stat-label">% رضا العملاء</div>
                </div>
                <div class="stat-item">
                    <div class="stat-icon">
                        <i class="bi bi-people"></i>
                    </div>
                    <div class="stat-number" data-target="5000">0</div>
                    <div class="stat-label">عميل راضي</div>
                </div>
            </div>
            <div class="hero-cta">
                <a href="#contact-form" class="cta-btn primary">
                    <i class="bi bi-chat-text"></i>
                    أرسل رسالة الآن
                </a>
                <a href="#contact-methods" class="cta-btn secondary">
                    <i class="bi bi-telephone"></i>
                    طرق التواصل
                </a>
            </div>
        </div>
        <div class="hero-visual">
            <div class="contact-illustration">
                <div class="illustration-bg"></div>
                <div class="floating-card card-1">
                    <div class="card-icon">
                        <i class="bi bi-headset"></i>
                    </div>
                    <span>دعم فني متخصص</span>
                </div>
                <div class="floating-card card-2">
                    <div class="card-icon">
                        <i class="bi bi-clock"></i>
                    </div>
                    <span>رد سريع خلال 24 ساعة</span>
                </div>
                <div class="floating-card card-3">
                    <div class="card-icon">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <span>حماية كاملة لبياناتك</span>
                </div>
                <div class="floating-card card-4">
                    <div class="card-icon">
                        <i class="bi bi-star"></i>
                    </div>
                    <span>خدمة متميزة</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Methods Section -->
<section class="contact-methods">
    <div class="container">
        <div class="section-header">
            <div class="section-badge">
                <i class="bi bi-telephone"></i>
                <span>طرق التواصل</span>
            </div>
            <h2 class="section-title">اختر الطريقة المناسبة لك</h2>
            <p class="section-description">نوفر لك العديد من طرق التواصل للوصول إلينا بسهولة</p>
        </div>
        
        <div class="methods-grid">
            <!-- WhatsApp -->
            <div class="method-card whatsapp">
                <div class="method-icon">
                    <i class="bi bi-whatsapp"></i>
                </div>
                <div class="method-content">
                    <h3>واتساب</h3>
                    <p>{{ setting('site_whatsapp', '+966 50 123 4567') }}</p>
                    <a href="https://wa.me/{{ str_replace(['+', ' ', '-'], '', setting('site_whatsapp', '+966501234567')) }}" 
                       target="_blank" class="method-btn">
                        <i class="bi bi-whatsapp"></i>
                        تواصل الآن
                    </a>
                </div>
            </div>

            <!-- Phone -->
            <div class="method-card phone">
                <div class="method-icon">
                    <i class="bi bi-telephone"></i>
                </div>
                <div class="method-content">
                    <h3>الهاتف</h3>
                    <p>{{ setting('site_phone', '+966 50 123 4567') }}</p>
                    <a href="tel:{{ setting('site_phone', '+966501234567') }}" class="method-btn">
                        <i class="bi bi-telephone"></i>
                        اتصل الآن
                    </a>
                </div>
            </div>

            <!-- Email -->
            <div class="method-card email">
                <div class="method-icon">
                    <i class="bi bi-envelope"></i>
                </div>
                <div class="method-content">
                    <h3>البريد الإلكتروني</h3>
                    <p>{{ setting('site_email', 'info@greenarrow.edu.sa') }}</p>
                    <a href="mailto:{{ setting('site_email', 'info@greenarrow.edu.sa') }}" class="method-btn">
                        <i class="bi bi-envelope"></i>
                        أرسل بريد
                    </a>
                </div>
            </div>

            <!-- Location -->
            <div class="method-card location">
                <div class="method-icon">
                    <i class="bi bi-geo-alt"></i>
                </div>
                <div class="method-content">
                    <h3>العنوان</h3>
                    <p>{{ setting('site_address', 'الرياض، المملكة العربية السعودية') }}</p>
                    <button onclick="scrollToMap()" class="method-btn">
                        <i class="bi bi-map"></i>
                        عرض الخريطة
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Form Section -->
<section class="contact-form-section">
    <div class="container">
        <div class="form-wrapper">
            <div class="form-header">
                <div class="section-badge">
                    <i class="bi bi-chat-text"></i>
                    <span>رسالة جديدة</span>
                </div>
                <h2 class="section-title">أرسل لنا رسالة</h2>
                <p class="section-description">سنرد عليك في أقرب وقت ممكن</p>
            </div>

            @if(session('success'))
                <div class="alert success">
                    <i class="bi bi-check-circle"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert error">
                    <i class="bi bi-exclamation-triangle"></i>
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('contact.store') }}" class="contact-form">
                @csrf
                <div class="form-row">
                    <div class="form-group">
                        <label for="name">الاسم الكامل</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                        @error('name')
                            <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="email">البريد الإلكتروني</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                        @error('email')
                            <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="phone">رقم الهاتف</label>
                        <input type="tel" id="phone" name="phone" value="{{ old('phone') }}">
                        @error('phone')
                            <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="subject">الموضوع</label>
                        <select id="subject" name="subject" required>
                            <option value="">اختر الموضوع</option>
                            <option value="استفسار عام" {{ old('subject') == 'استفسار عام' ? 'selected' : '' }}>استفسار عام</option>
                            <option value="معلومات عن الدورات" {{ old('subject') == 'معلومات عن الدورات' ? 'selected' : '' }}>معلومات عن الدورات</option>
                            <option value="مشكلة تقنية" {{ old('subject') == 'مشكلة تقنية' ? 'selected' : '' }}>مشكلة تقنية</option>
                            <option value="اقتراح" {{ old('subject') == 'اقتراح' ? 'selected' : '' }}>اقتراح</option>
                            <option value="شكوى" {{ old('subject') == 'شكوى' ? 'selected' : '' }}>شكوى</option>
                            <option value="أخرى" {{ old('subject') == 'أخرى' ? 'selected' : '' }}>أخرى</option>
                        </select>
                        @error('subject')
                            <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group full-width">
                    <label for="message">الرسالة</label>
                    <textarea id="message" name="message" rows="6" placeholder="اكتب رسالتك هنا..." required>{{ old('message') }}</textarea>
                    @error('message')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="submit-btn">
                    <i class="bi bi-send"></i>
                    إرسال الرسالة
                </button>
            </form>
        </div>
    </div>
</section>

<!-- Map Section -->
<section class="map-section" id="map">
    <div class="container">
        <div class="map-header">
            <div class="section-badge">
                <i class="bi bi-geo-alt"></i>
                <span>موقعنا</span>
            </div>
            <h2 class="section-title">موقعنا على الخريطة</h2>
            <p class="section-description">يمكنك الوصول إلينا بسهولة</p>
        </div>
        
        <div class="map-container">
            <div class="map-placeholder">
                <div class="map-content">
                    <i class="bi bi-geo-alt"></i>
                    <h3>أكاديمية السهم الأخضر</h3>
                    <p>{{ setting('site_address', 'الرياض، المملكة العربية السعودية') }}</p>
                    <a href="{{ setting('google_maps_url', 'https://maps.google.com') }}" target="_blank" class="map-btn">
                        <i class="bi bi-arrow-up-right"></i>
                        احصل على الاتجاهات
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="faq-section">
    <div class="container">
        <div class="faq-header">
            <div class="section-badge">
                <i class="bi bi-question-circle"></i>
                <span>الأسئلة الشائعة</span>
            </div>
            <h2 class="section-title">إجابات على أكثر الأسئلة شيوعاً</h2>
            <p class="section-description">نوفر لك إجابات شاملة على جميع استفساراتك</p>
        </div>
        
        <div class="faq-list">
            <div class="faq-item">
                <div class="faq-question">
                    <h4>كيف يمكنني التسجيل في الدورات؟</h4>
                    <i class="bi bi-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    <p>يمكنك التسجيل في الدورات من خلال إنشاء حساب جديد أو تسجيل الدخول إذا كان لديك حساب، ثم اختيار الدورة المطلوبة والضغط على زر التسجيل.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <div class="faq-question">
                    <h4>هل الدورات مجانية أم مدفوعة؟</h4>
                    <i class="bi bi-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    <p>نقدم مزيجاً من الدورات المجانية والمدفوعة. الدورات المجانية متاحة للجميع، بينما تتطلب الدورات المدفوعة تسجيل الدخول والدفع.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <div class="faq-question">
                    <h4>كيف يمكنني الحصول على شهادة إتمام الدورة؟</h4>
                    <i class="bi bi-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    <p>بعد إتمام جميع الدروس والاختبارات في الدورة بنجاح، ستتمكن من تحميل شهادة إتمام الدورة من لوحة التحكم الخاصة بك.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <div class="faq-question">
                    <h4>هل يمكنني الوصول للدورات في أي وقت؟</h4>
                    <i class="bi bi-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    <p>نعم، بمجرد التسجيل في دورة، يمكنك الوصول إليها في أي وقت ومن أي مكان طالما لديك اتصال بالإنترنت.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
/* Enhanced Hero Section */
.hero-section {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 100px 0;
    position: relative;
    overflow: hidden;
    min-height: 600px;
    display: flex;
    align-items: center;
}

.hero-background {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    overflow: hidden;
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
    background: linear-gradient(45deg, 
        rgba(255,255,255,0.1) 0%, 
        transparent 30%, 
        transparent 70%, 
        rgba(255,255,255,0.1) 100%);
    animation: shimmer 4s ease-in-out infinite;
}

@keyframes floatingLights {
    0%, 100% { transform: translateY(0px) rotate(0deg); opacity: 0.8; }
    25% { transform: translateY(-10px) rotate(1deg); opacity: 1; }
    50% { transform: translateY(5px) rotate(-1deg); opacity: 0.6; }
    75% { transform: translateY(-5px) rotate(0.5deg); opacity: 0.9; }
}

@keyframes shimmer {
    0% { transform: translateX(-100%) skewX(-15deg); opacity: 0; }
    50% { opacity: 1; }
    100% { transform: translateX(200%) skewX(-15deg); opacity: 0; }
}

.hero-container {
    display: flex;
    align-items: center;
    justify-content: space-between;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
    position: relative;
    z-index: 2;
}

.hero-content {
    flex: 1;
    color: white;
}

.hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.3);
    border-radius: 50px;
    padding: 8px 20px;
    margin-bottom: 30px;
    font-size: 0.9rem;
    font-weight: 500;
}

.hero-title {
    font-size: 4rem;
    font-weight: 800;
    margin-bottom: 20px;
    line-height: 1.2;
    background: linear-gradient(45deg, #ffffff, #fbbf24);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.hero-subtitle {
    font-size: 1.4rem;
    opacity: 0.9;
    margin-bottom: 40px;
    line-height: 1.6;
}

.hero-stats {
    display: flex;
    gap: 40px;
}

.stat-item {
    text-align: center;
}

.stat-number {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 5px;
    color: #fbbf24;
}

.stat-label {
    font-size: 0.9rem;
    opacity: 0.8;
}

.hero-visual {
    flex: 1;
    position: relative;
    height: 400px;
}

.floating-card {
    position: absolute;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 15px;
    padding: 20px;
    display: flex;
    align-items: center;
    gap: 10px;
    color: white;
    animation: float 6s ease-in-out infinite;
    transition: all 0.3s ease;
}

.floating-card:hover {
    transform: translateY(-10px) scale(1.05);
    background: rgba(255, 255, 255, 0.2);
}

.card-icon {
    width: 40px;
    height: 40px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.card-icon i {
    font-size: 1.2rem;
    color: #fbbf24;
}

.card-1 {
    top: 20%;
    left: 10%;
    animation-delay: 0s;
}

.card-2 {
    top: 50%;
    right: 20%;
    animation-delay: 2s;
}

.card-3 {
    bottom: 20%;
    left: 30%;
    animation-delay: 4s;
}

@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-20px); }
}

/* Section Headers */
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
    border-radius: 50px;
    padding: 8px 20px;
    margin-bottom: 20px;
    font-size: 0.9rem;
    font-weight: 500;
}

.section-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 15px;
}

.section-description {
    font-size: 1.1rem;
    color: #64748b;
    max-width: 600px;
    margin: 0 auto;
}

/* Contact Methods Section */
.contact-methods {
    padding: 80px 0;
    background: white;
}

.methods-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 30px;
}

.method-card {
    background: white;
    border-radius: 20px;
    padding: 30px;
    text-align: center;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    border: 1px solid #f1f5f9;
    position: relative;
    overflow: hidden;
}

.method-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.6s ease;
}

.method-card:hover::before {
    left: 100%;
}

.method-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
}

.method-icon {
    width: 80px;
    height: 80px;
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
    font-size: 2rem;
    color: white;
    position: relative;
    z-index: 1;
}

.whatsapp .method-icon {
    background: linear-gradient(135deg, #25d366, #128c7e);
}

.phone .method-icon {
    background: linear-gradient(135deg, #10b981, #059669);
}

.email .method-icon {
    background: linear-gradient(135deg, #8b5cf6, #7c3aed);
}

.location .method-icon {
    background: linear-gradient(135deg, #3b82f6, #1d4ed8);
}

.method-content h3 {
    font-size: 1.3rem;
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 10px;
}

.method-content p {
    color: #64748b;
    margin-bottom: 20px;
}

.method-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 12px 24px;
    border-radius: 10px;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
    color: white;
    position: relative;
    z-index: 1;
}

.whatsapp .method-btn {
    background: linear-gradient(135deg, #25d366, #128c7e);
}

.phone .method-btn {
    background: linear-gradient(135deg, #10b981, #059669);
}

.email .method-btn {
    background: linear-gradient(135deg, #8b5cf6, #7c3aed);
}

.location .method-btn {
    background: linear-gradient(135deg, #3b82f6, #1d4ed8);
    border: none;
    cursor: pointer;
}

.method-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
    color: white;
}

/* Contact Form Section */
.contact-form-section {
    padding: 80px 0;
    background: #f8fafc;
}

.form-wrapper {
    max-width: 800px;
    margin: 0 auto;
    background: white;
    border-radius: 25px;
    padding: 50px;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
    position: relative;
    overflow: hidden;
}

.form-wrapper::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #10b981, #059669, #8b5cf6, #3b82f6);
}

.form-header {
    text-align: center;
    margin-bottom: 40px;
}

.alert {
    padding: 15px 20px;
    border-radius: 10px;
    margin-bottom: 30px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.alert.success {
    background: #d1fae5;
    color: #065f46;
    border: 1px solid #a7f3d0;
}

.alert.error {
    background: #fee2e2;
    color: #991b1b;
    border: 1px solid #fecaca;
}

.contact-form {
    display: flex;
    flex-direction: column;
    gap: 25px;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 25px;
}

.form-group {
    display: flex;
    flex-direction: column;
}

.form-group.full-width {
    grid-column: 1 / -1;
}

.form-group label {
    font-weight: 600;
    color: #374151;
    margin-bottom: 8px;
}

.form-group input,
.form-group select,
.form-group textarea {
    padding: 15px 20px;
    border: 2px solid #e5e7eb;
    border-radius: 12px;
    font-size: 1rem;
    transition: all 0.3s ease;
    background: white;
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
    outline: none;
    border-color: #10b981;
    box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1);
}

.form-group textarea {
    resize: vertical;
    min-height: 120px;
}

.error-text {
    color: #dc2626;
    font-size: 0.9rem;
    margin-top: 5px;
}

.submit-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
    border: none;
    border-radius: 15px;
    padding: 18px 40px;
    font-size: 1.1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 8px 25px rgba(16, 185, 129, 0.3);
    align-self: center;
}

.submit-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 35px rgba(16, 185, 129, 0.4);
}

/* Map Section */
.map-section {
    padding: 80px 0;
    background: white;
}

.map-container {
    max-width: 800px;
    margin: 0 auto;
}

.map-placeholder {
    background: linear-gradient(135deg, #f8fafc, #e2e8f0);
    border-radius: 20px;
    padding: 60px 40px;
    text-align: center;
    border: 2px dashed #cbd5e1;
    transition: all 0.3s ease;
    cursor: pointer;
}

.map-placeholder:hover {
    border-color: #10b981;
    background: linear-gradient(135deg, #f0fdf4, #dcfce7);
}

.map-content i {
    font-size: 3rem;
    color: #10b981;
    margin-bottom: 20px;
}

.map-content h3 {
    font-size: 1.5rem;
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 10px;
}

.map-content p {
    color: #64748b;
    margin-bottom: 25px;
}

.map-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
    text-decoration: none;
    padding: 12px 24px;
    border-radius: 10px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.map-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(16, 185, 129, 0.3);
    color: white;
}

/* FAQ Section */
.faq-section {
    padding: 80px 0;
    background: #f8fafc;
}

.faq-list {
    max-width: 800px;
    margin: 0 auto;
}

.faq-item {
    background: white;
    border-radius: 15px;
    margin-bottom: 20px;
    overflow: hidden;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
}

.faq-item:hover {
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
}

.faq-question {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 25px 30px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.faq-question:hover {
    background: #f8fafc;
}

.faq-question h4 {
    font-size: 1.1rem;
    font-weight: 600;
    color: #1e293b;
    margin: 0;
}

.faq-question i {
    color: #10b981;
    font-size: 1.2rem;
    transition: transform 0.3s ease;
}

.faq-item.active .faq-question i {
    transform: rotate(180deg);
}

.faq-answer {
    padding: 0 30px 25px;
    color: #64748b;
    line-height: 1.6;
    display: none;
}

.faq-item.active .faq-answer {
    display: block;
}

/* Responsive Design */
@media (max-width: 768px) {
    .hero-container {
        flex-direction: column;
        text-align: center;
        gap: 40px;
    }
    
    .hero-title {
        font-size: 2.5rem;
    }
    
    .hero-stats {
        justify-content: center;
        gap: 30px;
    }
    
    .hero-visual {
        height: 300px;
    }
    
    .methods-grid {
        grid-template-columns: 1fr;
    }
    
    .form-row {
        grid-template-columns: 1fr;
    }
    
    .form-wrapper {
        padding: 30px 20px;
    }
    
    .section-title {
        font-size: 2rem;
    }
}

@media (max-width: 480px) {
    .hero-title {
        font-size: 2rem;
    }
    
    .hero-subtitle {
        font-size: 1.1rem;
    }
    
    .hero-stats {
        flex-direction: column;
        gap: 20px;
    }
    
    .floating-card {
        padding: 15px;
        font-size: 0.9rem;
    }
}
</style>

<script>
// Animate stats on scroll
function animateStats() {
    const stats = document.querySelectorAll('.stat-number');
    stats.forEach(stat => {
        const target = parseInt(stat.getAttribute('data-target'));
        const increment = target / 100;
        let current = 0;
        
        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                current = target;
                clearInterval(timer);
            }
            stat.textContent = Math.floor(current);
        }, 20);
    });
}

// Intersection Observer for animations
const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.style.opacity = '1';
            entry.target.style.transform = 'translateY(0)';
            
            // Animate stats when hero section is visible
            if (entry.target.classList.contains('hero-section')) {
                animateStats();
            }
        }
    });
}, {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
});

// FAQ Functionality
document.addEventListener('DOMContentLoaded', function() {
    const faqItems = document.querySelectorAll('.faq-item');
    
    faqItems.forEach(item => {
        const question = item.querySelector('.faq-question');
        
        question.addEventListener('click', () => {
            const isActive = item.classList.contains('active');
            
            // Close all FAQ items
            faqItems.forEach(faq => faq.classList.remove('active'));
            
            // Open clicked item if it wasn't active
            if (!isActive) {
                item.classList.add('active');
            }
        });
    });
    
    // Observe elements for animation
    const animatedElements = document.querySelectorAll('.hero-section, .method-card, .form-wrapper, .map-container, .faq-item');
    
    animatedElements.forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(30px)';
        el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(el);
    });
});

// Smooth scroll to map
function scrollToMap() {
    const mapSection = document.getElementById('map');
    mapSection.scrollIntoView({ behavior: 'smooth' });
}

// Form enhancement
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('.contact-form');
    const submitBtn = document.querySelector('.submit-btn');
    
    if (form) {
        form.addEventListener('submit', function(e) {
            const submitText = submitBtn.innerHTML;
            
            // Disable submit button and show loading
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="bi bi-hourglass-split"></i> جاري الإرسال...';
            
            // Re-enable after 3 seconds (simulate processing)
            setTimeout(() => {
                submitBtn.disabled = false;
                submitBtn.innerHTML = submitText;
            }, 3000);
        });
    }
    
    // Add floating labels effect
    const inputs = document.querySelectorAll('input, select, textarea');
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('focused');
        });
        
        input.addEventListener('blur', function() {
            if (!this.value) {
                this.parentElement.classList.remove('focused');
            }
        });
    });
});
</script>
@endsection 