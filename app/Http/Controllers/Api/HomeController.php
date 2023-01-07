<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\CategoryOffersResource;
use App\Http\Resources\SliderResource;
use App\Models\Slider;
use Laraeast\LaravelSettings\Facades\Settings;
use App\Models\Product;
use App\Http\Resources\ProductResource;
use db;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function __invoke(Request $request)
    {
      
    
        $offers = [];
        $most_seller = Product::whereHas('items', function ($query) {
            $query->selectRaw('products.*, SUM(orderitems.quantity) AS quantity_sold')
            ->groupBy(['products.id']) // should group by primary key
            ->orderByDesc('quantity_sold')
            ->take(4);
        })->get();
          
       
        $categories = Category::whereHas('products')->where('display_in_home', true)->paginate();

        foreach ($categories as $category) {
            $category->load([
                'products' => function ($builder) {
                    $builder->offersFirst()->limit(5)->get();
                },
            ]);
        }
        return CategoryOffersResource::collection($categories)->additional([
            'sliders' => SliderResource::collection(Slider::wherehas('media')->active()->inRandomOrder()->limit(4)->get()),
            'categories' => CategoryResource::collection(Category::parentsOnly()->inRandomOrder()->paginate()),
            'code'=>Settings::get('code') ,
            'currency'=>Settings::get('currency'),
            'last_products'=> ProductResource::collection(Product::orderBy('created_at', 'desc')->limit(4)->get()),
            'most_seller'=>ProductResource::collection($most_seller),
        ]);
    }
}
