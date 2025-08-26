@extends('layouts.teacher')

@section('title', 'تقرير الطلاب')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">تقرير الطلاب</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('teacher.dashboard') }}">الرئيسية</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('teacher.reports.index') }}">التقارير</a></li>
                        <li class="breadcrumb-item active">تقرير الطلاب</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Student Statistics -->
        <div class="col-xl-3 col-md-6">
            <div class="card mini-stats-wid">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-muted fw-medium">إجمالي الطلاب</p>
                            <h4 class="mb-0">{{ $students->count() }}</h4>
                        </div>
                        <div class="flex-shrink-0 align-self-center">
                            <div class="mini-stat-icon avatar-sm rounded-circle bg-primary align-self-center">
                                <span class="avatar-title">
                                    <i class="bx bx-user font-size-24"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card mini-stats-wid">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-muted fw-medium">الطلاب النشطون</p>
                            <h4 class="mb-0">{{ $students->where('status', 'active')->count() }}</h4>
                        </div>
                        <div class="flex-shrink-0 align-self-center">
                            <div class="mini-stat-icon avatar-sm rounded-circle bg-success align-self-center">
                                <span class="avatar-title">
                                    <i class="bx bx-check-circle font-size-24"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card mini-stats-wid">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-muted fw-medium">متوسط الدورات</p>
                            <h4 class="mb-0">{{ number_format($students->avg('enrollments_count'), 1) }}</h4>
                        </div>
                        <div class="flex-shrink-0 align-self-center">
                            <div class="mini-stat-icon avatar-sm rounded-circle bg-warning align-self-center">
                                <span class="avatar-title">
                                    <i class="bx bx-book-open font-size-24"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card mini-stats-wid">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-muted fw-medium">معدل الإكمال</p>
                            <h4 class="mb-0">{{ number_format($students->avg('completion_rate'), 1) }}%</h4>
                        </div>
                        <div class="flex-shrink-0 align-self-center">
                            <div class="mini-stat-icon avatar-sm rounded-circle bg-info align-self-center">
                                <span class="avatar-title">
                                    <i class="bx bx-trending-up font-size-24"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Students List -->
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">قائمة الطلاب</h4>
                    
                    @if($students->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-centered table-nowrap mb-0">
                                <thead>
                                    <tr>
                                        <th>الطالب</th>
                                        <th>البريد الإلكتروني</th>
                                        <th>الدورات المسجل بها</th>
                                        <th>الدورات المكتملة</th>
                                        <th>معدل التقدم</th>
                                        <th>آخر نشاط</th>
                                        <th>الإجراءات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($students as $student)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0">
                                                    @if($student->avatar)
                                                        <img src="{{ asset('storage/' . $student->avatar) }}" 
                                                             alt="{{ $student->name }}" class="rounded-circle avatar-sm">
                                                    @else
                                                        <div class="avatar-sm rounded-circle bg-primary d-flex align-items-center justify-content-center">
                                                            <span class="avatar-title text-white">
                                                                {{ strtoupper(substr($student->name, 0, 1)) }}
                                                            </span>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h6 class="mb-1">{{ $student->name }}</h6>
                                                    <p class="text-muted mb-0">{{ $student->phone ?? 'غير محدد' }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $student->email }}</td>
                                        <td>
                                            <span class="badge bg-primary">{{ $student->enrollments_count ?? 0 }}</span>
                                        </td>
                                        <td>
                                            <span class="badge bg-success">{{ $student->completed_courses_count ?? 0 }}</span>
                                        </td>
                                        <td>
                                            <div class="progress" style="height: 6px;">
                                                <div class="progress-bar" role="progressbar" 
                                                     style="width: {{ $student->completion_rate ?? 0 }}%" 
                                                     aria-valuenow="{{ $student->completion_rate ?? 0 }}" 
                                                     aria-valuemin="0" aria-valuemax="100">
                                                </div>
                                            </div>
                                            <small class="text-muted">{{ number_format($student->completion_rate ?? 0, 1) }}%</small>
                                        </td>
                                        <td>{{ $student->last_activity ? $student->last_activity->diffForHumans() : 'غير محدد' }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                                    الإجراءات
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a class="dropdown-item" href="{{ route('teacher.students.show', $student) }}">
                                                            <i class="bx bx-user me-2"></i>عرض التفاصيل
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="{{ route('teacher.students.progress', $student) }}">
                                                            <i class="bx bx-trending-up me-2"></i>عرض التقدم
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="{{ route('teacher.students.certificates', $student) }}">
                                                            <i class="bx bx-certification me-2"></i>الشهادات
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="bx bx-user-x font-size-48 text-muted"></i>
                            <h5 class="mt-3 text-muted">لا يوجد طلاب</h5>
                            <p class="text-muted">لم يسجل أي طالب في دوراتك بعد</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 