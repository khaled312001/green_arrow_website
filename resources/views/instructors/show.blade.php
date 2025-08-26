@extends('layouts.app')

@section('title', $instructor->name . ' - أكاديمية السهم الأخضر')

@section('content')
<div class="container" style="max-width: 1200px; margin: 0 auto; padding: 20px;">
    <!-- Instructor Header -->
    <div style="background: white; border-radius: 15px; padding: 30px; margin-bottom: 30px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
        <div style="display: flex; align-items: center; gap: 30px; margin-bottom: 25px;">
            <img src="{{ $instructor->avatar_url }}" 
                 alt="{{ $instructor->name }}" 
                 style="width: 120px; height: 120px; border-radius: 50%; object-fit: cover;">
            <div style="flex: 1;">
                <h1 style="font-size: 2.2rem; color: #1f2937; margin-bottom: 10px;">{{ $instructor->name }}</h1>
                <p style="color: #6b7280; font-size: 1.1rem; margin-bottom: 15px;">{{ $instructor->speciality ?? 'مدرب محترف' }}</p>
                
                <!-- Rating -->
                <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 15px;">
                    <div style="display: flex; align-items: center; gap: 5px;">
                        @for($i = 1; $i <= 5; $i++)
                        <i class="bi bi-star{{ $i <= ($instructor->average_rating ?? 4) ? '-fill' : '' }}" style="color: #fbbf24; font-size: 1.1rem;"></i>
                        @endfor
                        <span style="font-size: 1rem; color: #6b7280; margin-left: 5px;">{{ number_format($instructor->average_rating ?? 4, 1) }}</span>
                    </div>
                    <span style="color: #6b7280;">•</span>
                    <span style="color: #6b7280;">{{ $instructor->reviews_count ?? 0 }} تقييم</span>
                </div>

                <!-- Stats -->
                <div style="display: flex; gap: 30px;">
                    <div style="text-align: center;">
                        <div style="font-size: 1.5rem; font-weight: 700; color: #10b981;">{{ $stats['total_courses'] }}</div>
                        <div style="font-size: 0.9rem; color: #6b7280;">دورة</div>
                    </div>
                    <div style="text-align: center;">
                        <div style="font-size: 1.5rem; font-weight: 700; color: #3b82f6;">{{ $stats['total_students'] }}</div>
                        <div style="font-size: 0.9rem; color: #6b7280;">طالب</div>
                    </div>
                    <div style="text-align: center;">
                        <div style="font-size: 1.5rem; font-weight: 700; color: #f59e0b;">{{ number_format($stats['average_rating'], 1) }}</div>
                        <div style="font-size: 0.9rem; color: #6b7280;">متوسط التقييم</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bio -->
        @if($instructor->bio)
        <div style="border-top: 1px solid #e5e7eb; padding-top: 25px;">
            <h3 style="font-size: 1.3rem; color: #1f2937; margin-bottom: 15px;">نبذة عن المدرب</h3>
            <p style="color: #4b5563; line-height: 1.8; font-size: 1.1rem;">{{ $instructor->bio }}</p>
        </div>
        @endif
    </div>

    <!-- Courses Section -->
    <div style="background: white; border-radius: 15px; padding: 30px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
            <h2 style="font-size: 1.8rem; color: #1f2937;">دورات {{ $instructor->name }}</h2>
            <span style="color: #6b7280;">{{ $courses->total() }} دورة</span>
        </div>

        @if($courses->count() > 0)
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(350px, 1fr)); gap: 25px;">
            @foreach($courses as $course)
            <div class="course-card" style="border: 1px solid #e5e7eb; border-radius: 12px; overflow: hidden; transition: transform 0.3s ease;">
                <div style="position: relative;">
                    <img src="{{ $course->featured_image ? asset('storage/' . $course->featured_image) : 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80' }}" 
                         alt="{{ $course->title_ar }}" 
                         style="width: 100%; height: 200px; object-fit: cover;">
                    
                    @if($course->discount_percentage > 0)
                    <div style="position: absolute; top: 15px; right: 15px; background: #ef4444; color: white; padding: 5px 10px; border-radius: 20px; font-size: 0.8rem; font-weight: 600;">
                        -{{ $course->discount_percentage }}%
                    </div>
                    @endif
                </div>

                <div style="padding: 20px;">
                    <!-- Course Meta -->
                    <div style="display: flex; gap: 15px; margin-bottom: 15px; font-size: 0.9rem; color: #6b7280;">
                        <span><i class="bi bi-clock"></i> {{ $course->duration_hours ?? 0 }} ساعة</span>
                        <span><i class="bi bi-people"></i> {{ $course->students_count }} طالب</span>
                        <span><i class="bi bi-star-fill"></i> {{ number_format($course->rating ?? 4, 1) }}</span>
                    </div>

                    <!-- Course Title -->
                    <h3 style="font-size: 1.2rem; color: #1f2937; margin-bottom: 10px; line-height: 1.4;">
                        <a href="{{ route('courses.show', $course->slug) }}" style="color: inherit; text-decoration: none;">
                            {{ $course->title_ar }}
                        </a>
                    </h3>

                    <!-- Course Description -->
                    <p style="color: #6b7280; line-height: 1.6; margin-bottom: 15px;">
                        {{ Str::limit($course->description_ar, 100) }}
                    </p>

                    <!-- Category -->
                    @if($course->category)
                    <div style="margin-bottom: 15px;">
                        <span style="background: #f3f4f6; color: #374151; padding: 4px 8px; border-radius: 6px; font-size: 0.8rem;">
                            {{ $course->category->name_ar }}
                        </span>
                    </div>
                    @endif

                    <!-- Price -->
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                        <div>
                            @if($course->discount_percentage > 0)
                            <div style="text-decoration: line-through; color: #6b7280; font-size: 0.9rem;">{{ $course->original_price }} ريال</div>
                            @endif
                            <div style="font-size: 1.3rem; font-weight: 700; color: #10b981;">{{ $course->price }} ريال</div>
                        </div>
                        <a href="{{ route('courses.show', $course->slug) }}" 
                           style="background: #10b981; color: white; padding: 8px 16px; border-radius: 8px; text-decoration: none; font-size: 0.9rem; font-weight: 600;">
                            عرض الدورة
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div style="margin-top: 30px; text-align: center;">
            {{ $courses->links() }}
        </div>
        @else
        <div style="text-align: center; padding: 60px 20px;">
            <div style="font-size: 4rem; color: #e5e7eb; margin-bottom: 20px;">
                <i class="bi bi-book"></i>
            </div>
            <h3 style="color: #1f2937; margin-bottom: 10px;">لا توجد دورات</h3>
            <p style="color: #6b7280;">لم ينشر هذا المدرب أي دورات بعد</p>
        </div>
        @endif
    </div>
</div>

<style>
.course-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
}
</style>
@endsection 