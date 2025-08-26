@extends('layouts.admin')

@section('title', 'الإشعارات')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">
                            <i class="bi bi-bell"></i>
                            الإشعارات
                        </h5>
                        <div class="header-actions">
                            <button class="btn btn-outline-primary btn-sm" onclick="markAllAsRead()">
                                <i class="bi bi-check-all"></i>
                                تحديد الكل كمقروء
                            </button>
                                                    <button class="btn btn-outline-danger btn-sm" onclick="deleteAllNotifications()">
                            <i class="bi bi-trash"></i>
                            حذف الكل
                        </button>
                        </div>
                    </div>
                </div>
                
                <div class="card-body">
                    @if($notifications->count() > 0)
                        <div class="notifications-list">
                            @foreach($notifications as $notification)
                                <div class="notification-item {{ !$notification->read_at ? 'unread' : '' }}" 
                                     data-notification-id="{{ $notification->id }}">
                                    <div class="notification-icon {{ $notification->type ?? 'info' }}">
                                        @switch($notification->type ?? 'info')
                                            @case('success')
                                                <i class="bi bi-check-circle"></i>
                                                @break
                                            @case('warning')
                                                <i class="bi bi-exclamation-triangle"></i>
                                                @break
                                            @case('error')
                                                <i class="bi bi-x-circle"></i>
                                                @break
                                            @default
                                                <i class="bi bi-info-circle"></i>
                                        @endswitch
                                    </div>
                                    
                                    <div class="notification-content">
                                        <div class="notification-title">{{ $notification->title }}</div>
                                        <div class="notification-message">{{ $notification->message }}</div>
                                        <div class="notification-time">
                                            {{ $notification->created_at->diffForHumans() }}
                                        </div>
                                    </div>
                                    
                                    <div class="notification-actions">
                                        @if(!$notification->read_at)
                                            <button class="btn btn-sm btn-outline-success" 
                                                    onclick="markAsRead({{ $notification->id }})"
                                                    title="تحديد كمقروء">
                                                <i class="bi bi-check"></i>
                                            </button>
                                        @endif
                                        <button class="btn btn-sm btn-outline-danger" 
                                                onclick="deleteNotification({{ $notification->id }})"
                                                title="حذف">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        <div class="d-flex justify-content-center mt-4">
                            {{ $notifications->links() }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="bi bi-bell-slash" style="font-size: 3rem; color: #9ca3af;"></i>
                            <h5 class="mt-3 text-muted">لا توجد إشعارات</h5>
                            <p class="text-muted">لم يصل أي إشعار من الموقع بعد</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.notifications-list {
    max-height: 600px;
    overflow-y: auto;
}

.notification-item {
    display: flex;
    align-items: flex-start;
    gap: 15px;
    padding: 15px;
    border-bottom: 1px solid #f3f4f6;
    transition: all 0.3s ease;
}

.notification-item:hover {
    background: #f9fafb;
}

.notification-item.unread {
    background: rgba(16, 185, 129, 0.05);
    border-right: 3px solid #10b981;
}

.notification-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.1rem;
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
}

.notification-title {
    font-weight: 600;
    font-size: 0.9rem;
    color: #1f2937;
    margin-bottom: 5px;
}

.notification-message {
    font-size: 0.85rem;
    color: #6b7280;
    line-height: 1.4;
    margin-bottom: 5px;
}

.notification-time {
    font-size: 0.75rem;
    color: #9ca3af;
}

.notification-actions {
    display: flex;
    gap: 5px;
    flex-shrink: 0;
}

.notification-actions .btn {
    padding: 4px 8px;
    font-size: 0.8rem;
}
</style>

<script>
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
            notificationItem.classList.remove('unread');
            
            // Update badge count
            updateNotificationBadge();
            
            showAlert('تم تحديد الإشعار كمقروء', 'success');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showAlert('حدث خطأ أثناء تحديث الإشعار', 'error');
    });
}

function markAllAsRead() {
    if (!confirm('هل تريد تحديد جميع الإشعارات كمقروءة؟')) {
        return;
    }
    
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
            updateNotificationBadge();
            
            showAlert('تم تحديد جميع الإشعارات كمقروءة', 'success');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showAlert('حدث خطأ أثناء تحديث الإشعارات', 'error');
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
            notificationItem.remove();
            
            // Update badge count
            updateNotificationBadge();
            
            showAlert('تم حذف الإشعار بنجاح', 'success');
            
            // Check if no notifications left
            if (document.querySelectorAll('.notification-item').length === 0) {
                location.reload();
            }
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showAlert('حدث خطأ أثناء حذف الإشعار', 'error');
    });
}

function deleteAllNotifications() {
    if (!confirm('هل تريد حذف جميع الإشعارات؟ هذا الإجراء لا يمكن التراجع عنه.')) {
        return;
    }
    
    // Get all notification IDs
    const notificationIds = Array.from(document.querySelectorAll('.notification-item'))
        .map(item => item.getAttribute('data-notification-id'));
    
    // Delete each notification
    Promise.all(notificationIds.map(id => 
        fetch(`/admin/notifications/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        })
    ))
    .then(() => {
        showAlert('تم حذف جميع الإشعارات بنجاح', 'success');
        location.reload();
    })
    .catch(error => {
        console.error('Error:', error);
        showAlert('حدث خطأ أثناء حذف الإشعارات', 'error');
    });
}

function updateNotificationBadge() {
    const unreadCount = document.querySelectorAll('.notification-item.unread').length;
    const badge = document.getElementById('notificationsCount');
    
    if (badge) {
        badge.textContent = unreadCount;
        badge.style.display = unreadCount > 0 ? 'block' : 'none';
    }
}

function showAlert(message, type = 'info') {
    const alertClass = type === 'success' ? 'alert-success' : 
                     type === 'error' ? 'alert-danger' : 
                     type === 'warning' ? 'alert-warning' : 'alert-info';
    
    const alert = `
        <div class="alert ${alertClass} alert-dismissible fade show" role="alert" style="position: fixed; top: 20px; right: 20px; z-index: 9999; min-width: 300px;">
            <i class="bi bi-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-triangle' : 'info-circle'}"></i>
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    `;
    
    document.body.insertAdjacentHTML('beforeend', alert);
    
    // Auto remove after 5 seconds
    setTimeout(() => {
        const alerts = document.querySelectorAll('.alert');
        if (alerts.length > 0) {
            alerts[alerts.length - 1].remove();
        }
    }, 5000);
}

        // Update badge count on page load
        document.addEventListener('DOMContentLoaded', function() {
            updateNotificationBadge();
        });


</script>
@endsection 