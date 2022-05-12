<?php

namespace App\Http\Requests;

use App\Models\Currency;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCurrencyRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('currency_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'max:255',
                'nullable',
            ],
            'symbol' => [
                'string',
                'max:255',
                'nullable',
            ],
        ];
    }
}
