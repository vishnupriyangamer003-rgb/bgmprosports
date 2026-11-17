<x-core::datagrid>
    <x-core::datagrid.item>
        <x-slot:title>{{ trans('plugins/ecommerce::bulk-order.fields.code') }}</x-slot:title>
        {{ $bulkOrder->code }}
    </x-core::datagrid.item>

    <x-core::datagrid.item>
        <x-slot:title>{{ trans('plugins/ecommerce::bulk-order.fields.full_name') }}</x-slot:title>
        {{ $bulkOrder->full_name }}
    </x-core::datagrid.item>

    <x-core::datagrid.item>
        <x-slot:title>{{ trans('plugins/ecommerce::bulk-order.fields.company_name') }}</x-slot:title>
        {{ $bulkOrder->company_name }}
    </x-core::datagrid.item>

    <x-core::datagrid.item>
        <x-slot:title>{{ trans('plugins/ecommerce::bulk-order.fields.phone') }}</x-slot:title>
        <a href="tel:{{ $bulkOrder->phone }}">{{ $bulkOrder->phone }}</a>
    </x-core::datagrid.item>

    @if ($bulkOrder->email)
        <x-core::datagrid.item>
            <x-slot:title>{{ trans('plugins/ecommerce::bulk-order.fields.email') }}</x-slot:title>
            {{ Html::mailto($bulkOrder->email) }}
        </x-core::datagrid.item>
    @endif

    <x-core::datagrid.item>
        <x-slot:title>{{ trans('plugins/ecommerce::bulk-order.fields.customer_type') }}</x-slot:title>
        {{ $bulkOrder->customer_type }}
    </x-core::datagrid.item>

    <x-core::datagrid.item>
        <x-slot:title>{{ trans('plugins/ecommerce::bulk-order.fields.submitted_at') }}</x-slot:title>
        {{ $bulkOrder->created_at->translatedFormat('d M Y H:i:s') }}
    </x-core::datagrid.item>
</x-core::datagrid>

<x-core::datagrid class="mt-3">
    <x-core::datagrid.item>
        <x-slot:title>{{ trans('plugins/ecommerce::bulk-order.fields.address') }}</x-slot:title>
        {{ $bulkOrder->address }}, {{ $bulkOrder->city }}, {{ $bulkOrder->state }} - {{ $bulkOrder->pincode }}
    </x-core::datagrid.item>

    @if ($bulkOrder->gstin)
        <x-core::datagrid.item>
            <x-slot:title>{{ trans('plugins/ecommerce::bulk-order.fields.gstin') }}</x-slot:title>
            {{ $bulkOrder->gstin }}
        </x-core::datagrid.item>
    @endif
</x-core::datagrid>

<div class="mt-3">
    <label class="form-label fw-bold">{{ trans('plugins/ecommerce::bulk-order.fields.products') }}</label>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>{{ trans('plugins/ecommerce::bulk-order.fields.product_name') }}</th>
                <th>{{ trans('plugins/ecommerce::bulk-order.fields.quantity') }}</th>
                <th>{{ trans('plugins/ecommerce::bulk-order.fields.unit') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($bulkOrder->products ?: [] as $product)
                <tr>
                    <td>{{ $product['name'] ?? '-' }}</td>
                    <td>{{ $product['quantity'] ?? 0 }}</td>
                    <td>{{ $product['unit'] ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">{{ trans('plugins/ecommerce::bulk-order.no_products') }}</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if ($bulkOrder->attachment)
    <x-core::datagrid.item class="mt-3">
        <x-slot:title>{{ trans('plugins/ecommerce::bulk-order.fields.attachment') }}</x-slot:title>
        <a href="{{ RvMedia::getImageUrl($bulkOrder->attachment) }}" target="_blank" rel="noopener">
            {{ trans('plugins/ecommerce::bulk-order.view_attachment') }}
        </a>
    </x-core::datagrid.item>
@endif

<x-core::datagrid.item class="mt-3">
    <x-slot:title>{{ trans('plugins/ecommerce::bulk-order.fields.message') }}</x-slot:title>
    {{ $bulkOrder->message ?: '...' }}
</x-core::datagrid.item>
