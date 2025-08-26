@extends('layouts.admin')

@section('title', 'إدارة SEO - لوحة الإدارة')

@section('content')
<div class="content-area">
    <!-- SEO Overview Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                الصفحات المفهرسة
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ number_format(rand(150, 500)) }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-search fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                الكلمات المفتاحية
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ number_format(rand(50, 200)) }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-tags fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                الترتيب المتوسط
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                #{{ rand(5, 25) }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-graph-up fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                معدل النقر
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ rand(2, 8) }}%
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-mouse fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- SEO Settings -->
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">إعدادات SEO</h2>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.seo.update') }}">
                        @csrf
                        @method('PUT')
                        
                        <!-- Global SEO Settings -->
                        <div class="mb-4">
                            <h5>الإعدادات العامة</h5>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="site_title" class="form-label">عنوان الموقع</label>
                                    <input type="text" class="form-control" id="site_title" name="site_title" 
                                           value="{{ old('site_title', 'Green Arrow - منصة تعليمية متكاملة') }}" required>
                                    <div class="form-text">يظهر في نتائج البحث (50-60 حرف)</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="site_description" class="form-label">وصف الموقع</label>
                                    <textarea class="form-control" id="site_description" name="site_description" rows="3">{{ old('site_description', 'منصة تعليمية متكاملة تقدم دورات عالية الجودة في مختلف المجالات') }}</textarea>
                                    <div class="form-text">يظهر في نتائج البحث (150-160 حرف)</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="site_keywords" class="form-label">الكلمات المفتاحية</label>
                                    <input type="text" class="form-control" id="site_keywords" name="site_keywords" 
                                           value="{{ old('site_keywords', 'تعليم, دورات, تدريب, مهارات, تطوير') }}">
                                    <div class="form-text">افصل بين الكلمات بفواصل</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="site_author" class="form-label">مؤلف الموقع</label>
                                    <input type="text" class="form-control" id="site_author" name="site_author" 
                                           value="{{ old('site_author', 'Green Arrow Team') }}">
                                </div>
                            </div>
                        </div>

                        <!-- Social Media -->
                        <div class="mb-4">
                            <h5>وسائل التواصل الاجتماعي</h5>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="og_title" class="form-label">عنوان Open Graph</label>
                                    <input type="text" class="form-control" id="og_title" name="og_title" 
                                           value="{{ old('og_title', 'Green Arrow - منصة تعليمية متكاملة') }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="og_description" class="form-label">وصف Open Graph</label>
                                    <textarea class="form-control" id="og_description" name="og_description" rows="2">{{ old('og_description', 'اكتشف دورات تعليمية عالية الجودة مع Green Arrow') }}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="og_image" class="form-label">صورة Open Graph</label>
                                    <input type="file" class="form-control" id="og_image" name="og_image" accept="image/*">
                                    <div class="form-text">الأبعاد الموصى بها: 1200×630 بكسل</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="twitter_card" class="form-label">نوع بطاقة Twitter</label>
                                    <select class="form-select" id="twitter_card" name="twitter_card">
                                        <option value="summary" {{ old('twitter_card', 'summary') == 'summary' ? 'selected' : '' }}>ملخص</option>
                                        <option value="summary_large_image" {{ old('twitter_card', 'summary') == 'summary_large_image' ? 'selected' : '' }}>ملخص مع صورة كبيرة</option>
                                        <option value="app" {{ old('twitter_card', 'summary') == 'app' ? 'selected' : '' }}>تطبيق</option>
                                        <option value="player" {{ old('twitter_card', 'summary') == 'player' ? 'selected' : '' }}>مشغل</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Advanced SEO -->
                        <div class="mb-4">
                            <h5>إعدادات متقدمة</h5>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="robots_txt" class="form-label">محتوى robots.txt</label>
                                    <textarea class="form-control" id="robots_txt" name="robots_txt" rows="4">User-agent: *
Allow: /
Disallow: /admin/
Disallow: /api/
Sitemap: {{ url('/sitemap.xml') }}</textarea>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="google_analytics" class="form-label">رمز Google Analytics</label>
                                    <input type="text" class="form-control" id="google_analytics" name="google_analytics" 
                                           value="{{ old('google_analytics', 'G-XXXXXXXXXX') }}" placeholder="G-XXXXXXXXXX">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="google_search_console" class="form-label">رمز Google Search Console</label>
                                    <input type="text" class="form-control" id="google_search_console" name="google_search_console" 
                                           value="{{ old('google_search_console', '') }}" placeholder="meta tag content">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="bing_webmaster" class="form-label">رمز Bing Webmaster</label>
                                    <input type="text" class="form-control" id="bing_webmaster" name="bing_webmaster" 
                                           value="{{ old('bing_webmaster', '') }}" placeholder="meta tag content">
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-lg"></i>
                                حفظ الإعدادات
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- SEO Analysis -->
            <div class="card mt-4">
                <div class="card-header">
                    <h3 class="card-title">تحليل SEO</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6>تحليل الصفحة الرئيسية</h6>
                            <div class="seo-score mb-3">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span>الدرجة الإجمالية</span>
                                    <span class="badge bg-success">85/100</span>
                                </div>
                                <div class="progress mb-3" style="height: 8px;">
                                    <div class="progress-bar bg-success" style="width: 85%"></div>
                                </div>
                            </div>
                            
                            <div class="seo-checklist">
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" checked disabled>
                                    <label class="form-check-label text-success">
                                        عنوان الصفحة محسن
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" checked disabled>
                                    <label class="form-check-label text-success">
                                        وصف الصفحة موجود
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" checked disabled>
                                    <label class="form-check-label text-success">
                                        الكلمات المفتاحية موجودة
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" disabled>
                                    <label class="form-check-label text-warning">
                                        صورة Open Graph مفقودة
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <h6>اقتراحات التحسين</h6>
                            <div class="alert alert-info">
                                <ul class="mb-0">
                                    <li>أضف صورة Open Graph لتحسين المشاركة</li>
                                    <li>حسن سرعة تحميل الصفحة</li>
                                    <li>أضف المزيد من المحتوى النصي</li>
                                    <li>تحقق من الروابط الداخلية</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- SEO Tools -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">أدوات SEO</h3>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <button type="button" class="btn btn-outline-primary" onclick="generateSitemap()">
                            <i class="bi bi-diagram-3"></i>
                            إنشاء خريطة الموقع
                        </button>
                        <button type="button" class="btn btn-outline-secondary" onclick="submitToSearchEngines()">
                            <i class="bi bi-search"></i>
                            إرسال لمحركات البحث
                        </button>
                        <button type="button" class="btn btn-outline-info" onclick="analyzeKeywords()">
                            <i class="bi bi-tags"></i>
                            تحليل الكلمات المفتاحية
                        </button>
                        <button type="button" class="btn btn-outline-success" onclick="checkPageSpeed()">
                            <i class="bi bi-speedometer2"></i>
                            فحص سرعة الصفحة
                        </button>
                        <button type="button" class="btn btn-outline-warning" onclick="generateRobotsTxt()">
                            <i class="bi bi-robot"></i>
                            إنشاء robots.txt
                        </button>
                    </div>
                </div>
            </div>

            <!-- Keyword Research -->
            <div class="card mt-4">
                <div class="card-header">
                    <h3 class="card-title">بحث الكلمات المفتاحية</h3>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <input type="text" class="form-control" id="keywordInput" placeholder="أدخل كلمة مفتاحية">
                    </div>
                    <button type="button" class="btn btn-primary w-100" onclick="researchKeyword()">
                        <i class="bi bi-search"></i>
                        بحث
                    </button>
                    
                    <div id="keywordResults" class="mt-3" style="display: none;">
                        <h6>نتائج البحث:</h6>
                        <div class="keyword-item mb-2">
                            <div class="d-flex justify-content-between">
                                <span>حجم البحث</span>
                                <span class="badge bg-primary">1K-10K</span>
                            </div>
                        </div>
                        <div class="keyword-item mb-2">
                            <div class="d-flex justify-content-between">
                                <span>صعوبة المنافسة</span>
                                <span class="badge bg-warning">متوسط</span>
                            </div>
                        </div>
                        <div class="keyword-item mb-2">
                            <div class="d-flex justify-content-between">
                                <span>تكلفة النقر</span>
                                <span class="badge bg-info">$0.50</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SEO Status -->
            <div class="card mt-4">
                <div class="card-header">
                    <h3 class="card-title">حالة SEO</h3>
                </div>
                <div class="card-body">
                    <div class="status-item mb-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>خريطة الموقع</span>
                            <span class="badge bg-success">محدثة</span>
                        </div>
                    </div>
                    <div class="status-item mb-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>robots.txt</span>
                            <span class="badge bg-success">موجودة</span>
                        </div>
                    </div>
                    <div class="status-item mb-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>Google Analytics</span>
                            <span class="badge bg-warning">غير متصل</span>
                        </div>
                    </div>
                    <div class="status-item mb-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>Search Console</span>
                            <span class="badge bg-danger">غير متصل</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// انتظار تحميل الصفحة
document.addEventListener('DOMContentLoaded', function() {
    // Character counter for meta descriptions
    const siteDescription = document.getElementById('site_description');
    if (siteDescription) {
        siteDescription.addEventListener('input', function() {
            const maxLength = 160;
            const currentLength = this.value.length;
            const remaining = maxLength - currentLength;
            
            if (remaining < 0) {
                this.style.borderColor = '#dc3545';
            } else if (remaining < 20) {
                this.style.borderColor = '#ffc107';
            } else {
                this.style.borderColor = '#198754';
            }
        });
    }

    const siteTitle = document.getElementById('site_title');
    if (siteTitle) {
        siteTitle.addEventListener('input', function() {
            const maxLength = 60;
            const currentLength = this.value.length;
            const remaining = maxLength - currentLength;
            
            if (remaining < 0) {
                this.style.borderColor = '#dc3545';
            } else if (remaining < 10) {
                this.style.borderColor = '#ffc107';
            } else {
                this.style.borderColor = '#198754';
            }
        });
    }
});

function generateSitemap() {
    if (confirm('هل تريد إنشاء خريطة موقع جديدة؟')) {
        fetch('{{ route("admin.seo.sitemap") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showNotification('تم إنشاء خريطة الموقع بنجاح', 'success');
            } else {
                showNotification(data.message || 'حدث خطأ أثناء إنشاء خريطة الموقع', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('حدث خطأ أثناء إنشاء خريطة الموقع', 'error');
        });
    }
}

function submitToSearchEngines() {
    if (confirm('هل تريد إرسال الموقع لمحركات البحث؟')) {
        fetch('{{ route("admin.seo.submit") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showSearchEnginesResults(data.results);
                showNotification('تم إرسال الموقع لمحركات البحث بنجاح', 'success');
            } else {
                showNotification(data.message || 'حدث خطأ أثناء الإرسال لمحركات البحث', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('حدث خطأ أثناء الإرسال لمحركات البحث', 'error');
        });
    }
}

function showSearchEnginesResults(results) {
    const modal = `
        <div class="modal fade" id="searchEnginesModal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">نتائج الإرسال لمحركات البحث</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="list-group">
                            ${results.map(result => `
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>${result.engine}</span>
                                    <span class="badge bg-${result.status === 'success' ? 'success' : 'danger'}">${result.message}</span>
                                </div>
                            `).join('')}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;
    
    // إزالة modal سابق إذا وجد
    const existingModal = document.getElementById('searchEnginesModal');
    if (existingModal) {
        existingModal.remove();
    }
    
    // إضافة modal جديد
    document.body.insertAdjacentHTML('beforeend', modal);
    
    // عرض modal
    const newModal = document.getElementById('searchEnginesModal');
    const modalInstance = new bootstrap.Modal(newModal);
    modalInstance.show();
}

function analyzeKeywords() {
    const keyword = prompt('أدخل الكلمة المفتاحية لتحليلها:');
    if (keyword && keyword.trim() !== '') {
        fetch('{{ route("admin.seo.analyze-keywords") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ keyword: keyword })
        })
        .then(response => response.json())
        .then(data => {
            showKeywordAnalysis(data);
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('حدث خطأ أثناء تحليل الكلمة المفتاحية', 'error');
        });
    }
}

function checkPageSpeed() {
    const url = prompt('أدخل رابط الصفحة لفحص سرعتها:', '{{ url("/") }}');
    if (url && url.trim() !== '') {
        fetch('{{ route("admin.seo.check-page-speed") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ url: url })
        })
        .then(response => response.json())
        .then(data => {
            showPageSpeedResults(data);
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('حدث خطأ أثناء فحص سرعة الصفحة', 'error');
        });
    }
}

function generateRobotsTxt() {
    if (confirm('هل تريد إنشاء ملف robots.txt جديد؟')) {
        fetch('{{ route("admin.seo.generate-robots-txt") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showNotification('تم إنشاء ملف robots.txt بنجاح', 'success');
            } else {
                showNotification(data.message || 'حدث خطأ أثناء إنشاء ملف robots.txt', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('حدث خطأ أثناء إنشاء ملف robots.txt', 'error');
        });
    }
}

function researchKeyword() {
    const keyword = document.getElementById('keywordInput').value;
    if (keyword.trim() === '') {
        showNotification('يرجى إدخال كلمة مفتاحية', 'warning');
        return;
    }
    
    fetch('{{ route("admin.seo.research-keyword") }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        },
        body: JSON.stringify({ keyword: keyword })
    })
    .then(response => response.json())
    .then(data => {
        showKeywordResearch(data);
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('حدث خطأ أثناء البحث عن الكلمة المفتاحية', 'error');
    });
}

function showKeywordAnalysis(data) {
    const modal = `
        <div class="modal fade" id="keywordAnalysisModal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">تحليل الكلمة المفتاحية</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h6>إحصائيات الكلمة المفتاحية</h6>
                                <div class="mb-3">
                                    <strong>حجم البحث:</strong> 
                                    <span class="badge bg-primary">${data.search_volume.toLocaleString()}</span>
                                </div>
                                <div class="mb-3">
                                    <strong>صعوبة المنافسة:</strong> 
                                    <div class="progress" style="height: 10px;">
                                        <div class="progress-bar ${data.difficulty <= 30 ? 'bg-success' : data.difficulty <= 60 ? 'bg-warning' : 'bg-danger'}" 
                                             style="width: ${data.difficulty}%"></div>
                                    </div>
                                    <small>${data.difficulty}/100</small>
                                </div>
                                <div class="mb-3">
                                    <strong>تكلفة النقر:</strong> 
                                    <span class="badge bg-info">$${data.cpc}</span>
                                </div>
                                <div class="mb-3">
                                    <strong>مستوى المنافسة:</strong> 
                                    <span class="badge bg-${data.competition === 'منخفض' ? 'success' : data.competition === 'متوسط' ? 'warning' : 'danger'}">${data.competition}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h6>الكلمات المفتاحية المرتبطة</h6>
                                <div class="list-group">
                                    ${data.related_keywords.map(keyword => `
                                        <div class="list-group-item d-flex justify-content-between align-items-center">
                                            <span>${keyword}</span>
                                            <span class="badge bg-secondary">مرتبط</span>
                                        </div>
                                    `).join('')}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;
    
    // إزالة modal سابق إذا وجد
    const existingModal = document.getElementById('keywordAnalysisModal');
    if (existingModal) {
        existingModal.remove();
    }
    
    // إضافة modal جديد
    document.body.insertAdjacentHTML('beforeend', modal);
    
    // عرض modal
    const newModal = document.getElementById('keywordAnalysisModal');
    const modalInstance = new bootstrap.Modal(newModal);
    modalInstance.show();
}

function showPageSpeedResults(data) {
    const overallScore = Math.round((data.mobile_score + data.desktop_score) / 2);
    const modal = `
        <div class="modal fade" id="pageSpeedModal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">نتائج فحص سرعة الصفحة</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-4">
                            <h6>الدرجة الإجمالية</h6>
                            <div class="progress mb-2" style="height: 20px;">
                                <div class="progress-bar ${overallScore >= 90 ? 'bg-success' : overallScore >= 70 ? 'bg-warning' : 'bg-danger'}" 
                                     style="width: ${overallScore}%">${overallScore}/100</div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <h6>الدرجات</h6>
                                <div class="mb-2">
                                    <strong>الجوال:</strong> ${data.mobile_score}/100
                                    <div class="progress" style="height: 10px;">
                                        <div class="progress-bar ${data.mobile_score >= 90 ? 'bg-success' : data.mobile_score >= 70 ? 'bg-warning' : 'bg-danger'}" 
                                             style="width: ${data.mobile_score}%"></div>
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <strong>الحاسوب:</strong> ${data.desktop_score}/100
                                    <div class="progress" style="height: 10px;">
                                        <div class="progress-bar ${data.desktop_score >= 90 ? 'bg-success' : data.desktop_score >= 70 ? 'bg-warning' : 'bg-danger'}" 
                                             style="width: ${data.desktop_score}%"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h6>مؤشرات الأداء</h6>
                                <div class="mb-2">
                                    <strong>وقت التحميل:</strong> ${data.load_time}
                                </div>
                                <div class="mb-2">
                                    <strong>First Contentful Paint:</strong> ${data.first_contentful_paint}
                                </div>
                                <div class="mb-2">
                                    <strong>Largest Contentful Paint:</strong> ${data.largest_contentful_paint}
                                </div>
                                <div class="mb-2">
                                    <strong>Cumulative Layout Shift:</strong> ${data.cumulative_layout_shift}
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <h6>اقتراحات التحسين</h6>
                            <ul class="list-group">
                                ${data.suggestions.map(suggestion => `<li class="list-group-item">${suggestion}</li>`).join('')}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;
    
    // إزالة modal سابق إذا وجد
    const existingModal = document.getElementById('pageSpeedModal');
    if (existingModal) {
        existingModal.remove();
    }
    
    // إضافة modal جديد
    document.body.insertAdjacentHTML('beforeend', modal);
    
    // عرض modal
    const newModal = document.getElementById('pageSpeedModal');
    const modalInstance = new bootstrap.Modal(newModal);
    modalInstance.show();
}

function showKeywordResearch(data) {
    const resultsDiv = document.getElementById('keywordResults');
    resultsDiv.innerHTML = `
        <h6>نتائج البحث:</h6>
        <div class="keyword-item mb-2">
            <div class="d-flex justify-content-between">
                <span>حجم البحث</span>
                <span class="badge bg-primary">${data.search_volume.toLocaleString()}</span>
            </div>
        </div>
        <div class="keyword-item mb-2">
            <div class="d-flex justify-content-between">
                <span>صعوبة المنافسة</span>
                <span class="badge bg-${data.competition === 'منخفض' ? 'success' : data.competition === 'متوسط' ? 'warning' : 'danger'}">${data.competition}</span>
            </div>
        </div>
        <div class="keyword-item mb-2">
            <div class="d-flex justify-content-between">
                <span>تكلفة النقر</span>
                <span class="badge bg-info">$${data.cpc}</span>
            </div>
        </div>
        <div class="keyword-item mb-2">
            <div class="d-flex justify-content-between">
                <span>الاتجاه</span>
                <span class="badge bg-success">${data.trend}</span>
            </div>
        </div>
        
        <h6 class="mt-3">الكلمات المفتاحية المرتبطة:</h6>
        <div class="list-group">
            ${data.related_keywords.map(keyword => `
                <div class="list-group-item d-flex justify-content-between align-items-center">
                    <span>${keyword}</span>
                    <span class="badge bg-secondary">مرتبط</span>
                </div>
            `).join('')}
        </div>
    `;
    resultsDiv.style.display = 'block';
}

function showNotification(message, type) {
    const alertClass = type === 'success' ? 'alert-success' : type === 'error' ? 'alert-danger' : 'alert-warning';
    const icon = type === 'success' ? 'bi-check-circle' : type === 'error' ? 'bi-exclamation-triangle' : 'bi-exclamation-circle';
    
    const notification = `
        <div class="alert ${alertClass} alert-dismissible fade show" role="alert">
            <i class="bi ${icon}"></i>
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    `;
    
    // إضافة الإشعار في أعلى الصفحة
    const contentArea = document.querySelector('.content-area');
    contentArea.insertAdjacentHTML('afterbegin', notification);
    
    // إزالة الإشعار بعد 5 ثوان
    setTimeout(() => {
        const alerts = document.querySelectorAll('.alert');
        if (alerts.length > 0) {
            alerts[0].remove();
        }
    }, 5000);
}


</script>

<style>
.border-left-primary {
    border-left: 0.25rem solid #4e73df !important;
}

.border-left-success {
    border-left: 0.25rem solid #1cc88a !important;
}

.border-left-info {
    border-left: 0.25rem solid #36b9cc !important;
}

.border-left-warning {
    border-left: 0.25rem solid #f6c23e !important;
}

.text-gray-300 {
    color: #dddfeb !important;
}

.text-gray-800 {
    color: #5a5c69 !important;
}

.text-xs {
    font-size: 0.7rem;
}

.font-weight-bold {
    font-weight: 700 !important;
}

.text-uppercase {
    text-transform: uppercase !important;
}

.progress {
    background-color: #eaecf4;
    border-radius: 0.35rem;
}

.progress-bar {
    border-radius: 0.35rem;
}

.card {
    border: none;
    box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
}

.card-header {
    background-color: #f8f9fc;
    border-bottom: 1px solid #e3e6f0;
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

.badge {
    font-size: 0.75rem;
    padding: 0.375rem 0.75rem;
}

.seo-checklist .form-check-label {
    font-size: 0.875rem;
}

.status-item {
    padding: 0.5rem 0;
    border-bottom: 1px solid #f3f4f6;
}

.status-item:last-child {
    border-bottom: none;
}

.keyword-item {
    padding: 0.5rem;
    background-color: #f8f9fa;
    border-radius: 6px;
}

h5 {
    color: #5a5c69;
    font-weight: 600;
    margin-bottom: 1rem;
    padding-bottom: 0.5rem;
    border-bottom: 2px solid #e3e6f0;
}
</style>
@endsection 