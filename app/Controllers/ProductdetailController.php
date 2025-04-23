<?php

require_once __DIR__ . '/../Models/ProductModel.php';
class ProductdetailController extends BaseController
{
    private $productModel;
    
    public function __construct()
    {
        $this->productModel = new ProductModel();
    }
    
    public function index()
    {

        $id = isset($_GET['id']) ? trim($_GET['id']) : null;

        if (!$id) {
            echo '<script>console.log("ID không hợp lệ: ' . htmlspecialchars($_GET['id']) . '");</script>';
            die('ID không hợp lệ.');
            header('Location: index.php?controller=product&action=index');
            exit;
        }

        echo '<script>console.log("ID: ' . $id . '");</script>';

        $product = $this->productModel->getProductById($id);

        if (!$product) {
            die('Sản phẩm không tồn tại.');
        }

        if ($product['price'] >= 1000000000) {
            $product['formatted_price'] = round($product['price'] / 1000000000, 2) . ' tỷ';
        } else {
            $product['formatted_price'] = round($product['price'] / 1000000, 2) . ' triệu';
        }
        if ($product['area'] > 0) {
            $price_per_m2 = $product['price'] / $product['area'];
            if ($price_per_m2 >= 1000000000) {
                $product['price_per_m2'] = round($price_per_m2 / 1000000000, 2) . ' tỷ';
            } else {
                $product['price_per_m2'] = round($price_per_m2 / 1000000, 2) . ' triệu';
            }
        } else {
            $product['price_per_m2'] = '0';
        }

        $suggestedProducts = $this->productModel->getProductsByCity($product['city'], $id);

        if (count($suggestedProducts) < 3) {
            $randomProducts = $this->productModel->getRandomProducts(3 - count($suggestedProducts), $id);
            $suggestedProducts = array_merge($suggestedProducts, $randomProducts);
        }

        return $this->view('productdetail.index', ['product' => $product, 'suggestedProducts' => $suggestedProducts]);
    }

    public function admin()
    {
        $id = isset($_GET['id']) ? trim($_GET['id']) : null;

        if (!$id) {
            die('ID không hợp lệ.');
        }

        $product = $this->productModel->getProductById($id);

        if (!$product) {
            die('Sản phẩm không tồn tại.');
        }

        return $this->view('productDetailAdmin.index', ['product' => $product]);
    }
}
?>