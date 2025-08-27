<div class="setting-group">
    <h5>الشعار والعلامة التجارية</h5>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="site_logo" class="form-label">شعار الموقع</label>
            <input type="file" class="form-control" id="site_logo" name="settings[appearance][site_logo]" accept="image/*">
            @if($settings['appearance']['site_logo'] ?? false)
                <div class="mt-2">
                    <img src="{{ $settings['appearance']['site_logo'] }}" alt="الشعار الحالي" class="file-preview">
                </div>
            @endif
            <div class="form-text">الشعار الرئيسي للموقع (يفضل PNG مع خلفية شفافة)</div>
        </div>
        <div class="col-md-6 mb-3">
            <label for="site_logo_light" class="form-label">الشعار الفاتح</label>
            <input type="file" class="form-control" id="site_logo_light" name="settings[appearance][site_logo_light]" accept="image/*">
            @if($settings['appearance']['site_logo_light'] ?? false)
                <div class="mt-2">
                    <img src="{{ $settings['appearance']['site_logo_light'] }}" alt="الشعار الفاتح الحالي" class="file-preview">
                </div>
            @endif
            <div class="form-text">الشعار للخلفيات الداكنة</div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="site_favicon" class="form-label">أيقونة الموقع</label>
            <input type="file" class="form-control" id="site_favicon" name="settings[appearance][site_favicon]" accept="image/*">
            @if($settings['appearance']['site_favicon'] ?? false)
                <div class="mt-2">
                    <img src="{{ $settings['appearance']['site_favicon'] }}" alt="الأيقونة الحالية" class="file-preview">
                </div>
            @endif
            <div class="form-text">أيقونة الموقع في المتصفح (يفضل 32x32 أو 16x16)</div>
        </div>
    </div>
</div>

<div class="setting-group">
    <h5>الألوان والتصميم</h5>
    <div class="row">
        <div class="col-md-4 mb-3">
            <label for="site_primary_color" class="form-label">اللون الأساسي</label>
            <div class="d-flex align-items-center">
                <div class="color-preview" style="background-color: {{ $settings['appearance']['site_primary_color'] ?? '#10b981' }}"></div>
                <input type="color" class="form-control form-control-color" id="site_primary_color" name="settings[appearance][site_primary_color]" 
                       value="{{ $settings['appearance']['site_primary_color'] ?? '#10b981' }}">
            </div>
            <div class="form-text">اللون الأساسي للموقع</div>
        </div>
        <div class="col-md-4 mb-3">
            <label for="site_secondary_color" class="form-label">اللون الثانوي</label>
            <div class="d-flex align-items-center">
                <div class="color-preview" style="background-color: {{ $settings['appearance']['site_secondary_color'] ?? '#1f2937' }}"></div>
                <input type="color" class="form-control form-control-color" id="site_secondary_color" name="settings[appearance][site_secondary_color]" 
                       value="{{ $settings['appearance']['site_secondary_color'] ?? '#1f2937' }}">
            </div>
            <div class="form-text">اللون الثانوي للموقع</div>
        </div>
        <div class="col-md-4 mb-3">
            <label for="site_accent_color" class="form-label">لون التمييز</label>
            <div class="d-flex align-items-center">
                <div class="color-preview" style="background-color: {{ $settings['appearance']['site_accent_color'] ?? '#f59e0b' }}"></div>
                <input type="color" class="form-control form-control-color" id="site_accent_color" name="settings[appearance][site_accent_color]" 
                       value="{{ $settings['appearance']['site_accent_color'] ?? '#f59e0b' }}">
            </div>
            <div class="form-text">لون التمييز للموقع</div>
        </div>
    </div>
</div> 