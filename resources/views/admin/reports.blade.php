@extends('layouts.admin')

@section('title', 'التقارير والإحصائيات - لوحة الإدارة')

@section('content')
<div class="content-area">
    <!-- Date Range Filter -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.reports') }}" class="row g-3">
                <div class="col-md-4">
                    <label for="start_date" class="form-label">من تاريخ</label>
                    <input type="date" name="start_date" id="start_date" 
                           value="{{ $startDate->format('Y-m-d') }}" class="form-control">
                </div>
                <div class="col-md-4">
                    <label for="end_date" class="form-label">إلى تاريخ</label>
                    <input type="date" name="end_date" id="end_date" 
                           value="{{ $endDate->format('Y-m-d') }}" class="form-control">
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary me-2">
                        <i class="bi bi-search"></i>
                        تحديث
                    </button>
                    <button type="button" class="btn btn-outline-secondary" onclick="exportReports()">
                        <i class="bi bi-download"></i>
                        تصدير
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                التسجيلات الجديدة
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ number_format($reports['enrollments']) }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-people-fill fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                الإيرادات
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ number_format($reports['revenue'], 2) }} ريال
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-currency-dollar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                المستخدمون الجدد
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ number_format($reports['new_users']) }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-person-plus-fill fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                الدورات المكتملة
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ number_format($reports['completed_courses']) }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-award-fill fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Top Courses -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">الدورات الأكثر مبيعاً</h6>
                </div>
                <div class="card-body">
                    @if($topCourses->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>الدورة</th>
                                        <th>التسجيلات</th>
                                        <th>النسبة</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($topCourses as $course)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if($course->thumbnail)
                                                    <img src="{{ asset('storage/' . $course->thumbnail) }}" 
                                                         alt="{{ $course->title_ar }}" class="rounded me-2" width="40" height="40">
                                                @else
                                                    <div class="bg-light rounded d-flex align-items-center justify-content-center me-2" 
                                                         style="width: 40px; height: 40px;">
                                                        <i class="bi bi-book text-muted"></i>
                                                    </div>
                                                @endif
                                                <div>
                                                    <div class="fw-bold">{{ $course->title_ar }}</div>
                                                    @if($course->title_en)
                                                        <small class="text-muted">{{ $course->title_en }}</small>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-primary">{{ $course->enrollments_count }}</span>
                                        </td>
                                        <td>
                                            @php
                                                $percentage = $reports['enrollments'] > 0 
                                                    ? round(($course->enrollments_count / $reports['enrollments']) * 100, 1)
                                                    : 0;
                                            @endphp
                                            <div class="progress" style="height: 6px;">
                                                <div class="progress-bar" style="width: {{ $percentage }}%"></div>
                                            </div>
                                            <small class="text-muted">{{ $percentage }}%</small>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="bi bi-book text-muted fs-1 d-block mb-3"></i>
                            <p class="text-muted">لا توجد دورات في هذه الفترة</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Top Instructors -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">المدربون الأكثر نشاطاً</h6>
                </div>
                <div class="card-body">
                    @if($topInstructors->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>المدرب</th>
                                        <th>الدورات</th>
                                        <th>النسبة</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($topInstructors as $instructor)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if($instructor->profile_photo)
                                                    <img src="{{ asset('storage/' . $instructor->profile_photo) }}" 
                                                         alt="{{ $instructor->name }}" class="rounded-circle me-2" width="40" height="40">
                                                @else
                                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2" 
                                                         style="width: 40px; height: 40px; font-size: 14px;">
                                                        {{ strtoupper(substr($instructor->name, 0, 1)) }}
                                                    </div>
                                                @endif
                                                <div>
                                                    <div class="fw-bold">{{ $instructor->name }}</div>
                                                    <small class="text-muted">{{ $instructor->email }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-success">{{ $instructor->teaching_courses_count }}</span>
                                        </td>
                                        <td>
                                            @php
                                                $totalCourses = $topInstructors->sum('teaching_courses_count');
                                                $percentage = $totalCourses > 0 
                                                    ? round(($instructor->teaching_courses_count / $totalCourses) * 100, 1)
                                                    : 0;
                                            @endphp
                                            <div class="progress" style="height: 6px;">
                                                <div class="progress-bar bg-success" style="width: {{ $percentage }}%"></div>
                                            </div>
                                            <small class="text-muted">{{ $percentage }}%</small>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="bi bi-person-workspace text-muted fs-1 d-block mb-3"></i>
                            <p class="text-muted">لا يوجد مدربون نشطون في هذه الفترة</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="row">
        <div class="col-lg-8 mb-4">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">تحليل الإيرادات</h6>
                </div>
                <div class="card-body">
                    <div class="chart-container" style="position: relative; height: 300px;">
                        <canvas id="revenueChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 mb-4">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">توزيع التسجيلات</h6>
                </div>
                <div class="card-body">
                    <div class="chart-container" style="position: relative; height: 300px;">
                        <canvas id="enrollmentsChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
function exportReports() {
    // هنا يمكن إضافة منطق تصدير التقارير
    alert('سيتم إضافة ميزة التصدير قريباً');
}

// Revenue Chart
const revenueCtx = document.getElementById('revenueChart').getContext('2d');
const revenueChart = new Chart(revenueCtx, {
    type: 'line',
    data: {
        labels: ['يناير', 'فبراير', 'مارس', 'أبريل', 'مايو', 'يونيو'],
        datasets: [{
            label: 'الإيرادات',
            data: [12000, 19000, 15000, 25000, 22000, 30000],
            borderColor: 'rgb(75, 192, 192)',
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            tension: 0.1
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'top',
            }
        },
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

// Enrollments Chart
const enrollmentsCtx = document.getElementById('enrollmentsChart').getContext('2d');
const enrollmentsChart = new Chart(enrollmentsCtx, {
    type: 'doughnut',
    data: {
        labels: ['طلاب', 'مدربون', 'مشرفون'],
        datasets: [{
            data: [70, 20, 10],
            backgroundColor: [
                'rgba(255, 99, 132, 0.8)',
                'rgba(54, 162, 235, 0.8)',
                'rgba(255, 205, 86, 0.8)'
            ],
            borderWidth: 2
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom',
            }
        }
    }
});
</script>

<style>
.border-left-primary {
    border-left: 0.25rem solid #4e73df !important;
}

.border-left-success {
    border-left: 0.25rem solid #1cc88a !important;
}

.border-left-info {
    border-left: 0.25rem solid #36b9cc !important;
}

.border-left-warning {
    border-left: 0.25rem solid #f6c23e !important;
}

.text-gray-300 {
    color: #dddfeb !important;
}

.text-gray-800 {
    color: #5a5c69 !important;
}

.text-xs {
    font-size: 0.7rem;
}

.font-weight-bold {
    font-weight: 700 !important;
}

.text-uppercase {
    text-transform: uppercase !important;
}

.progress {
    background-color: #eaecf4;
    border-radius: 0.35rem;
}

.progress-bar {
    background-color: #4e73df;
    border-radius: 0.35rem;
}

.chart-container {
    position: relative;
    margin: auto;
}

.card {
    border: none;
    box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15) !important;
}

.card-header {
    background-color: #f8f9fc;
    border-bottom: 1px solid #e3e6f0;
}

.table th {
    font-weight: 600;
    color: #5a5c69;
    border-bottom: 2px solid #e3e6f0;
}

.table td {
    vertical-align: middle;
    border-bottom: 1px solid #f8f9fc;
}

.badge {
    font-size: 0.75rem;
    padding: 0.375rem 0.75rem;
}
</style>
@endsection 