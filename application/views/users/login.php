<div class="content">
      <div class="container-form">
          <div class="signup">
              <h1 class="signup-heading">Đăng nhập</h1>
              <form action="<?php echo URL?>/users/login" class="signup-form" method="POST" >
                  <label for="username" class="signup-label">User name</label>
                  <input type="text" name="email" class="signup-input" required placeholder="enter your username">
                  <label for="password" class="signup-label">Password</label>
                  <input type="password" name="password" class="signup-input" required placeholder="enter your password">
                  <input type="submit" name="login" class="signup-submit"></input>
              </form>
              <p class="signup-already">
                  <span>Bạn chưa có tài khoản ?</span>
                  <a href="#" class="signup-login-link">Đăng ký</a>
              </p>
          </div>
      </div>
  </div>