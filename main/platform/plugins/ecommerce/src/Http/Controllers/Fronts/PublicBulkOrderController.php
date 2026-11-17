<?php

namespace Botble\Ecommerce\Http\Controllers\Fronts;

use Botble\Base\Http\Controllers\BaseController;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Ecommerce\Enums\BulkOrderStatusEnum;
use Botble\Ecommerce\Http\Requests\BulkOrderRequest;
use Botble\Ecommerce\Models\BulkOrder;
use Botble\Media\Facades\RvMedia;

class PublicBulkOrderController extends BaseController
{
    public function postSubmit(BulkOrderRequest $request): BaseHttpResponse
    {
        $products = collect($request->input('products', []))
            ->filter(fn ($product) => filled($product['name'] ?? null) && (int) ($product['quantity'] ?? 0) > 0)
            ->map(fn ($product) => [
                'name' => $product['name'],
                'quantity' => (int) $product['quantity'],
                'unit' => $product['unit'] ?: 'Pieces',
            ])
            ->values()
            ->all();

        $attachment = null;

        if ($request->hasFile('attachment')) {
            $result = RvMedia::handleUpload($request->file('attachment'), 0, 'bulk-orders');

            if ($result['error']) {
                return $this
                    ->httpResponse()
                    ->setError()
                    ->setMessage($result['message']);
            }

            $attachment = $result['data']->url ?? null;
        }

        $bulkOrder = BulkOrder::query()->create([
            'full_name' => $request->input('full_name'),
            'company_name' => $request->input('company_name'),
            'phone' => '+91' . preg_replace('/\D/', '', (string) $request->input('phone')),
            'email' => $request->input('email'),
            'customer_type' => $request->input('customer_type'),
            'products' => $products,
            'message' => $request->input('message'),
            'attachment' => $attachment,
            'address' => $request->input('address'),
            'city' => $request->input('city'),
            'state' => $request->input('state'),
            'pincode' => $request->input('pincode'),
            'gstin' => $request->input('gstin'),
            'status' => BulkOrderStatusEnum::NEW,
            'code' => 'TEMP',
        ]);

        $bulkOrder->code = 'TEX-BULK-' . str_pad((string) $bulkOrder->id, 5, '0', STR_PAD_LEFT);
        $bulkOrder->save();

        return $this
            ->httpResponse()
            ->setData([
                'code' => $bulkOrder->code,
                'whatsapp_url' => $this->buildWhatsAppUrl($bulkOrder, $products),
            ])
            ->setMessage(trans('plugins/ecommerce::bulk-order.submit_success'));
    }

    protected function buildWhatsAppUrl(BulkOrder $bulkOrder, array $products): string
    {
        $lines = [
            '*New Bulk Order Enquiry* (' . $bulkOrder->code . ')',
            '',
            '*Name:* ' . $bulkOrder->full_name,
            '*Company:* ' . $bulkOrder->company_name,
            '*Mobile:* ' . $bulkOrder->phone,
        ];

        if ($bulkOrder->email) {
            $lines[] = '*Email:* ' . $bulkOrder->email;
        }

        $lines[] = '*Customer Type:* ' . $bulkOrder->customer_type;
        $lines[] = '';
        $lines[] = '*Products:*';

        foreach ($products as $product) {
            $lines[] = '- ' . $product['name'] . ': ' . $product['quantity'] . ' ' . $product['unit'];
        }

        $lines[] = '';
        $lines[] = '*Address:* ' . $bulkOrder->address . ', ' . $bulkOrder->city . ', ' . $bulkOrder->state . ' - ' . $bulkOrder->pincode;

        if ($bulkOrder->gstin) {
            $lines[] = '*GSTIN:* ' . $bulkOrder->gstin;
        }

        if ($bulkOrder->message) {
            $lines[] = '';
            $lines[] = '*Requirement / Message:*';
            $lines[] = $bulkOrder->message;
        }

        $text = implode("\n", $lines);

        return 'https://wa.me/7200555565?text=' . rawurlencode($text);
    }
}
