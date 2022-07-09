<?php

namespace App\Http\Resources;

use App\Models\Tax;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceWithTaxResource extends JsonResource
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

        $data =  parent::toArray($request);
        $data["taxes"] = $this->taxes;
        $data['total_amount'] = $this->total;
        $data['tax_amount'] = $this->getParticularTaxAmount($this->taxes);
        $taxes = Tax::whereIn('id', explode(',', request()->taxes))->get();
        $taxes->each(function ($tax) use (&$data) {
            $data['tax_' . $tax->id] = $this->sub_total * ($tax->value / 100);
        });
        return $data;
    }
}
