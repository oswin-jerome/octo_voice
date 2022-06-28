<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreCustomerRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'nullable|sometimes|string|max:255',
            'phone' => "nullable|sometimes|string|max:255",
            'address' => "nullable|sometimes|string|max:255",
            'city' => "nullable|sometimes|string|max:255",
            'state' => "nullable|sometimes|string|max:255",
            'zip' => "nullable|sometimes|string|max:255",
            'country' => "nullable|sometimes|string|max:255",
            'company' => "nullable|sometimes|string|max:255",
            'website' => "nullable|sometimes|string|max:255",
            'facebook' => "nullable|sometimes|string|max:255",
            'twitter' => "nullable|sometimes|string|max:255",
            'instagram' => "nullable|sometimes|string|max:255",
            'youtube' => "nullable|sometimes|string|max:255",
        ];
    }
}
