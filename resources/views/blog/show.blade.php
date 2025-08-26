@extends('layouts.app')

@section('title', $post->title_ar . ' - أكاديمية السهم الأخضر للتدريب')

@section('content')
<!-- Enhanced Breadcrumb -->
<nav class="breadcrumb-nav">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('home') }}">
                    <i class="bi bi-house"></i>
                    الرئيسية
                </a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('blog') }}">
                    <i class="bi bi-journal-text"></i>
                    المدونة
                </a>
            </li>
            <li class="breadcrumb-item active">{{ $post->title_ar }}</li>
        </ol>
    </div>
</nav>

<!-- Enhanced Article Header -->
<article class="blog-post">
    <header class="post-header">
        <div class="container">
            <div class="post-header-content">
                <!-- Category and Meta -->
                <div class="post-meta">
                    <div class="category-badge">
                        <i class="bi bi-tag"></i>
                        {{ $post->category }}
                    </div>
                    <div class="meta-items">
                        <div class="meta-item">
                            <i class="bi bi-calendar3"></i>
                            <span>{{ $post->published_at->format('Y/m/d') }}</span>
                        </div>
                        <div class="meta-item">
                            <i class="bi bi-eye"></i>
                            <span>{{ $post->views_count }} مشاهدة</span>
                        </div>
                        <div class="meta-item">
                            <i class="bi bi-clock"></i>
                            <span>{{ $post->published_at->diffForHumans() }}</span>
                        </div>
                        <div class="meta-item">
                            <i class="bi bi-book"></i>
                            <span>{{ $post->reading_time }} دقيقة قراءة</span>
                        </div>
                    </div>
                </div>
                
                <!-- Title -->
                <h1 class="post-title">{{ $post->title_ar }}</h1>
                
                <!-- Excerpt -->
                @if($post->excerpt_ar)
                <p class="post-excerpt">{{ $post->excerpt_ar }}</p>
                @endif
                
                <!-- Author Info -->
                <div class="author-card">
                    <div class="author-avatar">
                        <img src="{{ $post->author->avatar_url }}" alt="{{ $post->author->name }}">
                    </div>
                    <div class="author-info">
                        <h4 class="author-name">{{ $post->author->name }}</h4>
                        <p class="author-bio">{{ $post->author->bio ?: 'كاتب محترف متخصص في مجال التعليم والتدريب، يشارك خبراته ومعرفته من خلال مقالات قيمة ومفيدة.' }}</p>
                        <div class="author-social">
                            <a href="#" class="social-link">
                                <i class="bi bi-twitter"></i>
                            </a>
                            <a href="#" class="social-link">
                                <i class="bi bi-linkedin"></i>
                            </a>
                            <a href="#" class="social-link">
                                <i class="bi bi-globe"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    
    <!-- Featured Image -->
    @if($post->featured_image)
    <div class="featured-image-section">
        <div class="container">
            <div class="featured-image-container">
                <img src="{{ asset('storage/' . $post->featured_image) }}" 
                     alt="{{ $post->title_ar }}" 
                     class="featured-image">
            </div>
        </div>
    </div>
    @endif
    
    <!-- Article Content -->
    <div class="post-content-section">
        <div class="container">
            <div class="content-wrapper">
                <div class="post-content">
                    <div class="content-body">
                        {!! $post->content_ar !!}
                    </div>
                </div>
                
                <!-- Sidebar -->
                <aside class="post-sidebar">
                    <!-- Social Sharing -->
                    <div class="sidebar-card">
                        <h4 class="sidebar-title">
                            <i class="bi bi-share"></i>
                            شارك المقال
                        </h4>
                        <div class="social-sharing">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" 
                               target="_blank" 
                               class="social-btn facebook">
                                <i class="bi bi-facebook"></i>
                                فيسبوك
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($post->title_ar) }}" 
                               target="_blank" 
                               class="social-btn twitter">
                                <i class="bi bi-twitter"></i>
                                تويتر
                            </a>
                            <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}" 
                               target="_blank" 
                               class="social-btn linkedin">
                                <i class="bi bi-linkedin"></i>
                                لينكد إن
                            </a>
                            <a href="https://wa.me/?text={{ urlencode($post->title_ar . ' ' . request()->url()) }}" 
                               target="_blank" 
                               class="social-btn whatsapp">
                                <i class="bi bi-whatsapp"></i>
                                واتساب
                            </a>
                            <button onclick="copyToClipboard('{{ request()->url() }}')" 
                                    class="social-btn copy">
                                <i class="bi bi-link-45deg"></i>
                                نسخ الرابط
                            </button>
                        </div>
                    </div>
                    
                    <!-- Tags -->
                    @if($post->tags)
                    <div class="sidebar-card">
                        <h4 class="sidebar-title">
                            <i class="bi bi-tags"></i>
                            العلامات
                        </h4>
                        <div class="tags-container">
                            @if(is_array($post->tags))
                                @foreach($post->tags as $tag)
                                <span class="tag">{{ trim($tag) }}</span>
                                @endforeach
                            @else
                                @foreach(explode(',', $post->tags) as $tag)
                                <span class="tag">{{ trim($tag) }}</span>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    @endif
                    
                    <!-- Reading Progress -->
                    <div class="sidebar-card">
                        <h4 class="sidebar-title">
                            <i class="bi bi-book"></i>
                            تقدم القراءة
                        </h4>
                        <div class="reading-progress">
                            <div class="progress-bar">
                                <div class="progress-fill" id="readingProgress"></div>
                            </div>
                            <span class="progress-text">0%</span>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</article>

<!-- Related Posts -->
@if($relatedPosts->count() > 0)
<section class="related-posts-section">
    <div class="container">
        <div class="section-header">
            <div class="section-badge">
                <i class="bi bi-journal-text"></i>
                <span>مقالات ذات صلة</span>
            </div>
            <h2 class="section-title">مقالات مشابهة</h2>
        </div>
        <div class="related-posts-grid">
            @foreach($relatedPosts as $relatedPost)
            <div class="related-post-card">
                <div class="card-image">
                    <img src="{{ $relatedPost->featured_image ? asset('storage/' . $relatedPost->featured_image) : 'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80' }}" 
                         alt="{{ $relatedPost->title_ar }}">
                    <div class="image-overlay">
                        <div class="category-badge">{{ $relatedPost->category }}</div>
                    </div>
                </div>
                <div class="card-content">
                    <div class="post-meta">
                        <div class="meta-item">
                            <i class="bi bi-calendar3"></i>
                            <span>{{ $relatedPost->published_at->format('Y/m/d') }}</span>
                        </div>
                        <div class="meta-item">
                            <i class="bi bi-eye"></i>
                            <span>{{ $relatedPost->views_count }}</span>
                        </div>
                    </div>
                    <h3 class="post-title">
                        <a href="{{ route('blog.post', $relatedPost->slug) }}">
                            {{ $relatedPost->title_ar }}
                        </a>
                    </h3>
                    <p class="post-excerpt">
                        {{ Str::limit($relatedPost->excerpt_ar ?: $relatedPost->content_ar, 100) }}
                    </p>
                    <a href="{{ route('blog.post', $relatedPost->slug) }}" class="read-more-btn">
                        <i class="bi bi-arrow-left"></i>
                        اقرأ المزيد
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

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
/* Breadcrumb */
.breadcrumb-nav {
    background: #f8fafc;
    padding: 20px 0;
    margin-bottom: 40px;
}

.breadcrumb {
    display: flex;
    list-style: none;
    margin: 0;
    padding: 0;
    gap: 10px;
    align-items: center;
    flex-wrap: wrap;
}

.breadcrumb-item {
    display: flex;
    align-items: center;
    gap: 5px;
}

.breadcrumb-item a {
    color: #10b981;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.3s ease;
}

.breadcrumb-item a:hover {
    color: #059669;
}

.breadcrumb-item.active {
    color: #6b7280;
}

/* Post Header */
.post-header {
    background: white;
    padding: 60px 0;
    margin-bottom: 40px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
}

.post-header-content {
    max-width: 800px;
    margin: 0 auto;
}

.post-meta {
    display: flex;
    align-items: center;
    gap: 20px;
    margin-bottom: 30px;
    flex-wrap: wrap;
}

.category-badge {
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 0.9rem;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 5px;
}

.meta-items {
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 5px;
    color: #6b7280;
    font-size: 0.9rem;
}

.post-title {
    font-size: 3rem;
    font-weight: 800;
    color: #1f2937;
    margin-bottom: 20px;
    line-height: 1.2;
}

.post-excerpt {
    font-size: 1.3rem;
    color: #6b7280;
    line-height: 1.6;
    margin-bottom: 40px;
}

/* Author Card */
.author-card {
    display: flex;
    align-items: center;
    gap: 20px;
    padding: 30px;
    background: linear-gradient(135deg, #f8fafc, #f1f5f9);
    border-radius: 20px;
    border: 1px solid #e2e8f0;
}

.author-avatar {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    overflow: hidden;
    flex-shrink: 0;
}

.author-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.author-info {
    flex: 1;
}

.author-name {
    font-size: 1.3rem;
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 8px;
}

.author-bio {
    color: #6b7280;
    line-height: 1.6;
    margin-bottom: 15px;
    font-size: 0.95rem;
}

.author-social {
    display: flex;
    gap: 15px;
}

.social-link {
    color: #10b981;
    font-size: 1.2rem;
    transition: all 0.3s ease;
}

.social-link:hover {
    color: #059669;
    transform: translateY(-2px);
}

/* Featured Image */
.featured-image-section {
    margin-bottom: 40px;
}

.featured-image-container {
    max-width: 900px;
    margin: 0 auto;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
}

.featured-image {
    width: 100%;
    height: auto;
    display: block;
}

/* Post Content */
.post-content-section {
    margin-bottom: 80px;
}

.content-wrapper {
    display: grid;
    grid-template-columns: 1fr 300px;
    gap: 40px;
    max-width: 1200px;
    margin: 0 auto;
}

.post-content {
    background: white;
    border-radius: 20px;
    padding: 40px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
}

.content-body {
    font-size: 1.1rem;
    line-height: 1.8;
    color: #374151;
}

.content-body h2 {
    font-size: 2rem;
    font-weight: 700;
    color: #1f2937;
    margin: 40px 0 20px;
    padding-bottom: 10px;
    border-bottom: 2px solid #e5e7eb;
}

.content-body h3 {
    font-size: 1.5rem;
    font-weight: 600;
    color: #1f2937;
    margin: 30px 0 15px;
}

.content-body p {
    margin-bottom: 20px;
}

.content-body ul, .content-body ol {
    margin-bottom: 20px;
    padding-left: 20px;
}

.content-body li {
    margin-bottom: 8px;
}

.content-body strong {
    font-weight: 600;
    color: #1f2937;
}

/* Sidebar */
.post-sidebar {
    display: flex;
    flex-direction: column;
    gap: 30px;
}

.sidebar-card {
    background: white;
    border-radius: 20px;
    padding: 25px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    border: 1px solid #e2e8f0;
}

.sidebar-title {
    font-size: 1.2rem;
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 8px;
}

/* Social Sharing */
.social-sharing {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.social-btn {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 12px 16px;
    border-radius: 12px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
    font-size: 0.9rem;
}

.social-btn.facebook {
    background: #1877f2;
    color: white;
}

.social-btn.twitter {
    background: #1da1f2;
    color: white;
}

.social-btn.linkedin {
    background: #0077b5;
    color: white;
}

.social-btn.whatsapp {
    background: #25d366;
    color: white;
}

.social-btn.copy {
    background: #6b7280;
    color: white;
}

.social-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    color: white;
}

/* Tags */
.tags-container {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}

.tag {
    background: #f3f4f6;
    color: #6b7280;
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 0.9rem;
    font-weight: 500;
    transition: all 0.3s ease;
}

.tag:hover {
    background: #10b981;
    color: white;
    transform: translateY(-2px);
}

/* Reading Progress */
.reading-progress {
    display: flex;
    align-items: center;
    gap: 15px;
}

.progress-bar {
    flex: 1;
    height: 8px;
    background: #e5e7eb;
    border-radius: 4px;
    overflow: hidden;
}

.progress-fill {
    height: 100%;
    background: linear-gradient(135deg, #10b981, #059669);
    width: 0%;
    transition: width 0.3s ease;
}

.progress-text {
    font-size: 0.9rem;
    color: #6b7280;
    font-weight: 600;
    min-width: 40px;
}

/* Related Posts */
.related-posts-section {
    padding: 80px 0;
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
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

.related-posts-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 30px;
}

.related-post-card {
    background: white;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    border: 1px solid #e2e8f0;
}

.related-post-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 30px 60px rgba(0, 0, 0, 0.15);
}

.related-post-card .card-image {
    height: 200px;
    position: relative;
    overflow: hidden;
}

.related-post-card .card-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.related-post-card:hover .card-image img {
    transform: scale(1.05);
}

.related-post-card .card-content {
    padding: 25px;
}

.related-post-card .post-meta {
    margin-bottom: 15px;
}

.related-post-card .post-title {
    font-size: 1.3rem;
    margin-bottom: 15px;
}

.related-post-card .post-title a {
    color: inherit;
    text-decoration: none;
    transition: color 0.3s ease;
}

.related-post-card .post-title a:hover {
    color: #10b981;
}

.related-post-card .post-excerpt {
    color: #6b7280;
    line-height: 1.6;
    margin-bottom: 20px;
    font-size: 0.95rem;
}

.read-more-btn {
    display: flex;
    align-items: center;
    gap: 8px;
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
    padding: 10px 20px;
    border-radius: 20px;
    text-decoration: none;
    font-weight: 600;
    font-size: 0.9rem;
    transition: all 0.3s ease;
}

.read-more-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3);
    color: white;
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

/* Responsive Design */
@media (max-width: 1024px) {
    .content-wrapper {
        grid-template-columns: 1fr;
        gap: 30px;
    }
    
    .post-sidebar {
        order: -1;
    }
}

@media (max-width: 768px) {
    .post-title {
        font-size: 2rem;
    }
    
    .post-excerpt {
        font-size: 1.1rem;
    }
    
    .author-card {
        flex-direction: column;
        text-align: center;
    }
    
    .meta-items {
        flex-direction: column;
        gap: 10px;
    }
    
    .section-title {
        font-size: 2rem;
    }
    
    .related-posts-grid {
        grid-template-columns: 1fr;
    }
    
    .newsletter-content h2 {
        font-size: 2rem;
    }
    
    .form-group {
        flex-direction: column;
        border-radius: 15px;
    }
    
    .newsletter-btn {
        border-radius: 0 0 15px 15px;
    }
}

@media (max-width: 480px) {
    .post-header {
        padding: 40px 0;
    }
    
    .post-title {
        font-size: 1.8rem;
    }
    
    .post-content {
        padding: 25px;
    }
    
    .content-body {
        font-size: 1rem;
    }
    
    .sidebar-card {
        padding: 20px;
    }
}
</style>

<script>
// Copy to clipboard function
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        const button = event.target.closest('button');
        const originalHTML = button.innerHTML;
        button.innerHTML = '<i class="bi bi-check"></i> تم النسخ';
        button.style.background = '#10b981';
        
        setTimeout(() => {
            button.innerHTML = originalHTML;
            button.style.background = '#6b7280';
        }, 2000);
    });
}

// Reading progress
function updateReadingProgress() {
    const content = document.querySelector('.content-body');
    const progressBar = document.getElementById('readingProgress');
    const progressText = document.querySelector('.progress-text');
    
    if (content && progressBar) {
        const scrollTop = window.pageYOffset;
        const contentTop = content.offsetTop;
        const contentHeight = content.offsetHeight;
        const windowHeight = window.innerHeight;
        
        const scrollProgress = Math.min(
            Math.max((scrollTop - contentTop + windowHeight) / contentHeight, 0),
            1
        );
        
        const percentage = Math.round(scrollProgress * 100);
        progressBar.style.width = percentage + '%';
        progressText.textContent = percentage + '%';
    }
}

// Update progress on scroll
window.addEventListener('scroll', updateReadingProgress);

// Initialize progress
document.addEventListener('DOMContentLoaded', function() {
    updateReadingProgress();
    
    // Social sharing hover effects
    document.querySelectorAll('.social-btn').forEach(btn => {
        btn.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-3px)';
        });
        
        btn.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
});
</script>
@endsection 