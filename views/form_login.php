<!-- Form đăng nhập -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <span class="login-caption">
                    Dù ai đi ngược về xuôi,</br>
                    đến giờ đọc truyện cứ vào SH
                </span>
                <div>
                    <div class="group-buttons">
                        <button type="button" class="btn modal-btn-dangnhap btn-outline-primary">Đăng nhập</button>
                        <button type="button" class="btn modal-btn-dangky btn-outline-primary">Đăng ký</button>
                    </div>

                    <div class="tab-content">
                        <div class="form-login ">
                            <p class="text-danger warning-login"></p>
                            <input type="email" placeholder="Tài khoản" id="email_login">
                            <input type="password" placeholder="Mật khẩu" id="password_login">
                            <button type="submit" class="button_login btn btn-lg" id="button_login">Đăng nhập</button>
                            <a href="" class="forget-password-link">Quên mật khẩu</a>
                        </div>

                        <div class="form-registration">
                            <p class="text-danger warning-register"></p>
                            <p class="text-success success-register"></p>
                            <input type="email" placeholder="Tài khoản" id="email_register">
                            <input type="password" placeholder="Mật khẩu" id="password_register">
                            <input type="password" placeholder="Nhập lại mật khẩu" id="rp_password_register">
                            <button type="submit" id="button_register">Đăng ký</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

     <div class="modal fade" id="modal-change-pw">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
                    <div class="group-buttons">
                        <p class="text-primary title-change-pw">Đổi mật khẩu</p>
                    </div>
                <div class="form-change-pw">
                            <p class="text-danger warning-change-pw"></p>
                            <p class="text-success success-change-pw"></p>
                            <input type="password" class="reset-form" placeholder="Mật khẩu cũ" id="old_pw">
                            <input type="password" class="reset-form" placeholder="Mật khẩu mới" id="new_pw">
                            <input type="password" class="reset-form" placeholder="Nhập lại mật khẩu mơi" id="repeat_new_pw">
                            <button type="submit" id="button_change_pw">Đổi mật khẩu</button>
                </div>
            
            
          </div>
        </div>
      </div>