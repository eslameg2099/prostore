<x-layout :title="trans('sliders.actions.create')" :breadcrumbs="['dashboard.categories.create']">
    {{ BsForm::resource('sliders')->post(route('dashboard.sliders.store')) }}
    @component('dashboard::components.box')
        @slot('title', trans('sliders.actions.create'))

        @include('dashboard.sliders.partials.form')

        @slot('footer')
            {{ BsForm::submit()->label(trans('sliders.actions.save')) }}
        @endslot
    @endcomponent
    {{ BsForm::close() }}
</x-layout>