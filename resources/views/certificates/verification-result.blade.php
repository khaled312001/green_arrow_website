@extends('layouts.app')

@section('title', 'نتيجة التحقق من الشهادة')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-success text-white text-center py-4">
                    <h2 class="mb-0">
                        <i class="bi bi-check-circle"></i>
                        شهادة صحيحة ومعتمدة
                    </h2>
                    <p class="mb-0 mt-2">Valid and Authenticated Certificate</p>
                </div>
                
                <div class="card-body p-5">
                    <!-- Success Icon -->
                    <div class="text-center mb-4">
                        <div class="success-icon mb-3">
                            <i class="bi bi-award-fill" style="font-size: 4rem; color: #10b981;"></i>
                        </div>
                        <h4 class="text-success">تم التحقق من صحة الشهادة بنجاح!</h4>
                        <p class="text-muted">Certificate has been successfully verified</p>
                    </div>

                    <!-- Certificate Details -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-card mb-4">
                                <h5 class="card-title">
                                    <i class="bi bi-person-circle text-primary"></i>
                                    معلومات الطالب
                                </h5>
                                <div class="info-item">
                                    <span class="label">الاسم:</span>
                                    <span class="value">{{ $certificate->user->name }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="label">البريد الإلكتروني:</span>
                                    <span class="value">{{ $certificate->user->email }}</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="info-card mb-4">
                                <h5 class="card-title">
                                    <i class="bi bi-book text-success"></i>
                                    معلومات الدورة
                                </h5>
                                <div class="info-item">
                                    <span class="label">اسم الدورة:</span>
                                    <span class="value">{{ $certificate->course->title_ar }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="label">المدرب:</span>
                                    <span class="value">{{ $certificate->course->instructor->name }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Certificate Details -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-card mb-4">
                                <h5 class="card-title">
                                    <i class="bi bi-hash text-warning"></i>
                                    تفاصيل الشهادة
                                </h5>
                                <div class="info-item">
                                    <span class="label">رقم الشهادة:</span>
                                    <span class="value certificate-number">{{ $certificate->certificate_number }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="label">رمز التحقق:</span>
                                    <span class="value verification-code">{{ $certificate->verification_code }}</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="info-card mb-4">
                                <h5 class="card-title">
                                    <i class="bi bi-calendar-check text-info"></i>
                                    تواريخ مهمة
                                </h5>
                                <div class="info-item">
                                    <span class="label">تاريخ الإصدار:</span>
                                    <span class="value">{{ $certificate->issued_at->format('d/m/Y') }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="label">حالة الشهادة:</span>
                                    <span class="value status-valid">صحيحة ومعتمدة</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Verification Status -->
                    <div class="verification-status text-center p-4 bg-light rounded">
                        <div class="status-icon mb-3">
                            <i class="bi bi-shield-check" style="font-size: 3rem; color: #10b981;"></i>
                        </div>
                        <h5 class="text-success mb-2">هذه الشهادة صحيحة ومعتمدة من أكاديمية السهم الأخضر</h5>
                        <p class="text-muted mb-0">
                            يمكن استخدام هذه الشهادة كدليل على إكمال الدورة بنجاح
                        </p>
                    </div>

                    <!-- Action Buttons -->
                    <div class="text-center mt-4">
                        <a href="{{ route('certificates.verify') }}" class="btn btn-outline-primary me-2">
                            <i class="bi bi-search"></i>
                            التحقق من شهادة أخرى
                        </a>
                        <a href="{{ route('home') }}" class="btn btn-primary">
                            <i class="bi bi-house"></i>
                            العودة للرئيسية
                        </a>
                    </div>
                </div>
            </div>

            <!-- Additional Info -->
            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center">
                            <i class="bi bi-shield-check text-success" style="font-size: 2rem;"></i>
                            <h6 class="mt-2">معتمدة</h6>
                            <p class="text-muted small">شهادة معتمدة من الأكاديمية</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center">
                            <i class="bi bi-globe text-primary" style="font-size: 2rem;"></i>
                            <h6 class="mt-2">دولية</h6>
                            <p class="text-muted small">معترف بها عالمياً</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center">
                            <i class="bi bi-clock-history text-warning" style="font-size: 2rem;"></i>
                            <h6 class="mt-2">دائمة</h6>
                            <p class="text-muted small">صالحة مدى الحياة</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.success-icon {
    width: 100px;
    height: 100px;
    background: linear-gradient(135deg, #10b981, #059669);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
    color: white;
}

.info-card {
    background: #f8f9fa;
    border-radius: 12px;
    padding: 1.5rem;
    border-left: 4px solid #10b981;
}

.info-card .card-title {
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 1rem;
    color: #1f2937;
}

.info-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.5rem 0;
    border-bottom: 1px solid #e5e7eb;
}

.info-item:last-child {
    border-bottom: none;
}

.info-item .label {
    font-weight: 600;
    color: #6b7280;
}

.info-item .value {
    font-weight: 500;
    color: #1f2937;
}

.certificate-number {
    background: #10b981;
    color: white;
    padding: 0.25rem 0.5rem;
    border-radius: 6px;
    font-family: monospace;
}

.verification-code {
    background: #fbbf24;
    color: #1f2937;
    padding: 0.25rem 0.5rem;
    border-radius: 6px;
    font-family: monospace;
    font-weight: 600;
}

.status-valid {
    color: #10b981;
    font-weight: 600;
}

.verification-status {
    border: 2px solid #10b981;
}

.status-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #10b981, #059669);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
    color: white;
}
</style>
@endsection 