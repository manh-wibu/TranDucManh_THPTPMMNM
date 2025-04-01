<?php include 'app/views/shares/header.php'; ?>

<div class="container mt-5">
    <h1 class="text-center mb-4">Giỏ hàng</h1>

    <?php if (empty($cart)): ?>
        <div class="alert alert-info text-center">
            Giỏ hàng của bạn hiện đang trống.
        </div>
    <?php else: ?>
        <div class="row justify-content-center" style="gap: 20px;">
            <?php 
            $total = 0; // Biến lưu tổng tiền giỏ hàng
            foreach ($cart as $product_id => $item): 
                $itemTotal = $item['price'] * $item['quantity']; // Tính tổng tiền cho từng sản phẩm
                $total += $itemTotal; // Cộng vào tổng tiền giỏ hàng
            ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card" style="border-radius: 12px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                        <div class="card-body">
                            <h5 class="card-title text-center" style="font-size: 18px; font-weight: bold;">
                                <?php echo htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8'); ?>
                            </h5>

                            <?php if ($item['image']): ?>
                                <div class="text-center">
                                    <img src="/webbanhang1/<?php echo $item['image']; ?>" alt="Product Image" style="max-width: 100%; height: 200px; object-fit: cover; border-radius: 12px;">
                                </div>
                            <?php endif; ?>

                            <p class="card-text mt-3 text-center">Giá: <?php echo htmlspecialchars($item['price'], ENT_QUOTES, 'UTF-8'); ?> VND</p>

                            <!-- Form nhập số lượng -->
                            <form action="/webbanhang1/Product/updateQuantity/<?php echo $product_id; ?>" method="POST">
                                <div class="form-group text-center">
                                    <label for="quantity<?php echo $product_id; ?>" class="form-label">Số lượng:</label>
                                    <input type="number" id="quantity<?php echo $product_id; ?>" name="quantity" class="form-control d-inline-block" value="<?php echo $item['quantity']; ?>" min="1" required style="width: 80px;">
                                </div>
                                <p class="card-text text-center" style="font-weight: bold;">Tổng tiền: <?php echo number_format($itemTotal, 0, ','); ?> VND</p>
                                <button type="submit" class="btn btn-primary" style="width: 100%;">Cập nhật</button>
                            </form>

                            <!-- Nút xóa sản phẩm khỏi giỏ hàng -->
                            <a href="/webbanhang1/Product/removeFromCart/<?php echo $product_id; ?>" class="btn btn-danger mt-2" style="width: 100%;">Xóa khỏi giỏ hàng</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Hiển thị tổng tiền của giỏ hàng -->
        <div class="text-center mt-3">
            <h3 style="color: #2ecc71;">Tổng tiền giỏ hàng: <?php echo number_format($total, 0, ',', '.'); ?> VND</h3>
        </div>


        <div class="text-center mt-3">
            <a href="/webbanhang1/Product/checkout" class="btn btn-success">Thanh toán</a>
        </div>
    <?php endif; ?>

    <div class="text-center mt-4">
        <a href="/webbanhang1/Product" class="btn btn-secondary">🔙 Quay lại danh sách sản phẩm</a>
    </div>
</div>

<?php include 'app/views/shares/footer.php'; ?>
