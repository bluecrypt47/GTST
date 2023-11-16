<?php
include("$_SERVER[DOCUMENT_ROOT]/GTST/views/layouts/client/header.php");
include("$_SERVER[DOCUMENT_ROOT]/GTST/model/client/login.php");

$class = new login();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $captcha = $_POST['captcha'];

    $checkLogin = $class->login($username, $password, $captcha);
}


?>
<!-- Bottom Bar End -->

<!-- Breadcrumb Start -->
<div class="breadcrumb-wrap">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Login & Register</li>
        </ul>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Login Start -->
<div class="login">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <div class="register-form">
                    <h2>Đăng Kí</h2>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Họ & Tên</label>
                            <input class="form-control" type="text" placeholder="Họ & Tên">
                        </div>
                        <div class="col-md-6">
                            <label>Tên tài khoản</label>
                            <input class="form-control" type="text" placeholder="Tên tài khoản">
                        </div>
                        <div class="col-md-6">
                            <label>E-mail</label>
                            <input class="form-control" type="text" placeholder="E-mail">
                        </div>
                        <div class="col-md-6">
                            <label>Số điên thoại</label>
                            <input class="form-control" type="text" placeholder="Số điện thoại">
                        </div>
                        <div class="col-md-6">
                            <label>Mật Khẩu</label>
                            <input class="form-control" type="password" placeholder="Mật khẩu">
                        </div>
                        <div class="col-md-6">
                            <label>Gõ lại mật khẩu</label>
                            <input class="form-control" type="password" placeholder="Gõ lại mật khẩu">
                        </div>
                        <div class="col-md-12">
                            <button class="btn">Đăng kí</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="login-form">
                    <h2>Đăng Nhập</h2>
                    <form action="login.php" method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Tên tài khoản</label>
                                <input class="form-control" type="text" placeholder="Tên tài khoản" name="username">
                            </div>
                            <div class="col-md-6">
                                <label>Mật khẩu</label>
                                <input class="form-control" type="text" placeholder="Mật khẩu" name="password">
                            </div>
                            <div class="col-md-6">
                                <label>Enter Captcha</label>
                                <input type="text" class="form-control" name="captcha" id="captcha">
                            </div>
                            <div class="col-md-6">
                                <label>Captcha Code</label>
                                <img src="../views/admin/captcha.php" alt="PHP Captcha">
                            </div>
                            <!-- <div class="col-md-12">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="newaccount">
                                <label class="custom-control-label" for="newaccount">Giữ đăng nhập</label>
                            </div>
                        </div> -->

                            <?php if (isset($checkLogin)) {
                                echo $checkLogin;
                            } ?>
                            <div class="col-md-12">
                                <input type="submit" name="login" value="Login" class="btn btn-primary" />
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Login End -->

<!-- Footer Start -->
<?php
include("$_SERVER[DOCUMENT_ROOT]/GTST/views/layouts/client/footer.php");
?>