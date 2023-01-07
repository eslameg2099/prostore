<?php /** @var \App\Models\Order $order */ ?>
<x-layout :title="$order->name" :breadcrumbs="['dashboard.orders.show', $order]">
    <div class="row">
        <div class="col-md-5">
            <h4>{{ trans('orders.singular') }}</h4>
            @component('dashboard::components.box')
                @slot('class', 'p-0')
                @slot('bodyClass', 'p-0')

                <table class="table table-striped table-middle">
                    <tbody>
                    <tr>
                        <th width="200">@lang('orders.attributes.id')</th>
                        <td>{{ $order->id }}</td>
                    </tr>
                    <tr>
                        <th width="200">@lang('orders.attributes.status')</th>
                        <td>{{ $order->getReadableStatus() }}
                        
                        </td>
                        
                    </tr>
                   
                    <tr>
                        <th width="200">@lang('orders.attributes.user_id')</th>
                        <td>{{ $order->user->name ?? '_' }}</td>
                    </tr>
                    <tr>
                        <th width="200">  @lang('orders.attributes.coupon')</th>
                        <td>{{ $order->coupon->code ?? '_'}} / نسبة الخصم: {{ $order->coupon->percentage_value ?? '_'}} </td>
                    </tr>
                    <tr>
                        <th width="200">@lang('orders.attributes.total_order')</th>
                        <td>{{ price($order->sub_total) }}</td>
                    </tr>
                    <tr>
                        <th width="200">@lang('orders.attributes.shipping_cost')</th>
                        <td>{{ price($order->shipping_cost) }}</td>
                    </tr>
                    <tr>
                        <th width="200">@lang('orders.attributes.discount')</th>
                        <td>{{ price($order->discount) }}</td>
                    </tr>
                    <tr>
                        <th width="200">@lang('orders.attributes.total')</th>
                        <td>{{ price(($order->sub_total + $order->shipping_cost)-$order->discount) }}</td>
                    </tr>
                 
                 
                    
                    <tr>
                        <th width="200">@lang('orders.attributes.created_at')</th>
                        <td>{{ new \App\Support\Date($order->created_at) }}</td>
                    </tr>
                    <tr>
                    <th width="200"> @lang('admins.attributes.fulladd')</th>
                       
                       <td>{{ $order->address->cities[0]->name ?? '_'  }} /{{ $order->address->cities[1]->name ?? '_'  }}/ {{ $order->address->cities[2]->name ?? '_'  }}/ {{ $order->address->cities[3]->name ?? '_'  }} </td>
                   </tr>
                    </tr>
                    </tbody>
                </table>

                @slot('footer')
                    @include('dashboard.orders.partials.actions.edit')
                    @include('dashboard.orders.partials.actions.delete')
                    @include('dashboard.orders.partials.actions.restore')
                    @include('dashboard.orders.partials.actions.forceDelete')
                @endslot
            @endcomponent
        </div>
        <div class="col-md-7">
            <h4>{{ trans('products.plural') }}</h4>
            <div class="card card-secondary card-outline card-outline-tabs">
                <div class="card-header p-0 border-bottom-0">
                    <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                     
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-four-tabContent">
                        @foreach($order->items as $item)
                          

                                <div class="row">
                              
                                    <div class="col-md-6">
                                      
                                    </div>
                                </div>
                                <h5 class="my-2"></h5>
                                <table class="table table-hover table-striped table-valign-middle mt-2">
                                    <thead>
                                    <tr>
                                        <th>@lang('products.singular')</th>
                                        <th>@lang('orders.attributes.quantity')</th>
                                        <th>@lang('orders.attributes.size')</th>
                                        <th>@lang('orders.attributes.color')</th>
                                        <th>@lang('orders.attributes.total')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($order->items as $item)
                                        <tr>
                                            <td>@include('dashboard.products.partials.actions.link', ['product' => $item->product])</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>{{ data_get($item->size, 'size') ?: '---' }}</td>
                                            <td>{{ data_get($item->color, 'name') ?: '---' }}</td>
                                            <td>{{ price($item->total) }}</td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</x-layout>
