@extends('layouts.app')

@section('title', 'تم إلغاء الدفع - أكاديمية السهم الأخضر للتدريب')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="border-radius: 15px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
                <div class="card-header" style="background: linear-gradient(135deg, #ef4444, #dc2626); color: white; padding: 30px; border-radius: 15px 15px 0 0; text-align: center;">
                    <div style="font-size: 4rem; margin-bottom: 20px;">
                        <i class="bi bi-x-circle"></i>
                    </div>
                    <h1 style="margin: 0; font-size: 2rem;">تم إلغاء الدفع</h1>
                    <p style="margin: 10px 0 0 0; opacity: 0.9;">لم يتم إكمال عملية الدفع بنجاح</p>
                </div>
                
                <div class="card-body" style="padding: 40px;">
                    <!-- رسالة الإلغاء -->
                    <div style="background: #fef2f2; padding: 25px; border-radius: 10px; margin-bottom: 30px; border: 1px solid #fecaca;">
                        <h3 style="color: #991b1b; margin-bottom: 20px; display: flex; align-items: center; gap: 10px;">
                            <i class="bi bi-info-circle"></i>
                            ما حدث؟
                        </h3>
                        
                        <div style="color: #7f1d1d; line-height: 1.6;">
                            <p style="margin-bottom: 15px;">تم إلغاء عملية الدفع. هذا قد يكون بسبب:</p>
                            <ul style="margin: 0; padding-right: 20px;">
                                <li style="margin-bottom: 8px;">إلغاء العملية من جانبك</li>
                                <li style="margin-bottom: 8px;">مشكلة في الاتصال بالإنترنت</li>
                                <li style="margin-bottom: 8px;">مشكلة في بيانات البطاقة</li>
                                <li style="margin-bottom: 8px;">انتهاء مهلة الدفع</li>
                            </ul>
                        </div>
                    </div>
                    
                    <!-- تفاصيل الفاتورة -->
                    <div style="background: #f8fafc; padding: 25px; border-radius: 10px; margin-bottom: 30px;">
                        <h3 style="color: #1f2937; margin-bottom: 20px; display: flex; align-items: center; gap: 10px;">
                            <i class="bi bi-receipt"></i>
                            تفاصيل الفاتورة
                        </h3>
                        
                        <div style="display: grid; gap: 15px;">
                            <div style="display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #e5e7eb;">
                                <span style="color: #6b7280;">رقم الفاتورة:</span>
                                <span style="color: #1f2937; font-weight: 600;">{{ $payment->invoice_number }}</span>
                            </div>
                            <div style="display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #e5e7eb;">
                                <span style="color: #6b7280;">المبلغ المطلوب:</span>
                                <span style="color: #ef4444; font-weight: 600; font-size: 1.1rem;">{{ number_format($payment->total_amount, 2) }} ريال</span>
                            </div>
                            <div style="display: flex; justify-content: space-between; padding: 10px 0;">
                                <span style="color: #6b7280;">تاريخ انتهاء الصلاحية:</span>
                                <span style="color: #1f2937; font-weight: 600;">{{ $payment->expires_at->format('Y-m-d H:i') }}</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- معلومات الدورة -->
                    <div style="background: #f0fdf4; padding: 25px; border-radius: 10px; margin-bottom: 30px; border: 1px solid #a7f3d0;">
                        <h3 style="color: #065f46; margin-bottom: 20px; display: flex; align-items: center; gap: 10px;">
                            <i class="bi bi-book"></i>
                            معلومات الدورة
                        </h3>
                        
                        <div style="display: flex; gap: 20px; align-items: center;">
                            <img src="{{ $payment->course->featured_image ? asset('storage/' . $payment->course->featured_image) : 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80' }}" 
                                 alt="{{ $payment->course->title_ar }}" 
                                 style="width: 80px; height: 60px; object-fit: cover; border-radius: 8px;">
                            <div>
                                <h4 style="margin: 0 0 5px 0; color: #065f46;">{{ $payment->course->title_ar }}</h4>
                                <p style="margin: 0; color: #047857; font-size: 0.9rem;">{{ $payment->course->category->name_ar }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- الخيارات المتاحة -->
                    <div style="background: #eff6ff; padding: 25px; border-radius: 10px; margin-bottom: 30px; border: 1px solid #bfdbfe;">
                        <h3 style="color: #1e40af; margin-bottom: 20px; display: flex; align-items: center; gap: 10px;">
                            <i class="bi bi-arrow-right-circle"></i>
                            ما يمكنك فعله الآن
                        </h3>
                        
                        <div style="display: grid; gap: 15px;">
                            <div style="display: flex; align-items: center; gap: 15px; padding: 15px; background: white; border-radius: 8px; border: 1px solid #dbeafe;">
                                <div style="background: #3b82f6; color: white; width: 30px; height: 30px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 600;">1</div>
                                <div>
                                    <div style="color: #1e40af; font-weight: 600;">إعادة المحاولة</div>
                                    <div style="color: #6b7280; font-size: 0.9rem;">يمكنك إعادة محاولة الدفع مرة أخرى</div>
                                </div>
                            </div>
                            <div style="display: flex; align-items: center; gap: 15px; padding: 15px; background: white; border-radius: 8px; border: 1px solid #dbeafe;">
                                <div style="background: #3b82f6; color: white; width: 30px; height: 30px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 600;">2</div>
                                <div>
                                    <div style="color: #1e40af; font-weight: 600;">اختيار طريقة دفع أخرى</div>
                                    <div style="color: #6b7280; font-size: 0.9rem;">التحويل البنكي أو الدفع النقدي</div>
                                </div>
                            </div>
                            <div style="display: flex; align-items: center; gap: 15px; padding: 15px; background: white; border-radius: 8px; border: 1px solid #dbeafe;">
                                <div style="background: #3b82f6; color: white; width: 30px; height: 30px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 600;">3</div>
                                <div>
                                    <div style="color: #1e40af; font-weight: 600;">التواصل مع الدعم</div>
                                    <div style="color: #6b7280; font-size: 0.9rem;">إذا كنت تواجه مشاكل في الدفع</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- أزرار التنقل -->
                    <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 15px;">
                        <a href="{{ route('payment', $payment->course) }}" style="background: linear-gradient(135deg, #10b981, #059669); color: white; text-decoration: none; padding: 15px; border-radius: 10px; text-align: center; font-weight: 600; transition: all 0.3s ease; display: flex; align-items: center; justify-content: center; gap: 10px;">
                            <i class="bi bi-arrow-clockwise"></i>
                            إعادة المحاولة
                        </a>
                        <a href="{{ route('courses.show', $payment->course->slug) }}" style="background: #f8fafc; color: #1f2937; text-decoration: none; padding: 15px; border-radius: 10px; text-align: center; font-weight: 600; transition: all 0.3s ease; border: 2px solid #e5e7eb; display: flex; align-items: center; justify-content: center; gap: 10px;">
                            <i class="bi bi-arrow-left"></i>
                            العودة للدورة
                        </a>
                        <a href="{{ route('contact') }}" style="background: #f8fafc; color: #1f2937; text-decoration: none; padding: 15px; border-radius: 10px; text-align: center; font-weight: 600; transition: all 0.3s ease; border: 2px solid #e5e7eb; display: flex; align-items: center; justify-content: center; gap: 10px;">
                            <i class="bi bi-headset"></i>
                            الدعم الفني
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        background: white;
        border: none;
    }
    
    a:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(16, 185, 129, 0.3);
    }
    
    @media (max-width: 768px) {
        .card-body {
            padding: 20px !important;
        }
        
        .row > div {
            grid-template-columns: 1fr !important;
        }
    }
</style>
@endsection 