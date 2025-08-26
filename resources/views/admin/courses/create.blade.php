@extends('layouts.admin')

@section('title', 'إنشاء دورة متقدمة - لوحة الإدارة')

@section('content')
<div class="content-area">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="card-title">إنشاء دورة متقدمة</h2>
                <a href="{{ route('admin.courses') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-right"></i>
                    العودة للدورات
                </a>
            </div>
        </div>
        
        <div class="card-body">
            <form method="POST" action="{{ route('admin.courses.store') }}" enctype="multipart/form-data" id="courseForm">
                @csrf
                
                <!-- Progress Bar -->
                <div class="progress mb-4" style="height: 8px;">
                    <div class="progress-bar" role="progressbar" style="width: 0%" id="formProgress"></div>
                </div>
                
                <!-- Form Steps -->
                <div id="step1" class="form-step active">
                    <h4 class="mb-4"><i class="bi bi-info-circle"></i> المعلومات الأساسية</h4>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="title_ar" class="form-label">عنوان الدورة (عربي) *</label>
                            <input type="text" class="form-control @error('title_ar') is-invalid @enderror" 
                                   id="title_ar" name="title_ar" value="{{ old('title_ar') }}" required>
                            @error('title_ar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="title_en" class="form-label">عنوان الدورة (إنجليزي)</label>
                            <input type="text" class="form-control @error('title_en') is-invalid @enderror" 
                                   id="title_en" name="title_en" value="{{ old('title_en') }}">
                            @error('title_en')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="category_id" class="form-label">القسم *</label>
                            <select class="form-select @error('category_id') is-invalid @enderror" 
                                    id="category_id" name="category_id" required>
                                <option value="">اختر القسم</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name_ar }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="instructor_id" class="form-label">المدرب *</label>
                            <select class="form-select @error('instructor_id') is-invalid @enderror" 
                                    id="instructor_id" name="instructor_id" required>
                                <option value="">اختر المدرب</option>
                                @foreach($instructors as $instructor)
                                    <option value="{{ $instructor->id }}" {{ old('instructor_id') == $instructor->id ? 'selected' : '' }}>
                                        {{ $instructor->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('instructor_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="description_ar" class="form-label">وصف الدورة (عربي) *</label>
                        <textarea class="form-control @error('description_ar') is-invalid @enderror" 
                                  id="description_ar" name="description_ar" rows="4" required>{{ old('description_ar') }}</textarea>
                        @error('description_ar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="description_en" class="form-label">وصف الدورة (إنجليزي)</label>
                        <textarea class="form-control @error('description_en') is-invalid @enderror" 
                                  id="description_en" name="description_en" rows="4">{{ old('description_en') }}</textarea>
                        @error('description_en')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-primary" onclick="nextStep()">
                            التالي <i class="bi bi-arrow-left"></i>
                        </button>
                    </div>
                </div>
                
                <!-- Step 2: Course Details -->
                <div id="step2" class="form-step" style="display: none;">
                    <h4 class="mb-4"><i class="bi bi-gear"></i> تفاصيل الدورة</h4>
                    
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="price" class="form-label">السعر (ريال) *</label>
                            <input type="number" class="form-control @error('price') is-invalid @enderror" 
                                   id="price" name="price" value="{{ old('price', 0) }}" min="0" step="0.01" required>
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-4 mb-3">
                            <label for="duration" class="form-label">المدة (ساعات) *</label>
                            <input type="number" class="form-control @error('duration') is-invalid @enderror" 
                                   id="duration" name="duration" value="{{ old('duration', 1) }}" min="1" required>
                            @error('duration')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-4 mb-3">
                            <label for="level" class="form-label">المستوى *</label>
                            <select class="form-select @error('level') is-invalid @enderror" 
                                    id="level" name="level" required>
                                <option value="">اختر المستوى</option>
                                <option value="beginner" {{ old('level') == 'beginner' ? 'selected' : '' }}>مبتدئ</option>
                                <option value="intermediate" {{ old('level') == 'intermediate' ? 'selected' : '' }}>متوسط</option>
                                <option value="advanced" {{ old('level') == 'advanced' ? 'selected' : '' }}>متقدم</option>
                                <option value="expert" {{ old('level') == 'expert' ? 'selected' : '' }}>خبير</option>
                            </select>
                            @error('level')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="max_students" class="form-label">الحد الأقصى للطلاب</label>
                            <input type="number" class="form-control" id="max_students" name="max_students" 
                                   value="{{ old('max_students', 100) }}" min="1">
                            <div class="form-text">اترك فارغاً للعدد غير المحدود</div>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="certificate_template" class="form-label">قالب الشهادة</label>
                            <select class="form-select" id="certificate_template" name="certificate_template">
                                <option value="default">القالب الافتراضي</option>
                                <option value="premium">القالب المميز</option>
                                <option value="custom">قالب مخصص</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">الحالة *</label>
                            <select class="form-select @error('status') is-invalid @enderror" 
                                    id="status" name="status" required>
                                <option value="">اختر الحالة</option>
                                <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>مسودة</option>
                                <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>منشور</option>
                                <option value="archived" {{ old('status') == 'archived' ? 'selected' : '' }}>مؤرشف</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="access_type" class="form-label">نوع الوصول</label>
                            <select class="form-select" id="access_type" name="access_type">
                                <option value="lifetime">مدى الحياة</option>
                                <option value="limited">محدود (30 يوم)</option>
                                <option value="subscription">اشتراك شهري</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-secondary" onclick="prevStep()">
                            <i class="bi bi-arrow-right"></i> السابق
                        </button>
                        <button type="button" class="btn btn-primary" onclick="nextStep()">
                            التالي <i class="bi bi-arrow-left"></i>
                        </button>
                    </div>
                </div>
                
                <!-- Step 3: Media & Resources -->
                <div id="step3" class="form-step" style="display: none;">
                    <h4 class="mb-4"><i class="bi bi-camera-video"></i> الوسائط والموارد</h4>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="thumbnail" class="form-label">صورة الدورة</label>
                            <input type="file" class="form-control @error('thumbnail') is-invalid @enderror" 
                                   id="thumbnail" name="thumbnail" accept="image/*">
                            <div class="form-text">الأبعاد الموصى بها: 800×600 بكسل</div>
                            @error('thumbnail')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="video_intro" class="form-label">فيديو تعريفي</label>
                            <select class="form-select" id="video_source" onchange="toggleVideoInput()">
                                <option value="upload">رفع فيديو</option>
                                <option value="youtube">YouTube</option>
                                <option value="drive">Google Drive</option>
                                <option value="vimeo">Vimeo</option>
                            </select>
                        </div>
                    </div>
                    
                    <div id="video_upload" class="mb-3">
                        <label for="intro_video" class="form-label">رفع الفيديو التعريفي</label>
                        <input type="file" class="form-control" id="intro_video" name="intro_video" accept="video/*">
                        <div class="form-text">الحد الأقصى: 500 ميجابايت</div>
                    </div>
                    
                    <div id="video_url" class="mb-3" style="display: none;">
                        <label for="video_url_input" class="form-label">رابط الفيديو</label>
                        <input type="url" class="form-control" id="video_url_input" name="video_url" 
                               placeholder="https://www.youtube.com/watch?v=...">
                    </div>
                    
                    <div class="mb-3">
                        <label for="course_resources" class="form-label">الموارد الإضافية</label>
                        <div class="resource-list" id="resourceList">
                            <div class="resource-item mb-2">
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" name="resources[0][title]" placeholder="عنوان المورد">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="file" class="form-control" name="resources[0][file]" accept=".pdf,.doc,.docx,.ppt,.pptx,.zip,.rar">
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-danger btn-sm" onclick="removeResource(this)">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-outline-primary btn-sm" onclick="addResource()">
                            <i class="bi bi-plus"></i> إضافة مورد
                        </button>
                    </div>
                    
                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-secondary" onclick="prevStep()">
                            <i class="bi bi-arrow-right"></i> السابق
                        </button>
                        <button type="button" class="btn btn-primary" onclick="nextStep()">
                            التالي <i class="bi bi-arrow-left"></i>
                        </button>
                    </div>
                </div>
                
                <!-- Step 4: Assessment & Quizzes -->
                <div id="step4" class="form-step" style="display: none;">
                    <h4 class="mb-4"><i class="bi bi-question-circle"></i> التقييم والاختبارات</h4>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="quiz_enabled" class="form-label">تفعيل الاختبارات</label>
                            <select class="form-select" id="quiz_enabled" name="quiz_enabled">
                                <option value="1">نعم</option>
                                <option value="0">لا</option>
                            </select>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="passing_score" class="form-label">الدرجة المطلوبة للنجاح (%)</label>
                            <input type="number" class="form-control" id="passing_score" name="passing_score" 
                                   value="70" min="0" max="100">
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">أنواع التقييم</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="midterm_exam" name="assessment_types[]" value="midterm">
                            <label class="form-check-label" for="midterm_exam">امتحان منتصف الفصل</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="final_exam" name="assessment_types[]" value="final">
                            <label class="form-check-label" for="final_exam">الامتحان النهائي</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="assignments" name="assessment_types[]" value="assignments">
                            <label class="form-check-label" for="assignments">الواجبات</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="projects" name="assessment_types[]" value="projects">
                            <label class="form-check-label" for="projects">المشاريع</label>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="certificate_requirements" class="form-label">متطلبات الحصول على الشهادة</label>
                        <textarea class="form-control" id="certificate_requirements" name="certificate_requirements" rows="3"
                                  placeholder="اكتب متطلبات الحصول على شهادة الدورة..."></textarea>
                    </div>
                    
                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-secondary" onclick="prevStep()">
                            <i class="bi bi-arrow-right"></i> السابق
                        </button>
                        <button type="button" class="btn btn-primary" onclick="nextStep()">
                            التالي <i class="bi bi-arrow-left"></i>
                        </button>
                    </div>
                </div>
                
                <!-- Step 5: Online Sessions -->
                <div id="step5" class="form-step" style="display: none;">
                    <h4 class="mb-4"><i class="bi bi-camera-video-fill"></i> الجلسات المباشرة</h4>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="live_sessions_enabled" class="form-label">تفعيل الجلسات المباشرة</label>
                            <select class="form-select" id="live_sessions_enabled" name="live_sessions_enabled" onchange="toggleLiveSessions()">
                                <option value="1">نعم</option>
                                <option value="0">لا</option>
                            </select>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="max_participants" class="form-label">الحد الأقصى للمشاركين</label>
                            <input type="number" class="form-control" id="max_participants" name="max_participants" 
                                   value="50" min="1">
                        </div>
                    </div>
                    
                    <div id="live_sessions_config" class="mb-3">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="session_duration" class="form-label">مدة الجلسة (دقائق)</label>
                                <input type="number" class="form-control" id="session_duration" name="session_duration" 
                                       value="60" min="15" step="15">
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="sessions_count" class="form-label">عدد الجلسات</label>
                                <input type="number" class="form-control" id="sessions_count" name="sessions_count" 
                                       value="4" min="1">
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="platform" class="form-label">منصة الجلسات</label>
                            <select class="form-select" id="platform" name="platform">
                                <option value="zoom">Zoom</option>
                                <option value="teams">Microsoft Teams</option>
                                <option value="meet">Google Meet</option>
                                <option value="custom">منصة مخصصة</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-secondary" onclick="prevStep()">
                            <i class="bi bi-arrow-right"></i> السابق
                        </button>
                        <button type="button" class="btn btn-primary" onclick="nextStep()">
                            التالي <i class="bi bi-arrow-left"></i>
                        </button>
                    </div>
                </div>
                
                <!-- Step 6: Advanced Settings -->
                <div id="step6" class="form-step" style="display: none;">
                    <h4 class="mb-4"><i class="bi bi-sliders"></i> الإعدادات المتقدمة</h4>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="prerequisites" class="form-label">المتطلبات المسبقة</label>
                            <textarea class="form-control" id="prerequisites" name="prerequisites" rows="3"
                                      placeholder="اكتب المتطلبات المسبقة للدورة..."></textarea>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="learning_objectives" class="form-label">أهداف التعلم</label>
                            <textarea class="form-control" id="learning_objectives" name="learning_objectives" rows="3"
                                      placeholder="اكتب أهداف التعلم..."></textarea>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="tags" class="form-label">العلامات</label>
                            <input type="text" class="form-control" id="tags" name="tags" 
                                   placeholder="افصل بين العلامات بفواصل">
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="language" class="form-label">لغة الدورة</label>
                            <select class="form-select" id="language" name="language">
                                <option value="ar">العربية</option>
                                <option value="en">الإنجليزية</option>
                                <option value="both">ثنائي اللغة</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="featured" name="featured" value="1">
                                <label class="form-check-label" for="featured">دورة مميزة</label>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="certificate_available" name="certificate_available" value="1">
                                <label class="form-check-label" for="certificate_available">شهادة متاحة</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-secondary" onclick="prevStep()">
                            <i class="bi bi-arrow-right"></i> السابق
                        </button>
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-check-lg"></i> إنشاء الدورة
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
let currentStep = 1;
const totalSteps = 6;

function updateProgress() {
    const progress = (currentStep / totalSteps) * 100;
    document.getElementById('formProgress').style.width = progress + '%';
}

function showStep(step) {
    // Hide all steps
    for (let i = 1; i <= totalSteps; i++) {
        document.getElementById('step' + i).style.display = 'none';
    }
    
    // Show current step
    document.getElementById('step' + step).style.display = 'block';
    
    // Update progress
    updateProgress();
}

function nextStep() {
    if (validateCurrentStep()) {
        if (currentStep < totalSteps) {
            currentStep++;
            showStep(currentStep);
        }
    }
}

function prevStep() {
    if (currentStep > 1) {
        currentStep--;
        showStep(currentStep);
    }
}

function validateCurrentStep() {
    const currentStepElement = document.getElementById('step' + currentStep);
    const requiredFields = currentStepElement.querySelectorAll('[required]');
    let isValid = true;
    
    requiredFields.forEach(field => {
        if (!field.value.trim()) {
            field.classList.add('is-invalid');
            isValid = false;
        } else {
            field.classList.remove('is-invalid');
        }
    });
    
    if (!isValid) {
        alert('يرجى ملء جميع الحقول المطلوبة');
    }
    
    return isValid;
}

function toggleVideoInput() {
    const source = document.getElementById('video_source').value;
    const uploadDiv = document.getElementById('video_upload');
    const urlDiv = document.getElementById('video_url');
    
    if (source === 'upload') {
        uploadDiv.style.display = 'block';
        urlDiv.style.display = 'none';
    } else {
        uploadDiv.style.display = 'none';
        urlDiv.style.display = 'block';
    }
}

function toggleLiveSessions() {
    const enabled = document.getElementById('live_sessions_enabled').value;
    const config = document.getElementById('live_sessions_config');
    
    if (enabled === '1') {
        config.style.display = 'block';
    } else {
        config.style.display = 'none';
    }
}

let resourceCount = 1;

function addResource() {
    const resourceList = document.getElementById('resourceList');
    const newResource = document.createElement('div');
    newResource.className = 'resource-item mb-2';
    newResource.innerHTML = `
        <div class="row">
            <div class="col-md-4">
                <input type="text" class="form-control" name="resources[${resourceCount}][title]" placeholder="عنوان المورد">
            </div>
            <div class="col-md-6">
                <input type="file" class="form-control" name="resources[${resourceCount}][file]" accept=".pdf,.doc,.docx,.ppt,.pptx,.zip,.rar">
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger btn-sm" onclick="removeResource(this)">
                    <i class="bi bi-trash"></i>
                </button>
            </div>
        </div>
    `;
    resourceList.appendChild(newResource);
    resourceCount++;
}

function removeResource(button) {
    button.closest('.resource-item').remove();
}

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    updateProgress();
    toggleLiveSessions();
});

// Form submission
document.getElementById('courseForm').addEventListener('submit', function(e) {
    if (!validateCurrentStep()) {
        e.preventDefault();
    }
});
</script>

<style>
.form-step {
    transition: all 0.3s ease;
}

.progress {
    background-color: #e9ecef;
    border-radius: 10px;
}

.progress-bar {
    background: linear-gradient(90deg, #10b981, #059669);
    border-radius: 10px;
    transition: width 0.3s ease;
}

.resource-item {
    border: 1px solid #dee2e6;
    border-radius: 8px;
    padding: 15px;
    background-color: #f8f9fa;
}

.form-control, .form-select {
    border-radius: 8px;
    border: 1px solid #d1d5db;
    padding: 0.5rem 0.75rem;
}

.form-control:focus, .form-select:focus {
    border-color: #10b981;
    box-shadow: 0 0 0 0.2rem rgba(16, 185, 129, 0.25);
}

.btn {
    border-radius: 8px;
    font-weight: 500;
}

.card {
    border: none;
    box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
}

.card-header {
    background-color: #f8f9fc;
    border-bottom: 1px solid #e3e6f0;
}

h4 {
    color: #5a5c69;
    font-weight: 600;
}

.form-text {
    font-size: 0.875rem;
    color: #6c757d;
}

.invalid-feedback {
    font-size: 0.875rem;
}

.form-check-input:checked {
    background-color: #10b981;
    border-color: #10b981;
}
</style>
@endsection 