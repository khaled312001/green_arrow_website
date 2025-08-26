<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuizQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'quiz_id',
        'question_ar',
        'question_en',
        'type',
        'options',
        'correct_answer',
        'explanation_ar',
        'explanation_en',
        'points',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'options' => 'array',
        'is_active' => 'boolean',
    ];

    /**
     * الكويز الذي ينتمي إليه السؤال
     */
    public function quiz(): BelongsTo
    {
        return $this->belongsTo(Quiz::class);
    }

    /**
     * الحصول على السؤال باللغة المناسبة
     */
    public function getQuestionAttribute(): string
    {
        return app()->getLocale() === 'ar' ? $this->question_ar : ($this->question_en ?? $this->question_ar);
    }

    /**
     * الحصول على الشرح باللغة المناسبة
     */
    public function getExplanationAttribute(): string
    {
        return app()->getLocale() === 'ar' ? $this->explanation_ar : ($this->explanation_en ?? $this->explanation_ar);
    }

    /**
     * نطاق الأسئلة النشطة
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * نطاق الأسئلة المرتبة
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }
}
