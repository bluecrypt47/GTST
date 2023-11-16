<!-- Topbar -->
<?php
include("$_SERVER[DOCUMENT_ROOT]/GTST/views/layouts/admin/header.php");
include("$_SERVER[DOCUMENT_ROOT]/GTST/model/admin/account/updateProfile.php");

date_default_timezone_set('Asia/Ho_Chi_Minh');

$class = new updateProfile();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idUser = Session::get('idUser');
    $updateAt = date("Y-m-d H:i:s");

    if ($_POST['form_type'] == 'avatar') {
        $avatarName = basename($_FILES['avatar']['name']);

        $checkUpdate = $class->updateAvatar($idUser, $avatarName, $updateAt);
    } else {
        $name = $_POST['name'];
        $phoneNumber = $_POST['phoneNumber'];

        $checkUpdate = $class->updateInfo($idUser, $name, $phoneNumber, $updateAt);
    }
}

?>
<!-- End of Topbar -->

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Profile of <b> <?php echo Session::get('name'); ?></b></h1>
    </div>
    <?php if (isset($checkUpdate)) {
        echo $checkUpdate;
    } ?>
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="p-10">
                        <form method="post" action="profile.php" class="user" enctype="multipart/form-data">
                            <div class="form-group row" style="text-align: center;">
                                <input type="hidden" name="form_type" value="avatar">
                                <div class="col-sm-6">
                                    <img src="../../assets/img/avatar/<?php echo Session::get('avatar'); ?>" class="rounded mx-auto d-block" alt="Avatar" style="width:300px;height:300px;">
                                    <label>Avatar<label style="color: red;">*</label></label>
                                    <input class="rounded mx-auto" type="file" name="avatar">
                                </div>
                                <div class="col-sm-6" style="margin-top: 12%;">
                                    <input type="submit" name="update" value="Update avatar" class="btn btn-primary btn-user btn-block" />
                                </div>
                            </div>
                        </form>
                        <form method="post" action="profile.php" class="user" enctype="multipart/form-data">
                            <input type="hidden" name="form_type" value="info">
                            <div class="form-group row">
                                <div class="col-sm-4 mb-3 mb-sm-0">
                                    <label>Email<label style="color: red;">*</label></label>
                                    <input type="email" class="form-control form-control-user" disabled name="email" aria-describedby="emailHelp" value="<?php echo Session::get('email'); ?>">
                                </div>
                                <div class="col-sm-4">
                                    <label>Name<label style="color: red;">*</label></label>
                                    <input type="text" class="form-control form-control-user" name="name" value="<?php echo Session::get('name'); ?>">
                                </div>
                                <div class="col-sm-4">
                                    <label>Phone Number<label style="color: red; visibility: hidden;">*</label></label>
                                    <input type="text" class="form-control form-control-user" name="phoneNumber" value="<?php echo Session::get('phoneNumber'); ?>">
                                </div>
                            </div>
                            <hr>

                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <a class="btn btn-success btn-user btn-block" href="<?php echo $_SERVER['HTTP_REFERER']; ?>"><i class="fas fa-caret-left"></i> Back</a>
                                </div>
                                <div class="col-sm-6">
                                    <input type="submit" name="update" value="Update" class="btn btn-primary btn-user btn-block" />
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