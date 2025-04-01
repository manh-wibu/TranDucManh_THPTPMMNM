<!-- Bao gồm phần đầu trang -->

<!-- Banner toàn màn hình -->
<div class="banner" style="background-color: #000000; color: #ffffff; padding: 60px; text-align: center; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5); width: 100%; margin: 0;">
    <h1 style="font-size: 56px; margin: 0; font-weight: bold; text-transform: uppercase;">Shop Công Nghệ</h1>
    <p style="font-size: 32px; color: #e67e22;">Nơi công nghệ giao nhau</p>
    <p style="font-size: 24px;">Khuyến mãi: <strong>Giảm giá 5% từ ngày 3/3/2025 đến 9/3/2025</strong></p>
</div>

<?php include 'app/views/shares/header.php'; ?>

<div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 20px; margin: 0 auto; padding: 20px;">
    <?php foreach ($products as $product): ?>
    <div style="flex: 0 1 calc(33.33% - 40px); box-sizing: border-box;">
        <div class="list-group-item" style="border: 1px solid #bdc3c7; border-radius: 12px; padding: 20px; background-color: #ecf0f1; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); transition: transform 0.3s ease, box-shadow 0.3s ease;">
            
            <h2 style="font-size: 24px; margin-bottom: 10px; font-weight: bold; color: #2c3e50; text-align: center;">
                <a href="/webbanhang1/Product/show/<?php echo $product->id; ?>" style="text-decoration: none; color: inherit;"><?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?></a>
            </h2>

            <?php if ($product->image): ?>
                <div style="text-align: center; margin-bottom: 15px;">
                    <a href="/webbanhang1/Product/show/<?php echo $product->id; ?>" style="text-decoration: none;">
                        <img src="/webbanhang1/<?php echo $product->image; ?>" alt="Product Image" style="max-width: 100%; height: 250px; object-fit: cover; border-radius: 12px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                    </a>
                </div>
            <?php endif; ?>

            <p style="font-size: 16px; color: #7f8c8d; margin-bottom: 15px; text-align: center;"><?php echo htmlspecialchars($product->description, ENT_QUOTES, 'UTF-8'); ?></p>
            <p style="font-size: 20px; font-weight: bold; color: #27ae60; text-align: center;">Giá: <?php echo htmlspecialchars($product->price, ENT_QUOTES, 'UTF-8'); ?> VND</p>
            <p style="font-size: 16px; color: #95a5a6; margin-bottom: 20px; text-align: center;">Danh mục: <?php echo htmlspecialchars($product->category_name, ENT_QUOTES, 'UTF-8'); ?></p>

            <!-- Các nút chỉ hiển thị nếu đã đăng nhập -->
            <?php if (SessionHelper::isLoggedIn()): ?>
                <div style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap;">
                    <!-- Nếu là admin thì hiển thị nút Sửa và Xóa -->
                    <?php if (SessionHelper::isAdmin()): ?>
                        <a href="/webbanhang1/Product/edit/<?php echo $product->id; ?>" class="btn btn-primary" style="padding: 12px 25px; font-size: 20px; color: #fff; border-radius: 30px; border: none;">✏️ Sửa</a>
                        <a href="/webbanhang1/Product/delete/<?php echo $product->id; ?>" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');" style="padding: 12px 25px; font-size: 20px; color: #000; border-radius: 30px; border: none;">🗑️ Xóa</a>
                    <?php endif; ?>

                    <!-- Nếu không phải admin thì hiển thị nút Thêm vào giỏ hàng -->
                    <?php if (!SessionHelper::isAdmin()): ?>
                        <a href="/webbanhang1/Product/addToCart/<?php echo $product->id; ?>" class="btn btn-success" style="padding: 12px 25px; font-size: 20px; color: #ff7f00; border-radius: 30px; background-color: #2ecc71; border: none;">🛒 Thêm vào giỏ hàng</a>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <!-- Nếu chưa đăng nhập, chỉ hiển thị nút đăng nhập -->
                <div style="text-align: center; margin-top: 15px;">
                    <a href="/webbanhang1/account/login" class="btn btn-warning" style="padding: 12px 25px; font-size: 20px; color: #2ecc71; border-radius: 30px; background-color: #f39c12; border: none;">🔒 Đăng nhập để mua hàng</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<?php if (SessionHelper::isAdmin()): ?>
    <a href="/webbanhang1/Product/add" class="btn btn-primary mb-2" style="display: block; width: 250px; margin: 0 auto; font-size: 18px; background-color: #27ae60; color: #fff; border-radius: 30px; padding: 15px;">Thêm sản phẩm mới</a>
<?php endif; ?>


<?php include 'app/views/shares/footer.php'; ?> <!-- Bao gồm phần chân trang -->
