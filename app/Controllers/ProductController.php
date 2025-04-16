<?php
require_once __DIR__ . '/../Models/ProductModel.php';

class ProductController extends BaseController
{
    public function __construct() {
        // Khởi tạo ProductModel trong constructor
        $this->productModel = new ProductModel();
    }

    public function index()
    {
        // Sử dụng trực tiếp $this->productModel đã khởi tạo
        $listProduct = $this->productModel->getAllProducts();
        echo '<script>console.log(' . json_encode($listProduct) . ');</script>';
        return $this->view('product.index', ['products' => $listProduct]);  // Truyền dữ liệu vào view
    }
}
?>
