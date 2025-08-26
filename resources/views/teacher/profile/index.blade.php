@extends('layouts.teacher')

@section('title', 'الملف الشخصي')

@section('content')
<style>
    .profile-container {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        padding: 2rem 0;
    }
    
    .profile-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        overflow: hidden;
        transition: all 0.3s ease;
    }
    
    .profile-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 30px 60px rgba(0, 0, 0, 0.15);
    }
    
    .profile-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 3rem 2rem;
        text-align: center;
        color: white;
        position: relative;
        overflow: hidden;
    }
    
    .profile-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/><circle cx="50" cy="10" r="0.5" fill="white" opacity="0.1"/><circle cx="10" cy="60" r="0.5" fill="white" opacity="0.1"/><circle cx="90" cy="40" r="0.5" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
        opacity: 0.3;
    }
    
    .avatar-container {
        position: relative;
        display: inline-block;
        margin-bottom: 1.5rem;
    }
    
    .avatar {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        border: 4px solid rgba(255, 255, 255, 0.3);
        object-fit: cover;
        transition: all 0.3s ease;
    }
    
    .avatar-placeholder {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        color: white;
        font-weight: bold;
        border: 4px solid rgba(255, 255, 255, 0.3);
    }
    
    .avatar-container:hover .avatar,
    .avatar-container:hover .avatar-placeholder {
        transform: scale(1.05);
        border-color: rgba(255, 255, 255, 0.6);
    }
    
    .profile-name {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    }
    
    .profile-role {
        font-size: 1.1rem;
        opacity: 0.9;
        margin-bottom: 0.5rem;
    }
    
    .profile-email {
        font-size: 1rem;
        opacity: 0.8;
    }
    
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 1.5rem;
        padding: 2rem;
    }
    
    .stat-card {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        color: white;
        padding: 1.5rem;
        border-radius: 15px;
        text-align: center;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .stat-card:nth-child(2) {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    }
    
    .stat-card:nth-child(3) {
        background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
    }
    
    .stat-card:nth-child(4) {
        background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
    }
    
    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s ease;
    }
    
    .stat-card:hover::before {
        left: 100%;
    }
    
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
    }
    
    .stat-number {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }
    
    .stat-label {
        font-size: 0.9rem;
        opacity: 0.9;
    }
    
    .form-section {
        background: white;
        padding: 2rem;
        border-radius: 15px;
        margin-bottom: 2rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(0, 0, 0, 0.05);
    }
    
    .section-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .section-title i {
        color: #667eea;
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
    
    .courses-section {
        background: white;
        padding: 2rem;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(0, 0, 0, 0.05);
    }
    
    .course-item {
        display: flex;
        align-items: center;
        padding: 1rem;
        border-radius: 10px;
        margin-bottom: 1rem;
        background: #f7fafc;
        transition: all 0.3s ease;
        border: 1px solid #e2e8f0;
    }
    
    .course-item:hover {
        background: white;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        transform: translateX(5px);
    }
    
    .course-image {
        width: 60px;
        height: 60px;
        border-radius: 10px;
        object-fit: cover;
        margin-left: 1rem;
    }
    
    .course-info {
        flex: 1;
    }
    
    .course-title {
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 0.25rem;
    }
    
    .course-stats {
        font-size: 0.9rem;
        color: #718096;
    }
    
    .course-status {
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        margin-left: 1rem;
    }
    
    .status-published {
        background: #c6f6d5;
        color: #22543d;
    }
    
    .status-draft {
        background: #fef5e7;
        color: #744210;
    }
    
    .empty-state {
        text-align: center;
        padding: 3rem 2rem;
        color: #718096;
    }
    
    .empty-state i {
        font-size: 4rem;
        margin-bottom: 1rem;
        opacity: 0.5;
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
    
    @media (max-width: 768px) {
        .profile-container {
            padding: 1rem 0;
        }
        
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
            padding: 1.5rem;
        }
        
        .profile-header {
            padding: 2rem 1rem;
        }
        
        .profile-name {
            font-size: 1.5rem;
        }
        
        .avatar,
        .avatar-placeholder {
            width: 100px;
            height: 100px;
        }
    }
</style>

<div class="profile-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="profile-card">
                    <!-- Profile Header -->
                    <div class="profile-header">
                        <div class="avatar-container">
                            @if($teacher->avatar)
                                <img src="{{ asset('storage/' . $teacher->avatar) }}" 
                                     alt="{{ $teacher->name }}" 
                                     class="avatar">
                            @else
                                <div class="avatar-placeholder">
                                    {{ strtoupper(substr($teacher->name, 0, 1)) }}
                                </div>
                            @endif
                        </div>
                        <h1 class="profile-name">{{ $teacher->name }}</h1>
                        <p class="profile-role">معلم محترف</p>
                        <p class="profile-email">{{ $teacher->email }}</p>
                    </div>
                    
                    <!-- Statistics -->
                    <div class="stats-grid">
                        <div class="stat-card">
                            <div class="stat-number">{{ $teacher->teachingCourses()->count() }}</div>
                            <div class="stat-label">الدورات</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-number">{{ $teacher->teachingCourses()->withCount('enrollments')->get()->sum('enrollments_count') }}</div>
                            <div class="stat-label">الطلاب</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-number">{{ $teacher->teachingCourses()->where('status', 'published')->count() }}</div>
                            <div class="stat-label">منشور</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-number">{{ number_format($teacher->teachingCourses()->avg('rating'), 1) }}</div>
                            <div class="stat-label">التقييم</div>
                        </div>
                    </div>
                </div>
                
                <!-- Profile Form -->
                <div class="form-section">
                    <h2 class="section-title">
                        <i class="bi bi-person-gear"></i>
                        تعديل الملف الشخصي
                    </h2>
                    
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

                    <form action="{{ route('teacher.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="form-label">الاسم الكامل</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                           id="name" name="name" value="{{ old('name', $teacher->name) }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email" class="form-label">البريد الإلكتروني</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                           id="email" name="email" value="{{ old('email', $teacher->email) }}" required>
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
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                                           id="phone" name="phone" value="{{ old('phone', $teacher->phone) }}">
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="avatar" class="form-label">الصورة الشخصية</label>
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

                <!-- Recent Courses -->
                <div class="courses-section">
                    <h2 class="section-title">
                        <i class="bi bi-book"></i>
                        الدورات الحديثة
                    </h2>
                    
                    @if($teacher->teachingCourses()->count() > 0)
                        @foreach($teacher->teachingCourses()->latest()->take(5)->get() as $course)
                            <div class="course-item">
                                <img src="{{ $course->image ? asset('storage/' . $course->image) : asset('images/default-course.svg') }}" 
                                     alt="{{ $course->title_ar }}" class="course-image">
                                <div class="course-info">
                                    <div class="course-title">{{ $course->title_ar }}</div>
                                    <div class="course-stats">{{ $course->enrollments()->count() }} طالب • {{ $course->lessons()->count() }} درس</div>
                                </div>
                                <span class="course-status status-{{ $course->status === 'published' ? 'published' : 'draft' }}">
                                    {{ $course->status === 'published' ? 'منشور' : 'مسودة' }}
                                </span>
                                <a href="{{ route('teacher.courses.show', $course) }}" class="btn btn-sm btn-outline-primary ms-2">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </div>
                        @endforeach
                        
                        <div class="text-center mt-4">
                            <a href="{{ route('teacher.courses.index') }}" class="btn btn-outline-primary">
                                <i class="bi bi-arrow-left"></i>
                                عرض جميع الدورات
                            </a>
                        </div>
                    @else
                        <div class="empty-state">
                            <i class="bi bi-book"></i>
                            <h4>لا توجد دورات بعد</h4>
                            <p>ابدأ بإنشاء دورتك الأولى وشارك معرفتك مع الطلاب</p>
                            <a href="{{ route('teacher.courses.create') }}" class="btn btn-primary">
                                <i class="bi bi-plus-lg"></i>
                                إنشاء دورة جديدة
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add animation to stats cards
    const statCards = document.querySelectorAll('.stat-card');
    statCards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        
        setTimeout(() => {
            card.style.transition = 'all 0.6s ease';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 100);
    });
    
    // Add animation to form sections
    const formSections = document.querySelectorAll('.form-section, .courses-section');
    formSections.forEach((section, index) => {
        section.style.opacity = '0';
        section.style.transform = 'translateX(20px)';
        
        setTimeout(() => {
            section.style.transition = 'all 0.6s ease';
            section.style.opacity = '1';
            section.style.transform = 'translateX(0)';
        }, 500 + index * 200);
    });
    
    // Preview avatar image
    const avatarInput = document.getElementById('avatar');
    const avatarContainer = document.querySelector('.avatar-container');
    
    if (avatarInput) {
        avatarInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = avatarContainer.querySelector('.avatar') || document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'avatar';
                    img.alt = 'Preview';
                    
                    if (!avatarContainer.querySelector('.avatar')) {
                        avatarContainer.innerHTML = '';
                        avatarContainer.appendChild(img);
                    }
                };
                reader.readAsDataURL(file);
            }
        });
    }
});
</script>
@endsection 