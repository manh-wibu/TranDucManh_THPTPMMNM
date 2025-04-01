<?php include 'app/views/shares/header.php'; ?>

<section class="vh-100 gradient-custom">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card bg-dark text-white" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">
            <form action="/webbanhang1/account/checklogin" method="post">
              
              <div class="mb-md-5 mt-md-4 pb-5">
                <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                <p class="text-white-50 mb-5">Vui lòng nhập tên đăng nhập và mật khẩu của bạn!</p>

                <!-- Username Input -->
                <div class="form-outline form-white mb-4">
                <input type="text" name="username" class="form-control form-control-lg" placeholder="Tài khoản" required />
                </div>

                <!-- Password Input -->
                <div class="form-outline form-white mb-4">
                <input type="password" name="password" class="form-control form-control-lg" placeholder="Mật khẩu" required />
                </div>

                <!-- Forgot Password Link -->
                <p class="small mb-5 pb-lg-2"><a class="text-white-50" href="#">Quên mật khẩu?</a></p>

                <!-- Login Button -->
                <button class="btn btn-outline-light btn-lg px-5" type="submit">Đăng nhập</button>

                <!-- Social Media Login Links -->
                <div class="d-flex justify-content-center text-center mt-4 pt-1">
                  <a href="#" class="text-white"><i class="fab fa-facebook-f fa-lg"></i></a>
                  <a href="#" class="text-white"><i class="fab fa-twitter fa-lg mx-4 px-2"></i></a>
                  <a href="#" class="text-white"><i class="fab fa-google fa-lg"></i></a>
                </div>
              </div>

              <!-- Sign Up Link -->
              <div>
                <p class="mb-0">Bạn chưa có tài khoản? <a href="/webbanhang1/account/register" class="text-white-50 fw-bold">Đăng ký</a></p>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include 'app/views/shares/footer.php'; ?>
