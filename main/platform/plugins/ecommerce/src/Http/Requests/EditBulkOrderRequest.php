<?php

namespace Botble\Ecommerce\Http\Requests;

use Botble\Ecommerce\Enums\BulkOrderStatusEnum;
use Botble\Support\Http\Requests\Request;
use Illuminate\Validation\Rule;

class EditBulkOrderRequest extends Request
{
    public function rules(): array
    {
        return [
            'status' => ['required', Rule::in(BulkOrderStatusEnum::values())],
            'admin_note' => ['nullable', 'string', 'max:5000'],
        ];
    }
}
