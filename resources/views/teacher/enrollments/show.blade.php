@extends('layouts.teacher')

@section('title', 'تفاصيل التسجيل')

@section('content')
<div class="dashboard-container">
    <!-- Page Header -->
    <div class="page-header">
        <div>
            <h1 style="font-size: 2rem; color: #1f2937; margin-bottom: 5px;">تفاصيل التسجيل</h1>
            <p style="color: #6b7280; margin: 0;">معلومات التسجيل والطالب والدورة</p>
        </div>
        <div style="display: flex; gap: 15px;">
            <a href="{{ route('teacher.enrollments.index') }}" class="btn btn-outline">
                <i class="bi bi-arrow-left"></i>
                العودة للتسجيلات
            </a>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 30px;">
        <!-- Main Content -->
        <div>
            <!-- Enrollment Details -->
            <div style="background: white; padding: 30px; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); margin-bottom: 30px;">
                <h2 style="font-size: 1.5rem; color: #1f2937; margin-bottom: 25px;">معلومات التسجيل</h2>
                
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 25px;">
                    <div>
                        <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">تاريخ التسجيل</label>
                        <span style="color: #6b7280;">{{ $enrollment->created_at->format('Y/m/d H:i') }}</span>
                    </div>
                    
                    <div>
                        <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">حالة التسجيل</label>
                        @if($enrollment->status == 'active')
                            <span style="background: #10b981; color: white; padding: 6px 12px; border-radius: 12px; font-size: 0.9rem;">نشط</span>
                        @elseif($enrollment->status == 'completed')
                            <span style="background: #3b82f6; color: white; padding: 6px 12px; border-radius: 12px; font-size: 0.9rem;">مكتمل</span>
                        @else
                            <span style="background: #6b7280; color: white; padding: 6px 12px; border-radius: 12px; font-size: 0.9rem;">ملغي</span>
                        @endif
                    </div>
                    
                    <div>
                        <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">نسبة التقدم</label>
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <div style="flex: 1; background: #e5e7eb; border-radius: 10px; height: 10px;">
                                <div style="background: #10b981; height: 10px; border-radius: 10px; width: {{ $enrollment->progress_percentage ?? 0 }}%;"></div>
                            </div>
                            <span style="font-weight: 600; color: #1f2937;">{{ $enrollment->progress_percentage ?? 0 }}%</span>
                        </div>
                    </div>
                    
                    @if($enrollment->completed_at)
                    <div>
                        <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">تاريخ الإكمال</label>
                        <span style="color: #6b7280;">{{ $enrollment->completed_at->format('Y/m/d H:i') }}</span>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Course Information -->
            <div style="background: white; padding: 30px; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); margin-bottom: 30px;">
                <h2 style="font-size: 1.5rem; color: #1f2937; margin-bottom: 25px;">معلومات الدورة</h2>
                
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 25px;">
                    <div>
                        <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">عنوان الدورة</label>
                        <span style="color: #1f2937; font-weight: 500;">{{ $enrollment->course->title_ar }}</span>
                    </div>
                    
                    <div>
                        <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">القسم</label>
                        <span style="color: #6b7280;">{{ $enrollment->course->category->name_ar }}</span>
                    </div>
                    
                    <div>
                        <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">المستوى</label>
                        <span style="color: #6b7280;">{{ ucfirst($enrollment->course->level) }}</span>
                    </div>
                    
                    <div>
                        <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">المدة</label>
                        <span style="color: #6b7280;">{{ $enrollment->course->duration }} ساعة</span>
                    </div>
                    
                    <div>
                        <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">السعر</label>
                        <span style="color: #6b7280;">{{ number_format($enrollment->course->price, 0) }} ريال</span>
                    </div>
                    
                    <div>
                        <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">عدد الدروس</label>
                        <span style="color: #6b7280;">{{ $enrollment->course->lessons->count() }} درس</span>
                    </div>
                </div>
            </div>

            <!-- Progress Tracking -->
            <div style="background: white; padding: 30px; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                <h2 style="font-size: 1.5rem; color: #1f2937; margin-bottom: 25px;">تتبع التقدم</h2>
                
                @if($enrollment->course->lessons->count() > 0)
                <div style="display: flex; flex-direction: column; gap: 15px;">
                    @foreach($enrollment->course->lessons->sortBy('order') as $lesson)
                    <div style="display: flex; justify-content: space-between; align-items: center; padding: 15px; background: #f9fafb; border-radius: 8px;">
                        <div style="flex: 1;">
                            <div style="font-weight: 500; color: #1f2937;">{{ $lesson->title_ar }}</div>
                            <div style="font-size: 0.9rem; color: #6b7280;">{{ $lesson->duration }} دقيقة</div>
                        </div>
                        <div style="display: flex; align-items: center; gap: 10px;">
                            @if($enrollment->lessons->contains($lesson->id))
                                <span style="background: #10b981; color: white; padding: 4px 8px; border-radius: 8px; font-size: 0.8rem;">
                                    <i class="bi bi-check-circle"></i> مكتمل
                                </span>
                            @else
                                <span style="background: #e5e7eb; color: #6b7280; padding: 4px 8px; border-radius: 8px; font-size: 0.8rem;">
                                    <i class="bi bi-clock"></i> لم يكتمل
                                </span>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <p style="color: #6b7280; text-align: center; padding: 20px;">لا توجد دروس لهذه الدورة</p>
                @endif
            </div>
        </div>

        <!-- Sidebar -->
        <div>
            <!-- Student Information -->
            <div style="background: white; padding: 25px; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); margin-bottom: 20px;">
                <h3 style="font-size: 1.2rem; color: #1f2937; margin-bottom: 20px;">معلومات الطالب</h3>
                
                <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 20px;">
                    <div style="width: 60px; height: 60px; background: #10b981; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: 1.5rem;">
                        {{ substr($enrollment->user->name, 0, 1) }}
                    </div>
                    <div>
                        <div style="font-weight: 600; color: #1f2937; font-size: 1.1rem;">{{ $enrollment->user->name }}</div>
                        <div style="color: #6b7280;">{{ $enrollment->user->email }}</div>
                    </div>
                </div>
                
                <div style="display: flex; flex-direction: column; gap: 15px;">
                    @if($enrollment->user->phone)
                    <div>
                        <span style="color: #6b7280; font-size: 0.9rem;">الهاتف:</span>
                        <div style="color: #1f2937;">{{ $enrollment->user->phone }}</div>
                    </div>
                    @endif
                    
                    @if($enrollment->user->city)
                    <div>
                        <span style="color: #6b7280; font-size: 0.9rem;">المدينة:</span>
                        <div style="color: #1f2937;">{{ $enrollment->user->city }}</div>
                    </div>
                    @endif
                    
                    <div>
                        <span style="color: #6b7280; font-size: 0.9rem;">تاريخ الانضمام:</span>
                        <div style="color: #1f2937;">{{ $enrollment->user->created_at->format('Y/m/d') }}</div>
                    </div>
                </div>
                
                <div style="margin-top: 20px;">
                    <a href="{{ route('teacher.students.show', $enrollment->user) }}" class="btn btn-primary" style="width: 100%;">
                        <i class="bi bi-eye"></i>
                        عرض ملف الطالب
                    </a>
                </div>
            </div>

            <!-- Actions -->
            <div style="background: white; padding: 25px; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                <h3 style="font-size: 1.2rem; color: #1f2937; margin-bottom: 20px;">الإجراءات</h3>
                
                <form method="POST" action="{{ route('teacher.enrollments.status', $enrollment) }}" style="margin-bottom: 15px;">
                    @csrf
                    @method('PUT')
                    <div style="margin-bottom: 15px;">
                        <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">تغيير الحالة</label>
                        <select name="status" style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 0.9rem;">
                            <option value="active" {{ $enrollment->status == 'active' ? 'selected' : '' }}>نشط</option>
                            <option value="completed" {{ $enrollment->status == 'completed' ? 'selected' : '' }}>مكتمل</option>
                            <option value="cancelled" {{ $enrollment->status == 'cancelled' ? 'selected' : '' }}>ملغي</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary" style="width: 100%;">
                        <i class="bi bi-check-circle"></i>
                        تحديث الحالة
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 