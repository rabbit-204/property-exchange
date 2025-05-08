<?php
class ContactController extends BaseController
{
    private $contactModel;
    public function __construct()
    {
        parent::__construct();
        $this->contactModel = $this->model('contact');
    }
    public function index()
    {
        $listInfo = $this->contactModel->getInfor();
        return $this->view('contact.index', ['listInfo' => $listInfo]);  //tên folder bên view + .index
    }
    public function admin()
    {
        $listInfo = $this->contactModel->getInfor();
        return $this->view('contact.admin', ['listInfo' => $listInfo]);  //tên folder bên view + .index
    }

    public function uploadInfo()
    {
        header('Content-Type: application/json');
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $address = $_POST['address'];

        if (empty($phone)) {
            echo json_encode(['status' => 'error', 'message' => 'Bạn chưa nhập số điện thoại của chi nhánh.']);
            exit;
        }

        if (empty($email)) {
            echo json_encode(['status' => 'error', 'message' => 'Bạn chưa nhập email của chi nhánh.']);
            exit;
        }

        if (empty($address)) {
            echo json_encode(['status' => 'error', 'message' => 'Bạn chưa nhập địa chỉ của chi nhánh.']);
            exit;
        }

        $response = $this->contactModel->addInfo($phone, $email, $address);

        if ($response) {
            // Trả về phản hồi JSON thành công
            echo json_encode(['status' => 'success', 'message' => 'Dữ liệu đã được lưu thành công!']);
        } else {
            // Trả về phản hồi JSON lỗi nếu không thể lưu dữ liệu
            echo json_encode(['status' => 'error', 'message' => 'Lỗi khi lưu dữ liệu.']);
        }
    }
    public function deleteInfo()
    {
        // $id = $_POST['id'];
        $id = $_POST['id'] ?? null;
        if (!$id) {
            error_log("ID rỗng hoặc không tồn tại");
            return;
        } else {
            log($id);
        }
        $this->contactModel->deleteInfo($id);
    }
    public function updateInfo()
    {
        $id = $_POST['id'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $response = $this->contactModel->updateInfo($id, $phone, $email, $address);
        if ($response) {
            // Trả về phản hồi JSON thành công
            echo json_encode(['status' => 'success', 'message' => 'Dữ liệu đã được thay thành công!']);
        } else {
            // Trả về phản hồi JSON lỗi nếu không thể lưu dữ liệu
            echo json_encode(['status' => 'error', 'message' => 'Lỗi khi thay dữ liệu.']);
        }
    }
}
