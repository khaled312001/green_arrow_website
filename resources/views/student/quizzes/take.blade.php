@extends('layouts.student')

@section('title', $quiz->title_ar . ' - الاختبار')

@section('content')
<div class="container" style="max-width: 800px; margin: 0 auto; padding: 20px;">
    <div class="card">
        <div class="card-header" style="background: #f8fafc; padding: 20px; border-bottom: 1px solid #e5e7eb;">
            <h2 style="margin: 0; color: #1f2937;">{{ $quiz->title_ar }}</h2>
            <p style="margin: 10px 0 0 0; color: #6b7280;">{{ $quiz->description_ar }}</p>
        </div>
        
        <div class="card-body" style="padding: 20px;">
            <div style="background: #fef3c7; color: #92400e; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
                <h4 style="margin: 0 0 10px 0;">
                    <i class="bi bi-info-circle"></i>
                    معلومات الاختبار
                </h4>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px;">
                    <div>
                        <strong>عدد الأسئلة:</strong> {{ $questions->count() }}
                    </div>
                    <div>
                        <strong>الوقت المحدد:</strong> {{ $quiz->duration_minutes ?? 'غير محدد' }} دقيقة
                    </div>
                    <div>
                        <strong>درجة النجاح:</strong> {{ $quiz->passing_score ?? 70 }}%
                    </div>
                </div>
            </div>
            
            <form id="quizForm">
                @csrf
                @foreach($questions as $index => $question)
                <div class="question-card" style="background: white; border: 1px solid #e5e7eb; border-radius: 8px; padding: 20px; margin-bottom: 20px;">
                    <h4 style="margin: 0 0 15px 0; color: #1f2937;">
                        السؤال {{ $index + 1 }}: {{ $question->question_text_ar }}
                    </h4>
                    
                    <div class="options">
                        @foreach(['a', 'b', 'c', 'd'] as $option)
                            @if($question->{'option_' . $option})
                            <label style="display: block; margin-bottom: 10px; cursor: pointer;">
                                <input type="radio" 
                                       name="answers[{{ $question->id }}]" 
                                       value="{{ $option }}" 
                                       style="margin-left: 10px;">
                                <span style="margin-right: 10px; font-weight: 600; color: #10b981;">{{ strtoupper($option) }}.</span>
                                {{ $question->{'option_' . $option} }}
                            </label>
                            @endif
                        @endforeach
                    </div>
                </div>
                @endforeach
                
                <div style="text-align: center; margin-top: 30px;">
                    <button type="submit" class="btn btn-primary" style="background: #10b981; color: white; border: none; padding: 12px 30px; border-radius: 8px; font-size: 1.1rem; font-weight: 600;">
                        <i class="bi bi-check-circle"></i>
                        إرسال الإجابات
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('quizForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    // التحقق من إجابة جميع الأسئلة
    const questions = document.querySelectorAll('.question-card');
    let allAnswered = true;
    
    questions.forEach(question => {
        const radioButtons = question.querySelectorAll('input[type="radio"]');
        const answered = Array.from(radioButtons).some(radio => radio.checked);
        
        if (!answered) {
            allAnswered = false;
            question.style.borderColor = '#ef4444';
        } else {
            question.style.borderColor = '#e5e7eb';
        }
    });
    
    if (!allAnswered) {
        alert('يرجى الإجابة على جميع الأسئلة');
        return;
    }
    
    // إرسال الإجابات
    const formData = new FormData(this);
    
    fetch('{{ route("student.quizzes.submit", $quiz) }}', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(`تم إرسال إجاباتك بنجاح!\nالنتيجة: ${data.score}/${data.total} (${data.percentage.toFixed(1)}%)\n${data.is_passed ? 'مبروك! لقد نجحت في الاختبار' : 'للأسف لم تنجح في الاختبار'}`);
            window.location.href = data.redirect_url;
        } else {
            alert('حدث خطأ أثناء إرسال الإجابات');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('حدث خطأ أثناء إرسال الإجابات');
    });
});
</script>

<style>
.question-card:hover {
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.options label:hover {
    background: #f8fafc;
    padding: 5px;
    border-radius: 4px;
}

.btn:hover {
    background: #059669 !important;
    transform: translateY(-1px);
}
</style>
@endsection 