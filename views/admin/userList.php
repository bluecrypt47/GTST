<!-- Sidebar -->
<?php
include("$_SERVER[DOCUMENT_ROOT]/GTST/views/layouts/admin/header.php");
include("$_SERVER[DOCUMENT_ROOT]/GTST/model/admin/users/userManagement.php");

$users = new userManagement();

if (isset($_GET['DelID'])) {
    $userID = $_GET['DelID'];
    $delUser = $users->delUser($userID);
}

?>
<!-- End of Sidebar -->

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">List Users</h1>
        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- <div>
            <h6>Total <strong>#</strong> users</h6>
        </div> -->
        <?php if (isset($delUser)) {
            echo $delUser;
        } ?>
        <div style="position: absolute;  right: 100px; top: 100px; ">
            <a class="btn btn-danger" href="userAdd.php"><i class="fas fa-plus"></i> Add User</a>
        </div>
        <?php

        // Get all user in DB and pagination
        $count = 0;

        $usersList = $users->countUsers();
        $rows = mysqli_fetch_assoc($usersList);

        $totalRows = $rows['total'];

        $currentPage = isset($_GET['currentPage']) ? $_GET['currentPage'] : 1;
        $limit = 7;

        $sizePage = 2;
        $totalPage = ceil($totalRows / $limit);

        if ($currentPage > $totalPage) {
            $currentPage = $totalPage;
        } else if ($currentPage < 1) {
            $currentPage = 1;
        }
        $start = ($currentPage - 1) * $limit;
        ?>

        <?php
        if ($totalRows == 0) { ?>
            <table class="table">
                <thead style="text-align: center;">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Avatar</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone Number</th>
                        <th scope="col">Username</th>
                        <th scope="col">Password</th>
                        <th scope="col">Role</th>
                        <th scope="col">Update at</th>
                        <th scope="col">Activity</th>
                    </tr>
                </thead>
                <tbody style="text-align: center;">
                    <tr>
                        <span class='text-danger'>List Empty!</span>
                    </tr>
                </tbody>
            </table>
        <?php } else {
        ?>
            <table class="table ">
                <thead style="text-align: center;">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Avatar</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone Number</th>
                        <th scope="col">Username</th>
                        <th scope="col">Password</th>
                        <th scope="col">Role</th>
                        <th scope="col">Update at</th>
                        <th scope="col">Activity</th>
                    </tr>
                </thead>
                <tbody style="text-align: center;">
                    <?php
                    $usersList = $users->startEnd($start, $limit);
                    if ($usersList) {
                        $i = 0;
                        while ($row = $usersList->fetch_assoc()) {
                            $i++;
                    ?>
                            <tr>
                                <th scope="row"><?php echo $i; ?></th>
                                <td><img src="../../assets/img/avatar/<?php echo $row['avatar']; ?>" width="50px" height="auto"></td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo $row['phoneNumber']; ?></td>
                                <td><?php echo $row['username']; ?></td>
                                <td><?php echo $row['password']; ?></td>
                                <td><?php echo $row['nameRole']; ?></td>
                                <td><?php echo $row['updateAt']; ?></td>
                                <td><a class="btn btn-info" title="Details" href="userEdit.php?UserID=<?php echo $row['idUser']; ?>"><i class="fas fa-eye"></i></a> |
                                    <a class="btn btn-warning" title="Change password" href="userChangePassword.php?UserID=<?php echo $row['idUser']; ?>"><i class="fas fa-cogs"></i></a> |
                                    <a onclick="return confirm('Are you want to Delete this User?')" class="btn btn-danger" title="Delete" href="?DelID=<?php echo $row['idUser']; ?>"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                    <?php
                        }
                    }

                    ?>
                </tbody>
            </table>
        <?php }
        ?>
        <div>
            <a class="btn btn-success" href="<?php echo $_SERVER['HTTP_REFERER']; ?>"><i class="fas fa-caret-left"></i> Back</a>
        </div>
        <hr>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item">
                    <?php if ($currentPage > 1 && $totalPage > 1) { ?>
                        <a class="page-link" href="userList.php?currentPage=<?php echo $currentPage - 1; ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <?php
                    }

                    for ($i = 1; $i <= $totalPage; $i++) {
                        if ($i == $currentPage) { ?>
                <li class="page-item"><a class="page-link" href="#"><?php echo $i; ?></a></li>
            <?php  } else { ?>

                <li class="page-item"><a class="page-link" href="userList.php?currentPage=<?php echo $i; ?>"><?php echo $i; ?></a></li>
            <?php   }
                    }
                    if ($currentPage != $totalRows) { ?>
            <li class="page-item">
                <a class="page-link" href="userList.php?currentPage=<?php echo $currentPage + 1; ?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Next</span>
                </a>
            </li>
        <?php  }
        ?>
        </li>
            </ul>
        </nav>

    </div>
    <!-- /.container-fluid -->

</div>


<?php
include("$_SERVER[DOCUMENT_ROOT]/GTST/views/layouts/admin/footer.php");
?>