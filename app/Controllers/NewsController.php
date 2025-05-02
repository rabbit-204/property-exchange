<?php
require_once __DIR__ . '/../Models/NewsModel.php';

class NewsController extends BaseController
{
    private $newsModel;
    public function __construct()
    {
        $this->newsModel = new NewsModel();
    }
    public function create()
    {
        return $this->view('NewsAdmin.index', ['newsFormData' => []]);
    }
    public function delete()
    {
        $newsId = $_GET['id'];

        if ($this->newsModel->deleteNews($newsId)) {
            $_SESSION['message'] = "Tin tức đã được xóa thành công!";
            header('Location: index.php?controller=news&action=admin');
            exit;
        } else {
            $_SESSION['message'] = "Lỗi khi xóa tin tức.";
            header('Location: index.php?controller=news&action=admin');
            exit;
        }
    }

    public function index()
    {
        $limit = 9;
        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        $offset = ($page - 1) * $limit;

        $search = isset($_GET['search']) ? trim($_GET['search']) : null;
        $order = isset($_GET['order']) ? strtoupper($_GET['order']) : 'DESC';

        $newsList = $this->newsModel->filterNews($search, $limit, $offset, $order);
        $totalNews = $this->newsModel->countFilteredNews($search);
        $totalPages = ceil($totalNews / $limit);

        return $this->view('news.index', [
            'newsList' => $newsList,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'search' => $search,
            'order' => $order
        ]);
    }

    public function admin()
    {
        $search = isset($_GET['search']) ? trim($_GET['search']) : null;
        $newsList = $this->newsModel->filterNews($search, 100000, 0);

        return $this->view('NewsAdmin.index', [
            'newsList' => $newsList,
            'search' => $search,
        ]);
    }

    public function getSortedNews()
    {
        $order = isset($_GET['order']) ? strtoupper($_GET['order']) : 'DESC';

        $newsList = $this->newsModel->getSortedNewsByDate($order);

        echo json_encode($newsList);
    }

    public function store()
    {
        try {
            $uploadDir = "uploads/";
            $imagePath = "";

            // Xử lý ảnh upload
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                $filename = uniqid('news_') . '.' . $ext;
                $imagePath = $uploadDir . $filename;

                move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
            }

            // Lấy dữ liệu từ form
            $title = trim($_POST['title'] ?? '');
            $description = trim($_POST['description'] ?? '');

            // Kiểm tra dữ liệu đầu vào (nếu muốn)
            if (empty($title) || empty($description) || empty($imagePath)) {
                throw new Exception("Vui lòng điền đầy đủ thông tin và chọn ảnh!");
            }

            // Chuẩn bị dữ liệu
            $data = [
                'title' => $title,
                'description' => $description,
                'image' => $imagePath,
            ];

            // Lưu vào DB
            $this->newsModel->insertNews($data);

            $_SESSION['message'] = " Tin tức đã được thêm thành công!";
            $_SESSION['message_type'] = 'success';

        } catch (Exception $e) {
            $_SESSION['message'] = " Có lỗi: " . $e->getMessage();
            $_SESSION['message_type'] = 'error';
        }

        // Điều hướng về trang admin tin tức
        header("Location: index.php?controller=news&action=admin");
        exit;
    }
    public function edit()
    {
        if (!isset($_GET['id'])) {
            $_SESSION['message'] = "ID tin tức không được cung cấp";
            $_SESSION['message_type'] = 'error';
            header('Location: index.php?controller=news&action=admin');
            exit;
        }

        $id = $_GET['id'];
        $news = $this->newsModel->getNewsById($id); // Gọi đúng model và tên hàm

        if (!$news) {
            $_SESSION['message'] = "Không tìm thấy tin tức với ID: $id";
            $_SESSION['message_type'] = 'error';
            header('Location: index.php?controller=news&action=admin');
            exit;
        }

        return $this->view('NewsDetailAdmin.edit', [
            'news' => $news
        ]);
    }

    public function update()
    {
        try {
            $id = $_POST['id'];

            $existingNews = $this->newsModel->getNewsById($id);
            if (!$existingNews) {
                throw new Exception("Không tìm thấy tin tức với ID: $id");
            }

            $data = [
                'title' => $_POST['title'],
                'description' => $_POST['description'],
            ];

            $uploadDir = "uploads/";
            if (!empty($_FILES['image']['name']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                $filename = "news_" . $id . '.' . $ext;
                $imagePath = $uploadDir . $filename;

                // Xóa ảnh cũ nếu tồn tại
                if (!empty($existingNews['image']) && file_exists($existingNews['image'])) {
                    @unlink($existingNews['image']);
                }

                move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
                $data['image'] = $imagePath;
            }

            $this->newsModel->updateNews($id, $data);

            $_SESSION['message'] = "Tin tức đã được cập nhật thành công!";
            $_SESSION['message_type'] = 'success';
        } catch (Exception $e) {
            $_SESSION['message'] = "Có lỗi xảy ra: " . $e->getMessage();
            $_SESSION['message_type'] = 'error';
        }

        header("Location: index.php?controller=newsdetails&action=index&id=$id");
        exit;
    }

}

?>