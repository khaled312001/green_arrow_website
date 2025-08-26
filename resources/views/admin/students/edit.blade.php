@extends('layouts.admin')

@section('title', 'تعديل الطالب')

@section('content')
<div class="student-edit">
    <div class="page-header">
        <div class="header-content">
            <h1>تعديل الطالب</h1>
            <p>تعديل معلومات الطالب: {{ $student->name }}</p>
        </div>
        <div class="header-actions">
            <a href="{{ route('admin.students.show', $student) }}" class="btn btn-outline-secondary">
                <i class="bi bi-eye"></i>
                عرض التفاصيل
            </a>
            <a href="{{ route('admin.students') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i>
                العودة للقائمة
            </a>
        </div>
    </div>

    <div class="edit-container">
        <div class="row">
            <div class="col-md-8">
                <div class="edit-card">
                    <div class="card-header">
                        <h3>معلومات الطالب</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.students.update', $student) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">الاسم الكامل *</label>
                                        <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" 
                                               value="{{ old('name', $student->name) }}" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">البريد الإلكتروني *</label>
                                        <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                                               value="{{ old('email', $student->email) }}" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone">رقم الهاتف</label>
                                        <input type="text" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror" 
                                               value="{{ old('phone', $student->phone) }}">
                                        @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status">الحالة *</label>
                                        <select id="status" name="status" class="form-select @error('status') is-invalid @enderror" required>
                                            <option value="active" {{ old('status', $student->status) == 'active' ? 'selected' : '' }}>نشط</option>
                                            <option value="inactive" {{ old('status', $student->status) == 'inactive' ? 'selected' : '' }}>غير نشط</option>
                                            <option value="suspended" {{ old('status', $student->status) == 'suspended' ? 'selected' : '' }}>معلق</option>
                                        </select>
                                        @error('status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="city">المدينة</label>
                                        <input type="text" id="city" name="city" class="form-control @error('city') is-invalid @enderror" 
                                               value="{{ old('city', $student->city) }}">
                                        @error('city')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="country">البلد</label>
                                        <select id="country" name="country" class="form-select @error('country') is-invalid @enderror">
                                            <option value="">اختر البلد</option>
                                            <option value="Saudi Arabia" {{ old('country', $student->country) == 'Saudi Arabia' ? 'selected' : '' }}>المملكة العربية السعودية</option>
                                            <option value="UAE" {{ old('country', $student->country) == 'UAE' ? 'selected' : '' }}>الإمارات العربية المتحدة</option>
                                            <option value="Kuwait" {{ old('country', $student->country) == 'Kuwait' ? 'selected' : '' }}>الكويت</option>
                                            <option value="Qatar" {{ old('country', $student->country) == 'Qatar' ? 'selected' : '' }}>قطر</option>
                                            <option value="Bahrain" {{ old('country', $student->country) == 'Bahrain' ? 'selected' : '' }}>البحرين</option>
                                            <option value="Oman" {{ old('country', $student->country) == 'Oman' ? 'selected' : '' }}>عمان</option>
                                            <option value="Egypt" {{ old('country', $student->country) == 'Egypt' ? 'selected' : '' }}>مصر</option>
                                            <option value="Jordan" {{ old('country', $student->country) == 'Jordan' ? 'selected' : '' }}>الأردن</option>
                                            <option value="Lebanon" {{ old('country', $student->country) == 'Lebanon' ? 'selected' : '' }}>لبنان</option>
                                            <option value="Iraq" {{ old('country', $student->country) == 'Iraq' ? 'selected' : '' }}>العراق</option>
                                            <option value="Other" {{ old('country', $student->country) == 'Other' ? 'selected' : '' }}>أخرى</option>
                                        </select>
                                        @error('country')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="gender">الجنس</label>
                                        <select id="gender" name="gender" class="form-select @error('gender') is-invalid @enderror">
                                            <option value="">اختر الجنس</option>
                                            <option value="male" {{ old('gender', $student->gender) == 'male' ? 'selected' : '' }}>ذكر</option>
                                            <option value="female" {{ old('gender', $student->gender) == 'female' ? 'selected' : '' }}>أنثى</option>
                                        </select>
                                        @error('gender')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="birth_date">تاريخ الميلاد</label>
                                        <input type="date" id="birth_date" name="birth_date" class="form-control @error('birth_date') is-invalid @enderror" 
                                               value="{{ old('birth_date', $student->birth_date ? $student->birth_date->format('Y-m-d') : '') }}">
                                        @error('birth_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="bio">نبذة شخصية</label>
                                <textarea id="bio" name="bio" class="form-control @error('bio') is-invalid @enderror" rows="4">{{ old('bio', $student->bio) }}</textarea>
                                @error('bio')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="avatar">الصورة الشخصية</label>
                                <input type="file" id="avatar" name="avatar" class="form-control @error('avatar') is-invalid @enderror" 
                                       accept="image/*">
                                <small class="form-text text-muted">يُسمح بملفات الصور فقط (JPG, PNG, GIF) بحد أقصى 2 ميجابايت</small>
                                @error('avatar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-check-circle"></i>
                                    حفظ التغييرات
                                </button>
                                <a href="{{ route('admin.students.show', $student) }}" class="btn btn-outline-secondary">
                                    <i class="bi bi-x-circle"></i>
                                    إلغاء
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="info-card">
                    <div class="card-header">
                        <h3>معلومات سريعة</h3>
                    </div>
                    <div class="card-body">
                        <div class="info-item">
                            <strong>تاريخ التسجيل:</strong>
                            <span>{{ $student->created_at->format('Y-m-d') }}</span>
                        </div>
                        <div class="info-item">
                            <strong>آخر تحديث:</strong>
                            <span>{{ $student->updated_at->format('Y-m-d') }}</span>
                        </div>
                        <div class="info-item">
                            <strong>البريد الإلكتروني مؤكد:</strong>
                            <span>{{ $student->email_verified_at ? 'نعم' : 'لا' }}</span>
                        </div>
                        <div class="info-item">
                            <strong>إجمالي التسجيلات:</strong>
                            <span>{{ $student->enrollments->count() }}</span>
                        </div>
                        <div class="info-item">
                            <strong>الدورات المكتملة:</strong>
                            <span>{{ $student->enrollments->where('status', 'completed')->count() }}</span>
                        </div>
                    </div>
                </div>

                @if($student->avatar)
                <div class="info-card">
                    <div class="card-header">
                        <h3>الصورة الحالية</h3>
                    </div>
                    <div class="card-body text-center">
                        <img src="{{ asset('storage/' . $student->avatar) }}" alt="{{ $student->name }}" 
                             class="current-avatar">
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
.student-edit {
    padding: 20px;
    max-width: 1400px;
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

.header-actions {
    display: flex;
    gap: 10px;
}

.edit-card, .info-card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
    overflow: hidden;
}

.card-header {
    background: #f8f9fa;
    padding: 20px;
    border-bottom: 1px solid #e9ecef;
}

.card-header h3 {
    margin: 0;
    color: #495057;
    font-weight: 600;
}

.card-body {
    padding: 20px;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    color: #495057;
    font-weight: 500;
}

.form-control, .form-select {
    border: 1px solid #ced4da;
    border-radius: 8px;
    padding: 12px 15px;
    font-size: 14px;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.form-control:focus, .form-select:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
}

.form-control.is-invalid, .form-select.is-invalid {
    border-color: #dc3545;
}

.invalid-feedback {
    display: block;
    width: 100%;
    margin-top: 5px;
    font-size: 12px;
    color: #dc3545;
}

.form-text {
    font-size: 12px;
    color: #6c757d;
    margin-top: 5px;
}

.form-actions {
    display: flex;
    gap: 10px;
    margin-top: 30px;
    padding-top: 20px;
    border-top: 1px solid #e9ecef;
}

.info-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 0;
    border-bottom: 1px solid #f8f9fa;
}

.info-item:last-child {
    border-bottom: none;
}

.info-item strong {
    color: #495057;
    font-weight: 600;
}

.info-item span {
    color: #6c757d;
}

.current-avatar {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    object-fit: cover;
    border: 4px solid #e9ecef;
}

@media (max-width: 768px) {
    .page-header {
        flex-direction: column;
        text-align: center;
        gap: 15px;
    }
    
    .header-actions {
        width: 100%;
        justify-content: center;
    }
    
    .form-actions {
        flex-direction: column;
    }
    
    .form-actions .btn {
        width: 100%;
    }
}
</style>
@endsection 