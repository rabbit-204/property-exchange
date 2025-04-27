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
    public function changePWform()
    {
        return $this->view('login.changePW');  // Tên folder bên view + .index
    }

    public function changePW(){
        if (isset($_POST['pwcurrent']) && isset($_POST['newpw']) &&isset($_POST['confirmpw'])){
            $pwcurrent = $_POST['pwcurrent'];
            $newpw = $_POST['newpw'];
            $confirmpw = $_POST['confirmpw'];
            if ($newpw !== $confirmpw){
                return $this->view('Login.changePW', [
                    'error' => 'Mật khẩu không khớp',
                ]);
            }
            $email = $_SESSION['email'];
            $user = $this->authmodel->getPasswordByEmail($email);
            if ( $pwcurrent !== $user['password']) {
                return $this->view('Login.changePW', [
                    'error' => 'Mật khẩu hiện tại không đúng',
                ]);
            }
            // $newHash = password_hash($newpw, PASSWORD_DEFAULT);
            $success = $this->authmodel->updatePassword($email, $newpw);
            // $success = $this->authmodel->changepw();
            if ($success) {
                // Đăng ký thành công, chuyển hướng đến trang login
                header('Location: /index.php?controller=login&action=index');
                exit;
            } else {
                return $this->view('Login.changePW', [
                    'error' => 'Thay đổi mật khẩu thất bại'
                ]);
            }

        }else {
            // Nếu không có dữ liệu POST, hiển thị form Register
            return $this->view('Login.changePW', ['error' => 'Vui lòng nhập đủ các trường']);
        }
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
                    'error' => 'Mật khẩu không khớp',
                    'showRegister' => true // Biến để hiển thị form Register
                ]);
            }
            // echo "<script>console.log('Password: " . addslashes($password) . "');</script>";
            // print_r($password);
            // Xử lý đăng ký (thêm vào cơ sở dữ liệu)
            $success = $this->authmodel->register($fullname, $email, $phone, $password, $role);

            if ($success) {
                // Đăng ký thành công, chuyển hướng đến trang login
                header('Location: /index.php?controller=login&action=index');
                exit;
            } else {
                // Đăng ký thất bại
                return $this->view('Login.index', [
                    'error' => 'Đăng ký thất bại',
                    'showRegister' => true
                ]);
            }
        } else {
            // Nếu không có dữ liệu POST, hiển thị form Register
            return $this->view('Login.index', ['showRegister' => true,'error' => 'Vui lòng nhập đủ các trường']);
        }
    }

    public function login()
    {
        if (isset($_POST['email']) && isset($_POST['password'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $remember = isset($_POST['remember']) ? $_POST['remember'] : false; // Kiểm tra xem có checkbox "Remember Me" không

            $user = $this->authmodel->login($email, $password);

            // Debug nếu cần kiểm tra thông tin user

            if ($user) {
                // Đăng nhập thành công
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }

                $_SESSION['user'] = $user;
                if ($remember) {
                    // Nếu có checkbox "Remember Me", lưu thông tin vào cookie
                    setcookie('token', json_encode($user), time() + (86400 * 1), "/"); // Cookie tồn tại trong 30 ngày
                }
                if ($user['role'] === 'admin') {
                    header('Location: /index.php?controller=homepage&action=admin');
                    exit;
                } else {
                    header('Location: /index.php?controller=homepage&action=index');
                    exit;
                }
            } else {
                // Đăng nhập thất bại
                return $this->view('Login.index', ['error' => 'Email hoặc mật khẩu không đúng']);
            }
        } else {
            // Nếu không có dữ liệu POST, có thể chuyển hướng hoặc báo lỗi
            return $this->view('Login.index', ['error' => 'Vui lòng nhập email và mật khẩu']);
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
}
