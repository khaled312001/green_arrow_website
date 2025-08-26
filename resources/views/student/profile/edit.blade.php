@extends('layouts.student')

@section('title', 'الملف الشخصي - لوحة الطالب')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header" style="margin-bottom: 30px;">
        <h1 style="font-size: 2rem; color: #1f2937; margin-bottom: 10px;">الملف الشخصي</h1>
        <p style="color: #6b7280;">إدارة معلوماتك الشخصية</p>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card" style="background: white; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                <div class="card-body" style="padding: 30px;">
                    <h3 style="font-size: 1.5rem; color: #1f2937; margin-bottom: 25px;">المعلومات الشخصية</h3>
                    
                    <form method="POST" action="{{ route('student.profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div style="margin-bottom: 20px;">
                                    <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">الاسم الكامل *</label>
                                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                                           style="width: 100%; padding: 12px; border: 2px solid #e5e7eb; border-radius: 10px; font-size: 1rem; transition: border-color 0.3s ease;">
                                    @error('name')
                                        <span style="color: #ef4444; font-size: 0.8rem; margin-top: 5px; display: block;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div style="margin-bottom: 20px;">
                                    <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">البريد الإلكتروني *</label>
                                    <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                                           style="width: 100%; padding: 12px; border: 2px solid #e5e7eb; border-radius: 10px; font-size: 1rem; transition: border-color 0.3s ease;">
                                    @error('email')
                                        <span style="color: #ef4444; font-size: 0.8rem; margin-top: 5px; display: block;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div style="margin-bottom: 20px;">
                                    <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">رقم الهاتف</label>
                                    <input type="tel" name="phone" value="{{ old('phone', $user->phone) }}"
                                           style="width: 100%; padding: 12px; border: 2px solid #e5e7eb; border-radius: 10px; font-size: 1rem; transition: border-color 0.3s ease;">
                                    @error('phone')
                                        <span style="color: #ef4444; font-size: 0.8rem; margin-top: 5px; display: block;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div style="margin-bottom: 20px;">
                                    <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">المدينة</label>
                                    <input type="text" name="city" value="{{ old('city', $user->city) }}"
                                           style="width: 100%; padding: 12px; border: 2px solid #e5e7eb; border-radius: 10px; font-size: 1rem; transition: border-color 0.3s ease;">
                                    @error('city')
                                        <span style="color: #ef4444; font-size: 0.8rem; margin-top: 5px; display: block;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div style="margin-bottom: 20px;">
                                    <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">تاريخ الميلاد</label>
                                    <input type="date" name="birth_date" value="{{ old('birth_date', $user->birth_date) }}"
                                           style="width: 100%; padding: 12px; border: 2px solid #e5e7eb; border-radius: 10px; font-size: 1rem; transition: border-color 0.3s ease;">
                                    @error('birth_date')
                                        <span style="color: #ef4444; font-size: 0.8rem; margin-top: 5px; display: block;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div style="margin-bottom: 20px;">
                                    <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">الجنس</label>
                                    <select name="gender" style="width: 100%; padding: 12px; border: 2px solid #e5e7eb; border-radius: 10px; font-size: 1rem; transition: border-color 0.3s ease;">
                                        <option value="">اختر الجنس</option>
                                        <option value="male" {{ old('gender', $user->gender) == 'male' ? 'selected' : '' }}>ذكر</option>
                                        <option value="female" {{ old('gender', $user->gender) == 'female' ? 'selected' : '' }}>أنثى</option>
                                    </select>
                                    @error('gender')
                                        <span style="color: #ef4444; font-size: 0.8rem; margin-top: 5px; display: block;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <div style="margin-bottom: 20px;">
                                    <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">نبذة شخصية</label>
                                    <textarea name="bio" rows="4" placeholder="اكتب نبذة مختصرة عن نفسك..."
                                              style="width: 100%; padding: 12px; border: 2px solid #e5e7eb; border-radius: 10px; font-size: 1rem; resize: vertical; transition: border-color 0.3s ease;">{{ old('bio', $user->bio) }}</textarea>
                                    @error('bio')
                                        <span style="color: #ef4444; font-size: 0.8rem; margin-top: 5px; display: block;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <div style="margin-bottom: 20px;">
                                    <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">صورة الملف الشخصي</label>
                                    <input type="file" name="avatar" accept="image/*"
                                           style="width: 100%; padding: 12px; border: 2px solid #e5e7eb; border-radius: 10px; font-size: 1rem; transition: border-color 0.3s ease;">
                                    <small style="color: #6b7280; font-size: 0.8rem; margin-top: 5px; display: block;">يُسمح بملفات JPG, PNG, GIF بحجم أقصى 2MB</small>
                                    @error('avatar')
                                        <span style="color: #ef4444; font-size: 0.8rem; margin-top: 5px; display: block;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div style="display: flex; gap: 15px; margin-top: 30px;">
                            <button type="submit" class="btn btn-primary" style="padding: 12px 24px; border-radius: 10px;">
                                <i class="bi bi-check-circle"></i>
                                حفظ التغييرات
                            </button>
                            <a href="{{ route('student.dashboard') }}" class="btn btn-outline" style="padding: 12px 24px; border-radius: 10px;">
                                <i class="bi bi-arrow-right"></i>
                                إلغاء
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <!-- Profile Summary Card -->
            <div class="card" style="background: white; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); margin-bottom: 20px;">
                <div class="card-body" style="padding: 25px; text-align: center;">
                    <div style="width: 100px; height: 100px; border-radius: 50%; background: linear-gradient(135deg, #10b981, #059669); display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; color: white; font-size: 2.5rem;">
                        @if($user->avatar)
                            <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}" style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;">
                        @else
                            <i class="bi bi-person"></i>
                        @endif
                    </div>
                    
                    <h4 style="font-size: 1.3rem; color: #1f2937; margin-bottom: 5px;">{{ $user->name }}</h4>
                    <p style="color: #6b7280; margin-bottom: 15px;">طالب</p>
                    
                    <div style="display: flex; justify-content: space-around; margin-bottom: 20px;">
                        <div style="text-align: center;">
                            <div style="font-size: 1.5rem; font-weight: 600; color: #10b981;">{{ $user->enrollments()->count() }}</div>
                            <div style="font-size: 0.8rem; color: #6b7280;">الدورات</div>
                        </div>
                        <div style="text-align: center;">
                            <div style="font-size: 1.5rem; font-weight: 600; color: #3b82f6;">{{ $user->certificates()->count() }}</div>
                            <div style="font-size: 0.8rem; color: #6b7280;">الشهادات</div>
                        </div>
                    </div>
                    
                    <div style="border-top: 1px solid #e5e7eb; padding-top: 15px;">
                        <p style="color: #6b7280; font-size: 0.9rem; margin-bottom: 5px;">
                            <i class="bi bi-calendar"></i>
                            انضم في {{ $user->created_at->format('Y-m-d') }}
                        </p>
                        @if($user->last_login_at)
                            <p style="color: #6b7280; font-size: 0.9rem;">
                                <i class="bi bi-clock"></i>
                                آخر دخول {{ $user->last_login_at->diffForHumans() }}
                            </p>
                        @endif
                    </div>
                </div>
            </div>
            
            <!-- Quick Stats -->
            <div class="card" style="background: white; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                <div class="card-body" style="padding: 25px;">
                    <h5 style="font-size: 1.1rem; color: #1f2937; margin-bottom: 15px;">إحصائيات سريعة</h5>
                    
                    <div style="margin-bottom: 15px;">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 5px;">
                            <span style="color: #6b7280; font-size: 0.9rem;">الدورات المكتملة</span>
                            <span style="color: #10b981; font-weight: 600;">{{ $user->enrollments()->where('status', 'completed')->count() }}</span>
                        </div>
                        <div style="width: 100%; height: 6px; background: #e5e7eb; border-radius: 3px; overflow: hidden;">
                            <div style="width: {{ $user->enrollments()->where('status', 'completed')->count() > 0 ? ($user->enrollments()->where('status', 'completed')->count() / $user->enrollments()->count()) * 100 : 0 }}%; height: 100%; background: #10b981; border-radius: 3px;"></div>
                        </div>
                    </div>
                    
                    <div style="margin-bottom: 15px;">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 5px;">
                            <span style="color: #6b7280; font-size: 0.9rem;">متوسط التقدم</span>
                            <span style="color: #3b82f6; font-weight: 600;">{{ number_format($user->enrollments()->avg('progress_percentage') ?? 0, 1) }}%</span>
                        </div>
                        <div style="width: 100%; height: 6px; background: #e5e7eb; border-radius: 3px; overflow: hidden;">
                            <div style="width: {{ $user->enrollments()->avg('progress_percentage') ?? 0 }}%; height: 100%; background: #3b82f6; border-radius: 3px;"></div>
                        </div>
                    </div>
                    
                    <div>
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 5px;">
                            <span style="color: #6b7280; font-size: 0.9rem;">إجمالي الساعات</span>
                            <span style="color: #f59e0b; font-weight: 600;">{{ number_format($user->enrollments()->sum('total_hours_watched') ?? 0, 1) }} ساعة</span>
                        </div>
                        <div style="width: 100%; height: 6px; background: #e5e7eb; border-radius: 3px; overflow: hidden;">
                            <div style="width: {{ $user->enrollments()->sum('total_hours_watched') > 0 ? min(($user->enrollments()->sum('total_hours_watched') / 100) * 100, 100) : 0 }}%; height: 100%; background: #f59e0b; border-radius: 3px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
input:focus, textarea:focus, select:focus {
    outline: none;
    border-color: #10b981;
    box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
}

.btn {
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
    font-weight: 500;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.btn:hover {
    background: linear-gradient(135deg, #059669, #047857);
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3);
    color: white;
    text-decoration: none;
}

.btn-outline {
    background: transparent;
    border: 2px solid #10b981;
    color: #10b981;
}

.btn-outline:hover {
    background: #10b981;
    color: white;
}

@media (max-width: 768px) {
    .col-lg-4 {
        margin-top: 20px;
    }
    
    .btn {
        width: 100%;
        justify-content: center;
        margin-bottom: 10px;
    }
}
</style>
@endsection 