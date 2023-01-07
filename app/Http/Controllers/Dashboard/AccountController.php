<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class AccountController extends Controller
{
    public function mostseller()
    {
        $most_sellers = Product::
            leftJoin('orderitems','products.id','=','orderitems.product_id')
            ->selectRaw('products.*, COALESCE(sum(orderitems.quantity),0) total')
            ->groupBy('products.id')
            ->orderBy('total','desc')
            ->paginate();
        return view('dashboard.account.mostseller', compact('most_sellers'));

    }

    public function orders()
    {
        $orders = Order::filter()->latest()->withCount('items')->paginate();
        $sum_orders = $orders->sum('sub_total');
        return view('dashboard.account.orders', compact('orders','sum_orders'));
    }


    public function users()
    {
        $users = User::withCount('orders')->orderBy('orders_count', 'desc')->paginate();
        return view('dashboard.account.users', compact('users'));
    
    }
}
