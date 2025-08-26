<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'course_id',
        'subject',
        'content',
        'type',
        'priority',
        'status',
        'parent_id',
        'read_at'
    ];

    protected $casts = [
        'read_at' => 'datetime',
    ];

    // العلاقات
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function parent()
    {
        return $this->belongsTo(Message::class, 'parent_id');
    }

    public function replies()
    {
        return $this->hasMany(Message::class, 'parent_id');
    }

    // الوظائف المساعدة
    public function markAsRead()
    {
        $this->update([
            'status' => 'read',
            'read_at' => now()
        ]);
    }

    public function markAsReplied()
    {
        $this->update(['status' => 'replied']);
    }

    public function isUnread()
    {
        return $this->status === 'unread';
    }

    public function isReplied()
    {
        return $this->status === 'replied';
    }

    public function getPriorityColorAttribute()
    {
        return [
            'low' => 'text-gray-500',
            'medium' => 'text-blue-500',
            'high' => 'text-orange-500',
            'urgent' => 'text-red-500'
        ][$this->priority] ?? 'text-gray-500';
    }

    public function getTypeIconAttribute()
    {
        return [
            'general' => 'bi-chat-dots',
            'course_question' => 'bi-question-circle',
            'technical_support' => 'bi-tools',
            'feedback' => 'bi-star'
        ][$this->type] ?? 'bi-chat-dots';
    }

    public function getTypeLabelAttribute()
    {
        return [
            'general' => 'رسالة عامة',
            'course_question' => 'سؤال عن الدورة',
            'technical_support' => 'دعم فني',
            'feedback' => 'تقييم وملاحظات'
        ][$this->type] ?? 'رسالة عامة';
    }

    // Scopes للاستعلامات
    public function scopeUnread($query)
    {
        return $query->where('status', 'unread');
    }

    public function scopeByCourse($query, $courseId)
    {
        return $query->where('course_id', $courseId);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function scopeByPriority($query, $priority)
    {
        return $query->where('priority', $priority);
    }

    public function scopeForUser($query, $userId)
    {
        return $query->where(function($q) use ($userId) {
            $q->where('sender_id', $userId)
              ->orWhere('receiver_id', $userId);
        });
    }

    public function scopeInbox($query, $userId)
    {
        return $query->where('receiver_id', $userId);
    }

    public function scopeSent($query, $userId)
    {
        return $query->where('sender_id', $userId);
    }
}
