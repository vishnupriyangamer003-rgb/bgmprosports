<?php

namespace Botble\Ecommerce\Http\Controllers;

use Botble\Base\Http\Actions\DeleteResourceAction;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Ecommerce\Forms\BulkOrderForm;
use Botble\Ecommerce\Http\Requests\EditBulkOrderRequest;
use Botble\Ecommerce\Models\BulkOrder;
use Botble\Ecommerce\Tables\BulkOrderTable;

class BulkOrderController extends BaseController
{
    public function index(BulkOrderTable $dataTable)
    {
        $this->pageTitle(trans('plugins/ecommerce::bulk-order.name'));

        return $dataTable->renderTable();
    }

    public function edit(BulkOrder $bulkOrder)
    {
        $this
            ->breadcrumb()
            ->add(trans('plugins/ecommerce::bulk-order.name'), route('bulk-orders.index'));

        $this->pageTitle(trans('plugins/ecommerce::bulk-order.edit', ['code' => $bulkOrder->code]));

        return BulkOrderForm::createFromModel($bulkOrder)->renderForm();
    }

    public function update(BulkOrder $bulkOrder, EditBulkOrderRequest $request)
    {
        BulkOrderForm::createFromModel($bulkOrder)->setRequest($request)->save();

        return $this
            ->httpResponse()
            ->setPreviousRoute('bulk-orders.index')
            ->withUpdatedSuccessMessage();
    }

    public function destroy(BulkOrder $bulkOrder)
    {
        return DeleteResourceAction::make($bulkOrder);
    }
}
