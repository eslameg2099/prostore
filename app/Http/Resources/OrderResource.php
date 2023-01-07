<?php

namespace App\Http\Resources;

use App\Support\Date;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'address' => new AddressResource($this->address),
            'status_order'=>$this->getStatus(),
            'coupon'=> $this->coupon->code ?? null,
            'sub_total' => price($this->sub_total),
            'discount' => price($this->discount),
            'shipping_cost' => price($this->shipping_cost),
            'total' => price(($this->sub_total + $this->shipping_cost)-$this->discount),
            'create_at' => new Date($this->created_at),
            'shipments_count' => $this->items()->count(),
            'payment_method' => $this->payment_method,
            'readable_payment_method' => trans('orders.payments.'.$this->payment_method),
            'shipments' => ShopOrderProductResource::collection($this->items),
        ];
    }
}
