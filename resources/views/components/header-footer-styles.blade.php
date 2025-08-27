<style>
/* Enhanced Header Styles */
.header {
    background: linear-gradient(135deg, #10b981 0%, #059669 50%, #047857 100%);
    color: white;
    box-shadow: 0 4px 20px rgba(0,0,0,0.15);
    position: relative;
    overflow: visible;
    margin-bottom: 0;
    margin-top: 0;
    z-index: 9998;
    /* Prevent shaking on mobile */
    transform: translateZ(0);
    -webkit-transform: translateZ(0);
    backface-visibility: hidden;
    -webkit-backface-visibility: hidden;
}

/* Global styles to remove gaps */
.main-content-area,
.main-content,
main,
.content,
section:first-of-type {
    margin-top: 0;
    padding-top: 0;
}

.header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: 
        radial-gradient(circle at 20% 50%, rgba(255,255,255,0.1) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(255,255,255,0.08) 0%, transparent 50%),
        radial-gradient(circle at 40% 80%, rgba(255,255,255,0.06) 0%, transparent 50%);
    animation: floatingLights 8s ease-in-out infinite;
    pointer-events: none;
}

.header::after {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, 
        transparent 0%, 
        rgba(255,255,255,0.1) 25%, 
        rgba(255,255,255,0.2) 50%, 
        rgba(255,255,255,0.1) 75%, 
        transparent 100%);
    animation: shimmer 4s ease-in-out infinite;
    pointer-events: none;
}

@keyframes floatingLights {
    0%, 100% { 
        transform: translateY(0px) rotate(0deg);
        opacity: 0.8;
    }
    25% { 
        transform: translateY(-10px) rotate(1deg);
        opacity: 1;
    }
    50% { 
        transform: translateY(5px) rotate(-1deg);
        opacity: 0.6;
    }
    75% { 
        transform: translateY(-5px) rotate(0.5deg);
        opacity: 0.9;
    }
}

@keyframes shimmer {
    0% { 
        transform: translateX(-100%) skewX(-15deg);
        opacity: 0;
    }
    50% { 
        opacity: 1;
    }
    100% { 
        transform: translateX(200%) skewX(-15deg);
        opacity: 0;
    }
}

/* Enhanced Header Top Bar */
.header-top {
    background: linear-gradient(135deg, rgba(0,0,0,0.3) 0%, rgba(0,0,0,0.2) 50%, rgba(0,0,0,0.3) 100%);
    padding: 12px 0;
    font-size: 13px;
    border-bottom: 1px solid rgba(255,255,255,0.15);
    position: relative;
    overflow: hidden;
}

.header-top::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: 
        radial-gradient(circle at 20% 50%, rgba(255,255,255,0.05) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(255,255,255,0.03) 0%, transparent 50%);
    pointer-events: none;
}

.top-bar-content {
    display: flex;
    flex-direction: row !important; /* تأكيد الاتجاه الأفقي */
    justify-content: space-between;
    align-items: center;
    flex-wrap: nowrap !important; /* منع الالتفاف على الشاشات الكبيرة */
    gap: 25px;
    position: relative;
    z-index: 2;
    width: 100%;
}

.contact-info {
    display: flex;
    flex-direction: row !important; /* تأكيد الاتجاه الأفقي */
    align-items: center;
    gap: 20px;
    flex-wrap: nowrap !important; /* منع الالتفاف على الشاشات الكبيرة */
    flex-shrink: 1;
    min-width: 0;
}

.contact-item {
    display: flex;
    align-items: center;
    gap: 10px;
    color: rgba(255,255,255,0.95);
    font-size: 12px;
    transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    padding: 8px 12px;
    border-radius: 12px;
    background: rgba(255,255,255,0.08);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,0.1);
    position: relative;
    overflow: hidden;
    flex-shrink: 1;
    min-width: 0;
    white-space: nowrap;
}

.contact-item::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
    transition: left 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

.contact-item:hover::before {
    left: 100%;
}

.contact-item:hover {
    background: rgba(255,255,255,0.15);
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    border-color: rgba(255,255,255,0.2);
}

.contact-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 24px;
    height: 24px;
    background: linear-gradient(135deg, rgba(255,255,255,0.2), rgba(255,255,255,0.1));
    border-radius: 50%;
    font-size: 12px;
    color: #fbbf24;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}

.contact-item:hover .contact-icon {
    background: linear-gradient(135deg, #fbbf24, #f59e0b);
    color: white;
    transform: scale(1.1);
    box-shadow: 0 4px 12px rgba(251, 191, 36, 0.3);
}

.contact-details {
    display: flex;
    flex-direction: column;
    gap: 3px;
}

.contact-label {
    font-size: 10px;
    opacity: 0.8;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: rgba(255,255,255,0.9);
}

.contact-value {
    color: white;
    text-decoration: none;
    font-weight: 700;
    font-size: 13px;
    transition: all 0.3s ease;
    line-height: 1.2;
}

.contact-value:hover {
    color: #fbbf24;
    text-shadow: 0 0 8px rgba(251, 191, 36, 0.5);
}

.top-bar-right {
    display: flex;
    flex-direction: row !important; /* تأكيد الاتجاه الأفقي */
    align-items: center;
    gap: 20px;
    flex-wrap: nowrap !important; /* منع الالتفاف على الشاشات الكبيرة */
    flex-shrink: 1;
    min-width: 0;
}

/* Enhanced Social Links */
.social-links {
    display: flex;
    align-items: center;
    gap: 10px;
    background: rgba(255,255,255,0.05);
    padding: 8px 15px;
    border-radius: 25px;
    backdrop-filter: blur(15px);
    border: 1px solid rgba(255,255,255,0.1);
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    flex-shrink: 1;
    min-width: 0;
}

.social-link {
    position: relative;
    color: rgba(255,255,255,0.9);
    font-size: 18px;
    transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    padding: 10px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(255,255,255,0.08);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,0.1);
    position: relative;
    overflow: hidden;
}

.social-link::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

.social-link:hover::before {
    left: 100%;
}

.social-link:hover {
    transform: translateY(-3px) scale(1.15);
    background: rgba(255,255,255,0.15);
    box-shadow: 0 8px 25px rgba(0,0,0,0.2);
}

.social-link.whatsapp:hover {
    color: #25D366;
    box-shadow: 0 4px 12px rgba(37, 211, 102, 0.3);
}

.social-link.youtube:hover {
    color: #FF0000;
    box-shadow: 0 4px 12px rgba(255, 0, 0, 0.3);
}

.social-link.instagram:hover {
    color: #E4405F;
    box-shadow: 0 4px 12px rgba(228, 64, 95, 0.3);
}

.social-link.twitter:hover {
    color: #1DA1F2;
    box-shadow: 0 4px 12px rgba(29, 161, 242, 0.3);
}

.social-link.facebook:hover {
    color: #1877F2;
    box-shadow: 0 4px 12px rgba(24, 119, 242, 0.3);
}

.social-link.telegram:hover {
    color: #0088cc;
    box-shadow: 0 4px 12px rgba(0, 136, 204, 0.3);
}

.social-link.tiktok:hover {
    color: #000000;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
}

.social-link.email:hover {
    color: #EA4335;
    box-shadow: 0 4px 12px rgba(234, 67, 53, 0.3);
}

.social-tooltip {
    position: absolute;
    bottom: 100%;
    left: 50%;
    transform: translateX(-50%);
    background: rgba(0,0,0,0.8);
    color: white;
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 11px;
    white-space: nowrap;
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.3s ease;
    margin-bottom: 5px;
}

.social-tooltip::after {
    content: '';
    position: absolute;
    top: 100%;
    left: 50%;
    transform: translateX(-50%);
    border: 4px solid transparent;
    border-top-color: rgba(0,0,0,0.8);
}

.social-link:hover .social-tooltip {
    opacity: 1;
}

/* Language Selector */
.language-selector {
    position: relative;
    flex-shrink: 0; /* منع تقلص محدد اللغة */
}

.lang-btn {
    display: flex;
    align-items: center;
    gap: 8px;
    background: linear-gradient(135deg, rgba(255,255,255,0.1), rgba(255,255,255,0.05));
    border: 1px solid rgba(255,255,255,0.2);
    color: white;
    padding: 8px 16px;
    border-radius: 25px;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    backdrop-filter: blur(15px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    position: relative;
    overflow: hidden;
}

.lang-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
    transition: left 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

.lang-btn:hover::before {
    left: 100%;
}

.lang-btn:hover {
    background: linear-gradient(135deg, rgba(255,255,255,0.2), rgba(255,255,255,0.1));
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0,0,0,0.2);
    border-color: rgba(255,255,255,0.3);
}

.lang-dropdown {
    position: absolute;
    top: 100%;
    right: 0;
    background: white;
    border-radius: 8px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    min-width: 150px;
    opacity: 0;
    visibility: hidden;
    transform: translateY(-10px);
    transition: all 0.3s ease;
    z-index: 9999;
    margin-top: 5px;
}

.language-selector:hover .lang-dropdown {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

.lang-option {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 10px 15px;
    color: #374151;
    text-decoration: none;
    transition: background 0.3s ease;
    border-radius: 6px;
    margin: 2px;
}

.lang-option:hover {
    background: #f3f4f6;
}

.lang-option.active {
    background: #10b981;
    color: white;
}

.lang-flag {
    font-size: 16px;
}

/* Enhanced Header Main */
.header-main {
    padding: 0;
    margin: 0;
    position: relative;
    z-index: 2;
}

.navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: nowrap;
    gap: 20px;
    min-height: 80px;
    width: 100%;
    padding: 0 15px;
    margin: 0;
    position: relative;
    z-index: 9998;
}

/* Enhanced Logo */
.navbar-brand {
    flex-shrink: 0;
}

.logo {
    display: flex;
    align-items: center;
    text-decoration: none;
    color: white;
    transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    position: relative;
    overflow: hidden;
    padding: 8px 15px;
    border-radius: 12px;
    background: rgba(255,255,255,0.1);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,0.2);
}

.logo::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
    transition: left 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

.logo:hover::before {
    left: 100%;
}

.logo:hover {
    transform: scale(1.05) translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.2);
    background: rgba(255,255,255,0.15);
}

.logo-container {
    display: flex;
    align-items: center;
    gap: 10px;
}

.logo-icon {
    font-size: 24px;
    color: #fbbf24;
}

.logo-image {
    height: 50px;
    width: auto;
    filter: drop-shadow(0 2px 8px rgba(0,0,0,0.2));
    transition: all 0.3s ease;
    border: 1px solid rgba(255,255,255,0.3);
    border-radius: 4px;
}

.logo:hover .logo-image {
    transform: scale(1.1) rotate(5deg);
    filter: drop-shadow(0 4px 12px rgba(0,0,0,0.3));
}

.logo-text {
    display: flex;
    flex-direction: column;
    gap: 2px;
}

.logo-title {
    font-size: 16px;
    font-weight: 700;
    line-height: 1.2;
}

.logo-subtitle {
    font-size: 10px;
    opacity: 0.8;
    font-weight: 500;
}

/* Enhanced Navigation Menu */
.navbar-menu {
    flex: 1;
    display: flex;
    justify-content: center;
}

.nav-menu {
    display: flex;
    align-items: center;
    gap: 5px;
    list-style: none;
    margin: 0;
    padding: 0;
    overflow-x: auto;
    scrollbar-width: none;
    -ms-overflow-style: none;
}

.nav-menu::-webkit-scrollbar {
    display: none;
}

.nav-item {
    position: relative;
}

.nav-link {
    display: flex;
    align-items: center;
    gap: 8px;
    color: rgba(255,255,255,0.9);
    text-decoration: none;
    padding: 12px 18px;
    border-radius: 12px;
    font-weight: 500;
    font-size: 14px;
    transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    position: relative;
    overflow: hidden;
    white-space: nowrap;
    min-width: fit-content;
    background: rgba(255,255,255,0.05);
    backdrop-filter: blur(10px);
}

.nav-link::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

.nav-link::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    width: 0;
    height: 3px;
    background: #fbbf24;
    border-radius: 2px;
    transition: all 0.3s ease;
    transform: translateX(-50%);
}

.nav-link:hover::before {
    left: 100%;
}

.nav-link:hover,
.nav-link.active {
    color: white;
    background: rgba(255,255,255,0.15);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

.nav-link:hover::after,
.nav-link.active::after {
    width: 80%;
}



/* Enhanced Navbar Actions */
.navbar-actions {
    display: flex;
    align-items: center;
    gap: 15px;
    flex-shrink: 0;
}

/* Notifications Styles */
.notifications-dropdown {
    position: relative;
    display: inline-block;
}

.notifications-toggle {
    position: relative;
    background: rgba(255,255,255,0.1);
    border: 2px solid rgba(255,255,255,0.3);
    color: white;
    font-size: 1.2rem;
    padding: 10px;
    border-radius: 50%;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    backdrop-filter: blur(10px);
}

.notifications-toggle:hover {
    background: rgba(255,255,255,0.2);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(255,255,255,0.2);
}

.notifications-badge {
    position: absolute;
    top: -5px;
    right: -5px;
    background: #ef4444;
    color: white;
    font-size: 0.7rem;
    font-weight: 600;
    padding: 2px 6px;
    border-radius: 10px;
    min-width: 18px;
    text-align: center;
    animation: pulse 2s infinite;
}

.notifications-panel {
    position: absolute;
    top: 100%;
    right: 0;
    width: 350px;
    background: white;
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    border: 1px solid #e5e7eb;
    z-index: 9999;
    opacity: 0;
    visibility: hidden;
    transform: translateY(-10px);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    margin-top: 10px;
}

.notifications-panel.active {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

.notifications-header {
    padding: 15px 20px;
    border-bottom: 1px solid #f3f4f6;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.notifications-header .header-actions {
    display: flex;
    align-items: center;
    gap: 10px;
}

.notifications-header h6 {
    margin: 0;
    font-weight: 600;
    color: #1f2937;
}

.mark-all-read {
    background: none;
    border: none;
    color: #10b981;
    font-size: 0.8rem;
    cursor: pointer;
    padding: 5px 10px;
    border-radius: 6px;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 5px;
}

.mark-all-read:hover {
    background: rgba(16, 185, 129, 0.1);
}

.notifications-list {
    max-height: 300px;
    overflow-y: auto;
    padding: 10px 0;
}

.notification-item {
    padding: 12px 20px;
    border-bottom: 1px solid #f3f4f6;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: flex-start;
    gap: 12px;
}

.notification-item:hover {
    background: #f9fafb;
}

.notification-item.unread {
    background: rgba(16, 185, 129, 0.05);
    border-right: 3px solid #10b981;
}

.notification-icon {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.9rem;
    flex-shrink: 0;
}

.notification-icon.success {
    background: rgba(16, 185, 129, 0.1);
    color: #10b981;
}

.notification-icon.warning {
    background: rgba(245, 158, 11, 0.1);
    color: #f59e0b;
}

.notification-icon.info {
    background: rgba(59, 130, 246, 0.1);
    color: #3b82f6;
}

.notification-icon.error {
    background: rgba(239, 68, 68, 0.1);
    color: #ef4444;
}

.notification-content {
    flex: 1;
    min-width: 0;
}

.notification-title {
    font-weight: 600;
    font-size: 0.9rem;
    color: #1f2937;
    margin-bottom: 4px;
    line-height: 1.3;
}

.notification-message {
    font-size: 0.85rem;
    color: #6b7280;
    line-height: 1.4;
    margin-bottom: 4px;
}

.notification-time {
    font-size: 0.75rem;
    color: #9ca3af;
}

.notification-actions {
    display: flex;
    gap: 5px;
    flex-shrink: 0;
    align-items: center;
}

.notification-actions .btn {
    padding: 4px 8px;
    font-size: 0.8rem;
    border-radius: 6px;
}

.no-notifications {
    text-align: center;
    padding: 40px 20px;
    color: #9ca3af;
}

.no-notifications i {
    font-size: 3rem;
    margin-bottom: 15px;
    display: block;
}

.no-notifications p {
    margin: 0;
    font-size: 0.9rem;
}

.notifications-footer {
    padding: 15px 20px;
    border-top: 1px solid #f3f4f6;
    text-align: center;
}

.notifications-footer a {
    color: #10b981;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.3s ease;
}

.notifications-footer a:hover {
    color: #059669;
}

@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.5; }
}

/* Responsive Notifications */
@media (max-width: 768px) {
    .notifications-panel {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        width: 100%;
        height: 100%;
        border-radius: 0;
        z-index: 9999;
    }
    
    .notifications-panel {
        padding: 20px;
    }
    
    .notifications-toggle {
        padding: 8px;
    }
    
    .notifications-badge {
        font-size: 0.7rem;
        min-width: 16px;
        height: 16px;
    }
}



/* Enhanced Auth Buttons */
.auth-buttons {
    display: flex;
    align-items: center;
    gap: 10px;
}

.btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 20px;
    border-radius: 25px;
    font-weight: 600;
    font-size: 14px;
    text-decoration: none;
    transition: all 0.3s ease;
    border: 2px solid transparent;
    cursor: pointer;
    backdrop-filter: blur(10px);
}

.btn-outline {
    background: rgba(255,255,255,0.1);
    border-color: rgba(255,255,255,0.3);
    color: white;
}

.btn-outline:hover {
    background: rgba(255,255,255,0.2);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(255,255,255,0.2);
}

.btn-primary {
    background: #fbbf24;
    color: #1f2937;
    border-color: #fbbf24;
}

.btn-primary:hover {
    background: #f59e0b;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(251, 191, 36, 0.4);
}

/* Enhanced User Menu */
.user-menu {
    position: relative;
}

.user-toggle {
    display: flex;
    align-items: center;
    gap: 12px;
    background: linear-gradient(135deg, rgba(16, 185, 129, 0.9) 0%, rgba(5, 150, 105, 0.9) 100%);
    border: 2px solid rgba(255,255,255,0.3);
    color: white;
    padding: 10px 18px;
    border-radius: 30px;
    cursor: pointer;
    transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    backdrop-filter: blur(15px);
    box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
    position: relative;
    overflow: hidden;
}

.user-toggle::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.6s ease;
}

.user-toggle:hover::before {
    left: 100%;
}

.user-toggle:hover {
    background: linear-gradient(135deg, rgba(16, 185, 129, 1) 0%, rgba(5, 150, 105, 1) 100%);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(16, 185, 129, 0.4);
    border-color: rgba(255,255,255,0.5);
}

.user-avatar {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    overflow: hidden;
    background: rgba(255,255,255,0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    border: 2px solid rgba(255,255,255,0.3);
    transition: all 0.3s ease;
}

.user-toggle:hover .user-avatar {
    border-color: rgba(255,255,255,0.6);
    transform: scale(1.05);
}

.user-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 50%;
}

.user-avatar i {
    font-size: 20px;
    color: rgba(255,255,255,0.9);
}

.user-name {
    font-weight: 700;
    font-size: 15px;
    text-shadow: 0 1px 2px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}

.user-toggle:hover .user-name {
    transform: scale(1.02);
}

.user-dropdown {
    position: absolute;
    top: 100%;
    right: 0;
    background: rgba(255,255,255,0.95);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255,255,255,0.2);
    border-radius: 16px;
    box-shadow: 0 12px 40px rgba(0,0,0,0.15);
    min-width: 220px;
    opacity: 0;
    visibility: hidden;
    transform: translateY(-15px) scale(0.95);
    transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    z-index: 9999;
    margin-top: 15px;
    padding: 12px;
}

.user-menu:hover .user-dropdown {
    opacity: 1;
    visibility: visible;
    transform: translateY(0) scale(1);
}

.dropdown-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 16px;
    color: #374151;
    text-decoration: none;
    border-radius: 10px;
    transition: all 0.3s ease;
    font-size: 14px;
    font-weight: 500;
    position: relative;
    overflow: hidden;
}

.dropdown-item::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(16, 185, 129, 0.1), transparent);
    transition: left 0.5s ease;
}

.dropdown-item:hover::before {
    left: 100%;
}

.dropdown-item:hover {
    background: rgba(16, 185, 129, 0.08);
    color: #10b981;
    transform: translateX(5px);
    box-shadow: 0 2px 8px rgba(16, 185, 129, 0.15);
}

.dropdown-item i {
    font-size: 16px;
    color: #6b7280;
    transition: all 0.3s ease;
    width: 20px;
    text-align: center;
}

.dropdown-item:hover i {
    color: #10b981;
    transform: scale(1.1);
}

.dropdown-divider {
    height: 1px;
    background: linear-gradient(90deg, transparent, #e5e7eb, transparent);
    margin: 10px 0;
    border-radius: 1px;
}

.logout-btn {
    background: none;
    border: none;
    width: 100%;
    text-align: left;
    color: #ef4444;
    cursor: pointer;
    font-weight: 500;
    transition: all 0.3s ease;
}

.logout-btn:hover {
    background: rgba(239, 68, 68, 0.08);
    color: #dc2626;
    transform: translateX(5px);
    box-shadow: 0 2px 8px rgba(239, 68, 68, 0.15);
}

.logout-btn:hover i {
    transform: scale(1.1);
}

/* Enhanced Mobile Menu Toggle */
.mobile-menu-toggle {
    display: none;
    flex-direction: column;
    gap: 4px;
    background: rgba(255,255,255,0.1);
    border: 2px solid rgba(255,255,255,0.2);
    cursor: pointer;
    padding: 10px;
    border-radius: 8px;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
    /* Prevent shaking */
    transform: translateZ(0);
    -webkit-transform: translateZ(0);
    backface-visibility: hidden;
    -webkit-backface-visibility: hidden;
}

.hamburger-line {
    width: 24px;
    height: 2px;
    background: white;
    border-radius: 2px;
    transition: all 0.3s ease;
    /* Prevent shaking */
    transform: translateZ(0);
    -webkit-transform: translateZ(0);
}

.mobile-menu-toggle:hover {
    background: rgba(255,255,255,0.2);
    border-color: rgba(255,255,255,0.4);
    transform: translateZ(0) scale(1.05);
    -webkit-transform: translateZ(0) scale(1.05);
}

.mobile-menu-toggle:hover .hamburger-line {
    background: #fbbf24;
}

/* Enhanced Mobile Menu */
.mobile-menu {
    position: fixed;
    top: 0;
    right: -100%;
    width: 320px;
    height: 100vh;
    background: white;
    box-shadow: -5px 0 15px rgba(0,0,0,0.1);
    z-index: 10000;
    transition: right 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    overflow-y: auto;
    display: flex;
    flex-direction: column;
    /* Prevent shaking */
    transform: translateZ(0);
    -webkit-transform: translateZ(0);
    backface-visibility: hidden;
    -webkit-backface-visibility: hidden;
}

.mobile-menu.active {
    right: 0;
}

.mobile-menu-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px;
    background: #10b981;
    color: white;
    flex-direction: row-reverse;
}

.mobile-menu-header h3 {
    margin: 0;
    font-size: 18px;
    font-weight: 600;
}

.mobile-menu-close {
    background: rgba(255,255,255,0.1);
    border: 2px solid rgba(255,255,255,0.3);
    color: white;
    font-size: 18px;
    cursor: pointer;
    padding: 8px;
    border-radius: 50%;
    transition: all 0.3s ease;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    backdrop-filter: blur(10px);
}

.mobile-menu-close:hover {
    background: rgba(255,255,255,0.2);
    border-color: rgba(255,255,255,0.5);
    transform: scale(1.1);
    box-shadow: 0 4px 12px rgba(0,0,0,0.2);
}



.mobile-nav-menu {
    list-style: none;
    padding: 0;
    margin: 0;
    flex: 1;
}

.mobile-nav-link {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 15px 20px;
    color: #374151;
    text-decoration: none;
    border-bottom: 1px solid #f3f4f6;
    transition: all 0.3s ease;
    font-weight: 500;
}

.mobile-nav-link:hover,
.mobile-nav-link.active {
    background: #f9fafb;
    color: #10b981;
    padding-left: 25px;
}

.mobile-nav-link i {
    font-size: 18px;
    width: 20px;
    text-align: center;
}

.mobile-auth-buttons {
    padding: 20px;
    display: flex;
    flex-direction: column;
    gap: 12px;
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    border-top: 1px solid #e5e7eb;
    margin-top: auto;
}

.mobile-auth-buttons .btn {
    width: 100%;
    justify-content: center;
    padding: 16px 20px;
    font-size: 16px;
    font-weight: 600;
    border-radius: 12px;
    transition: all 0.3s ease;
    text-align: center;
    display: flex;
    align-items: center;
    gap: 8px;
}

.mobile-auth-buttons .btn i {
    font-size: 18px;
}

.mobile-auth-buttons .btn-outline {
    background: rgba(16, 185, 129, 0.1);
    border: 2px solid #10b981;
    color: #10b981;
}

.mobile-auth-buttons .btn-outline:hover {
    background: #10b981;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
}

.mobile-auth-buttons .btn-primary {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    border: 2px solid #10b981;
    color: white;
}

.mobile-auth-buttons .btn-primary:hover {
    background: linear-gradient(135deg, #059669 0%, #047857 100%);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(16, 185, 129, 0.4);
}

.mobile-user-info {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 20px;
    background: #f9fafb;
    border-bottom: 1px solid #e5e7eb;
}

.mobile-user-avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    overflow: hidden;
    background: #e5e7eb;
    display: flex;
    align-items: center;
    justify-content: center;
}

.mobile-user-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.mobile-user-avatar i {
    font-size: 24px;
    color: #6b7280;
}

.mobile-user-details h4 {
    margin: 0 0 5px 0;
    color: #1f2937;
    font-size: 16px;
    font-weight: 600;
}

.mobile-user-details p {
    margin: 0;
    color: #6b7280;
    font-size: 14px;
}

.mobile-user-actions {
    padding: 20px;
}

.mobile-action-link {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 15px 20px;
    color: #374151;
    text-decoration: none;
    transition: all 0.3s ease;
    font-weight: 500;
    border-bottom: 1px solid #f3f4f6;
    border-radius: 8px;
    margin: 5px 0;
    position: relative;
    overflow: hidden;
}

.mobile-action-link::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(16, 185, 129, 0.1), transparent);
    transition: left 0.5s ease;
}

.mobile-action-link:hover::before {
    left: 100%;
}

.mobile-action-link:hover {
    color: #10b981;
    padding-left: 25px;
    background: rgba(16, 185, 129, 0.05);
    transform: translateX(5px);
    box-shadow: 0 2px 8px rgba(16, 185, 129, 0.1);
}

.mobile-action-link i {
    font-size: 18px;
    transition: all 0.3s ease;
}

.mobile-action-link:hover i {
    transform: scale(1.1);
    color: #10b981;
}

.mobile-action-link.logout-btn {
    color: #ef4444;
    border: none;
}

.mobile-action-link.logout-btn:hover {
    color: #dc2626;
    background: rgba(239, 68, 68, 0.05);
    box-shadow: 0 2px 8px rgba(239, 68, 68, 0.1);
}

.mobile-action-link.logout-btn:hover i {
    color: #dc2626;
}

/* Responsive Design */
@media (max-width: 1024px) {
    .navbar-menu {
        display: none;
    }
    
    .mobile-menu-toggle {
        display: flex;
    }
    
    .auth-buttons {
        display: none;
    }
}

@media (max-width: 768px) {
    .header {
        margin-bottom: 0;
        margin-top: 0;
    }
    
    .header-main {
        margin-bottom: 0;
        margin-top: 0;
    }
    
    .navbar {
        margin-bottom: 0;
        margin-top: 0;
    }
    
    .header-top {
        padding: 4px 0;
        margin-bottom: 0;
    }
    
    .top-bar-content {
        gap: 8px;
    }
    
    .contact-info {
        gap: 6px;
    }
    
    .top-bar-right {
        gap: 8px;
    }
    
    /* Remove any gaps between header and main content */
    .main-content-area,
    .main-content,
    main,
    .content,
    section:first-of-type {
        margin-top: 0 !important;
        padding-top: 0 !important;
    }
    
    /* Ensure hero section starts immediately after header */
    .hero-slider {
        margin-top: 0 !important;
        padding-top: 0 !important;
    }
    
    /* Remove any body padding/margin that might create gaps */
    body {
        margin-top: 0 !important;
        padding-top: 0 !important;
    }
    
    .top-bar-content {
        flex-direction: row !important;
        gap: 10px;
        flex-wrap: nowrap !important;
        overflow-x: auto;
        overflow-y: hidden;
        align-items: center;
        justify-content: space-between;
    }
    
    .contact-info {
        justify-content: flex-start;
        gap: 8px;
        flex-wrap: nowrap !important;
        flex-direction: row !important;
        overflow-x: auto;
        overflow-y: hidden;
        width: auto;
        flex: 1;
    }
    
    .contact-item {
        padding: 3px 6px;
        font-size: 9px;
        min-width: auto;
        white-space: nowrap;
    }
    
    .contact-icon {
        width: 16px;
        height: 16px;
        font-size: 8px;
    }
    
    .contact-value {
        font-size: 9px;
    }
    
    .contact-label {
        font-size: 8px;
    }
    
    .top-bar-right {
        justify-content: flex-end;
        gap: 10px;
        flex-wrap: nowrap !important;
        flex-direction: row !important;
        overflow-x: auto;
        overflow-y: hidden;
        -webkit-overflow-scrolling: touch;
        flex-shrink: 0;
    }
    
    .social-links {
        padding: 4px 8px;
        gap: 6px;
    }
    
    .social-link {
        padding: 6px;
        font-size: 14px;
    }
    
    .lang-btn {
        padding: 6px 12px;
        font-size: 12px;
    }
    
    .navbar {
        min-height: 50px;
        padding: 0 10px;
    }
    
    .logo {
        padding: 4px 10px;
    }
    
    .logo-title {
        font-size: 12px;
    }
    
    .logo-subtitle {
        font-size: 8px;
    }
    
    .logo-image {
        height: 35px;
    }
    
    .search-toggle {
        width: 35px;
        height: 35px;
    }
}

@media (max-width: 480px) {
    .header-top {
        padding: 2px 0;
    }
    
    .top-bar-content {
        gap: 5px;
    }
    
    .contact-info {
        gap: 4px;
    }
    
    .top-bar-right {
        gap: 5px;
    }
    
    .navbar {
        min-height: 45px;
        padding: 0 8px;
    }
    
    .logo {
        padding: 3px 8px;
    }
    
    .logo-title {
        font-size: 11px;
    }
    
    .logo-subtitle {
        font-size: 7px;
    }
    
    .logo-image {
        height: 30px;
    }
    
    /* Additional mobile optimizations */
    .main-content-area,
    .main-content,
    main,
    .content,
    section:first-of-type {
        margin-top: 0 !important;
        padding-top: 0 !important;
    }
    
    .hero-slider {
        margin-top: 0 !important;
        padding-top: 0 !important;
    }
    
    body {
        margin-top: 0 !important;
        padding-top: 0 !important;
    }
    
    .contact-info {
        flex-direction: row;
        gap: 8px;
        width: auto;
        flex-wrap: nowrap;
    }
    
    .contact-item {
        width: auto;
        justify-content: center;
        padding: 2px 4px;
        flex-shrink: 0;
        font-size: 8px;
    }
    
    .contact-icon {
        width: 14px;
        height: 14px;
        font-size: 7px;
    }
    
    .contact-value {
        font-size: 8px;
    }
    
    .contact-label {
        font-size: 7px;
    }
    
    .social-links {
        gap: 6px;
        padding: 6px 10px;
        width: auto;
        justify-content: center;
        flex-wrap: nowrap;
    }
    
    .social-link {
        padding: 6px;
        font-size: 14px;
        flex-shrink: 0;
    }
    
    .lang-btn {
        padding: 6px 10px;
        font-size: 11px;
        width: auto;
        justify-content: center;
        flex-shrink: 0;
    }
    
    .top-bar-right {
        width: auto;
        flex-direction: row;
        gap: 15px;
    }
    
    .mobile-menu {
        width: 100%;
    }
}

/* Enhanced Footer Styles */
.enhanced-footer {
    background: linear-gradient(135deg, #1f2937 0%, #111827 100%);
    color: white;
    position: relative;
    overflow: hidden;
    margin-top: 80px;
    padding: 0;
    margin-left: 0;
    margin-right: 0;
}

.footer-background {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 1;
}

.footer-pattern {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-image: 
        radial-gradient(circle at 25% 25%, rgba(16, 185, 129, 0.1) 0%, transparent 50%),
        radial-gradient(circle at 75% 75%, rgba(251, 191, 36, 0.1) 0%, transparent 50%);
    opacity: 0.6;
}

.footer-content {
    display: grid;
    grid-template-columns: 2fr 1fr 1fr 1fr 1fr;
    gap: 40px;
    padding: 60px 0 40px;
    position: relative;
    z-index: 2;
    max-width: 100%;
    align-items: start;
    margin: 0;
    padding-left: 0;
    padding-right: 0;
}

.footer-section {
    display: flex;
    flex-direction: column;
    gap: 20px;
    padding: 0;
}

.footer-brand {
    grid-column: 1;
    text-align: right;
    max-width: 100%;
    margin: 0;
    padding: 0;
}

.footer-logo {
    display: flex;
    align-items: center;
    justify-content: flex-start;
    gap: 15px;
    margin-bottom: 20px;
}

.logo-icon {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #10b981, #059669);
    border-radius: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 28px;
    color: white;
    box-shadow: 0 8px 25px rgba(16, 185, 129, 0.3);
}

.logo-text h3 {
    font-size: 24px;
    font-weight: 700;
    margin: 0;
    background: linear-gradient(135deg, #10b981, #fbbf24);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.logo-tagline {
    color: #9ca3af;
    font-size: 14px;
    font-weight: 500;
}

.footer-description {
    color: #d1d5db;
    line-height: 1.8;
    font-size: 16px;
    margin-bottom: 30px;
    text-align: right;
}

.footer-social {
    margin: 0;
    padding: 0;
    width: 100%;
}

.footer-social h4 {
    color: #fbbf24;
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 15px;
    display: flex;
    align-items: center;
    gap: 8px;
    justify-content: flex-start;
    margin-right: 0;
    margin-left: 0;
    padding: 0;
}

.social-icons-grid {
    display: flex;
    justify-content: flex-start;
    gap: 15px;
    flex-wrap: wrap;
    margin: 0;
    padding: 0;
    width: 100%;
}

.social-icon {
    width: 45px;
    height: 45px;
    background: rgba(255,255,255,0.1);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 20px;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,0.2);
    margin: 0;
    padding: 0;
    flex-shrink: 0;
}

.social-icon:hover {
    transform: translateY(-3px) scale(1.1);
    background: rgba(255,255,255,0.2);
}

.social-icon.whatsapp:hover {
    color: #25D366;
    box-shadow: 0 8px 25px rgba(37, 211, 102, 0.3);
}

.social-icon.twitter:hover {
    color: #1DA1F2;
    box-shadow: 0 8px 25px rgba(29, 161, 242, 0.3);
}

.social-icon.telegram:hover {
    color: #0088cc;
    box-shadow: 0 8px 25px rgba(0, 136, 204, 0.3);
}

.social-icon.youtube:hover {
    color: #FF0000;
    box-shadow: 0 8px 25px rgba(255, 0, 0, 0.3);
}

.social-icon.tiktok:hover {
    color: #000000;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
}

.social-icon.email:hover {
    color: #EA4335;
    box-shadow: 0 8px 25px rgba(234, 67, 53, 0.3);
}

.section-title {
    font-size: 20px;
    font-weight: 700;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 10px;
    color: #fbbf24;
    position: relative;
    padding-bottom: 10px;
}

.section-title::after {
    content: '';
    position: absolute;
    bottom: 0;
    right: 0;
    width: 50px;
    height: 3px;
    background: linear-gradient(135deg, #10b981, #fbbf24);
    border-radius: 2px;
}

.section-title i {
    color: #10b981;
    font-size: 24px;
}

.footer-links {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.footer-links a {
    color: #d1d5db;
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 8px 0;
    transition: all 0.3s ease;
    font-size: 15px;
    position: relative;
    overflow: hidden;
}

.footer-links a::before {
    content: '';
    position: absolute;
    right: -100%;
    top: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(16, 185, 129, 0.1), transparent);
    transition: right 0.3s ease;
}

.footer-links a:hover::before {
    right: 100%;
}

.footer-links a:hover {
    color: #10b981;
    transform: translateX(-5px);
    padding-right: 10px;
}

.footer-links a i {
    font-size: 12px;
    transition: transform 0.3s ease;
    color: #10b981;
}

.footer-links a:hover i {
    transform: translateX(-3px) scale(1.2);
}

/* Enhanced Contact Info Section */
.contact-info {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    flex-direction: column;
    gap: 20px;
}

/* Contact Cards Layout */
.contact-cards {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.contact-card {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 15px;
    background: rgba(255,255,255,0.05);
    border-radius: 12px;
    border: 1px solid rgba(255,255,255,0.1);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.contact-card::before {
    content: '';
    position: absolute;
    top: 0;
    right: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(16, 185, 129, 0.1), transparent);
    transition: right 0.3s ease;
}

.contact-card:hover::before {
    right: 100%;
}

.contact-card:hover {
    background: rgba(255,255,255,0.08);
    border-color: rgba(16, 185, 129, 0.3);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(16, 185, 129, 0.15);
}

.contact-card-icon {
    width: 45px;
    height: 45px;
    background: linear-gradient(135deg, #10b981, #059669);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 18px;
    flex-shrink: 0;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
}

.contact-card:hover .contact-card-icon {
    transform: scale(1.1) rotate(5deg);
    box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
}

.contact-card-content {
    display: flex;
    flex-direction: column;
    gap: 6px;
    flex: 1;
}

.contact-card-content h5 {
    color: #9ca3af;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin: 0;
}

.contact-card-content p,
.contact-card-content a {
    color: #d1d5db;
    font-size: 14px;
    font-weight: 500;
    line-height: 1.4;
    margin: 0;
    text-decoration: none;
    transition: color 0.3s ease;
}

.contact-card-content a:hover {
    color: #10b981;
    text-shadow: 0 0 8px rgba(16, 185, 129, 0.3);
}

.contact-info li {
    display: flex;
    align-items: flex-start;
    gap: 15px;
    padding: 15px;
    background: rgba(255,255,255,0.05);
    border-radius: 12px;
    border: 1px solid rgba(255,255,255,0.1);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.contact-info li::before {
    content: '';
    position: absolute;
    top: 0;
    right: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(16, 185, 129, 0.1), transparent);
    transition: right 0.3s ease;
}

.contact-info li:hover::before {
    right: 100%;
}

.contact-info li:hover {
    background: rgba(255,255,255,0.08);
    border-color: rgba(16, 185, 129, 0.3);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(16, 185, 129, 0.15);
}

.contact-icon {
    width: 45px;
    height: 45px;
    background: linear-gradient(135deg, #10b981, #059669);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 18px;
    flex-shrink: 0;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
}

.contact-info li:hover .contact-icon {
    transform: scale(1.1) rotate(5deg);
    box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
}

.contact-details {
    display: flex;
    flex-direction: column;
    gap: 6px;
    flex: 1;
}

.contact-label {
    color: #9ca3af;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 2px;
}

.contact-value {
    color: #d1d5db;
    font-size: 14px;
    font-weight: 500;
    line-height: 1.4;
}

.contact-link {
    color: #10b981 !important;
    text-decoration: none;
    transition: all 0.3s ease;
    font-weight: 600;
}

.contact-link:hover {
    color: #fbbf24 !important;
    text-shadow: 0 0 8px rgba(251, 191, 36, 0.3);
}

.footer-bottom {
    border-top: 1px solid rgba(255,255,255,0.1);
    padding: 30px 0;
    position: relative;
    z-index: 2;
    background: rgba(0,0,0,0.2);
}

.footer-bottom-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 20px;
}

.copyright p {
    color: #9ca3af;
    font-size: 14px;
    margin: 0;
}

.footer-links-bottom {
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
}

.footer-links-bottom a {
    color: #d1d5db;
    text-decoration: none;
    font-size: 14px;
    transition: color 0.3s ease;
    padding: 8px 12px;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.footer-links-bottom a:hover {
    color: #10b981;
    background: rgba(16, 185, 129, 0.1);
    transform: translateY(-2px);
}

/* Footer Responsive Design */
@media (max-width: 1200px) {
    .footer-content {
        grid-template-columns: 2fr 1fr 1fr 1fr;
        gap: 30px;
    }
    
    .footer-section:last-child {
        grid-column: 1 / -1;
        text-align: center;
    }
}

@media (max-width: 992px) {
    .footer-content {
        grid-template-columns: 1fr 1fr;
        gap: 30px;
    }
    
    .footer-brand {
        grid-column: 1 / -1;
        text-align: center;
    }
    
    .footer-section:last-child {
        grid-column: 1 / -1;
    }
}

@media (max-width: 768px) {
    .footer-content {
        grid-template-columns: 1fr;
        gap: 30px;
        padding: 40px 0 30px;
    }

    .footer-brand {
        grid-column: 1;
        text-align: center;
    }

    .footer-bottom-content {
        flex-direction: column;
        text-align: center;
    }
    
    .contact-info li {
        padding: 12px;
    }
    
    .contact-icon {
        width: 40px;
        height: 40px;
        font-size: 16px;
    }
    
    .contact-card {
        padding: 12px;
    }
    
    .contact-card-icon {
        width: 40px;
        height: 40px;
        font-size: 16px;
    }
}

@media (max-width: 480px) {
    .footer-content {
        grid-template-columns: 1fr;
        gap: 25px;
        padding: 30px 0 25px;
    }

    .footer-brand {
        padding: 0 15px;
    }

    .social-icons-grid {
        gap: 10px;
        justify-content: center;
    }

    .social-icon {
        width: 40px;
        height: 40px;
        font-size: 18px;
    }

    .footer-bottom-content {
        gap: 15px;
    }
    
    .contact-info li {
        padding: 10px;
        gap: 12px;
    }
    
    .contact-icon {
        width: 35px;
        height: 35px;
        font-size: 14px;
    }
    
    .contact-value {
        font-size: 13px;
    }
    
    .contact-card {
        padding: 10px;
        gap: 12px;
    }
    
    .contact-card-icon {
        width: 35px;
        height: 35px;
        font-size: 14px;
    }
    
    .contact-card-content p,
    .contact-card-content a {
        font-size: 13px;
    }
}
</style> 