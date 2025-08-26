@extends('layouts.teacher')

@section('title', 'تقدم الطالب')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">تقدم الطالب: {{ $student->name }}</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('teacher.dashboard') }}">الرئيسية</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('teacher.students.index') }}">الطلاب</a></li>
                        <li class="breadcrumb-item active">تقدم الطالب</li>
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
                    <h5 class="card-title mb-3">إحصائيات سريعة</h5>
                    <div class="row text-center">
                        <div class="col-6">
                            <div class="border-end">
                                <h4 class="mb-1">{{ $enrollments->count() }}</h4>
                                <p class="text-muted mb-0">الدورات المسجل بها</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div>
                                <h4 class="mb-1">{{ $enrollments->where('status', 'completed')->count() }}</h4>
                                <p class="text-muted mb-0">الدورات المكتملة</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <!-- Course Progress -->
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">تقدم الدورات</h4>
                    
                    @if($enrollments->count() > 0)
                        @foreach($enrollments as $enrollment)
                        <div class="border rounded p-3 mb-3">
                            <div class="d-flex align-items-center mb-3">
                                <div class="flex-shrink-0">
                                    <img src="{{ $enrollment->course->image ? asset('storage/' . $enrollment->course->image) : asset('images/default-course.jpg') }}" 
                                         alt="{{ $enrollment->course->title_ar }}" class="rounded avatar-sm">
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-1">{{ $enrollment->course->title_ar }}</h6>
                                    <p class="text-muted mb-0">{{ $enrollment->course->category->name_ar ?? 'بدون تصنيف' }}</p>
                                </div>
                                <div class="flex-shrink-0">
                                    <span class="badge bg-{{ $enrollment->status === 'completed' ? 'success' : ($enrollment->status === 'active' ? 'primary' : 'warning') }}">
                                        {{ $enrollment->status === 'completed' ? 'مكتمل' : ($enrollment->status === 'active' ? 'نشط' : 'معلق') }}
                                    </span>
                                </div>
                            </div>

                            <!-- Progress Bar -->
                            <div class="mb-3">
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="text-muted">التقدم</span>
                                    <span class="text-muted">{{ $enrollment->progress_percentage ?? 0 }}%</span>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" 
                                         style="width: {{ $enrollment->progress_percentage ?? 0 }}%" 
                                         aria-valuenow="{{ $enrollment->progress_percentage ?? 0 }}" 
                                         aria-valuemin="0" aria-valuemax="100">
                                    </div>
                                </div>
                            </div>

                            <!-- Course Details -->
                            <div class="row text-center">
                                <div class="col-4">
                                    <small class="text-muted">تاريخ التسجيل</small>
                                    <p class="mb-0">{{ $enrollment->enrolled_at ? $enrollment->enrolled_at->format('Y-m-d') : 'غير محدد' }}</p>
                                </div>
                                <div class="col-4">
                                    <small class="text-muted">تاريخ الإكمال</small>
                                    <p class="mb-0">{{ $enrollment->completed_at ? $enrollment->completed_at->format('Y-m-d') : 'لم يكتمل بعد' }}</p>
                                </div>
                                <div class="col-4">
                                    <small class="text-muted">آخر نشاط</small>
                                    <p class="mb-0">{{ $enrollment->updated_at->diffForHumans() }}</p>
                                </div>
                            </div>

                            <!-- Lesson Progress -->
                            @if($enrollment->course->lessons->count() > 0)
                            <div class="mt-3">
                                <h6 class="mb-2">تقدم الدروس</h6>
                                <div class="row">
                                    @foreach($enrollment->course->lessons->take(6) as $lesson)
                                    <div class="col-md-6 mb-2">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <i class="bx bx-play-circle font-size-16 text-primary"></i>
                                            </div>
                                            <div class="flex-grow-1 ms-2">
                                                <small class="d-block">{{ $lesson->title_ar }}</small>
                                                <small class="text-muted">{{ $lesson->duration }} دقيقة</small>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <i class="bx bx-check-circle font-size-16 text-success"></i>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                @if($enrollment->course->lessons->count() > 6)
                                <div class="text-center mt-2">
                                    <small class="text-muted">و {{ $enrollment->course->lessons->count() - 6 }} درس آخر</small>
                                </div>
                                @endif
                            </div>
                            @endif
                        </div>
                        @endforeach
                    @else
                        <div class="text-center py-4">
                            <i class="bx bx-user-x font-size-48 text-muted"></i>
                            <h5 class="mt-3 text-muted">لا توجد دورات مسجل بها</h5>
                            <p class="text-muted">هذا الطالب لم يسجل في أي دورة من دوراتك بعد</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 