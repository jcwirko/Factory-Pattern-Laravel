<?php

namespace App\Services;

use Illuminate\Support\Str;

class PaymentService
{
    public function createPaymentIntent(int $amount, string $currency, $paymentMetadata)
    {
        return [
            'id' => Str::uuid(),
            'currency' => 'usd',
            'payment_method' => 'card',
            'receipt_email' => 'test@test.com',
            'created' => '1546532432',
            "client_secret" => "pi_1DoYvs2eZvKYlo2CXLOFBGXi_secret_t4gBYdKwdA9F2QayGJOAbIc31",
        ];
    }
}
