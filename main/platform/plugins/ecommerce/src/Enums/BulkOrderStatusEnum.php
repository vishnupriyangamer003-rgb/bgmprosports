<?php

namespace Botble\Ecommerce\Enums;

use Botble\Base\Facades\BaseHelper;
use Botble\Base\Supports\Enum;
use Illuminate\Support\HtmlString;

/**
 * @method static BulkOrderStatusEnum NEW()
 * @method static BulkOrderStatusEnum CONTACTED()
 * @method static BulkOrderStatusEnum PROCESSING()
 * @method static BulkOrderStatusEnum COMPLETED()
 * @method static BulkOrderStatusEnum CANCELLED()
 */
class BulkOrderStatusEnum extends Enum
{
    public const NEW = 'new';

    public const CONTACTED = 'contacted';

    public const PROCESSING = 'processing';

    public const COMPLETED = 'completed';

    public const CANCELLED = 'cancelled';

    public static $langPath = 'plugins/ecommerce::bulk-order.statuses';

    public function toHtml(): HtmlString|string
    {
        $color = match ($this->value) {
            self::NEW => 'info',
            self::CONTACTED => 'warning',
            self::PROCESSING => 'primary',
            self::COMPLETED => 'success',
            self::CANCELLED => 'danger',
            default => 'secondary',
        };

        return BaseHelper::renderBadge($this->label(), $color, icon: $this->getIcon());
    }

    public function getIcon(): string
    {
        return match ($this->value) {
            self::NEW => 'ti ti-sparkles',
            self::CONTACTED => 'ti ti-phone-outgoing',
            self::PROCESSING => 'ti ti-refresh',
            self::COMPLETED => 'ti ti-circle-check',
            self::CANCELLED => 'ti ti-circle-x',
            default => 'ti ti-circle',
        };
    }
}
