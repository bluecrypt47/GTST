<!-- Sidebar -->
<?php
include("$_SERVER[DOCUMENT_ROOT]/GTST/views/layouts/admin/header.php");
include("$_SERVER[DOCUMENT_ROOT]/GTST/model/admin/roles/roleManagement.php");

$roles = new roleManagement();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];

    $checkInfo = $roles->addRole($name);
}

?>
<!-- End of Sidebar -->

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Create Role</h1>
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
                            <form method="post" action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" class="user">
                                <div class="form-group row">
                                    <div class="col-sm-4 mb-3 mb-sm-0">
                                        <label>Name<label style="color: red;">*</label></label>
                                        <input type="text" class="form-control form-control-user" name="name" placeholder="Name">
                                    </div>
                                    <div class="col-sm-4">
                                        <label style=" visibility: hidden;"><label style="color: red; visibility: hidden;">*</label></label>
                                        <input type="submit" name="create" value="Create Role" class="btn btn-primary btn-user btn-block" />
                                    </div>
                                    <div class="col-sm-4">
                                        <label style=" visibility: hidden;"><label style="color: red; visibility: hidden;">*</label></label>
                                        <a class="btn btn-success btn-user btn-block" href="roleList.php"><i class="fas fa-caret-left"></i> Back</a>
                                    </div>
                                </div>
                                <hr>
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