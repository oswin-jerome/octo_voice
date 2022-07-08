<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreExpenseRequest extends FormRequest
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
            'expense_category_id' => 'required|exists:expense_categories,id',
            'amount' => 'required|numeric',
            'description' => 'required|string',
            'invoice_id' => 'sometimes|nullable|exists:invoices,id',
        ];
    }
}
