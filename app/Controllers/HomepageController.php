<?php
class HomepageController extends BaseController
{
    private $homepageModel;
    public function __construct()
    {
        parent::__construct();
        $this->homepageModel = $this->model('homepage');
    }
    public function index()
    {
        $listScreen = $this->homepageModel->getAllImage();
        $timeskip = $this->homepageModel->getInterval();
        $listCard = $this->homepageModel->getAllCard();
        $listIntroduction = $this->homepageModel->getAllIntroduction();
        return $this->view('homepage.index', ['listScreen' => $listScreen, 'timeskip' => $timeskip, 'listCard' => $listCard, 'listIntroduction' => $listIntroduction]);  //tên folder bên view + .index
    }
    public function admin()
    {
        $listScreen = $this->homepageModel->getAllImage();
        $timeskip = $this->homepageModel->getInterval();
        $listCard = $this->homepageModel->getAllCard();
        $listIntroduction = $this->homepageModel->getAllIntroduction();
        return $this->view('homepage.admin', ['listScreen' => $listScreen, 'timeskip' => $timeskip, 'listCard' => $listCard, 'listIntroduction' => $listIntroduction]);  //tên folder bên view + .index
    }

    #region slider
    public function uploadImageSlider()
    {
        header('Content-Type: application/json');
        $caption = $_POST['caption'];
        if (empty($caption)) {
            $caption = "WELCOME TO BKHOME";
        }
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            // Kiểm tra xem tệp có phải là ảnh không
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if ($check === false) {
                // Trả về phản hồi JSON lỗi nếu tệp không phải là ảnh
                echo json_encode(['status' => 'error', 'message' => 'Tệp không phải là ảnh.']);
                exit;
            }

            // Đọc tệp ảnh dưới dạng nhị phân
            $imageData = file_get_contents($_FILES['image']['tmp_name']);
            // $imageData = ImageHelper::resizeImage($imageData);

            // Lưu thông tin vào cơ sở dữ liệu
            $response = $this->homepageModel->addImage($imageData, $caption);

            if ($response) {
                // Trả về phản hồi JSON thành công
                echo json_encode(['status' => 'success', 'message' => 'Dữ liệu đã được lưu thành công!']);
            } else {
                // Trả về phản hồi JSON lỗi nếu không thể lưu dữ liệu
                echo json_encode(['status' => 'error', 'message' => 'Lỗi khi lưu dữ liệu.']);
            }
        } else {
            // Trả về phản hồi JSON lỗi nếu không có ảnh thumbnail
            echo json_encode(['status' => 'error', 'message' => 'Vui lòng chọn ảnh.']);
            exit;
        }
    }
    public function deleteScreen()
    {
        // $id = $_POST['id'];
        $id = $_POST['id'] ?? null;
        if (!$id) {
            error_log("ID rỗng hoặc không tồn tại");
            return;
        } else {
            log($id);
        }
        $this->homepageModel->deleteImage($id);
    }
    public function updateInterval()
    {
        $timeskip = intval($_POST['interval']);
        $this->homepageModel->updateInterval($timeskip);
        header('Location: homepage.php?action=admin');
    }
    public function updateScreen()
    {
        $id = $_POST['id'];
        $caption = $_POST['caption'];
        $response = $this->homepageModel->updateScreen($id, $caption);
        if ($response) {
            // Trả về phản hồi JSON thành công
            echo json_encode(['status' => 'success', 'message' => 'Dữ liệu đã được thay thành công!']);
        } else {
            // Trả về phản hồi JSON lỗi nếu không thể lưu dữ liệu
            echo json_encode(['status' => 'error', 'message' => 'Lỗi khi thay dữ liệu.']);
        }
    }
    #endregion

    #region card
    public function uploadCard()
    {
        header('Content-Type: application/json');
        $name = $_POST['name'];
        $num = $_POST['num'];

        if (empty($name)) {
            echo json_encode(['status' => 'error', 'message' => 'Tên của thẻ không thể để trống.']);
            exit;
        }
        if (empty($num)) {
            echo json_encode(['status' => 'error', 'message' => 'Bạn chưa ước lượng số lượng Bất Động Sản.']);
            exit;
        }
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            // Kiểm tra xem tệp có phải là ảnh không
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if ($check === false) {
                // Trả về phản hồi JSON lỗi nếu tệp không phải là ảnh
                echo json_encode(['status' => 'error', 'message' => 'Tệp không phải là ảnh.']);
                exit;
            }

            // Đọc tệp ảnh dưới dạng nhị phân
            $imageData = file_get_contents($_FILES['image']['tmp_name']);

            // Lưu thông tin vào cơ sở dữ liệu
            $response = $this->homepageModel->addCard($name, $imageData, $num);

            if ($response) {
                // Trả về phản hồi JSON thành công
                echo json_encode(['status' => 'success', 'message' => 'Dữ liệu đã được lưu thành công!']);
            } else {
                // Trả về phản hồi JSON lỗi nếu không thể lưu dữ liệu
                echo json_encode(['status' => 'error', 'message' => 'Lỗi khi lưu dữ liệu.']);
            }
        } else {
            // Trả về phản hồi JSON lỗi nếu không có ảnh thumbnail
            echo json_encode(['status' => 'error', 'message' => 'Vui lòng chọn ảnh của thẻ.']);
            exit;
        }
    }
    public function deleteCard()
    {
        // $id = $_POST['id'];
        $id = $_POST['id'] ?? null;
        if (!$id) {
            error_log("ID rỗng hoặc không tồn tại");
            return;
        } else {
            log($id);
        }
        $this->homepageModel->deleteCard($id);
    }
    public function updateCard()
    {
        $id = $_POST['id'];
        $num = $_POST['num'];
        $response = $this->homepageModel->updateCard($id, $num);
        if ($response) {
            // Trả về phản hồi JSON thành công
            echo json_encode(['status' => 'success', 'message' => 'Dữ liệu đã được thay thành công!']);
        } else {
            // Trả về phản hồi JSON lỗi nếu không thể lưu dữ liệu
            echo json_encode(['status' => 'error', 'message' => 'Lỗi khi thay dữ liệu.']);
        }
    }
    #endregion

    #region introduction
    public function uploadIntroduction()
    {
        header('Content-Type: application/json');
        $symbol = $_POST['symbol'];
        $title = $_POST['title'];
        $detail = $_POST['detail'];

        if (empty($symbol)) {
            echo json_encode(['status' => 'error', 'message' => 'Bạn chưa chọn biểu tượng của thẻ.']);
            exit;
        }
        if (empty($title)) {
            echo json_encode(['status' => 'error', 'message' => 'Bạn chưa viết tiêu đề cho thẻ giới thiệu.']);
            exit;
        }
        if (empty($detail)) {
            echo json_encode(['status' => 'error', 'message' => 'Bạn chưa viết mô tả chi tiết cho thẻ giới thiệu.']);
            exit;
        }
        $response = $this->homepageModel->addIntroduction($symbol, $title, $detail);
        if ($response) {
            // Trả về phản hồi JSON thành công
            echo json_encode(['status' => 'success', 'message' => 'Dữ liệu đã được lưu thành công!']);
        } else {
            // Trả về phản hồi JSON lỗi nếu không thể lưu dữ liệu
            echo json_encode(['status' => 'error', 'message' => 'Lỗi khi lưu dữ liệu.']);
        }
    }
    public function deleteIntroduction()
    {
        // $id = $_POST['id'];
        $id = $_POST['id'] ?? null;
        if (!$id) {
            error_log("ID rỗng hoặc không tồn tại");
            return;
        } else {
            log($id);
        }
        $this->homepageModel->deleteIntroduction($id);
    }
    public function updateIntroduction()
    {
        $id = $_POST['id'];
        $symbol = $_POST['symbol'] ?? null;
        if (!$id) {
            error_log("symbol rỗng hoặc không tồn tại");
            return;
        }
        $title = $_POST['title'];
        $detail = $_POST['detail'];
        $response = $this->homepageModel->updateIntroduction($id, $symbol, $title, $detail);
        if ($response) {
            // Trả về phản hồi JSON thành công
            echo json_encode(['status' => 'success', 'message' => 'Dữ liệu đã được thay thành công!']);
        } else {
            // Trả về phản hồi JSON lỗi nếu không thể lưu dữ liệu
            echo json_encode(['status' => 'error', 'message' => 'Lỗi khi thay dữ liệu.']);
        }
    }
    #endregion
}
