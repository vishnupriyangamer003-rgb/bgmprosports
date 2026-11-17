<?php

namespace Botble\Ecommerce\Models;

use Botble\Base\Casts\SafeContent;
use Botble\Base\Models\BaseModel;
use Botble\Ecommerce\Enums\BulkOrderStatusEnum;

class BulkOrder extends BaseModel
{
    protected $table = 'ec_bulk_orders';

    protected $fillable = [
        'code',
        'full_name',
        'company_name',
        'phone',
        'email',
        'customer_type',
        'products',
        'message',
        'attachment',
        'delivery_location',
        'address',
        'city',
        'state',
        'pincode',
        'gstin',
        'admin_note',
        'status',
    ];

    protected $casts = [
        'status' => BulkOrderStatusEnum::class,
        'full_name' => SafeContent::class,
        'company_name' => SafeContent::class,
        'delivery_location' => SafeContent::class,
        'address' => SafeContent::class,
        'message' => SafeContent::class,
        'admin_note' => SafeContent::class,
        'products' => 'array',
    ];

    public function getTotalQuantityAttribute(): int
    {
        return (int) collect($this->products)->sum(fn ($product) => (int) ($product['quantity'] ?? 0));
    }
}
