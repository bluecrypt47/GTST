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
    $updateAt = date("Y-m-d H:i:s");

    $name = $_POST['name'];
    $phoneNumber = $_POST['phoneNumber'];
    $idRole = $_POST['idRole'];

    $checkInfo = $users->updateUserInfo($userID, $name, $phoneNumber, $idRole, $updateAt);
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
                        <?php
                        $getUser = $users->userInfo($userID);
                        if ($getUser) {
                            while ($row = $getUser->fetch_assoc()) {
                        ?>
                                <form method="post" action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" class="user" enctype="multipart/form-data">
                                    <div class="form-group row" style="text-align: center;">
                                        <input type="hidden" name="form_type" value="avatar">
                                        <div class="col-sm-6">
                                            <img src="../../assets/img/avatar/<?php echo $row['avatar']; ?>" class="rounded mx-auto d-block" alt="Avatar" style="width:300px;height:300px;">
                                            <label>Avatar<label style="color: red;">*</label></label>
                                            <input class="rounded mx-auto" type="file" name="avatar" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <label>Username<label style="color: red;">*</label></label>
                                            <input type="text" class="form-control form-control-user" disabled name="username" value="<?php echo $row['username']; ?>" placeholder="Username">
                                        </div>
                                        <div class="col-sm-6">
                                            <label>Email<label style=" color: red;">*</label></label>
                                            <input type="email" class="form-control form-control-user" disabled name="email" value="<?php echo $row['email']; ?>" placeholder="Email Address">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-4 mb-3 mb-sm-0">
                                            <label>Name<label style="color: red;">*</label></label>
                                            <input type="text" class="form-control form-control-user" name="name" value="<?php echo $row['name']; ?>" placeholder="Name">
                                        </div>
                                        <div class="col-sm-4">
                                            <label>Phone Number<label style="color: red; visibility: hidden;">*</label></label>
                                            <input type="text" class="form-control form-control-user" name="phoneNumber" value="<?php echo $row['phoneNumber']; ?>" placeholder="Phone Number">
                                        </div>
                                        <div class="col-sm-4">
                                            <label>Role<label style=" color: red;">*</label></label>
                                            <select name="idRole" style=" position: absolute; top: 40px; border-radius: 10px; width: 150px; height: calc(1.5em + 0.75rem + 2px); text-align: center;" class="form-select form-select-user" aria-label="Default select example">
                                                <?php
                                                $listRole = $users->getListRole();

                                                while ($list = $listRole->fetch_assoc()) {
                                                    if ($row['idRole'] == $list['idRole']) {  ?>
                                                        <option selected value="<?php echo $list['idRole']; ?>"><?php echo $list['nameRole']; ?></option>
                                                    <?php } else { ?>
                                                        <option value="<?php echo $list['idRole']; ?>"><?php echo $list['nameRole']; ?></option>
                                                <?php }
                                                } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <a class="btn btn-success btn-user btn-block" href="userList.php"><i class="fas fa-caret-left"></i> Back</a>
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="submit" name="update" value="Update User" class="btn btn-primary btn-user btn-block" />
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