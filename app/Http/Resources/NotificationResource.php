<?php

namespace App\Http\Resources;

use App\Models\Meal;
use App\Models\Notification;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Kitchen;
use App\Models\Order;

class NotificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'type'=>$this->data["type"],
            'image' => 'https://fast.d.deli.work/storage/842/fast-logo-open-source-01.jpg',
            'body' =>$this->order_id. $this->data["body"],
            'title' => $this->order_id.$this->data["trans"],
            'is_read' => !!$this->read_at,
            'order_id ' => $this->order_id,
            'created_at' => $this->created_at->diffForHumans()
        ];
    }
   

}
