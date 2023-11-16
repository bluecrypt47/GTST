<!-- Topbar -->
<?php
include("$_SERVER[DOCUMENT_ROOT]/GTST/views/layouts/admin/header.php");
include("$_SERVER[DOCUMENT_ROOT]/GTST/model/admin/managementProduct/productManagement.php");

$products = new productManagement();

if (!isset($_GET['productID']) || $_GET['productID'] == NULL) {
    echo "<script>window.location = 'productList.php'; </script>";
} else {
    $productID = $_GET['productID'];
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productID = $_GET['productID'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $unit = $_POST['unit'];
    $idProductType = $_POST['idProductType'];
    $description = $_POST['description'];
    // $newProduct = $_POST['newProduct'];
    // $highlightProduct = $_POST['highlightProduct'];
    $updateAt = date("Y-m-d H:i:s");


    $image = basename($_FILES['image']['name']);

    // $checkInfo = $products->updateProduct($productID, $idProductType, $name, $image, $description, $price, $quantity, $unit, $newProduct, $highlightProduct, $updateAt);
    $checkInfo = $products->updateProduct($productID, $idProductType, $name, $image, $description, $price, $quantity, $unit, $updateAt);
}

?>
<!-- End of Topbar -->

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Details</b></h1>
    </div>
    <?php if (isset($checkInfo)) {
        echo $checkInfo;
    } ?>
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="p-10">
                        <?php
                        $getProduct = $products->productInfo($productID);
                        if ($getProduct) {
                            while ($row = $getProduct->fetch_assoc()) {
                        ?>
                                <form method="post" action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" class="user" enctype="multipart/form-data">
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <img src="../../assets/img/product/<?php echo $row['image']; ?>" class="rounded mx-auto d-block" alt="Image" style="width:300px;height:300px;">
                                            <label>Image<label style="color: red;">*</label></label>
                                            <input class="rounded mx-auto" type="file" name="image">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-4 mb-3 mb-sm-0">
                                            <label>Name<label style="color: red;">*</label></label>
                                            <input type="text" class="form-control form-control-user" name="name" value="<?php echo $row['nameProduct']; ?>">
                                        </div>
                                        <div class="col-sm-4">
                                            <label>Price<label style=" color: red; visibility: hidden;">*</label></label>
                                            <input type="text" class="form-control form-control-user" name="price" value="<?php echo $row['price']; ?>">
                                        </div>
                                        <div class="col-sm-4">
                                            <label>Quantity<label style="color: red; visibility: hidden;">*</label></label>
                                            <input type="text" class="form-control form-control-user" name="quantity" value="<?php echo $row['quantity']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-3 mb-3 mb-sm-0">
                                            <label>Unit<label style="color: red; visibility: hidden;">*</label></label>
                                            <input type="text" class="form-control form-control-user" name="unit" value="<?php echo $row['unit']; ?>">
                                        </div>
                                        <div class="col-sm-3">
                                            <label>Type<label style=" color: red;">*</label></label>
                                            <select name="idProductType" style=" position: absolute; top: 40px; border-radius: 10px; width: 150px; height: calc(1.5em + 0.75rem + 2px); text-align: center;" class="form-select form-select-user" aria-label="Default select example">
                                                <?php
                                                $listType = $products->getListType();

                                                while ($list = $listType->fetch_assoc()) {
                                                    if ($row['idProductType'] == $list['idProductType']) {  ?>
                                                        <option selected value="<?php echo $list['idProductType']; ?>"><?php echo $list['nameProductType']; ?></option>
                                                    <?php } else { ?>
                                                        <option value="<?php echo $list['idProductType']; ?>"><?php echo $list['nameProductType']; ?></option>
                                                <?php }
                                                } ?>
                                            </select>
                                        </div>
                                        <!-- <div class="col-sm-3">
                                            <label>New Product<label style="color: red; visibility: hidden;">*</label></label>
                                                <input type="checkbox" name="newProduct" class="form-control form-control-user" value="1" >
                                        </div>
                                        <div class="col-sm-3">
                                            <label>Highlight Product<label style="color: red; visibility: hidden;">*</label></label>
                                                <input type="checkbox" name="highlightProduct" class="form-control form-control-user" value="1" >
                                        </div> -->
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <label>Description<label style="color: red; visibility: hidden;">*</label></label>
                                            <textarea name="description" class="form-control form-control-user" style="border-radius: 10px;" cols="70" rows="10"><?php echo $row['description']; ?></textarea>
                                        </div>

                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <a class="btn btn-success btn-user btn-block" href="productList.php"><i class="fas fa-caret-left"></i> Back</a>
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="submit" name="update" value="Update Product" class="btn btn-primary btn-user btn-block" />
                                        </div>
                                    </div>
                                </form>
                        <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include("$_SERVER[DOCUMENT_ROOT]/GTST/views/layouts/admin/footer.php");
?>