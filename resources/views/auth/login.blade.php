@extends('layouts.app')

@section('title', 'تسجيل الدخول - أكاديمية السهم الأخضر للتدريب')
@section('meta_description', 'سجل دخولك إلى أكاديمية السهم الأخضر للوصول إلى دوراتك ومتابعة تقدمك التعليمي')

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
                <i class="bi bi-person-check"></i>
                <span>مرحباً بك</span>
            </div>
            <h1 class="hero-title">
                <span class="highlight">سجل دخولك</span>
                <br>وواصل رحلة التعلم
            </h1>
            <p class="hero-subtitle">
                سجل دخولك للوصول إلى دوراتك ومتابعة تقدمك التعليمي مع أكاديمية السهم الأخضر
            </p>
            <div class="hero-stats">
                <div class="stat-item">
                    <div class="stat-number" data-target="5000">0</div>
                    <div class="stat-label">طالب نشط</div>
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
                        <i class="bi bi-book"></i>
                    </div>
                    <span>دورات متنوعة</span>
                </div>
                <div class="card card-2">
                    <div class="card-icon">
                        <i class="bi bi-graph-up"></i>
                    </div>
                    <span>تقدم مستمر</span>
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

<!-- Login Form Section -->
<section class="login-form-section">
    <div class="container">
        <div class="form-wrapper">
            <div class="form-header">
                <div class="section-badge">
                    <i class="bi bi-person-check"></i>
                    <span>تسجيل الدخول</span>
                </div>
                <h2 class="section-title">مرحباً بك مرة أخرى</h2>
                <p class="section-description">سجل دخولك للوصول إلى حسابك ومتابعة دوراتك</p>
            </div>

            @if(session('status'))
                <div class="alert success">
                    <i class="bi bi-check-circle"></i>
                    {{ session('status') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert error">
                    <i class="bi bi-exclamation-triangle"></i>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="login-form">
                @csrf
                
                <div class="form-group">
                    <label for="email">البريد الإلكتروني</label>
                    <div class="input-group">
                        <i class="bi bi-envelope input-icon"></i>
                        <input type="email" id="email" name="email" class="form-control" 
                               value="{{ old('email') }}" required placeholder="أدخل بريدك الإلكتروني">
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="password">كلمة المرور</label>
                    <div class="input-group">
                        <i class="bi bi-lock input-icon"></i>
                        <input type="password" id="password" name="password" class="form-control" 
                               required placeholder="أدخل كلمة المرور">
                        <button type="button" class="password-toggle" onclick="togglePassword()">
                            <i class="bi bi-eye" id="passwordToggle"></i>
                        </button>
                    </div>
                </div>
                
                <div class="form-options">
                    <label class="checkbox-container">
                        <input type="checkbox" name="remember">
                        <span class="checkmark"></span>
                        <span class="checkbox-text">تذكرني</span>
                    </label>
                    <a href="{{ route('password.request') }}" class="forgot-link">
                        نسيت كلمة المرور؟
                    </a>
                </div>
                
                <button type="submit" class="btn-submit">
                    <i class="bi bi-box-arrow-in-right"></i>
                    تسجيل الدخول
                </button>
            </form>
            
            <!-- Divider -->
            <div class="divider">
                <span>أو</span>
            </div>
            
            <!-- Social Login -->
            <div class="social-login">
                <a href="{{ route('auth.google') }}" class="social-btn google">
                    <i class="bi bi-google"></i>
                    <span>تسجيل الدخول بجوجل</span>
                </a>
                <button class="social-btn facebook">
                    <i class="bi bi-facebook"></i>
                    <span>تسجيل الدخول بفيسبوك</span>
                </button>
            </div>
            
            <!-- Register Link -->
            <div class="register-link">
                <p>ليس لديك حساب؟ 
                    <a href="{{ route('register') }}">سجل الآن</a>
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="features-section">
    <div class="container">
        <div class="section-header">
            <div class="section-badge">
                <i class="bi bi-star"></i>
                <span>مميزاتنا</span>
            </div>
            <h2 class="section-title">لماذا تختار أكاديمية السهم الأخضر؟</h2>
            <p class="section-description">نوفر لك تجربة تعليمية فريدة ومميزة</p>
        </div>
        
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="bi bi-laptop"></i>
                </div>
                <h3>تعلم مرن</h3>
                <p>ادرس في أي وقت ومن أي مكان يناسبك</p>
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
                    <i class="bi bi-award"></i>
                </div>
                <h3>شهادات معتمدة</h3>
                <p>احصل على شهادات معتمدة من أكاديمية السهم الأخضر</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="bi bi-headset"></i>
                </div>
                <h3>دعم فني 24/7</h3>
                <p>فريق دعم فني متاح على مدار الساعة لمساعدتك</p>
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
    background: linear-gradient(45deg, #ffffff, #fbbf24);
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

/* Login Form Section */
.login-form-section {
    padding: 80px 0;
    background: #f8fafc;
}

.form-wrapper {
    max-width: 500px;
    margin: 0 auto;
    background: white;
    border-radius: 25px;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
    padding: 50px;
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

.alert ul {
    margin: 0;
    padding-right: 20px;
}

.login-form {
    display: flex;
    flex-direction: column;
    gap: 25px;
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

.input-group {
    position: relative;
    display: flex;
    align-items: center;
}

.input-icon {
    position: absolute;
    right: 15px;
    color: #6b7280;
    font-size: 1.1rem;
    z-index: 1;
}

.form-control {
    width: 100%;
    padding: 15px 45px 15px 20px;
    border: 2px solid #e5e7eb;
    border-radius: 12px;
    font-size: 1rem;
    transition: all 0.3s ease;
    background: white;
}

.form-control:focus {
    outline: none;
    border-color: #667eea;
    box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
}

.password-toggle {
    position: absolute;
    left: 15px;
    background: none;
    border: none;
    color: #6b7280;
    cursor: pointer;
    font-size: 1.1rem;
    z-index: 1;
}

.form-options {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
}

.checkbox-container {
    display: flex;
    align-items: center;
    gap: 8px;
    cursor: pointer;
    color: #6b7280;
}

.checkbox-container input[type="checkbox"] {
    display: none;
}

.checkmark {
    width: 18px;
    height: 18px;
    border: 2px solid #d1d5db;
    border-radius: 4px;
    position: relative;
    transition: all 0.3s ease;
}

.checkbox-container input[type="checkbox"]:checked + .checkmark {
    background: #667eea;
    border-color: #667eea;
}

.checkbox-container input[type="checkbox"]:checked + .checkmark::after {
    content: '✓';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: white;
    font-size: 12px;
    font-weight: bold;
}

.forgot-link {
    color: #667eea;
    text-decoration: none;
    font-size: 0.9rem;
    transition: color 0.3s ease;
}

.forgot-link:hover {
    color: #5a67d8;
}

.btn-submit {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    border: none;
    border-radius: 15px;
    padding: 18px 40px;
    font-size: 1.1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
    width: 100%;
}

.btn-submit:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 35px rgba(102, 126, 234, 0.4);
}

.divider {
    display: flex;
    align-items: center;
    margin: 30px 0;
    color: #6b7280;
}

.divider::before,
.divider::after {
    content: '';
    flex: 1;
    height: 1px;
    background: #e5e7eb;
}

.divider span {
    padding: 0 15px;
    font-size: 0.9rem;
}

.social-login {
    display: flex;
    gap: 15px;
    margin-bottom: 30px;
}

.social-btn {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 12px 20px;
    border: 2px solid #e5e7eb;
    border-radius: 12px;
    text-decoration: none;
    color: #374151;
    font-weight: 500;
    transition: all 0.3s ease;
    background: white;
}

.social-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
}

.social-btn.google:hover {
    border-color: #ea4335;
    color: #ea4335;
}

.social-btn.facebook:hover {
    border-color: #1877f2;
    color: #1877f2;
}

.register-link {
    text-align: center;
    color: #6b7280;
}

.register-link a {
    color: #667eea;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.3s ease;
}

.register-link a:hover {
    color: #5a67d8;
}

/* Features Section */
.features-section {
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
    background: linear-gradient(135deg, #667eea, #764ba2);
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
    
    .form-wrapper {
        padding: 30px 20px;
    }
    
    .social-login {
        flex-direction: column;
    }
    
    .features-grid {
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
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

// Password toggle functionality
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const passwordToggle = document.getElementById('passwordToggle');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        passwordToggle.className = 'bi bi-eye-slash';
    } else {
        passwordInput.type = 'password';
        passwordToggle.className = 'bi bi-eye';
    }
}

// Initialize animations
document.addEventListener('DOMContentLoaded', function() {
    // Observe elements for animation
    const animatedElements = document.querySelectorAll('.hero-section, .form-wrapper, .feature-card');
    
    animatedElements.forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(30px)';
        el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(el);
    });
    
    // Form enhancement
    const form = document.querySelector('.login-form');
    const submitBtn = document.querySelector('.btn-submit');
    
    if (form) {
        form.addEventListener('submit', function(e) {
            const submitText = submitBtn.innerHTML;
            
            // Disable submit button and show loading
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="bi bi-hourglass-split"></i> جاري تسجيل الدخول...';
            
            // Re-enable after 3 seconds (simulate processing)
            setTimeout(() => {
                submitBtn.disabled = false;
                submitBtn.innerHTML = submitText;
            }, 3000);
        });
    }
});
</script>
@endsection 