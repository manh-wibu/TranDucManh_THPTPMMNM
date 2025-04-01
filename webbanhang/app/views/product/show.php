<?php include 'app/views/shares/header.php'; ?>

<?php if ($product): ?>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Chi tiết sản phẩm</h1>
        <div class="card shadow p-4 rounded bg-white">
            <div class="card-body text-center">
                <h2 class="card-title"> <?php echo htmlspecialchars($product->name ?? '', ENT_QUOTES, 'UTF-8'); ?></h2>
                
                <?php if (!empty($product->image)): ?>
                    <img src="/webbanhang1/<?php echo htmlspecialchars($product->image, ENT_QUOTES, 'UTF-8'); ?>" alt="Product Image" class="img-fluid rounded mt-3" style="max-width: 200px;">
                <?php endif; ?>
                
                <p class="mt-3"><strong>Mô tả:</strong> 
                <?php echo htmlspecialchars($product->description, ENT_QUOTES, 'UTF-8'); ?></p> 
                <p><strong>Giá:</strong> 
                 <?php echo htmlspecialchars($product->price ?? '0', ENT_QUOTES, 'UTF-8'); ?> VND</p>
                <p><strong>Danh mục:</strong> 
                    <?php echo htmlspecialchars($product->category_name, ENT_QUOTES, 'UTF-8'); ?></p>
                
                <div class="mt-4">
                <?php if (SessionHelper::isLoggedIn()): ?>
                <div style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap;">
                    <!-- Nếu là admin thì hiển thị nút Sửa và Xóa -->
                    <?php if (SessionHelper::isAdmin()): ?>
                        <a href="/webbanhang1/Product/edit/<?php echo $product->id; ?>" class="btn btn-primary" style="padding: 12px 25px; font-size: 20px; color: #fff; border-radius: 30px; border: none;">✏️ Sửa</a>
                        <a href="/webbanhang1/Product/delete/<?php echo $product->id; ?>" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');" style="padding: 12px 25px; font-size: 20px; color: #000; border-radius: 30px; border: none;">🗑️ Xóa</a>
                        <a href="/webbanhang1/Product" class="btn btn-secondary">🔙 Quay lại danh sách</a>
                    <?php endif; ?>

                    <!-- Nếu không phải admin thì hiển thị nút Thêm vào giỏ hàng -->
                    <?php if (!SessionHelper::isAdmin()): ?>
                        <a href="/webbanhang1/Product/addToCart/<?php echo $product->id; ?>" class="btn btn-success" style="padding: 12px 25px; font-size: 20px; color: #ff7f00; border-radius: 30px; background-color: #2ecc71; border: none;">🛒 Thêm vào giỏ hàng</a>
                        <a href="/webbanhang1/Product" class="btn btn-secondary">🔙 Quay lại danh sách</a>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <!-- Nếu chưa đăng nhập, chỉ hiển thị nút đăng nhập -->
                <div style="text-align: center; margin-top: 15px;">
                    <a href="/webbanhang1/account/login" class="btn btn-warning" style="padding: 12px 25px; font-size: 20px; color: #2ecc71; border-radius: 30px; background-color: #f39c12; border: none;">🔒 Đăng nhập để mua hàng</a>
                    <a href="/webbanhang1/Product" class="btn btn-secondary">🔙 Quay lại danh sách</a>
                </div>
            <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php else: ?>
    <p class="text-center text-danger mt-5">Sản phẩm không tồn tại.</p>
<?php endif; ?>

<?php include 'app/views/shares/footer.php'; ?>