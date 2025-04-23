<?php
require_once __DIR__ . '/../Models/ProductModel.php';

class ProductController extends BaseController
{
    private $productModel;
    public function __construct()
    {
        $this->productModel = new ProductModel();
    }
    public function create()
    {
        return $this->view('ProductAdmin.index', ['productFormData' => []]);
    }
    public function delete()
    {
        $id = $_GET['id'];
        $this->productModel->deleteProduct($id);
        header('Location: ?action=admin');
    }


    public function index()
    {
        $limit = 6;
        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
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

    public function admin()
    {
        $city = isset($_GET['city']) ? $_GET['city'] : null;
        $type = isset($_GET['type_of_real_estate']) ? $_GET['type_of_real_estate'] : null;
        $search = isset($_GET['search']) ? trim($_GET['search']) : null;

        $products = $this->productModel->filterByCityAndType($city, $type, $search);

        return $this->view('ProductAdmin.index', [
            'products' => $products,
            'city' => $city,
            'type' => $type,
            'search' => $search,
        ]);
    }

    public function getSortedProducts()
    {
        $order = isset($_GET['order']) ? $_GET['order'] : 'ASC';
        $column = isset($_GET['column']) ? $_GET['column'] : 'price';

        $products = $this->productModel->getSortedProducts($column, $order);

        echo json_encode($products);
    }

    public function store()
    {
        try {

            $id = strtoupper(uniqid('BDS'));


            $uploadDir = "uploads/";
            $imagePath = "";

            $image = $_FILES['image'];
            if ($image['error'] === UPLOAD_ERR_OK) {
                $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
                $filename = $id . '.' . $ext;
                $imagePath = $uploadDir . $filename;
                move_uploaded_file($image['tmp_name'], $imagePath);
            }

            $pictures = [];
            if (!empty($imagePath)) {
                $pictures[] = $imagePath;
            }
            foreach ($_FILES['pictures']['tmp_name'] as $key => $tmpName) {
                $ext = pathinfo($_FILES['pictures']['name'][$key], PATHINFO_EXTENSION);
                $filename = $id . "_pic_" . $key . '.' . $ext;
                $filePath = $uploadDir . $filename;

                if (move_uploaded_file($tmpName, $filePath)) {
                    $pictures[] = $filePath;
                }
            }

            $picturesJson = json_encode($pictures);

            $data = $_POST;
            $data['id'] = $id;
            $data['image'] = $imagePath;
            $data['pictures'] = $picturesJson;

            $this->productModel->insertProduct($data);

            $_SESSION['message'] = "Sản phẩm đã được lưu thành công!";
            $_SESSION['message_type'] = 'success';

        } catch (Exception $e) {
            $_SESSION['message'] = "Có lỗi xảy ra: " . $e->getMessage();
            $_SESSION['message_type'] = 'error';
        }
        header("Location: index.php?controller=product&action=admin");
        exit;
    }
    public function edit()
    {
        if (!isset($_GET['id'])) {
            $_SESSION['message'] = "ID sản phẩm không được cung cấp";
            $_SESSION['message_type'] = 'error';
            header('Location: index.php?controller=product&action=admin');
            exit;
        }

        $id = $_GET['id'];
        $product = $this->productModel->getProductById($id);

        if (!$product) {
            $_SESSION['message'] = "Không tìm thấy sản phẩm với ID: $id";
            $_SESSION['message_type'] = 'error';
            header('Location: index.php?controller=product&action=admin');
            exit;
        }

        return $this->view('ProductDetailAdmin.edit', [
            'product' => $product
        ]);
    }

    public function update()
    {
        try {
            $id = $_POST['id'];

            $existingProduct = $this->productModel->getProductById($id);

            if (!$existingProduct) {
                throw new Exception("Không tìm thấy sản phẩm với ID: $id");
            }

            $data = [
                'name' => $_POST['name'],
                'price' => $_POST['price'],
                'bedrooms' => $_POST['bedrooms'],
                'toilets' => $_POST['toilets'],
                'area' => $_POST['area'],
                'location' => $_POST['location'],
                'sell_type' => $_POST['sell_type'],
                'high_light' => isset($_POST['high_light']) ? $_POST['high_light'] : null,
                'city' => $_POST['city'],
                'type_of_real_estate' => $_POST['type_of_real_estate'],
                'agent_name' => isset($_POST['agent_name']) ? $_POST['agent_name'] : null,
                'phone' => isset($_POST['phone']) ? $_POST['phone'] : null,
                'floors' => isset($_POST['floors']) ? $_POST['floors'] : null,
                'direction' => isset($_POST['direction']) ? $_POST['direction'] : null,
                'latitude' => isset($_POST['latitude']) ? $_POST['latitude'] : null,
                'longitude' => isset($_POST['longitude']) ? $_POST['longitude'] : null,
                'length' => isset($_POST['length']) ? $_POST['length'] : null,
                'width' => isset($_POST['width']) ? $_POST['width'] : null
            ];

            $uploadDir = "uploads/";

            if (!empty($_FILES['image']['name']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                $filename = $id . '_main.' . $ext;
                $imagePath = $uploadDir . $filename;

                if (!empty($existingProduct['image']) && file_exists($existingProduct['image'])) {
                    @unlink($existingProduct['image']);
                }

                move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
                $data['image'] = $imagePath;
            }

            if (!empty($_FILES['pictures']['name'][0])) {
                $pictures = [];

                if (
                    isset($_POST['keep_existing_pictures']) && $_POST['keep_existing_pictures'] == '1' &&
                    !empty($existingProduct['pictures'])
                ) {
                    $pictures = json_decode($existingProduct['pictures'], true);
                }

                foreach ($_FILES['pictures']['tmp_name'] as $key => $tmpName) {
                    if ($_FILES['pictures']['error'][$key] === UPLOAD_ERR_OK) {
                        $ext = pathinfo($_FILES['pictures']['name'][$key], PATHINFO_EXTENSION);
                        $filename = $id . "_pic_" . uniqid() . '.' . $ext;
                        $filePath = $uploadDir . $filename;

                        if (move_uploaded_file($tmpName, $filePath)) {
                            $pictures[] = $filePath;
                        }
                    }
                }

                $data['pictures'] = json_encode($pictures);
            }else {
                if (!isset($_POST['keep_existing_pictures']) || $_POST['keep_existing_pictures'] != '1') {
                    if (!empty($existingProduct['pictures'])) {
                        $oldPictures = json_decode($existingProduct['pictures'], true);
                        foreach ($oldPictures as $picPath) {
                            if (file_exists($picPath)) {
                                @unlink($picPath);
                            }
                        }
                    }
                    $data['pictures'] = json_encode([]);
                }
            }

            $this->productModel->update($id, $data);

            $_SESSION['message'] = "Sản phẩm đã được cập nhật thành công!";
            $_SESSION['message_type'] = 'success';

        } catch (Exception $e) {
            $_SESSION['message'] = "Có lỗi xảy ra: " . $e->getMessage();
            $_SESSION['message_type'] = 'error';
        }

        header("Location: index.php?controller=product&action=admin");
        exit;
    }
}

?>