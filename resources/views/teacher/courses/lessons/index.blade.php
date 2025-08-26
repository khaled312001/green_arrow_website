@extends('layouts.teacher')

@section('title', 'دروس الدورة')

@section('content')
<div class="dashboard-container">
    <!-- Page Header -->
    <div class="page-header">
        <div>
            <h1 style="font-size: 2rem; color: #1f2937; margin-bottom: 5px;">دروس الدورة</h1>
            <p style="color: #6b7280; margin: 0;">إدارة دروس دورة "{{ $course->title_ar }}"</p>
        </div>
        <div style="display: flex; gap: 15px;">
            <a href="{{ route('teacher.courses.lessons.create', $course) }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i>
                إضافة درس جديد
            </a>
            <a href="{{ route('teacher.courses.show', $course) }}" class="btn btn-outline">
                <i class="bi bi-arrow-left"></i>
                العودة للدورة
            </a>
        </div>
    </div>

    <!-- Course Info -->
    <div style="background: white; padding: 25px; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); margin-bottom: 30px;">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px;">
            <div>
                <span style="color: #6b7280; font-size: 0.9rem;">عنوان الدورة:</span>
                <div style="font-weight: 600; color: #1f2937;">{{ $course->title_ar }}</div>
            </div>
            <div>
                <span style="color: #6b7280; font-size: 0.9rem;">القسم:</span>
                <div style="font-weight: 600; color: #1f2937;">{{ $course->category->name_ar }}</div>
            </div>
            <div>
                <span style="color: #6b7280; font-size: 0.9rem;">عدد الدروس:</span>
                <div style="font-weight: 600; color: #1f2937;">{{ $lessons->count() }} درس</div>
            </div>
            <div>
                <span style="color: #6b7280; font-size: 0.9rem;">إجمالي المدة:</span>
                <div style="font-weight: 600; color: #1f2937;">{{ $lessons->sum('duration') }} دقيقة</div>
            </div>
        </div>
    </div>

    <!-- Lessons List -->
    @if($lessons->count() > 0)
    <div style="background: white; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); overflow: hidden;">
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead style="background: #f9fafb;">
                    <tr>
                        <th style="padding: 15px; text-align: right; font-weight: 600; color: #374151; border-bottom: 1px solid #e5e7eb;">الترتيب</th>
                        <th style="padding: 15px; text-align: right; font-weight: 600; color: #374151; border-bottom: 1px solid #e5e7eb;">عنوان الدرس</th>
                        <th style="padding: 15px; text-align: right; font-weight: 600; color: #374151; border-bottom: 1px solid #e5e7eb;">نوع المحتوى</th>
                        <th style="padding: 15px; text-align: right; font-weight: 600; color: #374151; border-bottom: 1px solid #e5e7eb;">المدة</th>
                        <th style="padding: 15px; text-align: right; font-weight: 600; color: #374151; border-bottom: 1px solid #e5e7eb;">الحالة</th>
                        <th style="padding: 15px; text-align: right; font-weight: 600; color: #374151; border-bottom: 1px solid #e5e7eb;">الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($lessons->sortBy('order') as $lesson)
                    <tr style="border-bottom: 1px solid #f3f4f6;">
                        <td style="padding: 15px; text-align: center;">
                            <span style="background: #10b981; color: white; padding: 4px 8px; border-radius: 12px; font-size: 0.9rem; font-weight: 600;">
                                {{ $lesson->order }}
                            </span>
                        </td>
                        <td style="padding: 15px;">
                            <div>
                                <div style="font-weight: 500; color: #1f2937; margin-bottom: 5px;">{{ $lesson->title_ar }}</div>
                                <div style="font-size: 0.9rem; color: #6b7280;">{{ Str::limit($lesson->description_ar, 50) }}</div>
                            </div>
                        </td>
                        <td style="padding: 15px;">
                            @switch($lesson->content_type)
                                @case('video')
                                    <span style="background: #3b82f6; color: white; padding: 4px 8px; border-radius: 12px; font-size: 0.8rem;">
                                        <i class="bi bi-play-circle"></i> فيديو
                                    </span>
                                    @break
                                @case('text')
                                    <span style="background: #10b981; color: white; padding: 4px 8px; border-radius: 12px; font-size: 0.8rem;">
                                        <i class="bi bi-file-text"></i> نص
                                    </span>
                                    @break
                                @case('file')
                                    <span style="background: #f59e0b; color: white; padding: 4px 8px; border-radius: 12px; font-size: 0.8rem;">
                                        <i class="bi bi-file-earmark"></i> ملف
                                    </span>
                                    @break
                                @case('link')
                                    <span style="background: #8b5cf6; color: white; padding: 4px 8px; border-radius: 12px; font-size: 0.8rem;">
                                        <i class="bi bi-link-45deg"></i> رابط
                                    </span>
                                    @break
                                @default
                                    <span style="background: #6b7280; color: white; padding: 4px 8px; border-radius: 12px; font-size: 0.8rem;">
                                        غير محدد
                                    </span>
                            @endswitch
                        </td>
                        <td style="padding: 15px; color: #6b7280;">
                            {{ $lesson->duration }} دقيقة
                        </td>
                        <td style="padding: 15px;">
                            @if($lesson->is_free)
                                <span style="background: #10b981; color: white; padding: 4px 8px; border-radius: 12px; font-size: 0.8rem;">مجاني</span>
                            @else
                                <span style="background: #f59e0b; color: white; padding: 4px 8px; border-radius: 12px; font-size: 0.8rem;">مدفوع</span>
                            @endif
                        </td>
                        <td style="padding: 15px;">
                            <div style="display: flex; gap: 8px;">
                                <a href="{{ route('teacher.courses.lessons.show', [$course, $lesson]) }}" class="btn btn-sm btn-outline">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('teacher.courses.lessons.edit', [$course, $lesson]) }}" class="btn btn-sm btn-primary">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form method="POST" action="{{ route('teacher.courses.lessons.destroy', [$course, $lesson]) }}" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('هل أنت متأكد من حذف هذا الدرس؟')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Reorder Lessons -->
    <div style="background: white; padding: 25px; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); margin-top: 30px;">
        <h3 style="font-size: 1.2rem; color: #1f2937; margin-bottom: 20px;">إعادة ترتيب الدروس</h3>
        <p style="color: #6b7280; margin-bottom: 20px;">اسحب وأفلت الدروس لإعادة ترتيبها</p>
        
        <div id="lessons-sortable" style="display: flex; flex-direction: column; gap: 10px;">
            @foreach($lessons->sortBy('order') as $lesson)
            <div class="lesson-item" data-lesson-id="{{ $lesson->id }}" style="display: flex; align-items: center; gap: 15px; padding: 15px; background: #f9fafb; border-radius: 8px; cursor: move;">
                <i class="bi bi-grip-vertical" style="color: #6b7280; font-size: 1.2rem;"></i>
                <span style="background: #10b981; color: white; padding: 4px 8px; border-radius: 12px; font-size: 0.9rem; font-weight: 600; min-width: 30px; text-align: center;">
                    {{ $lesson->order }}
                </span>
                <div style="flex: 1;">
                    <div style="font-weight: 500; color: #1f2937;">{{ $lesson->title_ar }}</div>
                    <div style="font-size: 0.9rem; color: #6b7280;">{{ $lesson->duration }} دقيقة</div>
                </div>
            </div>
            @endforeach
        </div>
        
        <button id="save-order" class="btn btn-primary" style="margin-top: 20px;">
            <i class="bi bi-check-circle"></i>
            حفظ الترتيب
        </button>
    </div>
    @else
    <div style="background: white; padding: 60px; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); text-align: center;">
        <i class="bi bi-book" style="font-size: 4rem; color: #d1d5db; margin-bottom: 20px; display: block;"></i>
        <h3 style="font-size: 1.5rem; color: #374151; margin-bottom: 10px;">لا توجد دروس</h3>
        <p style="color: #6b7280; margin-bottom: 30px;">لم يتم إضافة أي دروس لهذه الدورة بعد</p>
        <a href="{{ route('teacher.courses.lessons.create', $course) }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i>
            إضافة أول درس
        </a>
    </div>
    @endif
</div>

@if($lessons->count() > 0)
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const sortableContainer = document.getElementById('lessons-sortable');
    const saveButton = document.getElementById('save-order');
    
    if (sortableContainer) {
        const sortable = new Sortable(sortableContainer, {
            animation: 150,
            ghostClass: 'sortable-ghost',
            chosenClass: 'sortable-chosen',
            dragClass: 'sortable-drag',
            onEnd: function() {
                // Update order numbers visually
                const items = sortableContainer.querySelectorAll('.lesson-item');
                items.forEach((item, index) => {
                    const orderSpan = item.querySelector('span');
                    if (orderSpan) {
                        orderSpan.textContent = index + 1;
                    }
                });
            }
        });
        
        saveButton.addEventListener('click', function() {
            const items = sortableContainer.querySelectorAll('.lesson-item');
            const orderData = Array.from(items).map((item, index) => ({
                id: item.dataset.lessonId,
                order: index + 1
            }));
            
            fetch('{{ route("teacher.courses.lessons.reorder", $course) }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ lessons: orderData })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show success message
                    alert('تم حفظ الترتيب بنجاح');
                    // Reload page to reflect changes
                    window.location.reload();
                } else {
                    alert('حدث خطأ أثناء حفظ الترتيب');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('حدث خطأ أثناء حفظ الترتيب');
            });
        });
    }
});
</script>
@endif
@endsection 