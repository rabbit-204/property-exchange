<!DOCTYPE html>
<html>
<head>
    <title>Thanh toán qua QR</title>
</head>
<body>
    <h2>Quét mã QR để thanh toán</h2>
    <img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=<?= urlencode($checkoutUrl) ?>" alt="QR Code">
    <p>Hoặc <a href="<?= htmlspecialchars($checkoutUrl) ?>" target="_blank">nhấn vào đây</a> để thanh toán.</p>
</body>
</html>
