@extends('layouts.teacher')

@section('title', 'تقرير الدورات')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">تقرير الدورات</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('teacher.dashboard') }}">الرئيسية</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('teacher.reports.index') }}">التقارير</a></li>
                        <li class="breadcrumb-item active">تقرير الدورات</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Course Statistics -->
        <div class="col-xl-3 col-md-6">
            <div class="card mini-stats-wid">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-muted fw-medium">إجمالي الدورات</p>
                            <h4 class="mb-0">{{ $courses->count() }}</h4>
                        </div>
                        <div class="flex-shrink-0 align-self-center">
                            <div class="mini-stat-icon avatar-sm rounded-circle bg-primary align-self-center">
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
                            <p class="text-muted fw-medium">الدورات المنشورة</p>
                            <h4 class="mb-0">{{ $courses->where('status', 'published')->count() }}</h4>
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
                            <p class="text-muted fw-medium">إجمالي التسجيلات</p>
                            <h4 class="mb-0">{{ $courses->sum('enrollments_count') }}</h4>
                        </div>
                        <div class="flex-shrink-0 align-self-center">
                            <div class="mini-stat-icon avatar-sm rounded-circle bg-warning align-self-center">
                                <span class="avatar-title">
                                    <i class="bx bx-user-plus font-size-24"></i>
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
                            <p class="text-muted fw-medium">متوسط التقييم</p>
                            <h4 class="mb-0">{{ number_format($courses->avg('rating_avg'), 1) }}/5</h4>
                        </div>
                        <div class="flex-shrink-0 align-self-center">
                            <div class="mini-stat-icon avatar-sm rounded-circle bg-info align-self-center">
                                <span class="avatar-title">
                                    <i class="bx bx-star font-size-24"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Courses List -->
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">قائمة الدورات</h4>
                    
                    @if($courses->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-centered table-nowrap mb-0">
                                <thead>
                                    <tr>
                                        <th>الدورة</th>
                                        <th>التصنيف</th>
                                        <th>الحالة</th>
                                        <th>التسجيلات</th>
                                        <th>التقييم</th>
                                        <th>الإيرادات</th>
                                        <th>الإجراءات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($courses as $course)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0">
                                                    <img src="{{ $course->image ? asset('storage/' . $course->image) : asset('images/default-course.jpg') }}" 
                                                         alt="{{ $course->title_ar }}" class="rounded avatar-sm">
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h6 class="mb-1">{{ $course->title_ar }}</h6>
                                                    <p class="text-muted mb-0">{{ $course->lessons_count ?? 0 }} درس</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-light text-dark">{{ $course->category->name_ar ?? 'بدون تصنيف' }}</span>
                                        </td>
                                        <td>
                                            <span class="badge bg-{{ $course->status === 'published' ? 'success' : 'warning' }}">
                                                {{ $course->status === 'published' ? 'منشور' : 'مسودة' }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <span class="badge bg-primary me-2">{{ $course->enrollments_count ?? 0 }}</span>
                                                <small class="text-muted">طالب</small>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="me-2">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        <i class="bx bx-star{{ $i <= ($course->rating_avg ?? 0) ? '' : '-o' }} text-warning"></i>
                                                    @endfor
                                                </div>
                                                <span class="text-muted">({{ number_format($course->rating_avg ?? 0, 1) }})</span>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="text-success fw-bold">{{ number_format($course->revenue ?? 0, 2) }} ريال</span>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                                    الإجراءات
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a class="dropdown-item" href="{{ route('teacher.courses.show', $course) }}">
                                                            <i class="bx bx-show me-2"></i>عرض التفاصيل
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="{{ route('teacher.courses.edit', $course) }}">
                                                            <i class="bx bx-edit me-2"></i>تعديل
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="{{ route('teacher.courses.lessons.index', $course) }}">
                                                            <i class="bx bx-list-ul me-2"></i>إدارة الدروس
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="{{ route('teacher.students.index') }}?course_id={{ $course->id }}">
                                                            <i class="bx bx-user me-2"></i>عرض الطلاب
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
                            <i class="bx bx-book-open font-size-48 text-muted"></i>
                            <h5 class="mt-3 text-muted">لا توجد دورات</h5>
                            <p class="text-muted">لم تقم بإنشاء أي دورات بعد</p>
                            <a href="{{ route('teacher.courses.create') }}" class="btn btn-primary">
                                إنشاء دورة جديدة
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Course Performance Chart -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">أداء الدورات</h4>
                    <div id="course-performance-chart" style="height: 300px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Course Performance Chart
    var courseData = {!! json_encode($courses->map(function($course) {
        return [
            'name' => $course->title_ar,
            'enrollments' => $course->enrollments_count ?? 0,
            'rating' => $course->rating_avg ?? 0,
            'revenue' => $course->revenue ?? 0
        ];
    })) !!};

    var options = {
        series: [{
            name: 'التسجيلات',
            data: courseData.map(function(course) { return course.enrollments; })
        }, {
            name: 'التقييم',
            data: courseData.map(function(course) { return (course.rating * 10); }) // Scale rating to 0-50 for better visualization
        }],
        chart: {
            type: 'bar',
            height: 300,
            toolbar: {
                show: false
            }
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '55%',
                endingShape: 'rounded'
            }
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            show: true,
            width: 2,
            colors: ['transparent']
        },
        xaxis: {
            categories: courseData.map(function(course) { return course.name; })
        },
        yaxis: {
            title: {
                text: 'القيمة'
            }
        },
        fill: {
            opacity: 1
        },
        tooltip: {
            y: {
                formatter: function (val) {
                    return val + " طالب";
                }
            }
        }
    };

    var chart = new ApexCharts(document.querySelector("#course-performance-chart"), options);
    chart.render();
});
</script>
@endpush
@endsection 