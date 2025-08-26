@extends('layouts.admin')

@section('title', 'لوحة الإدارة')

@section('content')
<div class="admin-dashboard">
    <!-- Header -->
    <div class="dashboard-header">
        <h1>لوحة الإدارة</h1>
        <p>مرحباً بك في لوحة تحكم أكاديمية السهم الأخضر</p>
    </div>

    <!-- Statistics Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon">
                <i class="bi bi-people"></i>
            </div>
            <div class="stat-content">
                <h3>{{ number_format($totalUsers) }}</h3>
                <p>إجمالي المستخدمين</p>
                <small class="text-success">+{{ $userGrowth }}% هذا الشهر</small>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">
                <i class="bi bi-book"></i>
            </div>
            <div class="stat-content">
                <h3>{{ number_format($totalCourses) }}</h3>
                <p>إجمالي الدورات</p>
                <small class="text-success">+{{ $courseGrowth }}% هذا الشهر</small>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">
                <i class="bi bi-currency-dollar"></i>
            </div>
            <div class="stat-content">
                <h3>{{ number_format($totalRevenue) }} ريال</h3>
                <p>إجمالي الإيرادات</p>
                <small class="text-success">+{{ $revenueGrowth }}% هذا الشهر</small>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">
                <i class="bi bi-graph-up"></i>
            </div>
            <div class="stat-content">
                <h3>{{ number_format($totalEnrollments) }}</h3>
                <p>إجمالي التسجيلات</p>
                <small class="text-success">+{{ $enrollmentGrowth }}% هذا الشهر</small>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="charts-row">
        <div class="chart-card">
            <h3>الإيرادات الشهرية</h3>
            <canvas id="revenueChart" width="400" height="200"></canvas>
        </div>

        <div class="chart-card">
            <h3>التسجيلات الشهرية</h3>
            <canvas id="enrollmentChart" width="400" height="200"></canvas>
        </div>
    </div>

    <!-- Recent Activities -->
    <div class="activities-row">
        <div class="activity-card">
            <h3>آخر التسجيلات</h3>
            <div class="activity-list">
                @forelse($recent_enrollments as $enrollment)
                <div class="activity-item">
                    <div class="activity-icon">
                        <i class="bi bi-person-plus"></i>
                    </div>
                    <div class="activity-content">
                        <p><strong>{{ $enrollment->student->name }}</strong> سجل في <strong>{{ $enrollment->course->title_ar }}</strong></p>
                        <small>{{ $enrollment->created_at->diffForHumans() }}</small>
                    </div>
                </div>
                @empty
                <p class="text-muted">لا توجد تسجيلات حديثة</p>
                @endforelse
            </div>
        </div>

        <div class="activity-card">
            <h3>آخر المدفوعات</h3>
            <div class="activity-list">
                @forelse($recent_payments as $payment)
                <div class="activity-item">
                    <div class="activity-icon">
                        <i class="bi bi-credit-card"></i>
                    </div>
                    <div class="activity-content">
                        <p><strong>{{ $payment->student->name }}</strong> دفع <strong>{{ $payment->total_amount }} ريال</strong></p>
                        <small>{{ $payment->created_at->diffForHumans() }}</small>
                    </div>
                </div>
                @empty
                <p class="text-muted">لا توجد مدفوعات حديثة</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Top Courses -->
    <div class="top-courses">
        <h3>أفضل الدورات</h3>
        <div class="courses-grid">
            @forelse($topCourses as $course)
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
                    <h4>{{ $course->title_ar }}</h4>
                    <p>{{ $course->category->name_ar }}</p>
                    <div class="course-stats">
                        <span><i class="bi bi-people"></i> {{ $course->enrollments_count ?? 0 }}</span>
                        <span><i class="bi bi-star"></i> {{ number_format($course->rating ?? 0, 1) }}</span>
                    </div>
                </div>
            </div>
            @empty
            <p class="text-muted">لا توجد دورات متاحة</p>
            @endforelse
        </div>
    </div>

    <!-- Notifications -->
    <div class="notifications-section">
        <h3>الإشعارات</h3>
        <div class="notifications-list">
            @foreach($notifications as $notification)
            <div class="notification-item notification-{{ $notification->type }}">
                <div class="notification-icon">
                    <i class="bi bi-{{ $notification->icon }}"></i>
                </div>
                <div class="notification-content">
                    <h4>{{ $notification->title }}</h4>
                    <p>{{ $notification->message }}</p>
                    <small>{{ $notification->created_at->diffForHumans() }}</small>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<style>
.admin-dashboard {
    padding: 20px;
    max-width: 1400px;
    margin: 0 auto;
}

.dashboard-header {
    text-align: center;
    margin-bottom: 30px;
    padding: 20px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border-radius: 15px;
}

.dashboard-header h1 {
    margin: 0;
    font-size: 2.5rem;
    font-weight: 700;
}

.dashboard-header p {
    margin: 10px 0 0 0;
    opacity: 0.9;
    font-size: 1.1rem;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

.stat-card {
    background: white;
    padding: 25px;
    border-radius: 15px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    display: flex;
    align-items: center;
    transition: transform 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-5px);
}

.stat-icon {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 20px;
    color: white;
    font-size: 1.5rem;
}

.stat-content h3 {
    margin: 0;
    font-size: 2rem;
    font-weight: 700;
    color: #1f2937;
}

.stat-content p {
    margin: 5px 0;
    color: #6b7280;
    font-weight: 500;
}

.stat-content small {
    font-weight: 600;
}

.charts-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

.chart-card {
    background: white;
    padding: 25px;
    border-radius: 15px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.chart-card h3 {
    margin: 0 0 20px 0;
    color: #1f2937;
    font-weight: 600;
}

.activities-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

.activity-card {
    background: white;
    padding: 25px;
    border-radius: 15px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.activity-card h3 {
    margin: 0 0 20px 0;
    color: #1f2937;
    font-weight: 600;
}

.activity-item {
    display: flex;
    align-items: center;
    padding: 15px 0;
    border-bottom: 1px solid #f3f4f6;
}

.activity-item:last-child {
    border-bottom: none;
}

.activity-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: #f3f4f6;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 15px;
    color: #6b7280;
}

.activity-content p {
    margin: 0;
    color: #374151;
    font-weight: 500;
}

.activity-content small {
    color: #9ca3af;
}

.top-courses {
    background: white;
    padding: 25px;
    border-radius: 15px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    margin-bottom: 30px;
}

.top-courses h3 {
    margin: 0 0 20px 0;
    color: #1f2937;
    font-weight: 600;
}

.courses-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
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

.course-content h4 {
    margin: 0 0 5px 0;
    color: #1f2937;
    font-weight: 600;
}

.course-content p {
    margin: 0 0 10px 0;
    color: #6b7280;
    font-size: 0.9rem;
}

.course-stats {
    display: flex;
    gap: 15px;
    font-size: 0.8rem;
    color: #9ca3af;
}

.course-stats span {
    display: flex;
    align-items: center;
    gap: 5px;
}

.notifications-section {
    background: white;
    padding: 25px;
    border-radius: 15px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.notifications-section h3 {
    margin: 0 0 20px 0;
    color: #1f2937;
    font-weight: 600;
}

.notification-item {
    display: flex;
    align-items: center;
    padding: 15px;
    border-radius: 10px;
    margin-bottom: 10px;
    border-left: 4px solid;
}

.notification-success {
    background: #f0fdf4;
    border-left-color: #10b981;
}

.notification-info {
    background: #eff6ff;
    border-left-color: #3b82f6;
}

.notification-warning {
    background: #fffbeb;
    border-left-color: #f59e0b;
}

.notification-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 15px;
    font-size: 1.2rem;
}

.notification-success .notification-icon {
    background: #10b981;
    color: white;
}

.notification-info .notification-icon {
    background: #3b82f6;
    color: white;
}

.notification-warning .notification-icon {
    background: #f59e0b;
    color: white;
}

.notification-content h4 {
    margin: 0 0 5px 0;
    color: #1f2937;
    font-weight: 600;
}

.notification-content p {
    margin: 0 0 5px 0;
    color: #6b7280;
}

.notification-content small {
    color: #9ca3af;
    font-size: 0.8rem;
}

@media (max-width: 768px) {
    .stats-grid {
        grid-template-columns: 1fr;
    }
    
    .charts-row {
        grid-template-columns: 1fr;
    }
    
    .activities-row {
        grid-template-columns: 1fr;
    }
    
    .courses-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Revenue Chart
    const revenueCtx = document.getElementById('revenueChart').getContext('2d');
    new Chart(revenueCtx, {
        type: 'line',
        data: {
            labels: ['يناير', 'فبراير', 'مارس', 'أبريل', 'مايو', 'يونيو', 'يوليو', 'أغسطس'],
            datasets: [{
                label: 'الإيرادات',
                data: [12000, 19000, 15000, 25000, 22000, 30000, 28000, 35000],
                borderColor: '#667eea',
                backgroundColor: 'rgba(102, 126, 234, 0.1)',
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Enrollment Chart
    const enrollmentCtx = document.getElementById('enrollmentChart').getContext('2d');
    new Chart(enrollmentCtx, {
        type: 'bar',
        data: {
            labels: ['يناير', 'فبراير', 'مارس', 'أبريل', 'مايو', 'يونيو', 'يوليو', 'أغسطس'],
            datasets: [{
                label: 'التسجيلات',
                data: [65, 89, 80, 81, 56, 55, 40, 85],
                backgroundColor: '#764ba2'
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
});
</script>
@endsection 