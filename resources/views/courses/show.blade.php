@extends('layouts.app')

@section('title', $course->title_ar . ' - أكاديمية السهم الأخضر للتدريب')

@section('content')
<!-- Breadcrumb -->
<nav style="margin-bottom: 30px;">
    <ol style="display: flex; list-style: none; gap: 10px; color: #6b7280; font-size: 0.9rem;">
        <li><a href="{{ route('home') }}" style="color: #10b981; text-decoration: none;">الرئيسية</a></li>
        <li><i class="bi bi-chevron-left"></i></li>
        <li><a href="{{ route('courses') }}" style="color: #10b981; text-decoration: none;">الدورات</a></li>
        <li><i class="bi bi-chevron-left"></i></li>
        <li>{{ $course->title_ar }}</li>
    </ol>
</nav>

<!-- Course Header -->
<section class="course-header mb-40">
    <div class="row" style="display: grid; grid-template-columns: 2fr 1fr; gap: 40px;">
        <!-- Course Info -->
        <div class="course-info">
            <div class="card">
                <div class="card-body">
                    <!-- Category and Rating -->
                    <div style="display: flex; align-items: center; gap: 20px; margin-bottom: 20px;">
                        <span style="background: #10b981; color: white; padding: 5px 15px; border-radius: 20px; font-size: 0.9rem;">
                            {{ $course->category->name_ar }}
                        </span>
                        <div style="display: flex; align-items: center; gap: 5px;">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="bi bi-star{{ $i <= $course->rating ? '-fill' : '' }}" style="color: #fbbf24;"></i>
                            @endfor
                            <span style="color: #6b7280; margin-right: 5px;">({{ $reviews ? $reviews->count() : 0 }} تقييم)</span>
                        </div>
                    </div>
                    
                    <!-- Title -->
                    <h1 style="font-size: 2.5rem; margin-bottom: 20px; color: #1f2937; line-height: 1.3;">
                        {{ $course->title_ar }}
                    </h1>
                    
                    <!-- Description -->
                    <p style="font-size: 1.1rem; color: #6b7280; line-height: 1.6; margin-bottom: 30px;">
                        {{ $course->description_ar }}
                    </p>
                    
                    <!-- Course Stats -->
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 20px; margin-bottom: 30px;">
                        <div style="text-align: center; padding: 20px; background: #f8fafc; border-radius: 10px;">
                            <div style="font-size: 1.5rem; font-weight: 700; color: #10b981; margin-bottom: 5px;">{{ $course->duration_hours }}</div>
                            <div style="color: #6b7280; font-size: 0.9rem;">ساعة تدريبية</div>
                        </div>
                        <div style="text-align: center; padding: 20px; background: #f8fafc; border-radius: 10px;">
                            <div style="font-size: 1.5rem; font-weight: 700; color: #10b981; margin-bottom: 5px;">{{ $course->lessons->count() }}</div>
                            <div style="color: #6b7280; font-size: 0.9rem;">درس</div>
                        </div>
                        <div style="text-align: center; padding: 20px; background: #f8fafc; border-radius: 10px;">
                            <div style="font-size: 1.5rem; font-weight: 700; color: #10b981; margin-bottom: 5px;">{{ $course->enrolled_count }}</div>
                            <div style="color: #6b7280; font-size: 0.9rem;">طالب مسجل</div>
                        </div>
                        <div style="text-align: center; padding: 20px; background: #f8fafc; border-radius: 10px;">
                            <div style="font-size: 1.5rem; font-weight: 700; color: #10b981; margin-bottom: 5px;">
                                @switch($course->level)
                                    @case('beginner')
                                        مبتدئ
                                        @break
                                    @case('intermediate')
                                        متوسط
                                        @break
                                    @case('advanced')
                                        متقدم
                                        @break
                                    @default
                                        {{ $course->level }}
                                @endswitch
                            </div>
                            <div style="color: #6b7280; font-size: 0.9rem;">المستوى</div>
                        </div>
                    </div>
                    
                    <!-- Instructor -->
                    <div style="display: flex; align-items: center; gap: 15px; padding: 20px; background: #f8fafc; border-radius: 10px;">
                        <img src="{{ $course->instructor->avatar_url }}" 
                             alt="{{ $course->instructor->name }}" 
                             style="width: 60px; height: 60px; border-radius: 50%; object-fit: cover;">
                        <div>
                            <h4 style="margin-bottom: 5px; color: #1f2937;">{{ $course->instructor->name }}</h4>
                            <p style="color: #6b7280; margin: 0; font-size: 0.9rem;">مدرب الدورة</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Course Enrollment -->
        <div class="course-enrollment">
            <div class="card" style="position: sticky; top: 20px;">
                <div style="position: relative;">
                    <img src="{{ $course->featured_image ? asset('storage/' . $course->featured_image) : 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80' }}" 
                         alt="{{ $course->title_ar }}" 
                         style="width: 100%; height: 200px; object-fit: cover; border-radius: 15px 15px 0 0;">
                    @if($course->discount_price)
                    <div style="position: absolute; top: 15px; left: 15px; background: #ef4444; color: white; padding: 5px 10px; border-radius: 20px; font-size: 0.8rem; font-weight: 600;">
                        -{{ round((($course->price - $course->discount_price) / $course->price) * 100) }}%
                    </div>
                    @endif
                </div>
                <div class="card-body">
                    <div style="text-align: center; margin-bottom: 20px;">
                        @if($course->discount_price)
                        <div style="text-decoration: line-through; color: #6b7280; font-size: 1.1rem;">{{ $course->price }} ريال</div>
                        <div style="font-size: 2rem; font-weight: 700; color: #10b981;">{{ $course->discount_price }} ريال</div>
                        @else
                        <div style="font-size: 2rem; font-weight: 700; color: #10b981;">{{ $course->price }} ريال</div>
                        @endif
                    </div>
                    
                    @auth
                        @if(auth()->user()->isStudent())
                            @if(auth()->user()->enrolledCourses->contains($course->id))
                                <a href="{{ route('student.courses.show', $course) }}" class="btn btn-primary" style="width: 100%; padding: 15px; font-size: 1.1rem;">
                                    <i class="bi bi-play-circle"></i>
                                    استمر في التعلم
                                </a>
                            @else
                                <form action="{{ route('courses.enroll', $course) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary" style="width: 100%; padding: 15px; font-size: 1.1rem;">
                                        <i class="bi bi-cart-plus"></i>
                                        سجل في الدورة
                                    </button>
                                </form>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary" style="width: 100%; padding: 15px; font-size: 1.1rem;">
                                <i class="bi bi-person"></i>
                                سجل دخول للتسجيل
                            </a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary" style="width: 100%; padding: 15px; font-size: 1.1rem;">
                            <i class="bi bi-person"></i>
                            سجل دخول للتسجيل
                        </a>
                    @endauth
                    
                    <div style="margin-top: 20px; padding: 15px; background: #f8fafc; border-radius: 10px;">
                        <h5 style="margin-bottom: 15px; color: #1f2937;">ما ستحصل عليه:</h5>
                        <ul style="list-style: none; padding: 0; margin: 0;">
                            <li style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px; color: #6b7280;">
                                <i class="bi bi-check-circle" style="color: #10b981;"></i>
                                {{ $course->lessons->count() }} درس تفاعلي
                            </li>
                            <li style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px; color: #6b7280;">
                                <i class="bi bi-check-circle" style="color: #10b981;"></i>
                                شهادة إتمام الدورة
                            </li>
                            <li style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px; color: #6b7280;">
                                <i class="bi bi-check-circle" style="color: #10b981;"></i>
                                وصول مدى الحياة
                            </li>
                            <li style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px; color: #6b7280;">
                                <i class="bi bi-check-circle" style="color: #10b981;"></i>
                                دعم فني متواصل
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Course Content -->
<section class="course-content mb-40">
    <div class="row" style="display: grid; grid-template-columns: 2fr 1fr; gap: 40px;">
        <!-- Lessons -->
        <div class="lessons-section">
            <div class="card">
                <div class="card-body">
                    <h2 style="font-size: 1.8rem; margin-bottom: 30px; color: #1f2937;">محتوى الدورة</h2>
                    
                    @if($course->lessons->count() > 0)
                    <div class="lessons-list">
                        @foreach($course->lessons as $index => $lesson)
                        <div class="lesson-item" style="display: flex; align-items: center; gap: 15px; padding: 15px; border: 1px solid #e5e7eb; border-radius: 10px; margin-bottom: 10px;">
                            <div style="width: 40px; height: 40px; background: #10b981; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 600;">
                                {{ $index + 1 }}
                            </div>
                            <div style="flex: 1;">
                                <h4 style="margin-bottom: 5px; color: #1f2937;">{{ $lesson->title_ar }}</h4>
                                <p style="color: #6b7280; margin: 0; font-size: 0.9rem;">{{ $lesson->duration }} دقيقة</p>
                            </div>
                            <div style="color: #6b7280;">
                                <i class="bi bi-play-circle"></i>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div style="text-align: center; padding: 40px; color: #6b7280;">
                        <i class="bi bi-book" style="font-size: 3rem; margin-bottom: 20px; display: block;"></i>
                        <p>سيتم إضافة الدروس قريباً</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        
        <!-- Course Features -->
        <div class="course-features">
            <div class="card">
                <div class="card-body">
                    <h3 style="margin-bottom: 20px; color: #1f2937;">مميزات الدورة</h3>
                    <ul style="list-style: none; padding: 0; margin: 0;">
                        <li style="display: flex; align-items: center; gap: 10px; margin-bottom: 15px; color: #6b7280;">
                            <i class="bi bi-check-circle" style="color: #10b981;"></i>
                            دروس تفاعلية
                        </li>
                        <li style="display: flex; align-items: center; gap: 10px; margin-bottom: 15px; color: #6b7280;">
                            <i class="bi bi-check-circle" style="color: #10b981;"></i>
                            تمارين عملية
                        </li>
                        <li style="display: flex; align-items: center; gap: 10px; margin-bottom: 15px; color: #6b7280;">
                            <i class="bi bi-check-circle" style="color: #10b981;"></i>
                            شهادة معتمدة
                        </li>
                        <li style="display: flex; align-items: center; gap: 10px; margin-bottom: 15px; color: #6b7280;">
                            <i class="bi bi-check-circle" style="color: #10b981;"></i>
                            دعم فني 24/7
                        </li>
                        <li style="display: flex; align-items: center; gap: 10px; margin-bottom: 15px; color: #6b7280;">
                            <i class="bi bi-check-circle" style="color: #10b981;"></i>
                            وصول مدى الحياة
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Instructor Details -->
<section class="instructor-details mb-40">
    <div class="card">
        <div class="card-body">
            <h2 style="font-size: 1.8rem; margin-bottom: 30px; color: #1f2937;">عن المدرب</h2>
            <div style="display: flex; gap: 30px; align-items: flex-start;">
                <img src="{{ $course->instructor->avatar_url }}" 
                     alt="{{ $course->instructor->name }}" 
                     style="width: 120px; height: 120px; border-radius: 50%; object-fit: cover;">
                <div style="flex: 1;">
                    <h3 style="margin-bottom: 10px; color: #1f2937;">{{ $course->instructor->name }}</h3>
                    <p style="color: #6b7280; line-height: 1.6; margin-bottom: 20px;">
                        {{ $course->instructor->bio ?: 'مدرب محترف متخصص في مجال التدريب والتعليم، يمتلك خبرة واسعة في تقديم الدورات التدريبية عالية الجودة.' }}
                    </p>
                    <div style="display: flex; gap: 20px; flex-wrap: wrap;">
                        <div style="text-align: center;">
                            <div style="font-size: 1.5rem; font-weight: 700; color: #10b981;">{{ $course->instructor->teachingCourses->count() }}</div>
                            <div style="color: #6b7280; font-size: 0.9rem;">دورة</div>
                        </div>
                        <div style="text-align: center;">
                            <div style="font-size: 1.5rem; font-weight: 700; color: #10b981;">{{ $course->instructor->teachingCourses->sum('students_count') }}</div>
                            <div style="color: #6b7280; font-size: 0.9rem;">طالب</div>
                        </div>
                        <div style="text-align: center;">
                            <div style="font-size: 1.5rem; font-weight: 700; color: #10b981;">4.8</div>
                            <div style="color: #6b7280; font-size: 0.9rem;">تقييم</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Reviews -->
@if($reviews && $reviews->count() > 0)
<section class="reviews-section mb-40">
    <div class="card">
        <div class="card-body">
            <h2 style="font-size: 1.8rem; margin-bottom: 30px; color: #1f2937;">تقييمات الطلاب</h2>
            
            <!-- Overall Rating -->
            <div style="display: flex; align-items: center; gap: 30px; margin-bottom: 30px; padding: 20px; background: #f8fafc; border-radius: 10px;">
                <div style="text-align: center;">
                    <div style="font-size: 3rem; font-weight: 700; color: #10b981;">{{ number_format($course->rating, 1) }}</div>
                    <div style="display: flex; align-items: center; gap: 5px; justify-content: center; margin: 10px 0;">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="bi bi-star{{ $i <= $course->rating ? '-fill' : '' }}" style="color: #fbbf24;"></i>
                        @endfor
                    </div>
                    <div style="color: #6b7280; font-size: 0.9rem;">{{ $reviews ? $reviews->count() : 0 }} تقييم</div>
                </div>
                <div style="flex: 1;">
                    <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 5px;">
                        <span style="width: 60px; font-size: 0.9rem;">5 نجوم</span>
                        <div style="flex: 1; height: 8px; background: #e5e7eb; border-radius: 4px; overflow: hidden;">
                            <div style="width: 80%; height: 100%; background: #fbbf24;"></div>
                        </div>
                        <span style="width: 40px; text-align: left; font-size: 0.9rem;">80%</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 5px;">
                        <span style="width: 60px; font-size: 0.9rem;">4 نجوم</span>
                        <div style="flex: 1; height: 8px; background: #e5e7eb; border-radius: 4px; overflow: hidden;">
                            <div style="width: 15%; height: 100%; background: #fbbf24;"></div>
                        </div>
                        <span style="width: 40px; text-align: left; font-size: 0.9rem;">15%</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 5px;">
                        <span style="width: 60px; font-size: 0.9rem;">3 نجوم</span>
                        <div style="flex: 1; height: 8px; background: #e5e7eb; border-radius: 4px; overflow: hidden;">
                            <div style="width: 3%; height: 100%; background: #fbbf24;"></div>
                        </div>
                        <span style="width: 40px; text-align: left; font-size: 0.9rem;">3%</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 5px;">
                        <span style="width: 60px; font-size: 0.9rem;">2 نجوم</span>
                        <div style="flex: 1; height: 8px; background: #e5e7eb; border-radius: 4px; overflow: hidden;">
                            <div style="width: 1%; height: 100%; background: #fbbf24;"></div>
                        </div>
                        <span style="width: 40px; text-align: left; font-size: 0.9rem;">1%</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <span style="width: 60px; font-size: 0.9rem;">1 نجمة</span>
                        <div style="flex: 1; height: 8px; background: #e5e7eb; border-radius: 4px; overflow: hidden;">
                            <div style="width: 1%; height: 100%; background: #fbbf24;"></div>
                        </div>
                        <span style="width: 40px; text-align: left; font-size: 0.9rem;">1%</span>
                    </div>
                </div>
            </div>
            
            <!-- Individual Reviews -->
            <div class="reviews-list">
                @foreach($reviews as $review)
                <div class="review-item" style="border-bottom: 1px solid #e5e7eb; padding: 20px 0;">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 10px;">
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <img src="{{ $review->user->avatar_url }}" 
                                 alt="{{ $review->user->name }}" 
                                 style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
                            <div>
                                <h4 style="margin-bottom: 5px; color: #1f2937;">{{ $review->user->name }}</h4>
                                <div style="display: flex; align-items: center; gap: 5px;">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="bi bi-star{{ $i <= $review->rating ? '-fill' : '' }}" style="color: #fbbf24; font-size: 0.8rem;"></i>
                                    @endfor
                                </div>
                            </div>
                        </div>
                        <div style="color: #6b7280; font-size: 0.9rem;">{{ $review->created_at->diffForHumans() }}</div>
                    </div>
                    <p style="color: #6b7280; line-height: 1.6; margin: 0;">{{ $review->comment }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endif

<!-- Related Courses -->
@if($related_courses && $related_courses->count() > 0)
<section class="related-courses mb-60">
    <h2 style="font-size: 2rem; margin-bottom: 30px; color: #1f2937;">دورات ذات صلة</h2>
    <div class="row" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px;">
        @foreach($related_courses as $relatedCourse)
        <div class="card course-card">
            <div style="position: relative;">
                <img src="{{ $relatedCourse->featured_image ? asset('storage/' . $relatedCourse->featured_image) : 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80' }}" 
                     alt="{{ $relatedCourse->title_ar }}" 
                     style="width: 100%; height: 180px; object-fit: cover; border-radius: 15px 15px 0 0;">
            </div>
            <div class="card-body">
                <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 15px; font-size: 0.85rem; color: #6b7280;">
                    <span><i class="bi bi-person"></i> {{ $relatedCourse->instructor->name }}</span>
                    <span><i class="bi bi-clock"></i> {{ $relatedCourse->duration }}</span>
                </div>
                <h3 style="font-size: 1.2rem; margin-bottom: 15px; color: #1f2937; line-height: 1.4;">
                    <a href="{{ route('courses.show', $relatedCourse->slug) }}" style="color: inherit; text-decoration: none;">
                        {{ $relatedCourse->title_ar }}
                    </a>
                </h3>
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <div style="display: flex; align-items: center; gap: 5px;">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="bi bi-star{{ $i <= $relatedCourse->rating ? '-fill' : '' }}" style="color: #fbbf24; font-size: 0.8rem;"></i>
                        @endfor
                        <span style="font-size: 0.8rem; color: #6b7280;">({{ $relatedCourse->reviews_count ?? 0 }})</span>
                    </div>
                    <div style="font-size: 1.1rem; font-weight: 700; color: #10b981;">{{ $relatedCourse->price }} ريال</div>
                </div>
                <a href="{{ route('courses.show', $relatedCourse->slug) }}" class="btn btn-primary" style="width: 100%; margin-top: 15px; padding: 10px;">
                    <i class="bi bi-play-circle"></i>
                    عرض الدورة
                </a>
            </div>
        </div>
        @endforeach
    </div>
</section>
@endif

<style>
.course-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.15);
}

.lesson-item:hover {
    background: #f8fafc;
    border-color: #10b981;
}

@media (max-width: 768px) {
    .row {
        grid-template-columns: 1fr !important;
    }
    
    .course-header h1 {
        font-size: 1.8rem !important;
    }
    
    .instructor-details .card-body > div {
        flex-direction: column;
        text-align: center;
    }
}
</style>
@endsection 