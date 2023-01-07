<?php

namespace App\Http\Controllers\Dashboard;

use App\Events\OrderMarkedAsAssignedToDelegate;
use App\Models\Order;
use App\Models\ShopOrder;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Requests\Dashboard\OrderRequest;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


use App\Models\User;
use App\Traits\NotificationsTrait;
use App\Models\Notification as NotificationModel;
use App\Models\Delegate;
use Laraeast\LaravelSettings\Facades\Settings;
use App\Models\Notification;
class OrderController extends Controller
{
  

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::with('user')->filter()->latest()->paginate();

        return view('dashboard.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.orders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Dashboard\OrderRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(OrderRequest $request)
    {
        $order = Order::create($request->all());

        flash()->success(trans('orders.messages.created'));

        return redirect()->route('dashboard.orders.show', $order);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Order $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $added = Settings::get('added');
        return view('dashboard.orders.show', compact('order','added'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Order $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        return view('dashboard.orders.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Dashboard\OrderRequest $request
     * @param \App\Models\Order $order
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Order $order)
    {
        $order->status = $request->status;
        $order->save();
        $this->sendnotfation($order,$request->status);
        flash()->success(trans('orders.messages.updated'));

        return redirect()->route('dashboard.orders.show', $order);
    }

    public function assignDelegate(Request $request, ShopOrder $shopOrder)
    {
        $this->authorize('markAsAssignedToDelegate', $shopOrder);

        $request->validate([
            'delegate_id' => 'required|exists:users,id',
        ]);

        $shopOrder->forceFill([
            'status' => Order::ASSIGNED_TO_DELEGATE_STATUS,
            'delegate_id' => $request->delegate_id,
        ])->save();

        $shopOrder->refresh()->load('items.product');
        $Delegate = Delegate::findorfail($request->delegate_id);
     
        broadcast(new OrderMarkedAsAssignedToDelegate($shopOrder))->toOthers();
        return back();
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Order $order
     * @throws \Exception
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Order $order)
    {
        $order->delete();

        flash()->success(trans('orders.messages.deleted'));

        return redirect()->route('dashboard.orders.index');
    }

    /**
     * Display a listing of the trashed resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trashed()
    {
        $this->authorize('viewAnyTrash', Order::class);

        $orders = Order::onlyTrashed()->paginate();

        return view('dashboard.orders.trashed', compact('orders'));
    }

    /**
     * Display the specified trashed resource.
     *
     * @param \App\Models\Order $order
     * @return \Illuminate\Http\Response
     */
    public function showTrashed(Order $order)
    {
        $this->authorize('viewTrash', $order);

        return view('dashboard.orders.show', compact('order'));
    }

    /**
     * Restore the trashed resource.
     *
     * @param \App\Models\Order $order
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore(Order $order)
    {
        $this->authorize('restore', $order);

        $order->restore();

        flash()->success(trans('orders.messages.restored'));

        return redirect()->route('dashboard.orders.trashed');
    }

    /**
     * Force delete the specified resource from storage.
     *
     * @param \App\Models\Order $order
     * @throws \Exception
     * @return \Illuminate\Http\RedirectResponse
     */
    public function forceDelete(Order $order)
    {
        $this->authorize('forceDelete', $order);

        $order->forceDelete();

        flash()->success(trans('orders.messages.deleted'));

        return redirect()->route('dashboard.orders.trashed');
    }

    public function sendnotfation($order,$status)
    {
        switch ($status) {
            case Notification::PROCESSING_TYPE:
                NotificationsTrait::send($order->user,"قيد التجهيز الطلب","قيد التجهيز الطلب رقم",NotificationModel::PROCESSING_TYPE,$order->id);
                break;

            case Notification::Assign_Delegete_TYPE:
                NotificationsTrait::send($order->user,"تم تسليم للمندوب الطلب ","تم تسليم للمندوب الطلب رقم",NotificationModel::Assign_Delegete_TYPE,$order->id);
                break;
            case Notification::FINSH_ORDER_TYPE:
                NotificationsTrait::send($order->user,"تم الانتهاء من الطلب ","تم الانتهاء من الطلب رقم",NotificationModel::FINSH_ORDER_TYPE,$order->id);
                break;

    
        }
    }
}
