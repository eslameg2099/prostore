<?php

namespace App\Http\Controllers\Api;

use App\Models\Coupon;
use Illuminate\Routing\Controller;
use App\Http\Resources\CouponResource;
use App\Http\Resources\SelectResource;

use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;

class CouponController extends Controller
{

    /**
     * Display a listing of the coupons.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $coupons = Coupon::filter()->simplePaginate();

        return CouponResource::collection($coupons);
    }

    /**
     * Display the specified coupon.
     *
     * @param \App\Models\Coupon $coupon
     * @return \App\Http\Resources\CouponResource
     */
    public function show(Coupon $coupon)
    {
        return new CouponResource($coupon);
    }


    public function applyCoupon($coupon)
    {
        /** @var \App\Models\Coupon $coupon */
        if (! $coupon = Coupon::where('code', $coupon)->first()) {
            throw ValidationException::withMessages([
                'coupon' => [__('The coupon you entered is invalid.')],
            ]);
        }
        if ($coupon->isExpired()) {
            throw ValidationException::withMessages([
                'coupon' => [__('The coupon you entered is expired.')],
            ]);
        }

        return response()->json(["data" => $coupon->get_discount($coupon)]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function select()
    {
        $coupons = Coupon::filter()->simplePaginate();

        return SelectResource::collection($coupons);
    }
}
