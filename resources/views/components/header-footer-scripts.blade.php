<script>
// Enhanced Header and Footer Scripts
document.addEventListener('DOMContentLoaded', function() {
    // Mobile Menu Toggle - Enhanced with better performance
    const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
    const mobileMenu = document.querySelector('.mobile-menu');
    const mobileMenuClose = document.querySelector('.mobile-menu-close');
    const body = document.body;


  
    // Mobile menu toggle function
    function toggleMobileMenu() {
        const navMenu = document.getElementById('navMenu');
        const mobileMenu = document.getElementById('mobileMenu');
        const toggleButton = document.querySelector('.mobile-menu-toggle');
        
        // Add loading animation
        if (navMenu) navMenu.classList.add('loading');
        if (mobileMenu) mobileMenu.classList.add('loading');
        
        setTimeout(() => {
            if (navMenu) {
                navMenu.classList.remove('loading');
                navMenu.classList.toggle('active');
            }
            if (mobileMenu) {
                mobileMenu.classList.remove('loading');
                mobileMenu.classList.toggle('active');
            }
            
            // Prevent body scroll when menu is open
            const isActive = (navMenu && navMenu.classList.contains('active')) || 
                           (mobileMenu && mobileMenu.classList.contains('active'));
            document.body.style.overflow = isActive ? 'hidden' : '';
            
            // Add haptic feedback for mobile devices
            if ('vibrate' in navigator) {
                navigator.vibrate(50);
            }
        }, 300);
    }
    
    // Close mobile menu function
    function closeMobileMenu() {
        const navMenu = document.getElementById('navMenu');
        const mobileMenu = document.getElementById('mobileMenu');
        
        if (navMenu) navMenu.classList.remove('active');
        if (mobileMenu) mobileMenu.classList.remove('active');
        document.body.style.overflow = '';
        document.body.style.position = '';
        document.body.style.width = '';
    }

    if (mobileMenuToggle && mobileMenu) {
        mobileMenuToggle.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            toggleMobileMenu();
        });

        if (mobileMenuClose) {
            mobileMenuClose.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                closeMobileMenu();
            });
        }

        // Close mobile menu when clicking outside
        mobileMenu.addEventListener('click', function(e) {
            if (e.target === mobileMenu) {
                closeMobileMenu();
            }
        });

        // Close mobile menu on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && mobileMenu.classList.contains('active')) {
                closeMobileMenu();
            }
        });

        // Close mobile menu on window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768 && mobileMenu.classList.contains('active')) {
                closeMobileMenu();
            }
        });
    }



    // User Menu Toggle
    const userToggle = document.querySelector('.user-toggle');
    const userDropdown = document.querySelector('.user-dropdown');

    if (userToggle && userDropdown) {
        userToggle.addEventListener('click', function(e) {
            e.stopPropagation();
            userDropdown.classList.toggle('active');
        });

        // Close user dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!userToggle.contains(e.target) && !userDropdown.contains(e.target)) {
                userDropdown.classList.remove('active');
            }
        });
    }

    // Language Selector
    const langBtn = document.querySelector('.lang-btn');
    const langDropdown = document.querySelector('.lang-dropdown');

    if (langBtn && langDropdown) {
        langBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            langDropdown.classList.toggle('active');
        });

        // Close language dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!langBtn.contains(e.target) && !langDropdown.contains(e.target)) {
                langDropdown.classList.remove('active');
            }
        });
    }



    // Smooth Scrolling for Anchor Links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const href = this.getAttribute('href');
            if (href === '#') {
                e.preventDefault();
                return;
            }
            
            e.preventDefault();
            const target = document.querySelector(href);
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Header Scroll Effect - Enhanced for mobile
    const header = document.querySelector('.header');
    let lastScrollTop = 0;
    let ticking = false;

    function updateHeader() {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        
        if (header) {
            if (scrollTop > 100) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }

            // Hide/show header on scroll with throttling
            if (Math.abs(scrollTop - lastScrollTop) > 10) {
                if (scrollTop > lastScrollTop && scrollTop > 200) {
                    header.style.transform = 'translateY(-100%)';
                } else {
                    header.style.transform = 'translateY(0)';
                }
                lastScrollTop = scrollTop;
            }
        }
        ticking = false;
    }

    window.addEventListener('scroll', function() {
        if (!ticking) {
            requestAnimationFrame(updateHeader);
            ticking = true;
        }
    });

    // Social Media Tracking
    document.querySelectorAll('.social-link, .social-icon').forEach(link => {
        link.addEventListener('click', function(e) {
            const platform = this.classList.contains('whatsapp') ? 'WhatsApp' :
                           this.classList.contains('twitter') ? 'Twitter' :
                           this.classList.contains('telegram') ? 'Telegram' :
                           this.classList.contains('youtube') ? 'YouTube' :
                           this.classList.contains('tiktok') ? 'TikTok' :
                           this.classList.contains('email') ? 'Email' : 'Social';
            
            // Track social media clicks (replace with your analytics)
            console.log(`Social media click: ${platform}`);
            
            // You can add Google Analytics or other tracking here
            if (typeof gtag !== 'undefined') {
                gtag('event', 'click', {
                    'event_category': 'Social Media',
                    'event_label': platform
                });
            }
        });
    });

    // Enhanced Form Interactions
    document.querySelectorAll('input, textarea, select').forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('focused');
        });

        input.addEventListener('blur', function() {
            if (!this.value) {
                this.parentElement.classList.remove('focused');
            }
        });
    });

    // Lazy Loading for Images
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.classList.remove('lazy');
                    imageObserver.unobserve(img);
                }
            });
        });

        document.querySelectorAll('img[data-src]').forEach(img => {
            imageObserver.observe(img);
        });
    }

    // Back to Top Button
    const backToTopBtn = document.createElement('button');
    backToTopBtn.innerHTML = '<i class="bi bi-arrow-up"></i>';
    backToTopBtn.className = 'back-to-top';
    backToTopBtn.style.cssText = `
        position: fixed;
        bottom: 20px;
        right: 20px;
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
        border: none;
        border-radius: 50%;
        cursor: pointer;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
        z-index: 1000;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    `;

    document.body.appendChild(backToTopBtn);

    window.addEventListener('scroll', function() {
        if (window.pageYOffset > 300) {
            backToTopBtn.style.opacity = '1';
            backToTopBtn.style.visibility = 'visible';
        } else {
            backToTopBtn.style.opacity = '0';
            backToTopBtn.style.visibility = 'hidden';
        }
    });

    backToTopBtn.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });

    // Utility Functions
    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    function showNotification(message, type = 'info') {
        const notification = document.createElement('div');
        notification.className = `notification notification-${type}`;
        notification.innerHTML = `
            <div class="notification-content">
                <i class="bi bi-${type === 'success' ? 'check-circle' : type === 'error' ? 'x-circle' : 'info-circle'}"></i>
                <span>${message}</span>
            </div>
        `;
        
        notification.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            background: ${type === 'success' ? '#10b981' : type === 'error' ? '#ef4444' : '#3b82f6'};
            color: white;
            padding: 15px 20px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            z-index: 10000;
            transform: translateX(100%);
            transition: transform 0.3s ease;
            max-width: 300px;
        `;

        notification.querySelector('.notification-content').style.cssText = `
            display: flex;
            align-items: center;
            gap: 10px;
        `;

        document.body.appendChild(notification);

        // Animate in
        setTimeout(() => {
            notification.style.transform = 'translateX(0)';
        }, 100);

        // Auto remove after 5 seconds
        setTimeout(() => {
            notification.style.transform = 'translateX(100%)';
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.parentNode.removeChild(notification);
                }
            }, 300);
        }, 5000);
    }

    // Enhanced Mobile Experience
    if (window.innerWidth <= 768) {
        // Add touch feedback for mobile
        document.querySelectorAll('.btn, .nav-link, .social-link, .social-icon').forEach(element => {
            element.addEventListener('touchstart', function() {
                this.style.transform = 'scale(0.95)';
            });

            element.addEventListener('touchend', function() {
                this.style.transform = '';
            });
        });
    }

    // Performance Optimization
    let scrollTimeout;
    window.addEventListener('scroll', function() {
        if (scrollTimeout) {
            clearTimeout(scrollTimeout);
        }
        
        scrollTimeout = setTimeout(() => {
            // Throttled scroll events for better performance
        }, 16); // ~60fps
    });

    // Accessibility Enhancements
    document.querySelectorAll('[tabindex]').forEach(element => {
        element.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                this.click();
            }
        });
    });

    // Initialize tooltips for social media links
    document.querySelectorAll('.social-link, .social-icon').forEach(link => {
        const tooltip = link.querySelector('.social-tooltip');
        if (tooltip) {
            link.addEventListener('mouseenter', function() {
                tooltip.style.opacity = '1';
            });

            link.addEventListener('mouseleave', function() {
                tooltip.style.opacity = '0';
            });
        }
    });

    // Close mobile menu when clicking on a link
    const navLinks = document.querySelectorAll('.nav-menu a, .mobile-nav-menu a');
    navLinks.forEach(function(link) {
        link.addEventListener('click', function() {
            const navMenu = document.getElementById('navMenu');
            const mobileMenu = document.getElementById('mobileMenu');
            if (navMenu) navMenu.classList.remove('active');
            if (mobileMenu) mobileMenu.classList.remove('active');
            document.body.style.overflow = '';
            document.body.style.position = '';
            document.body.style.width = '';
            
            // Add haptic feedback
            if ('vibrate' in navigator) {
                navigator.vibrate(30);
            }
        });
    });

    // Add touch gesture support for mobile menu
    let touchStartX = 0;
    let touchEndX = 0;
    
    document.addEventListener('touchstart', function(e) {
        touchStartX = e.changedTouches[0].screenX;
    });
    
    document.addEventListener('touchend', function(e) {
        touchEndX = e.changedTouches[0].screenX;
        handleSwipe();
    });
    
    function handleSwipe() {
        const navMenu = document.getElementById('navMenu');
        const mobileMenu = document.getElementById('mobileMenu');
        const swipeThreshold = 50;
        
        if (touchEndX < touchStartX - swipeThreshold) {
            // Swipe left - close menu
            if (navMenu && navMenu.classList.contains('active')) {
                navMenu.classList.remove('active');
                document.body.style.overflow = '';
            }
            if (mobileMenu && mobileMenu.classList.contains('active')) {
                mobileMenu.classList.remove('active');
                document.body.style.overflow = '';
            }
        } else if (touchEndX > touchStartX + swipeThreshold) {
            // Swipe right - open menu (only if we're on mobile)
            if (window.innerWidth <= 768) {
                if (navMenu && !navMenu.classList.contains('active')) {
                    navMenu.classList.add('active');
                    document.body.style.overflow = 'hidden';
                }
                if (mobileMenu && !mobileMenu.classList.contains('active')) {
                    mobileMenu.classList.add('active');
                    document.body.style.overflow = 'hidden';
                }
            }
        }
    }

    console.log('Enhanced header and footer scripts loaded successfully!');
});
</script> 