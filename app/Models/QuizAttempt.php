<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuizAttempt extends Model
{
    use HasFactory;

    protected $fillable = [
        'quiz_id',
        'user_id',
        'attempt_number',
        'started_at',
        'completed_at',
        'score',
        'total_points',
        'percentage',
        'is_passed',
        'answers',
        'notes',
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
        'answers' => 'array',
        'is_passed' => 'boolean',
    ];

    /**
     * الكويز المرتبط بالمحاولة
     */
    public function quiz(): BelongsTo
    {
        return $this->belongsTo(Quiz::class);
    }

    /**
     * المستخدم الذي قام بالمحاولة
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * التحقق من اكتمال المحاولة
     */
    public function isCompleted(): bool
    {
        return $this->completed_at !== null;
    }

    /**
     * حساب النسبة المئوية
     */
    public function calculatePercentage(): float
    {
        if ($this->total_points === 0) {
            return 0;
        }
        
        return round(($this->score / $this->total_points) * 100, 2);
    }

    /**
     * التحقق من النجاح
     */
    public function checkPassing(): bool
    {
        return $this->percentage >= $this->quiz->passing_score;
    }
}
