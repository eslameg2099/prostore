<x-layout :title="'المبيعات'" :breadcrumbs="['dashboard.mostseller']">
@include('dashboard.orders.partials.filter')

    @component('dashboard::components.table-box')
        @slot('title')
            @lang('sliders.actions.list') ({{ $orders->total() }})
        @endslot

        <thead>
        <tr>
          <th colspan="100">
              <div class="d-flex">
                

                  <div class="ml-2 d-flex justify-content-between flex-grow-1">
                   
                  </div>
              </div>
          </th>
        </tr>
        <tr>
           
            <th>رقم الطلب</th>
            <th>اسم العميل</th>
            <th>السعر</th>
            <th>عدد المنتجات</th>

            <th>@lang('sliders.attributes.created_at')</th>
            <th style="width: 160px">...</th>

        </tr>
        </thead>
        <tbody>
        @forelse($orders as $order)
            <tr>
              
                <td>
                    <a href="{{ route('dashboard.orders.show', $order) }}"
                       class="text-decoration-none text-ellipsis">

                      
                        {{ $order->id }}
                    </a>
                </td>
                <td>{{ $order->user->name ?? '_' }}</td>
               
                <td>{{ $order->sub_total }}</td>
                <td>{{ $order->items_count}}</td>

                

                <td>{{ new \App\Support\Date($order->created_at) }}</td>
                <td style="width: 160px">
                    @include('dashboard.orders.partials.actions.show')
                 
                </td>
              
            </tr>
        @empty
            <tr>
                <td colspan="100" class="text-center">لا يوجد منتجات حتي الان</td>
            </tr>
        @endforelse

        @if($orders->hasPages())
            @slot('footer')
                {{ $orders->links() }}
            @endslot
        @endif
    @endcomponent
 اجمالي البيع:   {{$sum_orders}}
</x-layout>
