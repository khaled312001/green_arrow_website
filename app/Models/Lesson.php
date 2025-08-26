<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id', 'title_ar', 'title_en', 'slug', 'description_ar', 'description_en',
        'type', 'video_url', 'video_duration', 'pdf_file', 'text_content', 'attachments',
        'live_session_date', 'google_meet_link', 'meeting_id', 'meeting_password',
        'is_free', 'is_published', 'sort_order', 'duration_minutes'
    ];

    protected $casts = [
        'live_session_date' => 'datetime',
        'attachments' => 'array',
        'is_free' => 'boolean',
        'is_published' => 'boolean',
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * الكويزات المرتبطة بالدرس
     */
    public function quizzes(): HasMany
    {
        return $this->hasMany(Quiz::class);
    }

    public function getTitleAttribute(): string
    {
        return app()->getLocale() === 'ar' ? $this->title_ar : ($this->title_en ?? $this->title_ar);
    }

    public function getDescriptionAttribute(): string
    {
        return app()->getLocale() === 'ar' ? $this->description_ar : ($this->description_en ?? $this->description_ar);
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($lesson) {
            if (empty($lesson->slug)) {
                $lesson->slug = Str::slug($lesson->title_ar);
            }
        });
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }

    /**
     * الحصول على نوع الدرس بالعربية
     */
    public function getTypeTextAttribute(): string
    {
        return match($this->type) {
            'video' => 'فيديو',
            'pdf' => 'ملف PDF',
            'text' => 'نص',
            'quiz' => 'اختبار',
            'assignment' => 'واجب',
            'live_session' => 'محاضرة مباشرة',
            default => $this->type
        };
    }

    /**
     * التحقق من أن الدرس مجاني
     */
    public function isFree(): bool
    {
        return $this->is_free || $this->course->is_free;
    }
}
