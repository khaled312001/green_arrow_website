@extends('layouts.teacher')

@section('title', 'إضافة درس جديد')

@section('content')
<div class="dashboard-container">
    <!-- Page Header -->
    <div class="page-header">
        <div>
            <h1 style="font-size: 2rem; color: #1f2937; margin-bottom: 5px;">إضافة درس جديد</h1>
            <p style="color: #6b7280; margin: 0;">إضافة درس جديد إلى دورة "{{ $course->title_ar }}"</p>
        </div>
        <div style="display: flex; gap: 15px;">
            <a href="{{ route('teacher.courses.lessons.index', $course) }}" class="btn btn-outline">
                <i class="bi bi-arrow-left"></i>
                العودة للدروس
            </a>
        </div>
    </div>

    <div style="background: white; padding: 30px; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
        <form method="POST" action="{{ route('teacher.courses.lessons.store', $course) }}" enctype="multipart/form-data">
            @csrf
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px;">
                <!-- Basic Information -->
                <div>
                    <h2 style="font-size: 1.3rem; color: #1f2937; margin-bottom: 20px;">المعلومات الأساسية</h2>
                    
                    <div style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">عنوان الدرس (عربي)</label>
                        <input type="text" name="title_ar" value="{{ old('title_ar') }}" required
                               style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 1rem;">
                        @error('title_ar')
                            <span style="color: #ef4444; font-size: 0.9rem;">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">عنوان الدرس (إنجليزي)</label>
                        <input type="text" name="title_en" value="{{ old('title_en') }}" required
                               style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 1rem;">
                        @error('title_en')
                            <span style="color: #ef4444; font-size: 0.9rem;">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">ترتيب الدرس</label>
                        <input type="number" name="order" value="{{ old('order', $course->lessons->count() + 1) }}" min="1" required
                               style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 1rem;">
                        @error('order')
                            <span style="color: #ef4444; font-size: 0.9rem;">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">مدة الدرس (دقائق)</label>
                        <input type="number" name="duration" value="{{ old('duration') }}" min="1" required
                               style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 1rem;">
                        @error('duration')
                            <span style="color: #ef4444; font-size: 0.9rem;">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">نوع المحتوى</label>
                        <select name="content_type" id="content_type" style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 1rem;">
                            <option value="video" {{ old('content_type') == 'video' ? 'selected' : '' }}>فيديو</option>
                            <option value="text" {{ old('content_type') == 'text' ? 'selected' : '' }}>نص</option>
                            <option value="file" {{ old('content_type') == 'file' ? 'selected' : '' }}>ملف</option>
                            <option value="link" {{ old('content_type') == 'link' ? 'selected' : '' }}>رابط</option>
                        </select>
                        @error('content_type')
                            <span style="color: #ef4444; font-size: 0.9rem;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                
                <!-- Content -->
                <div>
                    <h2 style="font-size: 1.3rem; color: #1f2937; margin-bottom: 20px;">محتوى الدرس</h2>
                    
                    <div style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">وصف الدرس (عربي)</label>
                        <textarea name="description_ar" rows="4" 
                                  style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 1rem; resize: vertical;">{{ old('description_ar') }}</textarea>
                        @error('description_ar')
                            <span style="color: #ef4444; font-size: 0.9rem;">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">وصف الدرس (إنجليزي)</label>
                        <textarea name="description_en" rows="4" 
                                  style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 1rem; resize: vertical;">{{ old('description_en') }}</textarea>
                        @error('description_en')
                            <span style="color: #ef4444; font-size: 0.9rem;">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <!-- Content Fields (Dynamic) -->
                    <div id="content_fields">
                        <!-- Video Content -->
                        <div id="video_content" class="content-field" style="display: none;">
                            <div style="margin-bottom: 20px;">
                                <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">رابط الفيديو</label>
                                <input type="url" name="video_url" value="{{ old('video_url') }}" 
                                       placeholder="https://www.youtube.com/watch?v=..."
                                       style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 1rem;">
                                @error('video_url')
                                    <span style="color: #ef4444; font-size: 0.9rem;">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div style="margin-bottom: 20px;">
                                <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">ملف الفيديو</label>
                                <input type="file" name="video_file" accept="video/*" 
                                       style="width: 100%; padding: 8px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 0.9rem;">
                                @error('video_file')
                                    <span style="color: #ef4444; font-size: 0.9rem;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Text Content -->
                        <div id="text_content" class="content-field" style="display: none;">
                            <div style="margin-bottom: 20px;">
                                <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">محتوى النص (عربي)</label>
                                <textarea name="text_content_ar" rows="6" 
                                          style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 1rem; resize: vertical;">{{ old('text_content_ar') }}</textarea>
                                @error('text_content_ar')
                                    <span style="color: #ef4444; font-size: 0.9rem;">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div style="margin-bottom: 20px;">
                                <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">محتوى النص (إنجليزي)</label>
                                <textarea name="text_content_en" rows="6" 
                                          style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 1rem; resize: vertical;">{{ old('text_content_en') }}</textarea>
                                @error('text_content_en')
                                    <span style="color: #ef4444; font-size: 0.9rem;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- File Content -->
                        <div id="file_content" class="content-field" style="display: none;">
                            <div style="margin-bottom: 20px;">
                                <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">ملف الدرس</label>
                                <input type="file" name="lesson_file" 
                                       style="width: 100%; padding: 8px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 0.9rem;">
                                @error('lesson_file')
                                    <span style="color: #ef4444; font-size: 0.9rem;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Link Content -->
                        <div id="link_content" class="content-field" style="display: none;">
                            <div style="margin-bottom: 20px;">
                                <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">رابط الدرس</label>
                                <input type="url" name="lesson_link" value="{{ old('lesson_link') }}" 
                                       placeholder="https://example.com"
                                       style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 1rem;">
                                @error('lesson_link')
                                    <span style="color: #ef4444; font-size: 0.9rem;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div style="margin-bottom: 20px;">
                        <label style="display: flex; align-items: center; gap: 8px; color: #374151; font-weight: 500;">
                            <input type="checkbox" name="is_free" value="1" {{ old('is_free') ? 'checked' : '' }}>
                            درس مجاني
                        </label>
                    </div>
                </div>
            </div>
            
            <!-- Submit Buttons -->
            <div style="display: flex; gap: 15px; margin-top: 30px; padding-top: 20px; border-top: 1px solid #e5e7eb;">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i>
                    إضافة الدرس
                </button>
                <a href="{{ route('teacher.courses.lessons.index', $course) }}" class="btn btn-outline">
                    <i class="bi bi-x-circle"></i>
                    إلغاء
                </a>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const contentTypeSelect = document.getElementById('content_type');
    const contentFields = document.querySelectorAll('.content-field');
    
    function showContentField() {
        const selectedType = contentTypeSelect.value;
        
        // Hide all content fields
        contentFields.forEach(field => {
            field.style.display = 'none';
        });
        
        // Show selected content field
        const selectedField = document.getElementById(selectedType + '_content');
        if (selectedField) {
            selectedField.style.display = 'block';
        }
    }
    
    // Show initial content field
    showContentField();
    
    // Listen for changes
    contentTypeSelect.addEventListener('change', showContentField);
});
</script>
@endsection 