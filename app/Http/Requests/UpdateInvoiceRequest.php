<?php

namespace App\Http\Requests;

use App\Models\Invoice;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateInvoiceRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('invoice_edit');
    }

    public function rules()
    {
        return [
            'invoice_number' => [
                'required',
                'unique:invoices,invoice_number,' . request()->route('invoice')->id,
            ],
            'invoice_date' => [
                'date_format:' . config('panel.date_format'),
                'required',
            ]
        
        ];
    }
}
