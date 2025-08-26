@extends('layouts.teacher')

@section('title', 'الإعدادات')

@section('content')
<style>
    .settings-container {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        padding: 2rem 0;
    }
    
    .settings-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        overflow: hidden;
        transition: all 0.3s ease;
    }
    
    .settings-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 30px 60px rgba(0, 0, 0, 0.15);
    }
    
    .settings-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 2rem;
        text-align: center;
        color: white;
        position: relative;
        overflow: hidden;
    }
    
    .settings-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/><circle cx="50" cy="10" r="0.5" fill="white" opacity="0.1"/><circle cx="10" cy="60" r="0.5" fill="white" opacity="0.1"/><circle cx="90" cy="40" r="0.5" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
        opacity: 0.3;
    }
    
    .settings-title {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        position: relative;
        z-index: 2;
    }
    
    .settings-subtitle {
        font-size: 1.1rem;
        opacity: 0.9;
        position: relative;
        z-index: 2;
    }
    
    .nav-tabs-custom {
        border: none;
        background: transparent;
        padding: 0 2rem;
        margin-top: -1rem;
        position: relative;
        z-index: 10;
    }
    
    .nav-tabs-custom .nav-link {
        border: none;
        background: rgba(255, 255, 255, 0.1);
        color: #667eea;
        border-radius: 15px 15px 0 0;
        padding: 1rem 1.5rem;
        margin: 0 0.5rem;
        font-weight: 600;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
    
    .nav-tabs-custom .nav-link:hover {
        background: rgba(255, 255, 255, 0.2);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
    
    .nav-tabs-custom .nav-link.active {
        background: white;
        color: #667eea;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        transform: translateY(-2px);
    }
    
    .tab-content {
        background: white;
        border-radius: 0 0 20px 20px;
        padding: 2rem;
    }
    
    .tab-pane {
        animation: fadeInUp 0.5s ease;
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .section-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid #e2e8f0;
    }
    
    .section-title i {
        color: #667eea;
        font-size: 1.3rem;
    }
    
    .form-group {
        margin-bottom: 1.5rem;
    }
    
    .form-label {
        font-weight: 600;
        color: #4a5568;
        margin-bottom: 0.5rem;
        display: block;
    }
    
    .form-control {
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        padding: 0.75rem 1rem;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: #f7fafc;
    }
    
    .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        background: white;
        outline: none;
    }
    
    .form-control.is-invalid {
        border-color: #e53e3e;
        box-shadow: 0 0 0 3px rgba(229, 62, 62, 0.1);
    }
    
    .form-check {
        margin-bottom: 1rem;
        padding: 1rem;
        border-radius: 10px;
        background: #f7fafc;
        border: 1px solid #e2e8f0;
        transition: all 0.3s ease;
    }
    
    .form-check:hover {
        background: white;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        transform: translateX(5px);
    }
    
    .form-check-input {
        width: 1.2rem;
        height: 1.2rem;
        margin-left: 0.5rem;
        border: 2px solid #cbd5e0;
        border-radius: 6px;
        transition: all 0.3s ease;
    }
    
    .form-check-input:checked {
        background-color: #667eea;
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.2);
    }
    
    .form-check-input:focus {
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.2);
    }
    
    .form-check-label {
        font-weight: 500;
        color: #2d3748;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .form-check-label i {
        color: #667eea;
        font-size: 1.1rem;
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        padding: 0.75rem 2rem;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .btn-primary::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s ease;
    }
    
    .btn-primary:hover::before {
        left: 100%;
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
    }
    
    .alert {
        border-radius: 10px;
        border: none;
        padding: 1rem 1.5rem;
        margin-bottom: 1.5rem;
    }
    
    .alert-success {
        background: linear-gradient(135deg, #c6f6d5 0%, #9ae6b4 100%);
        color: #22543d;
    }
    
    .alert-danger {
        background: linear-gradient(135deg, #fed7d7 0%, #feb2b2 100%);
        color: #742a2a;
    }
    
    .settings-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
        margin-top: 2rem;
    }
    
    .settings-section {
        background: #f7fafc;
        padding: 1.5rem;
        border-radius: 15px;
        border: 1px solid #e2e8f0;
        transition: all 0.3s ease;
    }
    
    .settings-section:hover {
        background: white;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        transform: translateY(-2px);
    }
    
    .settings-section h6 {
        color: #667eea;
        font-weight: 600;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .avatar-preview {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #667eea;
        margin: 1rem 0;
    }
    
    .avatar-placeholder {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        color: white;
        font-weight: bold;
        border: 3px solid #667eea;
        margin: 1rem 0;
    }
    
    @media (max-width: 768px) {
        .settings-container {
            padding: 1rem 0;
        }
        
        .settings-header {
            padding: 1.5rem 1rem;
        }
        
        .settings-title {
            font-size: 1.5rem;
        }
        
        .nav-tabs-custom {
            padding: 0 1rem;
        }
        
        .nav-tabs-custom .nav-link {
            padding: 0.75rem 1rem;
            margin: 0 0.25rem;
            font-size: 0.9rem;
        }
        
        .tab-content {
            padding: 1.5rem;
        }
        
        .settings-grid {
            grid-template-columns: 1fr;
            gap: 1rem;
        }
    }
</style>

<div class="settings-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="settings-card">
                    <!-- Settings Header -->
                    <div class="settings-header">
                        <h1 class="settings-title">الإعدادات</h1>
                        <p class="settings-subtitle">إدارة ملفك الشخصي وإعدادات الحساب</p>
                    </div>
                    
                    <!-- Navigation Tabs -->
                    <ul class="nav nav-tabs nav-tabs-custom" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#profile" role="tab">
                                <i class="bi bi-person-gear"></i>
                                <span class="d-none d-sm-inline">الملف الشخصي</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#notifications" role="tab">
                                <i class="bi bi-bell"></i>
                                <span class="d-none d-sm-inline">الإشعارات</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#privacy" role="tab">
                                <i class="bi bi-shield-check"></i>
                                <span class="d-none d-sm-inline">الخصوصية</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#security" role="tab">
                                <i class="bi bi-lock"></i>
                                <span class="d-none d-sm-inline">الأمان</span>
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        @if(session('success'))
                            <div class="alert alert-success">
                                <i class="bi bi-check-circle"></i>
                                {{ session('success') }}
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-danger">
                                <i class="bi bi-exclamation-triangle"></i>
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Profile Tab -->
                        <div class="tab-pane active" id="profile" role="tabpanel">
                            <h2 class="section-title">
                                <i class="bi bi-person-circle"></i>
                                الملف الشخصي
                            </h2>
                            
                            <form action="{{ route('teacher.profile.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                
                                <div class="settings-grid">
                                    <div class="settings-section">
                                        <h6><i class="bi bi-person"></i> المعلومات الأساسية</h6>
                                        
                                        <div class="form-group">
                                            <label for="name" class="form-label">الاسم الكامل</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                                   id="name" name="name" value="{{ old('name', $teacher->name) }}" required>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="email" class="form-label">البريد الإلكتروني</label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                                   id="email" name="email" value="{{ old('email', $teacher->email) }}" required>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="phone" class="form-label">رقم الهاتف</label>
                                            <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                                                   id="phone" name="phone" value="{{ old('phone', $teacher->phone) }}">
                                            @error('phone')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="settings-section">
                                        <h6><i class="bi bi-image"></i> الصورة الشخصية</h6>
                                        
                                        <div class="text-center">
                                            @if($teacher->avatar)
                                                <img src="{{ asset('storage/' . $teacher->avatar) }}" 
                                                     alt="{{ $teacher->name }}" 
                                                     class="avatar-preview" id="avatarPreview">
                                            @else
                                                <div class="avatar-placeholder" id="avatarPlaceholder">
                                                    {{ strtoupper(substr($teacher->name, 0, 1)) }}
                                                </div>
                                            @endif
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="avatar" class="form-label">تغيير الصورة</label>
                                            <input type="file" class="form-control @error('avatar') is-invalid @enderror" 
                                                   id="avatar" name="avatar" accept="image/*">
                                            <small class="form-text text-muted">الحد الأقصى: 2 ميجابايت. الأنواع المدعومة: JPG, PNG, GIF</small>
                                            @error('avatar')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="bio" class="form-label">نبذة شخصية</label>
                                    <textarea class="form-control @error('bio') is-invalid @enderror" 
                                              id="bio" name="bio" rows="4" placeholder="اكتب نبذة مختصرة عن نفسك وخبراتك...">{{ old('bio', $teacher->bio) }}</textarea>
                                    @error('bio')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-check-lg"></i>
                                        حفظ التغييرات
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Notifications Tab -->
                        <div class="tab-pane" id="notifications" role="tabpanel">
                            <h2 class="section-title">
                                <i class="bi bi-bell"></i>
                                إعدادات الإشعارات
                            </h2>
                            
                            <form action="{{ route('teacher.settings.update') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="settings_type" value="notifications">
                                
                                <div class="settings-grid">
                                    <div class="settings-section">
                                        <h6><i class="bi bi-envelope"></i> طرق الإشعارات</h6>
                                        
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="email_notifications" 
                                                   name="notification_preferences[email]" value="1" 
                                                   {{ old('notification_preferences.email', true) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="email_notifications">
                                                <i class="bi bi-envelope"></i>
                                                إشعارات البريد الإلكتروني
                                            </label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="sms_notifications" 
                                                   name="notification_preferences[sms]" value="1"
                                                   {{ old('notification_preferences.sms', false) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="sms_notifications">
                                                <i class="bi bi-phone"></i>
                                                إشعارات الرسائل النصية
                                            </label>
                                        </div>
                                    </div>
                                    
                                    <div class="settings-section">
                                        <h6><i class="bi bi-bell"></i> أنواع الإشعارات</h6>
                                        
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="new_enrollment" 
                                                   name="notification_preferences[new_enrollment]" value="1"
                                                   {{ old('notification_preferences.new_enrollment', true) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="new_enrollment">
                                                <i class="bi bi-person-plus"></i>
                                                تسجيل طالب جديد
                                            </label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="course_completion" 
                                                   name="notification_preferences[course_completion]" value="1"
                                                   {{ old('notification_preferences.course_completion', true) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="course_completion">
                                                <i class="bi bi-check-circle"></i>
                                                إكمال الطالب للدورة
                                            </label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="payment_received" 
                                                   name="notification_preferences[payment_received]" value="1"
                                                   {{ old('notification_preferences.payment_received', true) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="payment_received">
                                                <i class="bi bi-credit-card"></i>
                                                استلام دفعة جديدة
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-check-lg"></i>
                                        حفظ الإعدادات
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Privacy Tab -->
                        <div class="tab-pane" id="privacy" role="tabpanel">
                            <h2 class="section-title">
                                <i class="bi bi-shield-check"></i>
                                إعدادات الخصوصية
                            </h2>
                            
                            <form action="{{ route('teacher.settings.update') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="settings_type" value="privacy">
                                
                                <div class="settings-grid">
                                    <div class="settings-section">
                                        <h6><i class="bi bi-eye"></i> إعدادات العرض</h6>
                                        
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="profile_public" 
                                                   name="privacy_settings[profile_public]" value="1"
                                                   {{ old('privacy_settings.profile_public', true) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="profile_public">
                                                <i class="bi bi-globe"></i>
                                                الملف الشخصي عام
                                            </label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="show_courses" 
                                                   name="privacy_settings[show_courses]" value="1"
                                                   {{ old('privacy_settings.show_courses', true) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="show_courses">
                                                <i class="bi bi-book"></i>
                                                إظهار الدورات في الملف الشخصي
                                            </label>
                                        </div>
                                    </div>
                                    
                                    <div class="settings-section">
                                        <h6><i class="bi bi-person"></i> معلومات التواصل</h6>
                                        
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="show_email" 
                                                   name="privacy_settings[show_email]" value="1"
                                                   {{ old('privacy_settings.show_email', false) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="show_email">
                                                <i class="bi bi-envelope"></i>
                                                إظهار البريد الإلكتروني للطلاب
                                            </label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="show_phone" 
                                                   name="privacy_settings[show_phone]" value="1"
                                                   {{ old('privacy_settings.show_phone', false) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="show_phone">
                                                <i class="bi bi-phone"></i>
                                                إظهار رقم الهاتف للطلاب
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-check-lg"></i>
                                        حفظ الإعدادات
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Security Tab -->
                        <div class="tab-pane" id="security" role="tabpanel">
                            <h2 class="section-title">
                                <i class="bi bi-lock"></i>
                                إعدادات الأمان
                            </h2>
                            
                            <form action="{{ route('teacher.settings.update') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="settings_type" value="security">
                                
                                <div class="settings-grid">
                                    <div class="settings-section">
                                        <h6><i class="bi bi-key"></i> تغيير كلمة المرور</h6>
                                        
                                        <div class="form-group">
                                            <label for="current_password" class="form-label">كلمة المرور الحالية</label>
                                            <input type="password" class="form-control" id="current_password" name="current_password">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="new_password" class="form-label">كلمة المرور الجديدة</label>
                                            <input type="password" class="form-control" id="new_password" name="new_password">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="new_password_confirmation" class="form-label">تأكيد كلمة المرور الجديدة</label>
                                            <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation">
                                        </div>
                                    </div>
                                    
                                    <div class="settings-section">
                                        <h6><i class="bi bi-shield-lock"></i> إعدادات الأمان الإضافية</h6>
                                        
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="two_factor" 
                                                   name="security_settings[two_factor]" value="1"
                                                   {{ old('security_settings.two_factor', false) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="two_factor">
                                                <i class="bi bi-phone"></i>
                                                المصادقة الثنائية
                                            </label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="login_notifications" 
                                                   name="security_settings[login_notifications]" value="1"
                                                   {{ old('security_settings.login_notifications', true) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="login_notifications">
                                                <i class="bi bi-bell"></i>
                                                إشعارات تسجيل الدخول
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-end">
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
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Avatar preview functionality
    const avatarInput = document.getElementById('avatar');
    const avatarPreview = document.getElementById('avatarPreview');
    const avatarPlaceholder = document.getElementById('avatarPlaceholder');
    
    if (avatarInput) {
        avatarInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    if (avatarPreview) {
                        avatarPreview.src = e.target.result;
                    } else if (avatarPlaceholder) {
                        avatarPlaceholder.style.display = 'none';
                        const newImg = document.createElement('img');
                        newImg.src = e.target.result;
                        newImg.className = 'avatar-preview';
                        newImg.id = 'avatarPreview';
                        avatarPlaceholder.parentNode.appendChild(newImg);
                    }
                };
                reader.readAsDataURL(file);
            }
        });
    }
    
    // Tab animation
    const tabLinks = document.querySelectorAll('.nav-tabs-custom .nav-link');
    tabLinks.forEach(link => {
        link.addEventListener('click', function() {
            // Remove active class from all tabs
            tabLinks.forEach(l => l.classList.remove('active'));
            // Add active class to clicked tab
            this.classList.add('active');
        });
    });
    
    // Form validation enhancement
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const requiredFields = form.querySelectorAll('[required]');
            let isValid = true;
            
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    field.classList.add('is-invalid');
                    isValid = false;
                } else {
                    field.classList.remove('is-invalid');
                }
            });
            
            if (!isValid) {
                e.preventDefault();
                // Show error message
                const alert = document.createElement('div');
                alert.className = 'alert alert-danger';
                alert.innerHTML = '<i class="bi bi-exclamation-triangle"></i> يرجى ملء جميع الحقول المطلوبة';
                form.insertBefore(alert, form.firstChild);
                
                setTimeout(() => {
                    alert.remove();
                }, 5000);
            }
        });
    });
    
    // Smooth animations for settings sections
    const settingsSections = document.querySelectorAll('.settings-section');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
                setTimeout(() => {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }, index * 100);
            }
        });
    }, { threshold: 0.1 });
    
    settingsSections.forEach(section => {
        section.style.opacity = '0';
        section.style.transform = 'translateY(20px)';
        section.style.transition = 'all 0.6s ease';
        observer.observe(section);
    });
});
</script>
@endsection 