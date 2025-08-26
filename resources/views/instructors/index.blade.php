@extends('layouts.app')

@section('title', 'المدربون - أكاديمية السهم الأخضر')

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
                <i class="bi bi-person-workspace"></i>
                <span>فريق التدريب المحترف</span>
            </div>
            <h1 class="hero-title">المدربون المتميزون</h1>
            <p class="hero-subtitle">
                تعرف على فريق التدريب المحترف لدينا من الخبراء والمتخصصين في مختلف المجالات
            </p>
            
            <!-- Enhanced Search Bar -->
            <div class="search-container">
                <form method="GET" action="{{ route('instructors') }}" class="search-form">
                    <div class="search-input-group">
                        <i class="bi bi-search search-icon"></i>
            <input type="text" 
                   name="search" 
                   value="{{ request('search') }}"
                   placeholder="البحث في المدربين..." 
                               class="search-input">
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
                    <div class="stat-number" data-target="{{ $instructors->count() }}">0</div>
                    <div class="stat-label">مدرب محترف</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number" data-target="15">0</div>
                    <div class="stat-label">دورة تدريبية</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number" data-target="2500">0</div>
                    <div class="stat-label">طالب</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Instructors Section -->
<section class="instructors-section">
    <div class="container">
        <!-- Filters and Results Info -->
        <div class="results-header">
            <div class="results-info">
                <h2>المدرب المتميز</h2>
                <p>خبير في مجال الحاسب الآلي والبرمجة</p>
            </div>
        </div>

    <!-- Instructors Grid -->
        <div class="instructors-grid">
        @foreach($instructors as $instructor)
            <div class="instructor-card">
                <div class="instructor-header">
                    <div class="instructor-avatar">
                        <img src="{{ $instructor->avatar_url }}" alt="{{ $instructor->name }}">
                        <div class="avatar-overlay">
                            <i class="bi bi-linkedin"></i>
                        </div>
                    </div>
                    <div class="instructor-info">
                        <h3 class="instructor-name">{{ $instructor->name }}</h3>
                        <p class="instructor-speciality">{{ $instructor->speciality }}</p>
                    
                    <!-- Rating -->
                        <div class="rating-container">
                            <div class="stars">
                        @for($i = 1; $i <= 5; $i++)
                                <i class="bi bi-star{{ $i <= $instructor->average_rating ? '-fill' : '' }}"></i>
                        @endfor
                            </div>
                            <span class="rating-text">({{ $instructor->reviews_count }} تقييم)</span>
                    </div>
                </div>
            </div>

            <!-- Bio -->
            <div class="instructor-bio">
                <p>{{ $instructor->bio }}</p>
            </div>

            <!-- Stats -->
                <div class="instructor-stats">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="bi bi-play-circle"></i>
                        </div>
                        <div class="stat-content">
                            <div class="stat-number" data-target="{{ $instructor->courses_count }}">{{ $instructor->courses_count }}</div>
                            <div class="stat-label">دورة</div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="bi bi-people"></i>
                        </div>
                        <div class="stat-content">
                            <div class="stat-number" data-target="{{ $instructor->total_students }}">{{ $instructor->total_students }}</div>
                            <div class="stat-label">طالب</div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="bi bi-star"></i>
                </div>
                        <div class="stat-content">
                            <div class="stat-number" data-target="{{ $instructor->average_rating }}">{{ $instructor->average_rating }}</div>
                            <div class="stat-label">تقييم</div>
                </div>
                </div>
            </div>

            <!-- Recent Courses -->
            <div class="recent-courses">
                <h4>أحدث الدورات:</h4>
                <div class="courses-list">
                    @foreach($instructor->teachingCourses->where('status', 'published')->take(3) as $course)
                    <div class="course-item">
                        <div class="course-image">
                            <img src="{{ $course->thumbnail ? asset('storage/' . $course->thumbnail) : 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80' }}" alt="{{ $course->title_ar }}">
                        </div>
                        <div class="course-details">
                            <div class="course-title">{{ $course->title_ar }}</div>
                            <div class="course-category">{{ $course->category->name_ar }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- View Profile Button -->
                <a href="{{ route('instructors.show', $instructor->id) }}" class="view-profile-btn">
                    <i class="bi bi-person-circle"></i>
                عرض الملف الشخصي
            </a>
        </div>
        @endforeach
    </div>
    </div>
</section>

<style>
/* Prevent horizontal scroll */
html, body {
    overflow-x: hidden;
    width: 100%;
    max-width: 100%;
}

/* Hero Section */
.hero-section {
    position: relative;
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: white;
    padding: 120px 0 80px;
    margin: -40px 0 80px 0;
    overflow: hidden;
    width: 100%;
    max-width: 100%;
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
    max-width: 600px;
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

/* Instructors Section */
.instructors-section {
    padding: 80px 0;
}

.results-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 40px;
    flex-wrap: wrap;
    gap: 20px;
}

.results-info h2 {
    font-size: 2rem;
    font-weight: 800;
    color: #1f2937;
    margin-bottom: 5px;
}

.results-info p {
    color: #6b7280;
    font-size: 1.1rem;
}

.search-tag {
    display: flex;
    align-items: center;
    gap: 10px;
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
    padding: 10px 20px;
    border-radius: 25px;
    font-weight: 500;
}

.clear-search {
    color: white;
    text-decoration: none;
    font-size: 1.2rem;
    transition: opacity 0.3s ease;
}

.clear-search:hover {
    opacity: 0.8;
}

/* Instructors Grid */
.instructors-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(380px, 1fr));
    gap: 30px;
    margin-bottom: 60px;
}

.instructor-card {
    background: white;
    border-radius: 20px;
    padding: 30px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    border: 1px solid #e2e8f0;
    position: relative;
    overflow: hidden;
}

.instructor-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(135deg, #10b981, #059669);
    transform: scaleX(0);
    transition: transform 0.3s ease;
}

.instructor-card:hover::before {
    transform: scaleX(1);
}

.instructor-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 30px 60px rgba(0, 0, 0, 0.15);
}

/* Instructor Header */
.instructor-header {
    display: flex;
    align-items: center;
    gap: 20px;
    margin-bottom: 25px;
}

.instructor-avatar {
    position: relative;
    width: 80px;
    height: 80px;
    flex-shrink: 0;
}

.instructor-avatar img {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid #10b981;
}

.avatar-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(16, 185, 129, 0.8);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.instructor-card:hover .avatar-overlay {
    opacity: 1;
}

.instructor-info {
    flex: 1;
}

.instructor-name {
    font-size: 1.4rem;
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 5px;
}

.instructor-speciality {
    color: #6b7280;
    font-size: 0.95rem;
    margin-bottom: 10px;
}

.rating-container {
    display: flex;
    align-items: center;
    gap: 8px;
}

.stars {
    display: flex;
    gap: 2px;
}

.stars i {
    color: #fbbf24;
    font-size: 0.9rem;
}

.rating-text {
    font-size: 0.9rem;
    color: #6b7280;
}

/* Instructor Bio */
.instructor-bio {
    margin-bottom: 25px;
}

.instructor-bio p {
    color: #4b5563;
    line-height: 1.6;
    font-size: 0.95rem;
}

/* Instructor Stats */
.instructor-stats {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 15px;
    margin-bottom: 25px;
}

.stat-card {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 15px;
    background: linear-gradient(135deg, #f8fafc, #f1f5f9);
    border-radius: 12px;
    border: 1px solid #e2e8f0;
    transition: all 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
}

.stat-icon {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, #10b981, #059669);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.1rem;
}

.stat-content {
    flex: 1;
}

.stat-number {
    font-size: 1.2rem;
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 2px;
}

.stat-label {
    font-size: 0.8rem;
    color: #6b7280;
    font-weight: 500;
}

/* Recent Courses */
.recent-courses {
    margin-bottom: 25px;
}

.recent-courses h4 {
    font-size: 1rem;
    color: #1f2937;
    margin-bottom: 15px;
    font-weight: 600;
}

.courses-list {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.course-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px;
    background: #f9fafb;
    border-radius: 10px;
    transition: all 0.3s ease;
}

.course-item:hover {
    background: #f3f4f6;
    transform: translateX(5px);
}

.course-image {
    width: 40px;
    height: 30px;
    border-radius: 6px;
    overflow: hidden;
    flex-shrink: 0;
}

.course-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.course-details {
    flex: 1;
}

.course-title {
    font-size: 0.9rem;
    color: #1f2937;
    font-weight: 500;
    margin-bottom: 2px;
}

.course-category {
    font-size: 0.8rem;
    color: #6b7280;
}

/* View Profile Button */
.view-profile-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    width: 100%;
    padding: 15px;
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
    text-decoration: none;
    border-radius: 12px;
    font-weight: 600;
    font-size: 1rem;
    transition: all 0.3s ease;
}

.view-profile-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(16, 185, 129, 0.3);
    color: white;
}

/* Pagination */
.pagination-container {
    text-align: center;
    margin-top: 60px;
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
    
    .instructors-grid {
        grid-template-columns: 1fr;
    }
    
    .results-header {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .instructor-stats {
        grid-template-columns: 1fr;
    }
    
    .search-input-group {
        flex-direction: column;
        border-radius: 15px;
    }
    
    .search-button {
        border-radius: 0 0 15px 15px;
    }
}

/* Additional overflow prevention */
.container {
    max-width: 100%;
    overflow-x: hidden;
}

.instructors-section {
    overflow-x: hidden;
    width: 100%;
}

.instructors-grid {
    overflow-x: hidden;
    width: 100%;
}

.instructor-card {
    overflow-x: hidden;
    width: 100%;
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
    
    .instructor-card {
        padding: 20px;
    }
    
    .instructor-header {
        flex-direction: column;
        text-align: center;
    }
    
    .instructor-stats {
        grid-template-columns: 1fr;
    }
}
</style>

<script>
// Animate statistics on scroll
function animateStats() {
    const stats = document.querySelectorAll('.stat-number');
    
    stats.forEach(stat => {
        const target = parseFloat(stat.getAttribute('data-target'));
        const duration = 2000; // 2 seconds
        const increment = target / (duration / 16); // 60fps
        let current = 0;
        
        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                current = target;
                clearInterval(timer);
            }
            
            // Format number based on whether it's decimal or integer
            if (Number.isInteger(target)) {
                stat.textContent = Math.floor(current).toLocaleString();
            } else {
                stat.textContent = current.toFixed(1);
            }
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
    const animatedElements = document.querySelectorAll('.instructor-card');
    
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
    
    // Animate instructor card stats when they come into view
    const instructorStats = document.querySelectorAll('.instructor-card .stat-number');
    instructorStats.forEach(stat => {
        observer.observe(stat);
    });
    
    // Trigger animation for instructor stats
    const instructorObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const stat = entry.target;
                const target = parseFloat(stat.getAttribute('data-target'));
                if (target && !stat.classList.contains('animated')) {
                    stat.classList.add('animated');
                    animateSingleStat(stat, target);
                }
            }
        });
    }, { threshold: 0.5 });
    
    instructorStats.forEach(stat => {
        instructorObserver.observe(stat);
    });
});

// Animate single stat
function animateSingleStat(stat, target) {
    const duration = 1500; // 1.5 seconds
    const increment = target / (duration / 16); // 60fps
    let current = 0;
    
    const timer = setInterval(() => {
        current += increment;
        if (current >= target) {
            current = target;
            clearInterval(timer);
        }
        
        // Format number based on whether it's decimal or integer
        if (Number.isInteger(target)) {
            stat.textContent = Math.floor(current).toLocaleString();
        } else {
            stat.textContent = current.toFixed(1);
        }
    }, 16);
}
</script>
@endsection 