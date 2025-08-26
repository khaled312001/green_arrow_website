@extends('layouts.app')

@section('title', 'إنشاء حساب جديد - أكاديمية السهم الأخضر للتدريب')

@section('content')
<div style="min-height: 100vh; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, #10b981 0%, #059669 100%); padding: 20px;">
    <div class="card" style="width: 100%; max-width: 500px; border-radius: 20px; box-shadow: 0 20px 40px rgba(0,0,0,0.1);">
        <div class="card-body" style="padding: 40px;">
            <!-- Header -->
            <div style="text-align: center; margin-bottom: 30px;">
                <div style="width: 80px; height: 80px; background: #10b981; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; color: white; font-size: 2rem;">
                    <i class="bi bi-person-plus"></i>
                </div>
                <h1 style="font-size: 2rem; margin-bottom: 10px; color: #1f2937;">إنشاء حساب جديد</h1>
                <p style="color: #6b7280;">انضم إلى أكاديمية السهم الأخضر وابدأ رحلتك التعليمية</p>
            </div>
            
            <!-- Registration Form -->
            <form method="POST" action="{{ route('register') }}">
                @csrf
                
                <!-- Name -->
                <div style="margin-bottom: 20px;">
                    <label for="name" style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">الاسم الكامل *</label>
                    <input type="text" id="name" name="name" required 
                           value="{{ old('name') }}"
                           style="width: 100%; padding: 15px; border: 2px solid #e5e7eb; border-radius: 10px; font-size: 1rem; transition: border-color 0.3s ease;"
                           placeholder="أدخل اسمك الكامل">
                    @error('name')
                        <div style="color: #ef4444; font-size: 0.875rem; margin-top: 5px;">{{ $message }}</div>
                    @enderror
                </div>
                
                <!-- Email -->
                <div style="margin-bottom: 20px;">
                    <label for="email" style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">البريد الإلكتروني *</label>
                    <input type="email" id="email" name="email" required 
                           value="{{ old('email') }}"
                           style="width: 100%; padding: 15px; border: 2px solid #e5e7eb; border-radius: 10px; font-size: 1rem; transition: border-color 0.3s ease;"
                           placeholder="أدخل بريدك الإلكتروني">
                    @error('email')
                        <div style="color: #ef4444; font-size: 0.875rem; margin-top: 5px;">{{ $message }}</div>
                    @enderror
                </div>
                
                <!-- Phone -->
                <div style="margin-bottom: 20px;">
                    <label for="phone" style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">رقم الهاتف</label>
                    <input type="tel" id="phone" name="phone" 
                           value="{{ old('phone') }}"
                           style="width: 100%; padding: 15px; border: 2px solid #e5e7eb; border-radius: 10px; font-size: 1rem; transition: border-color 0.3s ease;"
                           placeholder="أدخل رقم هاتفك">
                    @error('phone')
                        <div style="color: #ef4444; font-size: 0.875rem; margin-top: 5px;">{{ $message }}</div>
                    @enderror
                </div>
                
                <!-- Role Selection -->
                <div style="margin-bottom: 20px;">
                    <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">نوع الحساب *</label>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                        <label style="display: flex; align-items: center; gap: 10px; padding: 15px; border: 2px solid #e5e7eb; border-radius: 10px; cursor: pointer; transition: all 0.3s ease;" id="student-role">
                            <input type="radio" name="role" value="student" {{ old('role') == 'student' ? 'checked' : '' }} style="width: 18px; height: 18px;">
                            <div style="text-align: center; flex: 1;">
                                <i class="bi bi-person" style="font-size: 1.5rem; color: #10b981; margin-bottom: 5px;"></i>
                                <div style="font-weight: 500; color: #1f2937;">طالب</div>
                                <div style="font-size: 0.8rem; color: #6b7280;">للتسجيل في الدورات</div>
                            </div>
                        </label>
                        <label style="display: flex; align-items: center; gap: 10px; padding: 15px; border: 2px solid #e5e7eb; border-radius: 10px; cursor: pointer; transition: all 0.3s ease;" id="instructor-role">
                            <input type="radio" name="role" value="teacher" {{ old('role') == 'teacher' ? 'checked' : '' }} style="width: 18px; height: 18px;">
                            <div style="text-align: center; flex: 1;">
                                <i class="bi bi-person-workspace" style="font-size: 1.5rem; color: #10b981; margin-bottom: 5px;"></i>
                                <div style="font-weight: 500; color: #1f2937;">مدرب</div>
                                <div style="font-size: 0.8rem; color: #6b7280;">لإنشاء الدورات</div>
                            </div>
                        </label>
                    </div>
                    @error('role')
                        <div style="color: #ef4444; font-size: 0.875rem; margin-top: 5px;">{{ $message }}</div>
                    @enderror
                </div>
                
                <!-- Password -->
                <div style="margin-bottom: 20px;">
                    <label for="password" style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">كلمة المرور *</label>
                    <div style="position: relative;">
                        <input type="password" id="password" name="password" required 
                               style="width: 100%; padding: 15px; border: 2px solid #e5e7eb; border-radius: 10px; font-size: 1rem; transition: border-color 0.3s ease;"
                               placeholder="أدخل كلمة المرور">
                        <button type="button" onclick="togglePassword('password')" 
                                style="position: absolute; left: 15px; top: 50%; transform: translateY(-50%); background: none; border: none; color: #6b7280; cursor: pointer;">
                            <i class="bi bi-eye" id="passwordToggle"></i>
                        </button>
                    </div>
                    @error('password')
                        <div style="color: #ef4444; font-size: 0.875rem; margin-top: 5px;">{{ $message }}</div>
                    @enderror
                </div>
                
                <!-- Confirm Password -->
                <div style="margin-bottom: 20px;">
                    <label for="password_confirmation" style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">تأكيد كلمة المرور *</label>
                    <div style="position: relative;">
                        <input type="password" id="password_confirmation" name="password_confirmation" required 
                               style="width: 100%; padding: 15px; border: 2px solid #e5e7eb; border-radius: 10px; font-size: 1rem; transition: border-color 0.3s ease;"
                               placeholder="أعد إدخال كلمة المرور">
                        <button type="button" onclick="togglePassword('password_confirmation')" 
                                style="position: absolute; left: 15px; top: 50%; transform: translateY(-50%); background: none; border: none; color: #6b7280; cursor: pointer;">
                            <i class="bi bi-eye" id="passwordConfirmationToggle"></i>
                        </button>
                    </div>
                </div>
                
                <!-- Terms and Conditions -->
                <div style="margin-bottom: 25px;">
                    <label style="display: flex; align-items: flex-start; gap: 10px; color: #6b7280; cursor: pointer;">
                        <input type="checkbox" name="terms" required style="width: 18px; height: 18px; margin-top: 2px;">
                        <span style="font-size: 0.9rem; line-height: 1.5;">
                            أوافق على <a href="{{ route('terms-of-service') }}" target="_blank" style="color: #10b981; text-decoration: none;">الشروط والأحكام</a> و <a href="{{ route('privacy-policy') }}" target="_blank" style="color: #10b981; text-decoration: none;">سياسة الخصوصية</a>
                        </span>
                    </label>
                    @error('terms')
                        <div style="color: #ef4444; font-size: 0.875rem; margin-top: 5px;">{{ $message }}</div>
                    @enderror
                </div>
                
                <!-- Register Button -->
                <button type="submit" class="btn btn-primary" style="width: 100%; padding: 15px; font-size: 1.1rem; margin-bottom: 20px;">
                    <i class="bi bi-person-plus"></i>
                    إنشاء الحساب
                </button>
            </form>
            
            <!-- Divider -->
            <div style="display: flex; align-items: center; margin: 30px 0;">
                <div style="flex: 1; height: 1px; background: #e5e7eb;"></div>
                <span style="padding: 0 15px; color: #6b7280; font-size: 0.9rem;">أو</span>
                <div style="flex: 1; height: 1px; background: #e5e7eb;"></div>
            </div>
            
            <!-- Social Registration -->
            <div style="display: flex; gap: 15px; margin-bottom: 30px;">
                <a href="{{ route('auth.google') }}" class="btn btn-outline" style="flex: 1; padding: 12px; border: 2px solid #e5e7eb; color: #374151; text-decoration: none; border-radius: 10px; display: flex; align-items: center; justify-content: center; gap: 8px; transition: all 0.3s ease;">
                    <i class="bi bi-google" style="color: #ea4335;"></i>
                    جوجل
                </a>
                <button class="btn btn-outline" style="flex: 1; padding: 12px; border: 2px solid #e5e7eb; color: #374151; background: none; border-radius: 10px; display: flex; align-items: center; justify-content: center; gap: 8px; transition: all 0.3s ease;">
                    <i class="bi bi-facebook" style="color: #1877f2;"></i>
                    فيسبوك
                </button>
            </div>
            
            <!-- Login Link -->
            <div style="text-align: center; color: #6b7280;">
                لديك حساب بالفعل؟ 
                <a href="{{ route('login') }}" style="color: #10b981; text-decoration: none; font-weight: 500;">
                    سجل دخولك
                </a>
            </div>
        </div>
    </div>
</div>

<script>
function togglePassword(fieldId) {
    const passwordInput = document.getElementById(fieldId);
    const toggleId = fieldId === 'password' ? 'passwordToggle' : 'passwordConfirmationToggle';
    const passwordToggle = document.getElementById(toggleId);
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        passwordToggle.className = 'bi bi-eye-slash';
    } else {
        passwordInput.type = 'password';
        passwordToggle.className = 'bi bi-eye';
    }
}

// Role selection effects
document.querySelectorAll('input[name="role"]').forEach(radio => {
    radio.addEventListener('change', function() {
        // Remove active class from all role labels
        document.querySelectorAll('label[id$="-role"]').forEach(label => {
            label.style.borderColor = '#e5e7eb';
            label.style.background = 'white';
        });
        
        // Add active class to selected role label
        const selectedLabel = document.getElementById(this.value + '-role');
        if (selectedLabel) {
            selectedLabel.style.borderColor = '#10b981';
            selectedLabel.style.background = '#f0fdf4';
        }
    });
});

// Initialize role selection
document.addEventListener('DOMContentLoaded', function() {
    const selectedRole = document.querySelector('input[name="role"]:checked');
    if (selectedRole) {
        selectedRole.dispatchEvent(new Event('change'));
    }
});

// Focus effects
document.querySelectorAll('input').forEach(input => {
    input.addEventListener('focus', function() {
        this.style.borderColor = '#10b981';
        this.style.boxShadow = '0 0 0 3px rgba(16, 185, 129, 0.1)';
    });
    
    input.addEventListener('blur', function() {
        this.style.borderColor = '#e5e7eb';
        this.style.boxShadow = 'none';
    });
});
</script>

<style>
.btn-outline:hover {
    background: #f8fafc;
    border-color: #10b981;
    color: #10b981;
}

@media (max-width: 480px) {
    .card-body {
        padding: 30px 20px !important;
    }
    
    .role-selection {
        grid-template-columns: 1fr !important;
    }
}
</style>
@endsection 