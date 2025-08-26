@extends('layouts.app')

@section('title', 'الدورات التدريبية - أكاديمية السهم الأخضر للتدريب')

@section('content')
<!-- Hero Section -->
<section class="hero-section" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; padding: 100px 0; text-align: center; margin: -40px 0 60px 0; position: relative; overflow: hidden; width: 100%; max-width: 100%;">
    <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: url('data:image/svg+xml,<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 100 100\"><defs><pattern id=\"grain\" width=\"100\" height=\"100\" patternUnits=\"userSpaceOnUse\"><circle cx=\"25\" cy=\"25\" r=\"1\" fill=\"white\" opacity=\"0.1\"/><circle cx=\"75\" cy=\"75\" r=\"1\" fill=\"white\" opacity=\"0.1\"/><circle cx=\"50\" cy=\"10\" r=\"0.5\" fill=\"white\" opacity=\"0.1\"/><circle cx=\"10\" cy=\"60\" r=\"0.5\" fill=\"white\" opacity=\"0.1\"/><circle cx=\"90\" cy=\"40\" r=\"0.5\" fill=\"white\" opacity=\"0.1\"/></pattern></defs><rect width=\"100\" height=\"100\" fill=\"url(%23grain)\"/></svg>'); opacity: 0.3;"></div>
    <div class="container" style="position: relative; z-index: 2;">
        <h1 style="font-size: 3.5rem; margin-bottom: 20px; font-weight: 800; text-shadow: 0 4px 8px rgba(0,0,0,0.3);">الدورات التدريبية</h1>
        <p style="font-size: 1.3rem; max-width: 700px; margin: 0 auto 30px; opacity: 0.95; line-height: 1.6;">
            اكتشف مجموعة واسعة من الدورات التدريبية عالية الجودة في مختلف المجالات
        </p>
        <div style="display: flex; justify-content: center; gap: 20px; flex-wrap: wrap;">
            <div style="background: rgba(255,255,255,0.2); padding: 15px 25px; border-radius: 25px; backdrop-filter: blur(10px);">
                <i class="bi bi-book" style="font-size: 1.5rem; margin-left: 10px;"></i>
                <span>{{ $courses->total() }} دورة متاحة</span>
            </div>
            <div style="background: rgba(255,255,255,0.2); padding: 15px 25px; border-radius: 25px; backdrop-filter: blur(10px);">
                <i class="bi bi-people" style="font-size: 1.5rem; margin-left: 10px;"></i>
                <span>{{ $categories->count() }} قسم مختلف</span>
            </div>
            <div style="background: rgba(255,255,255,0.2); padding: 15px 25px; border-radius: 25px; backdrop-filter: blur(10px);">
                <i class="bi bi-star" style="font-size: 1.5rem; margin-left: 10px;"></i>
                <span>دورات مميزة</span>
            </div>
        </div>
    </div>
</section>

<!-- Search and Filter Section -->
<section class="search-filter mb-50">
    <div class="card" style="background: white; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); border: none;">
        <div class="card-body" style="padding: 30px;">
            <form action="{{ route('courses') }}" method="GET" style="display: grid; grid-template-columns: 1fr 1fr 1fr auto; gap: 20px; align-items: end;">
                <div>
                    <label for="search" style="display: block; margin-bottom: 10px; color: #374151; font-weight: 600; font-size: 0.95rem;">
                        <i class="bi bi-search" style="margin-left: 5px;"></i>
                        البحث في الدورات
                    </label>
                    <input type="text" id="search" name="search" 
                           value="{{ request('search') }}"
                           style="width: 100%; padding: 15px 20px; border: 2px solid #e5e7eb; border-radius: 12px; font-size: 1rem; transition: all 0.3s ease;"
                           placeholder="ابحث في الدورات...">
                </div>
                <div>
                    <label for="category" style="display: block; margin-bottom: 10px; color: #374151; font-weight: 600; font-size: 0.95rem;">
                        <i class="bi bi-grid" style="margin-left: 5px;"></i>
                        القسم
                    </label>
                    <select id="category" name="category" 
                            style="width: 100%; padding: 15px 20px; border: 2px solid #e5e7eb; border-radius: 12px; font-size: 1rem; transition: all 0.3s ease; background: white;">
                        <option value="">جميع الأقسام</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name_ar }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="level" style="display: block; margin-bottom: 10px; color: #374151; font-weight: 600; font-size: 0.95rem;">
                        <i class="bi bi-bar-chart" style="margin-left: 5px;"></i>
                        المستوى
                    </label>
                    <select id="level" name="level" 
                            style="width: 100%; padding: 15px 20px; border: 2px solid #e5e7eb; border-radius: 12px; font-size: 1rem; transition: all 0.3s ease; background: white;">
                        <option value="">جميع المستويات</option>
                        <option value="beginner" {{ request('level') == 'beginner' ? 'selected' : '' }}>مبتدئ</option>
                        <option value="intermediate" {{ request('level') == 'intermediate' ? 'selected' : '' }}>متوسط</option>
                        <option value="advanced" {{ request('level') == 'advanced' ? 'selected' : '' }}>متقدم</option>
                    </select>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary" style="padding: 15px 30px; border-radius: 12px; font-weight: 600; font-size: 1rem; background: linear-gradient(135deg, #10b981, #059669); border: none; box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);">
                        <i class="bi bi-search" style="margin-left: 8px;"></i>
                        بحث
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- Categories Section -->
<section class="categories-section mb-60">
    <div style="text-align: center; margin-bottom: 40px;">
        <h2 style="font-size: 2.5rem; margin-bottom: 15px; color: #1f2937; font-weight: 700;">استكشف الأقسام</h2>
        <p style="color: #6b7280; font-size: 1.1rem; max-width: 600px; margin: 0 auto;">اختر القسم الذي يناسب اهتماماتك وابدأ رحلة التعلم</p>
    </div>
    
    <div class="categories-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 25px;">
        @foreach($categories as $category)
        <a href="{{ route('courses') }}?category={{ $category->id }}" class="category-card" style="text-decoration: none; background: white; border-radius: 20px; padding: 30px; text-align: center; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(0,0,0,0.1); border: 2px solid transparent; position: relative; overflow: hidden;">
            <div style="position: absolute; top: 0; left: 0; right: 0; height: 4px; background: linear-gradient(135deg, {{ $category->color }}, {{ $category->color }}80);"></div>
            <div style="width: 80px; height: 80px; background: linear-gradient(135deg, {{ $category->color }}, {{ $category->color }}80); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; color: white; font-size: 2rem; box-shadow: 0 8px 25px {{ $category->color }}40;">
                <i class="bi {{ $category->icon ?: 'bi-book' }}"></i>
            </div>
            <h4 style="color: #1f2937; margin-bottom: 10px; font-size: 1.3rem; font-weight: 600;">{{ $category->name_ar }}</h4>
            <p style="color: #6b7280; font-size: 0.9rem; margin-bottom: 15px; line-height: 1.5;">{{ Str::limit($category->description_ar, 80) }}</p>
            <div style="background: #f8fafc; padding: 10px 15px; border-radius: 10px; display: inline-block;">
                <span style="color: #10b981; font-weight: 600; font-size: 0.9rem;">{{ $category->courses()->count() }} دورة</span>
            </div>
        </a>
        @endforeach
    </div>
</section>


<!-- All Courses -->
<section class="all-courses mb-60">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; flex-wrap: wrap; gap: 20px;">
        <div>
            <h2 style="font-size: 2.2rem; color: #1f2937; font-weight: 700; margin-bottom: 5px;">جميع الدورات</h2>
            <p style="color: #6b7280; font-size: 1rem;">اكتشف مجموعة متنوعة من الدورات التدريبية</p>
        </div>
        <div style="display: flex; gap: 10px; flex-wrap: wrap;">
            <select name="sort" onchange="this.form.submit()" style="padding: 10px 15px; border: 2px solid #e5e7eb; border-radius: 10px; font-size: 0.9rem; background: white;">
                <option value="latest" {{ request('sort', 'latest') == 'latest' ? 'selected' : '' }}>الأحدث</option>
                <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>الأكثر شعبية</option>
                <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>الأعلى تقييماً</option>
                <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>السعر: من الأقل</option>
                <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>السعر: من الأعلى</option>
            </select>
        </div>
    </div>
    
    @if($courses->count() > 0)
        <div class="courses-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(350px, 1fr)); gap: 25px;">
            @foreach($courses as $course)
            <div class="course-card" style="background: white; border-radius: 20px; overflow: hidden; box-shadow: 0 8px 25px rgba(0,0,0,0.1); transition: all 0.3s ease; border: 2px solid transparent;">
                <div style="position: relative;">
                    <img src="{{ $course->thumbnail ? asset('storage/' . $course->thumbnail) : 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80' }}" 
                         alt="{{ $course->title_ar }}" 
                         style="width: 100%; height: 200px; object-fit: cover;">
                    @if($course->is_featured)
                    <div style="position: absolute; top: 15px; right: 15px; background: linear-gradient(135deg, #fbbf24, #f59e0b); color: #1f2937; padding: 6px 12px; border-radius: 15px; font-size: 0.7rem; font-weight: 600;">
                        <i class="bi bi-star-fill" style="margin-left: 3px;"></i>
                        مميز
                    </div>
                    @endif
                    @if($course->discount_price)
                    <div style="position: absolute; top: 15px; left: 15px; background: linear-gradient(135deg, #ef4444, #dc2626); color: white; padding: 6px 12px; border-radius: 15px; font-size: 0.7rem; font-weight: 600;">
                        -{{ round((($course->price - $course->discount_price) / $course->price) * 100) }}%
                    </div>
                    @endif
                </div>
                <div style="padding: 20px;">
                    <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 12px;">
                        <div style="width: 35px; height: 35px; border-radius: 50%; background: linear-gradient(135deg, {{ $course->category->color }}, {{ $course->category->color }}80); display: flex; align-items: center; justify-content: center; color: white; font-size: 1rem;">
                            <i class="bi bi-{{ $course->category->icon ?: 'book' }}"></i>
                        </div>
                        <div>
                            <div style="color: #10b981; font-size: 0.75rem; font-weight: 600;">{{ $course->category->name_ar }}</div>
                            <div style="color: #6b7280; font-size: 0.75rem;">{{ $course->instructor->name }}</div>
                        </div>
                    </div>
                    
                    <h3 style="font-size: 1.1rem; margin-bottom: 8px; color: #1f2937; line-height: 1.4; font-weight: 600;">{{ $course->title_ar }}</h3>
                    <p style="color: #6b7280; font-size: 0.85rem; margin-bottom: 15px; line-height: 1.4;">{{ Str::limit($course->description_ar, 80) }}</p>
                    
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; font-size: 0.8rem; color: #6b7280;">
                        <div style="display: flex; align-items: center; gap: 3px;">
                            <i class="bi bi-clock"></i>
                            <span>{{ $course->duration_hours }} ساعة</span>
                        </div>
                        <div style="display: flex; align-items: center; gap: 3px;">
                            <i class="bi bi-people"></i>
                            <span>{{ $course->enrolled_count }} طالب</span>
                        </div>
                        <div style="display: flex; align-items: center; gap: 3px;">
                            <i class="bi bi-star-fill" style="color: #fbbf24;"></i>
                            <span>{{ $course->rating }}</span>
                        </div>
                    </div>
                    
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <div style="display: flex; align-items: center; gap: 8px;">
                            @if($course->is_free)
                                <span style="color: #10b981; font-weight: 600; font-size: 1rem;">مجاني</span>
                            @else
                                @if($course->discount_price)
                                    <span style="color: #6b7280; text-decoration: line-through; font-size: 0.8rem;">{{ $course->price }} ريال</span>
                                    <span style="color: #10b981; font-weight: 600; font-size: 1rem;">{{ $course->discount_price }} ريال</span>
                                @else
                                    <span style="color: #10b981; font-weight: 600; font-size: 1rem;">{{ $course->price }} ريال</span>
                                @endif
                            @endif
                        </div>
                        <a href="{{ route('courses.show', $course->slug) }}" class="btn btn-outline" style="padding: 8px 16px; border-radius: 8px; font-weight: 600; border: 2px solid #10b981; color: #10b981; text-decoration: none; transition: all 0.3s ease; font-size: 0.9rem;">
                            عرض التفاصيل
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <!-- Pagination -->
        @if($courses->hasPages())
            <div style="margin-top: 50px; display: flex; justify-content: center;">
                {{ $courses->appends(request()->query())->links() }}
            </div>
        @endif
    @else
        <!-- Empty State -->
        <div style="text-align: center; padding: 80px 20px;">
            <div style="width: 100px; height: 100px; background: #f3f4f6; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 30px; color: #9ca3af; font-size: 3rem;">
                <i class="bi bi-search"></i>
            </div>
            <h3 style="font-size: 1.8rem; color: #374151; margin-bottom: 15px;">لا توجد دورات</h3>
            <p style="color: #6b7280; margin-bottom: 30px; font-size: 1.1rem;">جرب تغيير معايير البحث أو استكشف جميع الأقسام</p>
            <a href="{{ route('courses') }}" class="btn btn-primary" style="padding: 15px 30px; border-radius: 12px; font-weight: 600; background: linear-gradient(135deg, #10b981, #059669); border: none; color: white; text-decoration: none;">
                عرض جميع الدورات
            </a>
        </div>
    @endif
</section>

<style>
/* Prevent horizontal scroll */
html, body {
    overflow-x: hidden;
    width: 100%;
    max-width: 100%;
}

.container {
    max-width: 100%;
    overflow-x: hidden;
}

/* Enhanced Hover Effects */
.category-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    border-color: #10b981;
}

.course-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.15);
    border-color: #10b981;
}

.featured-courses-grid .course-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.2);
}

/* Input Focus Effects */
input:focus, select:focus {
    outline: none;
    border-color: #10b981;
    box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
}

/* Button Hover Effects */
.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(16, 185, 129, 0.3);
}

.btn-outline:hover {
    background: #10b981;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(16, 185, 129, 0.3);
}

/* Responsive Design */
@media (max-width: 768px) {
    .hero-section h1 {
        font-size: 2.5rem;
    }
    
    .search-filter form {
        grid-template-columns: 1fr;
        gap: 15px;
    }
    
    .categories-grid {
        grid-template-columns: 1fr;
    }
    
    .featured-courses-grid,
    .courses-grid {
        grid-template-columns: 1fr;
    }
    
    .hero-section .container > div {
        flex-direction: column;
        gap: 15px;
    }
}

@media (max-width: 480px) {
    .hero-section {
        padding: 60px 0;
    }
    
    .hero-section h1 {
        font-size: 2rem;
    }
    
    .card-body {
        padding: 20px;
    }
}
</style>

<script>
// Add smooth scrolling and enhanced interactions
document.addEventListener('DOMContentLoaded', function() {
    // Add loading animation to course cards
    const courseCards = document.querySelectorAll('.course-card');
    courseCards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        setTimeout(() => {
            card.style.transition = 'all 0.6s ease';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 100);
    });
    
    // Add category card animations
    const categoryCards = document.querySelectorAll('.category-card');
    categoryCards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'scale(0.9)';
        setTimeout(() => {
            card.style.transition = 'all 0.6s ease';
            card.style.opacity = '1';
            card.style.transform = 'scale(1)';
        }, index * 150);
    });
});
</script>
@endsection 