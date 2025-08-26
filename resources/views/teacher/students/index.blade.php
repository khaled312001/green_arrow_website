@extends('layouts.teacher')

@section('title', 'طلابي')

@section('content')
<div class="dashboard-container">
    <!-- Page Header -->
    <div class="page-header">
        <div>
            <h1 style="font-size: 2rem; color: #1f2937; margin-bottom: 5px;">طلابي</h1>
            <p style="color: #6b7280; margin: 0;">إدارة جميع الطلاب المسجلين في دوراتك</p>
        </div>
        <div style="display: flex; gap: 15px;">
            <a href="{{ route('teacher.reports.students') }}" class="btn btn-outline">
                <i class="bi bi-graph-up"></i>
                تقرير الطلاب
            </a>
        </div>
    </div>

    <!-- Filters and Search -->
    <div style="background: white; padding: 20px; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); margin-bottom: 30px;">
        <form method="GET" action="{{ route('teacher.students.index') }}" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; align-items: end;">
            <div>
                <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">البحث</label>
                <input type="text" name="search" value="{{ request('search') }}" 
                       placeholder="البحث في اسم الطالب أو البريد الإلكتروني..."
                       style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 0.9rem;">
            </div>
            
            <div>
                <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">الدورة</label>
                <select name="course_id" style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 0.9rem;">
                    <option value="">جميع الدورات</option>
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}" {{ request('course_id') == $course->id ? 'selected' : '' }}>
                            {{ $course->title_ar }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div>
                <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">حالة التسجيل</label>
                <select name="status" style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 0.9rem;">
                    <option value="">جميع الحالات</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>نشط</option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>مكتمل</option>
                    <option value="paused" {{ request('status') == 'paused' ? 'selected' : '' }}>متوقف مؤقتاً</option>
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

    <!-- Students List -->
    @if($students->count() > 0)
    <div style="background: white; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); overflow: hidden;">
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead style="background: #f9fafb;">
                    <tr>
                        <th style="padding: 15px; text-align: right; font-weight: 600; color: #374151; border-bottom: 1px solid #e5e7eb;">الطالب</th>
                        <th style="padding: 15px; text-align: right; font-weight: 600; color: #374151; border-bottom: 1px solid #e5e7eb;">الدورات المسجل فيها</th>
                        <th style="padding: 15px; text-align: right; font-weight: 600; color: #374151; border-bottom: 1px solid #e5e7eb;">تاريخ التسجيل</th>
                        <th style="padding: 15px; text-align: right; font-weight: 600; color: #374151; border-bottom: 1px solid #e5e7eb;">التقدم العام</th>
                        <th style="padding: 15px; text-align: right; font-weight: 600; color: #374151; border-bottom: 1px solid #e5e7eb;">آخر نشاط</th>
                        <th style="padding: 15px; text-align: right; font-weight: 600; color: #374151; border-bottom: 1px solid #e5e7eb;">الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $student)
                    <tr style="border-bottom: 1px solid #f3f4f6; transition: background 0.3s ease;">
                        <td style="padding: 15px;">
                            <div style="display: flex; align-items: center; gap: 15px;">
                                <img src="{{ $student->avatar_url }}" 
                                     alt="{{ $student->name }}"
                                     style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;">
                                <div>
                                    <div style="font-weight: 500; color: #1f2937; margin-bottom: 5px;">{{ $student->name }}</div>
                                    <div style="font-size: 0.8rem; color: #6b7280;">{{ $student->email }}</div>
                                    <div style="font-size: 0.8rem; color: #6b7280;">{{ $student->phone }}</div>
                                </div>
                            </div>
                        </td>
                        <td style="padding: 15px;">
                            <div style="display: flex; flex-direction: column; gap: 8px;">
                                @foreach($student->enrollments as $enrollment)
                                <div style="display: flex; align-items: center; gap: 10px; padding: 8px; background: #f9fafb; border-radius: 6px;">
                                    <span style="font-size: 0.9rem; color: #1f2937;">{{ $enrollment->course->title_ar }}</span>
                                    @if($enrollment->status == 'active')
                                        <span style="background: #10b981; color: white; padding: 2px 6px; border-radius: 10px; font-size: 0.7rem;">نشط</span>
                                    @elseif($enrollment->status == 'completed')
                                        <span style="background: #3b82f6; color: white; padding: 2px 6px; border-radius: 10px; font-size: 0.7rem;">مكتمل</span>
                                    @else
                                        <span style="background: #f59e0b; color: white; padding: 2px 6px; border-radius: 10px; font-size: 0.7rem;">متوقف</span>
                                    @endif
                                </div>
                                @endforeach
                            </div>
                        </td>
                        <td style="padding: 15px; color: #6b7280; font-size: 0.9rem;">
                            {{ $student->enrollments->first()->created_at->format('Y/m/d') }}
                        </td>
                        <td style="padding: 15px;">
                            @php
                                $totalProgress = $student->enrollments->avg('progress_percentage');
                            @endphp
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <div style="width: 80px; height: 8px; background: #e5e7eb; border-radius: 4px; overflow: hidden;">
                                    <div style="width: {{ $totalProgress }}%; height: 100%; background: #10b981; border-radius: 4px;"></div>
                                </div>
                                <span style="font-size: 0.9rem; color: #10b981; font-weight: 600;">{{ round($totalProgress) }}%</span>
                            </div>
                        </td>
                        <td style="padding: 15px; color: #6b7280; font-size: 0.9rem;">
                            {{ $student->last_login_at ? $student->last_login_at->diffForHumans() : 'لم يسجل الدخول بعد' }}
                        </td>
                        <td style="padding: 15px;">
                            <div style="display: flex; gap: 8px;">
                                <a href="{{ route('teacher.students.show', $student) }}" class="btn btn-sm btn-outline" style="padding: 6px 12px; font-size: 0.8rem;">
                                    <i class="bi bi-eye"></i>
                                    عرض
                                </a>
                                <button onclick="toggleStudentDropdown({{ $student->id }})" class="btn btn-sm btn-outline" style="padding: 6px 12px; font-size: 0.8rem;">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </button>
                            </div>
                            
                            <!-- Dropdown Menu -->
                            <div id="student-dropdown-{{ $student->id }}" class="student-dropdown" style="display: none; position: absolute; background: white; border: 1px solid #e5e7eb; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); z-index: 1000; min-width: 150px; margin-top: 5px;">
                                <a href="{{ route('teacher.students.progress', $student) }}" style="display: block; padding: 10px 15px; color: #374151; text-decoration: none; border-bottom: 1px solid #f3f4f6;">
                                    <i class="bi bi-graph-up"></i> التقدم
                                </a>
                                <a href="{{ route('teacher.students.certificates', $student) }}" style="display: block; padding: 10px 15px; color: #374151; text-decoration: none; border-bottom: 1px solid #f3f4f6;">
                                    <i class="bi bi-award"></i> الشهادات
                                </a>
                                <a href="mailto:{{ $student->email }}" style="display: block; padding: 10px 15px; color: #374151; text-decoration: none; border-bottom: 1px solid #f3f4f6;">
                                    <i class="bi bi-envelope"></i> إرسال بريد
                                </a>
                                <button onclick="sendMessage({{ $student->id }})" style="width: 100%; text-align: right; padding: 10px 15px; background: none; border: none; color: #3b82f6; cursor: pointer;">
                                    <i class="bi bi-chat"></i> رسالة
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div style="margin-top: 30px; display: flex; justify-content: center;">
        {{ $students->links() }}
    </div>
    @else
    <!-- Empty State -->
    <div style="text-align: center; padding: 80px 20px; background: white; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
        <i class="bi bi-people" style="font-size: 4rem; color: #d1d5db; margin-bottom: 20px;"></i>
        <h3 style="color: #6b7280; margin-bottom: 10px; font-size: 1.5rem;">لا يوجد طلاب مسجلين بعد</h3>
        <p style="color: #9ca3af; margin-bottom: 30px; font-size: 1rem;">سيظهر الطلاب هنا عند تسجيلهم في دوراتك</p>
        <a href="{{ route('teacher.courses.index') }}" class="btn btn-primary" style="font-size: 1rem; padding: 15px 30px;">
            <i class="bi bi-book"></i>
            عرض دوراتي
        </a>
    </div>
    @endif

    <!-- Statistics Cards -->
    <div style="margin-top: 40px; display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px;">
        <div style="background: white; padding: 25px; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
            <div style="display: flex; align-items: center; justify-content: space-between;">
                <div>
                    <h3 style="font-size: 2rem; color: #10b981; margin: 0 0 5px 0;">{{ $totalStudents }}</h3>
                    <p style="color: #6b7280; margin: 0; font-size: 0.9rem;">إجمالي الطلاب</p>
                </div>
                <div style="width: 50px; height: 50px; background: #10b981; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                    <i class="bi bi-people" style="color: white; font-size: 1.5rem;"></i>
                </div>
            </div>
        </div>

        <div style="background: white; padding: 25px; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
            <div style="display: flex; align-items: center; justify-content: space-between;">
                <div>
                    <h3 style="font-size: 2rem; color: #3b82f6; margin: 0 0 5px 0;">{{ $activeStudents }}</h3>
                    <p style="color: #6b7280; margin: 0; font-size: 0.9rem;">طلاب نشطون</p>
                </div>
                <div style="width: 50px; height: 50px; background: #3b82f6; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                    <i class="bi bi-person-check" style="color: white; font-size: 1.5rem;"></i>
                </div>
            </div>
        </div>

        <div style="background: white; padding: 25px; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
            <div style="display: flex; align-items: center; justify-content: space-between;">
                <div>
                    <h3 style="font-size: 2rem; color: #f59e0b; margin: 0 0 5px 0;">{{ $completedStudents }}</h3>
                    <p style="color: #6b7280; margin: 0; font-size: 0.9rem;">طلاب مكتملون</p>
                </div>
                <div style="width: 50px; height: 50px; background: #f59e0b; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                    <i class="bi bi-award" style="color: white; font-size: 1.5rem;"></i>
                </div>
            </div>
        </div>

        <div style="background: white; padding: 25px; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
            <div style="display: flex; align-items: center; justify-content: space-between;">
                <div>
                    <h3 style="font-size: 2rem; color: #8b5cf6; margin: 0 0 5px 0;">{{ $averageProgress }}%</h3>
                    <p style="color: #6b7280; margin: 0; font-size: 0.9rem;">متوسط التقدم</p>
                </div>
                <div style="width: 50px; height: 50px; background: #8b5cf6; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                    <i class="bi bi-graph-up" style="color: white; font-size: 1.5rem;"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.student-dropdown {
    transition: all 0.3s ease;
}

tr:hover {
    background: #f9fafb;
}

.btn-sm {
    padding: 6px 12px;
    font-size: 0.8rem;
}

@media (max-width: 768px) {
    .page-header {
        flex-direction: column;
        gap: 15px;
        text-align: center;
    }
}
</style>

<script>
function toggleStudentDropdown(studentId) {
    const dropdown = document.getElementById(`student-dropdown-${studentId}`);
    const allDropdowns = document.querySelectorAll('.student-dropdown');
    
    // Close all other dropdowns
    allDropdowns.forEach(d => {
        if (d.id !== `student-dropdown-${studentId}`) {
            d.style.display = 'none';
        }
    });
    
    // Toggle current dropdown
    dropdown.style.display = dropdown.style.display === 'none' ? 'block' : 'none';
}

function sendMessage(studentId) {
    // Implement message functionality
    alert('سيتم إضافة ميزة الرسائل قريباً');
}

// Close dropdowns when clicking outside
document.addEventListener('click', function(event) {
    if (!event.target.closest('.student-dropdown') && !event.target.closest('button')) {
        document.querySelectorAll('.student-dropdown').forEach(dropdown => {
            dropdown.style.display = 'none';
        });
    }
});
</script>
@endsection 