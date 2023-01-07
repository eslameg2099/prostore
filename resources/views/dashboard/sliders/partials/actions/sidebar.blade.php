@component('dashboard::components.sidebarItem')
    @slot('url', route('dashboard.sliders.index'))
    @slot('name', trans('sliders.plural'))
    @slot('icon', 'fas fa-window-restore')
    @slot('tree', [
        [
            'name' => trans('sliders.actions.list'),
            'url' => route('dashboard.sliders.index'),
          
            'active' => request()->routeIs('*sliders.index')
            || request()->routeIs('*sliders.show'),
        ],
        [
            'name' => trans('sliders.actions.create'),
            'url' => route('dashboard.sliders.create'),
            'active' => request()->routeIs('*sliders.create'),
        ],
    ])
@endcomponent
