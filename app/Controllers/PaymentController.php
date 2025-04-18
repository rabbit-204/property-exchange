<?php
require_once __DIR__ . '/../../vendor/autoload.php';
use PayOS\PayOS;

class PaymentController
{
    public function create()
    {
        $payOS = new PayOS("e7c0a175-9a65-44ea-b3d6-03eab89585c7", "4ecfc1d7-0a71-4bd4-82d3-470c3d3b95ed", "9ca8acb2258ac33cce858598829db75b16e6baa12bc44cde14c0ac685e6366ac");
        $YOUR_DOMAIN = "http://localhost"; // tùy cấu hình của bạn

        $data = [
            "orderCode" => intval(substr(strval(microtime(true) * 10000), -6)),
            "amount" => 2000,
            "description" => "Create payment link",
            "items" => [
                [
                    "name" => "Mỳ tôm Hảo Hảo ly",
                    "quantity" => 1,
                    "price" => 2000
                ]
            ],
            "returnUrl" => $YOUR_DOMAIN . "/success.html",
            "cancelUrl" => $YOUR_DOMAIN . "/cancel.html"
        ];

        try {
            $response = $payOS->createPaymentLink($data);
            $checkoutUrl = $response['checkoutUrl'];

            // Truyền sang View
            include './Views/Payment/qr_page.php';

        } catch (\Throwable $th) {
            echo "Lỗi tạo liên kết thanh toán: " . $th->getMessage();
        }
    }
}
