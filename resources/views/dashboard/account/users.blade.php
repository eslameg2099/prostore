<x-layout :title="'العملاء الاكثر شراء'" :breadcrumbs="['dashboard.users']">

    @component('dashboard::components.table-box')
        @slot('title')
            @lang('sliders.actions.list') ({{ $users->total() }})
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
           
            <th>رقم العميل</th>
            <th>اسم العميل</th>
            <th>عدد الطلبات</th>

            <th>@lang('sliders.attributes.created_at')</th>
            <th style="width: 160px">...</th>

        </tr>
        </thead>
        <tbody>
        @forelse($users as $customer)
            <tr>
              
                <td>
                    <a href="{{ route('dashboard.customers.show', $customer) }}"
                       class="text-decoration-none text-ellipsis">

                      
                        {{ $customer->id }}
                    </a>
                </td>
                <td>{{ $customer->name ?? '_' }}</td>
               
                <td>{{ $customer->orders_count}}</td>

                

                <td>{{ new \App\Support\Date($customer->created_at) }}</td>
                <td style="width: 160px">
                @include('dashboard.accounts.customers.partials.actions.show')
                 
                </td>
              
            </tr>
        @empty
            <tr>
                <td colspan="100" class="text-center">لا يوجد منتجات حتي الان</td>
            </tr>
        @endforelse

        @if($users->hasPages())
            @slot('footer')
                {{ $users->links() }}
            @endslot
        @endif
    @endcomponent
</x-layout>
