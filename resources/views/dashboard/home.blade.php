<x-layout :title="trans('dashboard.home')" :breadcrumbs="['dashboard.home']">
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ \App\Models\Order::whereDate('created_at', today())->count() }}</h3>

                    <p>{{ __('الطلبات اليوم') }}</p>
                </div>
                <a href="{{ route('dashboard.orders.index') }}" class="small-box-footer">
                    @lang('عرض المزيد')
                    <i class="fas fa-arrow-circle-right"></i>
                </a>
                <div class="icon">
                            <i class="fa fa-shopping-cart"></i>
                        </div>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ \App\Models\Product::count() }}</h3>
                    <p>{{ __('عدد المنتجات') }}</p>
                </div>
                <a href="" class="small-box-footer">
                    @lang('عرض المزيد')
                    <i class="fas fa-arrow-circle-right"></i>
                </a>
                <div class="icon">
                            <i class="fas fa-shopping-basket"></i>
                        </div>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ \App\Models\Category::where('parent_id',null)->count() }}</h3>

                    <p>{{ __('عدد الاقسام') }}</p>
                </div>
                <a href="{{ route('dashboard.delegates.index') }}" class="small-box-footer">
                    @lang('عرض المزيد')
                    <i class="fas fa-arrow-circle-right"></i>
                </a>
                <div class="icon">
                            <i class="fas fa-th"></i>
                        </div>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ \App\Models\Customer::count() }}</h3>

                    <p>{{ __('عدد العملاء') }}</p>
                </div>
                <a href="{{ route('dashboard.customers.index') }}" class="small-box-footer">
                    @lang('عرض المزيد')
                    <i class="fas fa-arrow-circle-right"></i>
                </a>
                <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
            </div>
        </div>
        <!-- ./col -->
    </div>

    <div class="col-12 col-6">
مؤشر الطلبات
<div class="box-body border-radius-none">
<div class="chart" id="line-chart" style="height: 400px;"></div>
</div>

@push('scripts')

<script>

    //line chart
    var line = new Morris.Line({
        element: 'line-chart',
        resize: true,
        data: [
            @foreach ($sales_data as $data)
            {
                ym: "{{ $data->year }}-{{ $data->month }}", sum: "{{ $data->sum }}"
            },
            @endforeach
        ],
        xkey: 'ym',
        ykeys: ['sum'],
        labels: ['عدد الطلبات'],
        lineWidth: 2,
        hideHover: 'auto',
        gridStrokeWidth: 0.4,
        pointSize: 4,
        gridTextFamily: 'Open Sans',
        gridTextSize: 10
    });
   
</script>

@endpush
{{--    @foreach(\App\Models\Product::where('quantity', '<', 5)->get())--}}

{{--    @endforeach--}}
</x-layout>
