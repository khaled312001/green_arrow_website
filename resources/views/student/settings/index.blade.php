@extends('layouts.student')

@section('title', 'الإعدادات - لوحة الطالب')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header" style="margin-bottom: 30px;">
        <h1 style="font-size: 2rem; color: #1f2937; margin-bottom: 10px;">الإعدادات</h1>
        <p style="color: #6b7280;">إدارة إعدادات حسابك وتفضيلاتك</p>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card" style="background: white; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                <div class="card-body" style="padding: 30px;">
                    <!-- Settings Navigation -->
                    <div class="settings-nav" style="display: flex; gap: 10px; margin-bottom: 30px; border-bottom: 2px solid #e5e7eb; padding-bottom: 20px;">
                        <button class="nav-tab active" data-tab="profile" style="padding: 12px 20px; border: none; background: #10b981; color: white; border-radius: 10px; cursor: pointer; font-weight: 500;">
                            <i class="bi bi-person"></i>
                            الملف الشخصي
                        </button>
                        <button class="nav-tab" data-tab="notifications" style="padding: 12px 20px; border: none; background: #e5e7eb; color: #6b7280; border-radius: 10px; cursor: pointer; font-weight: 500;">
                            <i class="bi bi-bell"></i>
                            الإشعارات
                        </button>
                        <button class="nav-tab" data-tab="privacy" style="padding: 12px 20px; border: none; background: #e5e7eb; color: #6b7280; border-radius: 10px; cursor: pointer; font-weight: 500;">
                            <i class="bi bi-shield"></i>
                            الخصوصية
                        </button>
                        <button class="nav-tab" data-tab="security" style="padding: 12px 20px; border: none; background: #e5e7eb; color: #6b7280; border-radius: 10px; cursor: pointer; font-weight: 500;">
                            <i class="bi bi-lock"></i>
                            الأمان
                        </button>
                    </div>

                    <!-- Profile Settings -->
                    <div class="settings-content" id="profile-content">
                        <h3 style="font-size: 1.5rem; color: #1f2937; margin-bottom: 20px;">الملف الشخصي</h3>
                        
                        <form method="POST" action="{{ route('student.profile.update') }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div style="margin-bottom: 20px;">
                                        <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">الاسم الكامل</label>
                                        <input type="text" name="name" value="{{ $user->name }}" required
                                               style="width: 100%; padding: 12px; border: 2px solid #e5e7eb; border-radius: 10px; font-size: 1rem;">
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div style="margin-bottom: 20px;">
                                        <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">البريد الإلكتروني</label>
                                        <input type="email" name="email" value="{{ $user->email }}" required
                                               style="width: 100%; padding: 12px; border: 2px solid #e5e7eb; border-radius: 10px; font-size: 1rem;">
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div style="margin-bottom: 20px;">
                                        <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">رقم الهاتف</label>
                                        <input type="tel" name="phone" value="{{ $user->phone }}"
                                               style="width: 100%; padding: 12px; border: 2px solid #e5e7eb; border-radius: 10px; font-size: 1rem;">
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div style="margin-bottom: 20px;">
                                        <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">المدينة</label>
                                        <input type="text" name="city" value="{{ $user->city }}"
                                               style="width: 100%; padding: 12px; border: 2px solid #e5e7eb; border-radius: 10px; font-size: 1rem;">
                                    </div>
                                </div>
                                
                                <div class="col-12">
                                    <div style="margin-bottom: 20px;">
                                        <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">نبذة شخصية</label>
                                        <textarea name="bio" rows="4" style="width: 100%; padding: 12px; border: 2px solid #e5e7eb; border-radius: 10px; font-size: 1rem; resize: vertical;">{{ $user->bio }}</textarea>
                                    </div>
                                </div>
                            </div>
                            
                            <button type="submit" class="btn btn-primary" style="padding: 12px 24px; border-radius: 10px;">
                                <i class="bi bi-check-circle"></i>
                                حفظ التغييرات
                            </button>
                        </form>
                    </div>

                    <!-- Notifications Settings -->
                    <div class="settings-content" id="notifications-content" style="display: none;">
                        <h3 style="font-size: 1.5rem; color: #1f2937; margin-bottom: 20px;">إعدادات الإشعارات</h3>
                        
                        <form method="POST" action="{{ route('student.settings.update') }}">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="settings_type" value="notifications">
                            
                            <div class="settings-group" style="margin-bottom: 30px;">
                                <h4 style="font-size: 1.1rem; color: #374151; margin-bottom: 15px;">إشعارات البريد الإلكتروني</h4>
                                
                                <div style="margin-bottom: 15px;">
                                    <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                                        <input type="checkbox" name="notification_preferences[email]" value="1" 
                                               {{ $notificationPreferences['email'] ?? false ? 'checked' : '' }}
                                               style="width: 18px; height: 18px;">
                                        <span>تفعيل إشعارات البريد الإلكتروني</span>
                                    </label>
                                </div>
                                
                                <div style="margin-bottom: 15px;">
                                    <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                                        <input type="checkbox" name="notification_preferences[new_course]" value="1" 
                                               {{ $notificationPreferences['new_course'] ?? false ? 'checked' : '' }}
                                               style="width: 18px; height: 18px;">
                                        <span>إشعارات الدورات الجديدة</span>
                                    </label>
                                </div>
                                
                                <div style="margin-bottom: 15px;">
                                    <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                                        <input type="checkbox" name="notification_preferences[lesson_reminder]" value="1" 
                                               {{ $notificationPreferences['lesson_reminder'] ?? false ? 'checked' : '' }}
                                               style="width: 18px; height: 18px;">
                                        <span>تذكير بالدروس</span>
                                    </label>
                                </div>
                                
                                <div style="margin-bottom: 15px;">
                                    <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                                        <input type="checkbox" name="notification_preferences[quiz_reminder]" value="1" 
                                               {{ $notificationPreferences['quiz_reminder'] ?? false ? 'checked' : '' }}
                                               style="width: 18px; height: 18px;">
                                        <span>تذكير بالاختبارات</span>
                                    </label>
                                </div>
                            </div>
                            
                            <button type="submit" class="btn btn-primary" style="padding: 12px 24px; border-radius: 10px;">
                                <i class="bi bi-check-circle"></i>
                                حفظ الإعدادات
                            </button>
                        </form>
                    </div>

                    <!-- Privacy Settings -->
                    <div class="settings-content" id="privacy-content" style="display: none;">
                        <h3 style="font-size: 1.5rem; color: #1f2937; margin-bottom: 20px;">إعدادات الخصوصية</h3>
                        
                        <form method="POST" action="{{ route('student.settings.update') }}">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="settings_type" value="privacy">
                            
                            <div class="settings-group" style="margin-bottom: 30px;">
                                <h4 style="font-size: 1.1rem; color: #374151; margin-bottom: 15px;">إعدادات الملف الشخصي</h4>
                                
                                <div style="margin-bottom: 15px;">
                                    <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                                        <input type="checkbox" name="privacy_settings[profile_public]" value="1" 
                                               {{ $privacySettings['profile_public'] ?? false ? 'checked' : '' }}
                                               style="width: 18px; height: 18px;">
                                        <span>الملف الشخصي عام</span>
                                    </label>
                                </div>
                                
                                <div style="margin-bottom: 15px;">
                                    <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                                        <input type="checkbox" name="privacy_settings[show_progress]" value="1" 
                                               {{ $privacySettings['show_progress'] ?? false ? 'checked' : '' }}
                                               style="width: 18px; height: 18px;">
                                        <span>إظهار تقدمي للآخرين</span>
                                    </label>
                                </div>
                                
                                <div style="margin-bottom: 15px;">
                                    <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                                        <input type="checkbox" name="privacy_settings[show_certificates]" value="1" 
                                               {{ $privacySettings['show_certificates'] ?? false ? 'checked' : '' }}
                                               style="width: 18px; height: 18px;">
                                        <span>إظهار شهاداتي للآخرين</span>
                                    </label>
                                </div>
                            </div>
                            
                            <button type="submit" class="btn btn-primary" style="padding: 12px 24px; border-radius: 10px;">
                                <i class="bi bi-check-circle"></i>
                                حفظ الإعدادات
                            </button>
                        </form>
                    </div>

                    <!-- Security Settings -->
                    <div class="settings-content" id="security-content" style="display: none;">
                        <h3 style="font-size: 1.5rem; color: #1f2937; margin-bottom: 20px;">إعدادات الأمان</h3>
                        
                        <form method="POST" action="{{ route('student.settings.update') }}">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="settings_type" value="security">
                            
                            <div class="settings-group" style="margin-bottom: 30px;">
                                <h4 style="font-size: 1.1rem; color: #374151; margin-bottom: 15px;">تغيير كلمة المرور</h4>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div style="margin-bottom: 20px;">
                                            <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">كلمة المرور الحالية</label>
                                            <input type="password" name="current_password"
                                                   style="width: 100%; padding: 12px; border: 2px solid #e5e7eb; border-radius: 10px; font-size: 1rem;">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div style="margin-bottom: 20px;">
                                            <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">كلمة المرور الجديدة</label>
                                            <input type="password" name="new_password"
                                                   style="width: 100%; padding: 12px; border: 2px solid #e5e7eb; border-radius: 10px; font-size: 1rem;">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div style="margin-bottom: 20px;">
                                            <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">تأكيد كلمة المرور الجديدة</label>
                                            <input type="password" name="new_password_confirmation"
                                                   style="width: 100%; padding: 12px; border: 2px solid #e5e7eb; border-radius: 10px; font-size: 1rem;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="settings-group" style="margin-bottom: 30px;">
                                <h4 style="font-size: 1.1rem; color: #374151; margin-bottom: 15px;">إعدادات الأمان الإضافية</h4>
                                
                                <div style="margin-bottom: 15px;">
                                    <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                                        <input type="checkbox" name="security_settings[login_notifications]" value="1" 
                                               {{ $securitySettings['login_notifications'] ?? false ? 'checked' : '' }}
                                               style="width: 18px; height: 18px;">
                                        <span>إشعارات تسجيل الدخول</span>
                                    </label>
                                </div>
                                
                                <div style="margin-bottom: 15px;">
                                    <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                                        <input type="checkbox" name="security_settings[two_factor]" value="1" 
                                               {{ $securitySettings['two_factor'] ?? false ? 'checked' : '' }}
                                               style="width: 18px; height: 18px;">
                                        <span>المصادقة الثنائية (قريباً)</span>
                                    </label>
                                </div>
                            </div>
                            
                            <button type="submit" class="btn btn-primary" style="padding: 12px 24px; border-radius: 10px;">
                                <i class="bi bi-check-circle"></i>
                                حفظ الإعدادات
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.nav-tab {
    transition: all 0.3s ease;
}

.nav-tab:hover {
    transform: translateY(-2px);
}

.nav-tab.active {
    background: #10b981 !important;
    color: white !important;
}

.settings-content {
    animation: fadeIn 0.3s ease;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

.btn {
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
    font-weight: 500;
}

.btn:hover {
    background: linear-gradient(135deg, #059669, #047857);
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3);
}

@media (max-width: 768px) {
    .settings-nav {
        flex-direction: column;
    }
    
    .nav-tab {
        text-align: center;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const navTabs = document.querySelectorAll('.nav-tab');
    const settingsContents = document.querySelectorAll('.settings-content');
    
    navTabs.forEach(tab => {
        tab.addEventListener('click', function() {
            const targetTab = this.getAttribute('data-tab');
            
            // Update active tab
            navTabs.forEach(t => {
                t.classList.remove('active');
                t.style.background = '#e5e7eb';
                t.style.color = '#6b7280';
            });
            this.classList.add('active');
            this.style.background = '#10b981';
            this.style.color = 'white';
            
            // Show target content
            settingsContents.forEach(content => {
                content.style.display = 'none';
            });
            document.getElementById(targetTab + '-content').style.display = 'block';
        });
    });
});
</script>
@endsection 