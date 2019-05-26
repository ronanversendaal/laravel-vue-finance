<?php

namespace App\Http\Requests\Api\Wallet\Record;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'currencyId' => 'string',
            'accountId' => 'string',
            'categoryId' => 'string',
            'amount' => 'numeric',
            'paymentType' => 'in:cash,debit_card,credit_card,transfer,voucher,mobile_payment,web_payment',
            'note' => 'string',
            'date' => 'date',
            'recordState' => 'in:reconciled,cleared,uncleared,void',
            'transferId' => 'string'
        ];
    }
}
