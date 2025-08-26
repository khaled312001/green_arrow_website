// Course Player JavaScript - Enhanced Interactions

class CoursePlayer {
    constructor() {
        this.init();
    }

    init() {
        this.setupEventListeners();
        this.setupProgressAnimation();
        this.setupLessonNavigation();
        this.setupKeyboardShortcuts();
        this.setupAutoSave();
    }

    setupEventListeners() {
        // Sidebar toggle
        const sidebarToggle = document.querySelector('.sidebar-toggle');
        const sidebar = document.getElementById('courseSidebar');
        const overlay = document.querySelector('.sidebar-overlay');

        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', () => this.toggleSidebar());
        }

        if (overlay) {
            overlay.addEventListener('click', () => this.toggleSidebar());
        }

        // Lesson search
        const searchInput = document.getElementById('lessonSearch');
        if (searchInput) {
            searchInput.addEventListener('input', (e) => this.filterLessons(e.target.value));
            searchInput.addEventListener('focus', () => this.highlightSearchResults());
        }

        // Lesson completion
        const completeButtons = document.querySelectorAll('.complete-lesson-btn');
        completeButtons.forEach(btn => {
            btn.addEventListener('click', (e) => this.completeLesson(e));
        });

        // Card hover effects
        const cards = document.querySelectorAll('.info-card, .progress-stat, .next-lesson-card');
        cards.forEach(card => {
            card.addEventListener('mouseenter', () => this.addHoverEffect(card));
            card.addEventListener('mouseleave', () => this.removeHoverEffect(card));
        });

        // Lesson navigation
        const lessonItems = document.querySelectorAll('.lesson-item');
        lessonItems.forEach(item => {
            item.addEventListener('click', (e) => this.handleLessonClick(e, item));
        });

        // Progress bar animation
        this.animateProgressBars();
    }

    toggleSidebar() {
        const sidebar = document.getElementById('courseSidebar');
        const overlay = document.querySelector('.sidebar-overlay');
        
        sidebar.classList.toggle('show');
        overlay.classList.toggle('show');
        
        // Add smooth transition
        if (sidebar.classList.contains('show')) {
            sidebar.style.transform = 'translateX(0)';
        } else {
            sidebar.style.transform = 'translateX(-100%)';
        }
    }

    async completeLesson(event) {
        const btn = event.target.closest('.complete-lesson-btn');
        const lessonId = btn.getAttribute('data-lesson-id') || 
                        btn.onclick.toString().match(/\d+/)[0];

        if (btn.disabled) return;

        if (confirm('هل تريد تحديد هذا الدرس كمكتمل؟')) {
            this.showLoadingState(btn);
            
            try {
                const response = await fetch(`/student/lessons/${lessonId}/complete`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json',
                    },
                });

                const data = await response.json();

                if (data.success) {
                    this.showSuccessState(btn);
                    this.updateProgressDisplay();
                    this.celebrateCompletion();
                    
                    // If course is completed, redirect to celebration page
                    if (data.course_completed && data.celebration_url) {
                        setTimeout(() => {
                            window.location.href = data.celebration_url;
                        }, 2000);
                    } else {
                        // Reload after animation
                        setTimeout(() => {
                            location.reload();
                        }, 1500);
                    }
                } else {
                    this.showErrorState(btn, 'حدث خطأ أثناء تحديث حالة الدرس');
                }
            } catch (error) {
                console.error('Error:', error);
                this.showErrorState(btn, 'حدث خطأ في الاتصال');
            }
        }
    }

    showLoadingState(btn) {
        btn.classList.add('loading');
        btn.disabled = true;
        btn.innerHTML = '<span class="loading-spinner"></span> جاري التحديث...';
    }

    showSuccessState(btn) {
        btn.classList.remove('loading');
        btn.classList.add('success-animation');
        btn.innerHTML = '<i class="bi bi-check-circle success-checkmark"></i> مكتمل';
        btn.disabled = true;
    }

    showErrorState(btn, message) {
        btn.classList.remove('loading');
        btn.disabled = false;
        btn.innerHTML = '<i class="bi bi-check-circle"></i> تحديد كمكتمل';
        this.showNotification(message, 'error');
    }

    addHoverEffect(card) {
        card.style.transform = 'translateY(-4px)';
        card.style.boxShadow = '0 8px 25px rgba(0,0,0,0.15)';
    }

    removeHoverEffect(card) {
        card.style.transform = 'translateY(0)';
        card.style.boxShadow = '';
    }

    handleLessonClick(event, item) {
        // Remove active class from all lessons
        document.querySelectorAll('.lesson-item').forEach(lesson => {
            lesson.classList.remove('active');
        });

        // Add active class to clicked lesson
        item.classList.add('active');

        // Add click animation
        item.style.transform = 'scale(0.98)';
        setTimeout(() => {
            item.style.transform = '';
        }, 150);
    }

    setupProgressAnimation() {
        const progressBars = document.querySelectorAll('.progress-bar-fill');
        progressBars.forEach(bar => {
            const width = bar.style.width;
            bar.style.width = '0%';
            
            setTimeout(() => {
                bar.style.width = width;
            }, 500);
        });
    }

    animateProgressBars() {
        const progressNumbers = document.querySelectorAll('.progress-stat-number');
        progressNumbers.forEach(number => {
            const finalValue = parseInt(number.textContent);
            this.animateNumber(number, 0, finalValue, 1000);
        });
    }

    animateNumber(element, start, end, duration) {
        const startTime = performance.now();
        const updateNumber = (currentTime) => {
            const elapsed = currentTime - startTime;
            const progress = Math.min(elapsed / duration, 1);
            
            const current = Math.floor(start + (end - start) * progress);
            element.textContent = current + (element.textContent.includes('%') ? '%' : '');
            
            if (progress < 1) {
                requestAnimationFrame(updateNumber);
            }
        };
        
        requestAnimationFrame(updateNumber);
    }

    updateProgressDisplay() {
        // Update progress bars and numbers
        const progressBars = document.querySelectorAll('.progress-bar-fill');
        const progressNumbers = document.querySelectorAll('.progress-stat-number');
        
        // This would typically fetch updated data from the server
        // For now, we'll just add a small increment
        progressNumbers.forEach(number => {
            const current = parseInt(number.textContent);
            if (!isNaN(current)) {
                number.textContent = current + 1 + (number.textContent.includes('%') ? '%' : '');
            }
        });
    }

    celebrateCompletion() {
        // Add celebration animation
        const celebration = document.createElement('div');
        celebration.innerHTML = '🎉';
        celebration.style.cssText = `
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 4rem;
            z-index: 9999;
            animation: celebration 1s ease-out forwards;
        `;
        
        document.body.appendChild(celebration);
        
        setTimeout(() => {
            celebration.remove();
        }, 1000);
    }

    setupKeyboardShortcuts() {
        document.addEventListener('keydown', (e) => {
            // Space bar to toggle sidebar
            if (e.code === 'Space' && e.target === document.body) {
                e.preventDefault();
                this.toggleSidebar();
            }
            
            // Escape to close sidebar
            if (e.code === 'Escape') {
                const sidebar = document.getElementById('courseSidebar');
                if (sidebar.classList.contains('show')) {
                    this.toggleSidebar();
                }
            }
            
            // Arrow keys for lesson navigation
            if (e.code === 'ArrowRight' || e.code === 'ArrowLeft') {
                this.navigateLessons(e.code);
            }
        });
    }

    navigateLessons(direction) {
        const currentLesson = document.querySelector('.lesson-item.active');
        const allLessons = Array.from(document.querySelectorAll('.lesson-item'));
        const currentIndex = allLessons.indexOf(currentLesson);
        
        let nextIndex;
        if (direction === 'ArrowRight') {
            nextIndex = currentIndex + 1;
        } else {
            nextIndex = currentIndex - 1;
        }
        
        if (nextIndex >= 0 && nextIndex < allLessons.length) {
            allLessons[nextIndex].click();
        }
    }

    setupAutoSave() {
        // Auto-save progress every 30 seconds
        setInterval(() => {
            this.saveProgress();
        }, 30000);
    }

    async saveProgress() {
        try {
            const currentLesson = document.querySelector('.lesson-item.active');
            if (currentLesson) {
                const lessonId = currentLesson.getAttribute('href').split('/').pop();
                
                await fetch('/student/progress/auto-save', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        lesson_id: lessonId,
                        timestamp: Date.now()
                    })
                });
            }
        } catch (error) {
            console.log('Auto-save failed:', error);
        }
    }

    showNotification(message, type = 'info') {
        const notification = document.createElement('div');
        notification.className = `notification notification-${type}`;
        notification.textContent = message;
        notification.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 1rem 1.5rem;
            border-radius: 8px;
            color: white;
            font-weight: 600;
            z-index: 10000;
            animation: slideInRight 0.3s ease-out;
            background: ${type === 'error' ? '#ef4444' : '#10b981'};
        `;
        
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.style.animation = 'slideOutRight 0.3s ease-in';
            setTimeout(() => {
                notification.remove();
            }, 300);
        }, 3000);
    }

    filterLessons(searchTerm) {
        const lessonItems = document.querySelectorAll('.lesson-item');
        const searchTermLower = searchTerm.toLowerCase();
        let visibleCount = 0;

        lessonItems.forEach(item => {
            const title = item.querySelector('.lesson-title').textContent.toLowerCase();
            const isVisible = title.includes(searchTermLower);
            
            item.style.display = isVisible ? 'block' : 'none';
            if (isVisible) visibleCount++;
        });

        // Show/hide no results message
        this.toggleNoResultsMessage(visibleCount === 0 && searchTerm.length > 0);
    }

    toggleNoResultsMessage(show) {
        let noResults = document.querySelector('.no-results-message');
        
        if (show && !noResults) {
            noResults = document.createElement('div');
            noResults.className = 'no-results-message';
            noResults.innerHTML = `
                <div style="text-align: center; padding: 2rem; color: var(--text-secondary);">
                    <i class="bi bi-search" style="font-size: 2rem; margin-bottom: 1rem; display: block;"></i>
                    <p>لا توجد نتائج للبحث</p>
                </div>
            `;
            
            const lessonsList = document.querySelector('.lessons-list');
            lessonsList.appendChild(noResults);
        } else if (!show && noResults) {
            noResults.remove();
        }
    }

    highlightSearchResults() {
        const searchInput = document.getElementById('lessonSearch');
        if (searchInput && searchInput.value.length > 0) {
            this.filterLessons(searchInput.value);
        }
    }
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    new CoursePlayer();
});

// Add CSS animations
const style = document.createElement('style');
style.textContent = `
    @keyframes slideInRight {
        from { transform: translateX(100%); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }
    
    @keyframes slideOutRight {
        from { transform: translateX(0); opacity: 1; }
        to { transform: translateX(100%); opacity: 0; }
    }
    
    @keyframes celebration {
        0% { transform: translate(-50%, -50%) scale(0); opacity: 0; }
        50% { transform: translate(-50%, -50%) scale(1.2); opacity: 1; }
        100% { transform: translate(-50%, -50%) scale(1); opacity: 0; }
    }
`;
document.head.appendChild(style); 