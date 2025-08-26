@extends('layouts.admin')

@section('title', 'إضافة كويز جديد - لوحة الإدارة')

@section('content')
<div class="content-area">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="card-title">إضافة كويز جديد</h2>
                            <p class="text-muted mb-0">{{ $course->title_ar }}</p>
                        </div>
                        <a href="{{ route('admin.courses.quizzes', $course) }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-right"></i>
                            العودة للكويزات
                        </a>
                    </div>
                </div>
                
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.quizzes.store') }}">
                        @csrf
                        <input type="hidden" name="course_id" value="{{ $course->id }}">
                        
                        <div class="row">
                            <!-- العنوان -->
                            <div class="col-md-6 mb-3">
                                <label for="title_ar" class="form-label">عنوان الكويز (عربي) *</label>
                                <input type="text" class="form-control @error('title_ar') is-invalid @enderror" 
                                       id="title_ar" name="title_ar" value="{{ old('title_ar') }}" required>
                                @error('title_ar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="title_en" class="form-label">عنوان الكويز (إنجليزي)</label>
                                <input type="text" class="form-control @error('title_en') is-invalid @enderror" 
                                       id="title_en" name="title_en" value="{{ old('title_en') }}">
                                @error('title_en')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- الوصف -->
                            <div class="col-md-6 mb-3">
                                <label for="description_ar" class="form-label">وصف الكويز (عربي)</label>
                                <textarea class="form-control @error('description_ar') is-invalid @enderror" 
                                          id="description_ar" name="description_ar" rows="3">{{ old('description_ar') }}</textarea>
                                @error('description_ar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="description_en" class="form-label">وصف الكويز (إنجليزي)</label>
                                <textarea class="form-control @error('description_en') is-invalid @enderror" 
                                          id="description_en" name="description_en" rows="3">{{ old('description_en') }}</textarea>
                                @error('description_en')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- الدرس المرتبط -->
                            <div class="col-md-6 mb-3">
                                <label for="lesson_id" class="form-label">الدرس المرتبط</label>
                                <select class="form-select @error('lesson_id') is-invalid @enderror" id="lesson_id" name="lesson_id">
                                    <option value="">اختر درس (اختياري)</option>
                                    @foreach($lessons as $lesson)
                                        <option value="{{ $lesson->id }}" {{ old('lesson_id') == $lesson->id ? 'selected' : '' }}>
                                            {{ $lesson->title_ar }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('lesson_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- مدة الكويز -->
                            <div class="col-md-6 mb-3">
                                <label for="duration_minutes" class="form-label">مدة الكويز (دقائق) *</label>
                                <input type="number" class="form-control @error('duration_minutes') is-invalid @enderror" 
                                       id="duration_minutes" name="duration_minutes" value="{{ old('duration_minutes', 30) }}" 
                                       min="1" required>
                                @error('duration_minutes')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- نسبة النجاح -->
                            <div class="col-md-6 mb-3">
                                <label for="passing_score" class="form-label">نسبة النجاح (%) *</label>
                                <input type="number" class="form-control @error('passing_score') is-invalid @enderror" 
                                       id="passing_score" name="passing_score" value="{{ old('passing_score', 70) }}" 
                                       min="0" max="100" required>
                                @error('passing_score')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- عدد المحاولات -->
                            <div class="col-md-6 mb-3">
                                <label for="max_attempts" class="form-label">الحد الأقصى للمحاولات *</label>
                                <input type="number" class="form-control @error('max_attempts') is-invalid @enderror" 
                                       id="max_attempts" name="max_attempts" value="{{ old('max_attempts', 3) }}" 
                                       min="1" required>
                                @error('max_attempts')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- تاريخ الاستحقاق -->
                            <div class="col-md-6 mb-3">
                                <label for="due_date" class="form-label">تاريخ الاستحقاق</label>
                                <input type="datetime-local" class="form-control @error('due_date') is-invalid @enderror" 
                                       id="due_date" name="due_date" value="{{ old('due_date') }}">
                                @error('due_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- الإعدادات -->
                            <div class="col-12 mb-3">
                                <h5>إعدادات الكويز</h5>
                                <div class="row">
                                    <div class="col-md-4 mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" 
                                                   {{ old('is_active', true) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_active">
                                                نشط
                                            </label>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4 mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="allow_retake" name="allow_retake" value="1" 
                                                   {{ old('allow_retake', true) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="allow_retake">
                                                السماح بإعادة المحاولة
                                            </label>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4 mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="show_results" name="show_results" value="1" 
                                                   {{ old('show_results', true) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="show_results">
                                                عرض النتائج
                                            </label>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4 mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="randomize_questions" name="randomize_questions" value="1" 
                                                   {{ old('randomize_questions') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="randomize_questions">
                                                ترتيب الأسئلة عشوائياً
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="text-end">
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-check-circle"></i>
                                حفظ الكويز
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.form-label {
    font-weight: 500;
}

.form-control:focus {
    border-color: #198754;
    box-shadow: 0 0 0 0.2rem rgba(25, 135, 84, 0.25);
}

.form-check-input:checked {
    background-color: #198754;
    border-color: #198754;
}

.card-header h5 {
    margin-bottom: 0.5rem;
    color: #495057;
}
</style>
@endsection 