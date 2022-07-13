<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreAssetRequest extends FormRequest
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
            "name" => "required|string",
            "description" => "sometimes|nullable|string",
            "code" => "sometimes|nullable|string",
            "serial_number" => "sometimes|nullable|string",
            "manufacturer" => "sometimes|nullable|string",
            "model" => "sometimes|nullable|string",
            "purchase_date" => "sometimes|nullable|date",
            "asset_category_id" => "required|integer|exists:asset_categories,id",

        ];
    }
}
