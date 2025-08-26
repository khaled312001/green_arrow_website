<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'status',
        'admin_notes',
        'read_at',
        'replied_at'
    ];

    protected $casts = [
        'read_at' => 'datetime',
        'replied_at' => 'datetime',
    ];

    /**
     * الحصول على حالة الرسالة بالعربية
     */
    public function getStatusTextAttribute(): string
    {
        return match($this->status) {
            'new' => 'جديد',
            'read' => 'مقروء',
            'replied' => 'تم الرد',
            'closed' => 'مغلق',
            default => 'غير محدد'
        };
    }

    /**
     * الحصول على لون حالة الرسالة
     */
    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'new' => 'danger',
            'read' => 'warning',
            'replied' => 'success',
            'closed' => 'secondary',
            default => 'light'
        };
    }

    /**
     * تحديد الرسالة كمقروءة
     */
    public function markAsRead(): void
    {
        $this->update([
            'status' => 'read',
            'read_at' => now()
        ]);
    }

    /**
     * تحديد الرسالة كتم الرد عليها
     */
    public function markAsReplied(): void
    {
        $this->update([
            'status' => 'replied',
            'replied_at' => now()
        ]);
    }

    /**
     * تحديد الرسالة كمغلقة
     */
    public function markAsClosed(): void
    {
        $this->update([
            'status' => 'closed'
        ]);
    }
}
