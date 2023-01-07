<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SliderResource extends JsonResource
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
            'model_id' => $this->slidertable_id,
            'type' => $this->slidertable_type,
            'banner_phone' => $this->getFirstMediaUrl('image_phone'),
            'banner_web' =>  $this->getFirstMediaUrl('image_web'),

         
        ];
    }
}
