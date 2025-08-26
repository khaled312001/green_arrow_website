<div class="setting-group">
    <h5>إعدادات النظام الأساسية</h5>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="maintenance_mode" class="form-label">وضع الصيانة</label>
            <select class="form-select" id="maintenance_mode" name="settings[maintenance_mode]">
                <option value="0" {{ ($settings['system']['maintenance_mode'] ?? 0) == 0 ? 'selected' : '' }}>معطل</option>
                <option value="1" {{ ($settings['system']['maintenance_mode'] ?? 0) == 1 ? 'selected' : '' }}>مفعل</option>
            </select>
            <div class="form-text">تفعيل وضع الصيانة للموقع</div>
        </div>
        <div class="col-md-6 mb-3">
            <label for="maintenance_message" class="form-label">رسالة الصيانة</label>
            <input type="text" class="form-control" id="maintenance_message" name="settings[maintenance_message]" 
                   value="{{ $settings['system']['maintenance_message'] ?? '' }}">
            <div class="form-text">الرسالة المعروضة في وضع الصيانة</div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="user_registration_enabled" class="form-label">تفعيل التسجيل</label>
            <select class="form-select" id="user_registration_enabled" name="settings[user_registration_enabled]">
                <option value="1" {{ ($settings['system']['user_registration_enabled'] ?? 1) == 1 ? 'selected' : '' }}>نعم</option>
                <option value="0" {{ ($settings['system']['user_registration_enabled'] ?? 1) == 0 ? 'selected' : '' }}>لا</option>
            </select>
            <div class="form-text">السماح للمستخدمين الجدد بالتسجيل</div>
        </div>
        <div class="col-md-6 mb-3">
            <label for="email_verification_required" class="form-label">تأكيد البريد الإلكتروني</label>
            <select class="form-select" id="email_verification_required" name="settings[email_verification_required]">
                <option value="1" {{ ($settings['system']['email_verification_required'] ?? 1) == 1 ? 'selected' : '' }}>نعم</option>
                <option value="0" {{ ($settings['system']['email_verification_required'] ?? 1) == 0 ? 'selected' : '' }}>لا</option>
            </select>
            <div class="form-text">تطلب تأكيد البريد الإلكتروني</div>
        </div>
    </div>
</div>

<div class="setting-group">
    <h5>إعدادات الملفات والأمان</h5>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="max_file_upload_size" class="form-label">أقصى حجم للملفات (MB)</label>
            <input type="number" class="form-control" id="max_file_upload_size" name="settings[max_file_upload_size]" 
                   value="{{ $settings['system']['max_file_upload_size'] ?? 10 }}" min="1" max="100">
            <div class="form-text">أقصى حجم للملفات المرفوعة بالميجابايت</div>
        </div>
        <div class="col-md-6 mb-3">
            <label for="allowed_file_types" class="form-label">أنواع الملفات المسموحة</label>
            <input type="text" class="form-control" id="allowed_file_types" name="settings[allowed_file_types]" 
                   value="{{ $settings['system']['allowed_file_types'] ?? '' }}">
            <div class="form-text">أنواع الملفات المسموح برفعها (مفصولة بفواصل)</div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="session_timeout" class="form-label">مهلة الجلسة (دقائق)</label>
            <input type="number" class="form-control" id="session_timeout" name="settings[session_timeout]" 
                   value="{{ $settings['system']['session_timeout'] ?? 120 }}" min="15" max="1440">
            <div class="form-text">مهلة الجلسة بالدقائق</div>
        </div>
        <div class="col-md-6 mb-3">
            <label for="password_min_length" class="form-label">أقل طول لكلمة المرور</label>
            <input type="number" class="form-control" id="password_min_length" name="settings[password_min_length]" 
                   value="{{ $settings['system']['password_min_length'] ?? 8 }}" min="6" max="50">
            <div class="form-text">أقل طول مطلوب لكلمة المرور</div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="password_require_special" class="form-label">تطلب رموز خاصة</label>
            <select class="form-select" id="password_require_special" name="settings[password_require_special]">
                <option value="1" {{ ($settings['system']['password_require_special'] ?? 1) == 1 ? 'selected' : '' }}>نعم</option>
                <option value="0" {{ ($settings['system']['password_require_special'] ?? 1) == 0 ? 'selected' : '' }}>لا</option>
            </select>
            <div class="form-text">تطلب كلمة المرور رموز خاصة</div>
        </div>
    </div>
</div> 