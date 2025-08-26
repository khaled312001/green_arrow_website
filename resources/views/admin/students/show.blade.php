@extends('layouts.admin')

@section('title', 'تفاصيل الطالب')

@section('content')
<div class="student-details">
    <div class="page-header">
        <div class="header-content">
            <h1>تفاصيل الطالب</h1>
            <p>معلومات مفصلة عن الطالب: {{ $student->name }}</p>
        </div>
        <div class="header-actions">
            <a href="{{ route('admin.students.edit', $student) }}" class="btn btn-primary">
                <i class="bi bi-pencil"></i>
                تعديل
            </a>
            <a href="{{ route('admin.students') }}" class="btn btn-outline-secondary">
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
                        <div class="student-avatar">
                            @if($student->avatar)
                                <img src="{{ asset('storage/' . $student->avatar) }}" alt="{{ $student->name }}">
                            @else
                                <div class="avatar-placeholder">
                                    {{ strtoupper(substr($student->name, 0, 1)) }}
                                </div>
                            @endif
                        </div>
                        
                        <div class="student-info">
                            <h4>{{ $student->name }}</h4>
                            <p class="email">{{ $student->email }}</p>
                            
                            <div class="status-badge">
                                @if($student->status == 'active')
                                    <span class="badge bg-success">نشط</span>
                                @elseif($student->status == 'inactive')
                                    <span class="badge bg-secondary">غير نشط</span>
                                @else
                                    <span class="badge bg-warning">معلق</span>
                                @endif
                            </div>
                        </div>

                        <div class="contact-info">
                            <div class="info-item">
                                <i class="bi bi-envelope"></i>
                                <a href="mailto:{{ $student->email }}">{{ $student->email }}</a>
                            </div>
                            @if($student->phone)
                            <div class="info-item">
                                <i class="bi bi-telephone"></i>
                                <a href="tel:{{ $student->phone }}">{{ $student->phone }}</a>
                            </div>
                            @endif
                            @if($student->city)
                            <div class="info-item">
                                <i class="bi bi-geo-alt"></i>
                                <span>{{ $student->city }}, {{ $student->country }}</span>
                            </div>
                            @endif
                            <div class="info-item">
                                <i class="bi bi-calendar"></i>
                                <span>تاريخ التسجيل: {{ $student->created_at->format('Y-m-d') }}</span>
                            </div>
                            @if($student->last_login_at)
                            <div class="info-item">
                                <i class="bi bi-clock"></i>
                                <span>آخر تسجيل دخول: {{ $student->last_login_at->diffForHumans() }}</span>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Academic Information -->
            <div class="col-md-8">
                <div class="info-card">
                    <div class="card-header">
                        <h3>المعلومات الأكاديمية</h3>
                    </div>
                    <div class="card-body">
                        @if($student->bio)
                        <div class="info-section">
                            <h5>نبذة شخصية</h5>
                            <p>{{ $student->bio }}</p>
                        </div>
                        @endif

                        <div class="row">
                            <div class="col-md-6">
                                <div class="info-section">
                                    <h5>إجمالي التسجيلات</h5>
                                    <p class="stat-number">{{ $student->enrollments->count() }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-section">
                                    <h5>الدورات المكتملة</h5>
                                    <p class="stat-number">{{ $student->enrollments->where('status', 'completed')->count() }}</p>
                                </div>
                            </div>
                        </div>

                        @if($student->enrollments->count() > 0)
                        <div class="info-section">
                            <h5>التسجيلات الحالية</h5>
                            <div class="enrollments-list">
                                @foreach($student->enrollments->take(5) as $enrollment)
                                <div class="enrollment-item">
                                    <div class="course-info">
                                        <h6>{{ $enrollment->course->title_ar }}</h6>
                                        <p class="text-muted">{{ $enrollment->course->category->name_ar ?? 'غير محدد' }}</p>
                                    </div>
                                    <div class="enrollment-status">
                                        @if($enrollment->status == 'active')
                                            <span class="badge bg-success">نشط</span>
                                        @elseif($enrollment->status == 'completed')
                                            <span class="badge bg-primary">مكتمل</span>
                                        @elseif($enrollment->status == 'pending')
                                            <span class="badge bg-warning">في الانتظار</span>
                                        @else
                                            <span class="badge bg-secondary">{{ $enrollment->status }}</span>
                                        @endif
                                    </div>
                                    <div class="enrollment-date">
                                        <small>{{ $enrollment->created_at->format('Y-m-d') }}</small>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @if($student->enrollments->count() > 5)
                            <div class="text-center mt-3">
                                <a href="#" class="btn btn-outline-primary btn-sm">عرض جميع التسجيلات</a>
                            </div>
                            @endif
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional Information -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="info-card">
                    <div class="card-header">
                        <h3>معلومات إضافية</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @if($student->birth_date)
                            <div class="col-md-3">
                                <div class="info-section">
                                    <h5>تاريخ الميلاد</h5>
                                    <p>{{ $student->birth_date->format('Y-m-d') }}</p>
                                </div>
                            </div>
                            @endif
                            @if($student->gender)
                            <div class="col-md-3">
                                <div class="info-section">
                                    <h5>الجنس</h5>
                                    <p>{{ $student->gender == 'male' ? 'ذكر' : 'أنثى' }}</p>
                                </div>
                            </div>
                            @endif
                            <div class="col-md-3">
                                <div class="info-section">
                                    <h5>البريد الإلكتروني مؤكد</h5>
                                    <p>{{ $student->email_verified_at ? 'نعم' : 'لا' }}</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="info-section">
                                    <h5>الحالة</h5>
                                    <p>{{ $student->is_active ? 'مفعل' : 'غير مفعل' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.student-details {
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

.student-avatar {
    text-align: center;
    margin-bottom: 20px;
}

.student-avatar img {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    object-fit: cover;
    border: 4px solid #e9ecef;
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
    font-weight: bold;
    margin: 0 auto;
}

.student-info {
    text-align: center;
    margin-bottom: 20px;
}

.student-info h4 {
    margin: 0 0 5px 0;
    color: #495057;
    font-weight: 600;
}

.student-info .email {
    color: #6c757d;
    margin: 0 0 15px 0;
}

.status-badge {
    margin-bottom: 20px;
}

.contact-info {
    border-top: 1px solid #e9ecef;
    padding-top: 20px;
}

.info-item {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
    padding: 8px 0;
}

.info-item i {
    width: 20px;
    margin-left: 10px;
    color: #6c757d;
}

.info-item a {
    color: #007bff;
    text-decoration: none;
}

.info-item a:hover {
    text-decoration: underline;
}

.info-section {
    margin-bottom: 20px;
}

.info-section h5 {
    color: #495057;
    font-weight: 600;
    margin-bottom: 8px;
    font-size: 0.9rem;
}

.info-section p {
    color: #6c757d;
    margin: 0;
}

.stat-number {
    font-size: 1.5rem;
    font-weight: bold;
    color: #007bff;
}

.enrollments-list {
    max-height: 300px;
    overflow-y: auto;
}

.enrollment-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px;
    border: 1px solid #e9ecef;
    border-radius: 8px;
    margin-bottom: 10px;
    background: #f8f9fa;
}

.course-info h6 {
    margin: 0 0 5px 0;
    color: #495057;
    font-weight: 600;
}

.course-info p {
    margin: 0;
    font-size: 0.85rem;
}

.enrollment-status {
    margin: 0 15px;
}

.enrollment-date {
    color: #6c757d;
    font-size: 0.85rem;
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
    
    .enrollment-item {
        flex-direction: column;
        text-align: center;
        gap: 10px;
    }
}
</style>
@endsection 