<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "invoice_id" => "required|exists:invoices,id",
            "amount" => "required|numeric",
            "payment_method" => "required|string",
            "reference" => "required|string",
            "description" => "required|string",
        ];
    }
}
