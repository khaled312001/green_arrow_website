@extends('layouts.teacher')

@section('title', 'تفاصيل الدرس')

@section('content')
<div class="dashboard-container">
    <!-- Page Header -->
    <div class="page-header">
        <div>
            <h1 style="font-size: 2rem; color: #1f2937; margin-bottom: 5px;">تفاصيل الدرس</h1>
            <p style="color: #6b7280; margin: 0;">معلومات ومحتوى الدرس</p>
        </div>
        <div style="display: flex; gap: 15px;">
            <a href="{{ route('teacher.courses.lessons.edit', [$course, $lesson]) }}" class="btn btn-primary">
                <i class="bi bi-pencil"></i>
                تعديل الدرس
            </a>
            <a href="{{ route('teacher.courses.lessons.index', $course) }}" class="btn btn-outline">
                <i class="bi bi-arrow-left"></i>
                العودة للدروس
            </a>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 30px;">
        <!-- Main Content -->
        <div>
            <!-- Lesson Information -->
            <div style="background: white; padding: 30px; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); margin-bottom: 30px;">
                <h2 style="font-size: 1.5rem; color: #1f2937; margin-bottom: 25px;">معلومات الدرس</h2>
                
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 25px;">
                    <div>
                        <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">عنوان الدرس (عربي)</label>
                        <span style="color: #1f2937; font-weight: 500;">{{ $lesson->title_ar }}</span>
                    </div>
                    
                    <div>
                        <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">عنوان الدرس (إنجليزي)</label>
                        <span style="color: #1f2937; font-weight: 500;">{{ $lesson->title_en }}</span>
                    </div>
                    
                    <div>
                        <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">ترتيب الدرس</label>
                        <span style="background: #10b981; color: white; padding: 6px 12px; border-radius: 12px; font-size: 0.9rem; font-weight: 600;">{{ $lesson->order }}</span>
                    </div>
                    
                    <div>
                        <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">مدة الدرس</label>
                        <span style="color: #6b7280;">{{ $lesson->duration }} دقيقة</span>
                    </div>
                    
                    <div>
                        <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">نوع المحتوى</label>
                        @switch($lesson->content_type)
                            @case('video')
                                <span style="background: #3b82f6; color: white; padding: 6px 12px; border-radius: 12px; font-size: 0.9rem;">
                                    <i class="bi bi-play-circle"></i> فيديو
                                </span>
                                @break
                            @case('text')
                                <span style="background: #10b981; color: white; padding: 6px 12px; border-radius: 12px; font-size: 0.9rem;">
                                    <i class="bi bi-file-text"></i> نص
                                </span>
                                @break
                            @case('file')
                                <span style="background: #f59e0b; color: white; padding: 6px 12px; border-radius: 12px; font-size: 0.9rem;">
                                    <i class="bi bi-file-earmark"></i> ملف
                                </span>
                                @break
                            @case('link')
                                <span style="background: #8b5cf6; color: white; padding: 6px 12px; border-radius: 12px; font-size: 0.9rem;">
                                    <i class="bi bi-link-45deg"></i> رابط
                                </span>
                                @break
                            @default
                                <span style="background: #6b7280; color: white; padding: 6px 12px; border-radius: 12px; font-size: 0.9rem;">غير محدد</span>
                        @endswitch
                    </div>
                    
                    <div>
                        <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">حالة الدرس</label>
                        @if($lesson->is_free)
                            <span style="background: #10b981; color: white; padding: 6px 12px; border-radius: 12px; font-size: 0.9rem;">مجاني</span>
                        @else
                            <span style="background: #f59e0b; color: white; padding: 6px 12px; border-radius: 12px; font-size: 0.9rem;">مدفوع</span>
                        @endif
                    </div>
                </div>
                
                @if($lesson->description_ar)
                <div style="margin-top: 25px;">
                    <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">وصف الدرس (عربي)</label>
                    <p style="color: #6b7280; line-height: 1.6;">{{ $lesson->description_ar }}</p>
                </div>
                @endif
                
                @if($lesson->description_en)
                <div style="margin-top: 20px;">
                    <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">وصف الدرس (إنجليزي)</label>
                    <p style="color: #6b7280; line-height: 1.6;">{{ $lesson->description_en }}</p>
                </div>
                @endif
            </div>

            <!-- Lesson Content -->
            <div style="background: white; padding: 30px; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                <h2 style="font-size: 1.5rem; color: #1f2937; margin-bottom: 25px;">محتوى الدرس</h2>
                
                @switch($lesson->content_type)
                    @case('video')
                        <div>
                            @if($lesson->video_url)
                                <div style="margin-bottom: 20px;">
                                    <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">رابط الفيديو</label>
                                    <a href="{{ $lesson->video_url }}" target="_blank" style="color: #3b82f6; text-decoration: none; word-break: break-all;">
                                        {{ $lesson->video_url }}
                                    </a>
                                </div>
                            @endif
                            
                            @if($lesson->video_file)
                                <div>
                                    <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">ملف الفيديو</label>
                                    <video controls style="width: 100%; max-width: 600px; border-radius: 8px;">
                                        <source src="{{ asset('storage/' . $lesson->video_file) }}" type="video/mp4">
                                        متصفحك لا يدعم تشغيل الفيديو.
                                    </video>
                                </div>
                            @endif
                        </div>
                        @break
                        
                    @case('text')
                        <div>
                            @if($lesson->text_content_ar)
                                <div style="margin-bottom: 20px;">
                                    <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">محتوى النص (عربي)</label>
                                    <div style="background: #f9fafb; padding: 20px; border-radius: 8px; line-height: 1.6; color: #1f2937;">
                                        {!! nl2br(e($lesson->text_content_ar)) !!}
                                    </div>
                                </div>
                            @endif
                            
                            @if($lesson->text_content_en)
                                <div>
                                    <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">محتوى النص (إنجليزي)</label>
                                    <div style="background: #f9fafb; padding: 20px; border-radius: 8px; line-height: 1.6; color: #1f2937;">
                                        {!! nl2br(e($lesson->text_content_en)) !!}
                                    </div>
                                </div>
                            @endif
                        </div>
                        @break
                        
                    @case('file')
                        @if($lesson->lesson_file)
                            <div>
                                <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">ملف الدرس</label>
                                <a href="{{ asset('storage/' . $lesson->lesson_file) }}" target="_blank" class="btn btn-primary">
                                    <i class="bi bi-download"></i>
                                    تحميل الملف
                                </a>
                            </div>
                        @endif
                        @break
                        
                    @case('link')
                        @if($lesson->lesson_link)
                            <div>
                                <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">رابط الدرس</label>
                                <a href="{{ $lesson->lesson_link }}" target="_blank" class="btn btn-primary">
                                    <i class="bi bi-box-arrow-up-right"></i>
                                    فتح الرابط
                                </a>
                            </div>
                        @endif
                        @break
                        
                    @default
                        <p style="color: #6b7280; text-align: center; padding: 40px;">لا يوجد محتوى لهذا الدرس</p>
                @endswitch
            </div>
        </div>

        <!-- Sidebar -->
        <div>
            <!-- Course Information -->
            <div style="background: white; padding: 25px; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); margin-bottom: 20px;">
                <h3 style="font-size: 1.2rem; color: #1f2937; margin-bottom: 20px;">معلومات الدورة</h3>
                
                <div style="display: flex; flex-direction: column; gap: 15px;">
                    <div>
                        <span style="color: #6b7280; font-size: 0.9rem;">عنوان الدورة:</span>
                        <div style="color: #1f2937; font-weight: 500;">{{ $course->title_ar }}</div>
                    </div>
                    
                    <div>
                        <span style="color: #6b7280; font-size: 0.9rem;">القسم:</span>
                        <div style="color: #1f2937;">{{ $course->category->name_ar }}</div>
                    </div>
                    
                    <div>
                        <span style="color: #6b7280; font-size: 0.9rem;">المستوى:</span>
                        <div style="color: #1f2937;">{{ ucfirst($course->level) }}</div>
                    </div>
                    
                    <div>
                        <span style="color: #6b7280; font-size: 0.9rem;">إجمالي الدروس:</span>
                        <div style="color: #1f2937;">{{ $course->lessons->count() }} درس</div>
                    </div>
                </div>
                
                <div style="margin-top: 20px;">
                    <a href="{{ route('teacher.courses.show', $course) }}" class="btn btn-outline" style="width: 100%;">
                        <i class="bi bi-eye"></i>
                        عرض الدورة
                    </a>
                </div>
            </div>

            <!-- Actions -->
            <div style="background: white; padding: 25px; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                <h3 style="font-size: 1.2rem; color: #1f2937; margin-bottom: 20px;">الإجراءات</h3>
                
                <div style="display: flex; flex-direction: column; gap: 10px;">
                    <a href="{{ route('teacher.courses.lessons.edit', [$course, $lesson]) }}" class="btn btn-primary" style="width: 100%;">
                        <i class="bi bi-pencil"></i>
                        تعديل الدرس
                    </a>
                    
                    <a href="{{ route('teacher.courses.lessons.index', $course) }}" class="btn btn-outline" style="width: 100%;">
                        <i class="bi bi-list"></i>
                        عرض جميع الدروس
                    </a>
                    
                    <form method="POST" action="{{ route('teacher.courses.lessons.destroy', [$course, $lesson]) }}" style="width: 100%;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" style="width: 100%;" onclick="return confirm('هل أنت متأكد من حذف هذا الدرس؟')">
                            <i class="bi bi-trash"></i>
                            حذف الدرس
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 