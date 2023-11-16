<!-- Topbar -->
<?php
include("$_SERVER[DOCUMENT_ROOT]/GTST/views/layouts/admin/header.php");
include("$_SERVER[DOCUMENT_ROOT]/GTST/model/admin/account/changePassword.php");

date_default_timezone_set('Asia/Ho_Chi_Minh');

$class = new updateProfile();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idUser = Session::get('idUser');

    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];
    $retypePassword = $_POST['retypePassword'];
    $updateAt = date("Y-m-d H:i:s");


    $checkUpdate = $class->changePassword($idUser, $currentPassword, $newPassword, $retypePassword, $updateAt);
}

?>
<!-- End of Topbar -->

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Change Password</b></h1>
    </div>
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="p-10">
                        <form method="post" action="changePassword.php" class="user" enctype="multipart/form-data">

                            <div class="form-group">
                                <label>Curent Password<label style="color: red;">*</label></label>
                                <input type="password" class="form-control form-control-user" name="currentPassword" placeholder="*************">
                            </div>
                            <div class="form-group">
                                <label>New Password<label style="color: red;">*</label></label>
                                <input type="password" class="form-control form-control-user" name="newPassword" placeholder="*************">
                            </div>
                            <div class="form-group">
                                <label>Retpye Password<label style="color: red;">*</label></label>
                                <input type="password" class="form-control form-control-user" name="retypePassword" placeholder="*************">
                            </div>
                            <hr>
                            <span class="text-danger"><?php if (isset($checkUpdate)) {
                                                            echo $checkUpdate;
                                                        } ?></span>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <a class="btn btn-success btn-user btn-block" href="<?php echo $_SERVER['HTTP_REFERER']; ?>"><i class="fas fa-caret-left"></i> Back</a>
                                </div>
                                <div class="col-sm-6">
                                    <input type="submit" name="changePassword" value="Change password" class="btn btn-primary btn-user btn-block" />
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