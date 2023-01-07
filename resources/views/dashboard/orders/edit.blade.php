<x-layout :title="$order->name" :breadcrumbs="['dashboard.orders.edit', $order]">
    {{ BsForm::resource('orders')->putModel($order, route('dashboard.orders.update', $order)) }}
    @component('dashboard::components.box')
        @slot('title', trans('orders.actions.edit'))

        <div class="form-group">
   
   <select name="status" class="form-control">
   <option  value=1> جاري التجهيز </option>
   <option  value=2>توصيل للمندوب </option>
   <option  value=4>تم الانتهاء من الطلب </option>

 
   </select>
</div>
        @slot('footer')
            {{ BsForm::submit()->label(trans('orders.actions.save')) }}
        @endslot
    @endcomponent
    {{ BsForm::close() }}
</x-layout>