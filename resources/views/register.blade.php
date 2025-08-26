@extends('layouts.app')

@section('title', 'سجل الآن - ابدأ رحلة التعلم معنا')
@section('meta_description', 'انضم إلى آلاف الطلاب الذين طوروا مهاراتهم وحققوا أحلامهم المهنية من خلال دوراتنا المتميزة والورش المجانية')

@section('content')
<!-- Enhanced Hero Section -->
<section class="hero-section">
    <div class="hero-background">
        <div class="hero-particles"></div>
        <div class="hero-gradient"></div>
    </div>
    <div class="hero-container">
        <div class="hero-content">
            <div class="hero-badge">
                <i class="bi bi-rocket-takeoff"></i>
                <span>ابدأ رحلتك</span>
            </div>
            <h1 class="hero-title">
                <span class="highlight">سجل الآن</span>
                <br>ابدأ رحلة التعلم معنا اليوم
            </h1>
            <p class="hero-subtitle">
                انضم إلى آلاف الطلاب الذين طوروا مهاراتهم وحققوا أحلامهم المهنية من خلال دوراتنا المتميزة والورش المجانية
            </p>
            <div class="hero-stats">
                <div class="stat-item">
                    <div class="stat-number" data-target="5000">0</div>
                    <div class="stat-label">طالب مسجل</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number" data-target="50">0</div>
                    <div class="stat-label">دورة متاحة</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number" data-target="95">0</div>
                    <div class="stat-label">% نسبة الرضا</div>
                </div>
            </div>
        </div>
        <div class="hero-visual">
            <div class="floating-cards">
                <div class="card card-1">
                    <div class="card-icon">
                        <i class="bi bi-laptop"></i>
                    </div>
                    <span>دورات أونلاين</span>
                </div>
                <div class="card card-2">
                    <div class="card-icon">
                        <i class="bi bi-people"></i>
                    </div>
                    <span>ورش حضورية</span>
                </div>
                <div class="card card-3">
                    <div class="card-icon">
                        <i class="bi bi-award"></i>
                    </div>
                    <span>شهادات معتمدة</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Registration Options -->
<section class="registration-options">
    <div class="container">
        <div class="section-header">
            <div class="section-badge">
                <i class="bi bi-check-circle"></i>
                <span>اختر نوع التسجيل</span>
            </div>
            <h2 class="section-title">اختر نوع التسجيل</h2>
            <p class="section-description">يمكنك التسجيل في دوراتنا المميزة أو حضور ورش مجانية</p>
        </div>
        
        <div class="options-grid">
            <div class="option-card" data-type="course">
                <div class="option-icon">
                    <i class="bi bi-book"></i>
                </div>
                <h3>التسجيل في دورة</h3>
                <p>اختر من بين دوراتنا المميزة في البرمجة والإدارة واللغات</p>
                <div class="option-features">
                    <span><i class="bi bi-check-circle"></i> شهادة معتمدة</span>
                    <span><i class="bi bi-check-circle"></i> دعم فني</span>
                    <span><i class="bi bi-check-circle"></i> وصول مدى الحياة</span>
                </div>
                <button class="btn-select" onclick="selectOption('course')">اختيار</button>
            </div>
            
            <div class="option-card" data-type="workshop_online">
                <div class="option-icon">
                    <i class="bi bi-camera-video"></i>
                </div>
                <h3>ورشة أونلاين مجانية</h3>
                <p>احضر ورش مجانية عبر الإنترنت مع مدربين محترفين</p>
                <div class="option-features">
                    <span><i class="bi bi-check-circle"></i> مجانية تماماً</span>
                    <span><i class="bi bi-check-circle"></i> تفاعل مباشر</span>
                    <span><i class="bi bi-check-circle"></i> شهادة حضور</span>
                </div>
                <button class="btn-select" onclick="selectOption('workshop_online')">اختيار</button>
            </div>
            
            <div class="option-card" data-type="workshop_offline">
                <div class="option-icon">
                    <i class="bi bi-geo-alt"></i>
                </div>
                <h3>ورشة حضورية مجانية</h3>
                <p>احضر ورش مجانية في مقرنا بمكة المكرمة</p>
                <div class="option-features">
                    <span><i class="bi bi-check-circle"></i> مجانية تماماً</span>
                    <span><i class="bi bi-check-circle"></i> تجربة تفاعلية</span>
                    <span><i class="bi bi-check-circle"></i> شهادة حضور</span>
                </div>
                <button class="btn-select" onclick="selectOption('workshop_offline')">اختيار</button>
            </div>
        </div>
    </div>
</section>

<!-- Registration Form -->
<section class="registration-form-section" id="registrationForm">
    <div class="container">
        <div class="form-container">
            <div class="form-header">
                <div class="section-badge">
                    <i class="bi bi-person-plus"></i>
                    <span>نموذج التسجيل</span>
                </div>
                <h2 class="section-title">نموذج التسجيل</h2>
                <p class="section-description">املأ البيانات التالية وسنتواصل معك قريباً</p>
            </div>
            
            @if(session('success'))
                <div class="alert alert-success">
                    <i class="bi bi-check-circle"></i>
                    {{ session('success') }}
                </div>
            @endif
            
            @if($errors->any())
                <div class="alert alert-danger">
                    <i class="bi bi-exclamation-triangle"></i>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <form action="{{ route('register.submit') }}" method="POST" class="registration-form">
                @csrf
                <input type="hidden" name="registration_type" id="registrationType" value="">
                
                <!-- Course Selection (shown when course is selected) -->
                <div class="form-group course-selection" id="courseSelection" style="display: none;">
                    <label for="course_id">اختر الدورة</label>
                    <select name="course_id" id="course_id" class="form-control">
                        <option value="">-- اختر الدورة --</option>
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}" data-price="{{ $course->price }}">
                                {{ $course->title_ar }} - {{ $course->category->name_ar }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <!-- Workshop Type (shown when workshop is selected) -->
                <div class="form-group workshop-selection" id="workshopSelection" style="display: none;">
                    <label for="workshop_type">نوع الورشة</label>
                    <select name="workshop_type" id="workshop_type" class="form-control">
                        <option value="">-- اختر نوع الورشة --</option>
                        <option value="programming">برمجة وتطوير</option>
                        <option value="business">إدارة أعمال</option>
                        <option value="language">لغات</option>
                        <option value="design">تصميم جرافيك</option>
                    </select>
                    
                    <div class="form-group">
                        <label for="workshop_date">التاريخ المفضل</label>
                        <input type="date" name="workshop_date" id="workshop_date" class="form-control" min="{{ date('Y-m-d', strtotime('+1 day')) }}">
                    </div>
                    
                    <div class="form-group">
                        <label for="preferred_time">الوقت المفضل</label>
                        <select name="preferred_time" id="preferred_time" class="form-control">
                            <option value="">-- اختر الوقت --</option>
                            <option value="morning">صباحاً (9:00 - 12:00)</option>
                            <option value="afternoon">ظهراً (2:00 - 5:00)</option>
                            <option value="evening">مساءً (6:00 - 9:00)</option>
                        </select>
                    </div>
                </div>
                
                <!-- Personal Information -->
                <div class="form-row">
                    <div class="form-group">
                        <label for="name">الاسم الكامل *</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">البريد الإلكتروني *</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="phone">رقم الهاتف *</label>
                    <input type="tel" name="phone" id="phone" class="form-control" value="{{ old('phone') }}" required>
                </div>
                
                <div class="form-group">
                    <label for="message">رسالة إضافية (اختياري)</label>
                    <textarea name="message" id="message" class="form-control" rows="4" placeholder="أخبرنا عن أهدافك التعليمية أو أي استفسارات...">{{ old('message') }}</textarea>
                </div>
                
                <div class="form-actions">
                    <button type="submit" class="btn-submit">
                        <span>إرسال الطلب</span>
                        <i class="bi bi-arrow-left"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- Available Courses -->
<section class="available-courses">
    <div class="container">
        <div class="section-header">
            <div class="section-badge">
                <i class="bi bi-collection"></i>
                <span>الدورات المتاحة</span>
            </div>
            <h2 class="section-title">الدورات المتاحة</h2>
            <p class="section-description">تصفح دوراتنا المميزة واختر ما يناسبك</p>
        </div>
        
        <div class="courses-grid">
            @foreach($courses as $course)
            <div class="course-card">
                <div class="course-image">
                    @if($course->image)
                        <img src="{{ asset('storage/' . $course->image) }}" alt="{{ $course->title_ar }}">
                    @else
                        <div class="course-placeholder">
                            <i class="bi bi-book"></i>
                        </div>
                    @endif
                    <div class="course-category">{{ $course->category->name_ar }}</div>
                </div>
                
                <div class="course-content">
                    <h3>{{ $course->title_ar }}</h3>
                    <p>{{ Str::limit($course->description_ar, 100) }}</p>
                    
                    <div class="course-meta">
                        <span><i class="bi bi-clock"></i> {{ $course->duration }} ساعة</span>
                        <span><i class="bi bi-people"></i> {{ $course->students_count ?? 0 }} طالب</span>
                    </div>
                    
                    <div class="course-price">
                        <span class="price">{{ number_format($course->price) }} ريال</span>
                        <button class="btn-enroll" onclick="selectCourse({{ $course->id }})">التسجيل</button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Why Choose Us -->
<section class="why-choose-us">
    <div class="container">
        <div class="section-header">
            <div class="section-badge">
                <i class="bi bi-star"></i>
                <span>لماذا تختارنا؟</span>
            </div>
            <h2 class="section-title">لماذا تختارنا؟</h2>
            <p class="section-description">نحن نقدم تجربة تعليمية فريدة ومميزة</p>
        </div>
        
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="bi bi-award"></i>
                </div>
                <h3>شهادات معتمدة</h3>
                <p>احصل على شهادات معتمدة من أكاديمية السهم الأخضر</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="bi bi-person-check"></i>
                </div>
                <h3>مدربين محترفين</h3>
                <p>تعلم من مدربين ذوي خبرة عالية في مجالاتهم</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="bi bi-headset"></i>
                </div>
                <h3>دعم فني 24/7</h3>
                <p>فريق دعم فني متاح على مدار الساعة لمساعدتك</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="bi bi-laptop"></i>
                </div>
                <h3>تعلم مرن</h3>
                <p>ادرس في أي وقت ومن أي مكان يناسبك</p>
            </div>
        </div>
    </div>
</section>

<style>
/* Enhanced Hero Section */
.hero-section {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
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
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 60px;
    align-items: center;
    position: relative;
    z-index: 2;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
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
    line-height: 1.2;
    margin-bottom: 20px;
}

.highlight {
    background: linear-gradient(45deg, #fbbf24, #f59e0b);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.hero-subtitle {
    font-size: 1.4rem;
    line-height: 1.6;
    margin-bottom: 30px;
    opacity: 0.9;
}

.hero-stats {
    display: flex;
    gap: 40px;
}

.stat-item {
    text-align: center;
}

.stat-number {
    display: block;
    font-size: 2.5rem;
    font-weight: 800;
    color: #fbbf24;
}

.stat-label {
    font-size: 0.9rem;
    opacity: 0.8;
}

.hero-visual {
    position: relative;
    height: 400px;
}

.floating-cards {
    position: relative;
    height: 100%;
}

.card {
    position: absolute;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 15px;
    padding: 20px;
    text-align: center;
    animation: float 6s ease-in-out infinite;
    transition: all 0.3s ease;
}

.card:hover {
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
    margin: 0 auto 10px;
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
    background: linear-gradient(135deg, #667eea, #764ba2);
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
    color: #1f2937;
    margin-bottom: 15px;
}

.section-description {
    font-size: 1.1rem;
    color: #6b7280;
    max-width: 600px;
    margin: 0 auto;
}

/* Registration Options */
.registration-options {
    padding: 80px 0;
    background: #f8fafc;
}

.options-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 30px;
    margin-top: 40px;
}

.option-card {
    background: white;
    border-radius: 20px;
    padding: 40px 30px;
    text-align: center;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    cursor: pointer;
    border: 2px solid transparent;
    position: relative;
    overflow: hidden;
}

.option-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(16, 185, 129, 0.1), transparent);
    transition: left 0.6s ease;
}

.option-card:hover::before {
    left: 100%;
}

.option-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    border-color: #10b981;
}

.option-card.selected {
    border-color: #10b981;
    background: linear-gradient(135deg, #f0fdf4 0%, #ecfdf5 100%);
}

.option-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
    position: relative;
    z-index: 1;
}

.option-icon i {
    font-size: 2rem;
    color: white;
}

.option-card h3 {
    font-size: 1.5rem;
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 15px;
}

.option-card p {
    color: #6b7280;
    margin-bottom: 25px;
    line-height: 1.6;
}

.option-features {
    display: flex;
    flex-direction: column;
    gap: 10px;
    margin-bottom: 25px;
}

.option-features span {
    display: flex;
    align-items: center;
    gap: 10px;
    color: #374151;
    font-size: 0.9rem;
}

.option-features i {
    color: #10b981;
}

.btn-select {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: white;
    border: none;
    padding: 12px 30px;
    border-radius: 25px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
    z-index: 1;
}

.btn-select:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 20px rgba(16, 185, 129, 0.3);
}

/* Registration Form */
.registration-form-section {
    padding: 80px 0;
    background: white;
}

.form-container {
    max-width: 800px;
    margin: 0 auto;
    background: white;
    border-radius: 20px;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    padding: 50px;
    position: relative;
    overflow: hidden;
}

.form-container::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #667eea, #764ba2, #fbbf24, #10b981);
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

.alert-success {
    background: #d1fae5;
    color: #065f46;
    border: 1px solid #a7f3d0;
}

.alert-danger {
    background: #fee2e2;
    color: #991b1b;
    border: 1px solid #fecaca;
}

.alert ul {
    margin: 0;
    padding-right: 20px;
}

.registration-form {
    display: flex;
    flex-direction: column;
    gap: 25px;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}

.form-group {
    display: flex;
    flex-direction: column;
}

.form-group label {
    font-weight: 600;
    color: #374151;
    margin-bottom: 8px;
}

.form-control {
    padding: 15px 20px;
    border: 2px solid #e5e7eb;
    border-radius: 10px;
    font-size: 1rem;
    transition: all 0.3s ease;
    background: white;
}

.form-control:focus {
    outline: none;
    border-color: #10b981;
    box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
}

.form-control:invalid {
    border-color: #ef4444;
}

.form-actions {
    text-align: center;
    margin-top: 20px;
}

.btn-submit {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: white;
    border: none;
    padding: 15px 40px;
    border-radius: 25px;
    font-size: 1.1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 10px;
}

.btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 15px 30px rgba(16, 185, 129, 0.3);
}

/* Available Courses */
.available-courses {
    padding: 80px 0;
    background: #f8fafc;
}

.courses-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 30px;
    margin-top: 40px;
}

.course-card {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

.course-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
}

.course-image {
    position: relative;
    height: 200px;
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    display: flex;
    align-items: center;
    justify-content: center;
}

.course-placeholder {
    color: white;
    font-size: 3rem;
}

.course-category {
    position: absolute;
    top: 15px;
    right: 15px;
    background: rgba(255, 255, 255, 0.9);
    color: #10b981;
    padding: 5px 15px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
}

.course-content {
    padding: 25px;
}

.course-content h3 {
    font-size: 1.3rem;
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 10px;
}

.course-content p {
    color: #6b7280;
    margin-bottom: 20px;
    line-height: 1.6;
}

.course-meta {
    display: flex;
    gap: 20px;
    margin-bottom: 20px;
}

.course-meta span {
    display: flex;
    align-items: center;
    gap: 5px;
    color: #6b7280;
    font-size: 0.9rem;
}

.course-price {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.price {
    font-size: 1.2rem;
    font-weight: 700;
    color: #10b981;
}

.btn-enroll {
    background: #10b981;
    color: white;
    border: none;
    padding: 8px 20px;
    border-radius: 20px;
    font-size: 0.9rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-enroll:hover {
    background: #059669;
    transform: translateY(-2px);
}

/* Why Choose Us */
.why-choose-us {
    padding: 80px 0;
    background: white;
}

.features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 30px;
    margin-top: 40px;
}

.feature-card {
    text-align: center;
    padding: 30px 20px;
    transition: all 0.3s ease;
}

.feature-card:hover {
    transform: translateY(-5px);
}

.feature-icon {
    width: 70px;
    height: 70px;
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
}

.feature-icon i {
    font-size: 1.8rem;
    color: white;
}

.feature-card h3 {
    font-size: 1.3rem;
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 15px;
}

.feature-card p {
    color: #6b7280;
    line-height: 1.6;
}

/* Responsive Design */
@media (max-width: 768px) {
    .hero-container {
        grid-template-columns: 1fr;
        gap: 40px;
        text-align: center;
    }
    
    .hero-title {
        font-size: 2.5rem;
    }
    
    .hero-stats {
        justify-content: center;
    }
    
    .options-grid {
        grid-template-columns: 1fr;
    }
    
    .form-row {
        grid-template-columns: 1fr;
    }
    
    .courses-grid {
        grid-template-columns: 1fr;
    }
    
    .features-grid {
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    }
    
    .form-container {
        padding: 30px 20px;
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
    
    .floating-cards .card {
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

// Option Selection
function selectOption(type) {
    // Remove selected class from all cards
    document.querySelectorAll('.option-card').forEach(card => {
        card.classList.remove('selected');
    });
    
    // Add selected class to clicked card
    event.target.closest('.option-card').classList.add('selected');
    
    // Set registration type
    document.getElementById('registrationType').value = type;
    
    // Show/hide form sections
    const courseSelection = document.getElementById('courseSelection');
    const workshopSelection = document.getElementById('workshopSelection');
    
    if (type === 'course') {
        courseSelection.style.display = 'block';
        workshopSelection.style.display = 'none';
    } else {
        courseSelection.style.display = 'none';
        workshopSelection.style.display = 'block';
    }
    
    // Scroll to form
    document.getElementById('registrationForm').scrollIntoView({
        behavior: 'smooth'
    });
}

// Course Selection
function selectCourse(courseId) {
    // Select course option
    selectOption('course');
    
    // Set course ID
    document.getElementById('course_id').value = courseId;
    
    // Scroll to form
    document.getElementById('registrationForm').scrollIntoView({
        behavior: 'smooth'
    });
}

// Form Validation
document.querySelector('.registration-form').addEventListener('submit', function(e) {
    const registrationType = document.getElementById('registrationType').value;
    
    if (!registrationType) {
        e.preventDefault();
        alert('يرجى اختيار نوع التسجيل أولاً');
        return;
    }
    
    if (registrationType === 'course') {
        const courseId = document.getElementById('course_id').value;
        if (!courseId) {
            e.preventDefault();
            alert('يرجى اختيار دورة');
            return;
        }
    }
    
    if (registrationType.includes('workshop')) {
        const workshopType = document.getElementById('workshop_type').value;
        if (!workshopType) {
            e.preventDefault();
            alert('يرجى اختيار نوع الورشة');
            return;
        }
    }
    
    // Show loading state
    const submitBtn = document.querySelector('.btn-submit');
    submitBtn.classList.add('loading');
    submitBtn.disabled = true;
});

// Phone number formatting
document.getElementById('phone').addEventListener('input', function(e) {
    let value = e.target.value.replace(/\D/g, '');
    if (value.length > 0) {
        if (value.startsWith('966')) {
            value = value.substring(3);
        }
        if (value.startsWith('0')) {
            value = value.substring(1);
        }
        if (value.length > 9) {
            value = value.substring(0, 9);
        }
    }
    e.target.value = value;
});

// Initialize animations
document.addEventListener('DOMContentLoaded', function() {
    // Observe elements for animation
    const animatedElements = document.querySelectorAll('.hero-section, .option-card, .form-container, .course-card, .feature-card');
    
    animatedElements.forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(30px)';
        el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(el);
    });
});

// Smooth scrolling for all internal links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth'
            });
        }
    });
});
</script>
@endsection 