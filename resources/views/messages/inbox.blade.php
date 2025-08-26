@extends('layouts.student')

@section('title', 'صندوق الوارد')

@section('content')
<div class="messages-container">
    <!-- Page Header -->
    <div class="page-header">
        <div>
            <h1 style="font-size: 2rem; color: #1f2937; margin-bottom: 5px;">صندوق الوارد</h1>
            <p style="color: #6b7280; margin: 0;">عرض وإدارة الرسائل الواردة</p>
        </div>
        <div style="display: flex; gap: 15px;">
            <a href="{{ route('messages.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i>
                رسالة جديدة
            </a>
            <a href="{{ route('messages.sent') }}" class="btn btn-outline">
                <i class="bi bi-send"></i>
                الرسائل المرسلة
            </a>
        </div>
    </div>

    <!-- Messages List -->
    <div class="messages-list">
        @forelse($messages as $message)
        <div class="message-card {{ $message->isUnread() ? 'unread' : '' }}">
            <div class="message-header">
                <div class="sender-info">
                    <img src="{{ $message->sender->avatar_url }}" 
                         alt="{{ $message->sender->name }}"
                         class="sender-avatar">
                    <div>
                        <h4 class="sender-name">{{ $message->sender->name }}</h4>
                        <span class="message-date">{{ $message->created_at->diffForHumans() }}</span>
                    </div>
                </div>
                <div class="message-meta">
                    @if($message->course)
                        <span class="course-badge">{{ $message->course->title_ar }}</span>
                    @endif
                    <span class="priority-badge priority-{{ $message->priority }}">
                        {{ $message->priority === 'urgent' ? 'عاجلة' : 
                           ($message->priority === 'high' ? 'عالية' : 
                           ($message->priority === 'medium' ? 'متوسطة' : 'منخفضة')) }}
                    </span>
                    <span class="type-badge">
                        <i class="bi {{ $message->type_icon }}"></i>
                        {{ $message->type_label }}
                    </span>
                </div>
            </div>
            
            <div class="message-content">
                @if($message->subject)
                    <h5 class="message-subject">{{ $message->subject }}</h5>
                @endif
                <p class="message-text">{{ Str::limit($message->content, 200) }}</p>
            </div>
            
            <div class="message-actions">
                <a href="{{ route('messages.show', $message) }}" class="btn btn-sm btn-primary">
                    <i class="bi bi-eye"></i>
                    عرض الرسالة
                </a>
                @if($message->isUnread())
                    <button class="btn btn-sm btn-outline" onclick="markAsRead({{ $message->id }})">
                        <i class="bi bi-check"></i>
                        تحديد كمقروءة
                    </button>
                @endif
                <button class="btn btn-sm btn-danger" onclick="deleteMessage({{ $message->id }})">
                    <i class="bi bi-trash"></i>
                    حذف
                </button>
            </div>
        </div>
        @empty
        <div class="empty-state">
            <i class="bi bi-inbox"></i>
            <h3>لا توجد رسائل</h3>
            <p>صندوق الوارد فارغ</p>
            <a href="{{ route('messages.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i>
                إرسال رسالة جديدة
            </a>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($messages->hasPages())
    <div class="pagination-wrapper">
        {{ $messages->links() }}
    </div>
    @endif
</div>

<style>
.messages-container {
    padding: 30px;
    background: #f9fafb;
    min-height: 100vh;
}

.page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
    padding: 25px;
    background: white;
    border-radius: 15px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

.btn {
    display: inline-flex;
    align-items: center;
    padding: 12px 20px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    font-size: 0.9rem;
    transition: all 0.2s;
    border: none;
    cursor: pointer;
}

.btn-primary {
    background: #10b981;
    color: white;
}

.btn-primary:hover {
    background: #059669;
    transform: translateY(-2px);
}

.btn-outline {
    background: transparent;
    color: #10b981;
    border: 2px solid #10b981;
}

.btn-outline:hover {
    background: #10b981;
    color: white;
    transform: translateY(-2px);
}

.btn-sm {
    padding: 8px 15px;
    font-size: 0.8rem;
}

.btn-danger {
    background: #ef4444;
    color: white;
}

.btn-danger:hover {
    background: #dc2626;
}

.messages-list {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.message-card {
    background: white;
    border-radius: 15px;
    padding: 25px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    transition: all 0.3s;
    border-left: 4px solid transparent;
}

.message-card.unread {
    border-left-color: #10b981;
    background: #f0fdf4;
}

.message-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 15px rgba(0,0,0,0.1);
}

.message-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 15px;
}

.sender-info {
    display: flex;
    align-items: center;
    gap: 15px;
}

.sender-avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    object-fit: cover;
}

.sender-name {
    margin: 0 0 5px 0;
    color: #1f2937;
    font-size: 1.1rem;
}

.message-date {
    color: #6b7280;
    font-size: 0.9rem;
}

.message-meta {
    display: flex;
    gap: 10px;
    align-items: center;
}

.course-badge {
    background: #e0e7ff;
    color: #3730a3;
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 0.8rem;
    font-weight: 600;
}

.priority-badge {
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 0.8rem;
    font-weight: 600;
}

.priority-urgent {
    background: #fef2f2;
    color: #dc2626;
}

.priority-high {
    background: #fffbeb;
    color: #d97706;
}

.priority-medium {
    background: #eff6ff;
    color: #2563eb;
}

.priority-low {
    background: #f3f4f6;
    color: #6b7280;
}

.type-badge {
    background: #f0fdf4;
    color: #059669;
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 0.8rem;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 5px;
}

.message-content {
    margin-bottom: 20px;
}

.message-subject {
    margin: 0 0 10px 0;
    color: #1f2937;
    font-size: 1.1rem;
}

.message-text {
    color: #6b7280;
    line-height: 1.6;
    margin: 0;
}

.message-actions {
    display: flex;
    gap: 10px;
    align-items: center;
}

.empty-state {
    text-align: center;
    padding: 60px 20px;
    background: white;
    border-radius: 15px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

.empty-state i {
    font-size: 4rem;
    color: #d1d5db;
    margin-bottom: 20px;
}

.empty-state h3 {
    color: #374151;
    margin-bottom: 10px;
}

.empty-state p {
    color: #6b7280;
    margin-bottom: 30px;
}

.pagination-wrapper {
    margin-top: 30px;
    display: flex;
    justify-content: center;
}

@media (max-width: 768px) {
    .messages-container {
        padding: 15px;
    }
    
    .page-header {
        flex-direction: column;
        gap: 20px;
        text-align: center;
    }
    
    .message-header {
        flex-direction: column;
        gap: 15px;
    }
    
    .message-meta {
        flex-wrap: wrap;
    }
    
    .message-actions {
        flex-wrap: wrap;
    }
}
</style>

<script>
function markAsRead(messageId) {
    if (confirm('هل تريد تحديد هذه الرسالة كمقروءة؟')) {
        fetch(`/messages/${messageId}/status`, {
            method: 'PATCH',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                status: 'read'
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('حدث خطأ أثناء تحديث حالة الرسالة');
        });
    }
}

function deleteMessage(messageId) {
    if (confirm('هل تريد حذف هذه الرسالة؟')) {
        fetch(`/messages/${messageId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            }
        })
        .then(response => {
            if (response.ok) {
                location.reload();
            } else {
                alert('حدث خطأ أثناء حذف الرسالة');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('حدث خطأ أثناء حذف الرسالة');
        });
    }
}
</script>
@endsection 