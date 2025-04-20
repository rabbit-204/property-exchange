<?php
class LoginController extends BaseController
{
    public function __construct() {
        $this->authmodel = new LoginModel();
    }
    public function index()
    {
        return $this->view('login.index');  //tên folder bên view + .index
    }
    public function register()
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $success = $this->authmodel->register($name, $email, $password);

        if ($success) {
            // Đăng ký thành công
            header('Location: /login'); // Chuyển hướng đến trang đăng nhập
        } else {
            // Đăng ký thất bại
            return $this->view('Register.index', ['error' => 'Registration failed']);
        }
    }
    public function login()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = $this->authmodel->login($email, $password);

        if ($user) {
            // Đăng nhập thành công
            session_start();
            $_SESSION['user'] = $user;
            header('Location: /dashboard'); // Chuyển hướng đến dashboard
        } else {
            // Đăng nhập thất bại
            return $this->view('Login.index', ['error' => 'Invalid email or password']);
        }
    }
}
?>