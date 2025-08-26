<div class="setting-group">
    <h5>إعدادات SEO الأساسية</h5>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="site_title" class="form-label">عنوان الموقع</label>
            <input type="text" class="form-control" id="site_title" name="settings[site_title]" 
                   value="{{ $settings['seo']['site_title'] ?? '' }}" maxlength="60">
            <div class="form-text">عنوان الموقع للمحركات البحث (أقصى 60 حرف)</div>
        </div>
        <div class="col-md-6 mb-3">
            <label for="site_keywords" class="form-label">كلمات مفتاحية</label>
            <input type="text" class="form-control" id="site_keywords" name="settings[site_keywords]" 
                   value="{{ $settings['seo']['site_keywords'] ?? '' }}">
            <div class="form-text">الكلمات المفتاحية للموقع (مفصولة بفواصل)</div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="site_author" class="form-label">مؤلف الموقع</label>
            <input type="text" class="form-control" id="site_author" name="settings[site_author]" 
                   value="{{ $settings['seo']['site_author'] ?? '' }}">
            <div class="form-text">مؤلف الموقع</div>
        </div>
        <div class="col-md-6 mb-3">
            <label for="twitter_card" class="form-label">نوع بطاقة تويتر</label>
            <select class="form-select" id="twitter_card" name="settings[twitter_card]">
                <option value="summary" {{ ($settings['seo']['twitter_card'] ?? 'summary_large_image') == 'summary' ? 'selected' : '' }}>ملخص</option>
                <option value="summary_large_image" {{ ($settings['seo']['twitter_card'] ?? 'summary_large_image') == 'summary_large_image' ? 'selected' : '' }}>ملخص مع صورة كبيرة</option>
                <option value="app" {{ ($settings['seo']['twitter_card'] ?? 'summary_large_image') == 'app' ? 'selected' : '' }}>تطبيق</option>
                <option value="player" {{ ($settings['seo']['twitter_card'] ?? 'summary_large_image') == 'player' ? 'selected' : '' }}>مشغل</option>
            </select>
            <div class="form-text">نوع بطاقة المشاركة في تويتر</div>
        </div>
    </div>
</div>

<div class="setting-group">
    <h5>Open Graph (وسائل التواصل الاجتماعي)</h5>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="og_title" class="form-label">عنوان Open Graph</label>
            <input type="text" class="form-control" id="og_title" name="settings[og_title]" 
                   value="{{ $settings['seo']['og_title'] ?? '' }}" maxlength="60">
            <div class="form-text">عنوان المشاركة في وسائل التواصل (أقصى 60 حرف)</div>
        </div>
        <div class="col-md-6 mb-3">
            <label for="og_description" class="form-label">وصف Open Graph</label>
            <input type="text" class="form-control" id="og_description" name="settings[og_description]" 
                   value="{{ $settings['seo']['og_description'] ?? '' }}" maxlength="160">
            <div class="form-text">وصف المشاركة في وسائل التواصل (أقصى 160 حرف)</div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="og_image" class="form-label">صورة Open Graph</label>
            <input type="file" class="form-control" id="og_image" name="settings[og_image]" accept="image/*">
            @if($settings['seo']['og_image'] ?? false)
                <div class="mt-2">
                    <img src="{{ $settings['seo']['og_image'] }}" alt="صورة Open Graph الحالية" class="file-preview">
                </div>
            @endif
            <div class="form-text">صورة المشاركة في وسائل التواصل (يفضل 1200x630)</div>
        </div>
    </div>
</div>

<div class="setting-group">
    <h5>أدوات التحليل والتتبع</h5>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="google_analytics" class="form-label">رمز Google Analytics</label>
            <input type="text" class="form-control" id="google_analytics" name="settings[google_analytics]" 
                   value="{{ $settings['seo']['google_analytics'] ?? '' }}" maxlength="20">
            <div class="form-text">رمز تتبع Google Analytics (G-XXXXXXXXXX)</div>
        </div>
        <div class="col-md-6 mb-3">
            <label for="google_search_console" class="form-label">رمز Google Search Console</label>
            <input type="text" class="form-control" id="google_search_console" name="settings[google_search_console]" 
                   value="{{ $settings['seo']['google_search_console'] ?? '' }}" maxlength="100">
            <div class="form-text">رمز التحقق من Google Search Console</div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="bing_webmaster" class="form-label">رمز Bing Webmaster</label>
            <input type="text" class="form-control" id="bing_webmaster" name="settings[bing_webmaster]" 
                   value="{{ $settings['seo']['bing_webmaster'] ?? '' }}" maxlength="100">
            <div class="form-text">رمز التحقق من Bing Webmaster</div>
        </div>
    </div>
</div> 