<?php

namespace Cms\Http\Requests\Commerce;

use Cms\Models\Commerce\Transaction;

class TransactionsRequest extends CommerceRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return app(Transaction::class)->rules;
    }
}
