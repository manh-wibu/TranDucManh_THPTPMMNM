<?php
// Require SessionHelper and other necessary files
require_once('app/config/database.php');
require_once('app/models/ProductModel.php');
require_once('app/models/CategoryModel.php');
require_once('app/helpers/SessionHelper.php');

class ProductController
{
    private $productModel;
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->productModel = new ProductModel($this->db);
    }

    // List products (available to both users and admins)
    public function index()
    {
        $products = $this->productModel->getProducts();
        include 'app/views/product/list.php';
    }

    // Show product details (available to both users and admins)
    public function show($id)
    {
        $product = $this->productModel->getProductById($id);
        if ($product) {
            include 'app/views/product/show.php';
        } else {
            echo "Không thấy sản phẩm.";
        }
    }

    // Add product (admin only)
    public function add()
    {
        // Check if the user is logged in and is admin
        if (!SessionHelper::isLoggedIn() || !SessionHelper::isAdmin()) {
            http_response_code(404);
            include 'app/views/product/error.php';
            exit;
        }

        $categories = (new CategoryModel($this->db))->getCategories();
        include_once 'app/views/product/add.php';
    }

    // Save new product (admin only)
    public function save()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';
            $price = $_POST['price'] ?? '';
            $category_id = $_POST['category_id'] ?? null;
            $image = isset($_FILES['image']) && $_FILES['image']['error'] == 0 ? $this->uploadImage($_FILES['image']) : "";

            // Add the product
            $result = $this->productModel->addProduct($name, $description, $price, $category_id, $image);

            if (is_array($result)) {
                $errors = $result;
                $categories = (new CategoryModel($this->db))->getCategories();
                include 'app/views/product/add.php';
            } else {
                header('Location: /webbanhang1/Product');
            }
        }
    }

    // Edit product (admin only)
    public function edit($id)
    {
        // Check if the user is logged in and is admin
        if (!SessionHelper::isLoggedIn() || !SessionHelper::isAdmin()) {
            http_response_code(404);
            include 'app/views/product/error.php';
            exit;
        }

        $product = $this->productModel->getProductById($id);
        $categories = (new CategoryModel($this->db))->getCategories();

        if ($product) {
            include 'app/views/product/edit.php';
        } else {
            echo "Không thấy sản phẩm.";
        }
    }

    // Update product (admin only)
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category_id = $_POST['category_id'];
            $image = isset($_FILES['image']) && $_FILES['image']['error'] == 0 ? $this->uploadImage($_FILES['image']) : $_POST['existing_image'];

            $edit = $this->productModel->updateProduct($id, $name, $description, $price, $category_id, $image);

            if ($edit) {
                header('Location: /webbanhang1/Product');
            } else {
                echo "Đã xảy ra lỗi khi lưu sản phẩm.";
            }
        }
    }

    // Delete product (admin only)
    public function delete($id)
    {
        // Check if the user is logged in and is admin
        if (!SessionHelper::isLoggedIn() || !SessionHelper::isAdmin()) {
            http_response_code(404);
            include 'app/views/product/error.php';
            exit;
        }
        
        if ($this->productModel->deleteProduct($id)) {
            header('Location: /webbanhang1/Product');
        } else {
            echo "Đã xảy ra lỗi khi xóa sản phẩm.";
        }
    }

    // Upload image for product
    private function uploadImage($file)
    {
        $target_dir = "uploads/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        $target_file = $target_dir . basename($file["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $check = getimagesize($file["tmp_name"]);

        if ($check === false) {
            throw new Exception("File không phải là hình ảnh.");
        }

        if ($file["size"] > 10 * 1024 * 1024) {
            throw new Exception("Hình ảnh có kích thước quá lớn.");
        }

        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            throw new Exception("Chỉ cho phép các định dạng JPG, JPEG, PNG và GIF.");
        }

        if (!move_uploaded_file($file["tmp_name"], $target_file)) {
            throw new Exception("Có lỗi xảy ra khi tải lên hình ảnh.");
        }

        return $target_file;
    }

    // Add to cart (user only)
    public function addToCart($id)
    {
        if (!SessionHelper::isLoggedIn() || SessionHelper::isAdmin()) {
            $_SESSION['redirect_after_login'] = '/webbanhang1/Product/addToCart/' . $id; 
            hhttp_response_code(404);
            include 'app/views/product/error.php';
            exit;
        }

        $product = $this->productModel->getProductById($id);
        if (!$product) {
            echo "Không tìm thấy sản phẩm.";
            return;
        }

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]['quantity']++;
        } else {
            $_SESSION['cart'][$id] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'image' => $product->image
            ];
        }
        header('Location: /webbanhang1/Product/cart');
    }

    // View cart (user only)
    public function cart()
    {
        if (!SessionHelper::isLoggedIn() || SessionHelper::isAdmin()) {
            http_response_code(404);
            include 'app/views/product/error.php';
            exit;
        }

        $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
        include 'app/views/product/cart.php';
    }

    // Checkout (user only)
    public function checkout()
    {
        if (!SessionHelper::isLoggedIn()) {
            http_response_code(404);
            include 'app/views/product/error.php';
            exit;
        }

        include 'app/views/product/checkout.php';
    }

    // Remove item from cart (user only)
    public function removeFromCart($id)
    {
        if (isset($_SESSION['cart'][$id])) {
            unset($_SESSION['cart'][$id]);
        }
        header('Location: /webbanhang1/Product/cart');
    }

    // Update cart quantity (user only)
    public function updateQuantity($product_id)
    {
        $new_quantity = $_POST['quantity'];
        $_SESSION['cart'][$product_id]['quantity'] = $new_quantity;
        header('Location: /webbanhang1/Product/cart');
        exit;
    }

    // Process checkout (user only)
    public function processCheckout()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];

            if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
                echo "Giỏ hàng trống.";
                return;
            }

            // Begin transaction
            $this->db->beginTransaction();
            try {
                // Save order
                $query = "INSERT INTO orders (name, phone, address) VALUES (:name, :phone, :address)";
                $stmt = $this->db->prepare($query);
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':phone', $phone);
                $stmt->bindParam(':address', $address);
                $stmt->execute();
                $order_id = $this->db->lastInsertId();

                // Save order details
                $cart = $_SESSION['cart'];
                foreach ($cart as $product_id => $item) {
                    $query = "INSERT INTO order_details (order_id, product_id, quantity, price) VALUES (:order_id, :product_id, :quantity, :price)";
                    $stmt = $this->db->prepare($query);
                    $stmt->bindParam(':order_id', $order_id);
                    $stmt->bindParam(':product_id', $product_id);
                    $stmt->bindParam(':quantity', $item['quantity']);
                    $stmt->bindParam(':price', $item['price']);
                    $stmt->execute();
                }

                // Clear cart
                unset($_SESSION['cart']);

                // Commit transaction
                $this->db->commit();

                // Redirect to order confirmation
                header('Location: /webbanhang1/Product/orderConfirmation');
            } catch (Exception $e) {
                // Rollback if error occurs
                $this->db->rollBack();
                echo "Đã xảy ra lỗi khi xử lý đơn hàng: " . $e->getMessage();
            }
        }
    }

    // Order confirmation (user only)
    public function orderConfirmation()
    {
        include 'app/views/product/orderConfirmation.php';
    }
}
?>
