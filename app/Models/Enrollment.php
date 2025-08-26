<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Enrollment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'course_id', 'payment_id', 'status', 'enrolled_at',
        'expires_at', 'completed_at', 'activated_at', 'progress_percentage', 'lessons_completed',
        'total_lessons', 'quiz_attempts', 'quiz_average', 'live_sessions_attended',
        'total_live_sessions', 'rating', 'review', 'reviewed_at',
        'certificate_issued', 'certificate_issued_at', 'certificate_number',
        'last_accessed_at', 'last_lesson_id'
    ];

    protected $casts = [
        'enrolled_at' => 'datetime',
        'expires_at' => 'datetime',
        'completed_at' => 'datetime',
        'activated_at' => 'datetime',
        'reviewed_at' => 'datetime',
        'certificate_issued_at' => 'datetime',
        'last_accessed_at' => 'datetime',
        'certificate_issued' => 'boolean',
        'progress_percentage' => 'integer',
        'quiz_average' => 'decimal:2',
    ];

    /**
     * الطالب المسجل
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * الدورة المسجل بها
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * الدفعة المرتبطة
     */
    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class);
    }

    /**
     * آخر درس تم الوصول إليه
     */
    public function lastLesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class, 'last_lesson_id');
    }

    /**
     * الدروس المكتملة
     */
    public function completedLessons()
    {
        return $this->hasMany(LessonCompletion::class);
    }

    /**
     * الحصول على حالة التسجيل بالعربية
     */
    public function getStatusTextAttribute(): string
    {
        return match($this->status) {
            'pending' => 'في الانتظار',
            'active' => 'نشط',
            'completed' => 'مكتمل',
            'cancelled' => 'ملغي',
            'expired' => 'منتهي الصلاحية',
            default => $this->status
        };
    }

    /**
     * التحقق من إمكانية الوصول للدورة
     */
    public function canAccess(): bool
    {
        return in_array($this->status, ['active', 'completed']) &&
               (!$this->expires_at || $this->expires_at->isFuture());
    }

    /**
     * التحقق من اكتمال الدورة
     */
    public function isCompleted(): bool
    {
        return $this->status === 'completed' || $this->progress_percentage >= 100;
    }

    /**
     * حساب نسبة التقدم
     */
    public function calculateProgress(): int
    {
        if ($this->total_lessons === 0) {
            return 0;
        }

        return min(100, round(($this->lessons_completed / $this->total_lessons) * 100));
    }

    /**
     * التحقق من انتهاء الصلاحية
     */
    public function isExpired(): bool
    {
        return $this->expires_at && $this->expires_at->isPast();
    }

    /**
     * الحصول على الوقت المتبقي
     */
    public function getRemainingTimeAttribute(): ?string
    {
        if (!$this->expires_at) {
            return null;
        }

        if ($this->expires_at->isPast()) {
            return 'منتهي الصلاحية';
        }

        return $this->expires_at->diffForHumans();
    }

    /**
     * التسجيلات النشطة فقط
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * التسجيلات المكتملة فقط
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    /**
     * التسجيلات في الانتظار
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * التسجيلات المنتهية الصلاحية
     */
    public function scopeExpired($query)
    {
        return $query->where('expires_at', '<', now());
    }

    /**
     * التحقق من اكتمال درس معين
     */
    public function isLessonCompleted($lessonId): bool
    {
        // استخدام الجدول الجديد لتتبع اكتمال الدروس
        return LessonCompletion::isLessonCompleted($this->id, $lessonId);
    }

    /**
     * الحصول على قائمة الدروس المكتملة
     */
    public function getCompletedLessonsAttribute(): array
    {
        return LessonCompletion::getCompletedLessons($this->id);
    }

    /**
     * الحصول على عدد الدروس المكتملة
     */
    public function getCompletedLessonsCountAttribute(): int
    {
        return LessonCompletion::getCompletedLessonsCount($this->id);
    }
}
