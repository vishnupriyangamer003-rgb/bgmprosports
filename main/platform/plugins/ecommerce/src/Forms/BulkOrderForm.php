<?php

namespace Botble\Ecommerce\Forms;

use Botble\Base\Forms\FieldOptions\StatusFieldOption;
use Botble\Base\Forms\FieldOptions\TextareaFieldOption;
use Botble\Base\Forms\Fields\SelectField;
use Botble\Base\Forms\Fields\TextareaField;
use Botble\Base\Forms\FormAbstract;
use Botble\Ecommerce\Enums\BulkOrderStatusEnum;
use Botble\Ecommerce\Http\Requests\EditBulkOrderRequest;
use Botble\Ecommerce\Models\BulkOrder;

class BulkOrderForm extends FormAbstract
{
    public function setup(): void
    {
        $this
            ->model(BulkOrder::class)
            ->setValidatorClass(EditBulkOrderRequest::class)
            ->add(
                'status',
                SelectField::class,
                StatusFieldOption::make()
                    ->choices(BulkOrderStatusEnum::labels())
            )
            ->add(
                'admin_note',
                TextareaField::class,
                TextareaFieldOption::make()
                    ->label(trans('plugins/ecommerce::bulk-order.fields.admin_note'))
                    ->rows(4)
            )
            ->setBreakFieldPoint('status')
            ->addMetaBoxes([
                'bulk_order_details' => [
                    'title' => trans('plugins/ecommerce::bulk-order.enquiry_details'),
                    'content' => view('plugins/ecommerce::bulk-orders.details', ['bulkOrder' => $this->getModel()])->render(),
                ],
            ]);
    }
}
