@extends('layouts.student')

@section('title', 'شهاداتي - لوحة الطالب')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header" style="margin-bottom: 30px;">
        <h1 style="font-size: 2rem; color: #1f2937; margin-bottom: 10px;">شهاداتي</h1>
        <p style="color: #6b7280;">شهادات الدورات المكتملة</p>
    </div>

    <!-- Statistics Cards -->
    <div class="stats-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 30px;">
        <div class="stat-card" style="background: white; padding: 25px; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); text-align: center;">
            <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #10b981, #059669); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px; color: white; font-size: 1.5rem;">
                <i class="bi bi-award"></i>
            </div>
            <h3 style="font-size: 2rem; color: #1f2937; margin-bottom: 5px;">{{ $certificates->count() }}</h3>
            <p style="color: #6b7280; margin: 0;">إجمالي الشهادات</p>
        </div>

        <div class="stat-card" style="background: white; padding: 25px; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); text-align: center;">
            <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #3b82f6, #2563eb); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px; color: white; font-size: 1.5rem;">
                <i class="bi bi-calendar-check"></i>
            </div>
            <h3 style="font-size: 2rem; color: #1f2937; margin-bottom: 5px;">{{ $certificates->where('created_at', '>=', now()->subDays(30))->count() }}</h3>
            <p style="color: #6b7280; margin: 0;">شهادات هذا الشهر</p>
        </div>

        <div class="stat-card" style="background: white; padding: 25px; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); text-align: center;">
            <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #f59e0b, #d97706); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px; color: white; font-size: 1.5rem;">
                <i class="bi bi-star"></i>
            </div>
            <h3 style="font-size: 2rem; color: #1f2937; margin-bottom: 5px;">{{ $certificates->avg('score') ? number_format($certificates->avg('score'), 1) : 'N/A' }}</h3>
            <p style="color: #6b7280; margin: 0;">متوسط الدرجات</p>
        </div>
    </div>

    <!-- Filters -->
    <div class="filters-section" style="background: white; padding: 20px; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); margin-bottom: 30px;">
        <form method="GET" action="{{ route('student.certificates') }}" style="display: flex; gap: 15px; align-items: end; flex-wrap: wrap;">
            <!-- Course Filter -->
            <div style="flex: 1; min-width: 200px;">
                <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">الدورة</label>
                <select name="course" style="width: 100%; padding: 12px; border: 2px solid #e5e7eb; border-radius: 10px; font-size: 1rem;">
                    <option value="">جميع الدورات</option>
                    @foreach($certificates->pluck('course')->unique() as $course)
                        <option value="{{ $course->id }}" {{ request('course') == $course->id ? 'selected' : '' }}>
                            {{ $course->title_ar }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Date Filter -->
            <div style="flex: 1; min-width: 200px;">
                <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">تاريخ الإصدار</label>
                <select name="date_filter" style="width: 100%; padding: 12px; border: 2px solid #e5e7eb; border-radius: 10px; font-size: 1rem;">
                    <option value="">جميع التواريخ</option>
                    <option value="this_month" {{ request('date_filter') == 'this_month' ? 'selected' : '' }}>هذا الشهر</option>
                    <option value="last_month" {{ request('date_filter') == 'last_month' ? 'selected' : '' }}>الشهر الماضي</option>
                    <option value="this_year" {{ request('date_filter') == 'this_year' ? 'selected' : '' }}>هذا العام</option>
                </select>
            </div>

            <!-- Search -->
            <div style="flex: 1; min-width: 200px;">
                <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">البحث</label>
                <input type="text" name="search" value="{{ request('search') }}" 
                       placeholder="ابحث في الشهادات..."
                       style="width: 100%; padding: 12px; border: 2px solid #e5e7eb; border-radius: 10px; font-size: 1rem;">
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit" class="btn btn-primary" style="padding: 12px 20px; border-radius: 10px;">
                    <i class="bi bi-search"></i>
                    بحث
                </button>
            </div>
        </form>
    </div>

    <!-- Certificates Grid -->
    @if($certificates->count() > 0)
        <div class="certificates-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(350px, 1fr)); gap: 20px;">
            @foreach($certificates as $certificate)
                <div class="certificate-card" style="background: white; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); overflow: hidden; transition: transform 0.3s ease;">
                    <div style="position: relative;">
                        <!-- Certificate Background -->
                        <div style="background: linear-gradient(135deg, #10b981, #059669); height: 120px; position: relative; overflow: hidden;">
                            <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); color: white; text-align: center;">
                                <i class="bi bi-award" style="font-size: 3rem; opacity: 0.3;"></i>
                            </div>
                            <div style="position: absolute; top: 15px; right: 15px; background: rgba(255,255,255,0.2); color: white; padding: 4px 8px; border-radius: 10px; font-size: 0.8rem;">
                                {{ $certificate->created_at->format('Y-m-d') }}
                            </div>
                        </div>
                        
                        <!-- Score Badge -->
                        @if($certificate->score)
                            <div style="position: absolute; top: 15px; left: 15px; background: #fbbf24; color: white; padding: 6px 12px; border-radius: 20px; font-size: 0.8rem; font-weight: 600;">
                                {{ $certificate->score }}%
                            </div>
                        @endif
                    </div>

                    <div style="padding: 20px;">
                        <!-- Certificate Info -->
                        <div style="margin-bottom: 15px;">
                            <h3 style="font-size: 1.2rem; margin-bottom: 8px; color: #1f2937; line-height: 1.4;">{{ $certificate->course->title_ar }}</h3>
                            <p style="color: #6b7280; font-size: 0.9rem; margin-bottom: 10px;">{{ $certificate->course->instructor->name }}</p>
                            <div style="color: #10b981; font-size: 0.8rem; font-weight: 500;">
                                {{ $certificate->course->category->name_ar ?? 'غير محدد' }}
                            </div>
                        </div>

                        <!-- Certificate Details -->
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; font-size: 0.8rem; color: #6b7280;">
                            <div>
                                <i class="bi bi-calendar"></i>
                                {{ $certificate->created_at->format('Y-m-d') }}
                            </div>
                            <div>
                                <i class="bi bi-clock"></i>
                                {{ $certificate->created_at->format('H:i') }}
                            </div>
                            <div>
                                <i class="bi bi-hash"></i>
                                #{{ $certificate->id }}
                            </div>
                        </div>

                        <!-- Certificate Status -->
                        <div style="margin-bottom: 15px;">
                            @if($certificate->status == 'issued')
                                <span style="background: #10b981; color: white; padding: 4px 12px; border-radius: 15px; font-size: 0.8rem; font-weight: 500;">
                                    <i class="bi bi-check-circle"></i>
                                    صادرة
                                </span>
                            @elseif($certificate->status == 'pending')
                                <span style="background: #f59e0b; color: white; padding: 4px 12px; border-radius: 15px; font-size: 0.8rem; font-weight: 500;">
                                    <i class="bi bi-clock"></i>
                                    قيد المعالجة
                                </span>
                            @else
                                <span style="background: #6b7280; color: white; padding: 4px 12px; border-radius: 15px; font-size: 0.8rem; font-weight: 500;">
                                    <i class="bi bi-question-circle"></i>
                                    غير محدد
                                </span>
                            @endif
                        </div>

                        <!-- Action Buttons -->
                        <div style="display: flex; gap: 10px;">
                            <a href="{{ route('student.certificates.download', $certificate) }}" 
                               class="btn btn-primary" 
                               style="flex: 1; padding: 12px; font-size: 0.9rem; border-radius: 10px; text-align: center; text-decoration: none; display: inline-block;">
                                <i class="bi bi-download"></i>
                                تحميل الشهادة
                            </a>
                            <button class="btn btn-outline" 
                                    onclick="shareCertificate('{{ $certificate->id }}')"
                                    style="padding: 12px; font-size: 0.9rem; border-radius: 10px; text-align: center; text-decoration: none; display: inline-block; border: 2px solid #10b981; color: #10b981; background: transparent;">
                                <i class="bi bi-share"></i>
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @if($certificates->hasPages())
            <div style="margin-top: 40px; display: flex; justify-content: center;">
                {{ $certificates->appends(request()->query())->links() }}
            </div>
        @endif
    @else
        <!-- Empty State -->
        <div style="text-align: center; padding: 60px 20px;">
            <div style="width: 80px; height: 80px; background: #f3f4f6; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; color: #9ca3af; font-size: 2rem;">
                <i class="bi bi-award"></i>
            </div>
            <h3 style="font-size: 1.5rem; color: #374151; margin-bottom: 10px;">لا توجد شهادات بعد</h3>
            <p style="color: #6b7280; margin-bottom: 30px;">أكمل الدورات لتحصل على شهاداتك</p>
            <a href="{{ route('student.courses') }}" class="btn btn-primary" style="padding: 12px 24px; border-radius: 10px;">
                استكشف دوراتي
            </a>
        </div>
    @endif
</div>

<style>
.certificate-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
}

.stat-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.15);
}

.btn {
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
    font-weight: 500;
}

.btn:hover {
    background: linear-gradient(135deg, #059669, #047857);
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3);
}

.btn-outline {
    background: transparent;
    border: 2px solid #10b981;
    color: #10b981;
}

.btn-outline:hover {
    background: #10b981;
    color: white;
}

@media (max-width: 768px) {
    .filters-section form {
        flex-direction: column;
    }
    
    .certificates-grid {
        grid-template-columns: 1fr;
    }
    
    .certificate-card .btn {
        flex-direction: column;
        gap: 10px;
    }
    
    .stats-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<script>
function shareCertificate(certificateId) {
    // Check if Web Share API is supported
    if (navigator.share) {
        navigator.share({
            title: 'شهادتي من أكاديمية السهم الأخضر',
            text: 'انظر إلى شهادتي الجديدة!',
            url: window.location.origin + '/student/certificates/' + certificateId
        }).catch(console.error);
    } else {
        // Fallback: copy to clipboard
        const url = window.location.origin + '/student/certificates/' + certificateId;
        navigator.clipboard.writeText(url).then(() => {
            alert('تم نسخ رابط الشهادة إلى الحافظة');
        }).catch(() => {
            alert('رابط الشهادة: ' + url);
        });
    }
}
</script>
@endsection 