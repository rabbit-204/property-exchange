<?php
require_once __DIR__ . '/../Models/AccountModel.php';

class AccountController extends BaseController {
    private $accountModel;
    
    public function __construct() {
        $this->accountModel = new AccountModel();
    }
    
    public function index() {
        if (!isset($_SESSION['user'])) {
            header('Location: /index.php?controller=login&action=index');
            exit;
        }
        
        $userId = $_SESSION['user']['id'];
        $account = $this->accountModel->getAccountById($userId);
        
        if (!$account) {
            die("Không tìm thấy thông tin tài khoản!");
        }
        
        
        // Get favorite products
        $favoriteProducts = $this->accountModel->getFavoriteProducts($userId);
        
        return $this->view('account.index', [
            'account' => $account,
            'favoriteProducts' => $favoriteProducts
        ]);
    }
    
    public function update() {
        if (!isset($_SESSION['user'])) {
            header('Location: /index.php?controller=login&action=index');
            exit;
        }
        
        $userId = $_SESSION['user']['id'];
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $fullname = $_POST['fullname'] ?? '';
            $email = $_POST['email'] ?? '';
            $phone = $_POST['phone'] ?? '';
            
            $imgPath = null;
            if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = 'uploads/avatars/';
                
                if (!file_exists($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                
                $fileName = time() . '_' . basename($_FILES['img']['name']);
                $targetPath = $uploadDir . $fileName;
                
                if (move_uploaded_file($_FILES['img']['tmp_name'], $targetPath)) {
                    $imgPath = $targetPath;
                }
            }
            
            $data = [
                'fullname' => $fullname,
                'email' => $email,
                'phone' => $phone
            ];
            
            if ($imgPath) {
                $data['img'] = $imgPath;
            }
            
            $updated = $this->accountModel->updateAccount($userId, $data);
            
            if ($updated) {
                $_SESSION['message'] = 'Cập nhật thông tin thành công!';
            } else {
                $_SESSION['error'] = 'Cập nhật thông tin thất bại!';
            }
            
            header('Location: index.php?controller=account&action=index');
            exit;
        }
        
        $account = $this->accountModel->getAccountById($userId);
        return $this->view('account.edit', ['account' => $account]);
    }

    public function changePassword() {
        if (!isset($_SESSION['user'])) {
            header('Location: /index.php?controller=login&action=index');
            exit;
        }
        
        $userId = $_SESSION['user']['id'];
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $currentPassword = $_POST['current_password'] ?? '';
            $newPassword = $_POST['new_password'] ?? '';
            $confirmPassword = $_POST['confirm_password'] ?? '';
            
            if (empty($currentPassword) || empty($newPassword) || empty($confirmPassword)) {
                $_SESSION['error'] = 'Vui lòng điền đầy đủ thông tin!';
                header('Location: index.php?controller=account&action=changePassword');
                exit;
            }
            
            if ($newPassword !== $confirmPassword) {
                $_SESSION['error'] = 'Mật khẩu mới không khớp!';
                header('Location: index.php?controller=account&action=changePassword');
                exit;
            }
            
            $isPasswordValid = $this->accountModel->verifyPassword($userId, $currentPassword);
            
            if (!$isPasswordValid) {
                $_SESSION['error'] = 'Mật khẩu hiện tại không đúng!';
                header('Location: index.php?controller=account&action=changePassword');
                exit;
            }
            
            $updated = $this->accountModel->updatePassword($userId, $newPassword);
            
            if ($updated) {
                $_SESSION['message'] = 'Đổi mật khẩu thành công!';
                header('Location: index.php?controller=account&action=index');
            } else {
                $_SESSION['error'] = 'Đổi mật khẩu thất bại!';
                header('Location: index.php?controller=account&action=changePassword');
            }
            exit;
        }
        
        return $this->view('account.change_password');
    }
}