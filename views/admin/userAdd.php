<!-- Sidebar -->
<?php
include("$_SERVER[DOCUMENT_ROOT]/GTST/views/layouts/admin/header.php");
include("$_SERVER[DOCUMENT_ROOT]/GTST/model/admin/users/userManagement.php");

$users = new userManagement();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $phoneNumber = $_POST['phoneNumber'];
    $email = $_POST['email'];
    $idRole = $_POST['idRole'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $rePassword = $_POST['rePassword'];

    $checkInfo = $users->addUser($name, $phoneNumber, $email, $idRole, $username, $password, $rePassword);
}

?>
<!-- End of Sidebar -->

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Create User</h1>
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
                                        <label>Email<label style=" color: red;">*</label></label>
                                        <input type="email" class="form-control form-control-user" name="email" placeholder="Email Address">
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Phone Number<label style="color: red; visibility: hidden;">*</label></label>
                                        <input type="text" class="form-control form-control-user" name="phoneNumber" placeholder="Phone Number">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label>Username<label style="color: red;">*</label></label>
                                        <input type="text" class="form-control form-control-user" name="username" placeholder="Username">
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Role<label style=" color: red;">*</label></label>
                                        <select name="idRole" style=" position: absolute; top: 40px; border-radius: 10px; width: 150px; height: calc(1.5em + 0.75rem + 2px); text-align: center;" class="form-select form-select-user" aria-label="Default select example">
                                            <option value="1">Admin</option>
                                            <option selected value="2">User</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label>Password<label style="color: red;">*</label></label>
                                        <input type="password" class="form-control form-control-user" name="password" placeholder="Password">
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Re-Password<label style="color: red;">*</label></label>
                                        <input type="password" class="form-control form-control-user" name="rePassword" placeholder="Repeat Password">
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <a class="btn btn-success btn-user btn-block" href="userList.php"><i class="fas fa-caret-left"></i> Back</a>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="submit" name="create" value="Create User" class="btn btn-primary btn-user btn-block" />
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