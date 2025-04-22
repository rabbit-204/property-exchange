<?php
require_once __DIR__ . '/../Models/AnswerandquestionModel.php';

class AnswerandquestionController extends BaseController
{
    private $chatModel;

    public function __construct()
    {
        $this->chatModel = new AnswerandquestionModel();
    }

    // Hiển thị trang hỏi đáp
    public function index()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /index.php?controller=login&action=index'); // Chuyển hướng nếu chưa đăng nhập
            exit;
        }
        $id_user = $_SESSION['user']['id'];

        $messages = $this->chatModel->getMessages($id_user);
        return $this->view('AnswerAndQuestion.index', [
            'messages' => $messages,
            'role' => $_SESSION['user']['role'] // 'user' hoặc 'admin'
        ]);
    }

    // API lấy tin nhắn
    public function getMessages()
    {
        $id_user = $_SESSION['user']['id'];
        $messages = $this->chatModel->getMessages($id_user);
        // echo $messages;
        echo json_encode(['messages' => $messages]);
    }

    // API gửi tin nhắn
    public function sendMessage()
    {
        $sender = 'user'; // 'user' hoặc 'admin'
        $message = $_POST['message'];
        $id_user = $_SESSION['user']['id'];
        $this->chatModel->addMessage($sender, $message, $id_user);
    }
}
?>