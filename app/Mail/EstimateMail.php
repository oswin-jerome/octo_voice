<?php

namespace App\Mail;

use App\Models\Customer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EstimateMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $estimate;
    public function __construct($estimate)
    {
        $this->estimate = $estimate;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // dd(storage_path("h.pdf"));
        return $this->subject("Estimate")->view("mail.estimate", [
            "estimate" => $this->estimate,
            "customer" => Customer::find($this->estimate->customer_id)
        ])->attach(storage_path("h.pdf"));
    }
}
