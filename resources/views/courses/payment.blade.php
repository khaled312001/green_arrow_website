@extends('layouts.app')

@section('title', 'الدفع - ' . $course->title_ar . ' - أكاديمية السهم الأخضر للتدريب')

@section('content')
<!-- Breadcrumb -->
<nav style="margin-bottom: 30px;">
    <ol style="display: flex; list-style: none; gap: 10px; color: #6b7280; font-size: 0.9rem;">
        <li><a href="{{ route('home') }}" style="color: #10b981; text-decoration: none;">الرئيسية</a></li>
        <li><i class="bi bi-chevron-left"></i></li>
        <li><a href="{{ route('courses') }}" style="color: #10b981; text-decoration: none;">الدورات</a></li>
        <li><i class="bi bi-chevron-left"></i></li>
        <li><a href="{{ route('courses.show', $course->slug) }}" style="color: #10b981; text-decoration: none;">{{ $course->title_ar }}</a></li>
        <li><i class="bi bi-chevron-left"></i></li>
        <li>الدفع</li>
    </ol>
</nav>

<div class="container">
    <div class="row" style="display: grid; grid-template-columns: 1fr 400px; gap: 40px; align-items: start;">
        
        <!-- Payment Form -->
        <div class="payment-form">
            <div class="card">
                <div class="card-header" style="background: linear-gradient(135deg, #10b981, #059669); color: white; padding: 25px; border-radius: 15px 15px 0 0;">
                    <h2 style="margin: 0; font-size: 1.8rem; display: flex; align-items: center; gap: 15px;">
                        <i class="bi bi-credit-card"></i>
                        معلومات الدفع
                    </h2>
                </div>
                
                <div class="card-body" style="padding: 30px;">
                    <form action="{{ route('payment.process', $course) }}" method="POST">
                        @csrf
                        <input type="hidden" name="amount" value="{{ $total_amount }}">
                        
                        <!-- Payment Method Selection -->
                        <div style="margin-bottom: 30px;">
                            <h3 style="margin-bottom: 20px; color: #1f2937; font-size: 1.3rem;">اختر طريقة الدفع</h3>
                            
                            <div style="display: grid; gap: 15px;">
                                <label style="display: flex; align-items: center; gap: 15px; padding: 20px; border: 2px solid #e5e7eb; border-radius: 10px; cursor: pointer; transition: all 0.3s ease;">
                                    <input type="radio" name="payment_method" value="online" style="width: 20px; height: 20px; accent-color: #10b981;">
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        <i class="bi bi-credit-card" style="font-size: 1.5rem; color: #10b981;"></i>
                                        <div>
                                            <div style="font-weight: 600; color: #1f2937;">الدفع الإلكتروني</div>
                                            <div style="color: #6b7280; font-size: 0.9rem;">بطاقة ائتمان أو مدى</div>
                                        </div>
                                    </div>
                                </label>
                                
                                <label style="display: flex; align-items: center; gap: 15px; padding: 20px; border: 2px solid #e5e7eb; border-radius: 10px; cursor: pointer; transition: all 0.3s ease;">
                                    <input type="radio" name="payment_method" value="bank_transfer" style="width: 20px; height: 20px; accent-color: #10b981;">
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        <i class="bi bi-bank" style="font-size: 1.5rem; color: #10b981;"></i>
                                        <div>
                                            <div style="font-weight: 600; color: #1f2937;">التحويل البنكي</div>
                                            <div style="color: #6b7280; font-size: 0.9rem;">تحويل مباشر للبنك</div>
                                        </div>
                                    </div>
                                </label>
                                
                                <label style="display: flex; align-items: center; gap: 15px; padding: 20px; border: 2px solid #e5e7eb; border-radius: 10px; cursor: pointer; transition: all 0.3s ease;">
                                    <input type="radio" name="payment_method" value="cash" style="width: 20px; height: 20px; accent-color: #10b981;">
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        <i class="bi bi-cash-coin" style="font-size: 1.5rem; color: #10b981;"></i>
                                        <div>
                                            <div style="font-weight: 600; color: #1f2937;">الدفع النقدي</div>
                                            <div style="color: #6b7280; font-size: 0.9rem;">في مقر الأكاديمية</div>
                                        </div>
                                    </div>
                                </label>
                            </div>
                            
                            @error('payment_method')
                                <div style="color: #dc2626; font-size: 0.9rem; margin-top: 10px;">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Billing Information -->
                        <div style="margin-bottom: 30px;">
                            <h3 style="margin-bottom: 20px; color: #1f2937; font-size: 1.3rem;">معلومات الفوترة</h3>
                            
                            <div style="display: grid; gap: 20px;">
                                <div>
                                    <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">الاسم الكامل *</label>
                                    <input type="text" name="billing_name" value="{{ auth()->user()->name }}" required
                                           style="width: 100%; padding: 12px 15px; border: 2px solid #e5e7eb; border-radius: 8px; font-size: 1rem; transition: border-color 0.3s ease;">
                                    @error('billing_name')
                                        <div style="color: #dc2626; font-size: 0.9rem; margin-top: 5px;">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div>
                                    <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">البريد الإلكتروني *</label>
                                    <input type="email" name="billing_email" value="{{ auth()->user()->email }}" required
                                           style="width: 100%; padding: 12px 15px; border: 2px solid #e5e7eb; border-radius: 8px; font-size: 1rem; transition: border-color 0.3s ease;">
                                    @error('billing_email')
                                        <div style="color: #dc2626; font-size: 0.9rem; margin-top: 5px;">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div>
                                    <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">رقم الهاتف *</label>
                                    <input type="tel" name="billing_phone" value="{{ auth()->user()->phone }}" required
                                           style="width: 100%; padding: 12px 15px; border: 2px solid #e5e7eb; border-radius: 8px; font-size: 1rem; transition: border-color 0.3s ease;">
                                    @error('billing_phone')
                                        <div style="color: #dc2626; font-size: 0.9rem; margin-top: 5px;">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div>
                                    <label style="display: block; margin-bottom: 8px; color: #374151; font-weight: 500;">العنوان (اختياري)</label>
                                    <textarea name="billing_address" rows="3" placeholder="العنوان الكامل للفوترة"
                                              style="width: 100%; padding: 12px 15px; border: 2px solid #e5e7eb; border-radius: 8px; font-size: 1rem; resize: vertical; transition: border-color 0.3s ease;"></textarea>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Terms and Conditions -->
                        <div style="margin-bottom: 30px;">
                            <label style="display: flex; align-items: flex-start; gap: 10px; cursor: pointer;">
                                <input type="checkbox" required style="margin-top: 3px; width: 18px; height: 18px; accent-color: #10b981;">
                                <div style="color: #6b7280; font-size: 0.9rem; line-height: 1.5;">
                                    أوافق على <a href="{{ route('terms-of-service') }}" target="_blank" style="color: #10b981; text-decoration: none;">الشروط والأحكام</a> 
                                    و <a href="{{ route('privacy-policy') }}" target="_blank" style="color: #10b981; text-decoration: none;">سياسة الخصوصية</a> 
                                    الخاصة بأكاديمية السهم الأخضر للتدريب
                                </div>
                            </label>
                        </div>
                        
                        <!-- Submit Button -->
                        <button type="submit" style="width: 100%; background: linear-gradient(135deg, #10b981, #059669); color: white; border: none; padding: 15px; border-radius: 10px; font-size: 1.1rem; font-weight: 600; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; justify-content: center; gap: 10px;">
                            <i class="bi bi-lock"></i>
                            إتمام الدفع الآمن
                        </button>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Order Summary -->
        <div class="order-summary">
            <div class="card" style="position: sticky; top: 20px;">
                <div class="card-header" style="background: #f8fafc; padding: 20px; border-bottom: 1px solid #e5e7eb;">
                    <h3 style="margin: 0; color: #1f2937; font-size: 1.3rem;">ملخص الطلب</h3>
                </div>
                
                <div class="card-body" style="padding: 20px;">
                    <!-- Course Info -->
                    <div style="display: flex; gap: 15px; margin-bottom: 20px; padding-bottom: 20px; border-bottom: 1px solid #e5e7eb;">
                        <img src="{{ $course->featured_image ? asset('storage/' . $course->featured_image) : 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80' }}" 
                             alt="{{ $course->title_ar }}" 
                             style="width: 80px; height: 60px; object-fit: cover; border-radius: 8px;">
                        <div>
                            <h4 style="margin: 0 0 5px 0; color: #1f2937; font-size: 1rem;">{{ $course->title_ar }}</h4>
                            <p style="margin: 0; color: #6b7280; font-size: 0.9rem;">{{ $course->category->name_ar }}</p>
                        </div>
                    </div>
                    
                    <!-- Pricing Breakdown -->
                    <div style="margin-bottom: 20px;">
                        @if($course->is_free)
                            <div style="display: flex; justify-content: space-between; padding-top: 15px; font-size: 1.1rem; font-weight: 600;">
                                <span style="color: #1f2937;">المجموع:</span>
                                <span style="color: #10b981;">مجاني</span>
                            </div>
                        @else
                            <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                                <span style="color: #6b7280;">سعر الدورة:</span>
                                <span style="color: #1f2937; font-weight: 500;">{{ number_format($amount, 2) }} ريال</span>
                            </div>
                            <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                                <span style="color: #6b7280;">ضريبة القيمة المضافة (15%):</span>
                                <span style="color: #1f2937; font-weight: 500;">{{ number_format($tax_amount, 2) }} ريال</span>
                            </div>
                            <div style="display: flex; justify-content: space-between; padding-top: 15px; border-top: 2px solid #e5e7eb; font-size: 1.1rem; font-weight: 600;">
                                <span style="color: #1f2937;">المجموع:</span>
                                <span style="color: #10b981;">{{ number_format($total_amount, 2) }} ريال</span>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Course Features -->
                    <div style="background: #f8fafc; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
                        <h4 style="margin: 0 0 15px 0; color: #1f2937; font-size: 1rem;">ما ستحصل عليه:</h4>
                        <ul style="margin: 0; padding-right: 20px; color: #6b7280; font-size: 0.9rem;">
                            <li style="margin-bottom: 8px;">وصول كامل لمحتوى الدورة</li>
                            <li style="margin-bottom: 8px;">{{ $course->lessons->count() }} درس تفاعلي</li>
                            <li style="margin-bottom: 8px;">شهادة إتمام معتمدة</li>
                            <li style="margin-bottom: 8px;">دعم فني متواصل</li>
                            <li style="margin-bottom: 0;">وصول مدى الحياة للمحتوى</li>
                        </ul>
                    </div>
                    
                    <!-- Security Notice -->
                    <div style="background: #ecfdf5; border: 1px solid #a7f3d0; padding: 15px; border-radius: 8px; text-align: center;">
                        <i class="bi bi-shield-check" style="color: #10b981; font-size: 1.5rem; margin-bottom: 10px;"></i>
                        <div style="color: #065f46; font-size: 0.9rem; font-weight: 500;">
                            دفع آمن ومشفر
                        </div>
                        <div style="color: #047857; font-size: 0.8rem; margin-top: 5px;">
                            جميع البيانات محمية بتقنيات التشفير المتقدمة
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }
    
    input[type="radio"]:checked + div {
        border-color: #10b981;
        background: #f0fdf4;
    }
    
    input:focus, textarea:focus {
        outline: none;
        border-color: #10b981;
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
    }
    
    button:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(16, 185, 129, 0.3);
    }
    
    @media (max-width: 768px) {
        .row {
            grid-template-columns: 1fr !important;
        }
        
        .order-summary .card {
            position: static !important;
        }
    }
</style>

<script>
    // Add visual feedback for payment method selection
    document.querySelectorAll('input[name="payment_method"]').forEach(radio => {
        radio.addEventListener('change', function() {
            // Remove active class from all labels
            document.querySelectorAll('input[name="payment_method"]').forEach(r => {
                r.closest('label').style.borderColor = '#e5e7eb';
                r.closest('label').style.background = 'transparent';
            });
            
            // Add active class to selected label
            if (this.checked) {
                this.closest('label').style.borderColor = '#10b981';
                this.closest('label').style.background = '#f0fdf4';
            }
        });
    });
</script>
@endsection 