<?php

namespace App\Models;

use App\Mail\InvoiceMail;
use App\Traits\HasCalculations;
use App\Traits\HasFilterable;
use App\Traits\HasSearchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class Invoice extends Model
{
    use HasFactory, HasSearchable, HasFilterable, HasCalculations;

    protected $guarded = [];
    protected $searchable_fields = ['id', 'status'];
    protected $appends = array('total', 'sub_total_with_discount');
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function deliverables()
    {
        return $this->belongsToMany(Deliverable::class)->withPivot(['quantity', 'amount_per_unit']);
    }

    /**
     * Get all of the tags for the post.
     */
    public function taxes()
    {
        return $this->morphToMany(Tax::class, 'taxable');
    }

    public function payments()
    {
        return $this->morphMany(Payment::class, 'paymentable');
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }


    public function getPaidTotalAttribute()
    {
        return $this->payments()->sum('amount');
    }

    // public function getSubTotalAttribute()
    // {
    //     return $this->deliverables->sum(function ($deliverable) {
    //         return $deliverable->pivot->quantity * $deliverable->pivot->amount_per_unit;
    //     });
    // }

    // public function getProfitAttribute()
    // {
    //     return $this->sub_total  - $this->expenses->sum('amount') - $this->discount_amount;
    // }

    // public function getTotalAttribute()
    // {
    //     $temp = $this->sub_total;
    //     $discount = $this->discount_amount;
    //     $taxAmount = $this->tax_amount;
    //     $temp = $temp + $taxAmount - $discount;
    //     return $temp;
    // }

    // public function getTaxAmountAttribute()
    // {
    //     $temp = 0;
    //     $this->taxes()->each(function ($tax) use (&$temp) {
    //         $temp += ($this->sub_total - $this->discount_amount) * ($tax->value / 100);
    //     });
    //     return $temp;
    // }

    // public function getBalanceAttribute()
    // {
    //     return $this->total - $this->paid_total;
    // }

    // public function getDiscountAmountAttribute()
    // {
    //     if ($this->discount_type == "fixed") {
    //         return $this->discount;
    //     }
    //     return ($this->discount * $this->sub_total) / 100;
    // }

    // public function getSubTotalWithDiscountAttribute()
    // {
    //     return $this->sub_total - $this->discount_amount;
    // }

    // public function getParticularTaxAmount($taxes)
    // {
    //     $amount = 0;
    //     $taxes->each(function ($tax) use (&$amount) {
    //         $ta =  $this->taxes->find($tax);
    //         if ($ta) {
    //             $perc = $tax->value;
    //             $amount += ($this->sub_total - $this->discount_amount) * $perc / 100;
    //         }
    //     });


    //     return $amount;
    // }


    public function scopeOrdered($query)
    {
        return $query->orderBy('created_at', 'desc');
    }




    // Functions
    public function sendInvoice()
    {
        if ($this->customer->email) {
            Mail::to($this->customer->email)->send(new InvoiceMail($this));
        }
        if ($this->status == 'cancelled') {
            return;
        }
        $this->status = "sent";
        $this->save();

        if ($this->balance <= 0) {
            $this->status = "paid";
            $this->save();
        }
    }
}
