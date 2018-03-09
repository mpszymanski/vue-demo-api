<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ReceiptRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'phone' => 'nullable|regex:/^[ +0-9]*$/',
            'shop_zip' => 'regex:/^[0-9]{3}[ ]?[0-9]{3}$/',
            'code' => [
                'regex:/^[0-9]*$/',
                Rule::unique('receipts')->where('shop_zip', $this->shop_zip),
            ],
            'image' => 'image',
        ];
    }
}
