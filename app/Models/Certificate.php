<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Certificate extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'course_id', 
        'enrollment_id',
        'certificate_number',
        'issued_at',
        'pdf_path',
        'verification_code',
        'is_verified',
        'notes'
    ];

    protected $casts = [
        'issued_at' => 'datetime',
        'is_verified' => 'boolean',
    ];

    /**
     * الطالب الحاصل على الشهادة
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * الدورة المرتبطة بالشهادة
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * التسجيل المرتبط بالشهادة
     */
    public function enrollment(): BelongsTo
    {
        return $this->belongsTo(Enrollment::class);
    }

    /**
     * الحصول على رابط تحميل الشهادة
     */
    public function getDownloadUrlAttribute(): string
    {
        return route('student.certificates.download', $this);
    }

    /**
     * الحصول على رابط التحقق من الشهادة
     */
    public function getVerificationUrlAttribute(): string
    {
        return route('certificates.verify', $this->certificate_number);
    }

    /**
     * إنشاء رمز التحقق
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($certificate) {
            if (empty($certificate->verification_code)) {
                $certificate->verification_code = strtoupper(substr(md5(uniqid()), 0, 8));
            }
        });
    }
}
