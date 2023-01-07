<x-layout :title="$slider->id" :breadcrumbs="['dashboard.sliders.edit', $slider]">
    {{ BsForm::resource('sliders')->putModel($slider, route('dashboard.sliders.update', $slider)) }}
    @component('dashboard::components.box')
        @slot('title', trans('sliders.actions.edit'))

        @include('dashboard.sliders.partials.form')

        @slot('footer')
            {{ BsForm::submit()->label(trans('sliders.actions.save')) }}
        @endslot
    @endcomponent
    {{ BsForm::close() }}
</x-layout>