@extends('layouts.student')

@section('title', 'الدروس - لوحة الطالب')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header" style="margin-bottom: 30px;">
        <h1 style="font-size: 2rem; color: #1f2937; margin-bottom: 10px;">دروسي</h1>
        <p style="color: #6b7280;">استكشف جميع الدروس في الدورات المسجل بها</p>
    </div>

    <!-- Filters -->
    <div class="filters-section" style="background: white; padding: 20px; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); margin-bottom: 30px;">
        <form method="GET" action="{{ route('student.lessons') }}" style="display: flex; gap: 15px; align-items: end; flex-wrap: wrap;">
            <!-- Course Filter -->
            <div style="flex: 1; min-width: 200px;">
                <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">الدورة</label>
                <select name="course_id" style="width: 100%; padding: 12px; border: 2px solid #e5e7eb; border-radius: 10px; font-size: 1rem;">
                    <option value="">جميع الدورات</option>
                    @foreach($enrolled_courses as $course)
                        <option value="{{ $course->id }}" {{ request('course_id') == $course->id ? 'selected' : '' }}>
                            {{ $course->title_ar }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Type Filter -->
            <div style="flex: 1; min-width: 200px;">
                <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">نوع الدرس</label>
                <select name="type" style="width: 100%; padding: 12px; border: 2px solid #e5e7eb; border-radius: 10px; font-size: 1rem;">
                    <option value="">جميع الأنواع</option>
                    <option value="video" {{ request('type') == 'video' ? 'selected' : '' }}>فيديو</option>
                    <option value="document" {{ request('type') == 'document' ? 'selected' : '' }}>مستند</option>
                    <option value="live_session" {{ request('type') == 'live_session' ? 'selected' : '' }}>محاضرة مباشرة</option>
                    <option value="quiz" {{ request('type') == 'quiz' ? 'selected' : '' }}>اختبار</option>
                </select>
            </div>

            <!-- Search -->
            <div style="flex: 1; min-width: 200px;">
                <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">البحث</label>
                <input type="text" name="search" value="{{ request('search') }}" 
                       placeholder="ابحث في الدروس..."
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

    <!-- Lessons Grid -->
    @if($lessons->count() > 0)
        <div class="lessons-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(350px, 1fr)); gap: 20px;">
            @foreach($lessons as $lesson)
                <div class="lesson-card" style="background: white; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); overflow: hidden; transition: transform 0.3s ease;">
                    <div style="position: relative;">
                        <!-- Lesson Type Icon -->
                        <div style="position: absolute; top: 15px; right: 15px; background: rgba(0,0,0,0.8); color: white; padding: 8px 12px; border-radius: 20px; font-size: 0.8rem; z-index: 2;">
                            @switch($lesson->type)
                                @case('video')
                                    <i class="bi bi-play-circle"></i> فيديو
                                    @break
                                @case('document')
                                    <i class="bi bi-file-text"></i> مستند
                                    @break
                                @case('live_session')
                                    <i class="bi bi-camera-video"></i> محاضرة مباشرة
                                    @break
                                @case('quiz')
                                    <i class="bi bi-question-circle"></i> اختبار
                                    @break
                                @default
                                    <i class="bi bi-file-earmark"></i> درس
                            @endswitch
                        </div>

                        <!-- Course Image or Placeholder -->
                        <img src="{{ $lesson->course->featured_image ? asset('storage/' . $lesson->course->featured_image) : 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80' }}" 
                             alt="{{ $lesson->course->title_ar }}" 
                             style="width: 100%; height: 180px; object-fit: cover;">
                    </div>

                    <div style="padding: 20px;">
                        <!-- Course Info -->
                        <div style="margin-bottom: 15px;">
                            <div style="color: #10b981; font-size: 0.9rem; font-weight: 500; margin-bottom: 5px;">
                                {{ $lesson->course->title_ar }}
                            </div>
                            <div style="color: #6b7280; font-size: 0.8rem;">
                                {{ $lesson->course->instructor->name }}
                            </div>
                        </div>

                        <!-- Lesson Title -->
                        <h3 style="font-size: 1.1rem; margin-bottom: 10px; color: #1f2937; line-height: 1.4;">
                            {{ $lesson->title_ar }}
                        </h3>

                        <!-- Lesson Description -->
                        @if($lesson->description)
                            <p style="color: #6b7280; font-size: 0.9rem; margin-bottom: 15px; line-height: 1.5;">
                                {{ Str::limit($lesson->description, 100) }}
                            </p>
                        @endif

                        <!-- Lesson Details -->
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; font-size: 0.8rem; color: #6b7280;">
                            <div>
                                <i class="bi bi-clock"></i>
                                {{ $lesson->duration ? $lesson->duration . ' دقيقة' : 'غير محدد' }}
                            </div>
                            <div>
                                <i class="bi bi-sort-numeric-up"></i>
                                الدرس {{ $lesson->sort_order }}
                            </div>
                        </div>

                        <!-- Action Button -->
                        <a href="{{ route('student.lessons.show', ['course' => $lesson->course, 'lesson' => $lesson]) }}" 
                           class="btn btn-primary" 
                           style="width: 100%; padding: 12px; font-size: 0.9rem; border-radius: 10px; text-align: center; text-decoration: none; display: inline-block;">
                            <i class="bi bi-play-circle"></i>
                            ابدأ الدرس
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @if($lessons->hasPages())
            <div style="margin-top: 40px; display: flex; justify-content: center;">
                {{ $lessons->appends(request()->query())->links() }}
            </div>
        @endif
    @else
        <!-- Empty State -->
        <div style="text-align: center; padding: 60px 20px;">
            <div style="width: 80px; height: 80px; background: #f3f4f6; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; color: #9ca3af; font-size: 2rem;">
                <i class="bi bi-book"></i>
            </div>
            <h3 style="font-size: 1.5rem; color: #374151; margin-bottom: 10px;">لا توجد دروس</h3>
            <p style="color: #6b7280; margin-bottom: 30px;">لم يتم العثور على دروس تطابق معايير البحث</p>
            <a href="{{ route('student.lessons') }}" class="btn btn-primary" style="padding: 12px 24px; border-radius: 10px;">
                عرض جميع الدروس
            </a>
        </div>
    @endif
</div>

<style>
.lesson-card:hover {
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

@media (max-width: 768px) {
    .filters-section form {
        flex-direction: column;
    }
    
    .lessons-grid {
        grid-template-columns: 1fr;
    }
}
</style>
@endsection 