<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreAssetTransactionRequest extends FormRequest
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
            'description' => 'sometimes|nullable|string|max:255',
            'asset_id' => 'required|exists:assets,id',
            'user_id' => 'sometimes|nullable|exists:users,id',
            'type' => 'required|in:checkout,checkin,transfer,update',
            'purpose' => 'required|in:general,repair',
        ];
    }
}
