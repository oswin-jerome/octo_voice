<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EstimateListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "valid_till" => $this->valid_till,
            "sub_total" => $this->sub_total,
            "discount" => $this->discount,
            "discount_type" => $this->discount_type,
            "total" => $this->total,
            "deliverables" => $this->deliverables,
            "customer" => $this->customer,
        ];
        // return parent::toArray($request);
    }
}
