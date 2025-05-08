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
        if (isset($_SESSION['user']) || isset($_COOKIE['tokenUser'])) {
            $_SESSION['user'] = json_decode($_COOKIE['tokenUser'], true) ?? $_SESSION['user'];
            header('Location: /index.php?controller=homepage&action=index');
            exit();
        }
        if (isset($_SESSION['admin']) || isset($_COOKIE['tokenAdmin'])) {
            $_SESSION['admin'] = json_decode($_COOKIE['tokenAdmin'], true) ?? $_SESSION['admin'];
            header('Location: /index.php?controller=homepage&action=admin');
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
            $success = $this->authmodel->updatePassword($email, $newpw);
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
            $remember = isset($_POST['remember']) ? $_POST['remember'] : false;

            $user = $this->authmodel->login($email, $password);

            if ($user) {
                if (isset($user['isActive']) && !$user['isActive']) {
                    return $this->view('Login.index', ['error' => 'Tài khoản của bạn đã bị khóa. Vui lòng liên hệ quản trị viên.']);
                }

                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }
                if ($user["role"] === "admin"){   
                    $_SESSION['admin'] = $user;
                }else{
                    $_SESSION['user'] = $user;
                }

                if ($remember) {
                    if ($user["role"] === "admin"){  
                        setcookie('tokenAdmin', json_encode($user), time() + (86400 * 1), "/"); // 1 ngày
                    }else{
                        setcookie('tokenUser', json_encode($user), time() + (86400 * 1), "/"); // 1 ngày
                    }
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

        // Xoá token và thông tin người dùng trước khi huỷ session
        if (isset($_SESSION['admin'])) {
            unset($_SESSION['admin']);
            setcookie('tokenAdmin', '', time() - 3600, "/");
        } elseif (isset($_SESSION['user'])) {
            unset($_SESSION['user']);
            setcookie('tokenUser', '', time() - 3600, "/");
        }

        // Huỷ session sau khi đã xử lý
        session_unset();
        session_destroy();

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
                // Generate a verification code
                $resetCode = sprintf("%06d", mt_rand(100000, 999999)); // 6-digit code
                $expiry = date('Y-m-d H:i:s', strtotime('+15 minutes'));
                
                // Save code to database
                $this->authmodel->saveResetCode($email, $resetCode, $expiry);
                
                // Create email message
                $subject = "Password Reset Verification Code";
                $message = "Hello,\n\n";
                $message .= "You requested a password reset. Here is your verification code:\n\n";
                $message .= $resetCode . "\n\n";
                $message .= "This code will expire in 15 minutes.\n\n";
                $message .= "If you did not request this, please ignore this email.\n\n";
                $message .= "Regards,\nBK HOME";
                
                // Send email using PHPMailer
                $mailSent = $this->sendEmail($email, $subject, $message);
                
                if ($mailSent) {
                    // Show success message and display verification form
                    return $this->view('login.forgotPassword', [
                        'success' => true,
                        'dev_code' => $resetCode // Only for development, remove in production
                    ]);
                } else {
                    return $this->view('login.forgotPassword', [
                        'error' => 'Failed to send verification email. Please try again later.'
                    ]);
                }
            } else {
                return $this->view('login.forgotPassword', ['error' => 'Email not found in our records']);
            }
        }
        
        return $this->view('login.forgotPassword');
    }
    
    private function sendEmail($to, $subject, $message)
{
    // Check if PHPMailer exists in different possible locations
    $autoloadPaths = [
        __DIR__ . '/../../vendor/autoload.php',
        __DIR__ . '/../vendor/autoload.php',
        __DIR__ . '/vendor/autoload.php',
        'vendor/autoload.php'
    ];
    
    $loaded = false;
    foreach ($autoloadPaths as $path) {
        if (file_exists($path)) {
            require_once $path;
            $loaded = true;
            break;
        }
    }
    
    if (!$loaded) {
        error_log("Could not find autoload.php");
        return false;
    }
    
    // Manual include if autoload doesn't work
    if (!class_exists('\PHPMailer\PHPMailer\PHPMailer')) {
        $phpmailerPaths = [
            __DIR__ . '/../../vendor/phpmailer/phpmailer/src/PHPMailer.php',
            __DIR__ . '/../vendor/phpmailer/phpmailer/src/PHPMailer.php',
            __DIR__ . '/vendor/phpmailer/phpmailer/src/PHPMailer.php',
            'vendor/phpmailer/phpmailer/src/PHPMailer.php'
        ];
        
        foreach ($phpmailerPaths as $path) {
            if (file_exists($path)) {
                require_once $path;
                // Also include required exception and SMTP classes
                require_once dirname($path) . '/Exception.php';
                require_once dirname($path) . '/SMTP.php';
                break;
            }
        }
    }
    
    // Check if class exists now
    if (!class_exists('\PHPMailer\PHPMailer\PHPMailer')) {
        error_log("PHPMailer class not found");
        return false;
    }
    
    $mail = new \PHPMailer\PHPMailer\PHPMailer(true);
    
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';          // Change to your SMTP server
        $mail->SMTPAuth   = true;
        $mail->Username   = 'tuanphonglqd@gmail.com';    // Change to your email address
        $mail->Password   = 'frtf trrl tzkl cqbj';       // Change to your email password
        $mail->SMTPSecure = 'tls';                       // Enable TLS encryption; `PHPMailer::ENCRYPTION_STARTTLS` also accepted
        $mail->Port       = 587;                         // TCP port (typically 587 for TLS, 465 for SSL)
        
        // Recipients
        $mail->setFrom('tuanphonglqd@gmail.com', 'BK HOME');
        $mail->addAddress($to);
        
        // Content
        $mail->isHTML(false);
        $mail->Subject = $subject;
        $mail->Body    = $message;
        
        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log("Email sending failed: " . (isset($mail->ErrorInfo) ? $mail->ErrorInfo : $e->getMessage()));
        return false;
    }
}
    
    // Keep the rest of your functions as they are
    public function verifyResetCode()
    {
        if (isset($_POST['email']) && isset($_POST['resetCode'])) {
            $email = $_POST['email'];
            $resetCode = $_POST['resetCode'];
            
            // Verify code is valid and not expired
            $validCode = $this->authmodel->verifyResetCode($email, $resetCode);
            
            if ($validCode) {
                // Code is valid, show password reset form
                return $this->view('login.resetPassword', [
                    'email' => $email,
                    'resetCode' => $resetCode
                ]);
            } else {
                return $this->view('login.forgotPassword', [
                    'error' => 'Invalid or expired verification code',
                    'success' => true // To show the verification form again
                ]);
            }
        }
        
        // Redirect to forgot password page if no POST data
        header('Location: /index.php?controller=login&action=forgotPassword');
        exit;
    }
    
    public function resetPassword()
    {
        if (isset($_POST['email']) && isset($_POST['resetCode']) && isset($_POST['password']) && isset($_POST['confirmPassword'])) {
            $email = $_POST['email'];
            $resetCode = $_POST['resetCode'];
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirmPassword'];
            
            // Verify code again for security
            $validCode = $this->authmodel->verifyResetCode($email, $resetCode);
            
            if (!$validCode) {
                return $this->view('login.forgotPassword', [
                    'error' => 'Invalid or expired verification code'
                ]);
            }
            
            if ($password !== $confirmPassword) {
                return $this->view('login.resetPassword', [
                    'error' => 'Passwords do not match',
                    'email' => $email,
                    'resetCode' => $resetCode
                ]);
            }
            
            // Update password
            $success = $this->authmodel->updatePassword($email, $password);
            
            if ($success) {
                // Invalidate the code after use
                $this->authmodel->invalidateResetCode($email);
                
                return $this->view('login.index', [
                    'success' => 'Password has been updated. You can now login with your new password'
                ]);
            } else {
                return $this->view('login.resetPassword', [
                    'error' => 'Failed to update password',
                    'email' => $email,
                    'resetCode' => $resetCode
                ]);
            }
        } elseif (isset($_GET['token'])) {
            // For backward compatibility with old links
            return $this->view('login.index', [
                'error' => 'Password reset method has changed. Please request a new password reset.'
            ]);
        }
        
        // Redirect to forgot password page if no POST data
        header('Location: /index.php?controller=login&action=forgotPassword');
        exit;
    }
}