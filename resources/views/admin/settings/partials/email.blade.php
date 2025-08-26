<div class="setting-group">
    <h5>إعدادات البريد الإلكتروني</h5>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="mail_from_address" class="form-label">عنوان المرسل</label>
            <input type="email" class="form-control" id="mail_from_address" name="settings[mail_from_address]" 
                   value="{{ $settings['email']['mail_from_address'] ?? '' }}">
            <div class="form-text">عنوان البريد الإلكتروني للمرسل</div>
        </div>
        <div class="col-md-6 mb-3">
            <label for="mail_from_name" class="form-label">اسم المرسل</label>
            <input type="text" class="form-control" id="mail_from_name" name="settings[mail_from_name]" 
                   value="{{ $settings['email']['mail_from_name'] ?? '' }}">
            <div class="form-text">اسم المرسل في البريد الإلكتروني</div>
        </div>
    </div>
</div>

<div class="setting-group">
    <h5>تفعيل أنواع البريد الإلكتروني</h5>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="welcome_email_enabled" class="form-label">تفعيل بريد الترحيب</label>
            <select class="form-select" id="welcome_email_enabled" name="settings[welcome_email_enabled]">
                <option value="1" {{ ($settings['email']['welcome_email_enabled'] ?? 1) == 1 ? 'selected' : '' }}>نعم</option>
                <option value="0" {{ ($settings['email']['welcome_email_enabled'] ?? 1) == 0 ? 'selected' : '' }}>لا</option>
            </select>
            <div class="form-text">إرسال بريد ترحيب للمستخدمين الجدد</div>
        </div>
        <div class="col-md-6 mb-3">
            <label for="course_completion_email" class="form-label">بريد إكمال الدورة</label>
            <select class="form-select" id="course_completion_email" name="settings[course_completion_email]">
                <option value="1" {{ ($settings['email']['course_completion_email'] ?? 1) == 1 ? 'selected' : '' }}>نعم</option>
                <option value="0" {{ ($settings['email']['course_completion_email'] ?? 1) == 0 ? 'selected' : '' }}>لا</option>
            </select>
            <div class="form-text">إرسال بريد عند إكمال الدورة</div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="payment_confirmation_email" class="form-label">بريد تأكيد الدفع</label>
            <select class="form-select" id="payment_confirmation_email" name="settings[payment_confirmation_email]">
                <option value="1" {{ ($settings['email']['payment_confirmation_email'] ?? 1) == 1 ? 'selected' : '' }}>نعم</option>
                <option value="0" {{ ($settings['email']['payment_confirmation_email'] ?? 1) == 0 ? 'selected' : '' }}>لا</option>
            </select>
            <div class="form-text">إرسال بريد تأكيد الدفع</div>
        </div>
        <div class="col-md-6 mb-3">
            <label for="newsletter_enabled" class="form-label">تفعيل النشرة الإخبارية</label>
            <select class="form-select" id="newsletter_enabled" name="settings[newsletter_enabled]">
                <option value="1" {{ ($settings['email']['newsletter_enabled'] ?? 1) == 1 ? 'selected' : '' }}>نعم</option>
                <option value="0" {{ ($settings['email']['newsletter_enabled'] ?? 1) == 0 ? 'selected' : '' }}>لا</option>
            </select>
            <div class="form-text">تفعيل إرسال النشرة الإخبارية</div>
        </div>
    </div>
</div> 