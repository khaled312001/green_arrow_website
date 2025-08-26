// Completion Celebration JavaScript
class CompletionCelebration {
    constructor() {
        this.init();
    }

    init() {
        this.setupConfetti();
        this.setupButtonEffects();
        this.setupAnimations();
        this.setupSocialSharing();
    }

    setupConfetti() {
        // Create additional confetti elements dynamically
        const confettiContainer = document.querySelector('.celebration-bg');
        if (confettiContainer) {
            for (let i = 0; i < 30; i++) {
                const confetti = document.createElement('div');
                confetti.className = 'confetti';
                confetti.style.left = Math.random() * 100 + '%';
                confetti.style.animationDelay = Math.random() * 3 + 's';
                confetti.style.animationDuration = (Math.random() * 2 + 2) + 's';
                confettiContainer.appendChild(confetti);
            }
        }
    }

    setupButtonEffects() {
        const buttons = document.querySelectorAll('.btn-celebration');
        buttons.forEach(button => {
            button.addEventListener('click', (e) => this.createRippleEffect(e, button));
            button.addEventListener('mouseenter', () => this.addHoverEffect(button));
            button.addEventListener('mouseleave', () => this.removeHoverEffect(button));
        });
    }

    createRippleEffect(event, button) {
        const ripple = document.createElement('span');
        const rect = button.getBoundingClientRect();
        const size = Math.max(rect.width, rect.height);
        const x = event.clientX - rect.left - size / 2;
        const y = event.clientY - rect.top - size / 2;
        
        ripple.style.width = ripple.style.height = size + 'px';
        ripple.style.left = x + 'px';
        ripple.style.top = y + 'px';
        ripple.classList.add('ripple');
        
        button.appendChild(ripple);
        
        setTimeout(() => {
            ripple.remove();
        }, 600);
    }

    addHoverEffect(button) {
        button.style.transform = 'translateY(-3px) scale(1.02)';
        button.style.boxShadow = '0 10px 25px rgba(0,0,0,0.2)';
    }

    removeHoverEffect(button) {
        button.style.transform = 'translateY(0) scale(1)';
        button.style.boxShadow = '';
    }

    setupAnimations() {
        // Animate stats numbers
        this.animateStats();
        
        // Add floating effect to success icon
        const successIcon = document.querySelector('.success-icon');
        if (successIcon) {
            successIcon.addEventListener('mouseenter', () => {
                successIcon.style.transform = 'scale(1.1) rotate(5deg)';
            });
            
            successIcon.addEventListener('mouseleave', () => {
                successIcon.style.transform = 'scale(1) rotate(0deg)';
            });
        }

        // Animate certificate section
        const certificateSection = document.querySelector('.certificate-section');
        if (certificateSection) {
            certificateSection.addEventListener('mouseenter', () => {
                certificateSection.style.transform = 'scale(1.02)';
            });
            
            certificateSection.addEventListener('mouseleave', () => {
                certificateSection.style.transform = 'scale(1)';
            });
        }
    }

    animateStats() {
        const statNumbers = document.querySelectorAll('.stat-number');
        statNumbers.forEach(stat => {
            const finalValue = parseInt(stat.textContent);
            this.animateNumber(stat, 0, finalValue, 2000);
        });
    }

    animateNumber(element, start, end, duration) {
        const startTime = performance.now();
        const animate = (currentTime) => {
            const elapsed = currentTime - startTime;
            const progress = Math.min(elapsed / duration, 1);
            
            const current = Math.floor(start + (end - start) * this.easeOutQuart(progress));
            element.textContent = current;
            
            if (progress < 1) {
                requestAnimationFrame(animate);
            }
        };
        requestAnimationFrame(animate);
    }

    easeOutQuart(t) {
        return 1 - Math.pow(1 - t, 4);
    }

    setupSocialSharing() {
        // Add click effects to social media icons
        const socialIcons = document.querySelectorAll('[onclick*="shareOnSocial"]');
        socialIcons.forEach(icon => {
            icon.addEventListener('click', (e) => {
                e.preventDefault();
                this.addSocialIconEffect(icon);
            });
        });
    }

    addSocialIconEffect(icon) {
        icon.style.transform = 'scale(1.2)';
        setTimeout(() => {
            icon.style.transform = 'scale(1)';
        }, 200);
    }

    // Enhanced social sharing function
    shareOnSocial(platform) {
        const text = `تهانينا! لقد أكملت دورة "${document.querySelector('.course-title').textContent}" بنجاح! 🎓✨`;
        const url = window.location.href;
        
        let shareUrl = '';
        
        switch(platform) {
            case 'facebook':
                shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}&quote=${encodeURIComponent(text)}`;
                break;
            case 'twitter':
                shareUrl = `https://twitter.com/intent/tweet?text=${encodeURIComponent(text)}&url=${encodeURIComponent(url)}`;
                break;
            case 'linkedin':
                shareUrl = `https://www.linkedin.com/sharing/share-offsite/?url=${encodeURIComponent(url)}`;
                break;
            case 'whatsapp':
                shareUrl = `https://wa.me/?text=${encodeURIComponent(text + ' ' + url)}`;
                break;
        }
        
        if (shareUrl) {
            window.open(shareUrl, '_blank', 'width=600,height=400');
        }
    }

    // Add celebration sound effect (optional)
    playCelebrationSound() {
        // Create audio context for celebration sound
        try {
            const audioContext = new (window.AudioContext || window.webkitAudioContext)();
            const oscillator = audioContext.createOscillator();
            const gainNode = audioContext.createGain();
            
            oscillator.connect(gainNode);
            gainNode.connect(audioContext.destination);
            
            oscillator.frequency.setValueAtTime(800, audioContext.currentTime);
            oscillator.frequency.setValueAtTime(1000, audioContext.currentTime + 0.1);
            oscillator.frequency.setValueAtTime(1200, audioContext.currentTime + 0.2);
            
            gainNode.gain.setValueAtTime(0.1, audioContext.currentTime);
            gainNode.gain.exponentialRampToValueAtTime(0.01, audioContext.currentTime + 0.3);
            
            oscillator.start(audioContext.currentTime);
            oscillator.stop(audioContext.currentTime + 0.3);
        } catch (error) {
            console.log('Audio not supported');
        }
    }

    // Add particle explosion effect
    createParticleExplosion(x, y) {
        const colors = ['#10b981', '#fbbf24', '#8b5cf6', '#ec4899', '#3b82f6'];
        
        for (let i = 0; i < 20; i++) {
            const particle = document.createElement('div');
            particle.style.position = 'absolute';
            particle.style.left = x + 'px';
            particle.style.top = y + 'px';
            particle.style.width = '8px';
            particle.style.height = '8px';
            particle.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
            particle.style.borderRadius = '50%';
            particle.style.pointerEvents = 'none';
            particle.style.zIndex = '1000';
            
            document.body.appendChild(particle);
            
            const angle = (Math.PI * 2 * i) / 20;
            const velocity = 100 + Math.random() * 50;
            const vx = Math.cos(angle) * velocity;
            const vy = Math.sin(angle) * velocity;
            
            let opacity = 1;
            const animate = () => {
                const currentX = parseFloat(particle.style.left);
                const currentY = parseFloat(particle.style.top);
                
                particle.style.left = (currentX + vx * 0.016) + 'px';
                particle.style.top = (currentY + vy * 0.016) + 'px';
                particle.style.opacity = opacity;
                
                opacity -= 0.02;
                
                if (opacity > 0) {
                    requestAnimationFrame(animate);
                } else {
                    particle.remove();
                }
            };
            
            requestAnimationFrame(animate);
        }
    }
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    const celebration = new CompletionCelebration();
    
    // Play celebration sound on page load
    setTimeout(() => {
        celebration.playCelebrationSound();
    }, 500);
    
    // Add click explosion effect to success icon
    const successIcon = document.querySelector('.success-icon');
    if (successIcon) {
        successIcon.addEventListener('click', (e) => {
            celebration.createParticleExplosion(e.clientX, e.clientY);
        });
    }
});

// Make shareOnSocial function globally available
window.shareOnSocial = function(platform) {
    const celebration = new CompletionCelebration();
    celebration.shareOnSocial(platform);
}; 