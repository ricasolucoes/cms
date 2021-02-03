<?php

namespace Cms\Http\Requests\Commerce;

use Cms\Models\Commerce\Coupon;

class CouponRequest extends CommerceRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return app(Coupon::class)->rules;
    }
}
