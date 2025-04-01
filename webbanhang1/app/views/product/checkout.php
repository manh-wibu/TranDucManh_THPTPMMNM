<?php include 'app/views/shares/header.php'; ?>

<div class="container mt-5">
    <h1 class="text-center mb-4">Thanh toán</h1>

    <form method="POST" action="/webbanhang1/Product/processCheckout" class="p-4 border rounded shadow-sm" style="max-width: 600px; margin: 0 auto;">
        <!-- Họ tên -->
        <div class="form-group">
            <label for="name">Họ tên:</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>

        <!-- Số điện thoại -->
        <div class="form-group">
            <label for="phone">Số điện thoại:</label>
            <input type="text" id="phone" name="phone" class="form-control" required>
        </div>

        <!-- Địa chỉ -->
        <div class="form-group">
            <label for="address">Địa chỉ:</label>
            <textarea id="address" name="address" class="form-control" required></textarea>
        </div>

        <!-- Nút thanh toán -->
        <div class="form-group text-center">
            <button type="submit" class="btn btn-primary btn-lg w-100">Thanh toán</button>
        </div>
    </form>

    <!-- Nút quay lại giỏ hàng -->
    <div class="text-center mt-3">
        <a href="/webbanhang1/Product/cart" class="btn btn-secondary btn-lg">Quay lại giỏ hàng</a>
    </div>
</div>

<?php include 'app/views/shares/footer.php'; ?>
