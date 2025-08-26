@extends('layouts.teacher')

@section('title', 'تقرير الإيرادات')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">تقرير الإيرادات</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('teacher.dashboard') }}">الرئيسية</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('teacher.reports.index') }}">التقارير</a></li>
                        <li class="breadcrumb-item active">تقرير الإيرادات</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Revenue Statistics -->
        <div class="col-xl-3 col-md-6">
            <div class="card mini-stats-wid">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-muted fw-medium">إجمالي الإيرادات</p>
                            <h4 class="mb-0">{{ number_format($monthlyRevenue->sum('total'), 2) }} ريال</h4>
                        </div>
                        <div class="flex-shrink-0 align-self-center">
                            <div class="mini-stat-icon avatar-sm rounded-circle bg-primary align-self-center">
                                <span class="avatar-title">
                                    <i class="bx bx-dollar-circle font-size-24"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card mini-stats-wid">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-muted fw-medium">متوسط شهري</p>
                            <h4 class="mb-0">{{ number_format($monthlyRevenue->avg('total'), 2) }} ريال</h4>
                        </div>
                        <div class="flex-shrink-0 align-self-center">
                            <div class="mini-stat-icon avatar-sm rounded-circle bg-success align-self-center">
                                <span class="avatar-title">
                                    <i class="bx bx-trending-up font-size-24"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card mini-stats-wid">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-muted fw-medium">أعلى شهر</p>
                            <h4 class="mb-0">{{ number_format($monthlyRevenue->max('total'), 2) }} ريال</h4>
                        </div>
                        <div class="flex-shrink-0 align-self-center">
                            <div class="mini-stat-icon avatar-sm rounded-circle bg-warning align-self-center">
                                <span class="avatar-title">
                                    <i class="bx bx-trending-up font-size-24"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card mini-stats-wid">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-muted fw-medium">عدد المعاملات</p>
                            <h4 class="mb-0">{{ $monthlyRevenue->count() }}</h4>
                        </div>
                        <div class="flex-shrink-0 align-self-center">
                            <div class="mini-stat-icon avatar-sm rounded-circle bg-info align-self-center">
                                <span class="avatar-title">
                                    <i class="bx bx-receipt font-size-24"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Revenue Chart -->
        <div class="col-xl-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">الإيرادات الشهرية</h4>
                    <div id="revenue-chart" style="height: 300px;"></div>
                </div>
            </div>
        </div>

        <!-- Revenue Breakdown -->
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">توزيع الإيرادات</h4>
                    <div id="revenue-pie-chart" style="height: 300px;"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Monthly Revenue Table -->
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">تفاصيل الإيرادات الشهرية</h4>
                    
                    @if($monthlyRevenue->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-centered table-nowrap mb-0">
                                <thead>
                                    <tr>
                                        <th>الشهر</th>
                                        <th>الإيرادات</th>
                                        <th>النسبة المئوية</th>
                                        <th>التغيير</th>
                                        <th>الاتجاه</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $totalRevenue = $monthlyRevenue->sum('total');
                                        $previousMonth = null;
                                    @endphp
                                    
                                    @foreach($monthlyRevenue as $revenue)
                                    @php
                                        $percentage = $totalRevenue > 0 ? ($revenue->total / $totalRevenue) * 100 : 0;
                                        $change = $previousMonth ? (($revenue->total - $previousMonth) / $previousMonth) * 100 : 0;
                                        $previousMonth = $revenue->total;
                                    @endphp
                                    <tr>
                                        <td>
                                            <strong>{{ $revenue->month }}</strong>
                                        </td>
                                        <td>
                                            <span class="text-success fw-bold">{{ number_format($revenue->total, 2) }} ريال</span>
                                        </td>
                                        <td>
                                            <div class="progress" style="height: 6px;">
                                                <div class="progress-bar" role="progressbar" 
                                                     style="width: {{ $percentage }}%" 
                                                     aria-valuenow="{{ $percentage }}" 
                                                     aria-valuemin="0" aria-valuemax="100">
                                                </div>
                                            </div>
                                            <small class="text-muted">{{ number_format($percentage, 1) }}%</small>
                                        </td>
                                        <td>
                                            @if($change > 0)
                                                <span class="text-success">
                                                    <i class="bx bx-up-arrow-alt"></i> +{{ number_format($change, 1) }}%
                                                </span>
                                            @elseif($change < 0)
                                                <span class="text-danger">
                                                    <i class="bx bx-down-arrow-alt"></i> {{ number_format($change, 1) }}%
                                                </span>
                                            @else
                                                <span class="text-muted">0%</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($change > 0)
                                                <i class="bx bx-trending-up text-success font-size-20"></i>
                                            @elseif($change < 0)
                                                <i class="bx bx-trending-down text-danger font-size-20"></i>
                                            @else
                                                <i class="bx bx-minus text-muted font-size-20"></i>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="bx bx-dollar-circle font-size-48 text-muted"></i>
                            <h5 class="mt-3 text-muted">لا توجد إيرادات</h5>
                            <p class="text-muted">لم يتم تسجيل أي إيرادات بعد</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Revenue Chart
    var revenueOptions = {
        series: [{
            name: 'الإيرادات',
            data: [{{ $monthlyRevenue->pluck('total')->implode(',') }}]
        }],
        chart: {
            type: 'area',
            height: 300,
            toolbar: {
                show: false
            }
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'smooth',
            width: 2
        },
        colors: ['#556ee6'],
        fill: {
            type: 'gradient',
            gradient: {
                shadeIntensity: 1,
                opacityFrom: 0.7,
                opacityTo: 0.2,
                stops: [0, 90, 100]
            }
        },
        xaxis: {
            categories: ['يناير', 'فبراير', 'مارس', 'أبريل', 'مايو', 'يونيو', 'يوليو', 'أغسطس', 'سبتمبر', 'أكتوبر', 'نوفمبر', 'ديسمبر']
        },
        tooltip: {
            x: {
                format: 'dd/MM/yy HH:mm'
            },
        }
    };

    var revenueChart = new ApexCharts(document.querySelector("#revenue-chart"), revenueOptions);
    revenueChart.render();

    // Revenue Pie Chart
    var pieOptions = {
        series: [{{ $monthlyRevenue->pluck('total')->implode(',') }}],
        chart: {
            type: 'pie',
            height: 300
        },
        labels: ['يناير', 'فبراير', 'مارس', 'أبريل', 'مايو', 'يونيو', 'يوليو', 'أغسطس', 'سبتمبر', 'أكتوبر', 'نوفمبر', 'ديسمبر'],
        responsive: [{
            breakpoint: 480,
            options: {
                chart: {
                    width: 200
                },
                legend: {
                    position: 'bottom'
                }
            }
        }]
    };

    var pieChart = new ApexCharts(document.querySelector("#revenue-pie-chart"), pieOptions);
    pieChart.render();
});
</script>
@endpush
@endsection 