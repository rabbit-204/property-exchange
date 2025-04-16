<?php
require_once __DIR__ . '/../Models/ProductModel.php';

class ProductController extends BaseController
{
    public function __construct() {
        $this->productModel = new ProductModel();
    }

    public function index()
    {
        $listProduct = $this->productModel->getAllProducts();
        return $this->view('product.index', ['products' => $listProduct]);  // Truyền dữ liệu vào view
    }
}
?>
