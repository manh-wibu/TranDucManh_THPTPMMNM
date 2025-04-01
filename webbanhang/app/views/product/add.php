<?php include 'app/views/shares/header.php'; ?>

<h1 class="text-center my-4">Thêm sản phẩm mới</h1>

<?php if (!empty($errors)): ?>
<div class="alert alert-danger">
    <ul>
        <?php foreach ($errors as $error): ?>
            <li><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></li>
        <?php endforeach; ?>
    </ul>
</div>
<?php endif; ?>

<form method="POST" action="/webbanhang1/Product/save" enctype="multipart/form-data" onsubmit="return validateForm();">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="form-group">
                    <label for="name">Tên sản phẩm:</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="description">Mô tả:</label>
                    <textarea id="description" name="description" class="form-control" required></textarea>
                </div>

                <div class="form-group">
                    <label for="price">Giá:</label>
                    <input type="number" id="price" name="price" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="category_id">Danh mục:</label>
                    <select id="category_id" name="category_id" class="form-control" required>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?php echo $category->id; ?>">
                                <?php echo htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8'); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="image">Hình ảnh:</label>
                    <input type="file" id="image" name="image" class="form-control">
                </div>

                <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
                </div>
                
                <div class="form-group text-center mt-3">
                    <a href="/webbanhang1/Product/" class="btn btn-secondary">🔙 Quay lại danh sách</a>
                </div>
            </div>
        </div>
    </div>
</form>

<?php include 'app/views/shares/footer.php'; ?>
