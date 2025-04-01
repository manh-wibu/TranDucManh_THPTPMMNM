<?php include 'app/views/shares/header.php'; ?>

<h1 class="text-center my-4">Sửa sản phẩm</h1>

<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form method="POST" action="/webbanhang1/Product/update" enctype="multipart/form-data" onsubmit="return validateForm();">
    <input type="hidden" name="id" value="<?php echo $product->id; ?>">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Tên sản phẩm -->
                <div class="form-group">
                    <label for="name">Tên sản phẩm:</label>
                    <input type="text" id="name" name="name" class="form-control" value="<?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>" required>
                </div>

                <!-- Mô tả sản phẩm -->
                <div class="form-group">
                    <label for="description">Mô tả:</label>
                    <textarea id="description" name="description" class="form-control" required><?php echo htmlspecialchars($product->description, ENT_QUOTES, 'UTF-8'); ?></textarea>
                </div>

                <!-- Giá sản phẩm -->
                <div class="form-group">
                    <label for="price">Giá:</label>
                    <input type="number" id="price" name="price" class="form-control" value="<?php echo htmlspecialchars($product->price, ENT_QUOTES, 'UTF-8'); ?>" required>
                </div>

                <!-- Danh mục sản phẩm -->
                <div class="form-group">
                    <label for="category_id">Danh mục:</label>
                    <select id="category_id" name="category_id" class="form-control" required>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?php echo $category->id; ?>" <?php echo isset($product->category_id) && $category->id == $product->category_id ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8'); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Hình ảnh sản phẩm -->
                <div class="form-group">
                    <label for="image">Hình ảnh:</label>
                    <input type="file" id="image" name="image" class="form-control">
                    <input type="hidden" name="existing_image" value="<?php echo $product->image; ?>">
                    <?php if ($product->image): ?>
                        <div class="mt-2">
                            <img src="/<?php echo $product->image; ?>" alt="Product Image" style="max-width: 100px; height: auto;">
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Nút lưu thay đổi -->
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                </div>

                <!-- Nút quay lại -->
                <div class="form-group text-center mt-3">
                    <a href="/webbanhang1/Product/" class="btn btn-secondary">🔙 Quay lại danh sách sản phẩm</a>
                </div>
            </div>
        </div>
    </div>
</form>

<?php include 'app/views/shares/footer.php'; ?>
