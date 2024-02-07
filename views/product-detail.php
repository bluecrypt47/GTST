<?php
include("$_SERVER[DOCUMENT_ROOT]/GTST/lib/session.php");
include("$_SERVER[DOCUMENT_ROOT]/GTST/views/layouts/client/header.php");
include("$_SERVER[DOCUMENT_ROOT]/GTST/model/client/products.php");
include("$_SERVER[DOCUMENT_ROOT]/GTST/model/client/carts.php");

$products = new products();
$carts = new carts();


if (!isset($_GET['ID']) || $_GET['ID'] == NULL) {
    echo "<script>window.location = 'index.php'; </script>";
} else {
    $productID = $_GET['ID'];
}

$idType = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $quantity = $_POST['quantity'];


    $addToCart = $carts->addToCart($productID, $quantity);
}


?>
<!-- Bottom Bar End -->

<!-- Breadcrumb Start -->
<div class="breadcrumb-wrap">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item"><a href="products.php">Products</a></li>
            <li class="breadcrumb-item active">Product Detail</li>
        </ul>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Product Detail Start -->
<div class="product-detail">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <div class="product-detail-top">
                    <div class="row align-items-center">
                        <?php
                        $getProduct = $products->getProductByID($productID);
                        if ($getProduct) {
                            while ($row = $getProduct->fetch_assoc()) {
                                $idType = $row['idProductType'];
                        ?>
                                <div class="col-md-5">
                                    <div class="product-slider-single normal-slider">
                                        <img src="../assets/img/product/<?php echo $row['image']; ?>" alt="Product Image">
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="product-content">
                                        <div class="title">
                                            <h2><?php echo $row['nameProduct']; ?></h2>
                                        </div>
                                        <div class="ratting">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <div class="price">
                                            <h4>Price:</h4>
                                            <p><?php echo number_format($row['price']); ?> đ</p>
                                        </div>
                                        <form action="" method="POST">
                                            <div class="quantity">
                                                <h4>Quantity:</h4>
                                                <div class="qty">
                                                    <button class="btn-minus"><i class="fa fa-minus"></i></button>
                                                    <input type="text" value="1" name="quantity" min=1>
                                                    <button class="btn-plus"><i class="fa fa-plus"></i></button>
                                                </div>
                                            </div>
                                            <div class="action">
                                                <!-- <a class="btn" href="#"><i class="fa fa-shopping-cart"></i>Add to Cart</a>
                                                <a class="btn" href="#"><i class="fa fa-shopping-bag"></i>Buy Now</a> -->
                                                <input class="btn" value="Buy Now" name="submit"></input>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                    </div>
                </div>

                <div class="row product-detail-bottom">
                    <div class="col-lg-12">
                        <ul class="nav nav-pills nav-justified">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="pill" href="#description">Description</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div id="description" class="container tab-pane active">
                                <!-- <h4>Product description</h4> -->
                                <p>
                                    <?php echo $row['description']; ?>
                                </p>
                            </div>

                    <?php
                            }
                        }
                    ?>
                        </div>
                    </div>
                </div>

                <div class="product">
                    <div class="section-header">
                        <h1>Related Products</h1>
                    </div>
                    <div class="row align-items-center product-slider product-slider-3">
                        <?php
                        $getProduct = $products->getRelationProduct($idType);
                        if ($getProduct) {
                            while ($row = $getProduct->fetch_assoc()) {
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
                                </div>
                        <?php
                            }
                        }
                        ?>

                    </div>
                </div>
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

            </div>
            <!-- Side Bar End -->
        </div>
    </div>
</div>
<!-- Product Detail End -->

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