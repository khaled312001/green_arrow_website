<div class="setting-group">
    <h5><i class="bi bi-bell"></i> إعدادات الإشعارات</h5>
    <p class="text-muted">تخصيص إعدادات الإشعارات للموقع</p>
    
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="email_notifications" class="form-label">
                <i class="bi bi-envelope"></i> إشعارات البريد الإلكتروني
            </label>
            <select class="form-select" id="email_notifications" name="settings[notifications][email_enabled]">
                <option value="1" {{ ($settings['notifications']['email_enabled'] ?? true) ? 'selected' : '' }}>مفعل</option>
                <option value="0" {{ !($settings['notifications']['email_enabled'] ?? true) ? 'selected' : '' }}>معطل</option>
            </select>
            <div class="form-text">تفعيل إرسال الإشعارات عبر البريد الإلكتروني</div>
        </div>
        <div class="col-md-6 mb-3">
            <label for="sms_notifications" class="form-label">
                <i class="bi bi-phone"></i> إشعارات الرسائل النصية
            </label>
            <select class="form-select" id="sms_notifications" name="settings[notifications][sms_enabled]">
                <option value="1" {{ ($settings['notifications']['sms_enabled'] ?? false) ? 'selected' : '' }}>مفعل</option>
                <option value="0" {{ !($settings['notifications']['sms_enabled'] ?? false) ? 'selected' : '' }}>معطل</option>
            </select>
            <div class="form-text">تفعيل إرسال الإشعارات عبر الرسائل النصية</div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="push_notifications" class="form-label">
                <i class="bi bi-bell"></i> الإشعارات الفورية
            </label>
            <select class="form-select" id="push_notifications" name="settings[notifications][push_enabled]">
                <option value="1" {{ ($settings['notifications']['push_enabled'] ?? true) ? 'selected' : '' }}>مفعل</option>
                <option value="0" {{ !($settings['notifications']['push_enabled'] ?? true) ? 'selected' : '' }}>معطل</option>
            </select>
            <div class="form-text">تفعيل الإشعارات الفورية في المتصفح</div>
        </div>
        <div class="col-md-6 mb-3">
            <label for="whatsapp_notifications" class="form-label">
                <i class="bi bi-whatsapp"></i> إشعارات الواتساب
            </label>
            <select class="form-select" id="whatsapp_notifications" name="settings[notifications][whatsapp_enabled]">
                <option value="1" {{ ($settings['notifications']['whatsapp_enabled'] ?? false) ? 'selected' : '' }}>مفعل</option>
                <option value="0" {{ !($settings['notifications']['whatsapp_enabled'] ?? false) ? 'selected' : '' }}>معطل</option>
            </select>
            <div class="form-text">تفعيل إرسال الإشعارات عبر الواتساب</div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="notification_sound" class="form-label">
                <i class="bi bi-volume-up"></i> صوت الإشعارات
            </label>
            <select class="form-select" id="notification_sound" name="settings[notifications][sound_enabled]">
                <option value="1" {{ ($settings['notifications']['sound_enabled'] ?? true) ? 'selected' : '' }}>مفعل</option>
                <option value="0" {{ !($settings['notifications']['sound_enabled'] ?? true) ? 'selected' : '' }}>معطل</option>
            </select>
            <div class="form-text">تفعيل صوت الإشعارات في المتصفح</div>
        </div>
        <div class="col-md-6 mb-3">
            <label for="notification_frequency" class="form-label">
                <i class="bi bi-clock"></i> تكرار الإشعارات
            </label>
            <select class="form-select" id="notification_frequency" name="settings[notifications][frequency]">
                <option value="immediate" {{ ($settings['notifications']['frequency'] ?? 'immediate') == 'immediate' ? 'selected' : '' }}>فوري</option>
                <option value="hourly" {{ ($settings['notifications']['frequency'] ?? 'immediate') == 'hourly' ? 'selected' : '' }}>كل ساعة</option>
                <option value="daily" {{ ($settings['notifications']['frequency'] ?? 'immediate') == 'daily' ? 'selected' : '' }}>يومي</option>
                <option value="weekly" {{ ($settings['notifications']['frequency'] ?? 'immediate') == 'weekly' ? 'selected' : '' }}>أسبوعي</option>
            </select>
            <div class="form-text">تكرار إرسال الإشعارات</div>
        </div>
    </div>
    
    <div class="alert alert-info">
        <i class="bi bi-info-circle"></i>
        <strong>ملاحظة:</strong> يمكن للمستخدمين تخصيص إعدادات الإشعارات الخاصة بهم من لوحة التحكم الخاصة بهم.
    </div>
</div> 