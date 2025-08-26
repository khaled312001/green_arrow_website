@extends('layouts.teacher')

@section('title', 'ملف الطالب')

@section('content')
<div class="dashboard-container">
    <!-- Page Header -->
    <div class="page-header">
        <div>
            <h1 style="font-size: 2rem; color: #1f2937; margin-bottom: 5px;">ملف الطالب</h1>
            <p style="color: #6b7280; margin: 0;">معلومات الطالب ودوراته المسجلة</p>
        </div>
        <div style="display: flex; gap: 15px;">
            <a href="{{ route('teacher.students.index') }}" class="btn btn-outline">
                <i class="bi bi-arrow-left"></i>
                العودة للطلاب
            </a>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 30px;">
        <!-- Student Profile -->
        <div>
            <div style="background: white; padding: 30px; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); margin-bottom: 20px;">
                <div style="text-align: center; margin-bottom: 25px;">
                    <div style="width: 100px; height: 100px; background: #10b981; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: 2.5rem; margin: 0 auto 15px;">
                        {{ substr($student->name, 0, 1) }}
                    </div>
                    <h2 style="font-size: 1.5rem; color: #1f2937; margin-bottom: 5px;">{{ $student->name }}</h2>
                    <p style="color: #6b7280; margin: 0;">{{ $student->email }}</p>
                </div>
                
                <div style="display: flex; flex-direction: column; gap: 15px;">
                    @if($student->phone)
                    <div>
                        <span style="color: #6b7280; font-size: 0.9rem;">الهاتف:</span>
                        <div style="color: #1f2937;">{{ $student->phone }}</div>
                    </div>
                    @endif
                    
                    @if($student->city)
                    <div>
                        <span style="color: #6b7280; font-size: 0.9rem;">المدينة:</span>
                        <div style="color: #1f2937;">{{ $student->city }}</div>
                    </div>
                    @endif
                    
                    @if($student->bio)
                    <div>
                        <span style="color: #6b7280; font-size: 0.9rem;">نبذة:</span>
                        <div style="color: #1f2937;">{{ $student->bio }}</div>
                    </div>
                    @endif
                    
                    <div>
                        <span style="color: #6b7280; font-size: 0.9rem;">تاريخ الانضمام:</span>
                        <div style="color: #1f2937;">{{ $student->created_at->format('Y/m/d') }}</div>
                    </div>
                    
                    <div>
                        <span style="color: #6b7280; font-size: 0.9rem;">آخر تسجيل دخول:</span>
                        <div style="color: #1f2937;">{{ $student->last_login_at ? $student->last_login_at->format('Y/m/d H:i') : 'غير متوفر' }}</div>
                    </div>
                </div>
            </div>

            <!-- Statistics -->
            <div style="background: white; padding: 25px; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                <h3 style="font-size: 1.2rem; color: #1f2937; margin-bottom: 20px;">الإحصائيات</h3>
                
                <div style="display: flex; flex-direction: column; gap: 15px;">
                    <div style="display: flex; justify-content: space-between; align-items: center; padding: 15px; background: #f9fafb; border-radius: 8px;">
                        <span style="color: #6b7280;">إجمالي الدورات</span>
                        <span style="font-weight: 600; color: #1f2937;">{{ $student->enrollments->count() }}</span>
                    </div>
                    
                    <div style="display: flex; justify-content: space-between; align-items: center; padding: 15px; background: #f9fafb; border-radius: 8px;">
                        <span style="color: #6b7280;">الدورات المكتملة</span>
                        <span style="font-weight: 600; color: #1f2937;">{{ $student->enrollments->where('status', 'completed')->count() }}</span>
                    </div>
                    
                    <div style="display: flex; justify-content: space-between; align-items: center; padding: 15px; background: #f9fafb; border-radius: 8px;">
                        <span style="color: #6b7280;">الدورات النشطة</span>
                        <span style="font-weight: 600; color: #1f2937;">{{ $student->enrollments->where('status', 'active')->count() }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Enrollments -->
        <div>
            <div style="background: white; padding: 30px; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                <h2 style="font-size: 1.5rem; color: #1f2937; margin-bottom: 25px;">الدورات المسجلة</h2>
                
                @if($student->enrollments->count() > 0)
                <div style="display: flex; flex-direction: column; gap: 20px;">
                    @foreach($student->enrollments as $enrollment)
                    <div style="border: 1px solid #e5e7eb; border-radius: 12px; padding: 20px; transition: all 0.3s ease;">
                        <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 15px;">
                            <div style="flex: 1;">
                                <h3 style="font-size: 1.2rem; color: #1f2937; margin-bottom: 8px;">{{ $enrollment->course->title_ar }}</h3>
                                <p style="color: #6b7280; margin-bottom: 10px;">{{ $enrollment->course->category->name_ar }}</p>
                                <div style="display: flex; gap: 15px; font-size: 0.9rem; color: #6b7280;">
                                    <span><i class="bi bi-calendar"></i> {{ $enrollment->created_at->format('Y/m/d') }}</span>
                                    <span><i class="bi bi-clock"></i> {{ $enrollment->course->duration }} ساعة</span>
                                </div>
                            </div>
                            <div style="text-align: left;">
                                @if($enrollment->status == 'active')
                                    <span style="background: #10b981; color: white; padding: 6px 12px; border-radius: 12px; font-size: 0.9rem;">نشط</span>
                                @elseif($enrollment->status == 'completed')
                                    <span style="background: #3b82f6; color: white; padding: 6px 12px; border-radius: 12px; font-size: 0.9rem;">مكتمل</span>
                                @else
                                    <span style="background: #6b7280; color: white; padding: 6px 12px; border-radius: 12px; font-size: 0.9rem;">ملغي</span>
                                @endif
                            </div>
                        </div>
                        
                        <div style="margin-bottom: 15px;">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                                <span style="color: #6b7280; font-size: 0.9rem;">التقدم</span>
                                <span style="font-weight: 600; color: #1f2937;">{{ $enrollment->progress_percentage ?? 0 }}%</span>
                            </div>
                            <div style="background: #e5e7eb; border-radius: 10px; height: 8px;">
                                <div style="background: #10b981; height: 8px; border-radius: 10px; width: {{ $enrollment->progress_percentage ?? 0 }}%;"></div>
                            </div>
                        </div>
                        
                        <div style="display: flex; gap: 10px;">
                            <a href="{{ route('teacher.enrollments.show', $enrollment) }}" class="btn btn-sm btn-primary">
                                <i class="bi bi-eye"></i>
                                عرض التفاصيل
                            </a>
                            <a href="{{ route('teacher.courses.show', $enrollment->course) }}" class="btn btn-sm btn-outline">
                                <i class="bi bi-book"></i>
                                عرض الدورة
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div style="text-align: center; padding: 40px;">
                    <i class="bi bi-book" style="font-size: 3rem; color: #d1d5db; margin-bottom: 15px; display: block;"></i>
                    <h3 style="font-size: 1.2rem; color: #374151; margin-bottom: 10px;">لا توجد دورات مسجلة</h3>
                    <p style="color: #6b7280;">لم يسجل هذا الطالب في أي دورة بعد</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection 