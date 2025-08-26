@extends('layouts.app')

@section('title', 'تفاصيل الدفع النقدي - أكاديمية السهم الأخضر للتدريب')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="border-radius: 15px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
                <div class="card-header" style="background: linear-gradient(135deg, #f59e0b, #d97706); color: white; padding: 30px; border-radius: 15px 15px 0 0; text-align: center;">
                    <div style="font-size: 4rem; margin-bottom: 20px;">
                        <i class="bi bi-cash-coin"></i>
                    </div>
                    <h1 style="margin: 0; font-size: 2rem;">تفاصيل الدفع النقدي</h1>
                    <p style="margin: 10px 0 0 0; opacity: 0.9;">يرجى زيارة مكتب الأكاديمية لإكمال الدفع</p>
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
                                <span style="color: #f59e0b; font-weight: 600; font-size: 1.1rem;">{{ number_format($payment->total_amount, 2) }} ريال</span>
                            </div>
                            <div style="display: flex; justify-content: space-between; padding: 10px 0;">
                                <span style="color: #6b7280;">تاريخ انتهاء الصلاحية:</span>
                                <span style="color: #1f2937; font-weight: 600;">{{ $payment->expires_at->format('Y-m-d H:i') }}</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- معلومات المكتب -->
                    <div style="background: #fef3c7; padding: 25px; border-radius: 10px; margin-bottom: 30px; border: 1px solid #f59e0b;">
                        <h3 style="color: #92400e; margin-bottom: 20px; display: flex; align-items: center; gap: 10px;">
                            <i class="bi bi-geo-alt"></i>
                            معلومات المكتب
                        </h3>
                        
                        @php
                            $cash_data = $payment->payment_data['cash_details'] ?? [
                                'office_address' => 'مكة المكرمة - حي العزيزية - شارع الملك عبدالله',
                                'office_hours' => 'الأحد - الخميس: 8:00 ص - 4:00 م',
                                'contact_phone' => '+966-12-1234567',
                                'contact_email' => 'info@greenarrow.edu.sa',
                            ];
                        @endphp
                        
                        <div style="display: grid; gap: 15px;">
                            <div style="display: flex; align-items: center; gap: 15px; padding: 15px; background: white; border-radius: 8px; border: 1px solid #fbbf24;">
                                <i class="bi bi-geo-alt" style="color: #f59e0b; font-size: 1.5rem;"></i>
                                <div>
                                    <div style="color: #92400e; font-weight: 600;">العنوان:</div>
                                    <div style="color: #6b7280;">{{ $cash_data['office_address'] }}</div>
                                </div>
                            </div>
                            <div style="display: flex; align-items: center; gap: 15px; padding: 15px; background: white; border-radius: 8px; border: 1px solid #fbbf24;">
                                <i class="bi bi-clock" style="color: #f59e0b; font-size: 1.5rem;"></i>
                                <div>
                                    <div style="color: #92400e; font-weight: 600;">ساعات العمل:</div>
                                    <div style="color: #6b7280;">{{ $cash_data['office_hours'] }}</div>
                                </div>
                            </div>
                            <div style="display: flex; align-items: center; gap: 15px; padding: 15px; background: white; border-radius: 8px; border: 1px solid #fbbf24;">
                                <i class="bi bi-telephone" style="color: #f59e0b; font-size: 1.5rem;"></i>
                                <div>
                                    <div style="color: #92400e; font-weight: 600;">رقم الهاتف:</div>
                                    <div style="color: #6b7280;">{{ $cash_data['contact_phone'] }}</div>
                                </div>
                            </div>
                            <div style="display: flex; align-items: center; gap: 15px; padding: 15px; background: white; border-radius: 8px; border: 1px solid #fbbf24;">
                                <i class="bi bi-envelope" style="color: #f59e0b; font-size: 1.5rem;"></i>
                                <div>
                                    <div style="color: #92400e; font-weight: 600;">البريد الإلكتروني:</div>
                                    <div style="color: #6b7280;">{{ $cash_data['contact_email'] }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- الوثائق المطلوبة -->
                    <div style="background: #eff6ff; padding: 25px; border-radius: 10px; margin-bottom: 30px; border: 1px solid #3b82f6;">
                        <h3 style="color: #1e40af; margin-bottom: 20px; display: flex; align-items: center; gap: 10px;">
                            <i class="bi bi-file-earmark-text"></i>
                            الوثائق المطلوبة
                        </h3>
                        
                        @php
                            $required_documents = $payment->payment_data['cash_details']['required_documents'] ?? [
                                'الهوية الوطنية أو الإقامة',
                                'رقم الفاتورة: ' . $payment->invoice_number,
                                'مبلغ الدفع: ' . number_format($payment->total_amount, 2) . ' ريال'
                            ];
                        @endphp
                        
                        <div style="display: grid; gap: 15px;">
                            @foreach($required_documents as $index => $document)
                                <div style="display: flex; align-items: center; gap: 15px; padding: 15px; background: white; border-radius: 8px; border: 1px solid #dbeafe;">
                                    <div style="background: #3b82f6; color: white; width: 30px; height: 30px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 600;">{{ $index + 1 }}</div>
                                    <div style="color: #1e40af; font-weight: 500;">{{ $document }}</div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    
                    <!-- التعليمات -->
                    <div style="background: #f0fdf4; padding: 25px; border-radius: 10px; margin-bottom: 30px; border: 1px solid #10b981;">
                        <h3 style="color: #065f46; margin-bottom: 20px; display: flex; align-items: center; gap: 10px;">
                            <i class="bi bi-info-circle"></i>
                            تعليمات الدفع
                        </h3>
                        
                        @php
                            $instructions = $payment->payment_data['instructions'] ?? [
                                'قم بزيارة مكتب الأكاديمية في العنوان المذكور',
                                'احضر الوثائق المطلوبة',
                                'ادفع المبلغ نقداً',
                                'ستحصل على إيصال رسمي',
                                'سيتم تفعيل حسابك فوراً بعد الدفع'
                            ];
                        @endphp
                        
                        <div style="display: grid; gap: 15px;">
                            @foreach($instructions as $index => $instruction)
                                <div style="display: flex; align-items: flex-start; gap: 15px;">
                                    <div style="background: #10b981; color: white; width: 25px; height: 25px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: 0.9rem; flex-shrink: 0;">{{ $index + 1 }}</div>
                                    <div style="color: #065f46; line-height: 1.6;">{{ $instruction }}</div>
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
                        <a href="{{ route('student.dashboard') }}" style="background: linear-gradient(135deg, #f59e0b, #d97706); color: white; text-decoration: none; padding: 15px; border-radius: 10px; text-align: center; font-weight: 600; transition: all 0.3s ease; display: flex; align-items: center; justify-content: center; gap: 10px;">
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
        box-shadow: 0 10px 25px rgba(245, 158, 11, 0.3);
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