@extends('layouts.admin')

@section('title', 'تعديل المعلم')

@section('content')
<div class="edit-instructor">
    <div class="page-header">
        <div class="header-content">
            <h1>تعديل المعلم</h1>
            <p>تعديل معلومات المعلم: {{ $instructor->name }}</p>
        </div>
        <div class="header-actions">
            <a href="{{ route('admin.instructors') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i>
                العودة للقائمة
            </a>
        </div>
    </div>

    <div class="form-container">
        <form method="POST" action="{{ route('admin.instructors.update', $instructor) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row">
                <!-- Personal Information -->
                <div class="col-md-8">
                    <div class="form-section">
                        <h3>المعلومات الشخصية</h3>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="form-label">الاسم الكامل *</label>
                                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" 
                                           value="{{ old('name', $instructor->name) }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email" class="form-label">البريد الإلكتروني *</label>
                                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" 
                                           value="{{ old('email', $instructor->email) }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone" class="form-label">رقم الهاتف</label>
                                    <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" 
                                           value="{{ old('phone', $instructor->phone) }}">
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="status" class="form-label">الحالة *</label>
                                    <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                                        <option value="">اختر الحالة</option>
                                        <option value="active" {{ old('status', $instructor->status) == 'active' ? 'selected' : '' }}>نشط</option>
                                        <option value="inactive" {{ old('status', $instructor->status) == 'inactive' ? 'selected' : '' }}>غير نشط</option>
                                        <option value="suspended" {{ old('status', $instructor->status) == 'suspended' ? 'selected' : '' }}>معلق</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Professional Information -->
                    <div class="form-section">
                        <h3>المعلومات المهنية</h3>
                        
                        <div class="form-group">
                            <label for="specialization" class="form-label">التخصص *</label>
                            <input type="text" name="specialization" id="specialization" class="form-control @error('specialization') is-invalid @enderror" 
                                   value="{{ old('specialization', $instructor->specialization) }}" required>
                            @error('specialization')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="bio" class="form-label">السيرة الذاتية</label>
                            <textarea name="bio" id="bio" rows="4" class="form-control @error('bio') is-invalid @enderror">{{ old('bio', $instructor->bio) }}</textarea>
                            @error('bio')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="experience_years" class="form-label">سنوات الخبرة</label>
                                    <input type="number" name="experience_years" id="experience_years" class="form-control @error('experience_years') is-invalid @enderror" 
                                           value="{{ old('experience_years', $instructor->experience_years) }}" min="0">
                                    @error('experience_years')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="education" class="form-label">المؤهل العلمي</label>
                                    <input type="text" name="education" id="education" class="form-control @error('education') is-invalid @enderror" 
                                           value="{{ old('education', $instructor->education) }}">
                                    @error('education')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="certifications" class="form-label">الشهادات المهنية</label>
                            <textarea name="certifications" id="certifications" rows="3" class="form-control @error('certifications') is-invalid @enderror">{{ old('certifications', $instructor->certifications) }}</textarea>
                            @error('certifications')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Files Upload -->
                <div class="col-md-4">
                    <div class="form-section">
                        <h3>الملفات</h3>
                        
                        <div class="form-group">
                            <label for="avatar" class="form-label">الصورة الشخصية</label>
                            <input type="file" name="avatar" id="avatar" class="form-control @error('avatar') is-invalid @enderror" 
                                   accept="image/*">
                            <small class="form-text text-muted">الأبعاد المفضلة: 300x300 بكسل، الحد الأقصى: 2 ميجابايت</small>
                            @error('avatar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="cv" class="form-label">السيرة الذاتية (PDF)</label>
                            <input type="file" name="cv" id="cv" class="form-control @error('cv') is-invalid @enderror" 
                                   accept=".pdf,.doc,.docx">
                            <small class="form-text text-muted">الحد الأقصى: 2 ميجابايت</small>
                            @error('cv')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Current Files -->
                    <div class="form-section">
                        <h3>الملفات الحالية</h3>
                        
                        @if($instructor->avatar)
                        <div class="current-file">
                            <label class="form-label">الصورة الحالية:</label>
                            <div class="current-avatar">
                                <img src="{{ asset('storage/' . $instructor->avatar) }}" alt="Current Avatar">
                            </div>
                        </div>
                        @endif

                        @if($instructor->cv)
                        <div class="current-file">
                            <label class="form-label">السيرة الذاتية الحالية:</label>
                            <a href="{{ asset('storage/' . $instructor->cv) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-file-earmark-text"></i>
                                عرض الملف
                            </a>
                        </div>
                        @endif
                    </div>

                    <!-- Preview -->
                    <div class="form-section">
                        <h3>معاينة الصورة الجديدة</h3>
                        <div class="avatar-preview">
                            <div id="avatar-preview" class="preview-placeholder">
                                <i class="bi bi-person"></i>
                                <p>لم يتم اختيار صورة جديدة</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-circle"></i>
                    حفظ التغييرات
                </button>
                <a href="{{ route('admin.instructors') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-x-circle"></i>
                    إلغاء
                </a>
            </div>
        </form>
    </div>
</div>

<style>
.edit-instructor {
    padding: 20px;
    max-width: 1200px;
    margin: 0 auto;
}

.page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
    padding: 20px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border-radius: 15px;
}

.page-header h1 {
    margin: 0;
    font-size: 2rem;
    font-weight: 700;
}

.page-header p {
    margin: 5px 0 0 0;
    opacity: 0.9;
}

.form-container {
    background: white;
    border-radius: 15px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

.form-section {
    padding: 25px;
    border-bottom: 1px solid #f3f4f6;
}

.form-section:last-child {
    border-bottom: none;
}

.form-section h3 {
    margin: 0 0 20px 0;
    color: #1f2937;
    font-weight: 600;
    font-size: 1.2rem;
}

.form-group {
    margin-bottom: 20px;
}

.form-label {
    font-weight: 600;
    color: #374151;
    margin-bottom: 8px;
}

.form-control, .form-select {
    border-radius: 8px;
    border: 1px solid #d1d5db;
    padding: 12px 15px;
    font-size: 0.95rem;
}

.form-control:focus, .form-select:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
}

.current-file {
    margin-bottom: 20px;
}

.current-avatar {
    text-align: center;
    margin-top: 10px;
}

.current-avatar img {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid #667eea;
}

.avatar-preview {
    text-align: center;
}

.preview-placeholder {
    width: 150px;
    height: 150px;
    border: 2px dashed #d1d5db;
    border-radius: 50%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
    color: #9ca3af;
}

.preview-placeholder i {
    font-size: 2rem;
    margin-bottom: 10px;
}

.preview-placeholder p {
    margin: 0;
    font-size: 0.8rem;
}

.avatar-preview img {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid #667eea;
}

.form-actions {
    padding: 25px;
    background: #f8f9fa;
    border-top: 1px solid #e9ecef;
    display: flex;
    gap: 15px;
    justify-content: flex-end;
}

.form-actions .btn {
    padding: 12px 25px;
    font-weight: 600;
}

@media (max-width: 768px) {
    .page-header {
        flex-direction: column;
        text-align: center;
        gap: 15px;
    }
    
    .form-actions {
        flex-direction: column;
    }
    
    .form-actions .btn {
        width: 100%;
    }
}
</style>

<script>
// Avatar preview
document.getElementById('avatar').addEventListener('change', function(e) {
    const file = e.target.files[0];
    const preview = document.getElementById('avatar-preview');
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.innerHTML = `<img src="${e.target.result}" alt="Avatar Preview">`;
        };
        reader.readAsDataURL(file);
    } else {
        preview.innerHTML = `
            <i class="bi bi-person"></i>
            <p>لم يتم اختيار صورة جديدة</p>
        `;
    }
});
</script>
@endsection 