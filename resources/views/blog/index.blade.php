@extends('layouts.app')

@section('title', 'المدونة - أكاديمية السهم الأخضر للتدريب')

@section('content')
<!-- Enhanced Hero Section -->
<section class="hero-section">
    <div class="hero-background">
        <div class="hero-particles"></div>
        <div class="hero-gradient"></div>
    </div>
    <div class="container">
        <div class="hero-content">
            <div class="hero-badge">
                <i class="bi bi-journal-text"></i>
                <span>المدونة التعليمية</span>
            </div>
            <h1 class="hero-title">المدونة</h1>
            <p class="hero-subtitle">
                اكتشف أحدث المقالات والأخبار في مجال التعليم والتدريب والتطوير المهني
            </p>
            
            <!-- Enhanced Search Bar -->
            <div class="search-container">
                <form action="{{ route('blog') }}" method="GET" class="search-form">
                    <div class="search-input-group">
                        <i class="bi bi-search search-icon"></i>
                        <input type="text" 
                               name="search" 
                           value="{{ request('search') }}"
                               placeholder="البحث في المقالات..." 
                               class="search-input">
                        <select name="category" class="category-select">
                        <option value="">جميع التصنيفات</option>
                        @foreach($categories as $category)
                            <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                                {{ $category }}
                            </option>
                        @endforeach
                    </select>
                        <button type="submit" class="search-button">
                            <i class="bi bi-arrow-left"></i>
                        بحث
                    </button>
                </div>
            </form>
            </div>

            <!-- Stats -->
            <div class="hero-stats">
                <div class="stat-item">
                    <div class="stat-number" data-target="{{ $posts->total() }}">0</div>
                    <div class="stat-label">مقال</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number" data-target="{{ $featuredPosts->count() }}">0</div>
                    <div class="stat-label">مقال مميز</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number" data-target="50">0</div>
                    <div class="stat-label">كاتب محترف</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Blog Content Section -->
<section class="blog-section">
    <div class="container">
        @if($featuredPosts->count() > 0)
<!-- Featured Posts -->
        <section class="featured-posts">
            <div class="section-header">
                <div class="section-badge">
                    <i class="bi bi-star"></i>
                    <span>المقالات المميزة</span>
                </div>
                <h2 class="section-title">أفضل المقالات</h2>
            </div>
            <div class="featured-grid">
                @foreach($featuredPosts as $post)
                <div class="featured-card">
                    <div class="card-image">
                        <img src="{{ $post->featured_image ? asset('storage/' . $post->featured_image) : 'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80' }}" 
                             alt="{{ $post->title_ar }}">
                        <div class="image-overlay">
                            <div class="featured-badge">
                                <i class="bi bi-star-fill"></i>
                                مميز
                            </div>
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="post-meta">
                            <div class="meta-item">
                                <i class="bi bi-calendar3"></i>
                                <span>{{ $post->published_at->format('Y/m/d') }}</span>
                            </div>
                            <div class="meta-item">
                                <i class="bi bi-eye"></i>
                                <span>{{ $post->views_count }} مشاهدة</span>
                            </div>
                            <div class="meta-item">
                                <i class="bi bi-tag"></i>
                                <span>{{ $post->category }}</span>
                            </div>
                </div>
                        <h3 class="post-title">
                            <a href="{{ route('blog.post', $post->slug) }}">
                        {{ $post->title_ar }}
                    </a>
                </h3>
                        <p class="post-excerpt">
                    {{ Str::limit($post->excerpt_ar ?: $post->content_ar, 120) }}
                </p>
                        <div class="post-footer">
                            <div class="author-info">
                        <img src="{{ $post->author->avatar_url }}" 
                             alt="{{ $post->author->name }}" 
                                     class="author-avatar">
                                <span class="author-name">{{ $post->author->name }}</span>
                    </div>
                            <a href="{{ route('blog.post', $post->slug) }}" class="read-more-btn">
                                <i class="bi bi-arrow-left"></i>
                        اقرأ المزيد
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>
@endif

<!-- All Posts -->
<section class="all-posts">
            <div class="section-header">
                <div class="section-badge">
                    <i class="bi bi-journal-text"></i>
                    <span>جميع المقالات</span>
                </div>
                <h2 class="section-title">أحدث المقالات</h2>
            </div>
    
    @if($posts->count() > 0)
            <div class="posts-grid">
        @foreach($posts as $post)
                <div class="post-card">
                    <div class="card-image">
                <img src="{{ $post->featured_image ? asset('storage/' . $post->featured_image) : 'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80' }}" 
                             alt="{{ $post->title_ar }}">
                        <div class="image-overlay">
                            <div class="category-badge">
                                {{ $post->category }}
                            </div>
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="post-meta">
                            <div class="meta-item">
                                <i class="bi bi-calendar3"></i>
                                <span>{{ $post->published_at->format('Y/m/d') }}</span>
                            </div>
                            <div class="meta-item">
                                <i class="bi bi-eye"></i>
                                <span>{{ $post->views_count }}</span>
            </div>
                </div>
                        <h3 class="post-title">
                            <a href="{{ route('blog.post', $post->slug) }}">
                        {{ $post->title_ar }}
                    </a>
                </h3>
                        <p class="post-excerpt">
                    {{ Str::limit($post->excerpt_ar ?: $post->content_ar, 100) }}
                </p>
                        <div class="post-footer">
                            <span class="category-tag">{{ $post->category }}</span>
                            <a href="{{ route('blog.post', $post->slug) }}" class="read-more-btn">
                                <i class="bi bi-arrow-left"></i>
                        اقرأ المزيد
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
            <!-- Enhanced Pagination -->
            <div class="pagination-container">
        {{ $posts->appends(request()->query())->links() }}
    </div>
    @else
            <!-- No Results -->
            <div class="no-results">
                <div class="no-results-icon">
                    <i class="bi bi-search"></i>
                </div>
                <h3>لا توجد مقالات</h3>
                <p>لم يتم العثور على مقالات تطابق معايير البحث الخاصة بك.</p>
                <a href="{{ route('blog') }}" class="btn btn-primary">
                <i class="bi bi-arrow-right"></i>
                عرض جميع المقالات
            </a>
        </div>
            @endif
        </section>
    </div>
</section>

<!-- Newsletter Section -->
<section class="newsletter-section">
    <div class="container">
        <div class="newsletter-content">
            <div class="newsletter-badge">
                <i class="bi bi-envelope"></i>
                <span>النشرة الإخبارية</span>
            </div>
            <h2>اشترك في النشرة الإخبارية</h2>
            <p>احصل على أحدث المقالات والأخبار مباشرة في بريدك الإلكتروني</p>
            <form class="newsletter-form">
                <div class="form-group">
                    <input type="email" placeholder="أدخل بريدك الإلكتروني" class="newsletter-input">
                    <button type="submit" class="newsletter-btn">
            <i class="bi bi-envelope"></i>
            اشتراك
        </button>
                </div>
    </form>
        </div>
    </div>
</section>

<style>
/* Hero Section */
.hero-section {
    position: relative;
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: white;
    padding: 120px 0 80px;
    margin: -40px -20px 80px -20px;
    overflow: hidden;
}

.hero-background {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
}

.hero-particles {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-image: 
        radial-gradient(circle at 20% 50%, rgba(255,255,255,0.1) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(255,255,255,0.08) 0%, transparent 50%),
        radial-gradient(circle at 40% 80%, rgba(255,255,255,0.06) 0%, transparent 50%);
    animation: floatingLights 8s ease-in-out infinite;
}

.hero-gradient {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(45deg, rgba(16, 185, 129, 0.9) 0%, rgba(5, 150, 105, 0.9) 100%);
}

.hero-content {
    position: relative;
    z-index: 2;
    text-align: center;
    max-width: 800px;
    margin: 0 auto;
}

.hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
    padding: 12px 24px;
    border-radius: 50px;
    font-size: 0.9rem;
    font-weight: 500;
    margin-bottom: 30px;
    border: 1px solid rgba(255, 255, 255, 0.3);
}

.hero-title {
    font-size: 4rem;
    font-weight: 900;
    margin-bottom: 20px;
    background: linear-gradient(45deg, #ffffff, #f0f9ff);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.hero-subtitle {
    font-size: 1.3rem;
    margin-bottom: 50px;
    opacity: 0.95;
    line-height: 1.6;
}

/* Search Container */
.search-container {
    margin-bottom: 50px;
}

.search-form {
    max-width: 700px;
    margin: 0 auto;
}

.search-input-group {
    display: flex;
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(10px);
    border-radius: 50px;
    border: 1px solid rgba(255, 255, 255, 0.3);
    overflow: hidden;
    transition: all 0.3s ease;
}

.search-input-group:focus-within {
    background: rgba(255, 255, 255, 0.25);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
}

.search-icon {
    padding: 15px 20px;
    color: rgba(255, 255, 255, 0.8);
    font-size: 1.2rem;
}

.search-input {
    flex: 1;
    padding: 15px 0;
    background: transparent;
    border: none;
    color: white;
    font-size: 1.1rem;
    outline: none;
}

.search-input::placeholder {
    color: rgba(255, 255, 255, 0.7);
}

.category-select {
    padding: 15px 20px;
    background: rgba(255, 255, 255, 0.1);
    border: none;
    color: white;
    font-size: 1rem;
    outline: none;
    border-left: 1px solid rgba(255, 255, 255, 0.2);
}

.category-select option {
    background: #1f2937;
    color: white;
}

.search-button {
    padding: 15px 30px;
    background: rgba(255, 255, 255, 0.2);
    border: none;
    color: white;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 8px;
}

.search-button:hover {
    background: rgba(255, 255, 255, 0.3);
}

/* Hero Stats */
.hero-stats {
    display: flex;
    justify-content: center;
    gap: 60px;
    flex-wrap: wrap;
}

.stat-item {
    text-align: center;
}

.stat-number {
    font-size: 3rem;
    font-weight: 900;
    color: #ffffff;
    margin-bottom: 8px;
}

.stat-label {
    font-size: 1rem;
    opacity: 0.9;
    font-weight: 500;
}

/* Blog Section */
.blog-section {
    padding: 80px 0;
}

.section-header {
    text-align: center;
    margin-bottom: 60px;
}

.section-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
    padding: 12px 24px;
    border-radius: 50px;
    font-size: 0.9rem;
    font-weight: 500;
    margin-bottom: 20px;
}

.section-title {
    font-size: 3rem;
    font-weight: 800;
    color: #1f2937;
    margin-bottom: 20px;
}

/* Featured Posts */
.featured-posts {
    margin-bottom: 80px;
}

.featured-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
    gap: 30px;
}

.featured-card {
    background: white;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    border: 1px solid #e2e8f0;
}

.featured-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 30px 60px rgba(0, 0, 0, 0.15);
}

.card-image {
    position: relative;
    height: 250px;
    overflow: hidden;
}

.card-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.featured-card:hover .card-image img {
    transform: scale(1.05);
}

.image-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(45deg, rgba(16, 185, 129, 0.2), rgba(5, 150, 105, 0.2));
    opacity: 0;
    transition: opacity 0.3s ease;
}

.featured-card:hover .image-overlay {
    opacity: 1;
}

.featured-badge {
    position: absolute;
    top: 15px;
    right: 15px;
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 5px;
}

.category-badge {
    position: absolute;
    top: 15px;
    right: 15px;
    background: rgba(0, 0, 0, 0.7);
    color: white;
    padding: 6px 12px;
    border-radius: 15px;
    font-size: 0.8rem;
    font-weight: 500;
}

.card-content {
    padding: 25px;
}

.post-meta {
    display: flex;
    align-items: center;
    gap: 20px;
    margin-bottom: 15px;
    font-size: 0.85rem;
    color: #6b7280;
    flex-wrap: wrap;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 5px;
}

.post-title {
    font-size: 1.4rem;
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 15px;
    line-height: 1.4;
}

.post-title a {
    color: inherit;
    text-decoration: none;
    transition: color 0.3s ease;
}

.post-title a:hover {
    color: #10b981;
}

.post-excerpt {
    color: #6b7280;
    line-height: 1.6;
    margin-bottom: 20px;
    font-size: 0.95rem;
}

.post-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 15px;
}

.author-info {
    display: flex;
    align-items: center;
    gap: 10px;
}

.author-avatar {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    object-fit: cover;
}

.author-name {
    font-size: 0.9rem;
    color: #6b7280;
    font-weight: 500;
}

.read-more-btn {
    display: flex;
    align-items: center;
    gap: 5px;
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
    padding: 8px 16px;
    border-radius: 20px;
    text-decoration: none;
    font-size: 0.85rem;
    font-weight: 600;
    transition: all 0.3s ease;
}

.read-more-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3);
    color: white;
}

.category-tag {
    background: #f3f4f6;
    color: #6b7280;
    padding: 6px 12px;
    border-radius: 15px;
    font-size: 0.8rem;
    font-weight: 500;
}

/* All Posts */
.all-posts {
    margin-bottom: 80px;
}

.posts-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 30px;
    margin-bottom: 60px;
}

.post-card {
    background: white;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    border: 1px solid #e2e8f0;
}

.post-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 30px 60px rgba(0, 0, 0, 0.15);
}

.post-card .card-image {
    height: 200px;
}

/* Pagination */
.pagination-container {
    text-align: center;
}

/* No Results */
.no-results {
    text-align: center;
    padding: 80px 20px;
}

.no-results-icon {
    font-size: 5rem;
    color: #e5e7eb;
    margin-bottom: 30px;
}

.no-results h3 {
    font-size: 2rem;
    color: #1f2937;
    margin-bottom: 15px;
    font-weight: 700;
}

.no-results p {
    color: #6b7280;
    font-size: 1.1rem;
    margin-bottom: 30px;
}

/* Newsletter Section */
.newsletter-section {
    background: linear-gradient(135deg, #1f2937 0%, #374151 100%);
    color: white;
    padding: 80px 0;
    border-radius: 20px;
    margin: 80px 0;
}

.newsletter-content {
    text-align: center;
    max-width: 600px;
    margin: 0 auto;
}

.newsletter-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
    padding: 12px 24px;
    border-radius: 50px;
    font-size: 0.9rem;
    font-weight: 500;
    margin-bottom: 30px;
    border: 1px solid rgba(255, 255, 255, 0.3);
}

.newsletter-content h2 {
    font-size: 3rem;
    font-weight: 800;
    margin-bottom: 20px;
}

.newsletter-content p {
    font-size: 1.2rem;
    margin-bottom: 40px;
    opacity: 0.9;
    line-height: 1.6;
}

.newsletter-form {
    max-width: 500px;
    margin: 0 auto;
}

.form-group {
    display: flex;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    border-radius: 50px;
    border: 1px solid rgba(255, 255, 255, 0.3);
    overflow: hidden;
}

.newsletter-input {
    flex: 1;
    padding: 15px 20px;
    background: transparent;
    border: none;
    color: white;
    font-size: 1rem;
    outline: none;
}

.newsletter-input::placeholder {
    color: rgba(255, 255, 255, 0.7);
}

.newsletter-btn {
    padding: 15px 30px;
    background: linear-gradient(135deg, #10b981, #059669);
    border: none;
    color: white;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 8px;
}

.newsletter-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3);
}

/* Buttons */
.btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 15px 30px;
    border-radius: 50px;
    font-size: 1rem;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
}

.btn-primary {
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
}

.btn-primary:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 30px rgba(16, 185, 129, 0.3);
    color: white;
}

/* Animations */
@keyframes floatingLights {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-20px) rotate(180deg); }
}

/* Responsive Design */
@media (max-width: 768px) {
    .hero-title {
        font-size: 2.5rem;
    }
    
    .hero-stats {
        gap: 30px;
    }
    
    .stat-number {
        font-size: 2rem;
    }
    
    .featured-grid {
        grid-template-columns: 1fr;
    }
    
    .posts-grid {
        grid-template-columns: 1fr;
    }
    
    .search-input-group {
        flex-direction: column;
        border-radius: 15px;
    }
    
    .search-button {
        border-radius: 0 0 15px 15px;
    }
    
    .form-group {
        flex-direction: column;
        border-radius: 15px;
    }
    
    .newsletter-btn {
        border-radius: 0 0 15px 15px;
    }
    
    .newsletter-content h2 {
        font-size: 2rem;
    }
}

@media (max-width: 480px) {
    .hero-section {
        padding: 80px 0 60px;
    }
    
    .hero-title {
        font-size: 2rem;
    }
    
    .hero-subtitle {
        font-size: 1.1rem;
    }
    
    .section-title {
        font-size: 2rem;
    }
    
    .featured-card,
    .post-card {
        margin: 0 10px;
    }
    
    .post-footer {
        flex-direction: column;
        align-items: flex-start;
    }
}
</style>

<script>
// Animate statistics on scroll
function animateStats() {
    const stats = document.querySelectorAll('.stat-number');
    
    stats.forEach(stat => {
        const target = parseInt(stat.getAttribute('data-target'));
        const duration = 2000; // 2 seconds
        const increment = target / (duration / 16); // 60fps
        let current = 0;
        
        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                current = target;
                clearInterval(timer);
            }
            stat.textContent = Math.floor(current).toLocaleString();
        }, 16);
    });
}

// Intersection Observer for animations
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            if (entry.target.classList.contains('hero-stats')) {
                animateStats();
            }
            entry.target.style.opacity = '1';
            entry.target.style.transform = 'translateY(0)';
        }
    });
}, observerOptions);

// Observe elements for animation
document.addEventListener('DOMContentLoaded', () => {
    const animatedElements = document.querySelectorAll('.featured-card, .post-card');
    
    animatedElements.forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(30px)';
        el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(el);
    });
    
    // Observe hero stats
    const heroStats = document.querySelector('.hero-stats');
    if (heroStats) {
        observer.observe(heroStats);
    }
});
</script>
@endsection 