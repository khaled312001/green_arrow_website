@extends('layouts.app')

@section('title', 'تفاصيل التحويل البنكي - أكاديمية السهم الأخضر للتدريب')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="border-radius: 15px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
                <div class="card-header" style="background: linear-gradient(135deg, #3b82f6, #1d4ed8); color: white; padding: 30px; border-radius: 15px 15px 0 0; text-align: center;">
                    <div style="font-size: 4rem; margin-bottom: 20px;">
                        <i class="bi bi-bank"></i>
                    </div>
                    <h1 style="margin: 0; font-size: 2rem;">تفاصيل التحويل البنكي</h1>
                    <p style="margin: 10px 0 0 0; opacity: 0.9;">يرجى إكمال التحويل البنكي لتفعيل حسابك</p>
                </div>
                
                <div class="card-body" style="padding: 40px;">
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
                                <span style="color: #3b82f6; font-weight: 600; font-size: 1.1rem;">{{ number_format($payment->total_amount, 2) }} ريال</span>
                            </div>
                            <div style="display: flex; justify-content: space-between; padding: 10px 0;">
                                <span style="color: #6b7280;">تاريخ انتهاء الصلاحية:</span>
                                <span style="color: #1f2937; font-weight: 600;">{{ $payment->expires_at->format('Y-m-d H:i') }}</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- معلومات الحساب البنكي -->
                    <div style="background: #eff6ff; padding: 25px; border-radius: 10px; margin-bottom: 30px; border: 1px solid #bfdbfe;">
                        <h3 style="color: #1e40af; margin-bottom: 20px; display: flex; align-items: center; gap: 10px;">
                            <i class="bi bi-credit-card"></i>
                            معلومات الحساب البنكي
                        </h3>
                        
                        @php
                            $bank_data = $payment->payment_data['bank_details'] ?? [
                                'bank_name' => 'البنك الأهلي السعودي',
                                'account_name' => 'أكاديمية السهم الأخضر للتدريب',
                                'account_number' => 'SA0380000000608010167519',
                                'iban' => 'SA0380000000608010167519',
                                'swift_code' => 'NCBJSARI',
                                'branch' => 'فرع مكة المكرمة',
                            ];
                        @endphp
                        
                        <div style="display: grid; gap: 15px;">
                            <div style="display: flex; justify-content: space-between; padding: 15px; background: white; border-radius: 8px; border: 1px solid #dbeafe;">
                                <span style="color: #6b7280;">اسم البنك:</span>
                                <span style="color: #1e40af; font-weight: 600;">{{ $bank_data['bank_name'] }}</span>
                            </div>
                            <div style="display: flex; justify-content: space-between; padding: 15px; background: white; border-radius: 8px; border: 1px solid #dbeafe;">
                                <span style="color: #6b7280;">اسم الحساب:</span>
                                <span style="color: #1e40af; font-weight: 600;">{{ $bank_data['account_name'] }}</span>
                            </div>
                            <div style="display: flex; justify-content: space-between; padding: 15px; background: white; border-radius: 8px; border: 1px solid #dbeafe;">
                                <span style="color: #6b7280;">رقم الحساب:</span>
                                <span style="color: #1e40af; font-weight: 600; direction: ltr;">{{ $bank_data['account_number'] }}</span>
                            </div>
                            <div style="display: flex; justify-content: space-between; padding: 15px; background: white; border-radius: 8px; border: 1px solid #dbeafe;">
                                <span style="color: #6b7280;">رقم الآيبان:</span>
                                <span style="color: #1e40af; font-weight: 600; direction: ltr;">{{ $bank_data['iban'] }}</span>
                            </div>
                            <div style="display: flex; justify-content: space-between; padding: 15px; background: white; border-radius: 8px; border: 1px solid #dbeafe;">
                                <span style="color: #6b7280;">رمز السويفت:</span>
                                <span style="color: #1e40af; font-weight: 600;">{{ $bank_data['swift_code'] }}</span>
                            </div>
                            <div style="display: flex; justify-content: space-between; padding: 15px; background: white; border-radius: 8px; border: 1px solid #dbeafe;">
                                <span style="color: #6b7280;">الفرع:</span>
                                <span style="color: #1e40af; font-weight: 600;">{{ $bank_data['branch'] }}</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- التعليمات -->
                    <div style="background: #fef3c7; padding: 25px; border-radius: 10px; margin-bottom: 30px; border: 1px solid #f59e0b;">
                        <h3 style="color: #92400e; margin-bottom: 20px; display: flex; align-items: center; gap: 10px;">
                            <i class="bi bi-info-circle"></i>
                            تعليمات مهمة
                        </h3>
                        
                        @php
                            $instructions = $payment->payment_data['instructions'] ?? [
                                'قم بتحويل المبلغ: ' . number_format($payment->total_amount, 2) . ' ريال',
                                'أضف رقم الفاتورة في وصف التحويل: ' . $payment->invoice_number,
                                'احتفظ بإيصال التحويل كدليل على الدفع',
                                'سيتم تفعيل حسابك خلال 24 ساعة من تأكيد التحويل'
                            ];
                        @endphp
                        
                        <div style="display: grid; gap: 15px;">
                            @foreach($instructions as $index => $instruction)
                                <div style="display: flex; align-items: flex-start; gap: 15px;">
                                    <div style="background: #f59e0b; color: white; width: 25px; height: 25px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: 0.9rem; flex-shrink: 0;">{{ $index + 1 }}</div>
                                    <div style="color: #92400e; line-height: 1.6;">{{ $instruction }}</div>
                                </div>
                            @endforeach
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
                    
                    <!-- أزرار التنقل -->
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                        <a href="{{ route('student.dashboard') }}" style="background: linear-gradient(135deg, #3b82f6, #1d4ed8); color: white; text-decoration: none; padding: 15px; border-radius: 10px; text-align: center; font-weight: 600; transition: all 0.3s ease; display: flex; align-items: center; justify-content: center; gap: 10px;">
                            <i class="bi bi-speedometer2"></i>
                            لوحة التحكم
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
        box-shadow: 0 10px 25px rgba(59, 130, 246, 0.3);
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