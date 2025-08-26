@extends('layouts.admin')

@section('title', 'تفاصيل المعلم')

@section('content')
<div class="instructor-details">
    <div class="page-header">
        <div class="header-content">
            <h1>تفاصيل المعلم</h1>
            <p>معلومات مفصلة عن المعلم: {{ $instructor->name }}</p>
        </div>
        <div class="header-actions">
            <a href="{{ route('admin.instructors.edit', $instructor) }}" class="btn btn-primary">
                <i class="bi bi-pencil"></i>
                تعديل
            </a>
            <a href="{{ route('admin.instructors') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i>
                العودة للقائمة
            </a>
        </div>
    </div>

    <div class="details-container">
        <div class="row">
            <!-- Personal Information -->
            <div class="col-md-4">
                <div class="info-card">
                    <div class="card-header">
                        <h3>المعلومات الشخصية</h3>
                    </div>
                    <div class="card-body">
                        <div class="instructor-avatar">
                            @if($instructor->avatar)
                                <img src="{{ asset('storage/' . $instructor->avatar) }}" alt="{{ $instructor->name }}">
                            @else
                                <div class="avatar-placeholder">
                                    {{ strtoupper(substr($instructor->name, 0, 1)) }}
                                </div>
                            @endif
                        </div>
                        
                        <div class="instructor-info">
                            <h4>{{ $instructor->name }}</h4>
                            <p class="specialization">{{ $instructor->specialization }}</p>
                            
                            <div class="status-badge">
                                @if($instructor->status == 'active')
                                    <span class="badge bg-success">نشط</span>
                                @elseif($instructor->status == 'inactive')
                                    <span class="badge bg-secondary">غير نشط</span>
                                @else
                                    <span class="badge bg-warning">معلق</span>
                                @endif
                            </div>
                        </div>

                        <div class="contact-info">
                            <div class="info-item">
                                <i class="bi bi-envelope"></i>
                                <a href="mailto:{{ $instructor->email }}">{{ $instructor->email }}</a>
                            </div>
                            @if($instructor->phone)
                            <div class="info-item">
                                <i class="bi bi-telephone"></i>
                                <a href="tel:{{ $instructor->phone }}">{{ $instructor->phone }}</a>
                            </div>
                            @endif
                            <div class="info-item">
                                <i class="bi bi-calendar"></i>
                                <span>تاريخ التسجيل: {{ $instructor->created_at->format('Y-m-d') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Professional Information -->
            <div class="col-md-8">
                <div class="info-card">
                    <div class="card-header">
                        <h3>المعلومات المهنية</h3>
                    </div>
                    <div class="card-body">
                        @if($instructor->bio)
                        <div class="info-section">
                            <h5>السيرة الذاتية</h5>
                            <p>{{ $instructor->bio }}</p>
                        </div>
                        @endif

                        <div class="row">
                            @if($instructor->experience_years)
                            <div class="col-md-6">
                                <div class="info-section">
                                    <h5>سنوات الخبرة</h5>
                                    <p>{{ $instructor->experience_years }} سنوات</p>
                                </div>
                            </div>
                            @endif

                            @if($instructor->education)
                            <div class="col-md-6">
                                <div class="info-section">
                                    <h5>المؤهل العلمي</h5>
                                    <p>{{ $instructor->education }}</p>
                                </div>
                            </div>
                            @endif
                        </div>

                        @if($instructor->certifications)
                        <div class="info-section">
                            <h5>الشهادات المهنية</h5>
                            <p>{{ $instructor->certifications }}</p>
                        </div>
                        @endif

                        @if($instructor->cv)
                        <div class="info-section">
                            <h5>السيرة الذاتية (PDF)</h5>
                            <a href="{{ asset('storage/' . $instructor->cv) }}" target="_blank" class="btn btn-outline-primary">
                                <i class="bi bi-file-earmark-text"></i>
                                عرض الملف
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="info-card">
                    <div class="card-header">
                        <h3>الإحصائيات</h3>
                    </div>
                    <div class="card-body">
                        <div class="stats-grid">
                            <div class="stat-item">
                                <div class="stat-icon">
                                    <i class="bi bi-book"></i>
                                </div>
                                <div class="stat-content">
                                    <h4>{{ $instructor->teachingCourses->count() }}</h4>
                                    <p>إجمالي الدورات</p>
                                </div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-icon">
                                    <i class="bi bi-people"></i>
                                </div>
                                <div class="stat-content">
                                    <h4>{{ $instructor->teachingCourses->sum('enrollments_count') }}</h4>
                                    <p>إجمالي الطلاب</p>
                                </div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-icon">
                                    <i class="bi bi-star"></i>
                                </div>
                                <div class="stat-content">
                                    <h4>{{ number_format($instructor->rating ?? 0, 1) }}</h4>
                                    <p>متوسط التقييم</p>
                                </div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-icon">
                                    <i class="bi bi-currency-dollar"></i>
                                </div>
                                <div class="stat-content">
                                    <h4>{{ number_format($instructor->teachingCourses->sum('revenue')) }} ريال</h4>
                                    <p>إجمالي الإيرادات</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Courses -->
        @if($instructor->teachingCourses->count() > 0)
        <div class="row mt-4">
            <div class="col-12">
                <div class="info-card">
                    <div class="card-header">
                        <h3>الدورات التدريبية</h3>
                    </div>
                    <div class="card-body">
                        <div class="courses-grid">
                            @foreach($instructor->teachingCourses as $course)
                            <div class="course-card">
                                <div class="course-image">
                                    @if($course->featured_image)
                                        <img src="{{ asset('storage/' . $course->featured_image) }}" alt="{{ $course->title_ar }}">
                                    @else
                                        <div class="course-placeholder">
                                            <i class="bi bi-book"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="course-content">
                                    <h5>{{ $course->title_ar }}</h5>
                                    <p class="course-category">{{ $course->category->name_ar }}</p>
                                    <div class="course-stats">
                                        <span><i class="bi bi-people"></i> {{ $course->enrollments_count ?? 0 }}</span>
                                        <span><i class="bi bi-star"></i> {{ number_format($course->rating ?? 0, 1) }}</span>
                                    </div>
                                    <div class="course-status">
                                        @if($course->status == 'published')
                                            <span class="badge bg-success">منشور</span>
                                        @elseif($course->status == 'draft')
                                            <span class="badge bg-secondary">مسودة</span>
                                        @else
                                            <span class="badge bg-warning">في الانتظار</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

<style>
.instructor-details {
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

.info-card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    height: 100%;
}

.card-header {
    background: #f8f9fa;
    padding: 20px;
    border-bottom: 1px solid #e9ecef;
}

.card-header h3 {
    margin: 0;
    color: #1f2937;
    font-weight: 600;
}

.card-body {
    padding: 25px;
}

.instructor-avatar {
    text-align: center;
    margin-bottom: 20px;
}

.instructor-avatar img {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    object-fit: cover;
    border: 4px solid #667eea;
}

.avatar-placeholder {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 3rem;
    font-weight: 600;
    margin: 0 auto;
}

.instructor-info {
    text-align: center;
    margin-bottom: 25px;
}

.instructor-info h4 {
    margin: 0 0 5px 0;
    color: #1f2937;
    font-weight: 600;
}

.specialization {
    color: #6b7280;
    margin: 0 0 15px 0;
}

.status-badge {
    margin-bottom: 20px;
}

.contact-info {
    border-top: 1px solid #f3f4f6;
    padding-top: 20px;
}

.info-item {
    display: flex;
    align-items: center;
    margin-bottom: 15px;
    color: #6b7280;
}

.info-item i {
    margin-right: 10px;
    color: #667eea;
    width: 20px;
}

.info-item a {
    color: #6b7280;
    text-decoration: none;
}

.info-item a:hover {
    color: #374151;
}

.info-section {
    margin-bottom: 25px;
}

.info-section h5 {
    color: #1f2937;
    font-weight: 600;
    margin-bottom: 10px;
}

.info-section p {
    color: #6b7280;
    margin: 0;
    line-height: 1.6;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
}

.stat-item {
    display: flex;
    align-items: center;
    padding: 20px;
    background: #f8f9fa;
    border-radius: 10px;
}

.stat-icon {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 15px;
    color: white;
    font-size: 1.2rem;
}

.stat-content h4 {
    margin: 0;
    font-size: 1.5rem;
    font-weight: 700;
    color: #1f2937;
}

.stat-content p {
    margin: 0;
    color: #6b7280;
    font-size: 0.9rem;
}

.courses-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
}

.course-card {
    border: 1px solid #e5e7eb;
    border-radius: 10px;
    overflow: hidden;
    transition: transform 0.3s ease;
}

.course-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
}

.course-image {
    height: 150px;
    background: #f3f4f6;
    display: flex;
    align-items: center;
    justify-content: center;
}

.course-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.course-placeholder {
    color: #9ca3af;
    font-size: 2rem;
}

.course-content {
    padding: 15px;
}

.course-content h5 {
    margin: 0 0 5px 0;
    color: #1f2937;
    font-weight: 600;
}

.course-category {
    color: #6b7280;
    font-size: 0.9rem;
    margin: 0 0 10px 0;
}

.course-stats {
    display: flex;
    gap: 15px;
    font-size: 0.8rem;
    color: #9ca3af;
    margin-bottom: 10px;
}

.course-stats span {
    display: flex;
    align-items: center;
    gap: 5px;
}

.course-status {
    text-align: right;
}

@media (max-width: 768px) {
    .page-header {
        flex-direction: column;
        text-align: center;
        gap: 15px;
    }
    
    .header-actions {
        flex-direction: column;
        width: 100%;
    }
    
    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .courses-grid {
        grid-template-columns: 1fr;
    }
}
</style>
@endsection 