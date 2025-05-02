<?php
require_once __DIR__ . '/../Models/AnswerandquestionModel.php';

class AnswerandquestionController extends BaseController
{
    private $chatModel;

    public function __construct()
    {
        parent::__construct();
        $this->chatModel = new AnswerandquestionModel();
    }


// ---------------------------------------------------user-----------------------------------------------------

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

    public function sendMessage()
    {
        $sender = 'user'; // 'user' hoặc 'admin'
        $message = $_POST['message'];
        $id_user = $_SESSION['user']['id'];
        $this->chatModel->addMessage($sender, $message, $id_user);
    }
// -------------------------------------------admin------------------------------------
    public function admin()
    {
        if (!isset($_SESSION['admin'])) {
            header('Location: /index.php?controller=login&action=index'); // Chuyển hướng nếu chưa đăng nhập
            exit;
        }

        $listChat = $this->chatModel->getListDM();
        return $this->view('AnswerAndQuestion.admin', [
            'listChat' => $listChat,
        ]);

    }
    public function loadUser(){
        $listChat = $this->chatModel->getListDM();
        echo json_encode(['listChat' => $listChat]);
    }
    public function getMessagesAdmin()
    {
        $id_user = $_POST['id'];
        $messages = $this->chatModel->getMessages($id_user);
        // echo $messages;
        echo json_encode(['messages' => $messages]);
    }
    public function sendMessageAdmin()
    {
        $sender = 'admin'; 
        $id_user = $_POST['userId'];
        $message = $_POST['message'];
        $this->chatModel->addMessage($sender, $message, $id_user);
    }
    public function markMessagesAsRead(){
        $id = $_POST['id'];
        $this->chatModel->markAsRead($id );
    }
}
?>