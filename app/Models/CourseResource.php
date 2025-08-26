<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseResource extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'lesson_id',
        'title_ar',
        'title_en',
        'description_ar',
        'description_en',
        'type',
        'file_path',
        'file_name',
        'file_size',
        'external_url',
        'is_free',
        'is_published',
        'sort_order',
        'download_count'
    ];

    protected $casts = [
        'is_free' => 'boolean',
        'is_published' => 'boolean',
    ];

    // العلاقات
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    // الوظائف المساعدة
    public function getTitleAttribute()
    {
        return app()->getLocale() === 'ar' ? $this->title_ar : ($this->title_en ?? $this->title_ar);
    }

    public function getDescriptionAttribute()
    {
        return app()->getLocale() === 'ar' ? $this->description_ar : ($this->description_en ?? $this->description_ar);
    }

    public function getTypeIconAttribute()
    {
        return [
            'pdf' => 'bi-file-pdf',
            'video' => 'bi-play-circle',
            'link' => 'bi-link-45deg',
            'document' => 'bi-file-earmark-text',
            'image' => 'bi-image',
            'audio' => 'bi-music-note'
        ][$this->type] ?? 'bi-file-earmark';
    }

    public function getTypeLabelAttribute()
    {
        return [
            'pdf' => 'ملف PDF',
            'video' => 'فيديو',
            'link' => 'رابط خارجي',
            'document' => 'مستند',
            'image' => 'صورة',
            'audio' => 'ملف صوتي'
        ][$this->type] ?? 'ملف';
    }

    public function getTypeColorAttribute()
    {
        return [
            'pdf' => 'text-red-500',
            'video' => 'text-blue-500',
            'link' => 'text-green-500',
            'document' => 'text-purple-500',
            'image' => 'text-pink-500',
            'audio' => 'text-orange-500'
        ][$this->type] ?? 'text-gray-500';
    }

    public function getFileUrlAttribute()
    {
        if ($this->external_url) {
            return $this->external_url;
        }
        
        if ($this->file_path) {
            return asset('storage/' . $this->file_path);
        }
        
        return null;
    }

    public function incrementDownloadCount()
    {
        $this->increment('download_count');
    }

    public function getFormattedFileSizeAttribute()
    {
        if (!$this->file_size) {
            return 'غير محدد';
        }

        $size = (int) $this->file_size;
        $units = ['B', 'KB', 'MB', 'GB'];
        
        for ($i = 0; $size > 1024 && $i < count($units) - 1; $i++) {
            $size /= 1024;
        }
        
        return round($size, 2) . ' ' . $units[$i];
    }

    // Scopes للاستعلامات
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function scopeByCourse($query, $courseId)
    {
        return $query->where('course_id', $courseId);
    }

    public function scopeByLesson($query, $lessonId)
    {
        return $query->where('lesson_id', $lessonId);
    }

    public function scopeFree($query)
    {
        return $query->where('is_free', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('created_at');
    }
}
