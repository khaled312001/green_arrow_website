// Notifications functionality
console.log('Notifications script loaded');

// Check if elements exist
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM loaded');
    
    const toggleButton = document.getElementById('notificationsToggle');
    const panel = document.getElementById('notificationsPanel');
    
    console.log('Toggle button:', toggleButton);
    console.log('Panel:', panel);
    
    if (toggleButton) {
        console.log('Toggle button found, adding click listener');
        toggleButton.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            console.log('Toggle button clicked');
            toggleNotifications();
        });
    } else {
        console.error('Toggle button not found');
    }
    
    // Load notifications on page load
    loadNotifications();
    
    // Auto refresh notifications every 30 seconds
    setInterval(loadNotifications, 30000);
});

function toggleNotifications() {
    console.log('Toggle notifications clicked');
    const panel = document.getElementById('notificationsPanel');
    const toggle = document.getElementById('notificationsToggle');
    
    if (!panel) {
        console.error('Notifications panel not found');
        return;
    }
    
    console.log('Panel found, toggling...');
    panel.classList.toggle('active');
    
    // Close when clicking outside
    if (panel.classList.contains('active')) {
        console.log('Panel is now active');
        document.addEventListener('click', closeNotificationsOnClickOutside);
    } else {
        console.log('Panel is now inactive');
        document.removeEventListener('click', closeNotificationsOnClickOutside);
    }
}

function closeNotificationsOnClickOutside(event) {
    const panel = document.getElementById('notificationsPanel');
    const toggle = document.getElementById('notificationsToggle');
    
    if (!panel.contains(event.target) && !toggle.contains(event.target)) {
        panel.classList.remove('active');
        document.removeEventListener('click', closeNotificationsOnClickOutside);
    }
}

function markAllAsRead() {
    fetch('/admin/notifications/mark-all-read', {
        method: 'PUT',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Remove unread class from all notifications
            document.querySelectorAll('.notification-item.unread').forEach(item => {
                item.classList.remove('unread');
            });
            
            // Update badge count
            updateNotificationBadge(0);
            
            // Show success message
            showNotification('تم تحديد جميع الإشعارات كمقروءة', 'success');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('حدث خطأ أثناء تحديث الإشعارات', 'error');
    });
}

function viewAllNotifications() {
    // Redirect to notifications page or show all notifications
    window.location.href = '/admin/notifications';
}

function updateNotificationBadge(count) {
    const badge = document.getElementById('notificationsCount');
    if (badge) {
        badge.textContent = count;
        
        if (count > 0) {
            badge.style.display = 'block';
        } else {
            badge.style.display = 'none';
        }
    }
}

function showNotification(message, type = 'info') {
    const alertClass = type === 'success' ? 'alert-success' : 
                     type === 'error' ? 'alert-danger' : 
                     type === 'warning' ? 'alert-warning' : 'alert-info';
    
    const notification = `
        <div class="alert ${alertClass} alert-dismissible fade show" role="alert" style="position: fixed; top: 20px; right: 20px; z-index: 9999; min-width: 300px;">
            <i class="bi bi-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-triangle' : 'info-circle'}"></i>
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    `;
    
    document.body.insertAdjacentHTML('beforeend', notification);
    
    // Auto remove after 5 seconds
    setTimeout(() => {
        const alerts = document.querySelectorAll('.alert');
        if (alerts.length > 0) {
            alerts[alerts.length - 1].remove();
        }
    }, 5000);
}

function loadNotifications() {
    console.log('Loading notifications...');
    fetch('/admin/notifications/api', {
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        console.log('Notifications data:', data);
        const notificationsList = document.getElementById('notificationsList');
        const noNotifications = document.querySelector('.no-notifications');
        
        if (data.notifications && data.notifications.length > 0) {
            console.log('Found notifications:', data.notifications.length);
            // Hide no notifications message
            if (noNotifications) {
                noNotifications.style.display = 'none';
            }
            
            // Clear existing notifications
            notificationsList.innerHTML = '';
            
            // Add notifications
            data.notifications.forEach(notification => {
                const notificationHtml = `
                    <div class="notification-item ${!notification.read_at ? 'unread' : ''}" 
                         data-notification-id="${notification.id}">
                        <div class="notification-icon ${notification.type || 'info'}">
                            <i class="bi bi-${getNotificationIcon(notification.type)}"></i>
                        </div>
                        <div class="notification-content">
                            <div class="notification-title">${notification.title}</div>
                            <div class="notification-message">${notification.message}</div>
                            <div class="notification-time">${formatTime(notification.created_at)}</div>
                        </div>
                        <div class="notification-actions">
                            ${!notification.read_at ? `
                                <button class="btn btn-sm btn-outline-success" 
                                        onclick="markAsRead(${notification.id})"
                                        title="تحديد كمقروء">
                                    <i class="bi bi-check"></i>
                                </button>
                            ` : ''}
                            <button class="btn btn-sm btn-outline-danger" 
                                    onclick="deleteNotification(${notification.id})"
                                    title="حذف">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    </div>
                `;
                notificationsList.insertAdjacentHTML('beforeend', notificationHtml);
            });
        } else {
            console.log('No notifications found');
            // Show no notifications message
            if (noNotifications) {
                noNotifications.style.display = 'block';
            }
        }
        
        // Update badge count
        updateNotificationBadge(data.unread_count || 0);
    })
    .catch(error => {
        console.error('Error loading notifications:', error);
        // Show no notifications message on error
        const noNotifications = document.querySelector('.no-notifications');
        if (noNotifications) {
            noNotifications.style.display = 'block';
        }
        updateNotificationBadge(0);
    });
}

function getNotificationIcon(type) {
    switch (type) {
        case 'success': return 'check-circle';
        case 'warning': return 'exclamation-triangle';
        case 'error': return 'x-circle';
        default: return 'info-circle';
    }
}

function formatTime(dateString) {
    const date = new Date(dateString);
    const now = new Date();
    const diffInMinutes = Math.floor((now - date) / (1000 * 60));
    
    if (diffInMinutes < 1) return 'الآن';
    if (diffInMinutes < 60) return `منذ ${diffInMinutes} دقيقة`;
    
    const diffInHours = Math.floor(diffInMinutes / 60);
    if (diffInHours < 24) return `منذ ${diffInHours} ساعة`;
    
    const diffInDays = Math.floor(diffInHours / 24);
    return `منذ ${diffInDays} يوم`;
}

function markAsRead(notificationId) {
    fetch(`/admin/notifications/${notificationId}/read`, {
        method: 'PUT',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const notificationItem = document.querySelector(`[data-notification-id="${notificationId}"]`);
            if (notificationItem) {
                notificationItem.classList.remove('unread');
            }
            
            // Update badge count
            loadNotifications();
            
            showNotification('تم تحديد الإشعار كمقروء', 'success');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('حدث خطأ أثناء تحديث الإشعار', 'error');
    });
}

function deleteNotification(notificationId) {
    if (!confirm('هل تريد حذف هذا الإشعار؟')) {
        return;
    }
    
    fetch(`/admin/notifications/${notificationId}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const notificationItem = document.querySelector(`[data-notification-id="${notificationId}"]`);
            if (notificationItem) {
                notificationItem.remove();
            }
            
            // Update badge count
            loadNotifications();
            
            showNotification('تم حذف الإشعار بنجاح', 'success');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('حدث خطأ أثناء حذف الإشعار', 'error');
    });
}