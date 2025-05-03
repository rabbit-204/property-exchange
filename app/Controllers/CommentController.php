<?php
require_once __DIR__ . '/../Models/CommentModel.php';
require_once __DIR__ . '/../Models/NewsModel.php';

class CommentController extends BaseController
{
    private $commentModel;

    public function __construct()
    {
        parent::__construct();
        $this->commentModel = new CommentModel();
    }

    // Thêm bình luận (chỉ khi là user)
    public function add()
    {
        if (!isset($_SESSION['user'])) {
            $_SESSION['message'] = 'Bạn phải đăng nhập để bình luận.';
            header('Location: index.php?controller=login&action=index');
            exit;
        }

        $user = $_SESSION['user'];
        $userId = $user['id'];
        $newsId = $_POST['news_id'] ?? null;
        $content = trim($_POST['content'] ?? '');

        if (!$newsId || $content === '') {
            $_SESSION['message'] = 'Thiếu thông tin bình luận.';
            header("Location: index.php?controller=newsdetails&action=index&id=$newsId");
            exit;
        }

        $this->commentModel->insertComment($newsId, $userId, $content);

        header("Location: index.php?controller=newsdetails&action=index&id=$newsId");
        exit;
    }

    // Xóa bình luận (chỉ admin được phép)
    public function delete()
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            $_SESSION['message'] = 'Bạn không có quyền xóa bình luận.';
            header('Location: index.php?controller=newsdetails&action=index');
            exit;
        }

        $id = $_GET['id'] ?? null;
        $newsId = $_GET['news_id'] ?? null;

        if (!$id || !$newsId) {
            $_SESSION['message'] = 'Thiếu thông tin để xóa.';
            header('Location: index.php?controller=newsdetails&action=index');
            exit;
        }

        $this->commentModel->deleteComment($id);

        $_SESSION['message'] = 'Đã xóa bình luận thành công.';
        header("Location: index.php?controller=newsdetails&action=index&id=$newsId");
        exit;
    }

    //  Lấy danh sách comment 
    public function list()
    {
        $newsId = $_GET['news_id'] ?? null;
        if (!$newsId) {
            echo json_encode([]);
            return;
        }

        $limit = $_GET['limit'] ?? 5;
        $offset = $_GET['offset'] ?? 0;

        $comments = $this->commentModel->getCommentsByNews($newsId, $limit, $offset);
        echo json_encode($comments);
    }
}
