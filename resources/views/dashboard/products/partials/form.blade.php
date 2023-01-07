@include('dashboard.errors')
@bsMultilangualFormTabs

{{ BsForm::text('name') }}
{{ BsForm::textarea('description')->attribute('class', 'textarea') }}
@endBsMultilangualFormTabs

{{ BsForm::number('price')->min(1)->step('any') }}
{{ BsForm::number('offer_price')->min(1)->step('any') }}
{{ BsForm::number('quantity')->min(0) }}
{{ BsForm::checkbox('has_discount')->value(1)->withDefault()->checked($product->has_discount ?? old('has_discount')) }}
<categories-select
        label="القسم الرئيسي"
        placeholder="@lang('shops.select')"
        nested-label="@lang('categories.subcategory')"
        nested-placeholder="@lang('categories.select-subcategory')"
        value="{{ $product->category_id ?? old('category_id') }}"
        category-value="{{ $product->category_id ?? old('category_id') }}"
></categories-select>

<colors-component :colors="{{ isset($product) ? json_encode($product->colors) : '[]' }}"></colors-component>

@isset($product)
    {{ BsForm::image('images')->unlimited()->files($product->getMediaResource()) }}
@else
    {{ BsForm::image('images')->unlimited() }}
@endisset

