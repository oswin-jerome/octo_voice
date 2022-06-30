<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreEstimateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "valid_till" => "required|date|max:255",
            "discount_type" => "required|string|max:255",
            "discount" => "required|numeric",
            "customer_id" => "required|exists:customers,id",
            "deliverables" => "required|array",
        ];
    }
}
