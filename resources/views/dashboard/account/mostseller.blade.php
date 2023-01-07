<x-layout :title="'المنتجات الاكتر مبيعا'" :breadcrumbs="['dashboard.mostseller']">

    @component('dashboard::components.table-box')
        @slot('title')
            @lang('sliders.actions.list') ({{ $most_sellers->total() }})
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
           
            <th>رقم المنتج</th>
            <th>اسم المنتج</th>
            <th>السعر</th>
            <th>النوع</th>
            <th>عدد مرات البيع</th>

            <th>@lang('sliders.attributes.created_at')</th>
        </tr>
        </thead>
        <tbody>
        @forelse($most_sellers as $most_seller)
            <tr>
              
                <td>
                    <a href="{{ route('dashboard.products.show', $most_seller) }}"
                       class="text-decoration-none text-ellipsis">

                      
                        {{ $most_seller->id }}
                    </a>
                </td>
                <td>{{ $most_seller->name }}</td>
               
                <td>{{ $most_seller->price }} </td>
                <td>{{ $most_seller->category->name }}</td>
                <td>{{ $most_seller->items->sum('quantity')}}</td>

                

                <td>{{ new \App\Support\Date($most_seller->created_at) }}</td>

              
            </tr>
        @empty
            <tr>
                <td colspan="100" class="text-center">لا يوجد منتجات حتي الان</td>
            </tr>
        @endforelse

        @if($most_sellers->hasPages())
            @slot('footer')
                {{ $most_sellers->links() }}
            @endslot
        @endif
    @endcomponent
</x-layout>
