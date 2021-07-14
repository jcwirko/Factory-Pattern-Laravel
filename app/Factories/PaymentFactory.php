<?php

namespace App\Factories;

use App\Models\Payment;
use App\Repositories\PaymentRepository;
use App\Repositories\ProductRepository;
use App\Services\PaymentService;
use App\Values\PaymentStatusValue;
use Illuminate\Support\Collection;

class PaymentFactory
{
    private $tax;
    private $currency;
    private $paymentService;
    private $productRepository;

    public function __construct(PaymentService $paymentService, ProductRepository $productRepository)
    {
        $this->paymentService = $paymentService;
        $this->productRepository = $productRepository;
        $this->currency = 'usd';
        $this->tax = 5;
    }

    public function createInstance(array $productsIds): Payment
    {
        $products = $this->productRepository->getByIds($productsIds);
        $subtotal = $products->sum('price');
        $amount = $this->addTaxToSubTotal($subtotal);
        $paymentMetadata = $this->generatePaymentMetadata($products, $subtotal);

        $paymentIntent = $this->paymentService->createPaymentIntent(
            $amount,
            $this->currency,
            $paymentMetadata
        );

        $paymentInstance = $this->getPaymentInstance([
            'status' => PaymentStatusValue::PENDING,
            'amount' => $amount,
            'products' => request()->input('products'),
            'payment_platform_id' => $paymentIntent['id'],
            'detail' => json_encode($paymentIntent),
            'user_id' => request()->input('user_id')
        ]);

        return $paymentInstance;
    }

    private function generatePaymentMetadata(Collection $products, float $subtotal): Collection
    {
        $metadata[] = $products->mapWithKeys(function($product) {
            return [
                str_replace(' ', '', ucwords($product['name'])) => $product['price']
            ];
        })->toArray();

        $metadata[] = [
            'subtotal' => $subtotal,
            'tax' => "$this->tax%",
            'amount' => $this->addTaxToSubTotal($subtotal)
        ];

        return collect(array_merge(...$metadata));
    }

    private function getPaymentInstance(array $attributes): Payment
    {
        return new Payment($attributes);
    }

    private function addTaxToSubTotal(int $price)
    {
        return $price * (1 + $this->tax / 100);
    }
}