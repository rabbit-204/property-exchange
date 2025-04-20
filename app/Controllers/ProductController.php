<?php
// require_once __DIR__ . '/../Models/ProductModel.php';
require_once __DIR__ . '/../Models/ProductModel.php';

class ProductController extends BaseController
{
    public function __construct() {
        $this->productModel = new ProductModel();
    }

    public function index()
    {
        $limit = 6; 
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($page - 1) * $limit;

        $sellType = isset($_GET['sell_type']) && $_GET['sell_type'] !== 'All' ? trim($_GET['sell_type']) : null;
        $city = isset($_GET['city']) && $_GET['city'] !== 'All' ? trim($_GET['city']) : null;
        $type = isset($_GET['type_of_real_estate']) && $_GET['type_of_real_estate'] !== 'All' ? trim($_GET['type_of_real_estate']) : null;
        $priceRange = isset($_GET['price_range']) && $_GET['price_range'] !== 'All' ? trim($_GET['price_range']) : null;

        $search = isset($_GET['search']) ? trim($_GET['search']) : null;

        $listProduct = $this->productModel->filterProducts($search, $sellType, $city, $type, $priceRange, $limit, $offset);
        $totalProducts = $this->productModel->countFilteredProducts($search, $sellType, $city, $type, $priceRange);

        $totalPages = ceil($totalProducts / $limit);

        return $this->view('product.index', [
            'products' => $listProduct,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'search' => $search,
            'sell_type' => $sellType,
            'city' => $city,
            'type_of_real_estate' => $type,
            'price_range' => $priceRange
        ]);
    }

    
}
?>
