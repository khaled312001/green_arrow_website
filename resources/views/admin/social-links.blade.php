@extends('layouts.admin')

@section('title', 'روابط التواصل الاجتماعي - لوحة الإدارة')

@section('content')
<div class="content-area">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">
                        <i class="bi bi-share"></i>
                        روابط التواصل الاجتماعي
                    </h2>
                    <p class="text-muted mb-0">إدارة جميع روابط التواصل الاجتماعي الخاصة بالأكاديمية</p>
                </div>
                <div class="card-body">
                    <!-- إحصائيات سريعة -->
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div class="card bg-primary text-white">
                                <div class="card-body text-center">
                                    <h4>{{ count($socialLinks) }}</h4>
                                    <p class="mb-0">روابط مفعلة</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-success text-white">
                                <div class="card-body text-center">
                                    <h4>{{ count($allLinks) - count($socialLinks) }}</h4>
                                    <p class="mb-0">روابط غير مفعلة</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-info text-white">
                                <div class="card-body text-center">
                                    <h4>{{ count($allLinks) }}</h4>
                                    <p class="mb-0">إجمالي الروابط</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-warning text-white">
                                <div class="card-body text-center">
                                    <h4>{{ count($socialLinks) > 0 ? round((count($socialLinks) / count($allLinks)) * 100) : 0 }}%</h4>
                                    <p class="mb-0">نسبة التفعيل</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- الروابط المفعلة -->
                    @if(!empty($socialLinks))
                    <div class="mb-5">
                        <h4 class="mb-3">
                            <i class="bi bi-check-circle text-success"></i>
                            الروابط المفعلة
                        </h4>
                        <div class="row g-3">
                            @foreach($socialLinks as $platform => $link)
                            <div class="col-lg-4 col-md-6">
                                <div class="card border-success h-100">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mb-3">
                                            <i class="bi {{ $link['icon'] }} {{ $link['color'] }} fs-2 me-3"></i>
                                            <div>
                                                <h5 class="card-title mb-1">{{ $link['label'] }}</h5>
                                                <span class="badge bg-success">مفعل</span>
                                            </div>
                                        </div>
                                        <p class="card-text text-muted small mb-3">
                                            {{ $link['url'] }}
                                        </p>
                                        <div class="d-flex gap-2">
                                            <a href="{{ $link['url'] }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                <i class="bi bi-box-arrow-up-right"></i>
                                                فتح الرابط
                                            </a>
                                            <a href="{{ route('admin.settings') }}#social" class="btn btn-sm btn-outline-secondary">
                                                <i class="bi bi-pencil"></i>
                                                تعديل
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- جميع الروابط -->
                    <div class="mb-5">
                        <h4 class="mb-3">
                            <i class="bi bi-list"></i>
                            جميع الروابط المتاحة
                        </h4>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>المنصة</th>
                                        <th>الرابط</th>
                                        <th>الحالة</th>
                                        <th>الإجراءات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($allLinks as $platform => $link)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="bi {{ $link['icon'] }} {{ $link['color'] }} fs-4 me-2"></i>
                                                <span>{{ $link['label'] }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            @if(!empty($link['url']))
                                                <a href="{{ $link['url'] }}" target="_blank" class="text-decoration-none">
                                                    {{ Str::limit($link['url'], 50) }}
                                                    <i class="bi bi-box-arrow-up-right text-muted"></i>
                                                </a>
                                            @else
                                                <span class="text-muted">غير محدد</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if(!empty($link['url']))
                                                <span class="badge bg-success">مفعل</span>
                                            @else
                                                <span class="badge bg-secondary">غير مفعل</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.settings') }}#social" class="btn btn-sm btn-primary">
                                                <i class="bi bi-pencil"></i>
                                                تعديل
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- معاينة في الموقع -->
                    <div class="mb-5">
                        <h4 class="mb-3">
                            <i class="bi bi-eye"></i>
                            معاينة في الموقع
                        </h4>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">كيف تظهر الأيقونات في تذييل الموقع:</h5>
                                <div class="border rounded p-3 bg-light">
                                    <x-social-icons size="fs-4" :show-labels="false" container-class="d-flex gap-3 flex-wrap" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- نصائح -->
                    <div class="alert alert-info">
                        <h5><i class="bi bi-info-circle"></i> نصائح مهمة:</h5>
                        <ul class="mb-0">
                            <li>تأكد من أن جميع الروابط صحيحة وتعمل بشكل جيد</li>
                            <li>استخدم الروابط الرسمية للحسابات فقط</li>
                            <li>يمكنك تعديل الروابط من صفحة الإعدادات</li>
                            <li>الروابط المفعلة فقط ستظهر في الموقع</li>
                            <li>يتم تحديث الأيقونات تلقائياً عند تغيير الإعدادات</li>
                        </ul>
                    </div>

                    <!-- أزرار الإجراءات -->
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.settings') }}#social" class="btn btn-primary">
                            <i class="bi bi-gear"></i>
                            إدارة الإعدادات
                        </a>
                        <a href="{{ route('contact') }}" target="_blank" class="btn btn-outline-primary">
                            <i class="bi bi-eye"></i>
                            معاينة صفحة التواصل
                        </a>
                        <a href="{{ route('home') }}" target="_blank" class="btn btn-outline-secondary">
                            <i class="bi bi-house"></i>
                            معاينة الصفحة الرئيسية
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.card {
    border-radius: 10px;
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.table th {
    border-top: none;
    font-weight: 600;
}

.badge {
    font-size: 0.8rem;
    padding: 0.5rem 0.75rem;
}

.btn-sm {
    padding: 0.25rem 0.5rem;
    font-size: 0.875rem;
}
</style>
@endsection 