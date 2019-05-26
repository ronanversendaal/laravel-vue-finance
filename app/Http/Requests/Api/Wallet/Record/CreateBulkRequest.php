<?php

namespace App\Http\Requests\Api\Wallet\Record;

use Illuminate\Foundation\Http\FormRequest;

class CreateBulkRequest extends FormRequest
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
            'records.*.currencyId' => 'required|string',
            'records.*.accountId' => 'required|string',
            'records.*.categoryId' => 'required|string',
            'records.*.amount' => 'required|numeric',
            'records.*.paymentType' => 'required|in:cash,debit_card,credit_card,transfer,voucher,mobile_payment,web_payment',
            'records.*.note' => 'string',
            'records.*.date' => 'date',
            'records.*.recordState' => 'in:reconciled,cleared,uncleared,void',
            'records.*.transferId' => 'string'
        ];
    }
}
