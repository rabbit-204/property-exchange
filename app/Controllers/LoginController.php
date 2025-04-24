<?php
require_once __DIR__ . '/../Models/LoginModel.php';
class LoginController extends BaseController
{
    private $authmodel;
    public function __construct()
    {
        $this->authmodel = new LoginModel();
    }

    public function index()
    {
        if (isset($_SESSION['user']) || isset($_COOKIE['token'])) {
            $_SESSION['user'] = json_decode($_COOKIE['token'], true) ?? $_SESSION['user'];
            // echo "<script>console.log('Cookie: " . $_SESSION['username'] . "');</script>";
            header('Location: /index.php?controller=homepage&action=index');
            exit();
        }
        return $this->view('login.index');  // Tên folder bên view + .index
    }

    public function register()
    {
        if (isset($_POST['fullname']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['password']) && isset($_POST['confirmPW'])) {

            $fullname = $_POST['fullname'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $password = $_POST['password'];
            $confirmPW = $_POST['confirmPW'];
            $role = 'user';

            if ($password !== $confirmPW) {
                // Trả về giao diện Register với thông báo lỗi
                return $this->view('login.index', [
                    'error' => 'Passwords do not match',
                    'showRegister' => true // Biến để hiển thị form Register
                ]);
            }
            echo "<script>console.log('Password: " . addslashes($password) . "');</script>";
            print_r($password);
            // Xử lý đăng ký (thêm vào cơ sở dữ liệu)
            $success = $this->authmodel->register($fullname, $email, $phone, $password, $role);

            if ($success) {
                // Đăng ký thành công, chuyển hướng đến trang login
                header('Location: /index.php?controller=login&action=index');
                exit;
            } else {
                // Đăng ký thất bại
                return $this->view('Login.index', [
                    'error' => 'Registration failed',
                    'showRegister' => true
                ]);
            }
        } else {
            // Nếu không có dữ liệu POST, hiển thị form Register
            return $this->view('Login.index', ['showRegister' => true]);
        }
    }

    public function login()
    {
        if (isset($_POST['email']) && isset($_POST['password'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $remember = isset($_POST['remember']) ? $_POST['remember'] : false;

            $user = $this->authmodel->login($email, $password);

            if ($user) {
                if (isset($user['isActive']) && !$user['isActive']) {
                    return $this->view('Login.index', ['error' => 'Tài khoản của bạn đã bị khóa. Vui lòng liên hệ quản trị viên.']);
                }

                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }

                $_SESSION['user'] = $user;

                if ($remember) {
                    setcookie('token', json_encode($user), time() + (86400 * 1), "/"); // 1 ngày
                }

                if ($user['role'] === 'admin') {
                    header('Location: /index.php?controller=homepage&action=admin');
                    exit;
                } else {
                    header('Location: /index.php?controller=homepage&action=index');
                    exit;
                }
            } else {
                return $this->view('Login.index', ['error' => 'Invalid email or password']);
            }
        } else {
            return $this->view('Login.index', ['error' => 'Please enter username and password']);
        }
    }

    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();
        unset($_SESSION['user']);
        setcookie('token', '', time() - 3600, "/"); // Xóa cookie
        header('Location: /index.php?controller=login&action=index');
        exit;
    }


    public function forgotPassword()
    {
        if (isset($_POST['email'])) {
            $email = $_POST['email'];
            
            // Check if email exists in database
            $user = $this->authmodel->getUserByEmail($email);
            
            if ($user) {
                // Generate a reset token
                $token = bin2hex(random_bytes(32));
                $expiry = date('Y-m-d H:i:s', strtotime('+1 hour'));
                
                // Save token to database
                $this->authmodel->saveResetToken($email, $token, $expiry);
                
                // Create reset link
                $resetLink = "http://" . $_SERVER['HTTP_HOST'] . "/index.php?controller=login&action=resetPassword&token=" . $token;
                $subject = "Password Reset Request";
                $message = "Hello,\n\nYou requested a password reset. Click the link below to reset your password:\n\n";
                $message .= $resetLink . "\n\n";
                $message .= "This link will expire in 1 hour.\n\n";
                $message .= "If you did not request this, please ignore this email.\n\n";
                $message .= "Regards,\nBK HOME";
                
                // Write to file instead of sending email
                $emailLogDir = __DIR__ . '/../../emails';
                $emailLogFile = $emailLogDir . '/' . time() . '_' . str_replace('@', '_at_', $email) . '.txt';
                
                // Make sure the directory exists
                if (!is_dir($emailLogDir)) {
                    mkdir($emailLogDir, 0777, true);
                }
                
                $emailContent = "To: $email\nSubject: $subject\n\n$message";
                file_put_contents($emailLogFile, $emailContent);
                
                // Display the reset link directly in the browser for development purposes
                return $this->view('login.forgotPassword', [
                    'success' => 'For development: Use this password reset link:',
                    'resetLink' => $resetLink // Show the link directly for testing
                ]);
            } else {
                return $this->view('login.forgotPassword', ['error' => 'Email not found in our records']);
            }
        }
        
        return $this->view('login.forgotPassword');
    }

public function resetPassword()
{
    if (isset($_GET['token'])) {
        $token = $_GET['token'];
        
        // Verify token is valid and not expired
        $validToken = $this->authmodel->verifyResetToken($token);
        
        if ($validToken) {
            if (isset($_POST['password']) && isset($_POST['confirmPassword'])) {
                $password = $_POST['password'];
                $confirmPassword = $_POST['confirmPassword'];
                
                if ($password !== $confirmPassword) {
                    return $this->view('login.resetPassword', [
                        'error' => 'Passwords do not match',
                        'token' => $token
                    ]);
                }
                
                // Update password
                $success = $this->authmodel->updatePassword($validToken['email'], $password);
                
                if ($success) {
                    // Invalidate the token after use
                    $this->authmodel->invalidateResetToken($token);
                    
                    return $this->view('login.index', ['success' => 'Password has been updated. You can now login with your new password']);
                } else {
                    return $this->view('login.resetPassword', [
                        'error' => 'Failed to update password',
                        'token' => $token
                    ]);
                }
            }
            
            return $this->view('login.resetPassword', ['token' => $token]);
        }
    }
    
    return $this->view('login.index', ['error' => 'Invalid or expired reset token']);
}
}