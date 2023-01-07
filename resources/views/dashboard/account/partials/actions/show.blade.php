@if(method_exists($slider, 'trashed') && $category->trashed())
  
@else
  
        <a href="{{ route('dashboard.sliders.show', $slider) }}" class="btn btn-outline-dark btn-sm">
            <i class="fas fa fa-fw fa-eye"></i>
        </a>
    
@endif