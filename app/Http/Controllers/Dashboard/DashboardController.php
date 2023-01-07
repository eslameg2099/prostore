<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Routing\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales_data = Order::select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(id) as sum')
        )->groupBy('month')->get();
        
        return view('dashboard.home', compact('sales_data'));
    }
}
