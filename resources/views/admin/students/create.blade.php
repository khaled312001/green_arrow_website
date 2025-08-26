@extends('layouts.admin')

@section('title', 'إضافة طالب جديد - لوحة الإدارة')

@section('content')
<div class="content-area">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="card-title">إضافة طالب جديد</h2>
                <a href="{{ route('admin.students') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-right"></i>
                    العودة للطلاب
                </a>
            </div>
        </div>
        
        <div class="card-body">
            <form method="POST" action="{{ route('admin.students.store') }}" enctype="multipart/form-data" id="studentForm">
                @csrf
                
                <div class="row">
                    <!-- Personal Information -->
                    <div class="col-lg-8">
                        <div class="section-card">
                            <h5 class="section-title">
                                <i class="bi bi-person"></i>
                                المعلومات الشخصية
                            </h5>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">الاسم الكامل *</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                           id="name" name="name" value="{{ old('name') }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">البريد الإلكتروني *</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                           id="email" name="email" value="{{ old('email') }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label">رقم الهاتف</label>
                                    <input type="tel" class="form-control @error('phone') is-invalid @enderror" 
                                           id="phone" name="phone" value="{{ old('phone') }}">
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="date_of_birth" class="form-label">تاريخ الميلاد</label>
                                    <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror" 
                                           id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') }}">
                                    @error('date_of_birth')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="gender" class="form-label">الجنس</label>
                                    <select class="form-select @error('gender') is-invalid @enderror" 
                                            id="gender" name="gender">
                                        <option value="">اختر الجنس</option>
                                        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>ذكر</option>
                                        <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>أنثى</option>
                                    </select>
                                    @error('gender')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="nationality" class="form-label">الجنسية</label>
                                    <input type="text" class="form-control @error('nationality') is-invalid @enderror" 
                                           id="nationality" name="nationality" value="{{ old('nationality') }}">
                                    @error('nationality')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="bio" class="form-label">نبذة شخصية</label>
                                <textarea class="form-control @error('bio') is-invalid @enderror" 
                                          id="bio" name="bio" rows="3">{{ old('bio') }}</textarea>
                                @error('bio')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Account Information -->
                        <div class="section-card">
                            <h5 class="section-title">
                                <i class="bi bi-shield-lock"></i>
                                معلومات الحساب
                            </h5>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="password" class="form-label">كلمة المرور *</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                               id="password" name="password" required>
                                        <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password')">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="password_confirmation" class="form-label">تأكيد كلمة المرور *</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" 
                                               id="password_confirmation" name="password_confirmation" required>
                                        <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password_confirmation')">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="status" class="form-label">حالة الحساب *</label>
                                    <select class="form-select @error('status') is-invalid @enderror" 
                                            id="status" name="status" required>
                                        <option value="">اختر الحالة</option>
                                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>نشط</option>
                                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>غير نشط</option>
                                        <option value="suspended" {{ old('status') == 'suspended' ? 'selected' : '' }}>معلق</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="email_verified_at" class="form-label">تأكيد البريد الإلكتروني</label>
                                    <select class="form-select" id="email_verified_at" name="email_verified">
                                        <option value="0">غير مؤكد</option>
                                        <option value="1" {{ old('email_verified') == '1' ? 'selected' : '' }}>مؤكد</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Educational Information -->
                        <div class="section-card">
                            <h5 class="section-title">
                                <i class="bi bi-mortarboard"></i>
                                المعلومات التعليمية
                            </h5>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="education_level" class="form-label">المستوى التعليمي</label>
                                    <select class="form-select" id="education_level" name="education_level">
                                        <option value="">اختر المستوى</option>
                                        <option value="primary" {{ old('education_level') == 'primary' ? 'selected' : '' }}>ابتدائي</option>
                                        <option value="intermediate" {{ old('education_level') == 'intermediate' ? 'selected' : '' }}>متوسط</option>
                                        <option value="secondary" {{ old('education_level') == 'secondary' ? 'selected' : '' }}>ثانوي</option>
                                        <option value="bachelor" {{ old('education_level') == 'bachelor' ? 'selected' : '' }}>بكالوريوس</option>
                                        <option value="master" {{ old('education_level') == 'master' ? 'selected' : '' }}>ماجستير</option>
                                        <option value="phd" {{ old('education_level') == 'phd' ? 'selected' : '' }}>دكتوراه</option>
                                    </select>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="field_of_study" class="form-label">مجال الدراسة</label>
                                    <input type="text" class="form-control" id="field_of_study" name="field_of_study" 
                                           value="{{ old('field_of_study') }}" placeholder="مثال: علوم الحاسوب">
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="institution" class="form-label">المؤسسة التعليمية</label>
                                    <input type="text" class="form-control" id="institution" name="institution" 
                                           value="{{ old('institution') }}" placeholder="اسم الجامعة أو المدرسة">
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="graduation_year" class="form-label">سنة التخرج</label>
                                    <input type="number" class="form-control" id="graduation_year" name="graduation_year" 
                                           value="{{ old('graduation_year') }}" min="1950" max="{{ date('Y') + 10 }}">
                                </div>
                            </div>
                        </div>

                        <!-- Contact Information -->
                        <div class="section-card">
                            <h5 class="section-title">
                                <i class="bi bi-geo-alt"></i>
                                معلومات الاتصال
                            </h5>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="country" class="form-label">البلد</label>
                                    <input type="text" class="form-control" id="country" name="country" 
                                           value="{{ old('country') }}">
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="city" class="form-label">المدينة</label>
                                    <input type="text" class="form-control" id="city" name="city" 
                                           value="{{ old('city') }}">
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="address" class="form-label">العنوان</label>
                                <textarea class="form-control" id="address" name="address" rows="2">{{ old('address') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar -->
                    <div class="col-lg-4">
                        <!-- Profile Picture -->
                        <div class="section-card">
                            <h5 class="section-title">
                                <i class="bi bi-camera"></i>
                                الصورة الشخصية
                            </h5>
                            
                            <div class="text-center mb-3">
                                <div class="avatar-upload">
                                    <img id="avatar-preview" src="{{ asset('images/default-avatar.png') }}" 
                                         alt="معاينة الصورة" class="avatar-preview-img">
                                    <div class="avatar-upload-overlay">
                                        <i class="bi bi-camera"></i>
                                        <span>تغيير الصورة</span>
                                    </div>
                                </div>
                                <input type="file" id="avatar" name="avatar" accept="image/*" style="display: none;">
                            </div>
                            
                            <div class="form-text text-center">
                                الأبعاد الموصى بها: 300×300 بكسل<br>
                                الحد الأقصى: 2 ميجابايت
                            </div>
                        </div>

                        <!-- Preferences -->
                        <div class="section-card">
                            <h5 class="section-title">
                                <i class="bi bi-gear"></i>
                                التفضيلات
                            </h5>
                            
                            <div class="mb-3">
                                <label for="language" class="form-label">اللغة المفضلة</label>
                                <select class="form-select" id="language" name="language">
                                    <option value="ar" {{ old('language') == 'ar' ? 'selected' : '' }}>العربية</option>
                                    <option value="en" {{ old('language') == 'en' ? 'selected' : '' }}>الإنجليزية</option>
                                </select>
                            </div>
                            
                            <div class="mb-3">
                                <label for="timezone" class="form-label">المنطقة الزمنية</label>
                                <select class="form-select" id="timezone" name="timezone">
                                    <option value="Asia/Riyadh" {{ old('timezone') == 'Asia/Riyadh' ? 'selected' : '' }}>الرياض (GMT+3)</option>
                                    <option value="Asia/Dubai" {{ old('timezone') == 'Asia/Dubai' ? 'selected' : '' }}>دبي (GMT+4)</option>
                                    <option value="Europe/London" {{ old('timezone') == 'Europe/London' ? 'selected' : '' }}>لندن (GMT+0)</option>
                                    <option value="America/New_York" {{ old('timezone') == 'America/New_York' ? 'selected' : '' }}>نيويورك (GMT-5)</option>
                                </select>
                            </div>
                            
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" id="email_notifications" 
                                       name="email_notifications" value="1" {{ old('email_notifications') ? 'checked' : '' }}>
                                <label class="form-check-label" for="email_notifications">
                                    إشعارات البريد الإلكتروني
                                </label>
                            </div>
                            
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" id="sms_notifications" 
                                       name="sms_notifications" value="1" {{ old('sms_notifications') ? 'checked' : '' }}>
                                <label class="form-check-label" for="sms_notifications">
                                    إشعارات الرسائل النصية
                                </label>
                            </div>
                            
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="marketing_emails" 
                                       name="marketing_emails" value="1" {{ old('marketing_emails') ? 'checked' : '' }}>
                                <label class="form-check-label" for="marketing_emails">
                                    رسائل تسويقية
                                </label>
                            </div>
                        </div>

                        <!-- Quick Actions -->
                        <div class="section-card">
                            <h5 class="section-title">
                                <i class="bi bi-lightning"></i>
                                إجراءات سريعة
                            </h5>
                            
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-check-lg"></i>
                                    حفظ الطالب
                                </button>
                                <button type="button" class="btn btn-outline-secondary" onclick="resetForm()">
                                    <i class="bi bi-arrow-clockwise"></i>
                                    إعادة تعيين
                                </button>
                                <a href="{{ route('admin.students') }}" class="btn btn-outline-danger">
                                    <i class="bi bi-x-lg"></i>
                                    إلغاء
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Avatar upload functionality
document.querySelector('.avatar-upload').addEventListener('click', function() {
    document.getElementById('avatar').click();
});

document.getElementById('avatar').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('avatar-preview').src = e.target.result;
        }
        reader.readAsDataURL(file);
    }
});

// Password toggle functionality
function togglePassword(fieldId) {
    const field = document.getElementById(fieldId);
    const button = field.nextElementSibling;
    const icon = button.querySelector('i');
    
    if (field.type === 'password') {
        field.type = 'text';
        icon.classList.remove('bi-eye');
        icon.classList.add('bi-eye-slash');
    } else {
        field.type = 'password';
        icon.classList.remove('bi-eye-slash');
        icon.classList.add('bi-eye');
    }
}

// Form reset functionality
function resetForm() {
    if (confirm('هل أنت متأكد من إعادة تعيين النموذج؟')) {
        document.getElementById('studentForm').reset();
        document.getElementById('avatar-preview').src = '{{ asset("images/default-avatar.png") }}';
    }
}

// Form validation
document.getElementById('studentForm').addEventListener('submit', function(e) {
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('password_confirmation').value;
    
    if (password !== confirmPassword) {
        e.preventDefault();
        alert('كلمات المرور غير متطابقة');
        return false;
    }
    
    if (password.length < 8) {
        e.preventDefault();
        alert('كلمة المرور يجب أن تكون 8 أحرف على الأقل');
        return false;
    }
});
</script>

<style>
.section-card {
    background: white;
    border: 1px solid #e5e7eb;
    border-radius: 10px;
    padding: 25px;
    margin-bottom: 25px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
}

.section-title {
    color: #374151;
    font-weight: 600;
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 2px solid #f3f4f6;
    display: flex;
    align-items: center;
    gap: 10px;
}

.section-title i {
    color: #10b981;
}

.avatar-upload {
    position: relative;
    width: 150px;
    height: 150px;
    margin: 0 auto;
    border-radius: 50%;
    overflow: hidden;
    cursor: pointer;
    border: 3px solid #e5e7eb;
    transition: all 0.3s ease;
}

.avatar-upload:hover {
    border-color: #10b981;
}

.avatar-preview-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.avatar-upload-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.7);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    color: white;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.avatar-upload:hover .avatar-upload-overlay {
    opacity: 1;
}

.avatar-upload-overlay i {
    font-size: 1.5rem;
    margin-bottom: 5px;
}

.avatar-upload-overlay span {
    font-size: 0.8rem;
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

.form-check-input:checked {
    background-color: #10b981;
    border-color: #10b981;
}

@media (max-width: 768px) {
    .section-card {
        padding: 20px;
        margin-bottom: 20px;
    }
    
    .avatar-upload {
        width: 120px;
        height: 120px;
    }
}
</style>
@endsection 