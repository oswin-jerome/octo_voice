<?php

namespace App\Traits;

trait HasCalculations
{
    public function getSubTotalAttribute()
    {
        return $this->deliverables->sum(function ($deliverable) {
            return $deliverable->pivot->quantity * $deliverable->pivot->amount_per_unit;
        });
    }

    public function getProfitAttribute()
    {
        return $this->sub_total  - $this->expenses->sum('amount') - $this->discount_amount;
    }

    public function getTotalAttribute()
    {
        $temp = $this->sub_total;
        $discount = $this->discount_amount;
        $taxAmount = $this->tax_amount;
        $temp = $temp + $taxAmount - $discount;
        return round($temp, 2);
    }

    public function getTaxAmountAttribute()
    {
        $temp = 0;
        $this->taxes()->each(function ($tax) use (&$temp) {
            $temp += ($this->sub_total - $this->discount_amount) * ($tax->value / 100);
        });
        return $temp;
    }

    public function getBalanceAttribute()
    {
        return $this->total - $this->paid_total;
    }

    public function getDiscountAmountAttribute()
    {
        if ($this->discount_type == "fixed") {
            return $this->discount;
        }
        return ($this->discount * $this->sub_total) / 100;
    }

    public function getSubTotalWithDiscountAttribute()
    {
        return $this->sub_total - $this->discount_amount;
    }

    public function getParticularTaxAmount($taxes)
    {
        $amount = 0;
        $taxes->each(function ($tax) use (&$amount) {
            $ta =  $this->taxes->find($tax);
            if ($ta) {
                $perc = $tax->value;
                $amount += ($this->sub_total - $this->discount_amount) * $perc / 100;
            }
        });


        return $amount;
    }
}
