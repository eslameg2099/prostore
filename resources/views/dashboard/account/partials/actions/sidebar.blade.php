@component('dashboard::components.sidebarItem')
   
    @slot('name', 'تقارير')
    @slot('icon', 'fas fa-window-restore')
    @slot('tree', [
        [
            'name' => 'المنتجات الاكتر مبيعا',
            'url' => route('dashboard.mostseller'),
          
            
        ],
        [
            'name' => 'تقرير المبيعات',
            'url' => route('dashboard.ordersreport'),
            
        ],
        [
            'name' => 'العملاء الاكتر شراء',
            'url' => route('dashboard.ordersusers'),
            
        ],
    ])
@endcomponent
