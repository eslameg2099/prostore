<?php

Breadcrumbs::for('dashboard.home', function ($breadcrumb) {
    $breadcrumb->push(trans('dashboard.home'), route('dashboard.home'));
});




Breadcrumbs::for('dashboard.mostseller', function ($breadcrumb) {
    $breadcrumb->parent('dashboard.home');
    $breadcrumb->push('المنتجات الاكتر مبيعا', route('dashboard.mostseller'));
});


Breadcrumbs::for('dashboard.users', function ($breadcrumb) {
    $breadcrumb->parent('dashboard.home');
    $breadcrumb->push('العملاء الاكثر شراء', route('dashboard.ordersusers'));
});


Breadcrumbs::for('dashboard.sliders.index', function ($breadcrumb) {
    $breadcrumb->parent('dashboard.home');
    $breadcrumb->push(trans('sliders.plural'), route('dashboard.sliders.index'));
});



Breadcrumbs::for('dashboard.sliders.create', function ($breadcrumb) {
    $breadcrumb->parent('dashboard.sliders.index');
    $breadcrumb->push(trans('sliders.actions.create'), route('dashboard.sliders.create'));
});

Breadcrumbs::for('dashboard.sliders.show', function ($breadcrumb, $slider) {
    $breadcrumb->parent('dashboard.sliders.index');
    $breadcrumb->push($slider->id, route('dashboard.sliders.show', $slider));
});

Breadcrumbs::for('dashboard.sliders.edit', function ($breadcrumb, $slider) {
    $breadcrumb->parent('dashboard.sliders.show', $slider);
    $breadcrumb->push(trans('sliders.actions.edit'), route('dashboard.sliders.edit', $slider));
});
