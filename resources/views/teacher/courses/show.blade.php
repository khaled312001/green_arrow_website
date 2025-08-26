@extends('layouts.teacher')

@section('title', $course->title_ar)

@section('content')
<div class="dashboard-container">
    <!-- Page Header -->
    <div class="page-header">
        <div>
            <h1 style="font-size: 2rem; color: #1f2937; margin-bottom: 5px;">{{ $course->title_ar }}</h1>
            <p style="color: #6b7280; margin: 0;">تفاصيل الدورة والإحصائيات</p>
        </div>
        <div style="display: flex; gap: 15px;">
            <a href="{{ route('teacher.courses.edit', $course) }}" class="btn btn-primary">
                <i class="bi bi-pencil"></i>
                تعديل الدورة
            </a>
            <a href="{{ route('teacher.courses.index') }}" class="btn btn-outline">
                <i class="bi bi-arrow-left"></i>
                العودة للدورات
            </a>
        </div>
    </div>

    <!-- Course Stats -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 30px;">
        <div style="background: white; padding: 25px; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); text-align: center;">
            <div style="font-size: 2.5rem; font-weight: 700; color: #10b981; margin-bottom: 10px;">{{ $course->enrollments->count() }}</div>
            <div style="color: #6b7280; font-size: 1rem;">إجمالي الطلاب</div>
        </div>
        
        <div style="background: white; padding: 25px; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); text-align: center;">
            <div style="font-size: 2.5rem; font-weight: 700; color: #3b82f6; margin-bottom: 10px;">{{ $course->lessons->count() }}</div>
            <div style="color: #6b7280; font-size: 1rem;">عدد الدروس</div>
        </div>
        
        <div style="background: white; padding: 25px; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); text-align: center;">
            <div style="font-size: 2.5rem; font-weight: 700; color: #f59e0b; margin-bottom: 10px;">{{ number_format($course->price, 0) }}</div>
            <div style="color: #6b7280; font-size: 1rem;">السعر (ريال)</div>
        </div>
        
        <div style="background: white; padding: 25px; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); text-align: center;">
            <div style="font-size: 2.5rem; font-weight: 700; color: #8b5cf6; margin-bottom: 10px;">{{ $course->average_rating ?? 0 }}/5</div>
            <div style="color: #6b7280; font-size: 1rem;">متوسط التقييم</div>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 30px;">
        <!-- Course Details -->
        <div style="background: white; padding: 30px; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
            <h2 style="font-size: 1.5rem; color: #1f2937; margin-bottom: 20px;">تفاصيل الدورة</h2>
            
            <!-- Course Image -->
            @if($course->featured_image)
            <div style="margin-bottom: 25px;">
                <img src="{{ asset('storage/' . $course->featured_image) }}" 
                     alt="{{ $course->title_ar }}"
                     style="width: 100%; height: 300px; object-fit: cover; border-radius: 10px;">
            </div>
            @endif

            <!-- Course Info -->
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 25px;">
                <div>
                    <label style="display: block; margin-bottom: 5px; color: #374151; font-weight: 500;">القسم</label>
                    <span style="color: #6b7280;">{{ $course->category->name_ar }}</span>
                </div>
                
                <div>
                    <label style="display: block; margin-bottom: 5px; color: #374151; font-weight: 500;">المستوى</label>
                    <span style="color: #6b7280;">{{ ucfirst($course->level) }}</span>
                </div>
                
                <div>
                    <label style="display: block; margin-bottom: 5px; color: #374151; font-weight: 500;">المدة</label>
                    <span style="color: #6b7280;">{{ $course->duration }} ساعة</span>
                </div>
                
                <div>
                    <label style="display: block; margin-bottom: 5px; color: #374151; font-weight: 500;">الحالة</label>
                    @if($course->status == 'published')
                        <span style="background: #10b981; color: white; padding: 4px 8px; border-radius: 12px; font-size: 0.8rem;">منشور</span>
                    @elseif($course->status == 'draft')
                        <span style="background: #f59e0b; color: white; padding: 4px 8px; border-radius: 12px; font-size: 0.8rem;">مسودة</span>
                    @else
                        <span style="background: #6b7280; color: white; padding: 4px 8px; border-radius: 12px; font-size: 0.8rem;">مؤرشف</span>
                    @endif
                </div>
            </div>

            <!-- Description -->
            <div style="margin-bottom: 25px;">
                <label style="display: block; margin-bottom: 10px; color: #374151; font-weight: 500;">وصف الدورة</label>
                <p style="color: #6b7280; line-height: 1.6;">{{ $course->description_ar }}</p>
            </div>

            <!-- Lessons -->
            <div>
                <h3 style="font-size: 1.3rem; color: #1f2937; margin-bottom: 15px;">دروس الدورة</h3>
                @if($course->lessons->count() > 0)
                    <div style="display: flex; flex-direction: column; gap: 10px;">
                        @foreach($course->lessons->sortBy('order') as $lesson)
                        <div style="display: flex; justify-content: space-between; align-items: center; padding: 15px; background: #f9fafb; border-radius: 8px;">
                            <div>
                                <div style="font-weight: 500; color: #1f2937;">{{ $lesson->title_ar }}</div>
                                <div style="font-size: 0.9rem; color: #6b7280;">{{ $lesson->duration }} دقيقة</div>
                            </div>
                            <div style="display: flex; gap: 10px;">
                                <a href="{{ route('teacher.lessons.edit', $lesson) }}" class="btn btn-sm btn-outline">
                                    <i class="bi bi-pencil"></i>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <p style="color: #6b7280; text-align: center; padding: 20px;">لا توجد دروس لهذه الدورة بعد</p>
                @endif
                
                <div style="margin-top: 20px;">
                    <a href="{{ route('teacher.lessons.create') }}?course_id={{ $course->id }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i>
                        إضافة درس جديد
                    </a>
                </div>
            </div>
        </div>

        <!-- Recent Students -->
        <div style="background: white; padding: 30px; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
            <h2 style="font-size: 1.5rem; color: #1f2937; margin-bottom: 20px;">آخر الطلاب المسجلين</h2>
            
            @if($course->enrollments->count() > 0)
                <div style="display: flex; flex-direction: column; gap: 15px;">
                    @foreach($course->enrollments->take(10) as $enrollment)
                    <div style="display: flex; align-items: center; gap: 15px; padding: 15px; background: #f9fafb; border-radius: 8px;">
                        <div style="width: 40px; height: 40px; background: #10b981; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 600;">
                            {{ substr($enrollment->user->name, 0, 1) }}
                        </div>
                        <div style="flex: 1;">
                            <div style="font-weight: 500; color: #1f2937;">{{ $enrollment->user->name }}</div>
                            <div style="font-size: 0.9rem; color: #6b7280;">{{ $enrollment->enrolled_at->format('Y/m/d') }}</div>
                        </div>
                        <div>
                            @if($enrollment->status == 'active')
                                <span style="background: #10b981; color: white; padding: 2px 6px; border-radius: 8px; font-size: 0.7rem;">نشط</span>
                            @elseif($enrollment->status == 'completed')
                                <span style="background: #3b82f6; color: white; padding: 2px 6px; border-radius: 8px; font-size: 0.7rem;">مكتمل</span>
                            @else
                                <span style="background: #6b7280; color: white; padding: 2px 6px; border-radius: 8px; font-size: 0.7rem;">ملغي</span>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <div style="margin-top: 20px; text-align: center;">
                    <a href="{{ route('teacher.students.index') }}?course_id={{ $course->id }}" class="btn btn-outline">
                        عرض جميع الطلاب
                    </a>
                </div>
            @else
                <p style="color: #6b7280; text-align: center; padding: 20px;">لا يوجد طلاب مسجلين في هذه الدورة</p>
            @endif
        </div>
    </div>
</div>
@endsection 