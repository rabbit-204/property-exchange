<?php
class RatingController extends BaseController
{
    private $ratingModel;
    public function __construct()
    {
        $this->ratingModel = $this->model('rating');
    }
    public function submit()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /index.php?controller=login&action=index'); // Chuyển hướng nếu chưa đăng nhập
            exit;
        }

        if (isset($_POST['rating']) && isset($_POST['message'])) {
            $rating = $_POST['rating'];
            $message = $_POST['message'];
            $id_user = $_SESSION['user']['id'];
            $name_user = $_SESSION['user']['fullname'];

            // Gọi model để lưu đánh giá vào cơ sở dữ liệu
            $this->ratingModel->submitRating($id_user, $rating, $message, $name_user);

            // Chuyển hướng về trang hỏi đáp sau khi gửi đánh giá
            header('Location: /index.php?controller=homepage&action=index');
            exit;
        } else {
            // Nếu không có dữ liệu POST, hiển thị thông báo lỗi hoặc làm gì đó khác
            echo "Vui lòng điền đầy đủ thông tin đánh giá.";
        }
    }
}
?>