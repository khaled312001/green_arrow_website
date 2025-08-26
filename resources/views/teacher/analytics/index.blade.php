@extends('layouts.teacher')

@section('title', 'التحليلات')

@section('content')
<style>
    .analytics-container {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        padding: 2rem 0;
    }
    
    .analytics-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        overflow: hidden;
        transition: all 0.3s ease;
    }
    
    .analytics-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 30px 60px rgba(0, 0, 0, 0.15);
    }
    
    .analytics-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 2rem;
        text-align: center;
        color: white;
        position: relative;
        overflow: hidden;
    }
    
    .analytics-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/><circle cx="50" cy="10" r="0.5" fill="white" opacity="0.1"/><circle cx="10" cy="60" r="0.5" fill="white" opacity="0.1"/><circle cx="90" cy="40" r="0.5" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
        opacity: 0.3;
    }
    
    .analytics-title {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        position: relative;
        z-index: 2;
    }
    
    .analytics-subtitle {
        font-size: 1.1rem;
        opacity: 0.9;
        position: relative;
        z-index: 2;
    }
    
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
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
    
    .stat-icon {
        font-size: 2.5rem;
        margin-bottom: 1rem;
        opacity: 0.9;
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
    
    .chart-section {
        background: white;
        padding: 2rem;
        border-radius: 15px;
        margin: 2rem;
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
        padding-bottom: 0.5rem;
        border-bottom: 2px solid #e2e8f0;
    }
    
    .section-title i {
        color: #667eea;
        font-size: 1.3rem;
    }
    
    .course-performance {
        background: white;
        padding: 2rem;
        border-radius: 15px;
        margin: 2rem;
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
    
    .course-rating {
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        background: #c6f6d5;
        color: #22543d;
    }
    
    .activity-section {
        background: white;
        padding: 2rem;
        border-radius: 15px;
        margin: 2rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(0, 0, 0, 0.05);
    }
    
    .activity-item {
        display: flex;
        align-items: center;
        padding: 1rem;
        border-radius: 10px;
        margin-bottom: 1rem;
        background: #f7fafc;
        transition: all 0.3s ease;
        border: 1px solid #e2e8f0;
    }
    
    .activity-item:hover {
        background: white;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        transform: translateX(5px);
    }
    
    .activity-icon {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.2rem;
        margin-left: 1rem;
    }
    
    .activity-info {
        flex: 1;
    }
    
    .activity-title {
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 0.25rem;
    }
    
    .activity-description {
        font-size: 0.9rem;
        color: #718096;
        margin-bottom: 0.25rem;
    }
    
    .activity-time {
        font-size: 0.8rem;
        color: #a0aec0;
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
    
    .metrics-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
        padding: 2rem;
    }
    
    .metric-card {
        background: white;
        padding: 2rem;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }
    
    .metric-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }
    
    @media (max-width: 768px) {
        .analytics-container {
            padding: 1rem 0;
        }
        
        .analytics-header {
            padding: 1.5rem 1rem;
        }
        
        .analytics-title {
            font-size: 1.5rem;
        }
        
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
            padding: 1.5rem;
        }
        
        .metrics-grid {
            grid-template-columns: 1fr;
            gap: 1rem;
            padding: 1.5rem;
        }
        
        .chart-section,
        .course-performance,
        .activity-section {
            margin: 1rem;
            padding: 1.5rem;
        }
    }
</style>

<div class="analytics-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="analytics-card">
                    <!-- Analytics Header -->
                    <div class="analytics-header">
                        <h1 class="analytics-title">التحليلات المتقدمة</h1>
                        <p class="analytics-subtitle">رؤى شاملة حول أداء دوراتك وطلابك</p>
                    </div>
                    
                    <!-- Statistics Overview -->
                    <div class="stats-grid">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="bi bi-book"></i>
                            </div>
                            <div class="stat-number">{{ $totalCourses ?? 0 }}</div>
                            <div class="stat-label">إجمالي الدورات</div>
                        </div>
                        
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="bi bi-people"></i>
                            </div>
                            <div class="stat-number">{{ $totalStudents ?? 0 }}</div>
                            <div class="stat-label">إجمالي الطلاب</div>
                        </div>
                        
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="bi bi-currency-dollar"></i>
                            </div>
                            <div class="stat-number">{{ number_format($totalRevenue ?? 0, 2) }}</div>
                            <div class="stat-label">إجمالي الإيرادات</div>
                        </div>
                        
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="bi bi-star"></i>
                            </div>
                            <div class="stat-number">{{ number_format($averageRating ?? 0, 1) }}/5</div>
                            <div class="stat-label">متوسط التقييم</div>
                        </div>
                    </div>
                    
                    <!-- Revenue Chart -->
                    <div class="chart-section">
                        <h2 class="section-title">
                            <i class="bi bi-graph-up-arrow"></i>
                            الإيرادات الشهرية
                        </h2>
                        <div id="revenue-chart" style="height: 400px;"></div>
                    </div>
                    
                    <!-- Course Performance -->
                    <div class="course-performance">
                        <h2 class="section-title">
                            <i class="bi bi-trophy"></i>
                            أفضل الدورات أداءً
                        </h2>
                        
                        @if(isset($topCourses) && $topCourses->count() > 0)
                            @foreach($topCourses as $course)
                                <div class="course-item">
                                    <img src="{{ $course->image ? asset('storage/' . $course->image) : asset('images/default-course.svg') }}" 
                                         alt="{{ $course->title_ar }}" class="course-image">
                                    <div class="course-info">
                                        <div class="course-title">{{ $course->title_ar }}</div>
                                        <div class="course-stats">
                                            {{ $course->enrollments_count }} طالب • 
                                            {{ number_format(round($course->rating ?? 0, 1), 1) }}/5 تقييم
                                        </div>
                                    </div>
                                    <div class="course-rating">
                                        {{ number_format(round($course->rating ?? 0, 1), 1) }}/5
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="empty-state">
                                <i class="bi bi-book"></i>
                                <h4>لا توجد دورات متاحة للعرض</h4>
                                <p>ابدأ بإنشاء دوراتك الأولى لرؤية الإحصائيات</p>
                                <a href="{{ route('teacher.courses.create') }}" class="btn btn-primary">
                                    <i class="bi bi-plus-lg"></i>
                                    إنشاء دورة جديدة
                                </a>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Additional Metrics -->
                    <div class="metrics-grid">
                        <!-- Student Engagement -->
                        <div class="metric-card">
                            <h3 class="section-title">
                                <i class="bi bi-people-fill"></i>
                                معدل مشاركة الطلاب
                            </h3>
                            <div id="engagement-chart" style="height: 300px;"></div>
                        </div>
                        
                        <!-- Recent Activity -->
                        <div class="metric-card">
                            <h3 class="section-title">
                                <i class="bi bi-activity"></i>
                                النشاط الأخير
                            </h3>
                            
                            @if(isset($recentActivity) && $recentActivity->count() > 0)
                                @foreach($recentActivity as $activity)
                                    <div class="activity-item">
                                        <div class="activity-icon">
                                            <i class="bi bi-person"></i>
                                        </div>
                                        <div class="activity-info">
                                            <div class="activity-title">{{ $activity->student->name ?? 'طالب' }}</div>
                                            <div class="activity-description">{{ $activity->description ?? 'نشاط جديد' }}</div>
                                            <div class="activity-time">{{ $activity->created_at->diffForHumans() }}</div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="empty-state">
                                    <i class="bi bi-activity"></i>
                                    <h4>لا يوجد نشاط حديث</h4>
                                    <p>سيظهر هنا النشاط الأخير للطلاب</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Enhanced Revenue Chart
    var revenueOptions = {
        series: [{
            name: 'الإيرادات',
            data: [{{ isset($monthlyRevenue) ? $monthlyRevenue->pluck('total')->implode(',') : '0,0,0,0,0,0,0,0,0,0,0,0' }}]
        }],
        chart: {
            type: 'area',
            height: 400,
            toolbar: {
                show: false
            },
            animations: {
                enabled: true,
                easing: 'easeinout',
                speed: 800,
                animateGradually: {
                    enabled: true,
                    delay: 150
                },
                dynamicAnimation: {
                    enabled: true,
                    speed: 350
                }
            }
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'smooth',
            width: 3,
            colors: ['#667eea']
        },
        colors: ['#667eea'],
        fill: {
            type: 'gradient',
            gradient: {
                shadeIntensity: 1,
                opacityFrom: 0.7,
                opacityTo: 0.2,
                stops: [0, 90, 100]
            }
        },
        xaxis: {
            categories: ['يناير', 'فبراير', 'مارس', 'أبريل', 'مايو', 'يونيو', 'يوليو', 'أغسطس', 'سبتمبر', 'أكتوبر', 'نوفمبر', 'ديسمبر'],
            labels: {
                style: {
                    colors: '#718096',
                    fontSize: '12px',
                    fontFamily: 'Tajawal, sans-serif'
                }
            }
        },
        yaxis: {
            labels: {
                style: {
                    colors: '#718096',
                    fontSize: '12px',
                    fontFamily: 'Tajawal, sans-serif'
                },
                formatter: function (val) {
                    return val.toFixed(0) + ' ريال';
                }
            }
        },
        tooltip: {
            theme: 'dark',
            style: {
                fontSize: '12px',
                fontFamily: 'Tajawal, sans-serif'
            },
            y: {
                formatter: function (val) {
                    return val.toFixed(2) + ' ريال';
                }
            }
        },
        grid: {
            borderColor: '#e2e8f0',
            strokeDashArray: 5,
            xaxis: {
                lines: {
                    show: true
                }
            },
            yaxis: {
                lines: {
                    show: true
                }
            }
        },
        markers: {
            size: 6,
            colors: ['#667eea'],
            strokeColors: '#ffffff',
            strokeWidth: 2,
            hover: {
                size: 8
            }
        }
    };

    var revenueChart = new ApexCharts(document.querySelector("#revenue-chart"), revenueOptions);
    revenueChart.render();

    // Enhanced Engagement Chart
    var engagementOptions = {
        series: [{{ isset($engagementData) ? $engagementData->pluck('percentage')->implode(',') : '70,80,65,90,75' }}],
        chart: {
            type: 'radialBar',
            height: 300,
            animations: {
                enabled: true,
                easing: 'easeinout',
                speed: 800
            }
        },
        plotOptions: {
            radialBar: {
                startAngle: -135,
                endAngle: 135,
                hollow: {
                    size: '70%',
                    background: 'transparent',
                    dropShadow: {
                        enabled: true,
                        top: 3,
                        left: 0,
                        blur: 4,
                        opacity: 0.24
                    }
                },
                track: {
                    background: '#e2e8f0',
                    strokeWidth: '97%',
                    margin: 5,
                    dropShadow: {
                        enabled: true,
                        top: 2,
                        left: 0,
                        blur: 4,
                        opacity: 0.15
                    }
                },
                dataLabels: {
                    name: {
                        show: true,
                        fontSize: '16px',
                        fontFamily: 'Tajawal, sans-serif',
                        color: '#2d3748',
                        offsetY: -10
                    },
                    value: {
                        show: true,
                        fontSize: '30px',
                        fontFamily: 'Tajawal, sans-serif',
                        color: '#667eea',
                        formatter: function (val) {
                            return val + '%';
                        }
                    }
                }
            }
        },
        fill: {
            type: 'gradient',
            gradient: {
                shade: 'dark',
                type: 'horizontal',
                shadeIntensity: 0.5,
                gradientToColors: ['#667eea'],
                inverseColors: true,
                opacityFrom: 1,
                opacityTo: 1,
                stops: [0, 100]
            }
        },
        stroke: {
            lineCap: 'round'
        },
        labels: ['معدل المشاركة'],
        colors: ['#667eea']
    };

    var engagementChart = new ApexCharts(document.querySelector("#engagement-chart"), engagementOptions);
    engagementChart.render();
    
    // Add animation to stat cards
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
    
    // Add animation to metric cards
    const metricCards = document.querySelectorAll('.metric-card');
    metricCards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        
        setTimeout(() => {
            card.style.transition = 'all 0.6s ease';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, 500 + index * 200);
    });
    
    // Add animation to course items
    const courseItems = document.querySelectorAll('.course-item');
    courseItems.forEach((item, index) => {
        item.style.opacity = '0';
        item.style.transform = 'translateX(20px)';
        
        setTimeout(() => {
            item.style.transition = 'all 0.6s ease';
            item.style.opacity = '1';
            item.style.transform = 'translateX(0)';
        }, 800 + index * 100);
    });
    
    // Add animation to activity items
    const activityItems = document.querySelectorAll('.activity-item');
    activityItems.forEach((item, index) => {
        item.style.opacity = '0';
        item.style.transform = 'translateX(20px)';
        
        setTimeout(() => {
            item.style.transition = 'all 0.6s ease';
            item.style.opacity = '1';
            item.style.transform = 'translateX(0)';
        }, 1000 + index * 100);
    });
});
</script>
@endpush
@endsection 