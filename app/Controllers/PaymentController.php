<?php
require_once __DIR__ . '/../../vendor/autoload.php';
use PayOS\PayOS;

class PaymentController
{
    public function create()
    {
        $payOS = new PayOS("e7c0a175-9a65-44ea-b3d6-03eab89585c7", "4ecfc1d7-0a71-4bd4-82d3-470c3d3b95ed", "9ca8acb2258ac33cce858598829db75b16e6baa12bc44cde14c0ac685e6366ac");
        $YOUR_DOMAIN = "http://localhost"; // tùy cấu hình của bạn

        // Lấy dữ liệu từ form
        $productId = $_POST['product_id'];
        $productName = $_POST['product_name'];
        $productPrice = $_POST['product_price'];
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $now = new DateTime();
        $minute = $now->format('i');
        $hour = $now->format('H');
        $day = $now->format('d');
        $month = $now->format('m');
        $year = $now->format('Y');
        $data = [
            "orderCode" => intval(substr(strval(microtime(true) * 10000), -6)), // Mã đơn hàng ngẫu nhiên
            "amount" => $productPrice/100000, // Giá sản phẩm
            "description" =>  $hour . " gio " . $minute . " phut ", // Mô tả đơn hàng
            "items" => [ 
                [
                    "name" => $productName,
                    "quantity" => 1,
                    "price" => $productPrice/100000
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
