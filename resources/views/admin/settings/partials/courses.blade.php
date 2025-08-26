<div class="setting-group">
    <h5>إعدادات الدورات</h5>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="max_course_duration" class="form-label">أقصى مدة للدورة (بالساعات)</label>
            <input type="number" class="form-control" id="max_course_duration" name="settings[max_course_duration]" 
                   value="{{ $settings['courses']['max_course_duration'] ?? 100 }}" min="1" max="1000">
            <div class="form-text">أقصى مدة مسموحة للدورة الواحدة</div>
        </div>
        <div class="col-md-6 mb-3">
            <label for="max_lessons_per_course" class="form-label">أقصى عدد للدروس في الدورة</label>
            <input type="number" class="form-control" id="max_lessons_per_course" name="settings[max_lessons_per_course]" 
                   value="{{ $settings['courses']['max_lessons_per_course'] ?? 50 }}" min="1" max="200">
            <div class="form-text">أقصى عدد للدروس في الدورة الواحدة</div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="course_approval_required" class="form-label">تتطلب الموافقة على الدورات</label>
            <select class="form-select" id="course_approval_required" name="settings[course_approval_required]">
                <option value="1" {{ ($settings['courses']['course_approval_required'] ?? 1) == 1 ? 'selected' : '' }}>نعم</option>
                <option value="0" {{ ($settings['courses']['course_approval_required'] ?? 1) == 0 ? 'selected' : '' }}>لا</option>
            </select>
            <div class="form-text">هل تتطلب الدورات موافقة قبل النشر</div>
        </div>
        <div class="col-md-6 mb-3">
            <label for="allow_course_preview" class="form-label">السماح بمعاينة الدورات</label>
            <select class="form-select" id="allow_course_preview" name="settings[allow_course_preview]">
                <option value="1" {{ ($settings['courses']['allow_course_preview'] ?? 1) == 1 ? 'selected' : '' }}>نعم</option>
                <option value="0" {{ ($settings['courses']['allow_course_preview'] ?? 1) == 0 ? 'selected' : '' }}>لا</option>
            </select>
            <div class="form-text">السماح للمستخدمين بمعاينة الدورات</div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="free_courses_allowed" class="form-label">السماح بالدورات المجانية</label>
            <select class="form-select" id="free_courses_allowed" name="settings[free_courses_allowed]">
                <option value="1" {{ ($settings['courses']['free_courses_allowed'] ?? 1) == 1 ? 'selected' : '' }}>نعم</option>
                <option value="0" {{ ($settings['courses']['free_courses_allowed'] ?? 1) == 0 ? 'selected' : '' }}>لا</option>
            </select>
            <div class="form-text">السماح بإنشاء دورات مجانية</div>
        </div>
        <div class="col-md-6 mb-3">
            <label for="course_certificate_enabled" class="form-label">تفعيل شهادات الدورات</label>
            <select class="form-select" id="course_certificate_enabled" name="settings[course_certificate_enabled]">
                <option value="1" {{ ($settings['courses']['course_certificate_enabled'] ?? 1) == 1 ? 'selected' : '' }}>نعم</option>
                <option value="0" {{ ($settings['courses']['course_certificate_enabled'] ?? 1) == 0 ? 'selected' : '' }}>لا</option>
            </select>
            <div class="form-text">تفعيل إصدار شهادات إتمام الدورات</div>
        </div>
    </div>
</div> 