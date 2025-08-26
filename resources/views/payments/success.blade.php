@extends('layouts.app')

@section('title', 'تم الدفع بنجاح - أكاديمية السهم الأخضر للتدريب')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="border-radius: 15px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
                <div class="card-header" style="background: linear-gradient(135deg, #10b981, #059669); color: white; padding: 30px; border-radius: 15px 15px 0 0; text-align: center;">
                    <div style="font-size: 4rem; margin-bottom: 20px;">
                        <i class="bi bi-check-circle"></i>
                    </div>
                    <h1 style="margin: 0; font-size: 2rem;">تم الدفع بنجاح!</h1>
                    <p style="margin: 10px 0 0 0; opacity: 0.9;">شكراً لك على ثقتك في أكاديمية السهم الأخضر للتدريب</p>
                </div>
                
                <div class="card-body" style="padding: 40px;">
                    <!-- تفاصيل الدفع -->
                    <div style="background: #f8fafc; padding: 25px; border-radius: 10px; margin-bottom: 30px;">
                        <h3 style="color: #1f2937; margin-bottom: 20px; display: flex; align-items: center; gap: 10px;">
                            <i class="bi bi-receipt"></i>
                            تفاصيل الدفع
                        </h3>
                        
                        <div style="display: grid; gap: 15px;">
                            <div style="display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #e5e7eb;">
                                <span style="color: #6b7280;">رقم الفاتورة:</span>
                                <span style="color: #1f2937; font-weight: 600;">{{ $payment->invoice_number }}</span>
                            </div>
                            <div style="display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #e5e7eb;">
                                <span style="color: #6b7280;">معرف الدفع:</span>
                                <span style="color: #1f2937; font-weight: 600;">{{ $payment->payment_id }}</span>
                            </div>
                            <div style="display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #e5e7eb;">
                                <span style="color: #6b7280;">المبلغ المدفوع:</span>
                                <span style="color: #10b981; font-weight: 600; font-size: 1.1rem;">{{ number_format($payment->total_amount, 2) }} ريال</span>
                            </div>
                            <div style="display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #e5e7eb;">
                                <span style="color: #6b7280;">طريقة الدفع:</span>
                                <span style="color: #1f2937; font-weight: 600;">
                                    @switch($payment->payment_method)
                                        @case('online')
                                            الدفع الإلكتروني
                                            @break
                                        @case('bank_transfer')
                                            التحويل البنكي
                                            @break
                                        @case('cash')
                                            الدفع النقدي
                                            @break
                                        @default
                                            {{ $payment->payment_method }}
                                    @endswitch
                                </span>
                            </div>
                            <div style="display: flex; justify-content: space-between; padding: 10px 0;">
                                <span style="color: #6b7280;">تاريخ الدفع:</span>
                                <span style="color: #1f2937; font-weight: 600;">{{ $payment->paid_at ? $payment->paid_at->format('Y-m-d H:i') : 'قيد المعالجة' }}</span>
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
                    
                    <!-- الخطوات التالية -->
                    <div style="background: #eff6ff; padding: 25px; border-radius: 10px; margin-bottom: 30px; border: 1px solid #bfdbfe;">
                        <h3 style="color: #1e40af; margin-bottom: 20px; display: flex; align-items: center; gap: 10px;">
                            <i class="bi bi-arrow-right-circle"></i>
                            الخطوات التالية
                        </h3>
                        
                        <div style="display: grid; gap: 15px;">
                            <div style="display: flex; align-items: center; gap: 15px;">
                                <div style="background: #3b82f6; color: white; width: 30px; height: 30px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 600;">1</div>
                                <div>
                                    <div style="color: #1e40af; font-weight: 600;">تم تفعيل حسابك</div>
                                    <div style="color: #6b7280; font-size: 0.9rem;">يمكنك الآن الوصول لجميع محتويات الدورة</div>
                                </div>
                            </div>
                            <div style="display: flex; align-items: center; gap: 15px;">
                                <div style="background: #3b82f6; color: white; width: 30px; height: 30px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 600;">2</div>
                                <div>
                                    <div style="color: #1e40af; font-weight: 600;">ابدأ التعلم</div>
                                    <div style="color: #6b7280; font-size: 0.9rem;">انتقل إلى لوحة تحكم الطالب وابدأ رحلة التعلم</div>
                                </div>
                            </div>
                            <div style="display: flex; align-items: center; gap: 15px;">
                                <div style="background: #3b82f6; color: white; width: 30px; height: 30px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 600;">3</div>
                                <div>
                                    <div style="color: #1e40af; font-weight: 600;">احصل على الشهادة</div>
                                    <div style="color: #6b7280; font-size: 0.9rem;">بعد إكمال الدورة ستحصل على شهادة معتمدة</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- أزرار التنقل -->
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                        <a href="{{ route('student.dashboard') }}" style="background: linear-gradient(135deg, #10b981, #059669); color: white; text-decoration: none; padding: 15px; border-radius: 10px; text-align: center; font-weight: 600; transition: all 0.3s ease; display: flex; align-items: center; justify-content: center; gap: 10px;">
                            <i class="bi bi-speedometer2"></i>
                            لوحة التحكم
                        </a>
                        <a href="{{ route('student.courses') }}" style="background: #f8fafc; color: #1f2937; text-decoration: none; padding: 15px; border-radius: 10px; text-align: center; font-weight: 600; transition: all 0.3s ease; border: 2px solid #e5e7eb; display: flex; align-items: center; justify-content: center; gap: 10px;">
                            <i class="bi bi-collection-play"></i>
                            دوراتي
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