@extends('layouts.admin')

@section('title', 'تعديل القسم - لوحة الإدارة')

@section('content')
<div class="content-area">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="card-title">تعديل القسم: {{ $category->name_ar }}</h2>
                <a href="{{ route('admin.categories') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-right"></i>
                    العودة للأقسام
                </a>
            </div>
        </div>
        
        <div class="card-body">
            <form method="POST" action="{{ route('admin.categories.update', $category) }}" class="needs-validation" novalidate>
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name_ar" class="form-label">اسم القسم بالعربية *</label>
                            <input type="text" class="form-control @error('name_ar') is-invalid @enderror" 
                                   id="name_ar" name="name_ar" value="{{ old('name_ar', $category->name_ar) }}" required>
                            @error('name_ar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name_en" class="form-label">اسم القسم بالإنجليزية</label>
                            <input type="text" class="form-control @error('name_en') is-invalid @enderror" 
                                   id="name_en" name="name_en" value="{{ old('name_en', $category->name_en) }}">
                            @error('name_en')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="icon" class="form-label">أيقونة القسم</label>
                            <div class="input-group">
                                <input type="text" class="form-control @error('icon') is-invalid @enderror" 
                                       id="icon" name="icon" value="{{ old('icon', $category->icon) }}" 
                                       placeholder="اختر أيقونة من القائمة أدناه" readonly>
                                <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#iconPickerModal">
                                    <i class="bi bi-grid-3x3-gap"></i>
                                    اختر الأيقونة
                                </button>
                            </div>
                            <small class="form-text text-muted">اضغط على زر "اختر الأيقونة" لاختيار من جميع الأيقونات المتاحة</small>
                            @error('icon')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="color" class="form-label">لون القسم *</label>
                            <input type="color" class="form-control form-control-color @error('color') is-invalid @enderror" 
                                   id="color" name="color" value="{{ old('color', $category->color) }}" required>
                            @error('color')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="sort_order" class="form-label">ترتيب القسم</label>
                            <input type="number" class="form-control @error('sort_order') is-invalid @enderror" 
                                   id="sort_order" name="sort_order" value="{{ old('sort_order', $category->sort_order ?? 0) }}" min="0">
                            @error('sort_order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="description_ar" class="form-label">وصف القسم بالعربية</label>
                    <textarea class="form-control @error('description_ar') is-invalid @enderror" 
                              id="description_ar" name="description_ar" rows="3">{{ old('description_ar', $category->description_ar) }}</textarea>
                    @error('description_ar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="description_en" class="form-label">وصف القسم بالإنجليزية</label>
                    <textarea class="form-control @error('description_en') is-invalid @enderror" 
                              id="description_en" name="description_en" rows="3">{{ old('description_en', $category->description_en) }}</textarea>
                    @error('description_en')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" 
                               {{ old('is_active', $category->is_active) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">
                            القسم نشط
                        </label>
                    </div>
                </div>
                
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.categories') }}" class="btn btn-secondary">إلغاء</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-lg"></i>
                        حفظ التغييرات
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Icon Picker Modal -->
<div class="modal fade" id="iconPickerModal" tabindex="-1" aria-labelledby="iconPickerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="iconPickerModalLabel">اختر أيقونة القسم</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <input type="text" class="form-control" id="iconSearch" placeholder="ابحث عن أيقونة...">
                </div>
                <div class="icon-grid" id="iconGrid">
                    <!-- Icons will be loaded here -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                <button type="button" class="btn btn-primary" id="selectIconBtn" data-bs-dismiss="modal">اختيار الأيقونة</button>
            </div>
        </div>
    </div>
</div>

<style>
.form-label {
    font-weight: 600;
    color: #374151;
    margin-bottom: 0.5rem;
}

.form-control, .form-select {
    border-radius: 8px;
    border: 1px solid #d1d5db;
    padding: 0.75rem;
    transition: all 0.3s ease;
}

.form-control:focus, .form-select:focus {
    border-color: #10b981;
    box-shadow: 0 0 0 0.2rem rgba(16, 185, 129, 0.25);
}

.form-control-color {
    width: 100%;
    height: 50px;
    border-radius: 8px;
}

.is-invalid {
    border-color: #dc3545;
}

.invalid-feedback {
    color: #dc3545;
    font-size: 0.875rem;
    margin-top: 0.25rem;
}

.form-check-input:checked {
    background-color: #10b981;
    border-color: #10b981;
}

.btn {
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-primary {
    background-color: #10b981;
    border-color: #10b981;
}

.btn-primary:hover {
    background-color: #059669;
    border-color: #059669;
}

/* Icon Picker Styles */
.icon-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(80px, 1fr));
    gap: 10px;
    max-height: 400px;
    overflow-y: auto;
    padding: 10px;
    border: 1px solid #dee2e6;
    border-radius: 8px;
}

.icon-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 10px;
    border: 2px solid transparent;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
    text-align: center;
    min-height: 80px;
}

.icon-item:hover {
    background-color: #f8f9fa;
    border-color: #10b981;
}

.icon-item.selected {
    background-color: #10b981;
    color: white;
    border-color: #10b981;
}

.icon-item i {
    font-size: 24px;
    margin-bottom: 5px;
}

.icon-item .icon-name {
    font-size: 10px;
    word-break: break-word;
    line-height: 1.2;
}

.modal-xl {
    max-width: 90%;
}

#iconSearch {
    border-radius: 8px;
    padding: 12px;
    border: 1px solid #d1d5db;
}

#iconSearch:focus {
    border-color: #10b981;
    box-shadow: 0 0 0 0.2rem rgba(16, 185, 129, 0.25);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const iconInput = document.getElementById('icon');
    const iconSearch = document.getElementById('iconSearch');
    const iconGrid = document.getElementById('iconGrid');
    const selectIconBtn = document.getElementById('selectIconBtn');
    let selectedIcon = null;

    // Bootstrap Icons list
    const bootstrapIcons = [
        'bi-alarm', 'bi-alarm-fill', 'bi-align-bottom', 'bi-align-center', 'bi-align-end', 'bi-align-middle', 'bi-align-start', 'bi-align-top',
        'bi-alt', 'bi-app', 'bi-app-indicator', 'bi-archive', 'bi-archive-fill', 'bi-arrow-90deg-down', 'bi-arrow-90deg-left', 'bi-arrow-90deg-right',
        'bi-arrow-90deg-up', 'bi-arrow-bar-down', 'bi-arrow-bar-left', 'bi-arrow-bar-right', 'bi-arrow-bar-up', 'bi-arrow-clockwise', 'bi-arrow-counterclockwise',
        'bi-arrow-down', 'bi-arrow-down-circle', 'bi-arrow-down-circle-fill', 'bi-arrow-down-left-circle', 'bi-arrow-down-left-circle-fill', 'bi-arrow-down-left-square',
        'bi-arrow-down-left-square-fill', 'bi-arrow-down-right-circle', 'bi-arrow-down-right-circle-fill', 'bi-arrow-down-right-square', 'bi-arrow-down-right-square-fill',
        'bi-arrow-down-square', 'bi-arrow-down-square-fill', 'bi-arrow-down-up', 'bi-arrow-left', 'bi-arrow-left-circle', 'bi-arrow-left-circle-fill',
        'bi-arrow-left-square', 'bi-arrow-left-square-fill', 'bi-arrow-repeat', 'bi-arrow-return-left', 'bi-arrow-return-right', 'bi-arrow-right',
        'bi-arrow-right-circle', 'bi-arrow-right-circle-fill', 'bi-arrow-right-square', 'bi-arrow-right-square-fill', 'bi-arrow-up', 'bi-arrow-up-circle',
        'bi-arrow-up-circle-fill', 'bi-arrow-up-left-circle', 'bi-arrow-up-left-circle-fill', 'bi-arrow-up-left-square', 'bi-arrow-up-left-square-fill',
        'bi-arrow-up-right-circle', 'bi-arrow-up-right-circle-fill', 'bi-arrow-up-right-square', 'bi-arrow-up-right-square-fill', 'bi-arrow-up-square',
        'bi-arrow-up-square-fill', 'bi-arrows-angle-contract', 'bi-arrows-angle-expand', 'bi-arrows-collapse', 'bi-arrows-expand', 'bi-arrows-fullscreen',
        'bi-arrows-move', 'bi-aspect-ratio', 'bi-aspect-ratio-fill', 'bi-asterisk', 'bi-at', 'bi-award', 'bi-award-fill', 'bi-back', 'bi-backspace',
        'bi-backspace-fill', 'bi-backspace-reverse', 'bi-backspace-reverse-fill', 'bi-bag', 'bi-bag-check', 'bi-bag-check-fill', 'bi-bag-dash', 'bi-bag-dash-fill',
        'bi-bag-fill', 'bi-bag-heart', 'bi-bag-heart-fill', 'bi-bag-plus', 'bi-bag-plus-fill', 'bi-bag-x', 'bi-bag-x-fill', 'bi-bar-chart', 'bi-bar-chart-fill',
        'bi-battery-charging', 'bi-battery-full', 'bi-battery-half', 'bi-battery', 'bi-bell', 'bi-bell-fill', 'bi-bezier', 'bi-bezier2', 'bi-bicycle',
        'bi-bluetooth', 'bi-body-text', 'bi-book', 'bi-bookmark', 'bi-bookmark-check', 'bi-bookmark-check-fill', 'bi-bookmark-dash', 'bi-bookmark-dash-fill',
        'bi-bookmark-fill', 'bi-bookmark-heart', 'bi-bookmark-heart-fill', 'bi-bookmark-plus', 'bi-bookmark-plus-fill', 'bi-bookmark-star', 'bi-bookmark-star-fill',
        'bi-bookmark-x', 'bi-bookmark-x-fill', 'bi-bookmarks', 'bi-bookmarks-fill', 'bi-bookshelf', 'bi-bootstrap', 'bi-bootstrap-fill', 'bi-bootstrap-reboot',
        'bi-bounding-box', 'bi-bounding-box-circles', 'bi-box', 'bi-box-arrow-down-left', 'bi-box-arrow-down-right', 'bi-box-arrow-down', 'bi-box-arrow-in-down',
        'bi-box-arrow-in-down-left', 'bi-box-arrow-in-down-right', 'bi-box-arrow-in-left', 'bi-box-arrow-in-right', 'bi-box-arrow-in-up', 'bi-box-arrow-in-up-left',
        'bi-box-arrow-in-up-right', 'bi-box-arrow-left', 'bi-box-arrow-right', 'bi-box-arrow-up', 'bi-box-arrow-up-left', 'bi-box-arrow-up-right', 'bi-box-seam',
        'bi-braces', 'bi-braces-asterisk', 'bi-bricks', 'bi-briefcase', 'bi-briefcase-fill', 'bi-brightness-alt-high', 'bi-brightness-alt-high-fill',
        'bi-brightness-high', 'bi-brightness-high-fill', 'bi-brightness-low', 'bi-brightness-low-fill', 'bi-broadcast', 'bi-broadcast-pin', 'bi-brush',
        'bi-brush-fill', 'bi-bucket', 'bi-bucket-fill', 'bi-bug', 'bi-bug-fill', 'bi-building', 'bi-bullseye', 'bi-calculator', 'bi-calculator-fill',
        'bi-calendar', 'bi-calendar-check', 'bi-calendar-check-fill', 'bi-calendar-date', 'bi-calendar-date-fill', 'bi-calendar-day', 'bi-calendar-day-fill',
        'bi-calendar-event', 'bi-calendar-event-fill', 'bi-calendar-minus', 'bi-calendar-minus-fill', 'bi-calendar-month', 'bi-calendar-month-fill',
        'bi-calendar-plus', 'bi-calendar-plus-fill', 'bi-calendar-range', 'bi-calendar-range-fill', 'bi-calendar-week', 'bi-calendar-week-fill',
        'bi-calendar-x', 'bi-calendar-x-fill', 'bi-calendar2', 'bi-calendar2-check', 'bi-calendar2-check-fill', 'bi-calendar2-date', 'bi-calendar2-date-fill',
        'bi-calendar2-day', 'bi-calendar2-day-fill', 'bi-calendar2-event', 'bi-calendar2-event-fill', 'bi-calendar2-minus', 'bi-calendar2-minus-fill',
        'bi-calendar2-month', 'bi-calendar2-month-fill', 'bi-calendar2-plus', 'bi-calendar2-plus-fill', 'bi-calendar2-range', 'bi-calendar2-range-fill',
        'bi-calendar2-week', 'bi-calendar2-week-fill', 'bi-calendar2-x', 'bi-calendar2-x-fill', 'bi-calendar3', 'bi-calendar3-event', 'bi-calendar3-event-fill',
        'bi-calendar3-range', 'bi-calendar3-range-fill', 'bi-calendar3-week', 'bi-calendar3-week-fill', 'bi-calendar4', 'bi-calendar4-event', 'bi-calendar4-range',
        'bi-calendar4-week', 'bi-camera', 'bi-camera-fill', 'bi-camera-reels', 'bi-camera-reels-fill', 'bi-camera-video', 'bi-camera-video-fill',
        'bi-camera-video-off', 'bi-camera-video-off-fill', 'bi-capslock', 'bi-capslock-fill', 'bi-card-checklist', 'bi-card-heading', 'bi-card-image',
        'bi-card-list', 'bi-card-text', 'bi-caret-down', 'bi-caret-down-fill', 'bi-caret-left', 'bi-caret-left-fill', 'bi-caret-right', 'bi-caret-right-fill',
        'bi-caret-up', 'bi-caret-up-fill', 'bi-cart', 'bi-cart-check', 'bi-cart-check-fill', 'bi-cart-dash', 'bi-cart-dash-fill', 'bi-cart-fill',
        'bi-cart-plus', 'bi-cart-plus-fill', 'bi-cart-x', 'bi-cart-x-fill', 'bi-cash', 'bi-cash-coin', 'bi-cash-stack', 'bi-cast', 'bi-chat',
        'bi-chat-dots', 'bi-chat-dots-fill', 'bi-chat-fill', 'bi-chat-heart', 'bi-chat-heart-fill', 'bi-chat-left', 'bi-chat-left-dots', 'bi-chat-left-dots-fill',
        'bi-chat-left-fill', 'bi-chat-left-heart', 'bi-chat-left-heart-fill', 'bi-chat-left-quote', 'bi-chat-left-quote-fill', 'bi-chat-left-text',
        'bi-chat-left-text-fill', 'bi-chat-quote', 'bi-chat-quote-fill', 'bi-chat-right', 'bi-chat-right-dots', 'bi-chat-right-dots-fill', 'bi-chat-right-fill',
        'bi-chat-right-heart', 'bi-chat-right-heart-fill', 'bi-chat-right-quote', 'bi-chat-right-quote-fill', 'bi-chat-right-text', 'bi-chat-right-text-fill',
        'bi-chat-square', 'bi-chat-square-dots', 'bi-chat-square-dots-fill', 'bi-chat-square-fill', 'bi-chat-square-heart', 'bi-chat-square-heart-fill',
        'bi-chat-square-quote', 'bi-chat-square-quote-fill', 'bi-chat-square-text', 'bi-chat-square-text-fill', 'bi-chat-text', 'bi-chat-text-fill',
        'bi-check', 'bi-check-all', 'bi-check-circle', 'bi-check-circle-fill', 'bi-check-lg', 'bi-check-square', 'bi-check-square-fill', 'bi-check2',
        'bi-check2-all', 'bi-check2-circle', 'bi-check2-square', 'bi-chevron-bar-contract', 'bi-chevron-bar-down', 'bi-chevron-bar-expand', 'bi-chevron-bar-left',
        'bi-chevron-bar-right', 'bi-chevron-bar-up', 'bi-chevron-compact-down', 'bi-chevron-compact-left', 'bi-chevron-compact-right', 'bi-chevron-compact-up',
        'bi-chevron-contract', 'bi-chevron-down', 'bi-chevron-expand', 'bi-chevron-left', 'bi-chevron-right', 'bi-chevron-up', 'bi-circle', 'bi-circle-fill',
        'bi-circle-half', 'bi-clipboard', 'bi-clipboard-check', 'bi-clipboard-check-fill', 'bi-clipboard-data', 'bi-clipboard-data-fill', 'bi-clipboard-fill',
        'bi-clipboard-heart', 'bi-clipboard-heart-fill', 'bi-clipboard-minus', 'bi-clipboard-minus-fill', 'bi-clipboard-plus', 'bi-clipboard-plus-fill',
        'bi-clipboard-pulse', 'bi-clipboard-x', 'bi-clipboard-x-fill', 'bi-clock', 'bi-clock-fill', 'bi-clock-history', 'bi-cloud', 'bi-cloud-arrow-down',
        'bi-cloud-arrow-down-fill', 'bi-cloud-arrow-up', 'bi-cloud-arrow-up-fill', 'bi-cloud-check', 'bi-cloud-check-fill', 'bi-cloud-download',
        'bi-cloud-download-fill', 'bi-cloud-fill', 'bi-cloud-minus', 'bi-cloud-minus-fill', 'bi-cloud-plus', 'bi-cloud-plus-fill', 'bi-cloud-slash',
        'bi-cloud-slash-fill', 'bi-cloud-upload', 'bi-cloud-upload-fill', 'bi-code', 'bi-code-slash', 'bi-code-square', 'bi-collection', 'bi-collection-fill',
        'bi-collection-play', 'bi-collection-play-fill', 'bi-columns', 'bi-columns-gap', 'bi-command', 'bi-compass', 'bi-compass-fill', 'bi-cone',
        'bi-cone-striped', 'bi-controller', 'bi-cpu', 'bi-cpu-fill', 'bi-credit-card', 'bi-credit-card-2-back', 'bi-credit-card-2-back-fill',
        'bi-credit-card-2-front', 'bi-credit-card-2-front-fill', 'bi-credit-card-fill', 'bi-crop', 'bi-cup-hot', 'bi-cup-hot-fill', 'bi-cup-straw',
        'bi-cup-straw-fill', 'bi-cursor', 'bi-cursor-fill', 'bi-cursor-text', 'bi-dash', 'bi-dash-circle', 'bi-dash-circle-dash', 'bi-dash-circle-fill',
        'bi-dash-lg', 'bi-dash-square', 'bi-dash-square-dash', 'bi-dash-square-fill', 'bi-diagram-2', 'bi-diagram-2-fill', 'bi-diagram-3', 'bi-diagram-3-fill',
        'bi-diamond', 'bi-diamond-fill', 'bi-diamond-half', 'bi-disc', 'bi-disc-fill', 'bi-discord', 'bi-display', 'bi-display-fill', 'bi-distribute-horizontal',
        'bi-distribute-vertical', 'bi-door-closed', 'bi-door-closed-fill', 'bi-door-open', 'bi-door-open-fill', 'bi-dot', 'bi-download', 'bi-dribbble',
        'bi-droplet', 'bi-droplet-fill', 'bi-droplet-half', 'bi-earbuds', 'bi-easel', 'bi-easel-fill', 'bi-egg', 'bi-egg-fill', 'bi-egg-fried',
        'bi-eject', 'bi-eject-fill', 'bi-emoji-angry', 'bi-emoji-dizzy', 'bi-emoji-expressionless', 'bi-emoji-frown', 'bi-emoji-heart-eyes',
        'bi-emoji-laughing', 'bi-emoji-neutral', 'bi-emoji-smile', 'bi-emoji-smile-upside-down', 'bi-emoji-sunglasses', 'bi-emoji-wink', 'bi-envelope',
        'bi-envelope-fill', 'bi-envelope-open', 'bi-envelope-open-fill', 'bi-eraser', 'bi-eraser-fill', 'bi-exclamation', 'bi-exclamation-circle',
        'bi-exclamation-circle-fill', 'bi-exclamation-diamond', 'bi-exclamation-diamond-fill', 'bi-exclamation-lg', 'bi-exclamation-octagon',
        'bi-exclamation-octagon-fill', 'bi-exclamation-square', 'bi-exclamation-square-fill', 'bi-exclamation-triangle', 'bi-exclamation-triangle-fill',
        'bi-exclude', 'bi-eye', 'bi-eye-fill', 'bi-eye-slash', 'bi-eye-slash-fill', 'bi-facebook', 'bi-file', 'bi-file-arrow-down', 'bi-file-arrow-down-fill',
        'bi-file-arrow-up', 'bi-file-arrow-up-fill', 'bi-file-binary', 'bi-file-binary-fill', 'bi-file-break', 'bi-file-break-fill', 'bi-file-check',
        'bi-file-check-fill', 'bi-file-code', 'bi-file-code-fill', 'bi-file-diff', 'bi-file-diff-fill', 'bi-file-earmark', 'bi-file-earmark-arrow-down',
        'bi-file-earmark-arrow-down-fill', 'bi-file-earmark-arrow-up', 'bi-file-earmark-arrow-up-fill', 'bi-file-earmark-binary', 'bi-file-earmark-binary-fill',
        'bi-file-earmark-break', 'bi-file-earmark-break-fill', 'bi-file-earmark-check', 'bi-file-earmark-check-fill', 'bi-file-earmark-code',
        'bi-file-earmark-code-fill', 'bi-file-earmark-diff', 'bi-file-earmark-diff-fill', 'bi-file-earmark-earmark', 'bi-file-earmark-fill',
        'bi-file-earmark-font', 'bi-file-earmark-font-fill', 'bi-file-earmark-image', 'bi-file-earmark-image-fill', 'bi-file-earmark-lock',
        'bi-file-earmark-lock-fill', 'bi-file-earmark-lock2', 'bi-file-earmark-lock2-fill', 'bi-file-earmark-medical', 'bi-file-earmark-medical-fill',
        'bi-file-earmark-minus', 'bi-file-earmark-minus-fill', 'bi-file-earmark-music', 'bi-file-earmark-music-fill', 'bi-file-earmark-person',
        'bi-file-earmark-person-fill', 'bi-file-earmark-play', 'bi-file-earmark-play-fill', 'bi-file-earmark-plus', 'bi-file-earmark-plus-fill',
        'bi-file-earmark-post', 'bi-file-earmark-post-fill', 'bi-file-earmark-ppt', 'bi-file-earmark-ppt-fill', 'bi-file-earmark-richtext',
        'bi-file-earmark-richtext-fill', 'bi-file-earmark-ruled', 'bi-file-earmark-ruled-fill', 'bi-file-earmark-slides', 'bi-file-earmark-slides-fill',
        'bi-file-earmark-spreadsheet', 'bi-file-earmark-spreadsheet-fill', 'bi-file-earmark-text', 'bi-file-earmark-text-fill', 'bi-file-earmark-word',
        'bi-file-earmark-word-fill', 'bi-file-earmark-x', 'bi-file-earmark-x-fill', 'bi-file-earmark-zip', 'bi-file-earmark-zip-fill', 'bi-file-easel',
        'bi-file-easel-fill', 'bi-file-excel', 'bi-file-excel-fill', 'bi-file-fill', 'bi-file-font', 'bi-file-font-fill', 'bi-file-image', 'bi-file-image-fill',
        'bi-file-lock', 'bi-file-lock-fill', 'bi-file-lock2', 'bi-file-lock2-fill', 'bi-file-medical', 'bi-file-medical-fill', 'bi-file-minus', 'bi-file-minus-fill',
        'bi-file-music', 'bi-file-music-fill', 'bi-file-person', 'bi-file-person-fill', 'bi-file-play', 'bi-file-play-fill', 'bi-file-plus', 'bi-file-plus-fill',
        'bi-file-post', 'bi-file-post-fill', 'bi-file-ppt', 'bi-file-ppt-fill', 'bi-file-richtext', 'bi-file-richtext-fill', 'bi-file-ruled', 'bi-file-ruled-fill',
        'bi-file-slides', 'bi-file-slides-fill', 'bi-file-spreadsheet', 'bi-file-spreadsheet-fill', 'bi-file-text', 'bi-file-text-fill', 'bi-file-word',
        'bi-file-word-fill', 'bi-file-x', 'bi-file-x-fill', 'bi-file-zip', 'bi-file-zip-fill', 'bi-files', 'bi-files-alt', 'bi-film', 'bi-fingerprint',
        'bi-flag', 'bi-flag-fill', 'bi-folder', 'bi-folder-check', 'bi-folder-fill', 'bi-folder-minus', 'bi-folder-plus', 'bi-folder-symlink',
        'bi-folder-symlink-fill', 'bi-folder-x', 'bi-folder2', 'bi-folder2-open', 'bi-fonts', 'bi-forward', 'bi-forward-fill', 'bi-front', 'bi-fullscreen',
        'bi-fullscreen-exit', 'bi-funnel', 'bi-funnel-fill', 'bi-gear', 'bi-gear-fill', 'bi-gear-wide', 'bi-gear-wide-connected', 'bi-gem', 'bi-gender-ambiguous',
        'bi-gender-female', 'bi-gender-male', 'bi-gender-trans', 'bi-geo-alt', 'bi-geo-alt-fill', 'bi-geo', 'bi-geo-fill', 'bi-gift', 'bi-gift-fill',
        'bi-github', 'bi-globe', 'bi-globe2', 'bi-google', 'bi-graph-down', 'bi-graph-down-arrow', 'bi-graph-up', 'bi-graph-up-arrow', 'bi-grid',
        'bi-grid-1x2', 'bi-grid-1x2-fill', 'bi-grid-3x2', 'bi-grid-3x2-gap', 'bi-grid-3x2-gap-fill', 'bi-grid-3x3', 'bi-grid-3x3-gap', 'bi-grid-3x3-gap-fill',
        'bi-grid-fill', 'bi-grip-horizontal', 'bi-grip-vertical', 'bi-hammer', 'bi-hand-index', 'bi-hand-index-fill', 'bi-hand-index-thumb',
        'bi-hand-index-thumb-fill', 'bi-hand-thumbs-down', 'bi-hand-thumbs-down-fill', 'bi-hand-thumbs-up', 'bi-hand-thumbs-up-fill', 'bi-hash',
        'bi-heart', 'bi-heart-fill', 'bi-heart-half', 'bi-heart-pulse', 'bi-heart-pulse-fill', 'bi-hearts', 'bi-hexagon', 'bi-hexagon-fill',
        'bi-hexagon-half', 'bi-hourglass', 'bi-hourglass-bottom', 'bi-hourglass-split', 'bi-hourglass-top', 'bi-house', 'bi-house-door',
        'bi-house-door-fill', 'bi-house-fill', 'bi-house-heart', 'bi-house-heart-fill', 'bi-hr', 'bi-hurricane', 'bi-hypnotize', 'bi-image',
        'bi-image-alt', 'bi-image-fill', 'bi-images', 'bi-inbox', 'bi-inbox-fill', 'bi-inboxes', 'bi-inboxes-fill', 'bi-info', 'bi-info-circle',
        'bi-info-circle-fill', 'bi-info-lg', 'bi-input-cursor', 'bi-input-cursor-text', 'bi-instagram', 'bi-intersect', 'bi-justify',
        'bi-justify-left', 'bi-justify-right', 'bi-kanban', 'bi-kanban-fill', 'bi-key', 'bi-key-fill', 'bi-keyboard', 'bi-keyboard-fill',
        'bi-ladder', 'bi-lamp', 'bi-lamp-fill', 'bi-laptop', 'bi-layers', 'bi-layers-fill', 'bi-layers-half', 'bi-lightbulb', 'bi-lightbulb-fill',
        'bi-lightbulb-off', 'bi-lightbulb-off-fill', 'bi-lightning', 'bi-lightning-charge', 'bi-lightning-charge-fill', 'bi-lightning-fill',
        'bi-link', 'bi-link-45deg', 'bi-linkedin', 'bi-list', 'bi-list-check', 'bi-list-nested', 'bi-list-ol', 'bi-list-stars', 'bi-list-task',
        'bi-list-ul', 'bi-lock', 'bi-lock-fill', 'bi-lungs', 'bi-lungs-fill', 'bi-magic', 'bi-magnet', 'bi-magnet-fill', 'bi-mailbox',
        'bi-mailbox2', 'bi-map', 'bi-map-fill', 'bi-markdown', 'bi-markdown-fill', 'bi-mask', 'bi-mastodon', 'bi-medium', 'bi-megaphone',
        'bi-megaphone-fill', 'bi-messenger', 'bi-meta', 'bi-mic', 'bi-mic-fill', 'bi-mic-mute', 'bi-mic-mute-fill', 'bi-microsoft',
        'bi-microsoft-teams', 'bi-minecart', 'bi-minecart-loaded', 'bi-modem', 'bi-modem-fill', 'bi-moon', 'bi-moon-fill', 'bi-moon-stars',
        'bi-moon-stars-fill', 'bi-mortarboard', 'bi-mortarboard-fill', 'bi-mouse', 'bi-mouse-fill', 'bi-mouse2', 'bi-mouse2-fill', 'bi-mouse3',
        'bi-mouse3-fill', 'bi-music-note', 'bi-music-note-beamed', 'bi-music-note-list', 'bi-music-player', 'bi-music-player-fill', 'bi-newspaper',
        'bi-node-minus', 'bi-node-plus', 'bi-nut', 'bi-nut-fill', 'bi-octagon', 'bi-octagon-fill', 'bi-octagon-half', 'bi-option', 'bi-outlet',
        'bi-p-circle', 'bi-p-circle-fill', 'bi-p-square', 'bi-p-square-fill', 'bi-palette', 'bi-palette-fill', 'bi-palette2', 'bi-paperclip',
        'bi-paragraph', 'bi-patch-check', 'bi-patch-check-fill', 'bi-patch-exclamation', 'bi-patch-exclamation-fill', 'bi-patch-minus',
        'bi-patch-minus-fill', 'bi-patch-plus', 'bi-patch-plus-fill', 'bi-patch-question', 'bi-patch-question-fill', 'bi-pause', 'bi-pause-btn',
        'bi-pause-btn-fill', 'bi-pause-circle', 'bi-pause-circle-fill', 'bi-pause-fill', 'bi-peace', 'bi-pen', 'bi-pencil', 'bi-pentagon',
        'bi-pentagon-fill', 'bi-pentagon-half', 'bi-percent', 'bi-person', 'bi-person-badge', 'bi-person-badge-fill', 'bi-person-bounding-box',
        'bi-person-check', 'bi-person-check-fill', 'bi-person-circle', 'bi-person-dash', 'bi-person-dash-fill', 'bi-person-fill', 'bi-person-gear',
        'bi-person-heart', 'bi-person-heart-fill', 'bi-person-lines-fill', 'bi-person-plus', 'bi-person-plus-fill', 'bi-person-rolodex',
        'bi-person-rolodex-fill', 'bi-person-square', 'bi-person-vcard', 'bi-person-vcard-fill', 'bi-person-video', 'bi-person-video2',
        'bi-person-video3', 'bi-person-workspace', 'bi-person-x', 'bi-person-x-fill', 'bi-phone', 'bi-phone-fill', 'bi-phone-flip',
        'bi-phone-landscape', 'bi-phone-landscape-fill', 'bi-phone-vibrate', 'bi-phone-vibrate-fill', 'bi-pie-chart', 'bi-pie-chart-fill',
        'bi-pin', 'bi-pin-angle', 'bi-pin-angle-fill', 'bi-pin-fill', 'bi-pin-map', 'bi-pin-map-fill', 'bi-pinterest', 'bi-play', 'bi-play-btn',
        'bi-play-btn-fill', 'bi-play-circle', 'bi-play-circle-fill', 'bi-play-fill', 'bi-playstation', 'bi-plug', 'bi-plug-fill', 'bi-plus',
        'bi-plus-circle', 'bi-plus-circle-dotted', 'bi-plus-circle-fill', 'bi-plus-lg', 'bi-plus-square', 'bi-plus-square-dotted', 'bi-plus-square-fill',
        'bi-postage', 'bi-postage-fill', 'bi-postage-heart', 'bi-postage-heart-fill', 'bi-printer', 'bi-printer-fill', 'bi-projector',
        'bi-projector-fill', 'bi-puzzle', 'bi-puzzle-fill', 'bi-question', 'bi-question-circle', 'bi-question-circle-fill', 'bi-question-diamond',
        'bi-question-diamond-fill', 'bi-question-lg', 'bi-question-octagon', 'bi-question-octagon-fill', 'bi-question-square', 'bi-question-square-fill',
        'bi-quote', 'bi-rainbow', 'bi-receipt', 'bi-receipt-cutoff', 'bi-reception-0', 'bi-reception-1', 'bi-reception-2', 'bi-reception-3',
        'bi-reception-4', 'bi-record', 'bi-record-btn', 'bi-record-btn-fill', 'bi-record-circle', 'bi-record-circle-fill', 'bi-record-fill',
        'bi-record2', 'bi-record2-fill', 'bi-reply', 'bi-reply-all', 'bi-reply-all-fill', 'bi-reply-fill', 'bi-robot', 'bi-router', 'bi-router-fill',
        'bi-rss', 'bi-rulers', 'bi-safe', 'bi-safe-fill', 'bi-safe2', 'bi-safe2-fill', 'bi-save', 'bi-save-fill', 'bi-save2', 'bi-save2-fill',
        'bi-scissors', 'bi-screwdriver', 'bi-search', 'bi-search-heart', 'bi-search-heart-fill', 'bi-segmented-nav', 'bi-server', 'bi-share',
        'bi-share-fill', 'bi-shield', 'bi-shield-check', 'bi-shield-check-fill', 'bi-shield-exclamation', 'bi-shield-fill', 'bi-shield-lock',
        'bi-shield-lock-fill', 'bi-shield-minus', 'bi-shield-plus', 'bi-shield-shaded', 'bi-shield-slash', 'bi-shield-slash-fill', 'bi-shield-x',
        'bi-shield-x-fill', 'bi-shift', 'bi-shift-fill', 'bi-shop', 'bi-shop-window', 'bi-signal', 'bi-signpost', 'bi-signpost-2', 'bi-signpost-2-fill',
        'bi-signpost-fill', 'bi-signpost-split', 'bi-signpost-split-fill', 'bi-sim', 'bi-sim-fill', 'bi-skip-backward', 'bi-skip-backward-btn',
        'bi-skip-backward-btn-fill', 'bi-skip-backward-circle', 'bi-skip-backward-circle-fill', 'bi-skip-backward-fill', 'bi-skip-forward',
        'bi-skip-forward-btn', 'bi-skip-forward-btn-fill', 'bi-skip-forward-circle', 'bi-skip-forward-circle-fill', 'bi-skip-forward-fill',
        'bi-skype', 'bi-slack', 'bi-slash-circle', 'bi-slash-lg', 'bi-slash-square', 'bi-slash-square-fill', 'bi-sliders', 'bi-smartwatch',
        'bi-snow', 'bi-snow2', 'bi-snow3', 'bi-sort-alpha-down', 'bi-sort-alpha-down-alt', 'bi-sort-alpha-up', 'bi-sort-alpha-up-alt',
        'bi-sort-down', 'bi-sort-down-alt', 'bi-sort-numeric-down', 'bi-sort-numeric-down-alt', 'bi-sort-numeric-up', 'bi-sort-numeric-up-alt',
        'bi-sort-up', 'bi-sort-up-alt', 'bi-soundwave', 'bi-speaker', 'bi-speaker-fill', 'bi-speedometer', 'bi-speedometer2', 'bi-spellcheck',
        'bi-square', 'bi-square-fill', 'bi-square-half', 'bi-stack', 'bi-star', 'bi-star-fill', 'bi-star-half', 'bi-stars', 'bi-stickies',
        'bi-stickies-fill', 'bi-sticky', 'bi-sticky-fill', 'bi-stop', 'bi-stop-btn', 'bi-stop-btn-fill', 'bi-stop-circle', 'bi-stop-circle-fill',
        'bi-stop-fill', 'bi-stoplights', 'bi-stoplights-fill', 'bi-stopwatch', 'bi-stopwatch-fill', 'bi-subtract', 'bi-suit-club', 'bi-suit-club-fill',
        'bi-suit-diamond', 'bi-suit-diamond-fill', 'bi-suit-heart', 'bi-suit-heart-fill', 'bi-suit-spade', 'bi-suit-spade-fill', 'bi-sun',
        'bi-sun-fill', 'bi-sunglasses', 'bi-table', 'bi-tablet', 'bi-tablet-fill', 'bi-tag', 'bi-tag-fill', 'bi-tags', 'bi-tags-fill', 'bi-telephone',
        'bi-telephone-fill', 'bi-telephone-forward', 'bi-telephone-forward-fill', 'bi-telephone-inbound', 'bi-telephone-inbound-fill',
        'bi-telephone-minus', 'bi-telephone-minus-fill', 'bi-telephone-outbound', 'bi-telephone-outbound-fill', 'bi-telephone-plus',
        'bi-telephone-plus-fill', 'bi-telephone-x', 'bi-telephone-x-fill', 'bi-terminal', 'bi-terminal-dash', 'bi-terminal-fill', 'bi-terminal-plus',
        'bi-terminal-split', 'bi-terminal-x', 'bi-text-center', 'bi-text-indent-left', 'bi-text-indent-right', 'bi-text-left', 'bi-text-paragraph',
        'bi-text-right', 'bi-textarea-resize', 'bi-textarea-t', 'bi-textarea', 'bi-thermometer', 'bi-thermometer-half', 'bi-thermometer-high',
        'bi-thermometer-low', 'bi-thermometer-snow', 'bi-thermometer-sun', 'bi-three-dots', 'bi-three-dots-vertical', 'bi-toggle-off',
        'bi-toggle-on', 'bi-tools', 'bi-tornado', 'bi-trash', 'bi-trash-fill', 'bi-tree', 'bi-tree-fill', 'bi-triangle', 'bi-triangle-fill',
        'bi-triangle-half', 'bi-trophy', 'bi-trophy-fill', 'bi-tropical-storm', 'bi-truck', 'bi-truck-flatbed', 'bi-tv', 'bi-tv-fill', 'bi-twitch',
        'bi-twitter', 'bi-type', 'bi-type-bold', 'bi-type-h1', 'bi-type-h2', 'bi-type-h3', 'bi-type-h4', 'bi-type-h5', 'bi-type-h6', 'bi-type-italic',
        'bi-type-strikethrough', 'bi-type-underline', 'bi-ubuntu', 'bi-ui-checks', 'bi-ui-checks-grid', 'bi-ui-radios', 'bi-ui-radios-grid',
        'bi-umbrella', 'bi-umbrella-fill', 'bi-vector-pen', 'bi-view-list', 'bi-view-stacked', 'bi-vinyl', 'bi-vinyl-fill', 'bi-voicemail',
        'bi-volume-down', 'bi-volume-down-fill', 'bi-volume-mute', 'bi-volume-mute-fill', 'bi-volume-off', 'bi-volume-off-fill', 'bi-volume-up',
        'bi-volume-up-fill', 'bi-vr', 'bi-wallet', 'bi-wallet-fill', 'bi-wallet2', 'bi-watch', 'bi-water', 'bi-webcam', 'bi-webcam-fill',
        'bi-whatsapp', 'bi-wifi', 'bi-wifi-1', 'bi-wifi-2', 'bi-wifi-off', 'bi-windows', 'bi-wordpress', 'bi-wrench', 'bi-wrench-adjustable',
        'bi-wrench-adjustable-circle', 'bi-wrench-adjustable-circle-fill', 'bi-x', 'bi-x-circle', 'bi-x-circle-fill', 'bi-x-diamond',
        'bi-x-diamond-fill', 'bi-x-lg', 'bi-x-octagon', 'bi-x-octagon-fill', 'bi-x-square', 'bi-x-square-fill', 'bi-youtube', 'bi-zoom-in',
        'bi-zoom-out'
    ];

    // Populate icon grid
    function populateIconGrid(icons) {
        iconGrid.innerHTML = '';
        icons.forEach(icon => {
            const iconItem = document.createElement('div');
            iconItem.className = 'icon-item';
            iconItem.innerHTML = `
                <i class="bi ${icon}"></i>
                <div class="icon-name">${icon.replace('bi-', '')}</div>
            `;
            iconItem.addEventListener('click', () => selectIcon(iconItem, icon));
            iconGrid.appendChild(iconItem);
        });
    }

    // Select icon
    function selectIcon(iconItem, iconName) {
        // Remove previous selection
        document.querySelectorAll('.icon-item').forEach(item => {
            item.classList.remove('selected');
        });
        
        // Add selection to clicked item
        iconItem.classList.add('selected');
        selectedIcon = iconName;
    }

    // Search functionality
    iconSearch.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        const filteredIcons = bootstrapIcons.filter(icon => 
            icon.toLowerCase().includes(searchTerm)
        );
        populateIconGrid(filteredIcons);
    });

    // Select button functionality
    selectIconBtn.addEventListener('click', function() {
        if (selectedIcon) {
            iconInput.value = selectedIcon;
        }
    });

    // Initialize icon grid
    populateIconGrid(bootstrapIcons);
});
</script>
@endsection 