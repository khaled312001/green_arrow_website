@extends('layouts.admin')

@section('title', 'إدارة أسئلة الكويز - لوحة الإدارة')

@section('content')
<div class="content-area">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="card-title">إدارة أسئلة الكويز</h2>
                            <p class="text-muted mb-0">{{ $quiz->title_ar }}</p>
                        </div>
                        <div>
                            <a href="{{ route('admin.courses.quizzes', $quiz->course) }}" class="btn btn-secondary me-2">
                                <i class="bi bi-arrow-right"></i>
                                العودة للكويزات
                            </a>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addQuestionModal">
                                <i class="bi bi-plus-circle"></i>
                                إضافة سؤال جديد
                            </button>
                        </div>
                    </div>
                </div>
                
                <div class="card-body">
                    @if($questions->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>السؤال</th>
                                        <th>النوع</th>
                                        <th>النقاط</th>
                                        <th>الحالة</th>
                                        <th>الإجراءات</th>
                                    </tr>
                                </thead>
                                <tbody id="questionsTable">
                                    @foreach($questions as $question)
                                        <tr data-id="{{ $question->id }}">
                                            <td>{{ $question->sort_order }}</td>
                                            <td>
                                                <div>
                                                    <strong>{{ $question->question_ar }}</strong>
                                                    @if($question->question_en)
                                                        <br><small class="text-muted">{{ $question->question_en }}</small>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge bg-secondary">{{ $question->type_text }}</span>
                                            </td>
                                            <td>{{ $question->points }}</td>
                                            <td>
                                                @if($question->is_active)
                                                    <span class="badge bg-success">نشط</span>
                                                @else
                                                    <span class="badge bg-secondary">غير نشط</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <button type="button" class="btn btn-sm btn-outline-primary" 
                                                            onclick="editQuestion({{ $question->id }})" title="تعديل">
                                                        <i class="bi bi-pencil"></i>
                                                    </button>
                                                    <form method="POST" action="{{ route('admin.quizzes.questions.delete', [$quiz, $question]) }}" 
                                                          class="d-inline" onsubmit="return confirm('هل أنت متأكد من حذف هذا السؤال؟')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="حذف">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="mt-3">
                            <h5>ملخص الكويز</h5>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="card bg-primary text-white">
                                        <div class="card-body text-center">
                                            <h4>{{ $questions->count() }}</h4>
                                            <small>إجمالي الأسئلة</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card bg-success text-white">
                                        <div class="card-body text-center">
                                            <h4>{{ $quiz->total_points }}</h4>
                                            <small>إجمالي النقاط</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card bg-info text-white">
                                        <div class="card-body text-center">
                                            <h4>{{ $quiz->duration_minutes }}</h4>
                                            <small>المدة (دقائق)</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card bg-warning text-white">
                                        <div class="card-body text-center">
                                            <h4>{{ $quiz->passing_score }}%</h4>
                                            <small>نسبة النجاح</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="bi bi-question-circle text-muted" style="font-size: 4rem;"></i>
                            <h4 class="mt-3 text-muted">لا توجد أسئلة لهذا الكويز</h4>
                            <p class="text-muted">ابدأ بإضافة أول سؤال للكويز</p>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addQuestionModal">
                                <i class="bi bi-plus-circle"></i>
                                إضافة سؤال جديد
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal إضافة سؤال جديد -->
<div class="modal fade" id="addQuestionModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">إضافة سؤال جديد</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="{{ route('admin.quizzes.questions.store', $quiz) }}">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="question_ar" class="form-label">السؤال (عربي) *</label>
                            <textarea class="form-control" id="question_ar" name="question_ar" rows="3" required></textarea>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="question_en" class="form-label">السؤال (إنجليزي)</label>
                            <textarea class="form-control" id="question_en" name="question_en" rows="3"></textarea>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="type" class="form-label">نوع السؤال *</label>
                            <select class="form-select" id="type" name="type" required>
                                <option value="">اختر نوع السؤال</option>
                                <option value="multiple_choice">اختيار متعدد</option>
                                <option value="true_false">صح أو خطأ</option>
                                <option value="fill_blank">ملء الفراغ</option>
                                <option value="essay">مقالي</option>
                            </select>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="points" class="form-label">النقاط *</label>
                            <input type="number" class="form-control" id="points" name="points" value="1" min="1" required>
                        </div>
                        
                        <!-- خيارات السؤال متعدد الخيارات -->
                        <div class="col-12 mb-3 multiple-choice-options" style="display: none;">
                            <label class="form-label">خيارات الإجابة</label>
                            <div id="optionsContainer">
                                <div class="row mb-2">
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="options[]" placeholder="الخيار الأول">
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="correct_answer" value="0">
                                            <label class="form-check-label">الإجابة الصحيحة</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="options[]" placeholder="الخيار الثاني">
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="correct_answer" value="1">
                                            <label class="form-check-label">الإجابة الصحيحة</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-sm btn-outline-primary" onclick="addOption()">
                                <i class="bi bi-plus"></i> إضافة خيار
                            </button>
                        </div>
                        
                        <!-- الإجابة الصحيحة -->
                        <div class="col-md-6 mb-3 correct-answer-field" style="display: none;">
                            <label for="correct_answer" class="form-label">الإجابة الصحيحة</label>
                            <input type="text" class="form-control" id="correct_answer" name="correct_answer">
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" checked>
                                <label class="form-check-label" for="is_active">
                                    نشط
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                    <button type="submit" class="btn btn-primary">حفظ السؤال</button>
                </div>
            </form>
        </div>
    </div>
</div>

@if($questions->count() > 0)
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const tbody = document.getElementById('questionsTable');
    
    new Sortable(tbody, {
        animation: 150,
        onEnd: function(evt) {
            const rows = Array.from(tbody.querySelectorAll('tr'));
            const orderData = rows.map((row, index) => ({
                id: row.dataset.id,
                sort_order: index + 1
            }));
            
            // تحديث ترتيب الأسئلة
            fetch('{{ route("admin.quizzes.questions.reorder", $quiz) }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ questions: orderData })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // تحديث أرقام الترتيب في الجدول
                    rows.forEach((row, index) => {
                        row.querySelector('td:first-child').textContent = index + 1;
                    });
                }
            });
        }
    });
});

// إظهار/إخفاء الحقول حسب نوع السؤال
document.getElementById('type').addEventListener('change', function() {
    const type = this.value;
    const multipleChoiceOptions = document.querySelector('.multiple-choice-options');
    const correctAnswerField = document.querySelector('.correct-answer-field');
    
    multipleChoiceOptions.style.display = 'none';
    correctAnswerField.style.display = 'none';
    
    if (type === 'multiple_choice') {
        multipleChoiceOptions.style.display = 'block';
    } else if (type === 'true_false') {
        correctAnswerField.style.display = 'block';
        document.getElementById('correct_answer').placeholder = 'صح أو خطأ';
    } else if (type === 'fill_blank') {
        correctAnswerField.style.display = 'block';
        document.getElementById('correct_answer').placeholder = 'الإجابة الصحيحة';
    }
});

// إضافة خيار جديد
function addOption() {
    const container = document.getElementById('optionsContainer');
    const optionCount = container.children.length;
    
    const newOption = document.createElement('div');
    newOption.className = 'row mb-2';
    newOption.innerHTML = `
        <div class="col-md-8">
            <input type="text" class="form-control" name="options[]" placeholder="الخيار ${optionCount + 1}">
        </div>
        <div class="col-md-4">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="correct_answer" value="${optionCount}">
                <label class="form-check-label">الإجابة الصحيحة</label>
            </div>
        </div>
    `;
    
    container.appendChild(newOption);
}
</script>
@endif

<style>
.table tbody tr {
    cursor: move;
}

.table tbody tr:hover {
    background-color: #f8f9fa;
}

.btn-group .btn {
    margin-right: 2px;
}

.badge {
    font-size: 0.75rem;
}

.card {
    border: none;
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
}
</style>
@endsection 