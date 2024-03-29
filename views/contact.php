<?php
include("$_SERVER[DOCUMENT_ROOT]/GTST/views/layouts/client/header.php");
?>
<!-- Bottom Bar End -->

<!-- Breadcrumb Start -->
<div class="breadcrumb-wrap">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">TRANG CHỦ</a></li>
            <li class="breadcrumb-item active">LIÊN HỆ</li>
        </ul>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Contact Start -->
<div class="contact">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">
                <div class="contact-info">
                    <h2>Văn Phòng</h2>
                    <h3><i class="fa fa-map-marker"></i>Khu Công Nghệ Cao Hutech, Q.9, TP.HCM</h3>
                    <h3><i class="fa fa-envelope"></i>ltvcblue@gmail.com</h3>
                    <h3><i class="fa fa-phone"></i>012-3456-789</h3>
                    <div class="social">
                        <a href=""><i class="fab fa-twitter"></i></a>
                        <a href=""><i class="fab fa-facebook-f"></i></a>
                        <a href=""><i class="fab fa-linkedin-in"></i></a>
                        <a href=""><i class="fab fa-instagram"></i></a>
                        <a href=""><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="contact-info">
                    <h2>Cửa Hàng</h2>
                    <h3><i class="fa fa-map-marker"></i>Khu Công Nghệ Cao Hutech, Q.9, TP.HCM</h3>
                    <h3><i class="fa fa-envelope"></i>ltvcblue@gmail.com</h3>
                    <h3><i class="fa fa-phone"></i>012-3456-789</h3>
                    <div class="social">
                        <a href=""><i class="fab fa-twitter"></i></a>
                        <a href=""><i class="fab fa-facebook-f"></i></a>
                        <a href=""><i class="fab fa-linkedin-in"></i></a>
                        <a href=""><i class="fab fa-instagram"></i></a>
                        <a href=""><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="contact-form">
                    <form>
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="Họ & Tên" />
                            </div>
                            <div class="col-md-6">
                                <input type="email" class="form-control" placeholder="Email" />
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Chủ đề" />
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" rows="5" placeholder="Nội Dung"></textarea>
                        </div>
                        <div><button class="btn" type="submit">Gửi</button></div>
                    </form>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="contact-map">
                    <div class="mapouter">
                        <div class="gmap_canvas"><iframe width="1200px" height="500px" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=600&amp;height=400&amp;hl=en&amp;q=Đại học Hutech Khu E&amp;t=&amp;z=16&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>
                        </div>
                        <style>
                            .mapouter {
                                position: relative;
                                text-align: center;
                                margin-top: 20px;
                                margin-bottom: -15px;
                                width: 1150px;
                                height: 500px;
                            }

                            .gmap_canvas {
                                overflow: hidden;
                                background: none !important;
                                width: 1170px;
                                height: 500px;
                            }
                        </style>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
<!-- Contact End -->

<!-- Footer Start -->
<?php
include("$_SERVER[DOCUMENT_ROOT]/GTST/views/layouts/client/footer.php");
?>