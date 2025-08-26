@extends('layouts.admin')

@section('title', 'إدارة الأقسام - لوحة الإدارة')

@section('content')
<div class="content-area">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="card-title">إدارة الأقسام</h2>
                <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-lg"></i>
                    إضافة قسم جديد
                </a>
            </div>
        </div>
        
        <div class="card-body">
            <!-- Categories Grid -->
            <div class="row">
                @forelse($categories as $category)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="category-icon me-3" style="background-color: {{ $category->color }}; width: 50px; height: 50px; border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                                    @if($category->icon)
                                        <i class="{{ $category->icon }}" style="font-size: 24px; color: white;"></i>
                                    @else
                                        <i class="bi bi-folder" style="font-size: 24px; color: white;"></i>
                                    @endif
                                </div>
                                <div class="flex-grow-1">
                                    <h5 class="card-title mb-1">{{ $category->name_ar }}</h5>
                                    @if($category->name_en)
                                        <small class="text-muted">{{ $category->name_en }}</small>
                                    @endif
                                </div>
                            </div>
                            
                            @if($category->description_ar)
                                <p class="card-text text-muted mb-3">{{ Str::limit($category->description_ar, 100) }}</p>
                            @endif
                            
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="badge bg-info">
                                    <i class="bi bi-book"></i>
                                    {{ $category->courses_count }} دورة
                                </span>
                                @if($category->is_active)
                                    <span class="badge bg-success">نشط</span>
                                @else
                                    <span class="badge bg-secondary">غير نشط</span>
                                @endif
                            </div>
                            
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.categories.edit', $category) }}" 
                                   class="btn btn-sm btn-outline-primary flex-fill">
                                    <i class="bi bi-pencil"></i>
                                    تعديل
                                </a>
                                <form method="POST" action="{{ route('admin.categories.delete', $category) }}" 
                                      style="display: inline;" onsubmit="return confirm('هل أنت متأكد من حذف هذا القسم؟')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" 
                                            {{ $category->courses_count > 0 ? 'disabled' : '' }}
                                            title="{{ $category->courses_count > 0 ? 'لا يمكن حذف القسم لوجود دورات مرتبطة به' : 'حذف القسم' }}">
                                        <i class="bi bi-trash"></i>
                                        حذف
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="text-center py-5">
                        <div class="text-muted">
                            <i class="bi bi-folder-x fs-1 d-block mb-3"></i>
                            <h4>لا توجد أقسام</h4>
                            <p>لم يتم إنشاء أي أقسام بعد. ابدأ بإنشاء قسم جديد لإدارة الدورات.</p>
                            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
                                <i class="bi bi-plus-lg"></i>
                                إضافة قسم جديد
                            </a>
                        </div>
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<style>
.card {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
}

.category-icon {
    transition: transform 0.2s ease;
}

.card:hover .category-icon {
    transform: scale(1.1);
}

.badge {
    font-size: 0.75rem;
    padding: 0.5rem 0.75rem;
}

.btn-sm {
    padding: 0.5rem 1rem;
    font-size: 0.875rem;
}

.card-title {
    font-weight: 600;
    color: #1f2937;
    margin-bottom: 0.5rem;
}

.card-text {
    font-size: 0.9rem;
    line-height: 1.5;
}

.text-muted {
    color: #6b7280 !important;
}
</style>
@endsection 