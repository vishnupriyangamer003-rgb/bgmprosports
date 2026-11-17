<?php

namespace Botble\Ecommerce\Tables;

use Botble\Ecommerce\Enums\BulkOrderStatusEnum;
use Botble\Ecommerce\Models\BulkOrder;
use Botble\Table\Abstracts\TableAbstract;
use Botble\Table\Actions\DeleteAction;
use Botble\Table\Actions\EditAction;
use Botble\Table\BulkActions\DeleteBulkAction;
use Botble\Table\BulkChanges\CreatedAtBulkChange;
use Botble\Table\BulkChanges\StatusBulkChange;
use Botble\Table\Columns\Column;
use Botble\Table\Columns\CreatedAtColumn;
use Botble\Table\Columns\IdColumn;
use Botble\Table\Columns\LinkableColumn;
use Botble\Table\Columns\StatusColumn;
use Illuminate\Database\Eloquent\Builder;

class BulkOrderTable extends TableAbstract
{
    public function setup(): void
    {
        $this
            ->model(BulkOrder::class)
            ->addActions([
                EditAction::make()->route('bulk-orders.edit'),
                DeleteAction::make()->route('bulk-orders.destroy'),
            ])
            ->addColumns([
                IdColumn::make(),
                LinkableColumn::make('code')
                    ->title(trans('plugins/ecommerce::bulk-order.fields.code'))
                    ->route('bulk-orders.edit')
                    ->alignStart(),
                Column::make('full_name')
                    ->title(trans('plugins/ecommerce::bulk-order.fields.full_name'))
                    ->alignStart(),
                Column::make('company_name')
                    ->title(trans('plugins/ecommerce::bulk-order.fields.company_name'))
                    ->alignStart(),
                Column::make('phone')
                    ->title(trans('plugins/ecommerce::bulk-order.fields.phone'))
                    ->alignStart(),
                Column::make('customer_type')
                    ->title(trans('plugins/ecommerce::bulk-order.fields.customer_type'))
                    ->alignStart(),
                CreatedAtColumn::make(),
                StatusColumn::make(),
            ])
            ->addBulkActions([
                DeleteBulkAction::make()->permission('bulk-orders.destroy'),
            ])
            ->addBulkChanges([
                StatusBulkChange::make()->choices(BulkOrderStatusEnum::labels()),
                CreatedAtBulkChange::make(),
            ])
            ->queryUsing(function (Builder $query) {
                return $query->select([
                    'id',
                    'code',
                    'full_name',
                    'company_name',
                    'phone',
                    'customer_type',
                    'created_at',
                    'status',
                ]);
            });
    }
}
