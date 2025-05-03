<?php

require_once __DIR__ . '/../Models/NewsModel.php';
require_once __DIR__ . '/../Models/CommentModel.php';

class NewsDetailsController extends BaseController
{
    private $newsModel;
    private $commentModel;

    public function __construct()
    {
        $this->newsModel = new NewsModel();
        $this->commentModel = new CommentModel();
    }

    public function index()
    {
        $id = isset($_GET['id']) ? trim($_GET['id']) : null;

        if (!$id) {
            echo '<script>console.log("ID không hợp lệ: ' . htmlspecialchars($_GET['id']) . '");</script>';
            die('ID không hợp lệ.');
        }

        echo '<script>console.log("ID bài viết: ' . $id . '");</script>';

        $news = $this->newsModel->getNewsById($id);

        if (!$news) {
            die('Bài viết không tồn tại.');
        }

        // Lấy bình luận liên quan
        $comments = $this->commentModel->getCommentsByNews($id, 100);

        // Phân quyền
        $isAdmin = isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin';

        // Gọi chung 1 view
        return $this->view('newsdetails.index', [
            'news' => $news,
            'comments' => $comments,
            'message' => $_SESSION['message'] ?? null,
            'isAdmin' => $isAdmin
        ]);
    }
}