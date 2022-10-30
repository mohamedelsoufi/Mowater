<?php

namespace App\Http\Resources\TireExchangeCenter;

use Illuminate\Http\Resources\Json\JsonResource;

class GetTireExchangeOffersResource extends JsonResource
{
    public function toArray($request)
    {
        $data = [];

        $data["id"] = $this->id;
        $data["one_image"] = $this->one_image;
        $data["name"] = $this->name;
        $data["description"] = $this->description;
        $data["tire_exchange_id"] = $this->tire_exchange_center_id;
        $data["tire_exchange"] = $this->tireExchangeCenter->name;
        $data["price"] = $this->price;
        $data["is_mowater_card"] = $this->is_mowater_card;
        if ($this->is_mowater_card === true){
            $data["card_discount_value"] = $this->card_discount_value;
            $data["card_price_after_discount"] = $this->card_price_after_discount;
            $data["card_number_of_uses_times"] = $this->card_number_of_uses_times;
            $data["notes"] = $this->notes;
        }else{
            $data["discount_type"] = $this->discount_type;
            $data["discount"] = $this->discount;
            $data["price_after_discount"] = $this->price_after_discount;
        }
        $data["number_of_views"] = $this->number_of_views;
        $data["active_number_of_views"] = $this->active_number_of_views;
        $data["available"] = $this->available;
        $data["active"] = $this->active;

        return $data;
    }
}
