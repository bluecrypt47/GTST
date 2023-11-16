<!-- Topbar -->
<?php
include("$_SERVER[DOCUMENT_ROOT]/GTST/views/layouts/admin/header.php");
include("$_SERVER[DOCUMENT_ROOT]/GTST/model/admin/users/userManagement.php");

$users = new userManagement();

if (!isset($_GET['UserID']) || $_GET['UserID'] == NULL) {
    echo "<script>window.location = 'userList.php'; </script>";
} else {
    $userID = $_GET['UserID'];
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userID = $_GET['UserID'];
    $newPassword = $_POST['newPassword'];
    $rePassword = $_POST['retypePassword'];
    $updateAt = date("Y-m-d H:i:s");

    $checkInfo = $users->changePasswordUser($userID, $newPassword, $rePassword, $updateAt);
    
}

?>
<!-- End of Topbar -->

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Profile</b></h1>
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
                        <form method="post" action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" class="user" enctype="multipart/form-data">
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <label>New password<label style="color: red;">*</label></label>
                                    <input type="password" class="form-control form-control-user" name="newPassword" placeholder="*************">
                                </div>
                                <div class="col-sm-6">
                                    <label>Retype new password<label style=" color: red;">*</label></label>
                                    <input type="password" class="form-control form-control-user" name="retypePassword" placeholder="*************">
                                </div>
                            </div>
                            <hr>

                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <a class="btn btn-success btn-user btn-block" href="userList.php"><i class="fas fa-caret-left"></i> Back</a>
                                </div>
                                <div class="col-sm-6">
                                    <input type="submit" name="create" value="Update User" class="btn btn-primary btn-user btn-block" />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include("$_SERVER[DOCUMENT_ROOT]/GTST/views/layouts/admin/footer.php");
?>