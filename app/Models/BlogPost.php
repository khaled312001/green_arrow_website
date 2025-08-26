<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class BlogPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'author_id', 'title_ar', 'title_en', 'slug', 'excerpt_ar', 'excerpt_en',
        'content_ar', 'content_en', 'featured_image', 'gallery', 'category', 'tags',
        'status', 'is_featured', 'comments_enabled', 'published_at',
        'meta_title_ar', 'meta_title_en', 'meta_description_ar', 'meta_description_en',
        'meta_keywords_ar', 'meta_keywords_en', 'reading_time'
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'gallery' => 'array',
        'tags' => 'array',
        'is_featured' => 'boolean',
        'comments_enabled' => 'boolean',
        'reading_time' => 'decimal:1',
    ];

    /**
     * الكاتب
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * الحصول على العنوان باللغة المناسبة
     */
    public function getTitleAttribute(): string
    {
        return app()->getLocale() === 'ar' ? $this->title_ar : ($this->title_en ?? $this->title_ar);
    }

    /**
     * الحصول على المقتطف باللغة المناسبة
     */
    public function getExcerptAttribute(): string
    {
        return app()->getLocale() === 'ar' ? $this->excerpt_ar : ($this->excerpt_en ?? $this->excerpt_ar);
    }

    /**
     * الحصول على المحتوى باللغة المناسبة
     */
    public function getContentAttribute(): string
    {
        return app()->getLocale() === 'ar' ? $this->content_ar : ($this->content_en ?? $this->content_ar);
    }

    /**
     * إنشاء slug تلقائياً عند الإنشاء
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            if (empty($post->slug)) {
                $post->slug = Str::slug($post->title_ar);
            }
        });

        static::updating(function ($post) {
            if ($post->isDirty('title_ar') && empty($post->slug)) {
                $post->slug = Str::slug($post->title_ar);
            }
        });
    }

    /**
     * المقالات المنشورة فقط
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    /**
     * المقالات المميزة
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * ترتيب حسب تاريخ النشر
     */
    public function scopeLatest($query)
    {
        return $query->orderByDesc('published_at');
    }
}
