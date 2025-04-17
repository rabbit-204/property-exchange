<?php
require_once __DIR__ . '/../Models/ProductModel.php';

class ProductController extends BaseController
{
    public function __construct() {
        $this->productModel = new ProductModel();
    }

    public function index()
    {
        $limit = 6; // Số sản phẩm trên mỗi trang
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Trang hiện tại
        $offset = ($page - 1) * $limit;

        // Lấy danh sách sản phẩm theo trang
        $listProduct = $this->productModel->getProductsByPage($limit, $offset);

        // Lấy tổng số sản phẩm để tính tổng số trang
        $totalProducts = $this->productModel->getTotalProducts();
        $totalPages = ceil($totalProducts / $limit);

        // Truyền dữ liệu sang view
        return $this->view('product.index', [
            'products' => $listProduct,
            'currentPage' => $page,
            'totalPages' => $totalPages
        ]);
    }
}
?>
