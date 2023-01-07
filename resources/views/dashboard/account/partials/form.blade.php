@include('dashboard.errors')

{{ BsForm::number('slidertable_id')->required() }}


<div class="form-group">
    <label>نوع المعلن</label>
    <select name="slidertable_type" class="form-control">
    <option selected="selected" value="product">
منتج
</option>
<option selected="selected" value="category">
قسم
</option>    
    </select>
</div>
{{ BsForm::checkbox('stauts')->value(1)->withDefault()->checked($slider->stauts ?? old('stauts')) }}

@isset($slider)
    {{ BsForm::image('image_phone')->files($slider->getMediaResource('image_phone')) }}
    {{ BsForm::image('image_web')->files($slider->getMediaResource('image_web')) }}

@else
    {{ BsForm::image('image_phone')->collection('image_phone')->required() }}
    {{ BsForm::image('image_web')->collection('image_web')->required() }}

@endisset