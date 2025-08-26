@extends('layouts.teacher')

@section('title', 'إنشاء دورة جديدة')

@section('content')
<div class="dashboard-container">
    <!-- Page Header -->
    <div class="page-header">
        <div>
            <h1 style="font-size: 2rem; color: #1f2937; margin-bottom: 5px;">إنشاء دورة جديدة</h1>
            <p style="color: #6b7280; margin: 0;">أضف دورة جديدة لمشاركة معرفتك مع الطلاب</p>
        </div>
        <div>
            <a href="{{ route('teacher.courses.index') }}" class="btn btn-outline">
                <i class="bi bi-arrow-right"></i>
                العودة للدورات
            </a>
        </div>
    </div>

    <!-- Course Creation Form -->
    <div style="background: white; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); overflow: hidden;">
        <form method="POST" action="{{ route('teacher.courses.store') }}" enctype="multipart/form-data">
            @csrf
            
            <!-- Form Header -->
            <div style="padding: 25px; border-bottom: 1px solid #e5e7eb;">
                <h2 style="font-size: 1.5rem; color: #1f2937; margin-bottom: 10px;">معلومات الدورة الأساسية</h2>
                <p style="color: #6b7280; margin: 0;">املأ المعلومات الأساسية للدورة</p>
            </div>

            <div style="padding: 30px;">
                <!-- Basic Information -->
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 25px; margin-bottom: 30px;">
                    <div>
                        <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">عنوان الدورة (عربي) *</label>
                        <input type="text" name="title_ar" value="{{ old('title_ar') }}" 
                               placeholder="أدخل عنوان الدورة باللغة العربية"
                               style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 0.9rem;">
                        @error('title_ar')
                            <div style="color: #ef4444; font-size: 0.8rem; margin-top: 5px;">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">عنوان الدورة (إنجليزي) *</label>
                        <input type="text" name="title_en" value="{{ old('title_en') }}" 
                               placeholder="Enter course title in English"
                               style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 0.9rem;">
                        @error('title_en')
                            <div style="color: #ef4444; font-size: 0.8rem; margin-top: 5px;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Description -->
                <div style="margin-bottom: 30px;">
                    <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">وصف الدورة (عربي) *</label>
                    <textarea name="description_ar" rows="4" 
                              placeholder="اكتب وصفاً مفصلاً للدورة باللغة العربية"
                              style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 0.9rem; resize: vertical;">{{ old('description_ar') }}</textarea>
                    @error('description_ar')
                        <div style="color: #ef4444; font-size: 0.8rem; margin-top: 5px;">{{ $message }}</div>
                    @enderror
                </div>

                <div style="margin-bottom: 30px;">
                    <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">وصف الدورة (إنجليزي) *</label>
                    <textarea name="description_en" rows="4" 
                              placeholder="Write a detailed description of the course in English"
                              style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 0.9rem; resize: vertical;">{{ old('description_en') }}</textarea>
                    @error('description_en')
                        <div style="color: #ef4444; font-size: 0.8rem; margin-top: 5px;">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Course Details -->
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 25px; margin-bottom: 30px;">
                    <div>
                        <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">القسم *</label>
                        <select name="category_id" style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 0.9rem;">
                            <option value="">اختر القسم</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name_ar }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div style="color: #ef4444; font-size: 0.8rem; margin-top: 5px;">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">المستوى *</label>
                        <select name="level" style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 0.9rem;">
                            <option value="">اختر المستوى</option>
                            <option value="beginner" {{ old('level') == 'beginner' ? 'selected' : '' }}>مبتدئ</option>
                            <option value="intermediate" {{ old('level') == 'intermediate' ? 'selected' : '' }}>متوسط</option>
                            <option value="advanced" {{ old('level') == 'advanced' ? 'selected' : '' }}>متقدم</option>
                        </select>
                        @error('level')
                            <div style="color: #ef4444; font-size: 0.8rem; margin-top: 5px;">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">المدة (بالساعات) *</label>
                        <input type="number" name="duration" value="{{ old('duration') }}" min="1" max="1000"
                               placeholder="مثال: 20"
                               style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 0.9rem;">
                        @error('duration')
                            <div style="color: #ef4444; font-size: 0.8rem; margin-top: 5px;">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">السعر (ريال) *</label>
                        <input type="number" name="price" value="{{ old('price') }}" min="0" step="0.01"
                               placeholder="مثال: 199.99"
                               style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 0.9rem;">
                        @error('price')
                            <div style="color: #ef4444; font-size: 0.8rem; margin-top: 5px;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Featured Image -->
                <div style="margin-bottom: 30px;">
                    <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">صورة الدورة</label>
                    <div style="border: 2px dashed #d1d5db; border-radius: 8px; padding: 30px; text-align: center; background: #f9fafb;">
                        <i class="bi bi-image" style="font-size: 2rem; color: #9ca3af; margin-bottom: 10px;"></i>
                        <p style="color: #6b7280; margin-bottom: 15px;">اسحب وأفلت الصورة هنا أو انقر للاختيار</p>
                        <input type="file" name="featured_image" accept="image/*" 
                               style="display: none;" id="featured_image">
                        <button type="button" onclick="document.getElementById('featured_image').click()" 
                                class="btn btn-outline">
                            <i class="bi bi-upload"></i>
                            اختيار صورة
                        </button>
                    </div>
                    @error('featured_image')
                        <div style="color: #ef4444; font-size: 0.8rem; margin-top: 5px;">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Additional Information -->
                <div style="border-top: 1px solid #e5e7eb; padding-top: 30px; margin-bottom: 30px;">
                    <h3 style="font-size: 1.2rem; color: #1f2937; margin-bottom: 20px;">معلومات إضافية</h3>
                    
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 25px;">
                        <div>
                            <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">أهداف الدورة (عربي)</label>
                            <textarea name="objectives_ar" rows="3" 
                                      placeholder="اكتب أهداف الدورة"
                                      style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 0.9rem; resize: vertical;">{{ old('objectives_ar') }}</textarea>
                        </div>

                        <div>
                            <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">أهداف الدورة (إنجليزي)</label>
                            <textarea name="objectives_en" rows="3" 
                                      placeholder="Write course objectives"
                                      style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 0.9rem; resize: vertical;">{{ old('objectives_en') }}</textarea>
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 25px; margin-top: 25px;">
                        <div>
                            <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">المتطلبات المسبقة (عربي)</label>
                            <textarea name="requirements_ar" rows="3" 
                                      placeholder="اكتب المتطلبات المسبقة للدورة"
                                      style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 0.9rem; resize: vertical;">{{ old('requirements_ar') }}</textarea>
                        </div>

                        <div>
                            <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">المتطلبات المسبقة (إنجليزي)</label>
                            <textarea name="requirements_en" rows="3" 
                                      placeholder="Write course prerequisites"
                                      style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 0.9rem; resize: vertical;">{{ old('requirements_en') }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Course Settings -->
                <div style="border-top: 1px solid #e5e7eb; padding-top: 30px; margin-bottom: 30px;">
                    <h3 style="font-size: 1.2rem; color: #1f2937; margin-bottom: 20px;">إعدادات الدورة</h3>
                    
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 25px;">
                        <div>
                            <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                                <input type="checkbox" name="is_free" value="1" {{ old('is_free') ? 'checked' : '' }} 
                                       style="width: 18px; height: 18px;">
                                <span style="color: #374151; font-weight: 500;">دورة مجانية</span>
                            </label>
                            <p style="color: #6b7280; font-size: 0.8rem; margin-top: 5px;">إذا تم تحديد هذا الخيار، ستكون الدورة مجانية</p>
                        </div>

                        <div>
                            <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                                <input type="checkbox" name="certificate_enabled" value="1" {{ old('certificate_enabled', true) ? 'checked' : '' }} 
                                       style="width: 18px; height: 18px;">
                                <span style="color: #374151; font-weight: 500;">إصدار شهادة إتمام</span>
                            </label>
                            <p style="color: #6b7280; font-size: 0.8rem; margin-top: 5px;">إصدار شهادة للطلاب عند إتمام الدورة</p>
                        </div>

                        <div>
                            <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                                <input type="checkbox" name="allow_reviews" value="1" {{ old('allow_reviews', true) ? 'checked' : '' }} 
                                       style="width: 18px; height: 18px;">
                                <span style="color: #374151; font-weight: 500;">السماح بالتقييمات</span>
                            </label>
                            <p style="color: #6b7280; font-size: 0.8rem; margin-top: 5px;">السماح للطلاب بتقييم الدورة</p>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div style="display: flex; gap: 15px; justify-content: flex-end; border-top: 1px solid #e5e7eb; padding-top: 30px;">
                    <a href="{{ route('teacher.courses.index') }}" class="btn btn-outline">
                        <i class="bi bi-x"></i>
                        إلغاء
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check"></i>
                        إنشاء الدورة
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<style>
@media (max-width: 768px) {
    .page-header {
        flex-direction: column;
        gap: 15px;
        text-align: center;
    }
    
    .form-actions {
        flex-direction: column;
    }
}
</style>

<script>
// File upload preview
document.getElementById('featured_image').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const container = document.querySelector('.file-upload-container');
            container.innerHTML = `
                <img src="${e.target.result}" style="max-width: 200px; max-height: 200px; border-radius: 8px; margin-bottom: 10px;">
                <p style="color: #6b7280; margin-bottom: 15px;">${file.name}</p>
                <button type="button" onclick="resetFileInput()" class="btn btn-outline">
                    <i class="bi bi-x"></i>
                    تغيير الصورة
                </button>
            `;
        };
        reader.readAsDataURL(file);
    }
});

function resetFileInput() {
    document.getElementById('featured_image').value = '';
    location.reload();
}
</script>
@endsection 