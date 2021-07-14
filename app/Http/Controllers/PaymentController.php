<?php

namespace App\Http\Controllers;

use App\Factories\PaymentFactory;
use App\Models\Payment;
use App\Repositories\PaymentRepository;
use App\Repositories\ProductRepository;
use App\Services\PaymentService;
use App\Values\PaymentStatusValue;
use Illuminate\Support\Collection;

class PaymentController extends Controller
{
    private $paymentRepository;
    private $paymentFactory;

    public function __construct(PaymentRepository $paymentRepository, PaymentFactory $paymentFactory)
    {
        $this->paymentRepository = $paymentRepository;
        $this->paymentFactory = $paymentFactory;
    }

    public function add()
    {
        $paymentInstance = $this->paymentFactory->createInstance(request()->input('products_ids'));
        $payment = $this->paymentRepository->save($paymentInstance);

        return response()->json($payment);
    }
}
