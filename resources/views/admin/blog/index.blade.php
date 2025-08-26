@extends('layouts.admin')

@section('title', 'إدارة المدونة - لوحة الإدارة')

@section('content')
<div class="content-area">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="card-title">إدارة المدونة</h2>
                <a href="{{ route('admin.blog.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-lg"></i>
                    إضافة مقال جديد
                </a>
            </div>
        </div>
        
        <div class="card-body">
            <!-- Search and Filter -->
            <div class="mb-4">
                <form method="GET" action="{{ route('admin.blog') }}" class="row g-3">
                    <div class="col-md-6">
                        <input type="text" name="search" value="{{ request('search') }}" 
                               class="form-control" placeholder="البحث في المقالات">
                    </div>
                    <div class="col-md-3">
                        <select name="status" class="form-select">
                            <option value="">جميع الحالات</option>
                            <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>مسودة</option>
                            <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>منشور</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-secondary w-100">
                            <i class="bi bi-search"></i>
                            بحث
                        </button>
                    </div>
                </form>
            </div>

            <!-- Blog Posts -->
            <div class="row">
                @forelse($posts as $post)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        @if($post->featured_image)
                            <img src="{{ asset('storage/' . $post->featured_image) }}" 
                                 class="card-img-top" alt="{{ $post->title_ar }}" style="height: 200px; object-fit: cover;">
                        @else
                            <div class="card-img-top bg-light d-flex align-items-center justify-content-center" 
                                 style="height: 200px;">
                                <i class="bi bi-file-text text-muted" style="font-size: 3rem;"></i>
                            </div>
                        @endif
                        
                        <div class="card-body">
                            <h5 class="card-title">{{ $post->title_ar }}</h5>
                            @if($post->title_en)
                                <p class="text-muted small">{{ $post->title_en }}</p>
                            @endif
                            
                            @if($post->excerpt_ar)
                                <p class="card-text text-muted">{{ Str::limit($post->excerpt_ar, 100) }}</p>
                            @endif
                            
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="badge bg-{{ $post->status === 'published' ? 'success' : 'warning' }}">
                                    {{ $post->status === 'published' ? 'منشور' : 'مسودة' }}
                                </span>
                                <small class="text-muted">{{ $post->created_at->format('Y-m-d') }}</small>
                            </div>
                            
                            @if($post->author)
                                <div class="d-flex align-items-center mb-3">
                                    @if($post->author->profile_photo)
                                        <img src="{{ asset('storage/' . $post->author->profile_photo) }}" 
                                             alt="{{ $post->author->name }}" class="rounded-circle me-2" width="30" height="30">
                                    @else
                                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2" 
                                             style="width: 30px; height: 30px; font-size: 12px;">
                                            {{ strtoupper(substr($post->author->name, 0, 1)) }}
                                        </div>
                                    @endif
                                    <small class="text-muted">{{ $post->author->name }}</small>
                                </div>
                            @endif
                            
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.blog.edit', $post) }}" 
                                   class="btn btn-sm btn-outline-primary flex-fill">
                                    <i class="bi bi-pencil"></i>
                                    تعديل
                                </a>
                                <form method="POST" action="{{ route('admin.blog.delete', $post) }}" 
                                      style="display: inline;" onsubmit="return confirm('هل أنت متأكد من حذف هذا المقال؟')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="حذف">
                                        <i class="bi bi-trash"></i>
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
                            <i class="bi bi-file-text fs-1 d-block mb-3"></i>
                            <h4>لا توجد مقالات</h4>
                            <p>لم يتم إنشاء أي مقالات بعد. ابدأ بإنشاء مقال جديد.</p>
                            <a href="{{ route('admin.blog.create') }}" class="btn btn-primary">
                                <i class="bi bi-plus-lg"></i>
                                إضافة مقال جديد
                            </a>
                        </div>
                    </div>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($posts->hasPages())
            <div class="d-flex justify-content-center mt-4">
                <nav aria-label="صفحات المقالات">
                    {{ $posts->appends(request()->query())->links('pagination::bootstrap-5') }}
                </nav>
            </div>
            @endif
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

.card-title {
    font-weight: 600;
    color: #1f2937;
    margin-bottom: 0.5rem;
}

.card-text {
    font-size: 0.9rem;
    line-height: 1.5;
}

.badge {
    font-size: 0.75rem;
    padding: 0.375rem 0.75rem;
}

.btn-sm {
    padding: 0.5rem 1rem;
    font-size: 0.875rem;
}

.form-control, .form-select {
    border-radius: 8px;
    border: 1px solid #d1d5db;
    padding: 0.5rem 0.75rem;
}

.form-control:focus, .form-select:focus {
    border-color: #10b981;
    box-shadow: 0 0 0 0.2rem rgba(16, 185, 129, 0.25);
}
</style>
@endsection 