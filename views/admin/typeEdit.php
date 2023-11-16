<!-- Topbar -->
<?php
include("$_SERVER[DOCUMENT_ROOT]/GTST/views/layouts/admin/header.php");
include("$_SERVER[DOCUMENT_ROOT]/GTST/model/admin/managementProduct/productTypeManagement.php");

$types = new productTypeManagement();

if (!isset($_GET['TypeID']) || $_GET['TypeID'] == NULL) {
    echo "<script>window.location = 'typeList.php'; </script>";
} else {
    $idType = $_GET['TypeID'];
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idType = $_GET['TypeID'];
    $name = $_POST['name'];
    $updateAt = date("Y-m-d H:i:s");

    $checkInfo = $types->updateType($idType, $name, $updateAt);
}

?>
<!-- End of Topbar -->

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Information</b></h1>
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
                        $getType = $types->typeInfo($idType);
                        if ($getType) {
                            while ($row = $getType->fetch_assoc()) {
                        ?>
                                <form method="post" action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" class="user" enctype="multipart/form-data">
                                    <div class="form-group row">
                                        <div class="col-sm-4 mb-3 mb-sm-0">
                                            <label>Name<label style="color: red;">*</label></label>
                                            <input type="text" class="form-control form-control-user" value="<?php echo $row['nameProductType']; ?>" name="name" placeholder="Name">
                                        </div>
                                        <div class="col-sm-4">
                                            <label style=" visibility: hidden;"><label style="color: red; visibility: hidden;">*</label></label>
                                            <input type="submit" name="update" value="Update Type" class="btn btn-primary btn-user btn-block" />
                                        </div>
                                        <div class="col-sm-4">
                                            <label style=" visibility: hidden;"><label style="color: red; visibility: hidden;">*</label></label>
                                            <a class="btn btn-success btn-user btn-block" href="typeList.php"><i class="fas fa-caret-left"></i> Back</a>
                                        </div>
                                    </div>
                                    <hr>
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