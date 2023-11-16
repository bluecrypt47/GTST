<!-- Sidebar -->
<?php
include("$_SERVER[DOCUMENT_ROOT]/GTST/views/layouts/admin/header.php");
include("$_SERVER[DOCUMENT_ROOT]/GTST/model/admin/managementProduct/productManagement.php");

$products = new productManagement();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['nameProduct'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $unit = $_POST['unit'];
    $idProductType = $_POST['idProductType'];
    $description = $_POST['description'];

    $image = basename($_FILES['image']['name']);

    $checkInfo = $products->addProduct($idProductType, $name, $image, $description, $price, $quantity, $unit);
}

?>
<!-- End of Sidebar -->

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Create Product</h1>
        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
    </div>
    <?php if (isset($checkInfo)) {
        echo $checkInfo;
    } ?>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->

        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="p-10">
                            <form method="post" action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" class="user" enctype="multipart/form-data">
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <img src="../../assets/img/product/avatar-default.png" class="rounded mx-auto d-block" alt="Image" style="width:300px;height:300px;">
                                        <label>Image<label style="color: red;">*</label></label>
                                        <input class="rounded mx-auto" type="file" name="image">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-4 mb-3 mb-sm-0">
                                        <label>Name<label style="color: red;">*</label></label>
                                        <input type="text" class="form-control form-control-user" name="nameProduct" placeholder="Name">
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Price<label style=" color: red; visibility: hidden;">*</label></label>
                                        <input type="text" class="form-control form-control-user" name="price" placeholder="10.000...">
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Quantity<label style="color: red; visibility: hidden;">*</label></label>
                                        <input type="text" class="form-control form-control-user" name="quantity" placeholder="1, 2, 3,...">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label>Unit<label style="color: red; visibility: hidden;">*</label></label>
                                        <input type="text" class="form-control form-control-user" name="unit" placeholder="Cái...">
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
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label>Description<label style="color: red; visibility: hidden;">*</label></label>
                                        <textarea name="description" class="form-control form-control-user" style="border-radius: 10px;" cols="70" rows="10"></textarea>
                                    </div>

                                </div>
                                <hr>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <a class="btn btn-success btn-user btn-block" href="productList.php"><i class="fas fa-caret-left"></i> Back</a>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="submit" name="create" value="Create Product" class="btn btn-primary btn-user btn-block" />
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include("$_SERVER[DOCUMENT_ROOT]/GTST/views/layouts/admin/footer.php");
?>