<!-- Sidebar -->
<?php
include("$_SERVER[DOCUMENT_ROOT]/GTST/views/layouts/admin/header.php");
include("$_SERVER[DOCUMENT_ROOT]/GTST/model/admin/roles/roleManagement.php");

$roles = new roleManagement();

if (isset($_GET['DelID'])) {
    $roleID = $_GET['DelID'];
    $delRole = $roles->delUser($roleID);
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
        <?php if (isset($delRole)) {
            echo $delRole;
        } ?>
        <div style="position: absolute;  right: 100px; top: 100px; ">
            <a class="btn btn-danger" href="roleAdd.php"><i class="fas fa-plus"></i> Add Role</a>
        </div>

        <?php

        // Get all user in DB and pagination
        $count = 0;

        $rolesList = $roles->countRoles();
        $rows = mysqli_fetch_assoc($rolesList);

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
                        <th scope="col">Name</th>
                        <th scope="col">Create at</th>
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
                        <th scope="col">Name</th>
                        <th scope="col">Create at</th>
                        <th scope="col">Update at</th>
                        <th scope="col">Activity</th>
                    </tr>
                </thead>
                <tbody style="text-align: center;">
                    <?php
                    $rolesList = $roles->startEnd($start, $limit);
                    if ($rolesList) {
                        $i = 0;
                        while ($row = $rolesList->fetch_assoc()) {
                            $i++;
                    ?>
                            <tr>
                                <th scope="row"><?php echo $i; ?></th>
                                <td><?php echo $row['nameRole']; ?></td>
                                <td><?php echo $row['createAtRole']; ?></td>
                                <td><?php echo $row['updateAtRole']; ?></td>
                                <td><a class="btn btn-info" title="Details" href="roleEdit.php?RoleID=<?php echo $row['idRole']; ?>"><i class="fas fa-eye"></i></a> |
                                    <a onclick="return confirm('Are you want to Delete this Role?')" class="btn btn-danger" title="Delete" href="?DelID=<?php echo $row['idRole']; ?>"><i class="fas fa-trash"></i></a>
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
                        <a class="page-link" href="roleList.php?currentPage=<?php echo $currentPage - 1; ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <?php
                    }

                    for ($i = 1; $i <= $totalPage; $i++) {
                        if ($i == $currentPage) { ?>
                <li class="page-item"><a class="page-link" href="#"><?php echo $i; ?></a></li>
            <?php  } else { ?>

                <li class="page-item"><a class="page-link" href="roleList.php?currentPage=<?php echo $i; ?>"><?php echo $i; ?></a></li>
            <?php   }
                    }
                    if ($currentPage != $totalRows) { ?>
            <li class="page-item">
                <a class="page-link" href="roleList.php?currentPage=<?php echo $currentPage + 1; ?>" aria-label="Next">
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