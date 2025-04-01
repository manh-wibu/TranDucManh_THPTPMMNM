<?php
class AccountModel {
    private $conn;
    private $table_name = "account";  // Đảm bảo tên bảng đúng

    public function __construct($db) {
        $this->conn = $db;
    }

    // Lấy tài khoản dựa trên tên đăng nhập
    public function getAccountByUsername($username) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE username = :username";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return $result;
    }

    // Lưu tài khoản mới vào cơ sở dữ liệu
    public function save($username, $fullname, $password, $role = "user") {
        // Mã hóa mật khẩu trước khi lưu vào cơ sở dữ liệu
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        $query = "INSERT INTO " . $this->table_name . " (username, fullname, password, role)
                  VALUES (:username, :fullname, :password, :role)";
        $stmt = $this->conn->prepare($query);

        // Làm sạch dữ liệu
        $username = htmlspecialchars(strip_tags($username));
        $fullname = htmlspecialchars(strip_tags($fullname));

        // Gán giá trị vào câu lệnh
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':fullname', $fullname);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->bindParam(':role', $role);

        // Thực thi câu lệnh SQL và trả về kết quả
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Kiểm tra mật khẩu đã nhập có đúng với mật khẩu đã mã hóa không
    public function verifyPassword($input_password, $stored_password) {
        return password_verify($input_password, $stored_password);
    }
}

?>
