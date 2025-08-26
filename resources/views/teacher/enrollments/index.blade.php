@extends('layouts.teacher')

@section('title', 'إدارة التسجيلات')

@section('content')
<div class="dashboard-container">
    <!-- Page Header -->
    <div class="page-header">
        <div>
            <h1 style="font-size: 2rem; color: #1f2937; margin-bottom: 5px;">إدارة التسجيلات</h1>
            <p style="color: #6b7280; margin: 0;">عرض وإدارة جميع تسجيلات الطلاب في دوراتك</p>
        </div>
    </div>

    <!-- Filters and Search -->
    <div style="background: white; padding: 20px; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); margin-bottom: 30px;">
        <form method="GET" action="{{ route('teacher.enrollments.index') }}" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; align-items: end;">
            <div>
                <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">البحث</label>
                <input type="text" name="search" value="{{ request('search') }}" 
                       placeholder="البحث في اسم الطالب..."
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
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>ملغي</option>
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

    <!-- Enrollments Table -->
    @if($enrollments->count() > 0)
    <div style="background: white; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); overflow: hidden;">
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead style="background: #f9fafb;">
                    <tr>
                        <th style="padding: 15px; text-align: right; font-weight: 600; color: #374151; border-bottom: 1px solid #e5e7eb;">الطالب</th>
                        <th style="padding: 15px; text-align: right; font-weight: 600; color: #374151; border-bottom: 1px solid #e5e7eb;">الدورة</th>
                        <th style="padding: 15px; text-align: right; font-weight: 600; color: #374151; border-bottom: 1px solid #e5e7eb;">تاريخ التسجيل</th>
                        <th style="padding: 15px; text-align: right; font-weight: 600; color: #374151; border-bottom: 1px solid #e5e7eb;">الحالة</th>
                        <th style="padding: 15px; text-align: right; font-weight: 600; color: #374151; border-bottom: 1px solid #e5e7eb;">التقدم</th>
                        <th style="padding: 15px; text-align: right; font-weight: 600; color: #374151; border-bottom: 1px solid #e5e7eb;">الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($enrollments as $enrollment)
                    <tr style="border-bottom: 1px solid #f3f4f6;">
                        <td style="padding: 15px;">
                            <div style="display: flex; align-items: center; gap: 12px;">
                                <div style="width: 40px; height: 40px; background: #10b981; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 600;">
                                                            {{ substr($enrollment->user->name, 0, 1) }}
                    </div>
                    <div>
                        <div style="font-weight: 500; color: #1f2937;">{{ $enrollment->user->name }}</div>
                        <div style="font-size: 0.9rem; color: #6b7280;">{{ $enrollment->user->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td style="padding: 15px;">
                            <div style="font-weight: 500; color: #1f2937;">{{ $enrollment->course->title_ar }}</div>
                            <div style="font-size: 0.9rem; color: #6b7280;">{{ $enrollment->course->category->name_ar }}</div>
                        </td>
                        <td style="padding: 15px; color: #6b7280;">
                            {{ $enrollment->created_at->format('Y/m/d') }}
                        </td>
                        <td style="padding: 15px;">
                            @if($enrollment->status == 'active')
                                <span style="background: #10b981; color: white; padding: 4px 8px; border-radius: 12px; font-size: 0.8rem;">نشط</span>
                            @elseif($enrollment->status == 'completed')
                                <span style="background: #3b82f6; color: white; padding: 4px 8px; border-radius: 12px; font-size: 0.8rem;">مكتمل</span>
                            @else
                                <span style="background: #6b7280; color: white; padding: 4px 8px; border-radius: 12px; font-size: 0.8rem;">ملغي</span>
                            @endif
                        </td>
                        <td style="padding: 15px;">
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <div style="flex: 1; background: #e5e7eb; border-radius: 10px; height: 8px;">
                                    <div style="background: #10b981; height: 8px; border-radius: 10px; width: {{ $enrollment->progress_percentage ?? 0 }}%;"></div>
                                </div>
                                <span style="font-size: 0.9rem; color: #6b7280;">{{ $enrollment->progress_percentage ?? 0 }}%</span>
                            </div>
                        </td>
                        <td style="padding: 15px;">
                            <div style="display: flex; gap: 8px;">
                                <a href="{{ route('teacher.students.show', $enrollment->user) }}" class="btn btn-sm btn-outline">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('teacher.enrollments.show', $enrollment) }}" class="btn btn-sm btn-primary">
                                    <i class="bi bi-info-circle"></i>
                                </a>
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
        {{ $enrollments->links() }}
    </div>
    @else
    <div style="background: white; padding: 60px; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); text-align: center;">
        <i class="bi bi-people" style="font-size: 4rem; color: #d1d5db; margin-bottom: 20px; display: block;"></i>
        <h3 style="font-size: 1.5rem; color: #374151; margin-bottom: 10px;">لا توجد تسجيلات</h3>
        <p style="color: #6b7280; margin-bottom: 30px;">لم يتم تسجيل أي طلاب في دوراتك بعد</p>
        <a href="{{ route('teacher.courses.index') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i>
            إنشاء دورة جديدة
        </a>
    </div>
    @endif
</div>
@endsection 