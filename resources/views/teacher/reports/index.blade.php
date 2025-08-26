@extends('layouts.teacher')

@section('title', 'التقارير')

@section('content')
<style>
    .reports-container {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        padding: 2rem 0;
    }
    
    .reports-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        overflow: hidden;
        transition: all 0.3s ease;
    }
    
    .reports-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 30px 60px rgba(0, 0, 0, 0.15);
    }
    
    .reports-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 2rem;
        text-align: center;
        color: white;
        position: relative;
        overflow: hidden;
    }
    
    .reports-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/><circle cx="50" cy="10" r="0.5" fill="white" opacity="0.1"/><circle cx="10" cy="60" r="0.5" fill="white" opacity="0.1"/><circle cx="90" cy="40" r="0.5" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
        opacity: 0.3;
    }
    
    .reports-title {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        position: relative;
        z-index: 2;
    }
    
    .reports-subtitle {
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
    
    .reports-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.5rem;
        padding: 2rem;
    }
    
    .report-card {
        background: white;
        padding: 2rem;
        border-radius: 15px;
        text-align: center;
        transition: all 0.3s ease;
        text-decoration: none;
        color: inherit;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(0, 0, 0, 0.05);
        position: relative;
        overflow: hidden;
    }
    
    .report-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(102, 126, 234, 0.1), transparent);
        transition: left 0.5s ease;
    }
    
    .report-card:hover::before {
        left: 100%;
    }
    
    .report-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        text-decoration: none;
        color: inherit;
    }
    
    .report-icon {
        font-size: 3rem;
        margin-bottom: 1rem;
        transition: all 0.3s ease;
    }
    
    .report-card:hover .report-icon {
        transform: scale(1.1);
    }
    
    .report-card:nth-child(1) .report-icon {
        color: #667eea;
    }
    
    .report-card:nth-child(2) .report-icon {
        color: #10b981;
    }
    
    .report-card:nth-child(3) .report-icon {
        color: #f59e0b;
    }
    
    .report-card:nth-child(4) .report-icon {
        color: #ef4444;
    }
    
    .report-title {
        font-size: 1.2rem;
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 0.5rem;
    }
    
    .report-description {
        color: #718096;
        font-size: 0.9rem;
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
    
    @media (max-width: 768px) {
        .reports-container {
            padding: 1rem 0;
        }
        
        .reports-header {
            padding: 1.5rem 1rem;
        }
        
        .reports-title {
            font-size: 1.5rem;
        }
        
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
            padding: 1.5rem;
        }
        
        .reports-grid {
            grid-template-columns: 1fr;
            gap: 1rem;
            padding: 1.5rem;
        }
        
        .chart-section,
        .course-performance {
            margin: 1rem;
            padding: 1.5rem;
        }
    }
</style>

<div class="reports-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="reports-card">
                    <!-- Reports Header -->
                    <div class="reports-header">
                        <h1 class="reports-title">التقارير والتحليلات</h1>
                        <p class="reports-subtitle">مراقبة أداء دوراتك وإحصائيات الطلاب</p>
                    </div>
                    
                    <!-- Statistics Overview -->
                    <div class="stats-grid">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="bi bi-currency-dollar"></i>
                            </div>
                            <div class="stat-number">{{ number_format($monthlyRevenue->sum('total'), 2) }}</div>
                            <div class="stat-label">إجمالي الإيرادات</div>
                        </div>
                        
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="bi bi-graph-up"></i>
                            </div>
                            <div class="stat-number">{{ number_format($monthlyRevenue->avg('total'), 2) }}</div>
                            <div class="stat-label">متوسط شهري</div>
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
                                <i class="bi bi-star"></i>
                            </div>
                            <div class="stat-number">{{ number_format($averageRating ?? 0, 1) }}</div>
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
                        
                        @if(isset($coursePerformance) && $coursePerformance->count() > 0)
                            @foreach($coursePerformance->take(5) as $course)
                                <div class="course-item">
                                    <img src="{{ $course->image ? asset('storage/' . $course->image) : asset('images/default-course.svg') }}" 
                                         alt="{{ $course->title_ar }}" class="course-image">
                                    <div class="course-info">
                                        <div class="course-title">{{ $course->title_ar }}</div>
                                        <div class="course-stats">
                                            {{ $course->enrollments_count }} طالب • 
                                            {{ number_format($course->rating ?? 0, 1) }}/5 تقييم
                                        </div>
                                    </div>
                                    <div class="course-rating">
                                        {{ number_format($course->rating ?? 0, 1) }}/5
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
                    
                    <!-- Detailed Reports -->
                    <div class="reports-grid">
                        <a href="{{ route('teacher.reports.students') }}" class="report-card">
                            <div class="report-icon">
                                <i class="bi bi-people-fill"></i>
                            </div>
                            <h3 class="report-title">تقرير الطلاب</h3>
                            <p class="report-description">إحصائيات الطلاب والتقدم والإنجازات</p>
                        </a>
                        
                        <a href="{{ route('teacher.reports.courses') }}" class="report-card">
                            <div class="report-icon">
                                <i class="bi bi-book-fill"></i>
                            </div>
                            <h3 class="report-title">تقرير الدورات</h3>
                            <p class="report-description">أداء الدورات والتقييمات والإحصائيات</p>
                        </a>
                        
                        <a href="{{ route('teacher.reports.revenue') }}" class="report-card">
                            <div class="report-icon">
                                <i class="bi bi-cash-stack"></i>
                            </div>
                            <h3 class="report-title">تقرير الإيرادات</h3>
                            <p class="report-description">تحليل الإيرادات والمدفوعات والأرباح</p>
                        </a>
                        
                        <a href="{{ route('teacher.analytics.index') }}" class="report-card">
                            <div class="report-icon">
                                <i class="bi bi-bar-chart-fill"></i>
                            </div>
                            <h3 class="report-title">التحليلات المتقدمة</h3>
                            <p class="report-description">تحليلات شاملة ومتقدمة مع الرسوم البيانية</p>
                        </a>
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
            data: [{{ $monthlyRevenue->pluck('total')->implode(',') }}]
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
    
    // Add animation to report cards
    const reportCards = document.querySelectorAll('.report-card');
    reportCards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        
        setTimeout(() => {
            card.style.transition = 'all 0.6s ease';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, 500 + index * 100);
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
});
</script>
@endpush
@endsection 