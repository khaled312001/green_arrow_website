@extends('layouts.teacher')

@section('title', 'تعديل الدورة')

@section('content')
<div class="dashboard-container">
    <!-- Page Header -->
    <div class="page-header">
        <div>
            <h1 style="font-size: 2rem; color: #1f2937; margin-bottom: 5px;">تعديل الدورة</h1>
            <p style="color: #6b7280; margin: 0;">تحديث معلومات الدورة والمحتوى</p>
        </div>
        <div style="display: flex; gap: 15px;">
            <a href="{{ route('teacher.courses.index') }}" class="btn btn-outline">
                <i class="bi bi-arrow-left"></i>
                العودة للدورات
            </a>
        </div>
    </div>

    <div style="background: white; padding: 30px; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
        <form method="POST" action="{{ route('teacher.courses.update', $course) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px;">
                <!-- Basic Information -->
                <div>
                    <h2 style="font-size: 1.3rem; color: #1f2937; margin-bottom: 20px;">المعلومات الأساسية</h2>
                    
                    <div style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">عنوان الدورة (عربي)</label>
                        <input type="text" name="title_ar" value="{{ old('title_ar', $course->title_ar) }}" 
                               style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 1rem;">
                        @error('title_ar')
                            <span style="color: #ef4444; font-size: 0.9rem;">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">عنوان الدورة (إنجليزي)</label>
                        <input type="text" name="title_en" value="{{ old('title_en', $course->title_en) }}" 
                               style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 1rem;">
                        @error('title_en')
                            <span style="color: #ef4444; font-size: 0.9rem;">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">القسم</label>
                        <select name="category_id" style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 1rem;">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $course->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name_ar }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <span style="color: #ef4444; font-size: 0.9rem;">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">المستوى</label>
                        <select name="level" style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 1rem;">
                            <option value="beginner" {{ old('level', $course->level) == 'beginner' ? 'selected' : '' }}>مبتدئ</option>
                            <option value="intermediate" {{ old('level', $course->level) == 'intermediate' ? 'selected' : '' }}>متوسط</option>
                            <option value="advanced" {{ old('level', $course->level) == 'advanced' ? 'selected' : '' }}>متقدم</option>
                        </select>
                        @error('level')
                            <span style="color: #ef4444; font-size: 0.9rem;">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">المدة (بالساعات)</label>
                        <input type="number" name="duration" value="{{ old('duration', $course->duration) }}" min="1" 
                               style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 1rem;">
                        @error('duration')
                            <span style="color: #ef4444; font-size: 0.9rem;">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">السعر (ريال)</label>
                        <input type="number" name="price" value="{{ old('price', $course->price) }}" min="0" step="0.01" 
                               style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 1rem;">
                        @error('price')
                            <span style="color: #ef4444; font-size: 0.9rem;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                
                <!-- Additional Information -->
                <div>
                    <h2 style="font-size: 1.3rem; color: #1f2937; margin-bottom: 20px;">معلومات إضافية</h2>
                    
                    <div style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">الوصف (عربي)</label>
                        <textarea name="description_ar" rows="4" 
                                  style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 1rem; resize: vertical;">{{ old('description_ar', $course->description_ar) }}</textarea>
                        @error('description_ar')
                            <span style="color: #ef4444; font-size: 0.9rem;">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">الوصف (إنجليزي)</label>
                        <textarea name="description_en" rows="4" 
                                  style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 1rem; resize: vertical;">{{ old('description_en', $course->description_en) }}</textarea>
                        @error('description_en')
                            <span style="color: #ef4444; font-size: 0.9rem;">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">المتطلبات المسبقة</label>
                        <textarea name="prerequisites" rows="3" 
                                  style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 1rem; resize: vertical;">{{ old('prerequisites', $course->prerequisites) }}</textarea>
                        @error('prerequisites')
                            <span style="color: #ef4444; font-size: 0.9rem;">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">صورة الدورة</label>
                        @if($course->thumbnail)
                            <div style="margin-bottom: 10px;">
                                <img src="{{ $course->thumbnail_url }}" alt="صورة الدورة" style="width: 100px; height: 60px; object-fit: cover; border-radius: 8px;">
                            </div>
                        @endif
                        <input type="file" name="thumbnail" accept="image/*" 
                               style="width: 100%; padding: 8px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 0.9rem;">
                        @error('thumbnail')
                            <span style="color: #ef4444; font-size: 0.9rem;">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">حالة الدورة</label>
                        <select name="status" style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 1rem;">
                            <option value="draft" {{ old('status', $course->status) == 'draft' ? 'selected' : '' }}>مسودة</option>
                            <option value="published" {{ old('status', $course->status) == 'published' ? 'selected' : '' }}>منشور</option>
                            <option value="archived" {{ old('status', $course->status) == 'archived' ? 'selected' : '' }}>مؤرشف</option>
                        </select>
                        @error('status')
                            <span style="color: #ef4444; font-size: 0.9rem;">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div style="margin-bottom: 20px;">
                        <label style="display: flex; align-items: center; gap: 8px; color: #374151; font-weight: 500;">
                            <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $course->is_featured) ? 'checked' : '' }}>
                            دورة مميزة
                        </label>
                    </div>
                    
                    <div style="margin-bottom: 20px;">
                        <label style="display: flex; align-items: center; gap: 8px; color: #374151; font-weight: 500;">
                            <input type="checkbox" name="is_free" value="1" {{ old('is_free', $course->is_free) ? 'checked' : '' }}>
                            دورة مجانية
                        </label>
                    </div>
                </div>
            </div>
            
            <!-- Submit Buttons -->
            <div style="display: flex; gap: 15px; margin-top: 30px; padding-top: 20px; border-top: 1px solid #e5e7eb;">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-circle"></i>
                    حفظ التغييرات
                </button>
                <a href="{{ route('teacher.courses.index') }}" class="btn btn-outline">
                    <i class="bi bi-x-circle"></i>
                    إلغاء
                </a>
            </div>
        </form>
    </div>
</div>
@endsection 