<div class="setting-group">
    <h5>إعدادات الدفع الأساسية</h5>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="currency" class="form-label">العملة</label>
            <select class="form-select" id="currency" name="settings[currency]">
                <option value="SAR" {{ ($settings['payment']['currency'] ?? 'SAR') == 'SAR' ? 'selected' : '' }}>ريال سعودي (SAR)</option>
                <option value="USD" {{ ($settings['payment']['currency'] ?? 'SAR') == 'USD' ? 'selected' : '' }}>دولار أمريكي (USD)</option>
                <option value="EUR" {{ ($settings['payment']['currency'] ?? 'SAR') == 'EUR' ? 'selected' : '' }}>يورو (EUR)</option>
                <option value="AED" {{ ($settings['payment']['currency'] ?? 'SAR') == 'AED' ? 'selected' : '' }}>درهم إماراتي (AED)</option>
                <option value="KWD" {{ ($settings['payment']['currency'] ?? 'SAR') == 'KWD' ? 'selected' : '' }}>دينار كويتي (KWD)</option>
                <option value="QAR" {{ ($settings['payment']['currency'] ?? 'SAR') == 'QAR' ? 'selected' : '' }}>ريال قطري (QAR)</option>
            </select>
            <div class="form-text">العملة الافتراضية للموقع</div>
        </div>
        <div class="col-md-6 mb-3">
            <label for="tax_rate" class="form-label">نسبة الضريبة (%)</label>
            <input type="number" class="form-control" id="tax_rate" name="settings[tax_rate]" 
                   value="{{ $settings['payment']['tax_rate'] ?? 15 }}" min="0" max="100" step="0.01">
            <div class="form-text">نسبة الضريبة المطبقة على المدفوعات</div>
        </div>
    </div>
</div>

<div class="setting-group">
    <h5>بوابات الدفع</h5>
    
    <!-- Stripe Settings -->
    <div class="row mb-4">
        <div class="col-12">
            <h6 class="text-primary">Stripe</h6>
        </div>
        <div class="col-md-6 mb-3">
            <label for="stripe_enabled" class="form-label">تفعيل Stripe</label>
            <select class="form-select" id="stripe_enabled" name="settings[stripe_enabled]">
                <option value="1" {{ ($settings['payment']['stripe_enabled'] ?? 1) == 1 ? 'selected' : '' }}>نعم</option>
                <option value="0" {{ ($settings['payment']['stripe_enabled'] ?? 1) == 0 ? 'selected' : '' }}>لا</option>
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label for="stripe_public_key" class="form-label">مفتاح Stripe العام</label>
            <input type="text" class="form-control" id="stripe_public_key" name="settings[stripe_public_key]" 
                   value="{{ $settings['payment']['stripe_public_key'] ?? '' }}">
        </div>
        <div class="col-md-6 mb-3">
            <label for="stripe_secret_key" class="form-label">مفتاح Stripe السري</label>
            <input type="password" class="form-control" id="stripe_secret_key" name="settings[stripe_secret_key]" 
                   value="{{ $settings['payment']['stripe_secret_key'] ?? '' }}">
        </div>
    </div>

    <!-- PayPal Settings -->
    <div class="row mb-4">
        <div class="col-12">
            <h6 class="text-primary">PayPal</h6>
        </div>
        <div class="col-md-6 mb-3">
            <label for="paypal_enabled" class="form-label">تفعيل PayPal</label>
            <select class="form-select" id="paypal_enabled" name="settings[paypal_enabled]">
                <option value="1" {{ ($settings['payment']['paypal_enabled'] ?? 1) == 1 ? 'selected' : '' }}>نعم</option>
                <option value="0" {{ ($settings['payment']['paypal_enabled'] ?? 1) == 0 ? 'selected' : '' }}>لا</option>
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label for="paypal_client_id" class="form-label">معرف PayPal</label>
            <input type="text" class="form-control" id="paypal_client_id" name="settings[paypal_client_id]" 
                   value="{{ $settings['payment']['paypal_client_id'] ?? '' }}">
        </div>
        <div class="col-md-6 mb-3">
            <label for="paypal_secret" class="form-label">مفتاح PayPal السري</label>
            <input type="password" class="form-control" id="paypal_secret" name="settings[paypal_secret]" 
                   value="{{ $settings['payment']['paypal_secret'] ?? '' }}">
        </div>
    </div>

    <!-- Bank Transfer Settings -->
    <div class="row">
        <div class="col-12">
            <h6 class="text-primary">التحويل البنكي</h6>
        </div>
        <div class="col-md-6 mb-3">
            <label for="bank_transfer_enabled" class="form-label">تفعيل التحويل البنكي</label>
            <select class="form-select" id="bank_transfer_enabled" name="settings[bank_transfer_enabled]">
                <option value="1" {{ ($settings['payment']['bank_transfer_enabled'] ?? 1) == 1 ? 'selected' : '' }}>نعم</option>
                <option value="0" {{ ($settings['payment']['bank_transfer_enabled'] ?? 1) == 0 ? 'selected' : '' }}>لا</option>
            </select>
        </div>
        <div class="col-md-12 mb-3">
            <label for="bank_account_info" class="form-label">معلومات الحساب البنكي</label>
            <textarea class="form-control" id="bank_account_info" name="settings[bank_account_info]" rows="4">{{ $settings['payment']['bank_account_info'] ?? '' }}</textarea>
            <div class="form-text">معلومات الحساب البنكي للتحويل (اسم البنك، رقم الحساب، IBAN، إلخ)</div>
        </div>
    </div>
</div> 