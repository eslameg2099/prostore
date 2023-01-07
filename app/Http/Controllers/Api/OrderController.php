<?php

namespace App\Http\Controllers\Api;
use App\Models\Coupon;
use App\Models\UserCoupon;


use App\Models\Order;
use Illuminate\Http\Request;
use App\Support\Cart\CartServices;
use Illuminate\Routing\Controller;
use App\Http\Resources\OrderResource;
use App\Repositories\OrderRepository;
use App\Http\Resources\SelectResource;
use App\Http\Requests\Api\OrderRequest;
use App\Http\Resources\ShopOrderResource;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Illuminate\Support\Facades\Notification;
use App\Broadcasting\PusherChannel;
use App\Models\Notification as NotificationModel;
use App\Notifications\CustomNotification;
use Laraeast\LaravelSettings\Facades\Settings;

class OrderController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * The order repository instance.
     *
     * @var \App\Repositories\OrderRepository
     */
    private $repository;

    /**
     * Create Order Controller instance.
     *
     * @param \App\Repositories\OrderRepository $repository
     */
    public function __construct(OrderRepository $repository)
    {
        $this->middleware('auth:sanctum');

        $this->repository = $repository;
    }

    /**
     * Display a listing of the orders.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $orders = auth()->user()->orders()->filter()->latest()->simplePaginate();

        return OrderResource::collection($orders);
    }

    /**
     * Display a listing of the orders.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function shopOrders()
    {
        $orders = Order::filter()->simplePaginate();

        return OrderResource::collection($orders);
    }

    /**
     * Display the specified order.
     *
     * @param \App\Models\Order $order
     * @return \App\Http\Resources\OrderResource
     */
    public function show(Order $order)
    {
        return new OrderResource($order);
    }

    /**
     * Display the specified order.
     *
     * @param \App\Http\Requests\Api\OrderRequest $request
     * @return \App\Http\Resources\OrderResource
     */
    public function store(OrderRequest $request)
    {
        $cartServices = app(CartServices::class);

        $cart = $cartServices
            ->setUser($request->user())
            ->setIdentifier($request->header('cart-identifier'))
            ->getCart();

        if ($cart->items->isEmpty()) {
            throw ValidationException::withMessages([
                'cart' => [__('The cart is empty')],
            ]);
        }
        if (! $cart->address_id) {
            throw ValidationException::withMessages([
                'cart' => [__('The address is not set in the cart')],
            ]);
        }
        if (! $cart->payment_method) {
            throw ValidationException::withMessages([
                'cart' => [__('The payment method not set in the cart')],
            ]);
        }

        $order = $this
            ->repository
            ->setUser($request->user())
            ->create($cart);
           
            $coupon = Coupon::where('id', $cart->coupon_id)->first();
            if($coupon != null)
            {
                $coupon->used = $coupon->used + 1;
                $coupon->save();
                $UserCoupon = new UserCoupon();
                $UserCoupon->user_id =$order->user_id ;
                $UserCoupon->coupon_id  =$coupon->id ;
                $UserCoupon->save();
                $order->coupon_id = $coupon->id;
                $order->save();
            }

      
          

        //   $this->sendnotfation($order);
          //  $this->sendmail($order);
          

        return new OrderResource($order);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function select()
    {
        $orders = Order::filter()->simplePaginate();

        return SelectResource::collection($orders);
    }


  

   
}
