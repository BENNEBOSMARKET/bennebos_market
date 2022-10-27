<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PaymentRequest;
use App\Models\Order;
use App\Services\IyzicoPayment;
use Exception;

class PaymentController extends Controller
{
    public function __construct(IyzicoPayment $paymentService, ApiResponse $apiResponse)
    {
        $this->paymentService = $paymentService;
        $this->apiResponse = $apiResponse;
    }

    public function create(PaymentRequest $paymentRequest)
    {
        try {

            $payment = $this->paymentService->create($paymentRequest->validated());
            if ( $payment->getErrorCode() != null ) {
                return $this->apiResponse->setError($payment->getErrorMessage())->setData()->getJsonResponse();
            }

            $response = [
                "html_content" => $payment->getCheckoutFormContent(),
                "token" => $payment->getToken(),
                "status" => $payment->getStatus(),
                "url_page" => $payment->getPaymentPageUrl(),
            ];

            return $this->apiResponse->setSuccess("payment url page data is loaded successfully")
                ->setData($response)
                ->getJsonResponse();

        } catch (Exception $exception) {
            return $this->apiResponse->setError($exception->getMessage())->setData()->getJsonResponse();
        }
    }

    public function callback(Request $request)
    {
        try {
            $callbackResponse = $this->paymentService->callback("123456789", $request->token);
            if ($callbackResponse->getErrorCode() != null) {
                return $this->apiResponse->setError($callbackResponse->getErrorMessage())->setData()->getJsonResponse();
            }
            Order::where('id', $callbackResponse->getBasketId())
                ->update(['payment_status' => "paid", "payment_type" => "credit card", "payment_details" => "iyzico"]);
                // $this->paymentService->approveTransaction($callbackResponse->getPaymentId());
            return redirect()->route("front.checkoutSuccess");
        } catch (Exception $exception) {
            return $this->apiResponse->setError($exception->getMessage())->setData()->getJsonResponse();
        }
    }
}
