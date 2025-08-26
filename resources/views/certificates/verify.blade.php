@extends('layouts.app')

@section('title', 'التحقق من الشهادة')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-primary text-white text-center py-4">
                    <h2 class="mb-0">
                        <i class="bi bi-shield-check"></i>
                        التحقق من صحة الشهادة
                    </h2>
                    <p class="mb-0 mt-2">Certificate Verification</p>
                </div>
                
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <div class="verification-icon mb-3">
                            <i class="bi bi-award" style="font-size: 3rem; color: #10b981;"></i>
                        </div>
                        <h4 class="text-muted">أدخل بيانات الشهادة للتحقق من صحتها</h4>
                        <p class="text-muted">Enter certificate details to verify its authenticity</p>
                    </div>

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-triangle"></i>
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('certificates.verify') }}">
                        @csrf
                        
                        <div class="mb-4">
                            <label for="certificate_number" class="form-label">
                                <i class="bi bi-hash"></i>
                                رقم الشهادة / Certificate Number
                            </label>
                            <input type="text" 
                                   class="form-control form-control-lg @error('certificate_number') is-invalid @enderror" 
                                   id="certificate_number" 
                                   name="certificate_number" 
                                   value="{{ old('certificate_number') }}"
                                   placeholder="مثال: GA-2025-000001"
                                   required>
                            @error('certificate_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="verification_code" class="form-label">
                                <i class="bi bi-key"></i>
                                رمز التحقق / Verification Code
                            </label>
                            <input type="text" 
                                   class="form-control form-control-lg @error('verification_code') is-invalid @enderror" 
                                   id="verification_code" 
                                   name="verification_code" 
                                   value="{{ old('verification_code') }}"
                                   placeholder="مثال: A1B2C3D4"
                                   required>
                            @error('verification_code')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="bi bi-search"></i>
                                التحقق من الشهادة
                            </button>
                        </div>
                    </form>

                    <div class="text-center mt-4">
                        <div class="verification-info p-3 bg-light rounded">
                            <h6 class="text-muted mb-2">
                                <i class="bi bi-info-circle"></i>
                                معلومات مهمة
                            </h6>
                            <p class="text-muted small mb-0">
                                يمكنك العثور على رقم الشهادة ورمز التحقق في أسفل الشهادة المطبوعة
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional Info -->
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body text-center">
                            <i class="bi bi-shield-check text-success" style="font-size: 2rem;"></i>
                            <h5 class="mt-2">شهادات معتمدة</h5>
                            <p class="text-muted small">جميع شهاداتنا معتمدة من الأكاديمية</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body text-center">
                            <i class="bi bi-globe text-primary" style="font-size: 2rem;"></i>
                            <h5 class="mt-2">صالحة دولياً</h5>
                            <p class="text-muted small">الشهادات معترف بها في جميع أنحاء العالم</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.verification-icon {
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

.form-control-lg {
    font-size: 1.1rem;
    padding: 0.75rem 1rem;
}

.btn-lg {
    padding: 0.75rem 2rem;
    font-size: 1.1rem;
}

.verification-info {
    border-left: 4px solid #10b981;
}
</style>
@endsection 