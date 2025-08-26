@extends('layouts.teacher')

@section('title', 'لوحة تحكم المدرب')

@section('content')
<div class="dashboard-container">
    <!-- Page Header -->
    <div class="page-header">
        <div>
            <h1 style="font-size: 2rem; color: #1f2937; margin-bottom: 5px;">مرحباً، {{ auth()->user()->name }}</h1>
            <p style="color: #6b7280; margin: 0;">إدارة دوراتك وطلابك</p>
        </div>
        <div style="display: flex; gap: 15px;">
            <a href="{{ route('teacher.courses.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i>
                إنشاء دورة جديدة
            </a>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="stats-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 40px;">
        <div class="stat-card" style="background: white; padding: 25px; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
            <div style="display: flex; align-items: center; justify-content: space-between;">
                <div>
                    <h3 style="font-size: 2rem; color: #10b981; margin: 0 0 5px 0;">{{ $totalCourses }}</h3>
                    <p style="color: #6b7280; margin: 0; font-size: 0.9rem;">إجمالي الدورات</p>
                </div>
                <div style="width: 50px; height: 50px; background: #10b981; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                    <i class="bi bi-book" style="color: white; font-size: 1.5rem;"></i>
                </div>
            </div>
        </div>

        <div class="stat-card" style="background: white; padding: 25px; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
            <div style="display: flex; align-items: center; justify-content: space-between;">
                <div>
                    <h3 style="font-size: 2rem; color: #3b82f6; margin: 0 0 5px 0;">{{ $totalStudents }}</h3>
                    <p style="color: #6b7280; margin: 0; font-size: 0.9rem;">إجمالي الطلاب</p>
                </div>
                <div style="width: 50px; height: 50px; background: #3b82f6; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                    <i class="bi bi-people" style="color: white; font-size: 1.5rem;"></i>
                </div>
            </div>
        </div>

        <div class="stat-card" style="background: white; padding: 25px; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
            <div style="display: flex; align-items: center; justify-content: space-between;">
                <div>
                    <h3 style="font-size: 2rem; color: #f59e0b; margin: 0 0 5px 0;">{{ $totalRevenue }}</h3>
                    <p style="color: #6b7280; margin: 0; font-size: 0.9rem;">إجمالي الإيرادات</p>
                </div>
                <div style="width: 50px; height: 50px; background: #f59e0b; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                    <i class="bi bi-currency-dollar" style="color: white; font-size: 1.5rem;"></i>
                </div>
            </div>
        </div>

        <div class="stat-card" style="background: white; padding: 25px; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
            <div style="display: flex; align-items: center; justify-content: space-between;">
                <div>
                    <h3 style="font-size: 2rem; color: #8b5cf6; margin: 0 0 5px 0;">{{ $averageRating }}</h3>
                    <p style="color: #6b7280; margin: 0; font-size: 0.9rem;">متوسط التقييم</p>
                </div>
                <div style="width: 50px; height: 50px; background: #8b5cf6; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                    <i class="bi bi-star" style="color: white; font-size: 1.5rem;"></i>
                </div>
            </div>
        </div>

        <div class="stat-card" style="background: white; padding: 25px; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
            <div style="display: flex; align-items: center; justify-content: space-between;">
                <div>
                    <h3 style="font-size: 2rem; color: #ec4899; margin: 0 0 5px 0;">{{ auth()->user()->receivedMessages()->unread()->count() }}</h3>
                    <p style="color: #6b7280; margin: 0; font-size: 0.9rem;">الرسائل الجديدة</p>
                </div>
                <div style="width: 50px; height: 50px; background: #ec4899; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                    <i class="bi bi-chat-dots" style="color: white; font-size: 1.5rem;"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <section class="charts-section mb-40">
        <h2 style="font-size: 1.5rem; color: #1f2937; margin-bottom: 20px;">التحليلات</h2>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); gap: 20px;">
            <div style="background: white; padding: 25px; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                <h3 style="font-size: 1.2rem; color: #1f2937; margin-bottom: 20px;">الإيرادات الشهرية</h3>
                <div style="height: 200px; background: #f9fafb; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #6b7280;">
                    <div style="text-align: center;">
                        <i class="bi bi-graph-up" style="font-size: 2rem; margin-bottom: 10px;"></i>
                        <p>سيتم إضافة الرسم البياني قريباً</p>
                    </div>
                </div>
            </div>

            <div style="background: white; padding: 25px; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                <h3 style="font-size: 1.2rem; color: #1f2937; margin-bottom: 20px;">توزيع الطلاب</h3>
                <div style="height: 200px; background: #f9fafb; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #6b7280;">
                    <div style="text-align: center;">
                        <i class="bi bi-pie-chart" style="font-size: 2rem; margin-bottom: 10px;"></i>
                        <p>سيتم إضافة الرسم البياني قريباً</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- My Courses Section -->
    <section class="my-courses mb-40">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h2 style="font-size: 1.5rem; color: #1f2937;">دوراتي</h2>
            <a href="{{ route('teacher.courses.index') }}" style="color: #10b981; text-decoration: none; font-size: 0.9rem;">عرض جميع الدورات</a>
        </div>

        @if($courses->count() > 0)
        <div class="courses-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 20px;">
            @foreach($courses as $course)
            <div class="course-card" style="background: white; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); overflow: hidden;">
                <div style="position: relative;">
                    <img src="{{ $course->featured_image ? asset('storage/' . $course->featured_image) : 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80' }}"
                         alt="{{ $course->title_ar }}"
                         style="width: 100%; height: 180px; object-fit: cover;">
                    <div style="position: absolute; top: 10px; right: 10px; background: rgba(0,0,0,0.7); color: white; padding: 4px 8px; border-radius: 12px; font-size: 0.8rem;">
                        {{ $course->status == 'published' ? 'منشور' : 'مسودة' }}
                    </div>
                </div>
                <div style="padding: 20px;">
                    <h3 style="font-size: 1.1rem; margin-bottom: 10px; color: #1f2937;">{{ $course->title_ar }}</h3>
                    <p style="color: #6b7280; font-size: 0.9rem; margin-bottom: 15px;">{{ Str::limit($course->description_ar, 80) }}</p>
                    
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; font-size: 0.8rem; color: #6b7280;">
                        <span><i class="bi bi-people"></i> {{ $course->enrollments->count() }} طالب</span>
                        <span><i class="bi bi-star-fill" style="color: #fbbf24;"></i> {{ $course->average_rating ?? 0 }}</span>
                        <span><i class="bi bi-currency-dollar"></i> {{ $course->price }}</span>
                    </div>
                    
                    <div style="display: flex; gap: 10px;">
                        <a href="{{ route('teacher.courses.edit', $course) }}" class="btn btn-outline" style="flex: 1; padding: 10px; font-size: 0.9rem;">
                            <i class="bi bi-pencil"></i>
                            تعديل
                        </a>
                        <a href="{{ route('teacher.courses.show', $course) }}" class="btn btn-primary" style="flex: 1; padding: 10px; font-size: 0.9rem;">
                            <i class="bi bi-eye"></i>
                            عرض
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div style="text-align: center; padding: 60px 20px; background: white; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
            <i class="bi bi-book" style="font-size: 3rem; color: #d1d5db; margin-bottom: 20px;"></i>
            <h3 style="color: #6b7280; margin-bottom: 10px;">لا توجد دورات بعد</h3>
            <p style="color: #9ca3af; margin-bottom: 20px;">ابدأ بإنشاء دورة جديدة لطلابك</p>
            <a href="{{ route('teacher.courses.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i>
                إنشاء دورة جديدة
            </a>
        </div>
        @endif
    </section>

    <!-- Recent Students Section -->
    <section class="recent-students mb-40">
        <h2 style="font-size: 1.5rem; color: #1f2937; margin-bottom: 20px;">آخر الطلاب المسجلين</h2>
        <div style="background: white; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); overflow: hidden;">
            @if($recentStudents->count() > 0)
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead style="background: #f9fafb;">
                        <tr>
                            <th style="padding: 15px; text-align: right; font-weight: 600; color: #374151; border-bottom: 1px solid #e5e7eb;">الطالب</th>
                            <th style="padding: 15px; text-align: right; font-weight: 600; color: #374151; border-bottom: 1px solid #e5e7eb;">الدورة</th>
                            <th style="padding: 15px; text-align: right; font-weight: 600; color: #374151; border-bottom: 1px solid #e5e7eb;">تاريخ التسجيل</th>
                            <th style="padding: 15px; text-align: right; font-weight: 600; color: #374151; border-bottom: 1px solid #e5e7eb;">التقدم</th>
                            <th style="padding: 15px; text-align: right; font-weight: 600; color: #374151; border-bottom: 1px solid #e5e7eb;">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentStudents as $enrollment)
                        <tr style="border-bottom: 1px solid #f3f4f6;">
                            <td style="padding: 15px;">
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    <img src="{{ $enrollment->student->avatar_url }}" 
                                         alt="{{ $enrollment->student->name }}"
                                         style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
                                    <div>
                                        <div style="font-weight: 500; color: #1f2937;">{{ $enrollment->student->name }}</div>
                                        <div style="font-size: 0.8rem; color: #6b7280;">{{ $enrollment->student->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td style="padding: 15px; color: #1f2937;">{{ $enrollment->course->title_ar }}</td>
                            <td style="padding: 15px; color: #6b7280; font-size: 0.9rem;">{{ $enrollment->created_at->format('Y/m/d') }}</td>
                            <td style="padding: 15px;">
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    <div style="width: 60px; height: 6px; background: #e5e7eb; border-radius: 3px; overflow: hidden;">
                                        <div style="width: {{ $enrollment->progress_percentage }}%; height: 100%; background: #10b981; border-radius: 3px;"></div>
                                    </div>
                                    <span style="font-size: 0.8rem; color: #10b981; font-weight: 600;">{{ $enrollment->progress_percentage }}%</span>
                                </div>
                            </td>
                            <td style="padding: 15px;">
                                <a href="{{ route('teacher.students.show', $enrollment->student) }}" class="btn btn-sm btn-outline" style="padding: 5px 10px; font-size: 0.8rem;">
                                    <i class="bi bi-eye"></i>
                                    عرض
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div style="text-align: center; padding: 40px 20px; color: #6b7280;">
                <i class="bi bi-people" style="font-size: 2rem; margin-bottom: 10px;"></i>
                <p>لا يوجد طلاب مسجلين بعد</p>
            </div>
            @endif
        </div>
    </section>

    <!-- Quick Actions -->
    <section class="quick-actions">
        <h2 style="font-size: 1.5rem; color: #1f2937; margin-bottom: 20px;">إجراءات سريعة</h2>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px;">
            <a href="{{ route('teacher.courses.create') }}" class="quick-action-card" style="background: white; padding: 20px; border-radius: 10px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); text-decoration: none; text-align: center; transition: transform 0.2s;">
                <i class="bi bi-plus-circle" style="font-size: 2rem; color: #10b981; margin-bottom: 10px;"></i>
                <h3 style="color: #1f2937; margin-bottom: 5px; font-size: 1rem;">إنشاء دورة</h3>
                <p style="color: #6b7280; font-size: 0.8rem; margin: 0;">إضافة دورة جديدة</p>
            </a>

            <a href="{{ route('teacher.lessons.create') }}" class="quick-action-card" style="background: white; padding: 20px; border-radius: 10px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); text-decoration: none; text-align: center; transition: transform 0.2s;">
                <i class="bi bi-play-circle" style="font-size: 2rem; color: #3b82f6; margin-bottom: 10px;"></i>
                <h3 style="color: #1f2937; margin-bottom: 5px; font-size: 1rem;">إضافة درس</h3>
                <p style="color: #6b7280; font-size: 0.8rem; margin: 0;">إنشاء درس جديد</p>
            </a>

            <a href="{{ route('teacher.students.index') }}" class="quick-action-card" style="background: white; padding: 20px; border-radius: 10px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); text-decoration: none; text-align: center; transition: transform 0.2s;">
                <i class="bi bi-people" style="font-size: 2rem; color: #f59e0b; margin-bottom: 10px;"></i>
                <h3 style="color: #1f2937; margin-bottom: 5px; font-size: 1rem;">إدارة الطلاب</h3>
                <p style="color: #6b7280; font-size: 0.8rem; margin: 0;">عرض جميع الطلاب</p>
            </a>

            <a href="{{ route('teacher.reports.index') }}" class="quick-action-card" style="background: white; padding: 20px; border-radius: 10px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); text-decoration: none; text-align: center; transition: transform 0.2s;">
                <i class="bi bi-graph-up" style="font-size: 2rem; color: #8b5cf6; margin-bottom: 10px;"></i>
                <h3 style="color: #1f2937; margin-bottom: 5px; font-size: 1rem;">التقارير</h3>
                <p style="color: #6b7280; font-size: 0.8rem; margin: 0;">عرض التحليلات</p>
            </a>

            <a href="{{ route('messages.inbox') }}" class="quick-action-card" style="background: white; padding: 20px; border-radius: 10px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); text-decoration: none; text-align: center; transition: transform 0.2s;">
                <i class="bi bi-chat-dots" style="font-size: 2rem; color: #ec4899; margin-bottom: 10px;"></i>
                <h3 style="color: #1f2937; margin-bottom: 5px; font-size: 1rem;">الرسائل</h3>
                <p style="color: #6b7280; font-size: 0.8rem; margin: 0;">عرض الرسائل الجديدة</p>
            </a>
        </div>
    </section>
</div>

<style>
.quick-action-card:hover {
    transform: translateY(-2px);
}

.btn-sm {
    padding: 5px 10px;
    font-size: 0.8rem;
}

.mb-40 {
    margin-bottom: 40px;
}
</style>
@endsection 