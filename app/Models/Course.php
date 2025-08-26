<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_ar',
        'title_en',
        'slug',
        'description_ar',
        'description_en',
        'objectives_ar',
        'objectives_en',
        'requirements_ar',
        'requirements_en',
        'category_id',
        'instructor_id',
        'price',
        'discount_price',
        'is_free',
        'start_date',
        'end_date',
        'duration_hours',
        'max_students',
        'thumbnail',
        'banner',
        'intro_video',
        'level',
        'type',
        'status',
        'is_featured',
        'certificate_enabled',
        'meta_title_ar',
        'meta_title_en',
        'meta_description_ar',
        'meta_description_en',
        'meta_keywords_ar',
        'meta_keywords_en',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'price' => 'decimal:2',
        'discount_price' => 'decimal:2',
        'is_free' => 'boolean',
        'is_featured' => 'boolean',
        'certificate_enabled' => 'boolean',
        'rating' => 'decimal:1',
    ];

    /**
     * القسم التابع له الدورة
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * المدرس المسؤول عن الدورة
     */
    public function instructor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }

    /**
     * الدروس الخاصة بالدورة
     */
    public function lessons(): HasMany
    {
        return $this->hasMany(Lesson::class)->orderBy('sort_order');
    }

    /**
     * تسجيلات الطلاب في الدورة
     */
    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class);
    }

    /**
     * الطلاب المسجلين في الدورة
     */
    public function students(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'enrollments')
            ->withPivot(['status', 'enrolled_at', 'progress_percentage', 'completed_at'])
            ->withTimestamps();
    }

    /**
     * المدفوعات المرتبطة بالدورة
     */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * الشهادات الصادرة للدورة
     */
    public function certificates(): HasMany
    {
        return $this->hasMany(Certificate::class);
    }

    /**
     * الكويزات المرتبطة بالدورة
     */
    public function quizzes(): HasMany
    {
        return $this->hasMany(Quiz::class);
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
     * الحصول على الأهداف باللغة المناسبة
     */
    public function getObjectivesAttribute(): string
    {
        return app()->getLocale() === 'ar' ? $this->objectives_ar : ($this->objectives_en ?? $this->objectives_ar);
    }

    /**
     * الحصول على المتطلبات باللغة المناسبة
     */
    public function getRequirementsAttribute(): string
    {
        return app()->getLocale() === 'ar' ? $this->requirements_ar : ($this->requirements_en ?? $this->requirements_ar);
    }

    /**
     * الحصول على السعر النهائي (بعد الخصم إن وجد)
     */
    public function getFinalPriceAttribute(): float
    {
        return $this->discount_price ?? $this->price;
    }

    /**
     * التحقق من وجود خصم
     */
    public function hasDiscount(): bool
    {
        return $this->discount_price !== null && $this->discount_price < $this->price;
    }

    /**
     * حساب نسبة الخصم
     */
    public function getDiscountPercentageAttribute(): int
    {
        if (!$this->hasDiscount()) {
            return 0;
        }

        return round((($this->price - $this->discount_price) / $this->price) * 100);
    }

    /**
     * الحصول على رابط الصورة المصغرة
     */
    public function getThumbnailUrlAttribute(): string
    {
        return $this->thumbnail ? asset('storage/' . $this->thumbnail) : asset('images/default-course.jpg');
    }

    /**
     * الحصول على رابط البانر
     */
    public function getBannerUrlAttribute(): string
    {
        return $this->banner ? asset('storage/' . $this->banner) : $this->thumbnail_url;
    }

    /**
     * الحصول على رابط الصورة المميزة
     */
    public function getFeaturedImageAttribute(): string
    {
        return $this->banner ? asset('storage/' . $this->banner) : $this->thumbnail_url;
    }

    /**
     * الحصول على عدد الطلاب المسجلين
     */
    public function getStudentsCountAttribute(): int
    {
        return $this->enrollments()->count();
    }

    /**
     * الحصول على عدد التقييمات
     */
    public function getReviewsCountAttribute(): int
    {
        // TODO: Implement reviews relationship when reviews functionality is added
        return 0;
    }

    /**
     * التحقق من إمكانية التسجيل في الدورة
     */
    public function canEnroll(): bool
    {
        return $this->status === 'published' && 
               $this->enrolled_count < $this->max_students &&
               (!$this->end_date || $this->end_date->isFuture());
    }

    /**
     * الحصول على عدد الأماكن المتاحة
     */
    public function getAvailableSpotsAttribute(): int
    {
        return max(0, $this->max_students - $this->enrolled_count);
    }

    /**
     * التحقق من امتلاء الدورة
     */
    public function isFull(): bool
    {
        return $this->enrolled_count >= $this->max_students;
    }

    /**
     * إنشاء slug تلقائياً عند الإنشاء
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($course) {
            if (empty($course->slug)) {
                $course->slug = Str::slug($course->title_ar);
            }
        });

        static::updating(function ($course) {
            if ($course->isDirty('title_ar') && empty($course->slug)) {
                $course->slug = Str::slug($course->title_ar);
            }
        });
    }

    /**
     * الدورات المنشورة فقط
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    /**
     * الدورات المميزة
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * الدورات المجانية
     */
    public function scopeFree($query)
    {
        return $query->where('is_free', true);
    }

    /**
     * الدورات المدفوعة
     */
    public function scopePaid($query)
    {
        return $query->where('is_free', false);
    }

    /**
     * البحث في الدورات
     */
    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('title_ar', 'like', "%{$search}%")
              ->orWhere('title_en', 'like', "%{$search}%")
              ->orWhere('description_ar', 'like', "%{$search}%")
              ->orWhere('description_en', 'like', "%{$search}%");
        });
    }

    /**
     * ترتيب حسب الشعبية
     */
    public function scopePopular($query)
    {
        return $query->orderByDesc('enrolled_count')->orderByDesc('rating');
    }

    /**
     * ترتيب حسب التقييم
     */
    public function scopeTopRated($query)
    {
        return $query->orderByDesc('rating')->orderByDesc('reviews_count');
    }

    /**
     * ترتيب حسب الأحدث
     */
    public function scopeLatest($query)
    {
        return $query->orderByDesc('created_at');
    }
}
