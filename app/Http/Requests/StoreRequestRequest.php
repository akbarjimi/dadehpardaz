<?php

namespace App\Http\Requests;

use App\Rules\ShebaValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequestRequest extends FormRequest
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
            'category_id' => 'required|integer|exists:categories,id',
            'desc' => 'required|min:3|max:65535',
            'amount' => 'required|integer|min:1000|max:1000000',
            'sheba' => ['required','numeric','digits_between:26,26', new ShebaValidationRule],
            'national_id' => 'required|numeric|digits_between:8,10|exists:users,national_id',
            'file' => 'file',
        ];
    }
}
