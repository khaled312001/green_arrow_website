@extends('layouts.student')

@section('title', 'لوحة تحكم الطالب')

@section('content')
<div class="dashboard-container">
    <!-- Page Header -->
    <div class="page-header">
        <div>
            <h1 style="font-size: 2rem; color: #1f2937; margin-bottom: 5px;">مرحباً، {{ auth()->user()->name }}</h1>
            <p style="color: #6b7280; margin: 0;">تابع تقدمك التعليمي واستكشف الدورات الجديدة</p>
        </div>
        <div style="display: flex; gap: 15px;">
            <a href="{{ route('courses') }}" class="btn btn-primary">
                <i class="bi bi-search"></i>
                استكشف الدورات
            </a>
            <a href="{{ route('student.progress') }}" class="btn btn-outline">
                <i class="bi bi-graph-up"></i>
                تقدمي
            </a>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="stats-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 40px;">
        <div class="stat-card" style="background: white; padding: 25px; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
            <div style="display: flex; align-items: center; justify-content: space-between;">
                <div>
                    <h3 style="font-size: 2rem; color: #10b981; margin: 0 0 5px 0;">{{ $stats['enrolled_courses'] }}</h3>
                    <p style="color: #6b7280; margin: 0; font-size: 0.9rem;">الدورات المسجل بها</p>
                </div>
                <div style="width: 50px; height: 50px; background: #10b981; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                    <i class="bi bi-book" style="color: white; font-size: 1.5rem;"></i>
                </div>
            </div>
        </div>

        <div class="stat-card" style="background: white; padding: 25px; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
            <div style="display: flex; align-items: center; justify-content: space-between;">
                <div>
                    <h3 style="font-size: 2rem; color: #3b82f6; margin: 0 0 5px 0;">{{ $stats['completed_lessons'] }}</h3>
                    <p style="color: #6b7280; margin: 0; font-size: 0.9rem;">الدروس المكتملة</p>
                </div>
                <div style="width: 50px; height: 50px; background: #3b82f6; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                    <i class="bi bi-check-circle" style="color: white; font-size: 1.5rem;"></i>
                </div>
            </div>
        </div>

        <div class="stat-card" style="background: white; padding: 25px; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
            <div style="display: flex; align-items: center; justify-content: space-between;">
                <div>
                    <h3 style="font-size: 2rem; color: #f59e0b; margin: 0 0 5px 0;">{{ $stats['certificates'] }}</h3>
                    <p style="color: #6b7280; margin: 0; font-size: 0.9rem;">الشهادات المحصل عليها</p>
                </div>
                <div style="width: 50px; height: 50px; background: #f59e0b; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                    <i class="bi bi-award" style="color: white; font-size: 1.5rem;"></i>
                </div>
            </div>
        </div>

        <div class="stat-card" style="background: white; padding: 25px; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
            <div style="display: flex; align-items: center; justify-content: space-between;">
                <div>
                    <h3 style="font-size: 2rem; color: #8b5cf6; margin: 0 0 5px 0;">{{ number_format($stats['total_hours'], 1) }}</h3>
                    <p style="color: #6b7280; margin: 0; font-size: 0.9rem;">ساعات التعلم</p>
                </div>
                <div style="width: 50px; height: 50px; background: #8b5cf6; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                    <i class="bi bi-clock" style="color: white; font-size: 1.5rem;"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Live Lessons Today -->
    @if(isset($today_live_lessons) && $today_live_lessons->count() > 0)
    <section class="live-lessons mb-40">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h2 style="font-size: 1.5rem; color: #1f2937; margin: 0;">المحاضرات المباشرة اليوم</h2>
            <a href="{{ route('student.lessons') }}" style="color: #10b981; text-decoration: none; font-size: 0.9rem;">
                عرض جميع المحاضرات <i class="bi bi-arrow-left"></i>
            </a>
        </div>
        
        <div style="background: white; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); overflow: hidden;">
            @foreach($today_live_lessons as $lesson)
            <div style="display: flex; align-items: center; padding: 20px; border-bottom: 1px solid #f3f4f6;">
                <div style="width: 40px; height: 40px; background: #ef4444; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-left: 15px;">
                    <i class="bi bi-broadcast" style="color: white; font-size: 1rem;"></i>
                </div>
                <div style="flex: 1;">
                    <h4 style="margin: 0 0 5px 0; color: #1f2937;">{{ $lesson->title_ar }}</h4>
                    <p style="margin: 0; color: #6b7280; font-size: 0.9rem;">{{ $lesson->course->title_ar }} - {{ $lesson->course->instructor->name }}</p>
                </div>
                <div style="background: #ef4444; color: white; padding: 8px 15px; border-radius: 20px; font-size: 0.9rem; font-weight: 600;">
                    {{ $lesson->live_session_date->format('H:i') }}
                </div>
            </div>
            @endforeach
        </div>
    </section>
    @endif

    <!-- Current Courses -->
    <section class="current-courses mb-40">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h2 style="font-size: 1.5rem; color: #1f2937; margin: 0;">دوراتي الحالية</h2>
            <a href="{{ route('student.courses') }}" style="color: #10b981; text-decoration: none; font-size: 0.9rem;">
                عرض جميع الدورات <i class="bi bi-arrow-left"></i>
            </a>
        </div>
        
        @if($enrolledCourses && $enrolledCourses->count() > 0)
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 20px;">
            @foreach($enrolledCourses as $enrollment)
            <div style="background: white; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); overflow: hidden;">
                <div style="position: relative; height: 200px; background: linear-gradient(135deg, #10b981, #059669);">
                    <img src="{{ $enrollment->course->thumbnail ? asset('storage/' . $enrollment->course->thumbnail) : 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80' }}" 
                         alt="{{ $enrollment->course->title_ar }}" 
                         style="width: 100%; height: 100%; object-fit: cover;">
                    <div style="position: absolute; top: 15px; right: 15px; background: rgba(0,0,0,0.8); color: white; padding: 8px 15px; border-radius: 20px; font-size: 0.8rem; font-weight: 600;">
                        {{ number_format($enrollment->progress_percentage, 0) }}% مكتمل
                    </div>
                </div>
                <div style="padding: 20px;">
                    <h3 style="margin: 0 0 10px 0; color: #1f2937; font-size: 1.1rem;">{{ $enrollment->course->title_ar }}</h3>
                    <p style="margin: 0 0 15px 0; color: #6b7280; font-size: 0.9rem;">
                        <i class="bi bi-person" style="margin-left: 5px;"></i>
                        {{ $enrollment->course->instructor->name }}
                    </p>
                    
                    <div style="margin-bottom: 20px;">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                            <span style="font-size: 0.9rem; color: #6b7280;">التقدم</span>
                            <span style="font-size: 0.9rem; color: #10b981; font-weight: 600;">{{ number_format($enrollment->progress_percentage, 0) }}%</span>
                        </div>
                        <div style="width: 100%; height: 8px; background: #f3f4f6; border-radius: 4px; overflow: hidden;">
                            <div style="width: {{ $enrollment->progress_percentage }}%; height: 100%; background: linear-gradient(90deg, #10b981, #059669); border-radius: 4px;"></div>
                        </div>
                    </div>
                    
                    <div style="display: flex; gap: 10px;">
                        <a href="{{ route('student.courses.player', $enrollment->course) }}" style="flex: 1; background: #10b981; color: white; text-decoration: none; padding: 12px; border-radius: 8px; text-align: center; font-weight: 600; font-size: 0.9rem;">
                            <i class="bi bi-play-circle" style="margin-left: 5px;"></i>
                            استمر في التعلم
                        </a>
                        <a href="{{ route('student.courses.show', $enrollment->course) }}" style="background: transparent; color: #10b981; border: 2px solid #10b981; text-decoration: none; padding: 12px; border-radius: 8px; text-align: center; font-weight: 600; font-size: 0.9rem;">
                            <i class="bi bi-eye"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div style="background: white; padding: 60px 20px; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); text-align: center;">
            <i class="bi bi-book" style="font-size: 4rem; color: #d1d5db; margin-bottom: 20px;"></i>
            <h3 style="color: #1f2937; margin-bottom: 10px;">لم تسجل في أي دورة بعد</h3>
            <p style="color: #6b7280; margin-bottom: 30px;">ابدأ رحلتك التعليمية من خلال التسجيل في إحدى دوراتنا المتميزة</p>
            <a href="{{ route('courses') }}" style="background: #10b981; color: white; text-decoration: none; padding: 12px 30px; border-radius: 8px; font-weight: 600;">
                <i class="bi bi-search" style="margin-left: 5px;"></i>
                استكشف الدورات
            </a>
        </div>
        @endif
    </section>

    <!-- Recent Activity -->
    <section class="recent-activity mb-40">
        <h2 style="font-size: 1.5rem; color: #1f2937; margin-bottom: 20px;">النشاط الأخير</h2>
        
        @if($recentActivity && $recentActivity->count() > 0)
        <div style="background: white; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); overflow: hidden;">
            @foreach($recentActivity as $activity)
            <div style="display: flex; align-items: center; padding: 20px; border-bottom: 1px solid #f3f4f6;">
                <div style="width: 40px; height: 40px; background: #8b5cf6; border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-left: 15px;">
                    <i class="bi bi-question-circle" style="color: white; font-size: 1.2rem;"></i>
                </div>
                <div style="flex: 1;">
                    <p style="margin: 0 0 5px 0; color: #1f2937;">
                        @if($activity->activity_type == 'quiz_attempted')
                            أخذت اختبار "{{ $activity->quiz->title_ar ?? 'غير محدد' }}"
                        @elseif($activity->activity_type == 'lesson_completed')
                            أكملت درس "{{ $activity->lesson->title_ar ?? 'غير محدد' }}"
                        @else
                            نشاط جديد
                        @endif
                    </p>
                    <small style="color: #6b7280;">
                        @if($activity->activity_type == 'quiz_attempted')
                            في دورة {{ $activity->quiz->course->title_ar ?? 'غير محدد' }}
                        @elseif($activity->activity_type == 'lesson_completed')
                            في دورة {{ $activity->lesson->course->title_ar ?? 'غير محدد' }}
                        @else
                            نشاط في النظام
                        @endif
                    </small>
                </div>
                <div style="color: #6b7280; font-size: 0.9rem;">
                    {{ $activity->activity_date->diffForHumans() }}
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div style="background: white; padding: 60px 20px; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); text-align: center;">
            <i class="bi bi-activity" style="font-size: 4rem; color: #d1d5db; margin-bottom: 20px;"></i>
            <h3 style="color: #1f2937; margin-bottom: 10px;">لا يوجد نشاط حديث</h3>
            <p style="color: #6b7280;">ابدأ التعلم لترى نشاطك هنا</p>
        </div>
        @endif
    </section>

    <!-- Recommended Courses -->
    @if($recommendedCourses && $recommendedCourses->count() > 0)
    <section class="recommended-courses mb-40">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h2 style="font-size: 1.5rem; color: #1f2937; margin: 0;">دورات موصى بها</h2>
            <a href="{{ route('courses') }}" style="color: #10b981; text-decoration: none; font-size: 0.9rem;">
                عرض جميع الدورات <i class="bi bi-arrow-left"></i>
            </a>
        </div>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px;">
            @foreach($recommendedCourses as $course)
            <div style="background: white; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); overflow: hidden;">
                <div style="position: relative; height: 180px;">
                    <img src="{{ $course->thumbnail ? asset('storage/' . $course->thumbnail) : 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80' }}" 
                         alt="{{ $course->title_ar }}" 
                         style="width: 100%; height: 100%; object-fit: cover;">
                    @if($course->discount_price && $course->discount_price < $course->price)
                    <div style="position: absolute; top: 15px; right: 15px; background: #ef4444; color: white; padding: 5px 10px; border-radius: 15px; font-size: 0.8rem; font-weight: 600;">
                        -{{ number_format((($course->price - $course->discount_price) / $course->price) * 100, 0) }}%
                    </div>
                    @endif
                </div>
                <div style="padding: 20px;">
                    <h3 style="margin: 0 0 10px 0; color: #1f2937; font-size: 1.1rem;">{{ $course->title_ar }}</h3>
                    <p style="margin: 0 0 15px 0; color: #6b7280; font-size: 0.9rem;">
                        <i class="bi bi-person" style="margin-left: 5px;"></i>
                        {{ $course->instructor->name }}
                    </p>
                    
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                        <div style="display: flex; align-items: center;">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="bi bi-star{{ $i <= ($course->rating ?? 5) ? '-fill' : '' }}" style="color: #fbbf24; font-size: 0.8rem; margin-left: 2px;"></i>
                            @endfor
                            <span style="font-size: 0.8rem; color: #6b7280; margin-right: 5px;">({{ $course->reviews_count ?? 0 }})</span>
                        </div>
                        <div style="font-size: 1rem; font-weight: 700; color: #10b981;">
                            {{ $course->is_free ? 'مجاني' : number_format($course->discount_price ?? $course->price, 0) . ' ريال' }}
                        </div>
                    </div>
                    
                    <a href="{{ route('courses.show', $course->slug) }}" style="display: block; background: #10b981; color: white; text-decoration: none; padding: 12px; border-radius: 8px; text-align: center; font-weight: 600; font-size: 0.9rem;">
                        <i class="bi bi-eye" style="margin-left: 5px;"></i>
                        عرض الدورة
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    @endif

    <!-- Quick Actions -->
    <section class="quick-actions">
        <h2 style="font-size: 1.5rem; color: #1f2937; margin-bottom: 20px;">إجراءات سريعة</h2>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px;">
            <a href="{{ route('student.courses') }}" style="background: white; padding: 30px 20px; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); text-decoration: none; text-align: center; transition: transform 0.2s;">
                <i class="bi bi-book" style="font-size: 3rem; color: #10b981; margin-bottom: 15px; display: block;"></i>
                <h4 style="color: #1f2937; margin-bottom: 10px;">دوراتي</h4>
                <p style="color: #6b7280; margin: 0; font-size: 0.9rem;">عرض جميع دوراتي والتقدم</p>
            </a>
            
            <a href="{{ route('student.certificates') }}" style="background: white; padding: 30px 20px; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); text-decoration: none; text-align: center; transition: transform 0.2s;">
                <i class="bi bi-award" style="font-size: 3rem; color: #f59e0b; margin-bottom: 15px; display: block;"></i>
                <h4 style="color: #1f2937; margin-bottom: 10px;">شهاداتي</h4>
                <p style="color: #6b7280; margin: 0; font-size: 0.9rem;">عرض الشهادات المحصل عليها</p>
            </a>
            
            <a href="#" style="background: white; padding: 30px 20px; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); text-decoration: none; text-align: center; transition: transform 0.2s;">
                <i class="bi bi-credit-card" style="font-size: 3rem; color: #3b82f6; margin-bottom: 15px; display: block;"></i>
                <h4 style="color: #1f2937; margin-bottom: 10px;">مدفوعاتي</h4>
                <p style="color: #6b7280; margin: 0; font-size: 0.9rem;">عرض سجل المدفوعات</p>
            </a>
            
            <a href="{{ route('student.profile') }}" style="background: white; padding: 30px 20px; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); text-decoration: none; text-align: center; transition: transform 0.2s;">
                <i class="bi bi-person" style="font-size: 3rem; color: #8b5cf6; margin-bottom: 15px; display: block;"></i>
                <h4 style="color: #1f2937; margin-bottom: 10px;">ملفي الشخصي</h4>
                <p style="color: #6b7280; margin: 0; font-size: 0.9rem;">تعديل معلوماتي الشخصية</p>
            </a>
        </div>
    </section>
</div>

<style>
.dashboard-container {
    padding: 30px;
    background: #f9fafb;
    min-height: 100vh;
}

.page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 40px;
    padding: 30px;
    background: white;
    border-radius: 15px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

.btn {
    display: inline-flex;
    align-items: center;
    padding: 12px 20px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    font-size: 0.9rem;
    transition: all 0.2s;
    border: none;
    cursor: pointer;
}

.btn-primary {
    background: #10b981;
    color: white;
}

.btn-primary:hover {
    background: #059669;
    transform: translateY(-2px);
}

.btn-outline {
    background: transparent;
    color: #10b981;
    border: 2px solid #10b981;
}

.btn-outline:hover {
    background: #10b981;
    color: white;
    transform: translateY(-2px);
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 15px rgba(0,0,0,0.1);
    transition: all 0.3s;
}

.quick-actions a:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 15px rgba(0,0,0,0.1);
}

.mb-40 {
    margin-bottom: 40px;
}

@media (max-width: 768px) {
    .dashboard-container {
        padding: 15px;
    }
    
    .page-header {
        flex-direction: column;
        gap: 20px;
        text-align: center;
    }
    
    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .quick-actions {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 480px) {
    .stats-grid {
        grid-template-columns: 1fr;
    }
    
    .quick-actions {
        grid-template-columns: 1fr;
    }
}
</style>
@endsection 