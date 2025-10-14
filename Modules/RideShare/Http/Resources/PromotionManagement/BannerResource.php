<?php

namespace Modules\RideShare\Http\Resources\PromotionManagement;

use Illuminate\Http\Resources\Json\JsonResource;

class BannerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "name" => $this->title,
            "description" => $this->description,
            "time_period" => $this->time_period,
            "display_position" => $this->display_position,
            "redirect_link" => $this->default_link,
            "banner_group" => $this->banner_group,
            "start_date" => $this->start_date,
            "end_date" => $this->end_date,
            "image" => $this->image_full_url,
        ];
    }
}
