@extends('layouts.admin')

@section('title', 'الإعدادات - لوحة الإدارة')

@section('content')
<div class="content-area">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">إعدادات الموقع</h2>
                </div>
                <div class="card-body">
                    <!-- Navigation Tabs -->
                    <ul class="nav nav-tabs" id="settingsTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="general-tab" data-bs-toggle="tab" data-bs-target="#general" type="button" role="tab">
                                <i class="bi bi-gear"></i> عام
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="appearance-tab" data-bs-toggle="tab" data-bs-target="#appearance" type="button" role="tab">
                                <i class="bi bi-palette"></i> المظهر
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="courses-tab" data-bs-toggle="tab" data-bs-target="#courses" type="button" role="tab">
                                <i class="bi bi-book"></i> الدورات
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="payment-tab" data-bs-toggle="tab" data-bs-target="#payment" type="button" role="tab">
                                <i class="bi bi-credit-card"></i> الدفع
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="email-tab" data-bs-toggle="tab" data-bs-target="#email" type="button" role="tab">
                                <i class="bi bi-envelope"></i> البريد الإلكتروني
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="social-tab" data-bs-toggle="tab" data-bs-target="#social" type="button" role="tab">
                                <i class="bi bi-share"></i> وسائل التواصل
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="seo-tab" data-bs-toggle="tab" data-bs-target="#seo" type="button" role="tab">
                                <i class="bi bi-search"></i> SEO
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="system-tab" data-bs-toggle="tab" data-bs-target="#system" type="button" role="tab">
                                <i class="bi bi-cpu"></i> النظام
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="notifications-tab" data-bs-toggle="tab" data-bs-target="#notifications" type="button" role="tab">
                                <i class="bi bi-bell"></i> الإشعارات
                            </button>
                        </li>
                    </ul>

                    <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data" id="settingsForm">
                        @csrf
                        @method('PUT')

                        
                        <div class="tab-content mt-4" id="settingsTabsContent">
                            <!-- General Settings Tab -->
                            <div class="tab-pane fade show active" id="general" role="tabpanel">
                                @include('admin.settings.partials.general')
                            </div>

                            <!-- Appearance Settings Tab -->
                            <div class="tab-pane fade" id="appearance" role="tabpanel">
                                @include('admin.settings.partials.appearance')
                            </div>

                            <!-- Courses Settings Tab -->
                            <div class="tab-pane fade" id="courses" role="tabpanel">
                                @include('admin.settings.partials.courses')
                            </div>

                            <!-- Payment Settings Tab -->
                            <div class="tab-pane fade" id="payment" role="tabpanel">
                                @include('admin.settings.partials.payment')
                            </div>

                            <!-- Email Settings Tab -->
                            <div class="tab-pane fade" id="email" role="tabpanel">
                                @include('admin.settings.partials.email')
                            </div>

                            <!-- Social Media Settings Tab -->
                            <div class="tab-pane fade" id="social" role="tabpanel">
                                @include('admin.settings.partials.social')
                            </div>

                            <!-- SEO Settings Tab -->
                            <div class="tab-pane fade" id="seo" role="tabpanel">
                                @include('admin.settings.partials.seo')
                            </div>

                            <!-- System Settings Tab -->
                            <div class="tab-pane fade" id="system" role="tabpanel">
                                @include('admin.settings.partials.system')
                            </div>

                            <!-- Notifications Settings Tab -->
                            <div class="tab-pane fade" id="notifications" role="tabpanel">
                                @include('admin.settings.partials.notifications')
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-lg"></i>
                                حفظ الإعدادات
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions Card -->
    <div class="row mt-4">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">إجراءات سريعة</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <form method="POST" action="{{ route('admin.settings.clear-cache') }}" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-outline-primary w-100" onclick="return confirm('هل أنت متأكد من مسح الذاكرة المؤقتة؟')">
                                    <i class="bi bi-arrow-clockwise"></i>
                                    مسح الذاكرة المؤقتة
                                </button>
                            </form>
                        </div>
                        <div class="col-md-6 mb-3">
                            <form method="POST" action="{{ route('admin.settings.backup-database') }}" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-outline-secondary w-100">
                                    <i class="bi bi-download"></i>
                                    نسخ احتياطي للقاعدة
                                </button>
                            </form>
                        </div>
                        <div class="col-md-6 mb-3">
                            <form method="POST" action="{{ route('admin.settings.optimize-database') }}" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-outline-info w-100">
                                    <i class="bi bi-speedometer2"></i>
                                    تحسين الأداء
                                </button>
                            </form>
                        </div>
                        <div class="col-md-6 mb-3">
                            @php
                                $maintenanceMode = $settings['system']['maintenance_mode'] ?? false;
                            @endphp
                            <form method="POST" action="{{ route('admin.settings.maintenance-mode') }}" class="d-inline">
                                @csrf
                                <input type="hidden" name="enabled" value="{{ $maintenanceMode ? '0' : '1' }}">
                                <button type="submit" class="btn btn-outline-warning w-100" onclick="return confirm('هل أنت متأكد من {{ $maintenanceMode ? 'إلغاء' : 'تفعيل' }} وضع الصيانة؟')">
                                    <i class="bi bi-tools"></i>
                                    @if($maintenanceMode)
                                        إلغاء وضع الصيانة
                                    @else
                                        وضع الصيانة
                                    @endif
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- System Information -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">معلومات النظام</h3>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <strong>إصدار Laravel:</strong>
                        <span class="badge bg-info">{{ app()->version() }}</span>
                    </div>
                    <div class="mb-3">
                        <strong>إصدار PHP:</strong>
                        <span class="badge bg-success">{{ phpversion() }}</span>
                    </div>
                    <div class="mb-3">
                        <strong>قاعدة البيانات:</strong>
                        <span class="badge bg-primary">{{ config('database.default') }}</span>
                    </div>
                    <div class="mb-3">
                        <strong>البيئة:</strong>
                        <span class="badge bg-{{ app()->environment() === 'production' ? 'danger' : 'warning' }}">
                            {{ app()->environment() }}
                        </span>
                    </div>
                    <div class="mb-3">
                        <strong>الذاكرة المستخدمة:</strong>
                        <span class="text-muted">{{ number_format(memory_get_usage(true) / 1024 / 1024, 2) }} MB</span>
                    </div>
                    <div class="mb-3">
                        <strong>وقت التشغيل:</strong>
                        <span class="text-muted">{{ number_format(microtime(true) - LARAVEL_START, 2) }} ثانية</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.nav-tabs .nav-link {
    border: none;
    border-bottom: 2px solid transparent;
    color: #6c757d;
    font-weight: 500;
    padding: 0.75rem 1rem;
}

.nav-tabs .nav-link.active {
    border-bottom-color: #10b981;
    color: #10b981;
    background: none;
}

.nav-tabs .nav-link:hover {
    border-bottom-color: #10b981;
    color: #10b981;
}

.form-control, .form-select {
    border-radius: 8px;
    border: 1px solid #d1d5db;
    padding: 0.5rem 0.75rem;
}

.form-control:focus, .form-select:focus {
    border-color: #10b981;
    box-shadow: 0 0 0 0.2rem rgba(16, 185, 129, 0.25);
}

.btn {
    border-radius: 8px;
    font-weight: 500;
}

.badge {
    font-size: 0.75rem;
    padding: 0.375rem 0.75rem;
}

.card {
    border: none;
    box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
}

.card-header {
    background-color: #f8f9fc;
    border-bottom: 1px solid #e3e6f0;
}

.tab-content {
    padding: 1.5rem 0;
}

.setting-group {
    background: #f8f9fa;
    border-radius: 8px;
    padding: 1.5rem;
    margin-bottom: 1.5rem;
}

.setting-group h5 {
    color: #5a5c69;
    font-weight: 600;
    margin-bottom: 1rem;
    padding-bottom: 0.5rem;
    border-bottom: 2px solid #e3e6f0;
}

.file-preview {
    max-width: 200px;
    max-height: 100px;
    border-radius: 8px;
    margin-top: 0.5rem;
}

.color-preview {
    width: 40px;
    height: 40px;
    border-radius: 8px;
    border: 2px solid #d1d5db;
    display: inline-block;
    margin-right: 0.5rem;
}
</style>
@endsection 