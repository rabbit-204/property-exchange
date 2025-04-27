<?php
require_once __DIR__ . '/../../vendor/autoload.php';
use PayOS\PayOS;

class PaymentController
{
    public function create()
    {
        $payOS = new PayOS("e7c0a175-9a65-44ea-b3d6-03eab89585c7", "4ecfc1d7-0a71-4bd4-82d3-470c3d3b95ed", "9ca8acb2258ac33cce858598829db75b16e6baa12bc44cde14c0ac685e6366ac");
        $YOUR_DOMAIN = "http://localhost"; 

        $productId = $_POST['product_id'];
        $productName = $_POST['product_name'];
        $productPrice = $_POST['product_price'];
        $Amount = 0;
        if ($productPrice > 1000000000) {
            $Amount = round($productPrice / 1000000, 2);
        } else if ($productPrice < 1000000000 && $productPrice > 1000000) {
            $Amount = round($productPrice / 1000, 2);
        } else{
            $Amount = round($productPrice / 1000, 2);
        }
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $now = new DateTime();
        $minute = $now->format('i');
        $hour = $now->format('H');
        $data = [
            "orderCode" => intval(substr(strval(microtime(true) * 10000), -6)), 
            "amount" => $Amount, 
            "description" =>  "{$hour} giờ {$minute} phút", 
            "items" => [ 
                [
                    "name" => $productName,
                    "quantity" => 1,
                    "price" => $Amount
                ]
            ],
            "returnUrl" => $YOUR_DOMAIN . "/success.html",
            "cancelUrl" => $YOUR_DOMAIN . "/cancel.html"
        ];

        try {

            $response = $payOS->createPaymentLink($data);
            echo json_encode([
                'success' => true,
                'checkoutUrl' => $response['checkoutUrl'], 
                'qrCode' => $response['qrCode'], 
            ]);
        } catch (\Throwable $th) {
            echo json_encode([
                'success' => false,
                'message' => "Lỗi tạo liên kết thanh toán: " . $th->getMessage(),
            ]);
        }
        exit;
    }
}