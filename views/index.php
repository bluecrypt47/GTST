<?php
include("$_SERVER[DOCUMENT_ROOT]/GTST/lib/session.php");
include("$_SERVER[DOCUMENT_ROOT]/GTST/views/layouts/client/header.php");
include("$_SERVER[DOCUMENT_ROOT]/GTST/model/client/products.php");

$products = new products();

?>
<!-- Bottom Bar End -->

<!-- Main Slider Start -->
<div class="header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <nav class="navbar bg-light">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="# "><i class="fa fa-home"></i>HOME</a>
                        </li>
                        <?php
                        $getProduct = $products->getListType();
                        if ($getProduct) {
                            while ($row = $getProduct->fetch_assoc()) {
                        ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="#"><i class="fa fa-plus-square"></i><?php echo $row['nameProductType']; ?></a>
                                </li>

                        <?php
                            }
                        }

                        ?>
                    </ul>
                </nav>
            </div>
            <div class="col-md-6">
                <div class="header-slider normal-slider">
                    <?php
                    $getProductHighlight = $products->getHighlightProduct();
                    if ($getProductHighlight) {
                        while ($row = $getProductHighlight->fetch_assoc()) {
                    ?>
                            <div class="header-slider-item">
                                <img src="../assets/img/product/<?php echo $row['image']; ?>" alt="Slider Image" width="1000px" height="400px">
                                <div class="header-slider-caption">
                                    <p><?php echo $row['description']; ?></p>
                                    <a class="btn" href="product-list.html"><i class="fa fa-shopping-cart"></i>BUY NOW</a>
                                </div>
                            </div>

                    <?php
                        }
                    }

                    ?>
                </div>
            </div>
            <div class="col-md-3">
                <div class="header-img">
                    <div class="img-item">
                        <img src="../assets/client/img/category-1.jpg" />
                        <a class="img-text" href="">
                            <p>Some text goes here that describes the image</p>
                        </a>
                    </div>
                    <div class="img-item">
                        <img src="../assets/client/img/category-2.jpg" />
                        <a class="img-text" href="">
                            <p>Some text goes here that describes the image</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Main Slider End -->

<!-- Featured Product Start -->
<div class="featured-product product">
    <div class="container-fluid">
        <div class="section-header">
            <h1>Sản Phẩm Nổi Bật</h1>
        </div>
        <div class="row align-items-center product-slider product-slider-4">
            <?php

            $getProductHighlight = $products->getHighlightProduct();
            if ($getProductHighlight) {
                while ($row = $getProductHighlight->fetch_assoc()) {
            ?>

                    <div class="col-lg-3">
                        <div class="product-item">
                            <div class="product-title">
                                <a href="#"><?php echo $row['nameProduct']; ?></a>
                                <div class="ratting">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                            </div>
                            <div class="product-image">
                                <a href="product-detail.html">
                                    <img src="../assets/img/product/<?php echo $row['image']; ?>" alt="Product Image" width="200px" height="200px">
                                </a>
                                <div class="product-action">
                                    <a href="#"><i class="fa fa-cart-plus"></i></a>
                                    <!-- <a href="#"><i class="fa fa-heart"></i></a> -->
                                    <a href="product-detail.php?ID=<?php echo $row['idProduct']; ?>"><i class="fa fa-search"></i></a>
                                </div>
                            </div>
                            <div class="product-price">
                                <h3><?php echo number_format($row['price']); ?><span> đ</span></h3>
                                <a class="btn" href=""><i class="fa fa-shopping-cart"></i>Buy now</a>
                            </div>
                        </div>
                    </div>


            <?php
                }
            } ?>
        </div>
    </div>

    <!-- Recent Product Start -->
    <div class="recent-product product">
        <div class="container-fluid">
            <div class="section-header">
                <h1>Sản Phẩm Gần Đây</h1>
            </div>
            <div class="row align-items-center product-slider product-slider-4">
                <?php
                $getProductNew = $products->getNewProduct();
                if ($getProductNew) {
                    while ($row = $getProductNew->fetch_assoc()) {
                ?>

                        <div class="col-lg-3">
                            <div class="product-item">
                                <div class="product-title">
                                    <a href="#"><?php echo $row['nameProduct']; ?></a>
                                    <div class="ratting">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                </div>
                                <div class="product-image">
                                    <a href="product-detail.html">
                                        <img src="../assets/img/product/<?php echo $row['image']; ?>" alt="Product Image" width="200px" height="200px">
                                    </a>
                                    <div class="product-action">
                                        <a href="#"><i class="fa fa-cart-plus"></i></a>
                                        <!-- <a href="#"><i class="fa fa-heart"></i></a> -->
                                        <a href="#"><i class="fa fa-search"></i></a>
                                    </div>
                                </div>
                                <div class="product-price">
                                    <h3><?php echo number_format($row['price']); ?><span> đ</span></h3>
                                    <a class="btn" href=""><i class="fa fa-shopping-cart"></i>Buy now</a>
                                </div>
                            </div>
                        </div>


                <?php
                    }
                } ?>
            </div>
        </div>
    </div>
    <!-- Recent Product End -->

    <!-- Footer Start -->
    <?php
    include("$_SERVER[DOCUMENT_ROOT]/GTST/views/layouts/client/footer.php");
    ?>