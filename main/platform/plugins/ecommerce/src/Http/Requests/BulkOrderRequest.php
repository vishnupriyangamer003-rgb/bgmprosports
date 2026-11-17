<?php

namespace Botble\Ecommerce\Http\Requests;

use Botble\Base\Rules\EmailRule;
use Botble\Base\Rules\PhoneNumberRule;
use Botble\Support\Http\Requests\Request;

class BulkOrderRequest extends Request
{
    protected $errorBag = 'bulkOrder';

    public function rules(): array
    {
        return [
            'full_name' => ['required', 'string', 'max:120'],
            'company_name' => ['required', 'string', 'max:191'],
            'phone' => ['required', new PhoneNumberRule()],
            'email' => ['nullable', new EmailRule(), 'max:120'],
            'customer_type' => ['required', 'string', 'max:60'],
            'products' => ['required', 'array', 'min:1'],
            'products.*.name' => ['required', 'string', 'max:191'],
            'products.*.quantity' => ['required', 'integer', 'min:1'],
            'products.*.unit' => ['nullable', 'string', 'max:60'],
            'attachment' => ['nullable', 'file', 'max:5120'],
            'message' => ['nullable', 'string', 'max:5000'],
            'address' => ['required', 'string', 'max:2000'],
            'city' => ['required', 'string', 'max:120'],
            'state' => ['required', 'string', 'max:120'],
            'pincode' => ['required', 'string', 'max:20'],
            'gstin' => ['nullable', 'string', 'max:30'],
        ];
    }

    public function attributes(): array
    {
        return [
            'full_name' => trans('plugins/ecommerce::bulk-order.fields.full_name'),
            'company_name' => trans('plugins/ecommerce::bulk-order.fields.company_name'),
            'phone' => trans('plugins/ecommerce::bulk-order.fields.phone'),
            'email' => trans('plugins/ecommerce::bulk-order.fields.email'),
            'customer_type' => trans('plugins/ecommerce::bulk-order.fields.customer_type'),
            'attachment' => trans('plugins/ecommerce::bulk-order.fields.attachment'),
            'address' => trans('plugins/ecommerce::bulk-order.fields.address'),
            'city' => trans('plugins/ecommerce::bulk-order.fields.city'),
            'state' => trans('plugins/ecommerce::bulk-order.fields.state'),
            'pincode' => trans('plugins/ecommerce::bulk-order.fields.pincode'),
        ];
    }
}
