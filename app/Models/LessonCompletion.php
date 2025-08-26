<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LessonCompletion extends Model
{
    use HasFactory;

    protected $fillable = [
        'enrollment_id',
        'lesson_id',
        'user_id',
        'completed_at',
        'time_spent_minutes',
        'progress_percentage',
        'quiz_results'
    ];

    protected $casts = [
        'completed_at' => 'datetime',
        'quiz_results' => 'array',
        'progress_percentage' => 'decimal:2'
    ];

    /**
     * التسجيل المرتبط
     */
    public function enrollment(): BelongsTo
    {
        return $this->belongsTo(Enrollment::class);
    }

    /**
     * الدرس المكتمل
     */
    public function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }

    /**
     * المستخدم الذي أكمل الدرس
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * التحقق من اكتمال درس معين لتسجيل معين
     */
    public static function isLessonCompleted(int $enrollmentId, int $lessonId): bool
    {
        return static::where('enrollment_id', $enrollmentId)
                    ->where('lesson_id', $lessonId)
                    ->exists();
    }

    /**
     * الحصول على عدد الدروس المكتملة لتسجيل معين
     */
    public static function getCompletedLessonsCount(int $enrollmentId): int
    {
        return static::where('enrollment_id', $enrollmentId)->count();
    }

    /**
     * الحصول على قائمة الدروس المكتملة لتسجيل معين
     */
    public static function getCompletedLessons(int $enrollmentId): array
    {
        return static::where('enrollment_id', $enrollmentId)
                    ->pluck('lesson_id')
                    ->toArray();
    }
}
