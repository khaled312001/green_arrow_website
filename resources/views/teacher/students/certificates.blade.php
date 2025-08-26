@extends('layouts.teacher')

@section('title', 'شهادات الطالب')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">شهادات الطالب: {{ $student->name }}</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('teacher.dashboard') }}">الرئيسية</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('teacher.students.index') }}">الطلاب</a></li>
                        <li class="breadcrumb-item active">شهادات الطالب</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <!-- Student Info Card -->
            <div class="card">
                <div class="card-body">
                    <div class="text-center">
                        <div class="mb-3">
                            @if($student->avatar)
                                <img src="{{ asset('storage/' . $student->avatar) }}" 
                                     alt="{{ $student->name }}" 
                                     class="rounded-circle avatar-lg">
                            @else
                                <div class="avatar-lg rounded-circle bg-primary d-flex align-items-center justify-content-center mx-auto">
                                    <span class="avatar-title text-white font-size-24">
                                        {{ strtoupper(substr($student->name, 0, 1)) }}
                                    </span>
                                </div>
                            @endif
                        </div>
                        <h5 class="mb-1">{{ $student->name }}</h5>
                        <p class="text-muted">طالب</p>
                        <p class="text-muted mb-0">{{ $student->email }}</p>
                        @if($student->phone)
                            <p class="text-muted mb-0">{{ $student->phone }}</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-3">إحصائيات الشهادات</h5>
                    <div class="row text-center">
                        <div class="col-6">
                            <div class="border-end">
                                <h4 class="mb-1">{{ $certificates->count() }}</h4>
                                <p class="text-muted mb-0">إجمالي الشهادات</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div>
                                <h4 class="mb-1">{{ $certificates->where('status', 'issued')->count() }}</h4>
                                <p class="text-muted mb-0">الشهادات الممنوحة</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <!-- Certificates List -->
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">الشهادات الممنوحة</h4>
                    
                    @if($certificates->count() > 0)
                        <div class="row">
                            @foreach($certificates as $certificate)
                            <div class="col-md-6 mb-4">
                                <div class="card certificate-card h-100">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="flex-shrink-0">
                                                <div class="certificate-icon bg-primary rounded-circle d-flex align-items-center justify-content-center">
                                                    <i class="bx bx-certification text-white font-size-24"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="mb-1">{{ $certificate->course->title_ar }}</h6>
                                                <p class="text-muted mb-0">{{ $certificate->course->category->name_ar ?? 'بدون تصنيف' }}</p>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <div class="row text-center">
                                                <div class="col-6">
                                                    <small class="text-muted d-block">تاريخ الإصدار</small>
                                                    <strong>{{ $certificate->issued_at ? $certificate->issued_at->format('Y-m-d') : 'غير محدد' }}</strong>
                                                </div>
                                                <div class="col-6">
                                                    <small class="text-muted d-block">رقم الشهادة</small>
                                                    <strong>{{ $certificate->certificate_number ?? 'غير محدد' }}</strong>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <span class="badge bg-{{ $certificate->status === 'issued' ? 'success' : 'warning' }}">
                                                {{ $certificate->status === 'issued' ? 'ممنوحة' : 'قيد المعالجة' }}
                                            </span>
                                        </div>

                                        <div class="d-grid gap-2">
                                            @if($certificate->certificate_file)
                                                <a href="{{ asset('storage/' . $certificate->certificate_file) }}" 
                                                   target="_blank" 
                                                   class="btn btn-outline-primary btn-sm">
                                                    <i class="bx bx-download me-1"></i>
                                                    تحميل الشهادة
                                                </a>
                                            @else
                                                <button class="btn btn-outline-secondary btn-sm" disabled>
                                                    <i class="bx bx-time me-1"></i>
                                                    قيد الإعداد
                                                </button>
                                            @endif
                                            
                                            <a href="{{ route('teacher.courses.show', $certificate->course) }}" 
                                               class="btn btn-outline-info btn-sm">
                                                <i class="bx bx-book-open me-1"></i>
                                                عرض الدورة
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="bx bx-certification font-size-48 text-muted"></i>
                            <h5 class="mt-3 text-muted">لا توجد شهادات</h5>
                            <p class="text-muted">هذا الطالب لم يحصل على أي شهادات من دوراتك بعد</p>
                            <a href="{{ route('teacher.students.progress', $student) }}" class="btn btn-primary">
                                عرض تقدم الطالب
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Certificate Requirements -->
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">متطلبات الحصول على الشهادات</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center mb-3">
                                <div class="flex-shrink-0">
                                    <i class="bx bx-check-circle text-success font-size-20"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-1">إكمال جميع الدروس</h6>
                                    <p class="text-muted mb-0">يجب على الطالب إكمال جميع دروس الدورة</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center mb-3">
                                <div class="flex-shrink-0">
                                    <i class="bx bx-check-circle text-success font-size-20"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-1">اجتياز الاختبارات</h6>
                                    <p class="text-muted mb-0">يجب اجتياز جميع الاختبارات المطلوبة</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center mb-3">
                                <div class="flex-shrink-0">
                                    <i class="bx bx-check-circle text-success font-size-20"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-1">معدل تقدم 100%</h6>
                                    <p class="text-muted mb-0">يجب الوصول إلى معدل تقدم 100% في الدورة</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center mb-3">
                                <div class="flex-shrink-0">
                                    <i class="bx bx-check-circle text-success font-size-20"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-1">موافقة المعلم</h6>
                                    <p class="text-muted mb-0">يجب موافقة المعلم على منح الشهادة</p>
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
.certificate-card {
    transition: transform 0.2s, box-shadow 0.2s;
    border: 1px solid #e9ecef;
}

.certificate-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.certificate-icon {
    width: 50px;
    height: 50px;
}
</style>
@endsection 