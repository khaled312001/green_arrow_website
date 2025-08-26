@extends('layouts.student')

@section('title', 'تقدمي - لوحة الطالب')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header" style="margin-bottom: 30px;">
        <h1 style="font-size: 2rem; color: #1f2937; margin-bottom: 10px;">تقدمي التعليمي</h1>
        <p style="color: #6b7280;">تابع تقدمك في جميع الدورات والإنجازات</p>
    </div>

    <!-- Statistics Cards -->
    <div class="stats-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 30px;">
        <div class="stat-card" style="background: white; padding: 25px; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
            <div style="display: flex; align-items: center; justify-content: space-between;">
                <div>
                    <div style="font-size: 2rem; font-weight: 700; color: #10b981; margin-bottom: 5px;">{{ $stats['total_courses'] }}</div>
                    <div style="color: #6b7280; font-size: 0.9rem;">إجمالي الدورات</div>
                </div>
                <div style="width: 50px; height: 50px; background: #10b981; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 1.5rem;">
                    <i class="bi bi-book"></i>
                </div>
            </div>
        </div>
        
        <div class="stat-card" style="background: white; padding: 25px; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
            <div style="display: flex; align-items: center; justify-content: space-between;">
                <div>
                    <div style="font-size: 2rem; font-weight: 700; color: #3b82f6; margin-bottom: 5px;">{{ $stats['completed_courses'] }}</div>
                    <div style="color: #6b7280; font-size: 0.9rem;">الدورات المكتملة</div>
                </div>
                <div style="width: 50px; height: 50px; background: #3b82f6; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 1.5rem;">
                    <i class="bi bi-check-circle"></i>
                </div>
            </div>
        </div>
        
        <div class="stat-card" style="background: white; padding: 25px; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
            <div style="display: flex; align-items: center; justify-content: space-between;">
                <div>
                    <div style="font-size: 2rem; font-weight: 700; color: #f59e0b; margin-bottom: 5px;">{{ number_format($stats['average_progress'], 1) }}%</div>
                    <div style="color: #6b7280; font-size: 0.9rem;">متوسط التقدم</div>
                </div>
                <div style="width: 50px; height: 50px; background: #f59e0b; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 1.5rem;">
                    <i class="bi bi-graph-up"></i>
                </div>
            </div>
        </div>
        
        <div class="stat-card" style="background: white; padding: 25px; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
            <div style="display: flex; align-items: center; justify-content: space-between;">
                <div>
                    <div style="font-size: 2rem; font-weight: 700; color: #ef4444; margin-bottom: 5px;">{{ $stats['total_hours_watched'] }}</div>
                    <div style="color: #6b7280; font-size: 0.9rem;">ساعات التعلم</div>
                </div>
                <div style="width: 50px; height: 50px; background: #ef4444; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 1.5rem;">
                    <i class="bi bi-clock"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Course Progress Section -->
    <div class="row">
        <div class="col-12">
            <div class="card" style="background: white; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); margin-bottom: 30px;">
                <div class="card-body" style="padding: 30px;">
                    <h3 style="font-size: 1.5rem; color: #1f2937; margin-bottom: 20px;">تقدم الدورات</h3>
                    
                    @if($course_progress->count() > 0)
                        <div class="course-progress-list">
                            @foreach($course_progress as $enrollment)
                                <div class="course-progress-item" style="border: 1px solid #e5e7eb; border-radius: 10px; padding: 20px; margin-bottom: 15px;">
                                    <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 15px;">
                                        <div style="flex: 1; min-width: 200px;">
                                            <h4 style="font-size: 1.1rem; color: #1f2937; margin-bottom: 5px;">{{ $enrollment->course->title_ar }}</h4>
                                            <p style="color: #6b7280; font-size: 0.9rem; margin-bottom: 10px;">{{ $enrollment->course->instructor->name }}</p>
                                            
                                            <!-- Progress Bar -->
                                            <div style="margin-bottom: 10px;">
                                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 5px;">
                                                    <span style="font-size: 0.9rem; color: #6b7280;">التقدم</span>
                                                    <span style="font-size: 0.9rem; color: #10b981; font-weight: 600;">{{ $enrollment->progress_percentage }}%</span>
                                                </div>
                                                <div style="width: 100%; height: 8px; background: #e5e7eb; border-radius: 4px; overflow: hidden;">
                                                    <div style="width: {{ $enrollment->progress_percentage }}%; height: 100%; background: #10b981; border-radius: 4px;"></div>
                                                </div>
                                            </div>
                                            
                                            <!-- Course Details -->
                                            <div style="display: flex; gap: 20px; font-size: 0.8rem; color: #6b7280;">
                                                <span><i class="bi bi-play-circle"></i> {{ $enrollment->lessons_completed }} درس مكتمل</span>
                                                <span><i class="bi bi-clock"></i> {{ $enrollment->total_hours_watched ?? 0 }} ساعة</span>
                                                <span><i class="bi bi-calendar"></i> {{ $enrollment->created_at->format('Y-m-d') }}</span>
                                            </div>
                                        </div>
                                        
                                        <div style="text-align: center;">
                                            <div style="font-size: 2rem; font-weight: 700; color: #10b981; margin-bottom: 5px;">{{ $enrollment->progress_percentage }}%</div>
                                            <div style="font-size: 0.8rem; color: #6b7280;">
                                                @if($enrollment->status == 'completed')
                                                    <span style="color: #10b981;">مكتمل</span>
                                                @elseif($enrollment->status == 'active')
                                                    <span style="color: #f59e0b;">قيد التقدم</span>
                                                @else
                                                    <span style="color: #6b7280;">غير محدد</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div style="text-align: center; padding: 40px;">
                            <div style="width: 80px; height: 80px; background: #f3f4f6; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; color: #9ca3af; font-size: 2rem;">
                                <i class="bi bi-book"></i>
                            </div>
                            <h4 style="font-size: 1.2rem; color: #374151; margin-bottom: 10px;">لا توجد دورات مسجل بها</h4>
                            <p style="color: #6b7280;">ابدأ بتسجيل الدخول في الدورات لرؤية تقدمك هنا</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Best Performing Courses -->
    @if($best_performing_courses->count() > 0)
        <div class="row">
            <div class="col-12">
                <div class="card" style="background: white; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); margin-bottom: 30px;">
                    <div class="card-body" style="padding: 30px;">
                        <h3 style="font-size: 1.5rem; color: #1f2937; margin-bottom: 20px;">أفضل الدورات أداءً</h3>
                        
                        <div class="best-courses-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px;">
                            @foreach($best_performing_courses as $enrollment)
                                <div class="best-course-card" style="border: 1px solid #e5e7eb; border-radius: 10px; padding: 20px;">
                                    <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 15px;">
                                        <div style="width: 50px; height: 50px; background: #10b981; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 1.5rem;">
                                            <i class="bi bi-trophy"></i>
                                        </div>
                                        <div>
                                            <h4 style="font-size: 1rem; color: #1f2937; margin-bottom: 5px;">{{ $enrollment->course->title_ar }}</h4>
                                            <p style="color: #6b7280; font-size: 0.8rem;">{{ $enrollment->course->category->name_ar ?? 'غير محدد' }}</p>
                                        </div>
                                    </div>
                                    
                                    <div style="text-align: center;">
                                        <div style="font-size: 2rem; font-weight: 700; color: #10b981; margin-bottom: 5px;">{{ $enrollment->progress_percentage }}%</div>
                                        <div style="font-size: 0.9rem; color: #6b7280;">معدل الإنجاز</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Certificates Section -->
    @if($certificates->count() > 0)
        <div class="row">
            <div class="col-12">
                <div class="card" style="background: white; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); margin-bottom: 30px;">
                    <div class="card-body" style="padding: 30px;">
                        <h3 style="font-size: 1.5rem; color: #1f2937; margin-bottom: 20px;">الشهادات المحصل عليها</h3>
                        
                        <div class="certificates-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px;">
                            @foreach($certificates as $certificate)
                                <div class="certificate-card" style="border: 1px solid #e5e7eb; border-radius: 10px; padding: 20px;">
                                    <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 15px;">
                                        <div style="width: 50px; height: 50px; background: #f59e0b; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 1.5rem;">
                                            <i class="bi bi-award"></i>
                                        </div>
                                        <div>
                                            <h4 style="font-size: 1rem; color: #1f2937; margin-bottom: 5px;">{{ $certificate->course->title_ar }}</h4>
                                            <p style="color: #6b7280; font-size: 0.8rem;">{{ $certificate->created_at->format('Y-m-d') }}</p>
                                        </div>
                                    </div>
                                    
                                    <a href="{{ route('student.certificates.download', $certificate) }}" 
                                       class="btn btn-primary" 
                                       style="width: 100%; padding: 10px; font-size: 0.9rem; border-radius: 8px; text-align: center; text-decoration: none; display: inline-block;">
                                        <i class="bi bi-download"></i>
                                        تحميل الشهادة
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

<style>
.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
}

.course-progress-item:hover {
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.best-course-card:hover,
.certificate-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
}

.btn {
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
    font-weight: 500;
}

.btn:hover {
    background: linear-gradient(135deg, #059669, #047857);
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3);
}

@media (max-width: 768px) {
    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .course-progress-item > div {
        flex-direction: column;
        text-align: center;
    }
    
    .best-courses-grid,
    .certificates-grid {
        grid-template-columns: 1fr;
    }
}
</style>
@endsection 