<x-layout :title="$slider->id" :breadcrumbs="['dashboard.sliders.show', $slider]">
    <div class="row">
        <div class="col-md-12">
            @component('dashboard::components.box')
                @slot('class', 'p-0')
                @slot('bodyClass', 'p-0')

                <table class="table table-striped table-middle">
                    <tbody>
                    <tr>
                        <th width="180">@lang('sliders.attributes.id')</th>
                        <td>{{ $slider->id }}</td>
                    </tr>
                    <tr>
                        <th width="180">@lang('sliders.attributes.stauts')</th>
                        <td> @if($slider->stauts != 0 )
             <span class="badge badge-success">مفعل</span>

                   

                    @else

                    <span class="badge badge-danger">غير مفعل</span>

                    @endif</td>
                    </tr>
                    <tr>
                        <th width="180">@lang('sliders.attributes.created_at')</th>
                        <td>
                        {{ $slider->created_at	 }}

                        </td>
                    </tr>
                    <tr>
                        <th width="180">@lang('sliders.attributes.slidertable_type')</th>
                        <td>
                        {{ $slider->slidertable_type	 }}

                        </td>
                    </tr>
                 
                    @if($slider->getFirstMedia())
                        <tr>
                            <th width="200">@lang('sliders.attributes.image')</th>
                            <td>
                                <file-preview :media="{{ $slider->getMediaResource() }}"></file-preview>
                            </td>
                        </tr>
                    @endif
                 
                    </tbody>
                </table>

                @slot('footer')
                    @include('dashboard.sliders.partials.actions.edit')
                    @include('dashboard.sliders.partials.actions.delete')
                 
                @endslot
            @endcomponent
        </div>
       
    
</x-layout>
