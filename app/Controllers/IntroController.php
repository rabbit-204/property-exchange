<?php
class IntroController extends BaseController
{
    private $introModel;
    public function __construct()
    {
        parent::__construct();
        $this->introModel = $this->model('intro');
    }
    public function index()
    {

        $listIntro = $this->introModel->getListIntro();
        $listProvince= $this->introModel->getListProvince();
        $listTitle = $this->introModel->getTitle();
        // echo "abc";
        return $this->view(
            'intro.index',
            [
                'listIntro' => $listIntro,
                'listProvince' =>$listProvince,
                'listTitle' => $listTitle
            ]
        );
    }
    public function admin()
    {

        $listIntro = $this->introModel->getListIntro();
        $listProvince= $this->introModel->getListProvince();
        $listTitle = $this->introModel->getTitle();
        // echo "abc";
        return $this->view(
            'intro.admin',
            [
                'listIntro' => $listIntro,
                'listProvince' =>$listProvince,
                'listTitle' => $listTitle
            ]
        );
    }
    public function deleteProvince(){
        $id = $_POST['id'];
        $this->introModel->deleteProvince($id);
    }
    public function addProvince() {
        header('Content-Type: application/json');
        $name = $_POST['name'];
        if (empty($name)) {
            // Trả về phản hồi JSON lỗi nếu trường "Tên Tỉnh/Thành phố" trống
            echo json_encode(['status' => 'error', 'message' => 'Tên Tỉnh/Thành phố không được để trống.']);
            exit;
        }
        if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] == 0) {
            // Kiểm tra xem tệp có phải là ảnh không
            $check = getimagesize($_FILES["thumbnail"]["tmp_name"]);
            if ($check === false) {
                // Trả về phản hồi JSON lỗi nếu tệp không phải là ảnh
                echo json_encode(['status' => 'error', 'message' => 'Tệp không phải là ảnh.']);
                exit;
            }
    
            // Đọc tệp ảnh dưới dạng nhị phân
            $thumbnailData = file_get_contents($_FILES['thumbnail']['tmp_name']);
    
            // Lưu thông tin vào cơ sở dữ liệu
            $response = $this->introModel->addProvince($name, $thumbnailData);
            
            if ($response) {
                // Trả về phản hồi JSON thành công
                echo json_encode(['status' => 'success', 'message' => 'Dữ liệu đã được lưu thành công!']);
            } else {
                // Trả về phản hồi JSON lỗi nếu không thể lưu dữ liệu
                echo json_encode(['status' => 'error', 'message' => 'Lỗi khi lưu dữ liệu.']);
            }
    
        } else {
            // Trả về phản hồi JSON lỗi nếu không có ảnh thumbnail
            echo json_encode(['status' => 'error', 'message' => 'Vui lòng chọn ảnh thumbnail.']);
            exit;
        }
    }
    public function updateProvince(){
        $id = $_POST['id'];
        $name = $_POST['name'];
        $thumbnail = null;
        if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] == UPLOAD_ERR_OK){
            $thumbnail = file_get_contents($_FILES['thumbnail']['tmp_name']);

        }
        $response = $this->introModel->updateProvince($id,$name,$thumbnail);
        if ($response) {
            // Trả về phản hồi JSON thành công
            echo json_encode(['status' => 'success', 'message' => 'Dữ liệu đã được thay thành công!']);
        } else {
            // Trả về phản hồi JSON lỗi nếu không thể lưu dữ liệu
            echo json_encode(['status' => 'error', 'message' => 'Lỗi khi thay dữ liệu.']);
        }
    }
    public function deleteIntro(){
        $id = $_POST['id'];
        $this->introModel->deleteIntro($id);
    }
    public function addIntro() {
        header('Content-Type: application/json');
        $name = $_POST['name'];
        if (empty($name)) {
            // Trả về phản hồi JSON lỗi nếu trường "Tên Tỉnh/Thành phố" trống
            echo json_encode(['status' => 'error', 'message' => 'Tên không được để trống.']);
            exit;
        }
        $content = $_POST['content'];
        if (empty($content)) {
            // Trả về phản hồi JSON lỗi nếu trường "Tên Tỉnh/Thành phố" trống
            echo json_encode(['status' => 'error', 'message' => 'Mô tả không được để trống.']);
            exit;
        }
        if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] == 0) {
            // Kiểm tra xem tệp có phải là ảnh không
            $check = getimagesize($_FILES["thumbnail"]["tmp_name"]);
            if ($check === false) {
                // Trả về phản hồi JSON lỗi nếu tệp không phải là ảnh
                echo json_encode(['status' => 'error', 'message' => 'Tệp không phải là ảnh.']);
                exit;
            }
    
            // Đọc tệp ảnh dưới dạng nhị phân
            $thumbnailData = file_get_contents($_FILES['thumbnail']['tmp_name']);
    
            // Lưu thông tin vào cơ sở dữ liệu
            $response = $this->introModel->addIntro($name,$content, $thumbnailData);
            
            if ($response) {
                // Trả về phản hồi JSON thành công
                echo json_encode(['status' => 'success', 'message' => 'Dữ liệu đã được lưu thành công!']);
            } else {
                // Trả về phản hồi JSON lỗi nếu không thể lưu dữ liệu
                echo json_encode(['status' => 'error', 'message' => 'Lỗi khi lưu dữ liệu.']);
            }
    
        } else {
            // Trả về phản hồi JSON lỗi nếu không có ảnh thumbnail
            echo json_encode(['status' => 'error', 'message' => 'Vui lòng chọn ảnh thumbnail.']);
            exit;
        }
    }
    public function updateIntro(){
        $id = $_POST['introId'];
        $introName = $_POST['introName'];
        $introDetail = $_POST['introDetail'];
        $thumbnail = null;
        if (isset($_FILES['introThumbnail']) && $_FILES['introThumbnail']['error'] == UPLOAD_ERR_OK){
            $thumbnail = file_get_contents($_FILES['introThumbnail']['tmp_name']);

        }
        $response = $this->introModel->updateIntro($id,$introName,$introDetail,$thumbnail);
        if ($response) {
            // Trả về phản hồi JSON thành công
            echo json_encode(['status' => 'success', 'message' => 'Dữ liệu đã được thay thành công!']);
        } else {
            // Trả về phản hồi JSON lỗi nếu không thể lưu dữ liệu
            echo json_encode(['status' => 'error', 'message' => 'Lỗi khi thay dữ liệu.']);
        }
    }
    
}
