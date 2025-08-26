@extends('layouts.student')

@section('title', 'دوراتي - لوحة الطالب')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header" style="margin-bottom: 30px;">
        <h1 style="font-size: 2rem; color: #1f2937; margin-bottom: 10px;">دوراتي</h1>
        <p style="color: #6b7280;">استكشف الدورات المسجل بها وتابع تقدمك</p>
    </div>

    <!-- Filters -->
    <div class="filters-section" style="background: white; padding: 20px; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); margin-bottom: 30px;">
        <form method="GET" action="{{ route('student.courses') }}" style="display: flex; gap: 15px; align-items: end; flex-wrap: wrap;">
            <!-- Status Filter -->
            <div style="flex: 1; min-width: 200px;">
                <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">حالة الدورة</label>
                <select name="status" style="width: 100%; padding: 12px; border: 2px solid #e5e7eb; border-radius: 10px; font-size: 1rem;">
                    <option value="">جميع الحالات</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>قيد التقدم</option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>مكتمل</option>
                    <option value="paused" {{ request('status') == 'paused' ? 'selected' : '' }}>متوقف مؤقتاً</option>
                </select>
            </div>

            <!-- Search -->
            <div style="flex: 1; min-width: 200px;">
                <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">البحث</label>
                <input type="text" name="search" value="{{ request('search') }}" 
                       placeholder="ابحث في الدورات..."
                       style="width: 100%; padding: 12px; border: 2px solid #e5e7eb; border-radius: 10px; font-size: 1rem;">
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit" class="btn btn-primary" style="padding: 12px 20px; border-radius: 10px;">
                    <i class="bi bi-search"></i>
                    بحث
                </button>
            </div>
        </form>
    </div>

    <!-- Courses Grid -->
    @if($enrollments->count() > 0)
        <div class="courses-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(350px, 1fr)); gap: 20px;">
            @foreach($enrollments as $enrollment)
                <div class="course-card" style="background: white; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); overflow: hidden; transition: transform 0.3s ease;">
                    <div style="position: relative;">
                        <!-- Course Image -->
                        <img src="{{ $enrollment->course->featured_image ? asset('storage/' . $enrollment->course->featured_image) : 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80' }}" 
                             alt="{{ $enrollment->course->title_ar }}" 
                             style="width: 100%; height: 200px; object-fit: cover;">
                        
                        <!-- Progress Badge -->
                        <div style="position: absolute; top: 15px; right: 15px; background: rgba(0,0,0,0.8); color: white; padding: 6px 12px; border-radius: 20px; font-size: 0.8rem;">
                            {{ $enrollment->progress_percentage }}% مكتمل
                        </div>
                        
                        <!-- Status Badge -->
                        <div style="position: absolute; top: 15px; left: 15px; padding: 6px 12px; border-radius: 20px; font-size: 0.8rem; font-weight: 500;">
                            @if($enrollment->status == 'completed')
                                <span style="background: #10b981; color: white;">مكتمل</span>
                            @elseif($enrollment->status == 'active')
                                <span style="background: #3b82f6; color: white;">قيد التقدم</span>
                            @elseif($enrollment->status == 'paused')
                                <span style="background: #f59e0b; color: white;">متوقف مؤقتاً</span>
                            @else
                                <span style="background: #6b7280; color: white;">غير محدد</span>
                            @endif
                        </div>
                    </div>

                    <div style="padding: 20px;">
                        <!-- Course Info -->
                        <div style="margin-bottom: 15px;">
                            <h3 style="font-size: 1.2rem; margin-bottom: 8px; color: #1f2937; line-height: 1.4;">{{ $enrollment->course->title_ar }}</h3>
                            <p style="color: #6b7280; font-size: 0.9rem; margin-bottom: 10px;">{{ $enrollment->course->instructor->name }}</p>
                            <div style="color: #10b981; font-size: 0.8rem; font-weight: 500;">
                                {{ $enrollment->course->category->name_ar ?? 'غير محدد' }}
                            </div>
                        </div>

                        <!-- Progress Bar -->
                        <div style="margin-bottom: 15px;">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 5px;">
                                <span style="font-size: 0.9rem; color: #6b7280;">التقدم</span>
                                <span style="font-size: 0.9rem; color: #10b981; font-weight: 600;">{{ $enrollment->progress_percentage }}%</span>
                            </div>
                            <div style="width: 100%; height: 8px; background: #e5e7eb; border-radius: 4px; overflow: hidden;">
                                <div style="width: {{ $enrollment->progress_percentage }}%; height: 100%; background: #10b981; border-radius: 4px;"></div>
                            </div>
                        </div>

                        <!-- Course Details -->
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; font-size: 0.8rem; color: #6b7280;">
                            <div>
                                <i class="bi bi-play-circle"></i>
                                {{ $enrollment->lessons_completed }} درس مكتمل
                            </div>
                            <div>
                                <i class="bi bi-clock"></i>
                                {{ $enrollment->total_hours_watched ?? 0 }} ساعة
                            </div>
                            <div>
                                <i class="bi bi-calendar"></i>
                                {{ $enrollment->created_at->format('Y-m-d') }}
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div style="display: flex; gap: 10px;">
                            <a href="{{ route('student.courses.show', $enrollment->course) }}" 
                               class="btn btn-primary" 
                               style="flex: 1; padding: 12px; font-size: 0.9rem; border-radius: 10px; text-align: center; text-decoration: none; display: inline-block;">
                                <i class="bi bi-play-circle"></i>
                                استمر في التعلم
                            </a>
                            @if($enrollment->status == 'completed')
                                <a href="{{ route('student.certificates.download', $enrollment->course) }}" 
                                   class="btn btn-outline" 
                                   style="padding: 12px; font-size: 0.9rem; border-radius: 10px; text-align: center; text-decoration: none; display: inline-block; border: 2px solid #10b981; color: #10b981;">
                                    <i class="bi bi-award"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @if($enrollments->hasPages())
            <div style="margin-top: 40px; display: flex; justify-content: center;">
                {{ $enrollments->appends(request()->query())->links() }}
            </div>
        @endif
    @else
        <!-- Empty State -->
        <div style="text-align: center; padding: 60px 20px;">
            <div style="width: 80px; height: 80px; background: #f3f4f6; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; color: #9ca3af; font-size: 2rem;">
                <i class="bi bi-book"></i>
            </div>
            <h3 style="font-size: 1.5rem; color: #374151; margin-bottom: 10px;">لا توجد دورات مسجل بها</h3>
            <p style="color: #6b7280; margin-bottom: 30px;">ابدأ بتسجيل الدخول في الدورات لرؤية دوراتك هنا</p>
            <a href="{{ route('courses') }}" class="btn btn-primary" style="padding: 12px 24px; border-radius: 10px;">
                استكشف الدورات المتاحة
            </a>
        </div>
    @endif
</div>

<style>
.course-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
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

.btn-outline {
    background: transparent;
    border: 2px solid #10b981;
    color: #10b981;
}

.btn-outline:hover {
    background: #10b981;
    color: white;
}

@media (max-width: 768px) {
    .filters-section form {
        flex-direction: column;
    }
    
    .courses-grid {
        grid-template-columns: 1fr;
    }
    
    .course-card .btn {
        flex-direction: column;
        gap: 10px;
    }
}
</style>
@endsection 