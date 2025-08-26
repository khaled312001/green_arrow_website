@extends('layouts.teacher')

@section('title', 'دوراتي')

@section('content')
<div class="dashboard-container">
    <!-- Page Header -->
    <div class="page-header">
        <div>
            <h1 style="font-size: 2rem; color: #1f2937; margin-bottom: 5px;">دوراتي</h1>
            <p style="color: #6b7280; margin: 0;">إدارة جميع دوراتك</p>
        </div>
        <div style="display: flex; gap: 15px;">
            <a href="{{ route('teacher.courses.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i>
                إنشاء دورة جديدة
            </a>
        </div>
    </div>

    <!-- Filters and Search -->
    <div style="background: white; padding: 20px; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); margin-bottom: 30px;">
        <form method="GET" action="{{ route('teacher.courses.index') }}" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; align-items: end;">
            <div>
                <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">البحث</label>
                <input type="text" name="search" value="{{ request('search') }}" 
                       placeholder="البحث في عنوان الدورة..."
                       style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 0.9rem;">
            </div>
            
            <div>
                <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">الحالة</label>
                <select name="status" style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 0.9rem;">
                    <option value="">جميع الحالات</option>
                    <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>مسودة</option>
                    <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>منشور</option>
                    <option value="archived" {{ request('status') == 'archived' ? 'selected' : '' }}>مؤرشف</option>
                </select>
            </div>
            
            <div>
                <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">القسم</label>
                <select name="category_id" style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 0.9rem;">
                    <option value="">جميع الأقسام</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name_ar }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div>
                <button type="submit" class="btn btn-primary" style="width: 100%;">
                    <i class="bi bi-search"></i>
                    بحث
                </button>
            </div>
        </form>
    </div>

    <!-- Courses Grid -->
    @if($courses->count() > 0)
    <div class="courses-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 25px;">
        @foreach($courses as $course)
        <div class="course-card" style="background: white; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); overflow: hidden; transition: transform 0.3s ease;">
            <div style="position: relative;">
                <img src="{{ $course->featured_image ? asset('storage/' . $course->featured_image) : 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80' }}"
                     alt="{{ $course->title_ar }}"
                     style="width: 100%; height: 200px; object-fit: cover;">
                
                <!-- Status Badge -->
                <div style="position: absolute; top: 15px; right: 15px;">
                    @if($course->status == 'published')
                        <span style="background: #10b981; color: white; padding: 6px 12px; border-radius: 20px; font-size: 0.8rem; font-weight: 500;">
                            <i class="bi bi-check-circle"></i> منشور
                        </span>
                    @elseif($course->status == 'draft')
                        <span style="background: #f59e0b; color: white; padding: 6px 12px; border-radius: 20px; font-size: 0.8rem; font-weight: 500;">
                            <i class="bi bi-pencil"></i> مسودة
                        </span>
                    @else
                        <span style="background: #6b7280; color: white; padding: 6px 12px; border-radius: 20px; font-size: 0.8rem; font-weight: 500;">
                            <i class="bi bi-archive"></i> مؤرشف
                        </span>
                    @endif
                </div>

                <!-- Category Badge -->
                <div style="position: absolute; top: 15px; left: 15px;">
                    <span style="background: rgba(0,0,0,0.7); color: white; padding: 4px 8px; border-radius: 12px; font-size: 0.7rem;">
                        {{ $course->category->name_ar }}
                    </span>
                </div>
            </div>

            <div style="padding: 25px;">
                <h3 style="font-size: 1.2rem; margin-bottom: 10px; color: #1f2937; line-height: 1.4;">{{ $course->title_ar }}</h3>
                <p style="color: #6b7280; font-size: 0.9rem; margin-bottom: 20px; line-height: 1.5;">{{ Str::limit($course->description_ar, 120) }}</p>
                
                <!-- Course Stats -->
                <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 15px; margin-bottom: 20px; padding: 15px; background: #f9fafb; border-radius: 10px;">
                    <div style="text-align: center;">
                        <div style="font-size: 1.2rem; font-weight: 600; color: #10b981;">{{ $course->enrollments->count() }}</div>
                        <div style="font-size: 0.8rem; color: #6b7280;">طالب</div>
                    </div>
                    <div style="text-align: center;">
                        <div style="font-size: 1.2rem; font-weight: 600; color: #3b82f6;">{{ $course->lessons->count() }}</div>
                        <div style="font-size: 0.8rem; color: #6b7280;">درس</div>
                    </div>
                    <div style="text-align: center;">
                        <div style="font-size: 1.2rem; font-weight: 600; color: #f59e0b;">{{ $course->average_rating ?? 0 }}</div>
                        <div style="font-size: 0.8rem; color: #6b7280;">تقييم</div>
                    </div>
                </div>

                <!-- Course Details -->
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; font-size: 0.9rem; color: #6b7280;">
                    <span><i class="bi bi-clock"></i> {{ $course->duration }} ساعة</span>
                    <span><i class="bi bi-currency-dollar"></i> {{ $course->price }} ريال</span>
                    <span><i class="bi bi-bar-chart"></i> {{ ucfirst($course->level) }}</span>
                </div>

                <!-- Action Buttons -->
                <div style="display: flex; gap: 10px;">
                    <a href="{{ route('teacher.courses.show', $course) }}" class="btn btn-primary" style="flex: 1; justify-content: center;">
                        <i class="bi bi-eye"></i>
                        عرض
                    </a>
                    <a href="{{ route('teacher.courses.edit', $course) }}" class="btn btn-outline" style="flex: 1; justify-content: center;">
                        <i class="bi bi-pencil"></i>
                        تعديل
                    </a>
                    <button onclick="toggleDropdown({{ $course->id }})" class="btn btn-outline" style="padding: 12px;">
                        <i class="bi bi-three-dots-vertical"></i>
                    </button>
                </div>

                <!-- Dropdown Menu -->
                <div id="dropdown-{{ $course->id }}" class="dropdown-menu" style="display: none; position: absolute; background: white; border: 1px solid #e5e7eb; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); z-index: 1000; min-width: 150px;">
                    <a href="{{ route('teacher.lessons.create', ['course_id' => $course->id]) }}" style="display: block; padding: 10px 15px; color: #374151; text-decoration: none; border-bottom: 1px solid #f3f4f6;">
                        <i class="bi bi-plus-circle"></i> إضافة درس
                    </a>
                    <a href="{{ route('teacher.courses.students', $course) }}" style="display: block; padding: 10px 15px; color: #374151; text-decoration: none; border-bottom: 1px solid #f3f4f6;">
                        <i class="bi bi-people"></i> الطلاب
                    </a>
                    @if($course->status == 'draft')
                        <form method="POST" action="{{ route('teacher.courses.publish', $course) }}" style="display: block;">
                            @csrf
                            <button type="submit" style="width: 100%; text-align: right; padding: 10px 15px; background: none; border: none; color: #10b981; cursor: pointer;">
                                <i class="bi bi-check-circle"></i> نشر
                            </button>
                        </form>
                    @elseif($course->status == 'published')
                        <form method="POST" action="{{ route('teacher.courses.unpublish', $course) }}" style="display: block;">
                            @csrf
                            <button type="submit" style="width: 100%; text-align: right; padding: 10px 15px; background: none; border: none; color: #f59e0b; cursor: pointer;">
                                <i class="bi bi-pause-circle"></i> إيقاف النشر
                            </button>
                        </form>
                    @endif
                    <form method="POST" action="{{ route('teacher.courses.destroy', $course) }}" style="display: block;" onsubmit="return confirm('هل أنت متأكد من حذف هذه الدورة؟')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="width: 100%; text-align: right; padding: 10px 15px; background: none; border: none; color: #ef4444; cursor: pointer;">
                            <i class="bi bi-trash"></i> حذف
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div style="margin-top: 40px; display: flex; justify-content: center;">
        {{ $courses->links() }}
    </div>
    @else
    <!-- Empty State -->
    <div style="text-align: center; padding: 80px 20px; background: white; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
        <i class="bi bi-book" style="font-size: 4rem; color: #d1d5db; margin-bottom: 20px;"></i>
        <h3 style="color: #6b7280; margin-bottom: 10px; font-size: 1.5rem;">لا توجد دورات بعد</h3>
        <p style="color: #9ca3af; margin-bottom: 30px; font-size: 1rem;">ابدأ بإنشاء دورة جديدة لمشاركة معرفتك مع الطلاب</p>
        <a href="{{ route('teacher.courses.create') }}" class="btn btn-primary" style="font-size: 1rem; padding: 15px 30px;">
            <i class="bi bi-plus-circle"></i>
            إنشاء دورة جديدة
        </a>
    </div>
    @endif
</div>

<style>
.course-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

.dropdown-menu {
    transition: all 0.3s ease;
}

@media (max-width: 768px) {
    .courses-grid {
        grid-template-columns: 1fr !important;
    }
    
    .page-header {
        flex-direction: column;
        gap: 15px;
        text-align: center;
    }
}
</style>

<script>
function toggleDropdown(courseId) {
    const dropdown = document.getElementById(`dropdown-${courseId}`);
    const allDropdowns = document.querySelectorAll('.dropdown-menu');
    
    // Close all other dropdowns
    allDropdowns.forEach(d => {
        if (d.id !== `dropdown-${courseId}`) {
            d.style.display = 'none';
        }
    });
    
    // Toggle current dropdown
    dropdown.style.display = dropdown.style.display === 'none' ? 'block' : 'none';
}

// Close dropdowns when clicking outside
document.addEventListener('click', function(event) {
    if (!event.target.closest('.dropdown-menu') && !event.target.closest('button')) {
        document.querySelectorAll('.dropdown-menu').forEach(dropdown => {
            dropdown.style.display = 'none';
        });
    }
});
</script>
@endsection 