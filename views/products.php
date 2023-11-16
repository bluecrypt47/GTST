<?php
include("$_SERVER[DOCUMENT_ROOT]/GTST/lib/session.php");
include("$_SERVER[DOCUMENT_ROOT]/GTST/views/layouts/client/header.php");
include("$_SERVER[DOCUMENT_ROOT]/GTST/model/client/products.php");

$products = new products();
?>
<!-- Bottom Bar End -->

<!-- Breadcrumb Start -->
<div class="breadcrumb-wrap">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item"><a href="products.php">Products</a></li>
            <li class="breadcrumb-item active">List Products</li>
        </ul>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Product List Start -->
<div class="product-view">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    <!-- <div class="col-md-12">
                        <div class="product-view-top">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="product-search">
                                        <input type="email" value="Search">
                                        <button><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="product-short">
                                        <div class="dropdown">
                                            <div class="dropdown-toggle" data-toggle="dropdown">Product short by</div>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="#" class="dropdown-item">Newest</a>
                                                <a href="#" class="dropdown-item">Popular</a>
                                                <a href="#" class="dropdown-item">Most sale</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="product-price-range">
                                        <div class="dropdown">
                                            <div class="dropdown-toggle" data-toggle="dropdown">Product price range</div>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="#" class="dropdown-item">$0 to $50</a>
                                                <a href="#" class="dropdown-item">$51 to $100</a>
                                                <a href="#" class="dropdown-item">$101 to $150</a>
                                                <a href="#" class="dropdown-item">$151 to $200</a>
                                                <a href="#" class="dropdown-item">$201 to $250</a>
                                                <a href="#" class="dropdown-item">$251 to $300</a>
                                                <a href="#" class="dropdown-item">$301 to $350</a>
                                                <a href="#" class="dropdown-item">$351 to $400</a>
                                                <a href="#" class="dropdown-item">$401 to $450</a>
                                                <a href="#" class="dropdown-item">$451 to $500</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <?php

                    // Get all user in DB and pagination
                    $count = 0;

                    $productsList = $products->countProducts();
                    $rows = mysqli_fetch_assoc($productsList);

                    $totalRows = $rows['total'];

                    $currentPage = isset($_GET['currentPage']) ? $_GET['currentPage'] : 1;
                    $limit = 9;

                    $sizePage = 2;
                    $totalPage = ceil($totalRows / $limit);

                    if ($currentPage > $totalPage) {
                        $currentPage = $totalPage;
                    } else if ($currentPage < 1) {
                        $currentPage = 1;
                    }
                    $start = ($currentPage - 1) * $limit;
                    ?>
                    <?php
                    if ($totalRows == 0) { ?>
                        <span>Product Empty!</span>
                        <?php } else {
                        $productsList = $products->startEnd($start, $limit);
                        if ($productsList) {
                            while ($row = $productsList->fetch_assoc()) {
                                $idType = $row['idProductType'];
                        ?>
                                <div class="col-md-4">
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
                                                <img src="../assets/img/product/<?php echo $row['image']; ?>" alt="Product Image" width="300px" height="300px">
                                            </a>
                                            <div class="product-action">
                                                <a href="#"><i class="fa fa-cart-plus"></i></a>
                                                <!-- <a href="#"><i class="fa fa-heart"></i></a> -->
                                                <a href="product-detail.php?ID=<?php echo $row['idProduct']; ?>"><i class="fa fa-search"></i></a>
                                            </div>
                                        </div>
                                        <div class="product-price">
                                            <h3><?php echo number_format($row['price']); ?><span> đ</span></h3>
                                            <a class="btn" href=""><i class="fa fa-shopping-cart"></i>By now</a>
                                        </div>
                                    </div>
                                </div>
                    <?php
                            }
                        }
                    }
                    ?>
                </div>

                <!-- Pagination Start -->
                <div class="col-md-12">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center">
                            <li class="page-item">
                                <?php if ($currentPage > 1 && $totalPage > 1) { ?>
                                    <a class="page-link" href="products.php?currentPage=<?php echo $currentPage - 1; ?>" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <?php
                                }

                                for ($i = 1; $i <= $totalPage; $i++) {
                                    if ($i == $currentPage) { ?>
                            <li class="page-item"><a class="page-link" href="#"><?php echo $i; ?></a></li>
                        <?php  } else { ?>

                            <li class="page-item"><a class="page-link" href="products.php?currentPage=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                        <?php   }
                                }
                                if ($currentPage != $totalRows) { ?>
                        <li class="page-item">
                            <a class="page-link" href="products.php?currentPage=<?php echo $currentPage + 1; ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Next</span>
                            </a>
                        </li>
                    <?php  }
                    ?>
                    </li>
                        </ul>
                    </nav>
                </div>
                <!-- Pagination Start -->
            </div>

            <!-- Side Bar Start -->
            <div class="col-lg-4 sidebar">
                <div class="sidebar-widget category">
                    <h2 class="title">Category</h2>
                    <nav class="navbar bg-light">
                        <ul class="navbar-nav">
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

                <div class="sidebar-widget widget-slider">
                    <div class="sidebar-slider normal-slider">
                        <?php
                        $getProduct = $products->getRelationProduct($idType);
                        if ($getProduct) {
                            while ($row = $getProduct->fetch_assoc()) {
                        ?>
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
                                        <a href="product-detail.php?ID=<?php echo $row['idProduct']; ?>">
                                            <img src="../assets/img/product/<?php echo $row['image']; ?>" alt="Product Image" width="300px" height="300px">
                                        </a>
                                        <div class="product-action">
                                            <a href="#"><i class="fa fa-cart-plus"></i></a>
                                            <!-- <a href="#"><i class="fa fa-heart"></i></a> -->
                                            <a href="product-detail.php?ID=<?php echo $row['idProduct']; ?>"><i class="fa fa-search"></i></a>
                                        </div>
                                    </div>
                                    <div class="product-price">
                                        <h3><?php echo number_format($row['price']); ?> đ</h3>
                                        <a class="btn" href=""><i class="fa fa-shopping-cart"></i>Buy Now</a>
                                    </div>
                                </div>
                        <?php
                            }
                        }
                        ?>
                    </div>
                </div>

                <div class="sidebar-widget brands">
                    <h2 class="title">Our Brands</h2>
                    <ul>
                        <li><a href="#">Nulla </a><span>(45)</span></li>
                        <li><a href="#">Curabitur </a><span>(34)</span></li>
                        <li><a href="#">Nunc </a><span>(67)</span></li>
                        <li><a href="#">Ullamcorper</a><span>(74)</span></li>
                        <li><a href="#">Fusce </a><span>(89)</span></li>
                        <li><a href="#">Sagittis</a><span>(28)</span></li>
                    </ul>
                </div>
            </div>
            <!-- Side Bar End -->
        </div>
    </div>
</div>
<!-- Product List End -->

<!-- Brand Start -->
<div class="brand">
    <div class="container-fluid">
        <div class="brand-slider">
            <div class="brand-item"><img src="img/brand-1.png" alt=""></div>
            <div class="brand-item"><img src="img/brand-2.png" alt=""></div>
            <div class="brand-item"><img src="img/brand-3.png" alt=""></div>
            <div class="brand-item"><img src="img/brand-4.png" alt=""></div>
            <div class="brand-item"><img src="img/brand-5.png" alt=""></div>
            <div class="brand-item"><img src="img/brand-6.png" alt=""></div>
        </div>
    </div>
</div>
<!-- Brand End -->

<!-- Footer Start -->
<?php
include("$_SERVER[DOCUMENT_ROOT]/GTST/views/layouts/client/footer.php");
?>