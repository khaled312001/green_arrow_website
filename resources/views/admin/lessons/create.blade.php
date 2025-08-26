@extends('layouts.admin')

@section('title', 'إنشاء درس جديد - لوحة الإدارة')

@section('content')
<div class="content-area">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="card-title">إنشاء درس جديد</h2>
                <a href="{{ route('admin.courses.show', $course) }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-right"></i>
                    العودة للدورة
                </a>
            </div>
        </div>
        
        <div class="card-body">
            <form method="POST" action="{{ route('admin.lessons.store') }}" enctype="multipart/form-data" id="lessonForm">
                @csrf
                <input type="hidden" name="course_id" value="{{ $course->id }}">
                
                <!-- Progress Bar -->
                <div class="progress mb-4" style="height: 8px;">
                    <div class="progress-bar" role="progressbar" style="width: 0%" id="formProgress"></div>
                </div>
                
                <!-- Form Steps -->
                <div id="step1" class="form-step active">
                    <h4 class="mb-4"><i class="bi bi-info-circle"></i> المعلومات الأساسية</h4>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="title_ar" class="form-label">عنوان الدرس (عربي) *</label>
                            <input type="text" class="form-control @error('title_ar') is-invalid @enderror" 
                                   id="title_ar" name="title_ar" value="{{ old('title_ar') }}" required>
                            @error('title_ar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="title_en" class="form-label">عنوان الدرس (إنجليزي)</label>
                            <input type="text" class="form-control @error('title_en') is-invalid @enderror" 
                                   id="title_en" name="title_en" value="{{ old('title_en') }}">
                            @error('title_en')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="lesson_type" class="form-label">نوع الدرس *</label>
                            <select class="form-select @error('lesson_type') is-invalid @enderror" 
                                    id="lesson_type" name="lesson_type" required onchange="toggleLessonType()">
                                <option value="">اختر نوع الدرس</option>
                                <option value="video" {{ old('lesson_type') == 'video' ? 'selected' : '' }}>درس فيديو</option>
                                <option value="text" {{ old('lesson_type') == 'text' ? 'selected' : '' }}>درس نصي</option>
                                <option value="audio" {{ old('lesson_type') == 'audio' ? 'selected' : '' }}>درس صوتي</option>
                                <option value="live" {{ old('lesson_type') == 'live' ? 'selected' : '' }}>جلسة مباشرة</option>
                                <option value="assignment" {{ old('lesson_type') == 'assignment' ? 'selected' : '' }}>واجب</option>
                                <option value="quiz" {{ old('lesson_type') == 'quiz' ? 'selected' : '' }}>اختبار</option>
                            </select>
                            @error('lesson_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="duration" class="form-label">مدة الدرس (دقائق) *</label>
                            <input type="number" class="form-control @error('duration') is-invalid @enderror" 
                                   id="duration" name="duration" value="{{ old('duration', 30) }}" min="1" required>
                            @error('duration')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="description_ar" class="form-label">وصف الدرس (عربي) *</label>
                        <textarea class="form-control @error('description_ar') is-invalid @enderror" 
                                  id="description_ar" name="description_ar" rows="4" required>{{ old('description_ar') }}</textarea>
                        @error('description_ar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="description_en" class="form-label">وصف الدرس (إنجليزي)</label>
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
                
                <!-- Step 2: Content -->
                <div id="step2" class="form-step" style="display: none;">
                    <h4 class="mb-4"><i class="bi bi-file-text"></i> محتوى الدرس</h4>
                    
                    <!-- Video Content -->
                    <div id="video_content" class="content-section" style="display: none;">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="video_source" class="form-label">مصدر الفيديو</label>
                                <select class="form-select" id="video_source" onchange="toggleVideoInput()">
                                    <option value="upload">رفع فيديو</option>
                                    <option value="youtube">YouTube</option>
                                    <option value="drive">Google Drive</option>
                                    <option value="vimeo">Vimeo</option>
                                </select>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="video_quality" class="form-label">جودة الفيديو</label>
                                <select class="form-select" id="video_quality" name="video_quality">
                                    <option value="auto">تلقائي</option>
                                    <option value="1080p">1080p</option>
                                    <option value="720p">720p</option>
                                    <option value="480p">480p</option>
                                </select>
                            </div>
                        </div>
                        
                        <div id="video_upload" class="mb-3">
                            <label for="video_file" class="form-label">رفع الفيديو</label>
                            <input type="file" class="form-control" id="video_file" name="video_file" accept="video/*">
                            <div class="form-text">الحد الأقصى: 1 جيجابايت</div>
                        </div>
                        
                        <div id="video_url" class="mb-3" style="display: none;">
                            <label for="video_url_input" class="form-label">رابط الفيديو</label>
                            <input type="url" class="form-control" id="video_url_input" name="video_url" 
                                   placeholder="https://www.youtube.com/watch?v=...">
                        </div>
                    </div>
                    
                    <!-- Text Content -->
                    <div id="text_content" class="content-section" style="display: none;">
                        <div class="mb-3">
                            <label for="content_ar" class="form-label">محتوى الدرس (عربي) *</label>
                            <textarea class="form-control" id="content_ar" name="content_ar" rows="10"
                                      placeholder="اكتب محتوى الدرس هنا...">{{ old('content_ar') }}</textarea>
                        </div>
                        
                        <div class="mb-3">
                            <label for="content_en" class="form-label">محتوى الدرس (إنجليزي)</label>
                            <textarea class="form-control" id="content_en" name="content_en" rows="10"
                                      placeholder="Write lesson content here...">{{ old('content_en') }}</textarea>
                        </div>
                    </div>
                    
                    <!-- Audio Content -->
                    <div id="audio_content" class="content-section" style="display: none;">
                        <div class="mb-3">
                            <label for="audio_file" class="form-label">رفع الملف الصوتي</label>
                            <input type="file" class="form-control" id="audio_file" name="audio_file" accept="audio/*">
                            <div class="form-text">الحد الأقصى: 100 ميجابايت</div>
                        </div>
                    </div>
                    
                    <!-- Live Session -->
                    <div id="live_content" class="content-section" style="display: none;">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="session_date" class="form-label">تاريخ الجلسة</label>
                                <input type="datetime-local" class="form-control" id="session_date" name="session_date">
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="session_link" class="form-label">رابط الجلسة</label>
                                <input type="url" class="form-control" id="session_link" name="session_link" 
                                       placeholder="https://zoom.us/j/...">
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="session_notes" class="form-label">ملاحظات الجلسة</label>
                            <textarea class="form-control" id="session_notes" name="session_notes" rows="3"
                                      placeholder="ملاحظات مهمة للجلسة..."></textarea>
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
                
                <!-- Step 3: Resources & Attachments -->
                <div id="step3" class="form-step" style="display: none;">
                    <h4 class="mb-4"><i class="bi bi-paperclip"></i> الموارد والمرفقات</h4>
                    
                    <div class="mb-3">
                        <label class="form-label">الملفات المرفقة</label>
                        <div class="attachment-list" id="attachmentList">
                            <div class="attachment-item mb-2">
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" name="attachments[0][title]" placeholder="عنوان الملف">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="file" class="form-control" name="attachments[0][file]" 
                                               accept=".pdf,.doc,.docx,.ppt,.pptx,.zip,.rar,.mp4,.mp3">
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-danger btn-sm" onclick="removeAttachment(this)">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-outline-primary btn-sm" onclick="addAttachment()">
                            <i class="bi bi-plus"></i> إضافة ملف
                        </button>
                    </div>
                    
                    <div class="mb-3">
                        <label for="external_links" class="form-label">الروابط الخارجية</label>
                        <div class="external-links" id="externalLinks">
                            <div class="link-item mb-2">
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" name="external_links[0][title]" placeholder="عنوان الرابط">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="url" class="form-control" name="external_links[0][url]" placeholder="https://...">
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-danger btn-sm" onclick="removeLink(this)">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-outline-primary btn-sm" onclick="addLink()">
                            <i class="bi bi-plus"></i> إضافة رابط
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
                
                <!-- Step 4: Quiz/Assessment -->
                <div id="step4" class="form-step" style="display: none;">
                    <h4 class="mb-4"><i class="bi bi-question-circle"></i> الاختبار والتقييم</h4>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="quiz_enabled" class="form-label">تفعيل الاختبار</label>
                            <select class="form-select" id="quiz_enabled" name="quiz_enabled" onchange="toggleQuiz()">
                                <option value="0">لا</option>
                                <option value="1">نعم</option>
                            </select>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="passing_score" class="form-label">الدرجة المطلوبة للنجاح (%)</label>
                            <input type="number" class="form-control" id="passing_score" name="passing_score" 
                                   value="70" min="0" max="100">
                        </div>
                    </div>
                    
                    <div id="quiz_config" style="display: none;">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="time_limit" class="form-label">الحد الزمني (دقائق)</label>
                                <input type="number" class="form-control" id="time_limit" name="time_limit" 
                                       value="30" min="1">
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="attempts_allowed" class="form-label">عدد المحاولات المسموحة</label>
                                <input type="number" class="form-control" id="attempts_allowed" name="attempts_allowed" 
                                       value="3" min="1">
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">أسئلة الاختبار</label>
                            <div class="quiz-questions" id="quizQuestions">
                                <div class="question-item mb-3 p-3 border rounded">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <input type="text" class="form-control mb-2" name="questions[0][question]" 
                                                   placeholder="اكتب السؤال هنا...">
                                        </div>
                                        <div class="col-md-4">
                                            <select class="form-select" name="questions[0][type]">
                                                <option value="multiple_choice">اختيار متعدد</option>
                                                <option value="true_false">صح وخطأ</option>
                                                <option value="short_answer">إجابة قصيرة</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="answers-section">
                                        <div class="answer-item mb-2">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="questions[0][answers][0]" 
                                                           placeholder="الإجابة الأولى">
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="questions[0][correct]" value="0">
                                                        <label class="form-check-label">صحيح</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <button type="button" class="btn btn-danger btn-sm" onclick="removeAnswer(this)">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-outline-secondary btn-sm" onclick="addAnswer(this)">
                                        <i class="bi bi-plus"></i> إضافة إجابة
                                    </button>
                                </div>
                            </div>
                            <button type="button" class="btn btn-outline-primary" onclick="addQuestion()">
                                <i class="bi bi-plus"></i> إضافة سؤال
                            </button>
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
                
                <!-- Step 5: Settings -->
                <div id="step5" class="form-step" style="display: none;">
                    <h4 class="mb-4"><i class="bi bi-gear"></i> إعدادات الدرس</h4>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="order" class="form-label">ترتيب الدرس</label>
                            <input type="number" class="form-control" id="order" name="order" 
                                   value="{{ old('order', 1) }}" min="1">
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">حالة الدرس</label>
                            <select class="form-select" id="status" name="status">
                                <option value="draft">مسودة</option>
                                <option value="published">منشور</option>
                                <option value="archived">مؤرشف</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="is_free" name="is_free" value="1">
                                <label class="form-check-label" for="is_free">درس مجاني</label>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="downloadable" name="downloadable" value="1">
                                <label class="form-check-label" for="downloadable">قابل للتحميل</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="notes" class="form-label">ملاحظات إضافية</label>
                        <textarea class="form-control" id="notes" name="notes" rows="3"
                                  placeholder="ملاحظات إضافية للدرس..."></textarea>
                    </div>
                    
                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-secondary" onclick="prevStep()">
                            <i class="bi bi-arrow-right"></i> السابق
                        </button>
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-check-lg"></i> إنشاء الدرس
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
let currentStep = 1;
const totalSteps = 5;
let attachmentCount = 1;
let linkCount = 1;
let questionCount = 1;

function updateProgress() {
    const progress = (currentStep / totalSteps) * 100;
    document.getElementById('formProgress').style.width = progress + '%';
}

function showStep(step) {
    for (let i = 1; i <= totalSteps; i++) {
        document.getElementById('step' + i).style.display = 'none';
    }
    document.getElementById('step' + step).style.display = 'block';
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

function toggleLessonType() {
    const lessonType = document.getElementById('lesson_type').value;
    const contentSections = document.querySelectorAll('.content-section');
    
    contentSections.forEach(section => {
        section.style.display = 'none';
    });
    
    if (lessonType) {
        document.getElementById(lessonType + '_content').style.display = 'block';
    }
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

function toggleQuiz() {
    const enabled = document.getElementById('quiz_enabled').value;
    const config = document.getElementById('quiz_config');
    
    if (enabled === '1') {
        config.style.display = 'block';
    } else {
        config.style.display = 'none';
    }
}

function addAttachment() {
    const attachmentList = document.getElementById('attachmentList');
    const newAttachment = document.createElement('div');
    newAttachment.className = 'attachment-item mb-2';
    newAttachment.innerHTML = `
        <div class="row">
            <div class="col-md-4">
                <input type="text" class="form-control" name="attachments[${attachmentCount}][title]" placeholder="عنوان الملف">
            </div>
            <div class="col-md-6">
                <input type="file" class="form-control" name="attachments[${attachmentCount}][file]" accept=".pdf,.doc,.docx,.ppt,.pptx,.zip,.rar,.mp4,.mp3">
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger btn-sm" onclick="removeAttachment(this)">
                    <i class="bi bi-trash"></i>
                </button>
            </div>
        </div>
    `;
    attachmentList.appendChild(newAttachment);
    attachmentCount++;
}

function removeAttachment(button) {
    button.closest('.attachment-item').remove();
}

function addLink() {
    const linkList = document.getElementById('externalLinks');
    const newLink = document.createElement('div');
    newLink.className = 'link-item mb-2';
    newLink.innerHTML = `
        <div class="row">
            <div class="col-md-4">
                <input type="text" class="form-control" name="external_links[${linkCount}][title]" placeholder="عنوان الرابط">
            </div>
            <div class="col-md-6">
                <input type="url" class="form-control" name="external_links[${linkCount}][url]" placeholder="https://...">
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger btn-sm" onclick="removeLink(this)">
                    <i class="bi bi-trash"></i>
                </button>
            </div>
        </div>
    `;
    linkList.appendChild(newLink);
    linkCount++;
}

function removeLink(button) {
    button.closest('.link-item').remove();
}

function addQuestion() {
    const questionList = document.getElementById('quizQuestions');
    const newQuestion = document.createElement('div');
    newQuestion.className = 'question-item mb-3 p-3 border rounded';
    newQuestion.innerHTML = `
        <div class="row">
            <div class="col-md-8">
                <input type="text" class="form-control mb-2" name="questions[${questionCount}][question]" placeholder="اكتب السؤال هنا...">
            </div>
            <div class="col-md-4">
                <select class="form-select" name="questions[${questionCount}][type]">
                    <option value="multiple_choice">اختيار متعدد</option>
                    <option value="true_false">صح وخطأ</option>
                    <option value="short_answer">إجابة قصيرة</option>
                </select>
            </div>
        </div>
        <div class="answers-section">
            <div class="answer-item mb-2">
                <div class="row">
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="questions[${questionCount}][answers][0]" placeholder="الإجابة الأولى">
                    </div>
                    <div class="col-md-2">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="questions[${questionCount}][correct]" value="0">
                            <label class="form-check-label">صحيح</label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-danger btn-sm" onclick="removeAnswer(this)">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-outline-secondary btn-sm" onclick="addAnswer(this)">
            <i class="bi bi-plus"></i> إضافة إجابة
        </button>
    `;
    questionList.appendChild(newQuestion);
    questionCount++;
}

function addAnswer(button) {
    const answersSection = button.previousElementSibling;
    const answerCount = answersSection.children.length;
    const newAnswer = document.createElement('div');
    newAnswer.className = 'answer-item mb-2';
    newAnswer.innerHTML = `
        <div class="row">
            <div class="col-md-8">
                <input type="text" class="form-control" name="questions[${questionCount-1}][answers][${answerCount}]" placeholder="إجابة إضافية">
            </div>
            <div class="col-md-2">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="questions[${questionCount-1}][correct]" value="${answerCount}">
                    <label class="form-check-label">صحيح</label>
                </div>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger btn-sm" onclick="removeAnswer(this)">
                    <i class="bi bi-trash"></i>
                </button>
            </div>
        </div>
    `;
    answersSection.appendChild(newAnswer);
}

function removeAnswer(button) {
    button.closest('.answer-item').remove();
}

document.addEventListener('DOMContentLoaded', function() {
    updateProgress();
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

.attachment-item, .link-item, .question-item {
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