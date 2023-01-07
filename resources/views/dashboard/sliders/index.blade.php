<x-layout :title="trans('sliders.plural')" :breadcrumbs="['dashboard.categories.index']">
    @include('dashboard.sliders.partials.filter')

    @component('dashboard::components.table-box')
        @slot('title')
            @lang('sliders.actions.list') ({{ $sliders->total() }})
        @endslot

        <thead>
        <tr>
          <th colspan="100">
              <div class="d-flex">
                

                  <div class="ml-2 d-flex justify-content-between flex-grow-1">
                      @include('dashboard.sliders.partials.actions.create')
                   
                  </div>
              </div>
          </th>
        </tr>
        <tr>
           
            <th>@lang('sliders.attributes.id')</th>
            <th>@lang('sliders.attributes.slidertable_type')</th>
            <th>@lang('sliders.attributes.stauts')</th>

            <th>@lang('sliders.attributes.created_at')</th>
            <th style="width: 160px">...</th>
        </tr>
        </thead>
        <tbody>
        @forelse($sliders as $slider)
            <tr>
              
                <td>
                    <a href="{{ route('dashboard.sliders.show', $slider) }}"
                       class="text-decoration-none text-ellipsis">

                      
                        {{ $slider->id }}
                    </a>
                </td>
                <td>{{ $slider->slidertable_type }}</td>
                <td> @if($slider->stauts != 0 )
             <span class="badge badge-success">مفعل</span>

                   

                    @else

                    <span class="badge badge-danger">غير مفعل</span>

                    @endif</td>

                <td>{{ new \App\Support\Date($slider->created_at) }}</td>

                <td style="width: 160px">
                    @include('dashboard.sliders.partials.actions.show')
                    @include('dashboard.sliders.partials.actions.edit')
                    @include('dashboard.sliders.partials.actions.delete')
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="100" class="text-center">@lang('sliders.empty')</td>
            </tr>
        @endforelse

        @if($sliders->hasPages())
            @slot('footer')
                {{ $sliders->links() }}
            @endslot
        @endif
    @endcomponent
</x-layout>
