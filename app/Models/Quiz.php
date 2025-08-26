<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'lesson_id',
        'title_ar',
        'title_en',
        'description_ar',
        'description_en',
        'duration_minutes',
        'passing_score',
        'is_active',
        'allow_retake',
        'max_attempts',
        'show_results',
        'randomize_questions',
        'due_date',
        'total_questions',
        'total_points',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'allow_retake' => 'boolean',
        'show_results' => 'boolean',
        'randomize_questions' => 'boolean',
        'due_date' => 'datetime',
    ];

    /**
     * الدورة التي ينتمي إليها الاختبار
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * الدرس الذي ينتمي إليه الاختبار
     */
    public function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }

    /**
     * أسئلة الاختبار
     */
    public function questions(): HasMany
    {
        return $this->hasMany(QuizQuestion::class)->ordered();
    }

    /**
     * محاولات الاختبار
     */
    public function attempts(): HasMany
    {
        return $this->hasMany(QuizAttempt::class);
    }

    /**
     * نطاق الاختبارات النشطة
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * نطاق الاختبارات حسب الدورة
     */
    public function scopeForCourse($query, $courseId)
    {
        return $query->where('course_id', $courseId);
    }

    /**
     * نطاق الاختبارات حسب الدرس
     */
    public function scopeForLesson($query, $lessonId)
    {
        return $query->where('lesson_id', $lessonId);
    }

    /**
     * الحصول على العنوان باللغة المناسبة
     */
    public function getTitleAttribute(): string
    {
        return app()->getLocale() === 'ar' ? $this->title_ar : ($this->title_en ?? $this->title_ar);
    }

    /**
     * الحصول على الوصف باللغة المناسبة
     */
    public function getDescriptionAttribute(): string
    {
        return app()->getLocale() === 'ar' ? $this->description_ar : ($this->description_en ?? $this->description_ar);
    }

    /**
     * حساب إجمالي النقاط
     */
    public function calculateTotalPoints(): int
    {
        return $this->questions()->active()->sum('points');
    }

    /**
     * حساب إجمالي الأسئلة
     */
    public function calculateTotalQuestions(): int
    {
        return $this->questions()->active()->count();
    }

    /**
     * التحقق من إمكانية إعادة المحاولة
     */
    public function canRetake(User $user): bool
    {
        if (!$this->allow_retake) {
            return false;
        }

        $attemptsCount = $this->attempts()->where('user_id', $user->id)->count();
        return $attemptsCount < $this->max_attempts;
    }

    /**
     * الحصول على أفضل محاولة للمستخدم
     */
    public function getBestAttempt(User $user): ?QuizAttempt
    {
        return $this->attempts()
            ->where('user_id', $user->id)
            ->orderByDesc('percentage')
            ->first();
    }
} 