<div class="setting-group">
    <h5><i class="bi bi-gear"></i> معلومات الموقع الأساسية</h5>
    <p class="text-muted">المعلومات الأساسية التي تظهر في جميع أنحاء الموقع</p>
    
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="site_name" class="form-label">اسم الموقع</label>
            <input type="text" class="form-control" id="site_name" name="settings[site_name]" 
                   value="{{ $settings['site']['site_name'] ?? 'أكاديمية السهم الأخضر للتدريب' }}">
            <div class="form-text">اسم الموقع كما يظهر في المتصفح</div>
        </div>
        <div class="col-md-6 mb-3">
            <label for="site_description" class="form-label">وصف الموقع</label>
            <input type="text" class="form-control" id="site_description" name="settings[site_description]" 
                   value="{{ $settings['site']['site_description'] ?? '' }}">
            <div class="form-text">وصف الموقع للمحركات البحث</div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="site_email" class="form-label">
                <i class="bi bi-envelope"></i> البريد الإلكتروني
            </label>
            <input type="email" class="form-control" id="site_email" name="settings[site_email]" 
                   value="{{ $settings['site']['site_email'] ?? 'greenarrowacademic@gmail.com' }}">
            <div class="form-text">البريد الإلكتروني الرئيسي للموقع</div>
        </div>
        <div class="col-md-6 mb-3">
            <label for="site_phone" class="form-label">
                <i class="bi bi-telephone"></i> رقم الهاتف
            </label>
            <input type="text" class="form-control" id="site_phone" name="settings[site_phone]" 
                   value="{{ $settings['site']['site_phone'] ?? '' }}">
            <div class="form-text">رقم الهاتف الرئيسي</div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="site_whatsapp" class="form-label">
                <i class="bi bi-whatsapp text-success"></i> رقم الواتساب
            </label>
            <input type="text" class="form-control" id="site_whatsapp" name="settings[site_whatsapp]" 
                   value="{{ $settings['site']['site_whatsapp'] ?? '' }}">
            <div class="form-text">رقم الواتساب للتواصل المباشر</div>
        </div>
        <div class="col-md-6 mb-3">
            <label for="site_address" class="form-label">
                <i class="bi bi-geo-alt"></i> العنوان
            </label>
            <input type="text" class="form-control" id="site_address" name="settings[site_address]" 
                   value="{{ $settings['site']['site_address'] ?? '' }}">
            <div class="form-text">عنوان الموقع</div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="site_working_hours" class="form-label">
                <i class="bi bi-clock"></i> ساعات العمل
            </label>
            <input type="text" class="form-control" id="site_working_hours" name="settings[site_working_hours]" 
                   value="{{ $settings['site']['site_working_hours'] ?? '' }}">
            <div class="form-text">ساعات العمل الرسمية</div>
        </div>
    </div>
</div> 