<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sản phẩm</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar-nav { margin-left: 0; }
        .navbar-nav .nav-item { margin-right: 20px; }
        .navbar-nav.ml-auto { margin-left: auto; }
        .navbar { padding-left: 20px; padding-right: 20px; }
        .navbar-nav .nav-item .btn { padding: 8px 16px; }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Menu</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/webbanhang1/Product/">Danh sách sản phẩm</a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <?php if (SessionHelper::isLoggedIn()): ?>
                    <li class="nav-item">
                        <span class="navbar-text mr-3 text-primary">Hello, <?php echo $_SESSION['username']; ?></span>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-danger" href="/webbanhang1/account/logout">Đăng xuất</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="btn btn-outline-primary" href="/webbanhang1/account/login">Đăng nhập</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-danger" href="/webbanhang1/account/register">Đăng ký</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

    <div class="container mt-4">
        <!-- Page content goes here -->
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
