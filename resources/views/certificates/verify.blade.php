@extends('layouts.app')

@section('title', 'التحقق من الشهادة')

@section('content')
<div class="certificate-verification-page">
    <!-- Hero Section -->
    <div class="hero-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <div class="hero-content">
                        <div class="verification-logo">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <h1 class="hero-title">التحقق من صحة الشهادة</h1>
                        <p class="hero-subtitle">Certificate Verification System</p>
                        <div class="hero-description">
                            <p>تأكد من صحة شهادتك بسهولة وسرعة</p>
                            <p>Verify your certificate authenticity quickly and easily</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Verification Form Section -->
    <div class="verification-form-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="verification-card">
                        <div class="card-header-section">
                            <div class="header-icon">
                                <i class="bi bi-award"></i>
                            </div>
                            <h3>أدخل بيانات الشهادة</h3>
                            <p>Enter Certificate Details</p>
                        </div>

                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <div class="alert-content">
                                    <i class="bi bi-exclamation-triangle"></i>
                                    <span>{{ session('error') }}</span>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('certificates.verify') }}" class="verification-form">
                            @csrf
                            
                            <div class="form-group">
                                <label for="certificate_number" class="form-label">
                                    <i class="bi bi-hash"></i>
                                    رقم الشهادة
                                </label>
                                <input type="text" 
                                       class="form-control @error('certificate_number') is-invalid @enderror" 
                                       id="certificate_number" 
                                       name="certificate_number" 
                                       value="{{ old('certificate_number') }}"
                                       placeholder="مثال: GA-2025-000001"
                                       required>
                                @error('certificate_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="verification_code" class="form-label">
                                    <i class="bi bi-key"></i>
                                    رمز التحقق
                                </label>
                                <input type="text" 
                                       class="form-control @error('verification_code') is-invalid @enderror" 
                                       id="verification_code" 
                                       name="verification_code" 
                                       value="{{ old('verification_code') }}"
                                       placeholder="مثال: A1B2C3D4"
                                       required>
                                @error('verification_code')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="verify-btn">
                                <i class="bi bi-search"></i>
                                <span>التحقق من الشهادة</span>
                            </button>
                        </form>

                        <div class="verification-info">
                            <div class="info-icon">
                                <i class="bi bi-info-circle"></i>
                            </div>
                            <div class="info-content">
                                <h6>معلومات مهمة</h6>
                                <p>يمكنك العثور على رقم الشهادة ورمز التحقق في أسفل الشهادة المطبوعة</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="features-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <h4>شهادات معتمدة</h4>
                        <p>جميع شهاداتنا معتمدة من الأكاديمية وموثقة رسمياً</p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-globe"></i>
                        </div>
                        <h4>صالحة دولياً</h4>
                        <p>الشهادات معترف بها في جميع أنحاء العالم</p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-clock"></i>
                        </div>
                        <h4>تحقق فوري</h4>
                        <p>نتائج التحقق فورية ومؤكدة بنسبة 100%</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Section -->
    <div class="stats-section">
        <div class="container">
            <div class="row text-center">
                <div class="col-lg-3 col-md-6">
                    <div class="stat-item">
                        <div class="stat-number" data-target="10000">0</div>
                        <div class="stat-label">شهادة صادرة</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-item">
                        <div class="stat-number" data-target="5000">0</div>
                        <div class="stat-label">تحقق ناجح</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-item">
                        <div class="stat-number" data-target="100">0</div>
                        <div class="stat-label">دورة معتمدة</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-item">
                        <div class="stat-number" data-target="50">0</div>
                        <div class="stat-label">مدرب معتمد</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.certificate-verification-page {
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    min-height: 100vh;
}

/* Hero Section */
.hero-section {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    padding: 80px 0 60px;
    color: white;
    position: relative;
    overflow: hidden;
}

.hero-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/><circle cx="50" cy="10" r="0.5" fill="white" opacity="0.1"/><circle cx="10" cy="60" r="0.5" fill="white" opacity="0.1"/><circle cx="90" cy="40" r="0.5" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
    opacity: 0.3;
}

.hero-content {
    position: relative;
    z-index: 2;
}

.verification-logo {
    width: 100px;
    height: 100px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 30px;
    font-size: 3rem;
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255, 255, 255, 0.3);
}

.hero-title {
    font-size: 3rem;
    font-weight: 700;
    margin-bottom: 15px;
    text-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.hero-subtitle {
    font-size: 1.5rem;
    opacity: 0.9;
    margin-bottom: 20px;
    font-weight: 300;
}

.hero-description {
    font-size: 1.1rem;
    opacity: 0.8;
    line-height: 1.6;
}

/* Verification Form Section */
.verification-form-section {
    padding: 60px 0;
    margin-top: -30px;
    position: relative;
    z-index: 3;
}

.verification-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.1);
    padding: 40px;
    position: relative;
    overflow: hidden;
}

.verification-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #10b981, #059669, #047857);
}

.card-header-section {
    text-align: center;
    margin-bottom: 40px;
}

.header-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #10b981, #059669);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
    font-size: 2rem;
    color: white;
    box-shadow: 0 10px 20px rgba(16, 185, 129, 0.3);
}

.card-header-section h3 {
    font-size: 1.8rem;
    color: #1f2937;
    margin-bottom: 10px;
    font-weight: 600;
}

.card-header-section p {
    color: #6b7280;
    font-size: 1.1rem;
    margin: 0;
}

/* Form Styles */
.verification-form {
    margin-bottom: 30px;
}

.form-group {
    margin-bottom: 25px;
}

.form-label {
    display: flex;
    align-items: center;
    gap: 8px;
    font-weight: 600;
    color: #374151;
    margin-bottom: 10px;
    font-size: 1rem;
}

.form-label i {
    color: #10b981;
    font-size: 1.1rem;
}

.form-control {
    border: 2px solid #e5e7eb;
    border-radius: 12px;
    padding: 15px 20px;
    font-size: 1rem;
    transition: all 0.3s ease;
    background: #f9fafb;
}

.form-control:focus {
    border-color: #10b981;
    box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
    background: white;
}

.form-control::placeholder {
    color: #9ca3af;
}

.verify-btn {
    width: 100%;
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
    border: none;
    border-radius: 12px;
    padding: 18px 30px;
    font-size: 1.1rem;
    font-weight: 600;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 10px 20px rgba(16, 185, 129, 0.3);
}

.verify-btn:hover {
    background: linear-gradient(135deg, #059669, #047857);
    transform: translateY(-2px);
    box-shadow: 0 15px 30px rgba(16, 185, 129, 0.4);
}

.verify-btn:active {
    transform: translateY(0);
}

/* Alert Styles */
.alert {
    border: none;
    border-radius: 12px;
    padding: 20px;
    margin-bottom: 30px;
}

.alert-danger {
    background: linear-gradient(135deg, #fef2f2, #fee2e2);
    color: #dc2626;
    border-left: 4px solid #dc2626;
}

.alert-content {
    display: flex;
    align-items: center;
    gap: 10px;
}

.alert-content i {
    font-size: 1.2rem;
}

/* Verification Info */
.verification-info {
    background: linear-gradient(135deg, #f0fdf4, #dcfce7);
    border-radius: 12px;
    padding: 20px;
    display: flex;
    align-items: flex-start;
    gap: 15px;
    border-left: 4px solid #10b981;
}

.info-icon {
    color: #10b981;
    font-size: 1.5rem;
    margin-top: 2px;
}

.info-content h6 {
    color: #065f46;
    font-weight: 600;
    margin-bottom: 8px;
}

.info-content p {
    color: #047857;
    margin: 0;
    font-size: 0.95rem;
    line-height: 1.5;
}

/* Features Section */
.features-section {
    padding: 80px 0;
    background: white;
}

.feature-card {
    text-align: center;
    padding: 40px 20px;
    border-radius: 16px;
    background: #f8fafc;
    margin-bottom: 30px;
    transition: all 0.3s ease;
    border: 1px solid #e2e8f0;
}

.feature-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.1);
    background: white;
}

.feature-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #10b981, #059669);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
    font-size: 2rem;
    color: white;
    box-shadow: 0 10px 20px rgba(16, 185, 129, 0.3);
}

.feature-card h4 {
    color: #1f2937;
    font-weight: 600;
    margin-bottom: 15px;
    font-size: 1.3rem;
}

.feature-card p {
    color: #6b7280;
    line-height: 1.6;
    margin: 0;
}

/* Stats Section */
.stats-section {
    padding: 60px 0;
    background: linear-gradient(135deg, #1f2937, #374151);
    color: white;
}

.stat-item {
    text-align: center;
    padding: 20px;
}

.stat-number {
    font-size: 3rem;
    font-weight: 700;
    color: #10b981;
    margin-bottom: 10px;
    text-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.stat-label {
    font-size: 1.1rem;
    opacity: 0.9;
    font-weight: 500;
}

/* Responsive Design */
@media (max-width: 768px) {
    .hero-title {
        font-size: 2rem;
    }
    
    .hero-subtitle {
        font-size: 1.2rem;
    }
    
    .verification-card {
        padding: 30px 20px;
        margin: 0 15px;
    }
    
    .feature-card {
        padding: 30px 15px;
    }
    
    .stat-number {
        font-size: 2.5rem;
    }
}

/* Animation for stats */
@keyframes countUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.stat-item {
    animation: countUp 0.6s ease-out forwards;
}

.stat-item:nth-child(1) { animation-delay: 0.1s; }
.stat-item:nth-child(2) { animation-delay: 0.2s; }
.stat-item:nth-child(3) { animation-delay: 0.3s; }
.stat-item:nth-child(4) { animation-delay: 0.4s; }
</style>

<script>
// Animate stats numbers
document.addEventListener('DOMContentLoaded', function() {
    const stats = document.querySelectorAll('.stat-number');
    
    const animateValue = (element, start, end, duration) => {
        let startTimestamp = null;
        const step = (timestamp) => {
            if (!startTimestamp) startTimestamp = timestamp;
            const progress = Math.min((timestamp - startTimestamp) / duration, 1);
            const current = Math.floor(progress * (end - start) + start);
            element.textContent = current.toLocaleString();
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
                const endValue = parseInt(target.getAttribute('data-target'));
                animateValue(target, 0, endValue, 2000);
                observer.unobserve(target);
            }
        });
    });
    
    stats.forEach(stat => observer.observe(stat));
});

// Form validation enhancement
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('.verification-form');
    const inputs = form.querySelectorAll('input[required]');
    
    inputs.forEach(input => {
        input.addEventListener('blur', function() {
            if (this.value.trim() === '') {
                this.classList.add('is-invalid');
            } else {
                this.classList.remove('is-invalid');
            }
        });
        
        input.addEventListener('input', function() {
            if (this.value.trim() !== '') {
                this.classList.remove('is-invalid');
            }
        });
    });
});
</script>
@endsection 