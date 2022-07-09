<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public static $wrap = '';
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
            "created_at" => $this->created_at->format('d M Y'),
            "updated_at" => $this->updated_at,
            "status" => $this->status,
            "customer_id" => $this->customer_id,

            "balance" => $this->balance,

            "expense" => $this->expenses()->sum("amount"),
            "profit" => $this->profit,
        ];
        // return parent::toArray($request);
    }
}
