<?php
require_once('app/config/database.php');
require_once('app/models/AccountModel.php');

class AccountController {
    private $accountModel;
    private $db;

    public function __construct() {
        $this->db = (new Database())->getConnection();
        $this->accountModel = new AccountModel($this->db);
    }

    // Hàm hiển thị form đăng ký
    public function register() {
        include_once 'app/views/account/register.php';
    }

    // Hàm hiển thị form đăng nhập
    public function login() {
        include_once 'app/views/account/login.php';
    }

    // Hàm xử lý lưu tài khoản mới
    public function save() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'] ?? '';
            $fullName = $_POST['fullname'] ?? '';
            $password = $_POST['password'] ?? '';
            $confirmPassword = $_POST['confirmpassword'] ?? '';
            $errors = [];

            // Kiểm tra dữ liệu nhập vào
            if (empty($username)) {
                $errors['username'] = "Vui lòng nhập tên đăng nhập!";
            }
            if (empty($fullName)) {
                $errors['fullname'] = "Vui lòng nhập tên đầy đủ!";
            }
            if (empty($password)) {
                $errors['password'] = "Vui lòng nhập mật khẩu!";
            }
            if ($password != $confirmPassword) {
                $errors['confirmPass'] = "Mật khẩu và xác nhận không trùng khớp!";
            }

            // Kiểm tra xem tài khoản đã tồn tại chưa
            $account = $this->accountModel->getAccountByUsername($username);
            if ($account) {
                $errors['account'] = "Tài khoản này đã có người đăng ký!";
            }

            // Nếu có lỗi, trả về form đăng ký với lỗi
            if (count($errors) > 0) {
                include_once 'app/views/account/register.php';
            } else {
                // Mã hóa mật khẩu trước khi lưu vào cơ sở dữ liệu
                $result = $this->accountModel->save($username, $fullName, $password);

                if ($result) {
                    header('Location: /webbanhang1/account/login');
                    exit;
                }
            }
        }
    }

    // Hàm xử lý đăng xuất
    public function logout() {
        unset($_SESSION['username']);
        unset($_SESSION['role']);
        header('Location: /webbanhang1/product');
    }

    // Hàm kiểm tra đăng nhập
    // Hàm kiểm tra đăng nhập
public function checkLogin() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        // Kiểm tra xem liệu form đã được submit và dữ liệu có đầy đủ không
        if (empty($username) || empty($password)) {
            echo "Vui lòng nhập đầy đủ thông tin.";
            return;
        }

        // Lấy tài khoản từ cơ sở dữ liệu
        $account = $this->accountModel->getAccountByUsername($username);

        if ($account) {
            // Kiểm tra mật khẩu với mật khẩu đã mã hóa trong cơ sở dữ liệu
            if ($this->accountModel->verifyPassword($password, $account->password)) {
                // Đăng nhập thành công
                session_start(); // Sửa lại đây thành session_start()

                // Đặt session sau khi đăng nhập thành công
                $_SESSION['username'] = $account->username;
                $_SESSION['user_role'] = $account->role; // Đảm bảo lưu role đúng cách

                header('Location: /webbanhang1/product');  // Chuyển hướng đến trang sản phẩm
                exit;
            } else {
                echo "Mật khẩu không chính xác.";
            }
        } else {
            echo "Không tìm thấy tài khoản này.";
        }
    }
}
}
?>
