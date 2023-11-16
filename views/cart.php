<?php
include("$_SERVER[DOCUMENT_ROOT]/GTST/views/layouts/client/header.php");
?>
<!-- Bottom Bar End -->

<!-- Breadcrumb Start -->
<div class="breadcrumb-wrap">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">TRANG CHỦ</a></li>
            <li class="breadcrumb-item"><a href="#">SẢN PHẨM</a></li>
            <li class="breadcrumb-item active">GIỎ HÀNG</li>
        </ul>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Cart Start -->
<div class="cart-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <div class="cart-page-inner">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th>Giá</th>
                                    <th>Số lượng</th>
                                    <th>Tổng cộng</th>
                                    <th>Xóa</th>
                                </tr>
                            </thead>
                            <tbody class="align-middle">
                                <tr>
                                    <td>
                                        <div class="img">
                                            <a href="#"><img src="img/product-1.jpg" alt="Image"></a>
                                            <p>Product Name</p>
                                        </div>
                                    </td>
                                    <td>99đ</td>
                                    <td>
                                        <div class="qty">
                                            <button class="btn-minus"><i class="fa fa-minus"></i></button>
                                            <input type="text" value="1">
                                            <button class="btn-plus"><i class="fa fa-plus"></i></button>
                                        </div>
                                    </td>
                                    <td>99đ</td>
                                    <td><button><i class="fa fa-trash"></i></button></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="img">
                                            <a href="#"><img src="img/product-2.jpg" alt="Image"></a>
                                            <p>Product Name</p>
                                        </div>
                                    </td>
                                    <td>99đ</td>
                                    <td>
                                        <div class="qty">
                                            <button class="btn-minus"><i class="fa fa-minus"></i></button>
                                            <input type="text" value="1">
                                            <button class="btn-plus"><i class="fa fa-plus"></i></button>
                                        </div>
                                    </td>
                                    <td>99đ</td>
                                    <td><button><i class="fa fa-trash"></i></button></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="img">
                                            <a href="#"><img src="img/product-3.jpg" alt="Image"></a>
                                            <p>Product Name</p>
                                        </div>
                                    </td>
                                    <td>99đ</td>
                                    <td>
                                        <div class="qty">
                                            <button class="btn-minus"><i class="fa fa-minus"></i></button>
                                            <input type="text" value="1">
                                            <button class="btn-plus"><i class="fa fa-plus"></i></button>
                                        </div>
                                    </td>
                                    <td>99đ</td>
                                    <td><button><i class="fa fa-trash"></i></button></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="img">
                                            <a href="#"><img src="img/product-4.jpg" alt="Image"></a>
                                            <p>Product Name</p>
                                        </div>
                                    </td>
                                    <td>99đ</td>
                                    <td>
                                        <div class="qty">
                                            <button class="btn-minus"><i class="fa fa-minus"></i></button>
                                            <input type="text" value="1">
                                            <button class="btn-plus"><i class="fa fa-plus"></i></button>
                                        </div>
                                    </td>
                                    <td>99đ</td>
                                    <td><button><i class="fa fa-trash"></i></button></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="img">
                                            <a href="#"><img src="img/product-5.jpg" alt="Image"></a>
                                            <p>Product Name</p>
                                        </div>
                                    </td>
                                    <td>99đ</td>
                                    <td>
                                        <div class="qty">
                                            <button class="btn-minus"><i class="fa fa-minus"></i></button>
                                            <input type="text" value="1">
                                            <button class="btn-plus"><i class="fa fa-plus"></i></button>
                                        </div>
                                    </td>
                                    <td>99đ</td>
                                    <td><button><i class="fa fa-trash"></i></button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="cart-page-inner">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="coupon">
                                <input type="text" placeholder="Nhập mã giảm giá...">
                                <button>Mã giảm giá</button>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="cart-summary">
                                <div class="cart-content">
                                    <h1>Tóm tắt giỏ hàng</h1>
                                    <p>Tổng tiền<span>99đ</span></p>
                                    <p>Phí vận chuyển<span>1đ</span></p>
                                    <h2>Tổng cộng<span>100đ</span></h2>
                                </div>
                                <div class="cart-btn">
                                    <button>Cập nhập giỏ hàng</button>
                                    <button>Thanh toán</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Cart End -->

<!-- Footer Start -->
<?php
include("$_SERVER[DOCUMENT_ROOT]/GTST/views/layouts/client/footer.php");
?>